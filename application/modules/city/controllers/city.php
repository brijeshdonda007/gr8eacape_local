<?php

class City extends CI_Controller
{
	public function __construct()
    {
		parent::__construct();
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->helper('url');
        $this->load->model('region/city_model');
		$this->load->model('suburb_model');
		$this->load->database();
	}

    public function index()
    {

        $data['user_profile_info']   = $this->suburb_model->getUserInfo($this->session->userdata('user_id'));
        $regionDetails               = $this->city_model->getRegionByName($this->uri->segment(2));
        $data['city_name']           = $this->suburb_model->getDetailsByRegionIdAndCityName($regionDetails->id, urldecode($this->uri->segment(4)));


        $data['suburb_lists']        = $this->suburb_model->get_suburb_by_cityID($data['city_name']->id);
        $data['main_client_view']    = 'city/index';
        $data['page_title']          = 'Suburb list';
		$this->load->model('login/Site_setting_model');
		$data['settings']            = $this->Site_setting_model->get_site_info(1);
		$data['header_menus']        = $this->Site_setting_model->get_header_menu();
		$data['footer_menus']        = $this->Site_setting_model->get_footer_menu();
		$data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();

        $this->load->view('region_city', $data);
    }
}
