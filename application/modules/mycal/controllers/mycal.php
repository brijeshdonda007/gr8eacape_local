<?php

class Mycal extends CI_Controller {

	

	function display($year = null, $month = null) {

		

		if (!$year) {

			$year = date('Y');

		}

		if (!$month) {

			$month = date('m');

		}

		

		$this->load->model('Mycal_model');

		$data['calendar'] = $this->Mycal_model->generate($year, $month);

		

		return $this->load->view('mycal', $data);

		

	}

	

}

