<?php

class Region_model extends CI_Model
{

    public function getDetailsByCountryName($name)
    {
        if(empty($name)) return false;

        $query = $this->db->get_where('tbl_country', array('country_name' => $name));
        return $query->row();
    }



    

    function getUserInfo($user_id)

    {

        $query = $this->db->get_where('tbl_users', array('id' => $user_id));

        return $query->row();

    }

    function get_all_region_by_countryID($country_id)

    {

        $query = $this->db->get_where('tbl_region', array('country_id' => $country_id, 'region_status' => 1));

        return $query->num_rows();

    }

    

    function get_region_with_limit($country_id, $limit, $offset)

    {

        $this->db->where('region_status', 1);

        $this->db->where('country_id', $country_id);

        $this->db->select('*');

        $this->db->from('tbl_region');

        $this->db->order_by('id', 'asc');

        

        $this->db->limit( $limit,$offset );

        

        $result = $this->db->get();

        //echo  $this->db->last_query();

        return $result->result();

    }

    

    function get_country_name($country_id)

    {

        $query = $this->db->get_where('tbl_country', array('id' => $country_id));

        return $query->row();

    }

}
