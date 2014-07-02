<?php

class Buyer extends CI_Controller {
		function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('buyer_model');
	}		
	
	function detail(){
		if($this->session->userdata('Fb_user')){
			$data['fb_arr'] = $this->session->userdata('Fb_user'); 
		}            		
		$data['user_profile_info']  =  $this->buyer_model->getUserInfo($this->session->userdata('user_id'));
		$data['buyer_detail'] = $this->buyer_model->buyerDetail($this->uri->segment(3));
		$data['buyer_city'] = $this->buyer_model->getCityByID($data['buyer_detail']->city_id);
		$data['buyer_country'] = $this->buyer_model->getCountryByID($data['buyer_detail']->country_id);
		$data['rating_category'] = $this->buyer_model->get_user_ratings_category();	
		$data['ratings_cat'] = $this->buyer_model->getAllRateCategory(); 
		$data['all_rates'] = $this->buyer_model->getTotalRate();
		$data['total_count'] = count($data['all_rates']); 
		$data['total_reviews'] = $this->buyer_model->geAllReviews($this->uri->segment(3));
		if($this->session->userdata('user_id')){
			$data['has_review'] = $this->buyer_model->getReviewByUser($this->uri->segment(3));
			$data['has_rated_allcats'] = $this->buyer_model->hasRatedAllCats($this->uri->segment(3));
		}
		if($this->session->userdata('user_id')){
			$data['has_booked_by_user'] = $this->buyer_model->has_booked_by_user($this->uri->segment(3));
		}                        		
		$data['main_client_view']			=		"buyer/buyer_detail";
		$data['page_title'] = 'Buyer Detail';
		$this->load->model('login/Site_setting_model');
		$data['settings'] = $this->Site_setting_model->get_site_info(1);
		$data['header_menus'] = $this->Site_setting_model->get_header_menu();
		$data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
		$data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();
		$this->load->view('buyer', $data);
	}
	
	function reviews(){	
		$id = $this->buyer_model->addReview();
		if($id){            		
			$data = array('msg'=>'Your review has been placed successfully!');
			$this->session->set_userdata($data);     
			redirect('buyer/detail/'.$this->input->post('user_id'), $data);
		}        	
	}
}
?>