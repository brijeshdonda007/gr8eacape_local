<?php

class Subscriber extends CI_Controller{

	public function __construct(){

		parent::__construct();

		$this->load->library('pagination');

		$this->load->library('session');

		$this->load->helper('url');

		$this->load->model('subscriber_model');

		$this->load->database();

	}

	

        function index(){

            $data['subscribers'] = $this->subscriber_model->get_all_subscriber();

            $data['main_content_view'] = 'subscriber/list';

            $this->load->view('default', $data);

        }

        

        function export()

        {

            $this->subscriber_model->export_csv();

        }

	

}
