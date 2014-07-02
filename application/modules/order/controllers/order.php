<?php

class Order extends CI_Controller{

	function __construct(){

		parent::__construct();

		$this->load->helper('url');

		$this->load->library('session');

		$this->load->model('order_model');

		$this->load->database();

	}

	

	function lists(){

                $config = array();

                $config["base_url"] = base_url() . "order/lists/";

                $config["total_rows"] = $this->order_model->record_count_bookings();

                $config["per_page"] = 30;

                $config["uri_segment"] = 3;

                $this->pagination->initialize($config);



                $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

                $data['all_bookings']		=	$this->order_model->all_bookings($config["per_page"], $page);

                $data["links"] = $this->pagination->create_links();

                $data['total_count'] = $config["total_rows"];

		$data['main_content_view']		=		'order/lists';

		$this->load->view('default', $data);

	}

}