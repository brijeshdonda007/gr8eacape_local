<?php 

class Page extends CI_Controller{

	function __construct(){

		parent::__construct();

		$this->load->model('page_model');

                $this->load->helper('form');

	}

	

	function index()
    {
		$data['pages']				= $this->page_model->listPage();
		$data['main_content_view']	= 'page/page_list';

		$this->load->view('default', $data);

	}

	

	function loadform(){

		$data['all_page']			=		$this->page_model->listPage();

		$data['main_content_view']		=		"page/form";

		$this->load->view('default', $data);

	}

	

	function addUpdatePage(){
		$path                                   = 		UPLOAD_PATH_PAGE;
				$page_id 				= 		$this->page_model->addUpdatePage();
		$data 							= 		array('msg'=>'Successfully Saved!');

		$this->session->set_userdata($data);

		redirect('page/index',$data);

	}

	

	function deletePage(){

		$this->page_model->deletePage();	

	}

	

	function editpage(){			

		$data['page_content']					=		$this->page_model->getPageData();

		$data['main_content_view']				=		'page/form';

		$this->load->view('default', $data);

	}

	

}