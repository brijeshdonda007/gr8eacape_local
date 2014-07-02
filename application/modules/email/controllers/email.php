<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	require_once APPPATH.'libraries/facebook/facebook.php';
class Email extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('email_model');
		$this->load->library('image_lib');
		$this->load->model('Site_setting_model');
		$this->load->model('register_model');
		$this->config->load('facebook');
	}
	public function reg_confirmation_email($activation_code){
		$this->load->model('email_model');
		$this->email_model->reg_confirmation_email($activation_code);
	}
}