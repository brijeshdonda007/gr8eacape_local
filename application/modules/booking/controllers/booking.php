<?php
/**
* Booking controller are responsible for processing booking
*
* @category Controller
* @author Eftakhairul Islam <eftakhairul@gmail.com> (http://eftakhairul.com)
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Booking
 */
class Booking extends CI_Controller
{

    /**
     * Initializing everything
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('booking_model');

        $this->load->library('form_validation');
        $this->load->library('email');

        $this->load->plugin('to_pdf');

        $this->load->helper('file');
        $this->load->helper('booking');
        $this->load->helper('logger');
    }

    /**
     * This process the payment after owner confirm the escape
     *
     * @param $id
     */
    public function post_confirmation_process_payment($id)
    {
        if (!$this->session->userdata('user_id')){
			redirect('login/index');

		} else {

            $bookingData                 = $this->booking_model->getDetailsByBookingId($id);
            $data['user_profile_info']   = $this->booking_model->getUserInfo($this->session->userdata('user_id'));

            if (empty($bookingData)) {
                $this->session->set_flashdata('success_msg', 'Something is went wrong. Please contact Escape owner.');
                redirect('user/index');
            }


            $bookingr_data = array('property_id'   => $bookingData->property_id,
                                   'start_date'    => $bookingData->start_date,
                                   'end_date'      => $bookingData->end_date,
                                   'no_of_guests'  => $bookingData->no_of_guests,
                                   'total_price'   => $bookingData->total_price,
                                   'booked_days'   => $bookingData->booked_days,
                                   'is_business'   => $data['user_profile_info']->is_business,
                                   'urlx'          => base_url() . '/booking/booking_direct',
                                   'id'            => $bookingData->id
            );

            $this->session->set_userdata('bookingr_data',$bookingr_data);
            $this->session->set_userdata('payment_data', $bookingr_data);

            $booking = $this->booking_model->getBookingByID($bookingData->id);

            if (empty($booking)) {
                $this->session->set_flashdata('success_msg', 'Something is went wrong. Please contact Escape owner.');
                redirect('user/index');
            }


            // from payment_form view
            $gstp = (15/100) * ($booking->total_price);
            if (true)
                $gst_amt = ($booking->total_price) + $gstp;
            else
                $gst_amt = ($booking->total_price);

            $grand_total     = $gst_amt;
            $escapeDetail    = $this->booking_model->getPropInfoByID($bookingData['property_id']);
            if(!empty($escapeDetail->bond_amount))          $grand_total =  $grand_total + $escapeDetail->bond_amount;
            if(!empty($escapeDetail->cleaning_amount))      $grand_total =  $grand_total + $escapeDetail->cleaning_amount;


            $td_item         = $booking->id.'-'.$booking->title;

            $postData = array(
		     "api_key"          => "ffdc58e12321e603aef29fb393be069cddef079a091210ce3ebf2df98c182c77",
		     "merchant_id"      => "15CC0006964023",
		     "td_item"          => $td_item,
		     "td_amount"        => $grand_total,
		     "td_description"   => 'Escape Name : '. $booking->title,
		     "td_user_data"     => $grand_total
            );
            $response = $this->booking_model->post_to_url("https://api.swipehq.com/createTransactionIdentifier.php", $postData);
            $response_data = json_decode($response);

            if($response_data->response_code == 200 && !empty($response_data->data->identifier))
            {
                $trans_id = $response_data->data->identifier;
                $this->booking_model->saveSessionTransID($trans_id);

                #SET LPN API
			$params = array (
			     "merchant_id"  => "15CC0006964023",
			     "api_key"      => "ffdc58e12321e603aef29fb393be069cddef079a091210ce3ebf2df98c182c77",
			     'lpn_url'      => base_url() . "booking/paymentsuccess"
			);
			$this->booking_model->post_to_url('https://api.swipehq.com/setLpn.php', $params);
			#SET Callback API
			$params = array (
			    "merchant_id"  => "15CC0006964023",
			     "api_key"     => "ffdc58e12321e603aef29fb393be069cddef079a091210ce3ebf2df98c182c77",
			    'callback_url' => base_url() . "booking/paymentsuccess"
			);
			$this->booking_model->post_to_url('https://api.swipehq.com/setCallback.php', $params);
            }

            $ret = '<form action="https://payment.swipehq.com/?identifier_id=' .$trans_id. '&checkout=true" method="post" id="swipe_payment_form">
                    <input type="submit" class="button buttonBlue checkout" id="submit_swipehq_payment_form" value="Book Now" />
                    <a class="buttonRed" href="">Cancel order </a>
                    </form><script>document.getElementById("swipe_payment_form").submit()</script>';
		    echo $ret;
        }
    }


    /**
     * Show the confirmation details for pre confirmation type only.
     */
    public function request_confirm()
    {
        if ($this->session->userdata('booking_redirect') == '1'){
            $bookingr_data = $this->session->userdata('bookingr_data');
        }else{
            $bookingr_data = array(
                'property_id'   => $this->input->post('property_id'),
                'start_date'    => $this->input->post('start_date'),
                'end_date'      => $this->input->post('end_date'),
                'no_of_guests'  => $this->input->post('no_of_guests'),
                'total_price'   => $this->input->post('total_price'),
                'booked_days'   => $this->input->post('booked_days'),
                'urlx'          => current_url()
            );
        }


        $this->session->set_userdata('booking_redirect','0');
        $this->session->set_userdata('bookingr_data',$bookingr_data);

        if (!$this->session->userdata('user_id')){
            redirect('login/index');
        }else{

            $data['escape_detail']       = $this->booking_model->getPropInfoByID($this->session->userdata['bookingr_data']['property_id']);
            $data['booking_data']        = $this->session->userdata('bookingr_data');
            $data['user_profile_info']   = $this->booking_model->getUserInfo($this->session->userdata('user_id'));

            $data['owner_info']          = $this->booking_model->getUserInfo($data['escape_detail']->owner_id);
            $data['main_client_view']    = "booking/confirm";
            $this->load->model('login/Site_setting_model');
            $data['settings']            = $this->Site_setting_model->get_site_info(1);
            $data['header_menus']        = $this->Site_setting_model->get_header_menu();
            $data['footer_menus']        = $this->Site_setting_model->get_footer_menu();
            $data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();

            $data['page_title'] = 'Booking Confirm';
            $this->load->view('index', $data);
        }
    }


    /**
     * Process email and redirect to success page for pre-confirmation booking
     */
    public function request()
    {
	    $bookingr_data = $this->session->userdata('bookingr_data');

        if(!$this->session->userdata('user_id')){
            redirect('login/index');
        } else {
            $id = $this->booking_model->request($bookingr_data);
            if($id){
                $data['escape_detail']      = $this->booking_model->getPropInfoByID($bookingr_data['property_id']);
                $bookingr_data['reference'] = $this->booking_model->getReferenceNoByID($id);

                $this->preConfirmationEmail($bookingr_data, $data['escape_detail']);
            }
        }
    }

    /**
     * Payment page for confirmed escape
     */
    public function booking_direct()
    {
		if ($this->session->userdata('booking_redirect') == '1'){
			$bookingr_data = $this->session->userdata('bookingr_data');
		}else{
			$bookingr_data = array(
				'property_id'   => $this->input->post('property_id'),
				'start_date'    => $this->input->post('start_date'),
				'end_date'      => $this->input->post('end_date'),
				'no_of_guests'  => $this->input->post('no_of_guests'),
				'total_price'   => $this->input->post('total_price'),
				'booked_days'   => $this->input->post('booked_days'),
				'is_business'   => $this->input->post('is_business'),
				'urlx'          => current_url()
			);
		}

		if (!$this->session->userdata('user_id')){
			redirect('login/index');
		} else {
            $this->session->set_userdata('booking_redirect','0');
            $data['user_profile_info']    = $this->booking_model->getUserInfo($this->session->userdata('user_id'));
            $bookingr_data['is_business'] = $data['user_profile_info']->is_business;
		    $this->session->set_userdata('bookingr_data',$bookingr_data);

			$this->paynow();
		}
    }

    /**
     * This is success page when email is sent for pre-confirmation booking
     */
    public function success()
    {
        $data['user_profile_info']   = $this->booking_model->getUserInfo($this->session->userdata('user_id'));
        $data['main_client_view']    = "booking/booking_success";
		$data['page_title']          = 'Booking success';
		$this->load->model('login/Site_setting_model');
		$data['settings']            = $this->Site_setting_model->get_site_info(1);
		$data['header_menus']        = $this->Site_setting_model->get_header_menu();
		$data['footer_menus']        = $this->Site_setting_model->get_footer_menu();
		$data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();

        $this->load->view('index', $data);
    }

    /**
     *
     */
    public function paynow()
    {
        $data['escape_detail']      = $this->booking_model->getPropInfoByID($this->session->userdata['bookingr_data']['property_id']);
        $data['user_profile_info']  = $this->booking_model->getUserInfo($this->session->userdata('user_id'));

        $total = $this->session->userdata['bookingr_data']['total_price'];
        if(!empty($data['escape_detail']->bond_amount))  $total =  $total + $data['escape_detail']->bond_amount;
        if(!empty($data['escape_detail']->cleaning_amount)) $total =  $total + $data['escape_detail']->cleaning_amount;

		$data['gstp']        = calculateGST($total);
        $data['grand_total'] = totalCalc($this->session->userdata['bookingr_data']['total_price'],
                                         $data['escape_detail']->cleaning_amount,
                                         $data['escape_detail']->bond_amount,
                                         true);

		$data['booking_data'] = array(
			'property_id' => $this->session->userdata['bookingr_data']['property_id'],
			'start_date' => $this->session->userdata['bookingr_data']['start_date'],
			'end_date' => $this->session->userdata['bookingr_data']['end_date'],
			'title' => $data['escape_detail']->title,
			'booked_days' => $this->session->userdata['bookingr_data']['booked_days'],
			'no_of_guests' => $this->session->userdata['bookingr_data']['no_of_guests'],
			'total_price' => $this->session->userdata['bookingr_data']['total_price'],
			'is_business' => $this->session->userdata['bookingr_data']['is_business']
		);
        $data['page_title'] = 'Book Now';
		$this->load->model('login/Site_setting_model');
		$data['settings'] = $this->Site_setting_model->get_site_info(1);
		$data['header_menus'] = $this->Site_setting_model->get_header_menu();
		$data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
		$data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();
        $data['main_client_view'] = "booking/payment_form";
        $this->load->view('index', $data);
    }

    /**
     * After payment success page
     */
    public function paymentsuccess()
    {

        $payment_data                = $this->session->userdata('payment_data');
        $this->booking_model->bookingStatusUpdate($payment_data);

        $data['user_profile_info']   = $this->booking_model->getUserInfo($this->session->userdata('user_id'));
		$data['page_title']          = 'Payment success';
        $data['main_client_view']    = "booking/payment_success";
		$this->load->model('login/Site_setting_model');

		$data['settings']            = $this->Site_setting_model->get_site_info(1);
		$data['header_menus']        = $this->Site_setting_model->get_header_menu();
		$data['footer_menus']        = $this->Site_setting_model->get_footer_menu();
		$data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();

        $this->load->view('index', $data);
    }

    /**
     * Create request to Swipe HQ to start payment process
     */
    public function booking_and_pay()
    {
		$bookingr_data = array(
			'property_id'   => $_REQUEST['escape_id'],
			'start_date'    => $_REQUEST['start_date'],
			'end_date'      => $_REQUEST['end_date'],
			'no_of_guests'  => $_REQUEST['no_of_guests'],
			'total_price'   => $_REQUEST['total_price'],
			'booked_days'   => $_REQUEST['booked_days'],
			'is_business'   => $_REQUEST['is_business'],
			'urlx'          => current_url()
		);
		$this->session->set_userdata('bookingr_data',$bookingr_data);
		$id = $this->booking_model->booking_direct($bookingr_data);
        $booking = $this->booking_model->getBookingByID($id);
        $payment_data = array(
	        'id'            => $booking->id,
	        'property_id'   => $booking->property_id,
	        'start_date'    => $booking->start_date,
	        'end_date'      => $booking->end_date,
	        'no_of_guests'  => $booking->no_of_guests,
	        'total_price'   => $booking->total_price,
	        'booked_days'   => $booking->booked_days,
		    'is_business'   => $_REQUEST['is_business']
        );
        $this->session->set_userdata('payment_data',$payment_data);

		$data['escape_detail'] = $this->booking_model->getPropInfoByID($payment_data['property_id']);
        $grand_total           = totalCalc($payment_data['total_price'],
                                           $data['escape_detail']->cleaning_amount,
                                           $data['escape_detail']->bond_amount,
                                           true);

		$td_item = $booking->id.'-'.$booking->title;
		$postData = array("api_key"         => "ffdc58e12321e603aef29fb393be069cddef079a091210ce3ebf2df98c182c77",
		                  "merchant_id"     => "15CC0006964023",
		                  "td_item"         => $td_item,
		                  "td_amount"       => $grand_total,
		                  "td_description"  => 'Escape Name : '. $booking->title,
		                  "td_user_data"    => $grand_total
		                 );

		$response      = $this->booking_model->post_to_url("https://api.swipehq.com/createTransactionIdentifier.php", $postData);
		$response_data = json_decode($response);

		if($response_data->response_code == 200 && !empty($response_data->data->identifier)){
			$trans_id = $response_data->data->identifier;
			$this->booking_model->saveSessionTransID($trans_id);

			#SET LPN API
			$params = array (
			     "merchant_id"  => "15CC0006964023",
			     "api_key"      => "ffdc58e12321e603aef29fb393be069cddef079a091210ce3ebf2df98c182c77",
			     'lpn_url'      => base_url() . "booking/paymentsuccess"
			);
			$this->booking_model->post_to_url('https://api.swipehq.com/setLpn.php', $params);

			#SET Callback API
			$params = array (
			    "merchant_id"  => "15CC0006964023",
			     "api_key"     => "ffdc58e12321e603aef29fb393be069cddef079a091210ce3ebf2df98c182c77",
			    'callback_url' => base_url() . "booking/paymentsuccess"
			);
			$this->booking_model->post_to_url('https://api.swipehq.com/setCallback.php', $params);
		}

		$ret = '<form action="https://payment.swipehq.com/?identifier_id=' .$trans_id. '&checkout=true" method="post" id="swipe_payment_form">
                <input type="submit" class="button buttonBlue checkout" id="submit_swipehq_payment_form" value="Book Now" />
                <a class="buttonRed" href="">Cancel order </a>
                </form>';

		echo $ret;
	}

    /**
     * Processing the first email for pre confirmation type escape
     *
     * @param $bookingData
     * @param $escapeDetails
     */
    private function preConfirmationEmail($bookingData, $escapeDetails)
    {
        $data['booking_data']        = $bookingData;
        $data['escapeDetails']       = $escapeDetails;
        $data['user_profile_info']   = $this->booking_model->getUserInfo($this->session->userdata('user_id'));
        $data['owner_info']          = $this->booking_model->getUserInfo($escapeDetails->owner_id);
        $data['email_message']       = $this->load->view('booking/pre_confimation_email', $data, true);

        $this->booking_model->sendPreConfirmationEmail($data);
        redirect('booking/success');
    }
}
