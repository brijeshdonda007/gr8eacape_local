<?php
class Region extends CI_Controller
{
	public function __construct()
    {
		parent::__construct();
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('city_model');
		$this->load->database();
	}

    public function index()
    {
        $data['user_profile_info']      = $this->city_model->getUserInfo($this->session->userdata('user_id'));
        $data['region_name']            = $this->city_model->getRegionByName($this->uri->segment(2));
        $data['city_lists']             = $this->city_model->get_city_by_regionID($data['region_name']->id);
        $data['main_client_view']       = 'region/index';
        $data['page_title']             = 'City list';

		$this->load->model('login/Site_setting_model');
		$data['settings']               = $this->Site_setting_model->get_site_info(1);
		$data['header_menus']           = $this->Site_setting_model->get_header_menu();
		$data['footer_menus']           = $this->Site_setting_model->get_footer_menu();

		$data['footer_bottom_menus']    = $this->Site_setting_model->get_footer_bottom_menu();

        $this->load->view('region_city', $data);
    }
}
