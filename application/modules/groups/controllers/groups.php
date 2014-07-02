<?php
class Groups extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('image_lib');
		$this->load->helper('form');
		$this->load->model('groups_model');
		$this->load->database();
	}
	function lists(){
		$config = array();
		$config["base_url"] = base_url() . "groups/lists/";
		$config["total_rows"] = $this->groups_model->record_count_all_groups();
		$config["per_page"] = 30;
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['all_groups'] = $this->groups_model->all_groups($config["per_page"], $page);
		$data["links"] = $this->pagination->create_links();
		$data['total_count'] = $config["total_rows"];
		$data['main_content_view'] = 'groups/lists';
		$this->load->view('default', $data);
	}
	function addgroup(){
		$data['form_title'] = 'Add Group';
		$data['sections'] = $this->groups_model->get_All_sections();
		$data['properties'] = $this->groups_model->get_All_property();
		$data['main_content_view'] = 'groups/add';
		$this->load->view('default', $data);
	}
	function newgroup(){
		$group_id = $this->groups_model->addGroup();
		$data = array('msg' => 'Successfully added!');
		redirect('groups/lists', $data);
	}
	function editgroup(){
		$data['group'] = $this->groups_model->get_group($this->uri->segment(3));
		$data['group_detail'] = $this->groups_model->get_detail($this->uri->segment(3));
		$data['form_title'] = 'Edit Group';
		$data['sections'] = $this->groups_model->get_All_sections();
		$data['properties'] = $this->groups_model->get_All_property();
		$data['main_content_view'] = 'groups/edit';
		$this->load->view('default', $data);
	}
	function addeditGroup(){
		$this->groups_model->addeditGroup();
		$data = array('msg' => 'Successfully edited!');
		redirect('groups/lists', $data);
	}
	function deleteGroup(){
		$this->groups_model->deleteGroup();
		$data = array('msg' => 'Successfully deleted!');
		redirect('groups/lists', $data);
	}

}
