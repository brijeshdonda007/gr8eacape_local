<?php

class Privacypolicy extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('privacypolicy_model');
		$this->load->database();
        $this->load->helper('text');
	}
	function index(){
			$this->load->model('login/Site_setting_model');
			$data['settings'] = $this->Site_setting_model->get_site_info(1);
		$data['header_menus'] = $this->Site_setting_model->get_header_menu();
		$data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
		$data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();
            $data['user_profile_info']                      = $this->privacypolicy_model->getUserInfo($this->session->userdata('user_id'));
            $data['privacy_policy']                     =       $this->privacypolicy_model->getPrivacyPolicy(5);
            $data['main_client_view']                   =       'privacypolicy/privacy-policy';
            $data['page_title'] = 'Privacy & Policy';
            $this->load->view('index', $data);
	}
}
