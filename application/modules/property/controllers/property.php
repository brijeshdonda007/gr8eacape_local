<?php
class Property extends CI_Controller {
	function __construct(){
	    parent::__construct();
	    $this->load->helper('url');
	    $this->load->library('session');
	    $this->load->model('property_model');
	    $this->load->database();
	    $this->load->library('pagination');
	    $this->load->library('user_agent');
	}
     function escapeList(){
		$data['all_category'] = $this->property_model->get_all_category();
		$config = array();
		$config["base_url"] = base_url() . "property/escapeList";
		$config["total_rows"] = $this->property_model->record_count_property();
		$config["per_page"] = 30;
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['mess'] = '';
		$data['all_property'] =	$this->property_model->listProperty($config["per_page"], $page);
		$data['property_count'] = $config["total_rows"];
		$data["links"] = $this->pagination->create_links();
		$data['main_content_view']= "property/property_list";			
		$this->load->view('default',$data);
	}
	function editProperty() { 
		$this->property_model->editCategory();
	}
	function addeditEscape(){ 
		$data['mess'] = '';
		$product_id = $this->property_model->addeditCategory();
		$data = array('msg'=>'Successfully Saved!');
		$this->session->set_userdata($data);
		redirect('property/categoryList',$data);	
	}
	function deleteProperty(){
		$this->property_model->deleteCategory();
	}
    function approveProperty()
    {
        $this->property_model->approveProperty($this->uri->segment(3));
        $data = array('msg'=>'Successfully Approved!');
        $this->session->set_userdata($data);
        redirect('property/escapeList',$data);	
    }
     function verifyProperty()
    {
        $this->property_model->verifyProperty($this->uri->segment(3));
        $data = array('msg'=>'Successfully Verified!');
        $this->session->set_userdata($data);
        redirect('property/escapeList',$data);	
    }
    function declineProperty()
    {
        $this->property_model->declineProperty($this->uri->segment(3));
        $data = array('msg'=>'Successfully Declined!');
        $this->session->set_userdata($data);
        redirect('property/escapeList',$data);	
    }
    function loadcategoryform()
    {
        $data['main_content_view']		=		"property/category_form";
        $this->load->view('default', $data);
    }
    function propertyDetail()
    {
       $data['detail'] = $this->property_model->get_property_detail($this->uri->segment(3));
       $data['main_content_view']		=		"property/property_detail";
       $this->load->view('default', $data); 
    }
}