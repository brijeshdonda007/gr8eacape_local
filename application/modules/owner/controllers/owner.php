<?php
class Owner extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('owner_model');
	}
        function detail()
        {
            if($this->session->userdata('Fb_user'))
             {
                   $data['fb_arr'] = $this->session->userdata('Fb_user');
             }
            $owner_id = $this->uri->segment(3);
            $data['user_profile_info']                      =               $this->owner_model->getUserInfo($this->session->userdata('user_id'));
            $data['owner_detail'] = $this->owner_model->ownerDetail($this->uri->segment(3));
            $data['owner_city'] = $this->owner_model->getCityByID($data['owner_detail']->city_id);
            $data['owner_country'] = $this->owner_model->getCountryByID($data['owner_detail']->country_id);
            $data['total_reviews'] = $this->owner_model->geAllReviews($this->uri->segment(3));
            $data['user_ratings'] = $this->user_ratings();
            if($this->session->userdata('user_id'))
            {
            $data['has_review'] = $this->owner_model->getReviewByUser($this->uri->segment(3));
            $data['has_rated_allcats'] = $this->owner_model->hasRatedAllCats($this->uri->segment(3));
            }
            if($this->session->userdata('user_id'))
            {
            $data['has_booked_by_user'] = $this->owner_model->has_booked_by_user($this->uri->segment(3));
            }
            $data['total_property']  =    $this->owner_model->get_count_property($owner_id);
            $data['escape_listings'] =    $this->owner_model->getOwnerEscapes($owner_id);
            $config = array();
            $config["base_url"] = base_url() . "owner/detail/".$this->uri->segment(3)."/";
            $config["total_rows"] = $data['total_property'];
            $config["per_page"] = 6;
            $config["uri_segment"] = 4;
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
           // $data['property_lists']                         =    $this->owner_model->getProperty_owner($config["per_page"], $page);  
            $data["links"] = $this->pagination->create_links();
            $data['ratings_cat'] = $this->owner_model->getAllRateCategory_prop();
            $data['page_title'] = 'My Profile';
            $data['main_client_view']			=		"owner/owner_detail";
			$this->load->model('login/Site_setting_model');
			$data['settings'] = $this->Site_setting_model->get_site_info(1);
			$data['header_menus'] = $this->Site_setting_model->get_header_menu();
			$data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
			$data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();

            $this->load->view('owner', $data);
        }
        function reviews()
        {
            $id = $this->owner_model->addReview();
            if($id)
            {
            $data = array('msg'=>'Your review has been placed successfully!');
            $this->session->set_userdata($data);
            redirect('owner/detail/'.$this->input->post('user_id'), $data);
            }
        }
        
        function user_ratings()
    {
        $all_property  = $this->owner_model->all_property_by_ownerID($this->uri->segment(3));
        $tot_ratings = 0;
        $total_rated_prop = 0;
        foreach($all_property as $alp)
        {
            $total_rated_prop += $this->owner_model->is_rated_propCheck($alp->id);
            $is_rated = $this->owner_model->is_rated_prop($alp->id);
            if($is_rated > 0)
            {
            $tot_ratings += $this->owner_model->get_rate_by_propID($alp->id);
            }
        }
        if($total_rated_prop > 0)
        {
        $rating = ($tot_ratings/$total_rated_prop)*(5/100);
        return $rating;
        }
    }
}