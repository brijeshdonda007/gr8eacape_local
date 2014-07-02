<?php
/**
* Guest controller
*
* @category Controller
* @author Eftakhairul Islam <eftakhairul@gmail.com> (http://eftakhairul.com)
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH .'modules/user/controllers/UserbaseController.php';
class Guest extends UserbaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if($this->session->userdata('user_id') == FALSE) {
            redirect('/login/index/','refresh');
        }

        $data['user_profile_info']       = $this->user_model->getUserInfo($this->session->userdata('user_id'));
        $data['user_country']            = $this->location_model->Country_user($data['user_profile_info']->country_id);
        $data['city']                    = $this->location_model->getCityByID($data['user_profile_info']->city_id);
        $data['booking_requests']        = $this->user_model->getAllBokingRequest($data['user_profile_info']->id);
        $data['booking_requests_buyer']  = $this->user_model->getAllBokingRequestBuyer($data['user_profile_info']->id);
        $data['latest_escapes']          = $this->user_model->getAlllatestLists($data['user_profile_info']->id);
        $data['confirmed_booking']       = $this->user_model->getAllConfirmedBooking($data['user_profile_info']->id);
        $data['unread_notifications']    = $this->user_model->getUnreadNotifications($data['user_profile_info']->id);
        $data['inbox_unread_items']      = $this->message_model->getAllMessageUnreadByUser($this->session->userdata('user_id'));
        if($this->session->userdata('Fb_user')) {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }

        $data['rating_category']         = $this->user_model->get_user_ratings_category();
        $data['ratings_cat']             = $this->user_model->getAllRateCategory();
        $data['all_rates']               = $this->user_model->getTotalRate();
        $data['total_count']             = count($data['all_rates']);

        $data['total_reviews']           = $this->user_model->geAllReviews($this->session->userdata('user_id'));
        $data['left_sidebar']            = 'user/guest/left-sidebar';
        $data['main_client_view']        = 'user/guest/dashboard';
        $data['dashboard_content']       = 'main-content';
        $data['page_title']              = 'Guest Dashboard';

        $this->commonSetting();
        $this->load->view('user', $data);;
    }
}