<?php

class Country extends CI_Controller
{
    public function __construct()
    {
		parent::__construct();
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('region_model');
		$this->load->database();
	}

        public function index()
        {
            $data['user_profile_info']          = $this->region_model->getUserInfo($this->session->userdata('user_id'));
            $data['country_rs']                 = $this->region_model->getDetailsByCountryName($this->uri->segment(2));
            $config                             = array();
            $config["base_url"]                 = base_url() . "country/" . $data['country_rs']->country_name. "/";
            $config["total_rows"]               = $this->region_model->get_all_region_by_countryID($this->uri->segment(3));
            $config["per_page"]                 = 20;
            $config["uri_segment"]              = 3;

            $this->pagination->initialize($config);
            $page                               = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data['region_list']                =    $this->region_model->get_region_with_limit($this->uri->segment(3), $config["per_page"], $page);
            $data["links"]                      = $this->pagination->create_links();
            $data['region_lists']               = $config["total_rows"];
            $data['page_title']                 = 'Region list';
            $data['main_client_view']           = 'country/index';
			$this->load->model('login/Site_setting_model');
			$data['settings']                   = $this->Site_setting_model->get_site_info(1);
			$data['header_menus']               = $this->Site_setting_model->get_header_menu();
			$data['footer_menus']               = $this->Site_setting_model->get_footer_menu();
			$data['footer_bottom_menus']        = $this->Site_setting_model->get_footer_bottom_menu();

            $this->load->view('region_city', $data);
        }

        function terms(){
            $data['user_profile_info'] = $this->home_model->getUserInfo($this->session->userdata('user_id'));
            $data['terms'] = $this->home_model->getTerms(2);
            $data['main_client_view'] = 'home/terms';
            $this->load->view('index', $data);
        }
        function cancellationpolicy(){
            $data['user_profile_info'] = $this->home_model->getUserInfo($this->session->userdata('user_id'));
            $data['cancel'] = $this->home_model->getcancellationpolicy(9);
            $data['main_client_view'] = 'home/cancellation-policy';
            $this->load->view('index', $data);
        }
        function company(){
            $data['user_profile_info'] = $this->home_model->getUserInfo($this->session->userdata('user_id'));
            $data['company'] = $this->home_model->getcompany(10);
            $data['main_client_view'] = 'home/company';
            $this->load->view('index', $data);
        }
        function destination(){
            $data['user_profile_info'] = $this->home_model->getUserInfo($this->session->userdata('user_id'));
            $data['destination'] = $this->home_model->getdestination(11);
            $data['main_client_view'] = 'home/destinations';
            $this->load->view('index', $data);
        }
         function helpsupport(){
            $data['user_profile_info'] = $this->home_model->getUserInfo($this->session->userdata('user_id'));
            $data['helpsupport'] = $this->home_model->gethelpsupport(12);
            $data['main_client_view'] = 'home/help-support';
            $this->load->view('index', $data);
        }
         function howitworks(){
            $data['user_profile_info'] = $this->home_model->getUserInfo($this->session->userdata('user_id'));
            $data['howitworks'] = $this->home_model->gethowitworks(13);
            $data['main_client_view'] = 'home/how-it-works';
            $this->load->view('index', $data);
        }
	    function faq(){
            $data['user_profile_info'] = $this->home_model->getUserInfo($this->session->userdata('user_id'));
            $data['howitworks'] = $this->home_model->gethowitworks(17);
            $data['main_client_view'] = 'home/how-it-works';
            $this->load->view('index', $data);
        }
        function contactSupport(){
            $data['user_profile_info'] = $this->home_model->getUserInfo($this->session->userdata('user_id'));
            $data['howitworks'] = $this->home_model->gethowitworks(18);
            $data['main_client_view'] = 'home/how-it-works';
            $this->load->view('index', $data);
        }
         function knowlegdebase(){
            $data['user_profile_info'] = $this->home_model->getUserInfo($this->session->userdata('user_id'));
            $data['howitworks'] = $this->home_model->gethowitworks(19);
            $data['main_client_view'] = 'home/how-it-works';
            $this->load->view('index', $data);
        }
}