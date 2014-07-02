<?php

class Dashboard extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('dashboard_model');
		$this->load->database();
	}
	function index(){
        $data['latest_booking'] = $this->dashboard_model->latest_booking();
        $data['latest_users'] = $this->dashboard_model->latest_users();
		$data['main_content_view']		=		'dashboard_content';
		$this->load->view('default', $data);
	}
}
