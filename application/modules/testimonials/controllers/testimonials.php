<?php

class Testimonials extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('testimonials_model');
		$this->load->database();
        $this->load->helper('text');
	}
	function index()
    {
    }
    function view_all(){
        $data['user_profile_info'] = $this->testimonials_model->getUserInfo($this->session->userdata('user_id'));
        $config = array();
        $config["base_url"] = base_url() . "testimonials/index";
        $config["total_rows"] = $this->testimonials_model->record_count_testi();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['testimonials'] =	$this->testimonials_model->get_all_testi($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['main_content_view'] = 'testimonials/list';
        $this->load->view('default', $data);
    }
    function newTesti() {
        $data['form_title'] = "Add New";
		$data['main_content_view'] = "testimonials/testi_form";
		$this->load->view('default',$data);
	}
    function editTesti()
    {
        $data['form_title'] = "Edit";
        $data['sigle_testi'] = $this->testimonials_model->edit_testi($this->uri->segment(3));
		$data['main_content_view'] = "testimonials/testi_form";
		$this->load->view('default',$data);
    }
    function addeditTesti() {
        $data['mess'] = '';		
		$testi_id = $this->testimonials_model->add_edit_testimonials();
        if($testi_id)
        {
            if(($_FILES['image']['error'] != '4') and !empty($_FILES['image']['name']))
            {
                $feature_img = $this->feature_image_upload($testi_id);
            }
            else{
                 $feature_img = $this->input->post('old_image');
            }
            $this->testimonials_model->update_feature_img($testi_id, $feature_img);
        }
		$data = array('msg'=>'Successfully added!');
		$this->session->set_userdata($data);
		redirect('testimonials/view_all',$data);	
    }
    function feature_image_upload($inserted_id){
        $testi_feat_img = $this->testimonials_model->edit_testi($inserted_id);
        if(@$testi_feat_img->image != '')
        {
			unlink('./images/testimonials/'.$testi_feat_img->image);
        }
        $config['overwrite'] = 'TRUE'; 
		$config['upload_path'] = './images/testimonials/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '200000';
        $config['max_width'] = '3000';
        $config['max_height'] = '40000';
        $this->load->library('upload', $config);
        $this->load->library('image_lib');
        if ( ! $this->upload->do_upload('image'))
        {
            $error = array('error' => $this->upload->display_errors());
            $data['errors'] = $error;
            $this->session->set_userdata($data);
            redirect('testimonials/newTesti');
        }
        else
        {
	        $data1 = array('upload_data' => $this->upload->data());
	        $image= $data1['upload_data']['file_name'];
	        $configBig = array();
	        $configBig['image_library'] = 'gd2';
	        $configBig['source_image'] = './images/testimonials/'.$image;
	        $configBig['create_thumb'] = TRUE;
	        $configBig['maintain_ratio'] = TRUE;
	        $configBig['width'] = 95;
	        $configBig['height'] = '1';
	        $configBig['master_dim'] = 'width';
	        $configBig['thumb_marker'] = "_thumb";
	        $configBig['new_image'] = './images/testimonials';
	        $this->image_lib->initialize($configBig);
	        $this->image_lib->resize();
	        $this->image_lib->clear();
	        unset($configBig);
	        $filename2 = $data1['upload_data']['raw_name'].'_thumb'.$data1['upload_data']['file_ext'];
	        $filename3 = $data1['upload_data']['raw_name'].$data1['upload_data']['file_ext'];
	        $rename = time().$inserted_id.$data1['upload_data']['file_ext'];
	        rename('./images/testimonials/' .$filename2, './images/testimonials/' .$rename);
	        unlink('./images/testimonials/' .$filename3);
	        return $rename;
    	}
    }
    function deleteTesti()
    {
        $testi_feat_img = $this->testimonials_model->edit_testi($this->uri->segment(3));
        if($testi_feat_img->image != '')
        {
            unlink('./images/testimonials/'.$testi_feat_img->image);
        }
        $this->testimonials_model->delete_testi();
        $data = array('msg'=>'Successfully Deleted!');
        $this->session->set_userdata($data);
        redirect('testimonials/view_all',$data);
    }
}
