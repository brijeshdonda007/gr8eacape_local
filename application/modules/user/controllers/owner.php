<?php
/**
* Owner controller
*
* @category Controller
* @author Eftakhairul Islam <eftakhairul@gmail.com> (http://eftakhairul.com)
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH .'modules/user/controllers/UserbaseController.php';

class Owner extends UserbaseController
{

    /**
     * Initializing
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Serve the owner home page
     *
     * @route /owner
     */
    public function index()
    {
        if ($this->session->userdata('user_id') == FALSE) {
            redirect('/login/index/','refresh');
        }
        
        $this->data['user_profile_info']      = $this->user_model->getUserInfo($this->session->userdata('user_id'));
        $this->data['user_country']           = $this->location_model->Country_user($this->data['user_profile_info']->country_id);
        $this->data['city']                   = $this->location_model->getCityByID($this->data['user_profile_info']->city_id);
        $this->data['booking_requests']       = $this->user_model->getAllBokingRequest($this->data['user_profile_info']->id);
        $this->data['booking_requests_buyer'] = $this->user_model->getAllBokingRequestBuyer($this->data['user_profile_info']->id);
        $this->data['latest_escapes']         = $this->user_model->getAlllatestLists($this->data['user_profile_info']->id);
        $this->data['confirmed_booking']      = $this->user_model->getAllConfirmedBooking($this->data['user_profile_info']->id);
        $this->data['unread_notifications']   = $this->user_model->getUnreadNotifications($this->data['user_profile_info']->id);
        $this->data['inbox_unread_items']     = $this->message_model->getAllMessageUnreadByUser($this->session->userdata('user_id'));

        if($this->session->userdata('Fb_user')) {
            $this->data['fb_arr'] = $this->session->userdata('Fb_user');
        }

        $this->data['user_ratings']               = $this->user_ratings();
        $this->data['total_reviews']              = $this->user_model->geAllReviews($this->session->userdata('user_id'));
        $this->data['main_client_view']           =  'user/owner/dashboard';
        $this->data['left_sidebar']               =  'user/owner/left-sidebar';
        $this->data['dashboard_content']          =  'user/owner/main-content';
        $this->data['page_title']                 =  'Owner Dashboard';

        $this->commonSetting();
        $this->load->view('user', $this->data);
    }

    /**
     * Show the earning details of owner
     *
     * @route /owner/mainEarning
     */
    public function mainEarning()
    {
        if($this->session->userdata('Fb_user')) {
            $this->data['fb_arr'] = $this->session->userdata('Fb_user');
        }

        $this->data['user_profile_info']     = $this->user_model->getUserInfo($this->session->userdata('user_id'));
        $this->data['unread_notifications']  = $this->user_model->getUnreadNotifications($this->data['user_profile_info']->id);
        $this->data['country']               = $this->location_model->Country($this->data['user_profile_info']->country_id);
        $this->data['city']                  = $this->location_model->getCityByID($this->data['user_profile_info']->city_id);
        $this->data['previous_earn_records'] = $this->user_model->getPreviousMnthRecords($this->data['user_profile_info']->id);
        $this->data['previous_earn']         = $this->user_model->getPreviousMonthEarn($this->data['user_profile_info']->id);
        $this->data['pending_balance']       = $this->user_model->getPendingBalance($this->data['user_profile_info']->id);
        $this->data['pending_balance_all']   = $this->user_model->getPendingBalanceAll($this->data['user_profile_info']->id);

        $this->data['main_client_view']      = 'user/owner/dashboard';
        $this->data['dashboard_content']     = 'user/owner/main-content';
        $this->data['list_property_view']    = 'user/owner/main_earnings';
        $this->data['page_title']            = 'Earnings';

        $this->commonSetting();
        $this->load->view('list_property', $this->data);
    }

    /**
     * Download PDF based on transaction Id
     *
     * @param $id
     * @route /owner/downloadEachTransactionInvoice/{id}
     */
    public function downloadEachTransactionInvoice($id)
    {
        $this->load->model('user/pdf_model');
        $this->data['pdf_download'] = $this->pdf_model->downloadEachTrnsx($id);
        $html                       = $this->load->view('invoice/owner_main_transaction_invoice',
                                                        $this->data,
                                                        true);


        $this->load->model('invoice/invoice_model');
        $invoiceModel = new Invoice_model();
        $invoiceModel->createPdfInvoice($html, true);
    }
}