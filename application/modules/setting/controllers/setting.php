<?php 

class Setting extends CI_Controller{

	function __construct(){

		parent::__construct();

		$this->load->library('session');

		$this->load->helper('url');

		$this->load->model('setting_model');

		$this->load->database();

	}

	

	function index(){

		$data['settings']				= 		$this->setting_model->getsetting();

		$data['main_content_view']		= 		'setting_page';

		$this->load->view('default', $data);

	}

	

	function addUpdateSetting(){

		$this->setting_model->addUpdateSetting();

		$data = array('msg'=>'Successfully Saved!');

		$this->session->set_userdata($data);

		redirect('setting/index',$data);	

	}

	

}
