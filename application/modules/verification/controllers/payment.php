<?php

/**
* Payment Process for verification
*
* @category Controller
* @author Eftakhairul Islam <eftakhairul@gmail.com> (http://eftakhairul.com)
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller
{
    /**
     * Initialization value
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model("verification/Verification_payment");
        $this->load->library('form_validation');
        $this->load->helper('file');
    }

    /**
     * Final confirmation page before the payment process
     *
     * @route /verification/payment/confirmation
     */
    public function confirmation()
    {
        if(empty($_POST)) redirect('/verification');
        if (!$this->session->userdata('user_id')) redirect('login/index');
        $this->load->model("escapedetails/escapedetails_model");
        $escapeDetailModel = new Escapedetails_model();
        $escapeDetails     = $escapeDetailModel->findById($this->input->post('property_id'));

        $bookingData = array(
            'property_id'       => $this->input->post('property_id'),
            'total_amount'      => $this->input->post('total_price'),
            'urlx'              => current_url(),
            'is_business'       => 1,
            'user_id'           => $this->session->userdata('user_id'),
            'verification_name' => "Verification Payment - {$escapeDetails['title']}",
        );

        $this->session->set_userdata('booking_redirect', 1);
        $this->session->set_userdata('bookingr_data',$bookingData);

        $this->load->model('login/Site_setting_model');
        $this->load->model('booking/booking_model');

        $data['booking_data']        = $this->session->userdata('bookingr_data');
        $data['user_profile_info']   = $this->booking_model->getUserInfo($this->session->userdata('user_id'));
        $data['escape_detail']       = $this->booking_model->getPropInfoByID($this->session->userdata['bookingr_data']['property_id']);
        $data['main_client_view']    = "verification/confirmation";
        $data['settings']            = $this->Site_setting_model->get_site_info(1);
        $data['header_menus']        = $this->Site_setting_model->get_header_menu();
        $data['footer_menus']        = $this->Site_setting_model->get_footer_menu();
        $data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();
        $data['page_title']          = 'Verification Payment Confirmation';

        $this->load->view('index', $data);
    }


	/**
     * Main payment Engine and communicating with swipeHQ
     *
     * @route /verification/payment/booking_and_pay
     */
    public function booking_and_pay()
    {
		$booking_data = $this->session->userdata('bookingr_data');

        if (empty($booking_data)) redirect('/verification');


        $verificationPaymentModel           = new Verification_payment();
		$id                                 = $verificationPaymentModel->save($booking_data);
        $verificationPaymentData            = $verificationPaymentModel->findById($id);

        $payment_data                       = array('id'           => $verificationPaymentData->id,
                                                    'property_id'  => $verificationPaymentData->property_id,
                                                    'total_amount' => $verificationPaymentData->total_amount,
                                                    'is_business'  => $booking_data['is_business']
                                                    );

        $this->session->set_userdata('payment_data', $payment_data);

		// from payment_form view
		$gstp          = (15/100) * ($verificationPaymentData->total_amount);
		$grand_total   = ($verificationPaymentData->total_amount) + $gstp;
		$td_item       = $verificationPaymentData->id.'-'.$verificationPaymentData->verification_name;

		$postData      = array("api_key"          => "ffdc58e12321e603aef29fb393be069cddef079a091210ce3ebf2df98c182c77",
                               "merchant_id"      => "15CC0006964023",
                               "td_item"          => $td_item,
                               "td_amount"        => $grand_total,
                               "td_description"   => $verificationPaymentData->verification_name,
                               "td_user_data"     => $id
                        );

		$response      = $verificationPaymentModel->post_to_url("https://api.swipehq.com/createTransactionIdentifier.php", $postData);
		$response_data = json_decode($response);

		if ($response_data->response_code == 200 && !empty($response_data->data->identifier)) {

			$trans_id = $response_data->data->identifier;
            $payment_data = $this->session->userdata('payment_data');
            $payment_data['transaction_id'] = $trans_id;
            $this->session->set_userdata('payment_data', $payment_data);


			#SET LPN API
			$params = array ("merchant_id" => "15CC0006964023",
			                 "api_key"     => "ffdc58e12321e603aef29fb393be069cddef079a091210ce3ebf2df98c182c77",
			                 'lpn_url'     => base_url() . "verification/payment/paymentsuccess"
			);
			$verificationPaymentModel->post_to_url('https://api.swipehq.com/setLpn.php', $params);

			#SET Callback API
			$params = array ("merchant_id"  => "15CC0006964023",
    		                 "api_key"      => "ffdc58e12321e603aef29fb393be069cddef079a091210ce3ebf2df98c182c77",
			                 'callback_url' => base_url() . "verification/payment/paymentsuccess"
			);
			$verificationPaymentModel->post_to_url('https://api.swipehq.com/setCallback.php', $params);
		}

        redirect('https://payment.swipehq.com/?identifier_id=' . $trans_id. '&checkout=true');
	}

    /**
     * After successful payment
     *
     * @route /verification/payment/paymentsuccess
     */
    public function paymentsuccess()
    {

        $this->load->model("propertyapprove_enum");
        $this->load->model('login/Site_setting_model');
        $this->load->model("escapedetails/escapedetails_model");

        $verificationPaymentId = $this->input->get('user_data');

        $escapedetailsModel         = new Escapedetails_model();
        $verificationPaymentModel   = new Verification_payment();
        $payment_data               = $this->session->userdata('payment_data');


        $escapeDetails              = $escapedetailsModel->findById($payment_data['property_id']);
        $data['pdf_download']       = $verificationPaymentModel->getPaymentWithPropertyAndUserDetails($verificationPaymentId);

        if (!empty($data['pdf_download']->email)) {
            $this->load->model('invoice/invoice_model');
            $html                 = $this->load->view('invoice/verification_invoice', $data, true);
            $invoiceModel         = new Invoice_model();
            $AttachedFilePath     = $verificationPaymentModel->createPdfInvoice($html);

            if (file_exists($AttachedFilePath)) {
                $invoiceModel->sendVerificationPaymentInvoice($data['pdf_download'],  $AttachedFilePath);
            }
        }

        $payment_data['status'] = Propertyapprove_enum::ACCEPTED;
        $verificationPaymentModel->update($verificationPaymentId, $payment_data);
        $this->session->set_flashdata('success_msg', 'Payment Accepted Successfully.');

        redirect('/verification');
    }
}
