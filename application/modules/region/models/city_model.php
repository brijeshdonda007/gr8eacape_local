<?php

class City_model extends CI_Model
{

    public function getRegionByName($name)
    {
        if(empty($name)) return false;

        $query = $this->db->get_where('tbl_region', array('region_name' => $name));
        return $query->row();
    }
    

    function getUserInfo($user_id)

    {

        $query = $this->db->get_where('tbl_users', array('id' => $user_id));

        return $query->row();

    }

    function get_city_by_regionID($region_id)
    {

        $query = $this->db->get_where('tbl_city', array('region_id' => $region_id, 'city_status' => 1));

        return $query->result();

    }

    

    function get_region_rsbyID($region_id)

    {

        $query = $this->db->get_where('tbl_region', array('id' => $region_id));

        return $query->row();

    }

}
