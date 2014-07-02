<?php

class Ratings_model extends CI_Model {	

	

   function insertRate()

   {

       $clicked_on = $this->input->post('clicked_on');

       $widget_id = $this->input->post('widget_id');

       preg_match('/star_([1-5]{1})/', $clicked_on, $match);

       $rate = $match[1];

       

       preg_match('/r([1-9]{1})/', $widget_id, $match_cat);

       $rcatid = $match_cat[1];

       

       $data = array(

           'property_id' => $this->input->post('property_id'),

           'rcatid' => $rcatid,

           'ratings' => $rate,

           'user_id' => $this->session->userdata('user_id'),

           'created_date' => date('Y-m-d H:i:s')

           

       );

       $data_already = array( 

           'property_id' => $this->input->post('property_id'),

           'rcatid' => $rcatid,

           'user_id' => $this->session->userdata('user_id'));

       

       $query = $this->db->get_where('tbl_property_review', $data_already);

       if($query->num_rows() > 0)

       {

        $new_array = array('clicked_on' => $clicked_on, 'widget_id' => $widget_id, 'rate' => $rate, 'is_rated' => 'yes');   

       }

       else

       {

        $this->db->insert('tbl_property_review', $data);

        $new_array = array('clicked_on' => $clicked_on, 'widget_id' => $widget_id, 'rate' => $rate, 'is_rated' => 'no');

        

       }

       return $new_array;

   }

   

   function insertRate_users()

   {

       $clicked_on = $this->input->post('clicked_on');

       $widget_id = $this->input->post('widget_id');

       preg_match('/star_([1-5]{1})/', $clicked_on, $match);

       $rate = $match[1];

       

       preg_match('/r([1-9]{1})/', $widget_id, $match_cat);

       $rcatid = $match_cat[1];

       

       $data = array(

           'user_id' => $this->input->post('user_id'),

           'user_id_by' => $this->session->userdata('user_id'),

           'rcatid' => $rcatid,

           'ratings' => $rate,

           'created_date' => date('Y-m-d H:i:s')

           

       );

       $data_already = array( 

           'user_id' => $this->input->post('user_id'),

           'rcatid' => $rcatid,

           'user_id_by' => $this->session->userdata('user_id'));

       

       $query = $this->db->get_where('tbl_users_rate_review', $data_already);

       if($query->num_rows() > 0)

       {

        $new_array = array('clicked_on' => $clicked_on, 'widget_id' => $widget_id, 'rate' => $rate, 'is_rated' => 'yes');   

       }

       else

       {

        $this->db->insert('tbl_users_rate_review', $data);

        $new_array = array('clicked_on' => $clicked_on, 'widget_id' => $widget_id, 'rate' => $rate, 'is_rated' => 'no');

        

       }

       return $new_array;

   }

		

}