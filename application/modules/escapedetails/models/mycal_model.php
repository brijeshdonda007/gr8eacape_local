<?php

class Mycal_model extends CI_Model {

	

	var $conf;

	

	function Mycal_model () {

//		parent::CI_Model();

		

		$this->conf = array(

			'start_day' => 'sunday',

			'show_next_prev' => true,

			'next_prev_url' => '',

		);

		

		$this->conf['template'] = '

			{table_open}<table border="0" cellpadding="0" cellspacing="0" class="calendar">{/table_open}

			

			{heading_row_start}<tr class="months">{/heading_row_start}

			

			{heading_previous_cell}<th><a id="calender-prev" href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}

			{heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}

			{heading_next_cell}<th><a id="calendar-next" href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

			

			{heading_row_end}</tr>{/heading_row_end}

			

			{week_row_start}<tr class="weeks">{/week_row_start}

			{week_day_cell}<td>{week_day}</td>{/week_day_cell}

			{week_row_end}</tr>{/week_row_end}

			

			{cal_row_start}<tr class="days">{/cal_row_start}

			{cal_cell_start}<td class="day">{/cal_cell_start}

			

			{cal_cell_content}

                                <div class="booked-days" style="background: red;">

				<div class="day_num">{day}</div>

				<div class="content">{content}</div>

                                </div>

			{/cal_cell_content}

			{cal_cell_content_today}

                            <div class="booked-days" style="background: red;">

				<div class="day_num highlight">{day}</div>

				<div class="content">{content}</div>

                            </div>

			{/cal_cell_content_today}

			

			{cal_cell_no_content}<div class="day_num">{day}</div>{/cal_cell_no_content}

			{cal_cell_no_content_today}<div class="day_num highlight">{day}</div>{/cal_cell_no_content_today}

			

			{cal_cell_blank}&nbsp;{/cal_cell_blank}

			

			{cal_cell_end}</td>{/cal_cell_end}

			{cal_row_end}</tr>{/cal_row_end}

			

			{table_close}</table>{/table_close}

		';

		

	}

	

	function get_Booked_dates($year, $month, $property_id) {

		

		

                

            $array_month = $this->dates_month($month,$year); 

            $items = array();

            foreach($array_month as $arr)

            {

                

                $sql = "SELECT * FROM tbl_booking WHERE start_date <= '".$arr."' AND end_date >= '".$arr."' AND property_id = '".$property_id."'";

                $query = $this->db->query($sql);

                if($query->num_rows() > 0)

                {





                     $items[]=$arr;



                }

         

            }

                $cal_data = array();

		

		foreach ($items as $row) {

			$cal_data[substr($row,8,2)] = '';

		}

		return $cal_data;

		

	}

	



	

	function generate ($year, $month) {

		

		$this->load->library('calendar', $this->conf);

		$str = $this->uri->segment(2);
		preg_match_all('!\d+!', $str, $matches);
		$prop_id = intval($matches[0][0]);
		$cal_data = $this->get_Booked_dates($year, $month, $prop_id);
		return $this->calendar->generate($year, $month, $cal_data);

		

	}

        

        function dates_month($month,$year)

        {

            $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);

            $dates_month=array();

            for($i=1;$i<=$num;$i++)

            {

                $mktime=mktime(0,0,0,$month,$i,$year);

                $date=date("Y-m-d",$mktime);

                $dates_month[$i]=$date;

            }

            return $dates_month;

        }

        

	

}

