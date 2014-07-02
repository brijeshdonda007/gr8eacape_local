<?php

class Cancellationpolicy extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('cancellationpolicy_model');
		$this->load->database();
        $this->load->helper('text');
	}
	function index(){
            $data['user_profile_info']                      = $this->cancellationpolicy_model->getUserInfo($this->session->userdata('user_id'));
            $data['cancel']                              =       $this->cancellationpolicy_model->getcancellationpolicy(9);
            $data['main_client_view']                   =       'cancellationpolicy/cancellation-policy';
            $data['page_title'] = 'Cancellation Policy';
			$this->load->model('login/Site_setting_model');
			$data['settings'] = $this->Site_setting_model->get_site_info(1);
			$data['header_menus'] = $this->Site_setting_model->get_header_menu();
			$data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
			$data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();
            $this->load->view('index', $data);
	}
}
