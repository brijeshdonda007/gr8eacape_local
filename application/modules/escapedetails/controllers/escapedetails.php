<?php

class Escapedetails extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('escapedetails_model');
		$this->load->database();
	}

	public function index()
    {
        $this->load->model('login/Site_setting_model');

		$str = $this->uri->segment(2);
		preg_match_all('!\d+!', $str, $matches);
		$prop_id                     = intval($matches[0][0]);
        $data['property_detail']     = $this->escapedetails_model->getPropertyDetailByID($prop_id);
        $data['user_profile_info']   = $this->escapedetails_model->getUserInfo($this->session->userdata('user_id'));

        //Non verified won't available for display
        if(($data['property_detail']->admin_action != 'approved') AND ($data['property_detail']->owner_id != $this->session->userdata('user_id'))) {
            show_404();
        }

		$data['settings']            = $this->Site_setting_model->get_site_info(1);
		$data['header_menus']        = $this->Site_setting_model->get_header_menu();
		$data['footer_menus']        = $this->Site_setting_model->get_footer_menu();
		$data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();

	    $data['property_amenities']  = $this->escapedetails_model->getPropertyAmenitiesByID($prop_id);
	    $data['amenities']           = $this->escapedetails_model->getAmenities();
	    $data['property_amenities']  = $this->escapedetails_model->getPropertyAmenitiesByID($prop_id);
        $this->escapedetails_model->updateVisitCount($prop_id, $data['property_detail']->visited_count);
		
		$data['escapeChannelsArr'] = $this->escapedetails_model->getAllEscapeChannels($prop_id);

        $data['property_gallery']    = $this->escapedetails_model->getGalleryByPropID($prop_id);
		$data['property_video']      = $this->escapedetails_model->getVideoByPropID($prop_id);
        $data['property_extra']      = $this->escapedetails_model->getPropertyExtraByID($prop_id);
        $data['property_country']    = $this->escapedetails_model->getCountryByID($data['property_detail']->country_id);
        $data['property_region']     = $this->escapedetails_model->getRegionByID($data['property_detail']->region_id);
        $data['property_city']       = $this->escapedetails_model->getCityByID($data['property_detail']->city_id);
        $data['property_suburb']     = $this->escapedetails_model->get_suburb_by_ID($data['property_detail']->suburb_id);
        $data['property_owner']      = $this->escapedetails_model->getOwnerInfoByID($data['property_detail']->owner_id);
        $data['owners_other']        = $this->escapedetails_model->getOtherOwnerList($data['property_detail']->owner_id, $prop_id);
        $data['calendar']            = $this->display($year = null, $month = null);
        $data['ratings_cat']         = $this->escapedetails_model->getAllRateCategory();
        $data['all_rates']           = $this->escapedetails_model->getTotalRate();
        $data['total_count']         = count($data['all_rates']);
        $data['total_reviews']       = $this->escapedetails_model->geAllReviews($prop_id);

        if($this->session->userdata('user_id')) {
            $data['has_review']        = $this->escapedetails_model->getReviewByUser($prop_id);
            $data['has_rated_allcats'] = $this->escapedetails_model->hasRatedAllCats($prop_id);
        }

        if($this->session->userdata('user_id')) {
            $data['has_booked_by_user'] = $this->escapedetails_model->has_booked_by_user($prop_id);
        }

        $data['type_escape']        = $this->escapedetails_model->type_escape($data['property_detail']->type_escape_id);
        $data['page_title']         = $data['property_detail']->title;
        $data['main_client_view']   = "escapedetails/details_mid";

        $this->load->view('property_details', $data);
	}

    public function privacypolicy()
    {
        $data['user_profile_info'] = $this->home_model->getUserInfo($this->session->userdata('user_id'));
        $data['privacy_policy']    = $this->home_model->getPrivacyPolicy(5);
        $data['main_client_view']  = 'home/privacy-policy';
        $this->load->view('index', $data);
    }

    public function terms()
    {
        $data['user_profile_info'] = $this->home_model->getUserInfo($this->session->userdata('user_id'));
        $data['terms']             = $this->home_model->getTerms(2);
        $data['main_client_view']  = 'home/terms';

        $this->load->view('index', $data);
    }

    public function cancellationpolicy()
    {
        $data['user_profile_info'] = $this->home_model->getUserInfo($this->session->userdata('user_id'));
        $data['cancel']            = $this->home_model->getcancellationpolicy(9);
        $data['main_client_view']  = 'home/cancellation-policy';

        $this->load->view('index', $data);
    }

    public function company()
    {
        $data['user_profile_info'] = $this->home_model->getUserInfo($this->session->userdata('user_id'));
        $data['company']           = $this->home_model->getcompany(10);
        $data['main_client_view']  = 'home/company';

        $this->load->view('index', $data);
    }

    public function destination()
    {
        $data['user_profile_info'] = $this->home_model->getUserInfo($this->session->userdata('user_id'));
        $data['destination']       = $this->home_model->getdestination(11);
        $data['main_client_view']  = 'home/destinations';

        $this->load->view('index', $data);
    }

    public function helpsupport()
     {
        $data['user_profile_info'] = $this->home_model->getUserInfo($this->session->userdata('user_id'));
        $data['helpsupport']       = $this->home_model->gethelpsupport(12);
        $data['main_client_view']  = 'home/help-support';

        $this->load->view('index', $data);
    }
     public function howitworks()
     {
        $data['user_profile_info'] = $this->home_model->getUserInfo($this->session->userdata('user_id'));
        $data['howitworks']        = $this->home_model->gethowitworks(13);
        $data['main_client_view']  = 'home/how-it-works';

        $this->load->view('index', $data);
    }

    public function display($year = null, $month = null)
    {
		if (!$year) {
			$year = date('Y');
		}
		if (!$month) {
			$month = date('m');
		}
		$this->load->model('Mycal_model');
		if ($day = $this->input->post('day')) {
			$this->Mycal_model->add_calendar_data(
				"$year-$month-$day",
				$this->input->post('data')
			);
		}
		return $this->Mycal_model->generate($year, $month);
	}

    public function rateReviews()
    {
        $this->escapedetails_model->addReview();
        redirect('escapedetails/'.$this->input->post('property_id'));
    }

    public function contact()
    {
        $this->load->view('escapedetails/contact');
    }
}