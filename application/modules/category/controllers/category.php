<?php

class Category extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('category_model');
		$this->load->database();
	}
	function index(){
        $data['user_profile_info'] = $this->category_model->getUserInfo($this->session->userdata('user_id'));
        $data['ratings_cat'] = $this->category_model->getAllRateCategory();
        $config = array();
        $config["base_url"] = base_url() . "search/category/";
        $config["total_rows"] = $this->category_model->get_count_property_by_category($this->uri->segment(3));
        $config["per_page"] = 8;
        $config["uri_segment"] = 4;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['property_lists']		=	$this->category_model->getPropertyByCategory($this->uri->segment(3), $config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['category'] = $this->category_model->get_category_byID($this->uri->segment(3));
        $data['total_rows'] = $config["total_rows"];
        $data['page_title'] = 'Category';
		$this->load->model('login/Site_setting_model');
		$data['settings'] = $this->Site_setting_model->get_site_info(1);
		$data['header_menus'] = $this->Site_setting_model->get_header_menu();
		$data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
		$data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();
        $data['main_client_view'] = "category/listing_property";
        $this->load->view('category', $data);
	}
    function lists()
    {
        
        $data['user_profile_info'] = $this->category_model->getUserInfo($this->session->userdata('user_id'));
        $data['all_category'] = $this->category_model->get_all_category();
        $data['main_client_view'] = "category/category_list";
        $data['page_title'] = 'Category List';
		$this->load->model('login/Site_setting_model');
		$data['settings'] = $this->Site_setting_model->get_site_info(1);
		$data['header_menus'] = $this->Site_setting_model->get_header_menu();
		$data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
		$data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();
        $this->load->view('category', $data);
    }
}
