<?php

class Home extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('home_model');
		$this->load->database();
        $this->load->helper('text');
	}
	function index(){
        $data['main_client_view']     = "home/home";
        $data['user_profile_info']    = $this->home_model->getUserInfo($this->session->userdata('user_id'));
        $data['banners']		      =	$this->home_model->loadBanners();
        $data['banners_first']	      =	$this->home_model->loadBanners_first();
        $data['settings']             = $this->home_model->getSettings();
        $data['just_listed_property'] = $this->home_model->getAllJustListed();
        $data['property_count']       = $this->home_model->get_all_propery();
        $homepage                     = $this->uri->segment(3);
        if($homepage)
        {
            $config = array();
            $config["base_url"]    = base_url() . "home/index";
            $config["total_rows"]  = $this->home_model->get_all_propery();
            $config["per_page"]    = 4;
            $config["uri_segment"] = $homepage;
            $this->pagination->initialize($config);
            $page                   = $homepage;
            $data['property_lists'] = $this->home_model->get_all_property_pagination($config["per_page"], $page);  
            $data["links"]          = $this->pagination->create_links();
        }else{
            $data['property_lists'] = $this->home_model->getAllProperty();  
        }
        $data['testimonials'] = $this->home_model->get_testimonials();
        $data['ratings_cat']  = $this->home_model->getAllRateCategory();
        $data['total_pages']  = count($data['property_lists']);
		$this->load->model('login/Site_setting_model');
		$data['header_menus'] = $this->Site_setting_model->get_header_menu();
		$data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
		$data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();
        $data['page_title']   = 'Home';
        $this->load->view('index', $data);
	}
	function faq(){
		$this->load->model('login/Site_setting_model');
		$data['settings'] = $this->Site_setting_model->get_site_info(1);
		$data['header_menus'] = $this->Site_setting_model->get_header_menu();
		$data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
		$data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();
        $data['user_profile_info']                      = $this->home_model->getUserInfo($this->session->userdata('user_id'));
        $data['howitworks']                            =   $this->home_model->gethowitworks(17);
        $data['faq_list'] = $this->home_model->list_faq();
        $data['main_client_view']                   =      'home/faq';
        $this->load->view('index', $data);
    }
    function faqsend()
    {
        $this->form_validation->set_rules('full_name', "Full Name",'trim|required|xss_clean');
        $this->form_validation->set_rules('email', "Email",'trim|required|xss_clean');
        $this->form_validation->set_rules('faq_question', "Question",'trim|required|xss_clean');
        if($this->form_validation->run()==TRUE)
	{
            $inserted_id   =   $this->home_model->save_faq();
            if($inserted_id)
            {
                $data = array('msg'=>'Thank you for asking a question, one of our friendly customer care team members will be in touch with you within the next 24 hours.');
                $this->session->set_userdata($data);
                redirect('home/faq'.'#faq-div',$data);	   
            }
            }
    }
    function contactSupport(){
		$this->load->model('login/Site_setting_model');
		$data['settings'] = $this->Site_setting_model->get_site_info(1);
		$data['header_menus'] = $this->Site_setting_model->get_header_menu();
		$data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
		$data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();
        $data['user_profile_info']                      = $this->home_model->getUserInfo($this->session->userdata('user_id'));
        $data['howitworks']                            =   $this->home_model->gethowitworks(18);
        $data['main_client_view']                   =      'home/how-it-works';
        $data['page_title'] = 'Contact Support';
        $this->load->view('index', $data);
    }
     function knowlegdebase(){
        $data['user_profile_info']                      = $this->home_model->getUserInfo($this->session->userdata('user_id'));
        $data['howitworks']                            =   $this->home_model->gethowitworks(19);
        $data['main_client_view']                   =      'home/how-it-works';
        $this->load->view('index', $data);
    }
    function contactsendemail()
    {
        $this->form_validation->set_rules('full_name', "Full Name",'trim|required|xss_clean');
        $this->form_validation->set_rules('email', "Email",'trim|required|xss_clean');
        $this->form_validation->set_rules('phone_number', "Phone Number",'trim|required|xss_clean');
        $this->form_validation->set_rules('message', "Message",'trim|required|xss_clean');
        if($this->form_validation->run()==TRUE)
        {
		$this->load->model('email/email_model');
        $response   =   $this->email_model->send_contact_enquiry();
            if($response == TRUE)
            {
                $data = array('msg'=>'Thank you, your enquiry has been successfully received.');
                $this->session->set_userdata($data);
                redirect('contactus',$data);
            }
        }
    }
    function contactsendemail_help()
    {
        $this->form_validation->set_rules('full_name', "Full Name",'trim|required|xss_clean');
        $this->form_validation->set_rules('email', "Email",'trim|required|xss_clean');
        $this->form_validation->set_rules('phone_number', "Phone Number",'trim|required|xss_clean');
        $this->form_validation->set_rules('message', "Message",'trim|required|xss_clean');
        if($this->form_validation->run()==TRUE)
        {
		$this->load->model('email/email_model');
        $response   =   $this->email_model->send_contact_help();
            if($response == TRUE)
            {
                $data = array('msg'=>'Thank you, your message has been successfully received.');
                $this->session->set_userdata($data);
                redirect('helpsupport',$data);   
            }
        }
    }
}
