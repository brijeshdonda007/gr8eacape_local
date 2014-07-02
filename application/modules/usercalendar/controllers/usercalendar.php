<?php

class Usercalendar extends CI_Controller {

	

	function display($year = null, $month = null) {

		

		if (!$year) {

			$year = date('Y');

		}

		if (!$month) {

			$month = date('m');

		}

		

		$this->load->model('Mycal_model');

		$data['calendar'] = $this->Mycal_model->generate($year, $month);

		

		return $this->load->view('usercalendar/mycal', $data);

		

	}

        

        function reserveDay()

        {

            $this->load->model('Mycal_model');

            $id = $this->Mycal_model->reserveDay();

            

            $day = $this->uri->segment(6);

            if($day < 10)

            {

                $data['dayf'] = '0'.$day;

            }

            else

            {

                $data['dayf'] = $day;

            }

            return $this->load->view('usercalendar/day_today', $data);

             

        }

        

	

}

