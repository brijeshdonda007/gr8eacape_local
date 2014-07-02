<?php

class Listing extends CI_Controller{

	public function __construct(){

		parent::__construct();

		$this->load->library('pagination');

		$this->load->library('session');

		$this->load->helper('url');

		$this->load->model('listing_model');

		$this->load->database();

                $this->load->helper('text');

	}

	

	function index(){

        $data['main_client_view']			=		"listing/listing_property";

        $data['user_profile_info']                      =               $this->listing_model->getUserInfo($this->session->userdata('user_id'));

        $data['banners']				=		$this->listing_model->loadBanners();

        $data['settings']                               =               $this->listing_model->getSettings();

        $data['suburb_rs'] = $this->listing_model->get_suburb_rs($this->uri->segment(3));

        $data['ratings_cat'] = $this->listing_model->getAllRateCategory();

        

        $config = array();

        $config["base_url"] = base_url() . "listing/index/".$this->uri->segment(3).'/';

        $config["total_rows"] = $this->listing_model->getCountPropertyAll($this->uri->segment(3));

        $config["per_page"] = 4;

        $config["uri_segment"] = 4;

        $this->pagination->initialize($config);



        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $data['property_lists']                         =    $this->listing_model->getAllProperty($this->uri->segment(3), $config["per_page"], $page);

        $data["links"] = $this->pagination->create_links();

		$data['page_title'] = 'Listing Escapes';
        //echo $data["links"];exit();
		$this->load->model('login/Site_setting_model');
		$data['header_menus'] = $this->Site_setting_model->get_header_menu();
		$data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
		$data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();

        $data['total_rows'] = $config["total_rows"];

        $this->load->view('listing', $data);

	}

         

}