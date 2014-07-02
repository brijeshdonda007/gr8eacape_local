<?php

class Forgotpassword extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('forgotpassword_model');
                //$this->load->model('Site_setting_model');
                $this->form_validation->set_error_delimiters('<label class="error">', '</label>');
	}
	function index(){
		$data['main_client_view'] = "forgotpassword/email_form";
		$data['page_title'] = 'Forgot password';
		$this->load->model('login/Site_setting_model');
		$data['header_menus'] = $this->Site_setting_model->get_header_menu();
		$data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
		$data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();
		$this->load->view('index', $data);
	}
    function get_password()
    {
		$this->form_validation->set_rules('email', 'Email', 'required|email|callback_check_email_forget'); 
		if($this->form_validation->run()==FALSE)
		{
			$data['main_client_view'] = "forgotpassword/email_form";
			$this->load->view('index', $data);
		}
		else
		{
			$this->load->model('login/Site_setting_model');
			$site_info=$this->Site_setting_model->get_site_info(1);
			$data['header_menus'] = $this->Site_setting_model->get_header_menu();
			$data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
			$data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();
			$this->load->model('email/email_model');
			$this->email_model->forget_password_reminder_email($site_info->contact_email);
			$data = array('msg'=>'Thanks a password reset link has been emailed to you!');
			$this->session->set_userdata($data);
			redirect('/forgotpassword/');
		}
	}
	function check_email_forget()
	{
		if($this->forgotpassword_model->check_email_forget($this->input->post('email'))==FALSE)
		{
			$this->form_validation->set_message('check_email_forget', 'Sorry your email does not exist!');
			return false;
		}
		else 
		{
			return true;
		}					
	}
	function change_process($email)
	{
		$em=ydecode(udecode($email),$this->config->item('encoder'));
		$data['email']=$email;
		if($this->forgotpassword_model->check_email_forget($em)==1)
		{
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[16]');
			$this->form_validation->set_rules('confirmation', 'Confirm Password', 'required|matches[password]');
			if($this->form_validation->run()==FALSE)
			{
				$data['page_title'] = "Password Reset";
				$data['main_client_view'] = "forgotpassword/change_password";
				$this->load->view('index', $data);
			}
			else
			{
				$this->forgotpassword_model->update_password($em);
				$data = array('msg'=>'Thanks your password has been updated successfully.');
				$this->session->set_userdata($data);
				redirect('/forgotpassword/change_process/'.$email);
			}
		}
		else
		{
			redirect(site_url());
		}
	}
}
