<?php

/**
* Verification Service Controller
*
* @category Controller
* @author Eftakhairul Islam <eftakhairul@gmail.com> (http://eftakhairul.com)
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verification extends CI_Controller
{
    const ADDRESS_VERIFICATION_PRICE = 4;

    /**
     * Initialization
     */
    function __construct()
    {
		parent::__construct();

        $this->load->helper('url');
        $this->load->helper('form');

		$this->load->library('session');
		$this->load->library('image_lib');


		$this->load->database();
	}

    /**
     * Serve the address verification page
     * @route /verification/index
     */
    public function index()
    {
        if($this->session->userdata('user_id') == FALSE){redirect('/login/index/','refresh');}

        $this->load->model("user/user_model");
        $this->load->model('login/Site_setting_model');

        //For Side bar and others
        $data['user_profile_info']       = $this->user_model->getUserInfo($this->session->userdata('user_id'));
        $data['unread_notifications']    = $this->user_model->getUnreadNotifications($data['user_profile_info']->id);

        //For Updating property
        $this->load->model("escapedetails/escapedetails_model");
        $this->load->model("propertyapprove_enum");

        $escapedetailsModel              = new Escapedetails_model();
        $data['escapes']                 = $escapedetailsModel->getUnapprovePropertyByOwnerId($this->session->userdata('user_id'));
        $data['accepted_escapes']        = $escapedetailsModel->getAcceptedPropertyByOwnerId($this->session->userdata('user_id'));

        $data['propertyapprove_status']  = PropertyApprove_enum::findAll();

        //Page Details Content
        $this->load->model("page/page_model");
        $pageModel                       =  new Page_model();
        $data['verification_content']    = $pageModel->getDataByPageName("Address Verification");


        //For maintaining view
		$data['main_client_view']       = 'user/user-dashboard';
		$data['dashboard_content']      = 'verification/address-verification';
		$data['page_title']             = "Address Verification";

        //Sidebar and others
		$data['settings']                            = $this->Site_setting_model->get_site_info(1);
		$data['header_menus']                        = $this->Site_setting_model->get_header_menu();
		$data['footer_menus']                        = $this->Site_setting_model->get_footer_menu();
		$data['footer_bottom_menus']                 = $this->Site_setting_model->get_footer_bottom_menu();
        $data['address_verification_total_price']    = self::ADDRESS_VERIFICATION_PRICE;

		$this->load->view('user', $data);
    }
}
