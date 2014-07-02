<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Location_helper
 {
 
    
    public function get_region_by_CountryID($country_id, $limit, $offset)
    {
        $CI =& get_instance();
        $query = $this->db->get_where('tbl_region', array('country_id' => $country_id, 'region_status' => 1), $limit, $offset);

        return $query->result();
    }
        
    public function get_count_city_regionID($region_id)
    {
        $query = $this->db->get_where('tbl_city', array('region_id' => $region_id, 'city_status' => 1));
        return count($query->result());
    }

    public function get_count_property_regionID($region_id)
    {
        $query = $this->db->get_where('tbl_property', array('region_id' => $region_id, 'property_status' => 1));
        return count($query->result());
    }

     /**
      * Make name to url
      *
      * @param $name
      * @return mixed
      */
     public function makeNameToUrl($name)
    {
        $name = str_replace('/','+',$name);
        return str_replace(' ','_',$name);
    }

     /**
      * convert url to name
      *
      * @param $url
      * @return mixed
      */
    public function makeUrltoName($url)
    {
        $name = str_replace('+','/',$url);
        return str_replace('_',' ',$url);
    }
}