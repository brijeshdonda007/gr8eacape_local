<?php 

class Search extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('search_model');
		$this->load->helper('form');
	}
	function index(){
		$data['user_profile_info'] = $this->search_model->getUserInfo($this->session->userdata('user_id'));
		$data['banners'] = $this->search_model->loadBanners();
		if(($_POST) or ($this->uri->segment(4)))
		{
			if($_POST)
			{
				if($this->session->userdata('searchq'))
				{
					$this->session->unset_userdata('searchq');
				}
				if(!array_key_exists('searchq', $_POST))
				{
					$keywords = '';  
				}
				else
				{
					$keywords = trim($this->input->post('searchq'));
				}
			}
			else {
				$keywords = $this->session->userdata('searchq');
			}
			$array_param = array('searchq' => $keywords);
			$this->session->set_userdata($array_param);
			$data['keywords'] = $array_param['searchq'];
			$str_search =    'keywords='.$array_param['searchq'];
			$url=urlencode(base64_encode($str_search));
			$config = array();
			$config["base_url"] = base_url() . "search/index/" . $url;
			$config["total_rows"] = $this->search_model->getAllSearchedCount();
			$config["per_page"] = 8;
			$config["uri_segment"] = 4;
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$data['search_results']		=	$this->search_model->getSearchResults($config["per_page"], $page);
			$data["links"] = $this->pagination->create_links();
			$data['total_num_search'] = $config["total_rows"];
		}
		$data['search_mid_view'] = 'search/search_results';
		$data['country'] = $this->search_model->getAllCountries();
		$data['just_listed_property'] = $this->search_model->getAllJustListed();
		$data['ratings_cat'] = $this->search_model->getAllRateCategory();
		$data['all_category'] = $this->search_model->get_all_category();
		$data['great_promise_block'] = 'search/great_promise';
		$data['just_listed'] = 'search/just_listed';
		$data['categories'] = 'search/category';
		$data['page_title'] = 'Search';
		$data['refine_search'] = 'search/refine_search';
		$this->load->model('login/Site_setting_model');
		$data['settings'] = $this->Site_setting_model->get_site_info(1);
		$data['header_menus'] = $this->Site_setting_model->get_header_menu();
		$data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
		$data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();
		$this->load->view('search', $data);
	}
	function refinesearch(){
		$data['user_profile_info'] =$this->search_model->getUserInfo($this->session->userdata('user_id'));
		$data['banners'] = $this->search_model->loadBanners();
		if($_POST)
		{
			/*if($this->session->userdata('keywords'))
			{
				$this->session->unset_userdata('keywords');
			}
			if($this->session->userdata('country_id'))
			{
				$this->session->unset_userdata('country_id');
			}
			if($this->session->userdata('region_id'))
			{
				$this->session->unset_userdata('region_id');
			}
			if($this->session->userdata('city_id'))
			{
				$this->session->unset_userdata('city_id');
			}
			if($this->session->userdata('suburb_id'))
			{
				$this->session->unset_userdata('suburb_id');
			}
			if($this->session->userdata('category_id'))
			{
				$this->session->unset_userdata('category_id');
			}
			if($this->session->userdata('start_date'))
			{
				$this->session->unset_userdata('start_date');
			}
			if($this->session->userdata('end_date'))
			{
				$this->session->unset_userdata('end_date');
			}
			if($this->session->userdata('adult'))
			{
				$this->session->unset_userdata('adult');
			}
			if($this->session->userdata('children'))
			{
				$this->session->unset_userdata('children');
			}
			if($this->session->userdata('bedroom'))
			{
				$this->session->unset_userdata('bedroom');
			}
			if($this->session->userdata('bathroom'))
			{
				$this->session->unset_userdata('bathroom');
			}
			if($this->session->userdata('pet'))
			{
				$this->session->unset_userdata('pet');
			}*/
			if(!array_key_exists('keywords', $_POST))
			{
				$keywords = '';  
			}
			else
			{
				$keywords = trim($this->input->post('keywords'));
			}
			$country_id = $this->input->post('country_id');
			if(!array_key_exists('region_id', $_POST))
			{
				$region_id  = 0;
			}
			else
			{
				$region_id = $this->input->post('region_id');
			}
			if(!array_key_exists('city_id', $_POST))
			{
				$city_id  = 0;
			}
			else
			{
				$city_id = $this->input->post('city_id'); 
			}
			if(!array_key_exists('suburb_id', $_POST))
			{
				$suburb_id  = 0;  
			}
			else
			{
				$suburb_id = $this->input->post('suburb_id'); 
			}
			if(!array_key_exists('category_id', $_POST))
			{
				$category_id  = "";  
			}
			else
			{
				$category_id = $this->input->post('category_id'); 
			}
			if(!array_key_exists('start_date', $_POST))
			{
				$start_date  = '';  
			}
			else
			{
				$start_date = $this->input->post('start_date'); 
			}
			if(!array_key_exists('end_date', $_POST))
			{
				$end_date  = '';  
			}
			else
			{
				$end_date = $this->input->post('end_date'); 
			}
			if(!array_key_exists('adult', $_POST))
			{
				$adult  = 0;  
			}
			else
			{
				$adult = $this->input->post('adult'); 
			}
			if(!array_key_exists('children', $_POST))
			{
				$children  = 0;  
			}
			else
			{
				$children = $this->input->post('children'); 
			}
			if(!array_key_exists('bedroom', $_POST))
			{
				$bedroom  = 0;  
			}
			else
			{
				$bedroom = $this->input->post('bedroom'); 
			}
			if(!array_key_exists('bathroom', $_POST))
			{
				$bathroom  = 0;  
			}
			else
			{
				$bathroom = $this->input->post('bathroom'); 
			}
			if(!array_key_exists('pet', $_POST))
			{
				$pet  = 0;  
			}
			else
			{
				$pet = $this->input->post('pet'); 
			}
		}
		else {
			$keywords = $this->session->userdata('keywords');
			$country_id = $this->session->userdata('country_id');
			$region_id = $this->session->userdata('region_id');
			$city_id = $this->session->userdata('city_id');
			$suburb_id = $this->session->userdata('suburb_id');
			$category_id = $this->session->userdata('category_id');
			$start_date = $this->session->userdata('start_date');
			$end_date = $this->session->userdata('end_date');
			$adult = $this->session->userdata('adult');
			$children = $this->session->userdata('children');
			$bedroom = $this->session->userdata('bedroom');
			$bathroom = $this->session->userdata('bathroom');
			$pet = $this->session->userdata('pet');
		}
		$array_param = array('keywords' => $keywords, 'country_id' => $country_id,
			'region_id' => $region_id, 'city_id' => $city_id, 'suburb_id' => $suburb_id,
			'category_id' => $category_id,
			'start_date' => $start_date, 'end_date' => $end_date,
			'adult' => $adult, 'children' => $children, 'bedroom' => $bedroom,
			'bathroom' => $bathroom, 'pet' => $pet);
		$this->session->set_userdata($array_param);
		$data['keywords'] = $array_param['keywords'];
		$data['country_id'] = $array_param['country_id'];
		$data['region_id'] = $array_param['region_id'];
		$data['city_id'] = $array_param['city_id'];
		$data['suburb_id'] = $array_param['suburb_id'];
		$data['category_id'] = $array_param['category_id'];
		$data['start_date'] = $array_param['start_date'];
		$data['end_date'] = $array_param['end_date'];
		$data['suburb_id'] = $array_param['suburb_id'];
		$data['adult'] = $array_param['adult'];
		$data['children'] = $array_param['children'];
		$data['bedroom'] = $array_param['bedroom'];
		$data['bathroom'] = $array_param['bathroom'];
		$data['pet'] = $array_param['pet'];
		$str_search =    'keywords='.$array_param['keywords'].'&country_id='.$array_param['country_id'].'&rregion_id='.$array_param['region_id'].'
		&city_id='.$array_param['city_id'].'&suburb_id='.$array_param['suburb_id'].'&category_id='.$array_param['category_id'].'&start_date='.$array_param['start_date'].'&end_date='.$array_param['end_date'].'&adult='.$array_param['adult'].'
		&children='.$array_param['children'].'&bedroom='.$array_param['bedroom'].'&bathroom='.$array_param['bathroom'].'&pet='.$array_param['pet'];
		$url=urlencode(base64_encode($str_search));
		$config = array();
		$config["base_url"] = base_url() . "search/refinesearch/" . $url;
		$config["total_rows"] = $this->search_model->getRefineSearchedCount();
		$config["per_page"] = 8;
		$config["uri_segment"] = 4;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['mess'] = '';
		$data['search_results']		=	$this->search_model->getRefineSearchResults($config["per_page"], $page);
		$data["links"] = $this->pagination->create_links();
		$data['total_num_search'] = $this->search_model->getRefineSearchedCount();
		if(($data['total_num_search']) > 0)
		{
			$tArray  = array();
			foreach ($data['search_results'] as $k => $v) {
			$tArray[$k] = $v->price_night;
			}
			$min_value = min($tArray);
			$max_value = max($tArray);
			$data['min_price'] = $min_value;
			$data['max_price'] = $max_value;
		}
		$data['search_mid_view']		= 		'search/refine_search_results';
		$data['country'] = $this->search_model->getAllCountries();
		if($data['country_id'])
		{
			$data['region'] = $this->search_model->getRegionByCountry($data['country_id']);    
			if($data['region_id'])
			{
				$data['cities'] = $this->search_model->getCityByRegion($data['region_id']);
				if($data['city_id'])
				{
					$data['suburb'] = $this->search_model->getSuburbByCity($data['city_id']);    
				}
			}
		}
		//$data['categories_all'] = $this->search_model->getAllCategories();
		$data['just_listed_property'] = $this->search_model->getAllJustListed();                
		$data['ratings_cat'] = $this->search_model->getAllRateCategory();
		$data['all_category'] = $this->search_model->get_all_category();
		$data['great_promise_block'] = 'search/great_promise';
		$data['just_listed'] = 'search/just_listed';
		$data['categories'] = 'search/category';
		$data['page_title'] = 'Search result';
		$data['refine_search'] = 'search/refine_search';
		$this->load->model('login/Site_setting_model');
		$data['settings'] = $this->Site_setting_model->get_site_info(1);
		$data['header_menus'] = $this->Site_setting_model->get_header_menu();
		$data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
		$data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();

		$this->load->view('search', $data);
	}
        function category($id)
        {
            $data['user_profile_info']                      =               $this->search_model->getUserInfo($this->session->userdata('user_id'));
            $data['banners']				=		$this->search_model->loadBanners();
            $config = array();
            $config["base_url"] = base_url() . "search/category/";
            $config["total_rows"] = $this->search_model->get_count_property_by_category($id);
            $config["per_page"] = 8;
            $config["uri_segment"] = 4;
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data['search_results']		=	$this->search_model->getPropertyByCategory($id, $config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();
            $data['just_listed_property'] = $this->search_model->getAllJustListed();
            $data['search_mid_view']		= 		'search/by_category';
			$this->load->model('login/Site_setting_model');
			$data['settings'] = $this->Site_setting_model->get_site_info(1);
            $this->load->view('search', $data);
        }
}
