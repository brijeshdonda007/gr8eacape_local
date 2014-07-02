<?php

class Suburb_model extends CI_Model
{

    /**
     * Return details of City by City name
     *
     * @param $regionId
     * @param $cityName
     * @return bool
     */
    public function getDetailsByRegionIdAndCityName($regionId, $cityName)
    {
        if(empty($cityName) OR empty($regionId)) return false;

		$this->db->select('tbl_city.*, tbl_region.region_name');
        $this->db->from('tbl_city');
		$this->db->join('tbl_region','tbl_region.id=tbl_city.region_id','left');
        $this->db->where('tbl_city.city_name', $cityName);
        $this->db->where('tbl_city.region_id', $regionId);

        return $this->db->get()->row();
    }


    

    function getUserInfo($user_id)

    {

        $query = $this->db->get_where('tbl_users', array('id' => $user_id));

        return $query->row();

    }

    function get_suburb_by_cityID($city_id)

    {

        $query = $this->db->get_where('tbl_suburb', array('city_id' => $city_id, 'status' => 1));

        return $query->result();

    }

    

    function get_city_by_cityID($city_id)

    {
		$this->db->where('tbl_city.id',$city_id);
		$this->db->select('tbl_city.*, tbl_region.region_name');
		$this->db->join('tbl_region','tbl_region.id=tbl_city.region_id','left');
		$this->db->from('tbl_city');
		$result = $this->db->get();
        return $result->row();

        /*$query = $this->db->get_where('tbl_city', array('id' => $city_id));
        return $query->row();*/
    }

}
