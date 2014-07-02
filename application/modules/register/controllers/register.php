<?php 

/* -----------------------------------------------------------------------------------------

   IdiotMinds - http://idiotminds.com

   -----------------------------------------------------------------------------------------

*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');



//include the facebook.php from libraries directory

require_once APPPATH.'libraries/facebook/facebook.php';

class Register extends CI_Controller
{
	public function __construct()
    {
		parent::__construct();

		$this->load->model('register_model');
        $this->form_validation->set_error_delimiters('<label class="error">', '</label>');
        $this->load->library('image_lib');
        $this->load->model('location_model');
        $this->load->helper('html');
        $this->config->load('facebook');
	}

	function index()
    {
        $data['page_title'] = 'Signup';
		$this->load->model('login/Site_setting_model');
        $data['settings'] = $this->Site_setting_model->get_site_info(1);
        $data['users_country'] = $this->location_model->get_all_users_country();
        $data['service_country'] = $this->location_model->getServiceCountries();
        $data['site_title'] = $data['settings']->site_title;
        $data['meta_title'] = $data['settings']->meta_title;
        $data['meta_keyword'] = $data['settings']->meta_keyword;
        $data['meta_description'] = $data['settings']->meta_description;
		$data['header_menus'] = $this->Site_setting_model->get_header_menu();
		$data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
		$data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();
		$data['main_client_view']			=		"register/register";
		$this->load->view('index', $data);
	}

	function newMember()
	{
		if ($this->input->post('is_business')){
			$is_business = '1';
			$gst_num = $this->input->post('gst_number');
		}else{
			$is_business = '0';
			$gst_num = '';
		}
		if($this->input->post('user_type') == '1')
		{
			$this->form_validation->set_rules('username', "User Name",'required|callback_user_name_check');
			$this->form_validation->set_rules('email', "Email",'required|callback_check_email_check');
			$this->form_validation->set_rules('password', "Password",'callback_password_check');
			$this->form_validation->set_rules('first_name',"First Name",'xss_clean|required');
			$this->form_validation->set_rules('last_name',"Last Name",'xss_clean|required');
			$this->form_validation->set_rules('phone',"Phone",'xss_clean');
			$this->form_validation->set_rules('mobile',"Mobile",'xss_clean');
		}else{
			$this->form_validation->set_rules('username', "User Name",'required|callback_user_name_check');
			$this->form_validation->set_rules('email', "Email",'required|callback_check_email_check');
			$this->form_validation->set_rules('password', "Password",'callback_password_check');
			$this->form_validation->set_rules('first_name',"First Name",'xss_clean|required');
			$this->form_validation->set_rules('last_name',"Last Name",'xss_clean|required');
			$this->form_validation->set_rules('phone',"Phone",'xss_clean');
			$this->form_validation->set_rules('mobile',"Mobile",'xss_clean');
		}
		if($this->form_validation->run()==FALSE)
		{
            $data['user_type'] = $this->input->post('user_type');
            $data['dayp'] = $this->input->post('day');
            $data['gender'] = $this->input->post('gender');
            $data['monthp'] = $this->input->post('month');
            $data['yearp'] = $this->input->post('year');
            $data['country_id'] = $this->input->post('country_id');
            $data['page_title'] = 'Signup';
			$this->load->model('login/Site_setting_model');
            $data['settings'] = $this->Site_setting_model->get_site_info(1);
            $data['country'] = $this->location_model->getAllCountries();
            $data['service_country'] = $this->location_model->getServiceCountries();
            $data['users_country'] = $this->location_model->get_all_users_country();
            $data['site_title'] = $data['settings']->site_title;
            $data['meta_title'] = $data['settings']->meta_title;
            $data['meta_keyword'] = $data['settings']->meta_keyword;
            $data['meta_description'] = $data['settings']->meta_description;
			$data['main_client_view'] = "register/register";
            $this->load->view('index', $data);
		}else{
			$activation_code = $this->register_model->newMember($is_business);
			if($activation_code){
                $this->load->model('login/Site_setting_model');
                $site_info = $this->Site_setting_model->get_site_info(1);
                $from_mail = $site_info->contact_email;
				$this->load->model('email/email_model');
                $this->email_model->register_confirmation_email($activation_code, $from_mail);
                $data['page_title'] = 'Account activated';
                redirect('register/accountcreated');
			}
		}
	}
	function user_name_check()
	{
		if($this->register_model->get_aleady_registered_username()==TRUE)
		{
			$this->form_validation->set_message('user_name_check', 'Great it looks like this username is already registered with us. Please sign in!');
			return false;
		}
		return true;
	}
	function check_email_check()
	{
		if($this->register_model->get_aleady_registered_email()==TRUE)
		{
			$this->form_validation->set_message('check_email_check', 'Great it looks like this email is already registered with us. Please sign in!');
			return false;
		}
		return true;
	}
	function password_check()
	{
		if($this->input->post('password')==$this->input->post('username'))
		{
			$this->form_validation->set_message('password_check', 'Sorry your username & password cannot be the same.');
			return false;
		}
		return true;
	}
	function activation_process($activation_code)
	{
		$this->load->model('login/Site_setting_model');
		$site_info = $this->Site_setting_model->get_site_info(1);
		$from_email = $site_info->contact_email;

		$this->load->model('email/email_model');
		$act_code = ydecode(udecode($activation_code),$this->config->item('encoder'));
		$this->email_model->registered_email($act_code, $from_email);

		if($this->register_model->activated($activation_code, $from_email)==true)
		{
			redirect('register/success/');
		}
		else
		{
			redirect('register/failed/');
		}
	}
	function accountcreated()
	{
		$data = array('msg'=>'Your account has been activated!');
		$data['main_client_view'] = "register/accountcreated";
		$data['page_title'] = 'New Account';
		$this->load->view('index', $data);
	}
	function success()
	{
		$data['main_client_view'] = "register/success";
		$data['page_title'] = 'Registration success';
		$this->load->view('index', $data);
	}
	function failed()
	{
		$data = array('msg'=>'Activation Failed!');
		$this->session->set_userdata($data);
		$data['main_client_view']			=		"register/failed_view";
		$this->load->view('index', $data);
	}
	public function facebook() {
		$this->load->library('fb');
		if (!$this->fb->is_connected()){
			redirect ( $this->fb->login_url( current_url() ));
		}
		$fb_user = $this->fb->client->api('/me');
		if (empty($fb_user)){
			$error = "FACEBOOK LOGIN FAILED - USER US EMPTY. FILE: " . __FILE__ . " LINE: " . __LINE__;
			$this->session->set_flashdata('register_error', $error);
		}else{
			$this->user->set_facebook_id($fb_user['id']);
			$user = $this->user->get_by_facebook();
			if (!empty($user) && !empty($user->id) && is_numeric($user->id)){
				//TODO: Make things a bit more secure here
				//Login & Redirect home
				$this->_login($user->id, 'facebook');
				$this->load->view('register/redirect_home');
				return;
			}
		}
		//Go to the registeration page
		$this->load->view('register/redirect', array('method' => 'facebook'));
	}
}
