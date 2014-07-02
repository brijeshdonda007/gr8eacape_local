<?php

class Listing_model extends CI_Model{

    function loadBanners(){

        $status     =       1;

        $query      =       $this->db->order_by('banner_title','random');

        $query      =       $this->db->get_where('tbl_banner', array('banner_status'=>$status));

        $result     =       $query->result();

        return $result;

    }

    

    function getSettings(){

        $query      =       $this->db->get('tbl_setting');

        $result     =       $query->row();

        return $result;

    }

    

    function getUserInfo($user_id)

    {

        $query = $this->db->get_where('tbl_users', array('id' => $user_id));

        return $query->row();

    }

    function getAllProperty($suburb_id, $limit, $offset)

    {

        

        $where = array();

        $this->db->where('tbl_property.suburb_id', $suburb_id);

        $this->db->where('tbl_property.admin_action !=', 'pending');

        $this->db->where('tbl_property.admin_action !=', 'declined');;

        $this->db->where('tbl_property.property_status', '1');

        $this->db->select('tbl_property.*, tbl_users.first_name as owner_name, tbl_users.profile_picture as owner_pic, tbl_country.short_name');

        $this->db->from('tbl_property');

        $this->db->join('tbl_users','tbl_property.owner_id=tbl_users.id','INNER');
		$this->db->join('tbl_country','tbl_property.country_id=tbl_country.id','LEFT');

        $this->db->group_by("tbl_property.id"); 

        $this->db->order_by('tbl_property.visited_count', 'desc');

        $this->db->limit( $limit,$offset );

        $result = $this->db->get();

        return $result->result();



    }

    

    function get_suburb_rs($suburb_id)

    {

        $query = $this->db->get_where('tbl_suburb', array('id' => $suburb_id));

        return $query->row();

    }

    

    function getCountPropertyAll($suburb_id)

    {

         $sql = "Select * from tbl_property a inner join tbl_users b on a.owner_id=b.id where a.suburb_id = $suburb_id and a.admin_action != 'pending' and a.admin_action != 'declined' and a.property_status = 1";

         $query = $this->db->query($sql);

         return $query->num_rows();

    }

    function getAllJustListed()

    {

        $sql = "select * from tbl_property where admin_action != 'pending' and admin_action != 'declined' and property_status = 1 order by created_date desc limit 0, 10";

        $query = $this->db->query($sql);

        return $query->result();

    }

    function getFooterCategory()

    {

       $sql = "select COUNT(p.id) as cp, c.* from tbl_property p inner join tbl_category c on p.category_id = c.id group by c.id order by cp desc limit 0, 8";

       $query = $this->db->query($sql);

       return $query->result(); 

    }

    

    function getAllRateCategory()

    {

        $query = $this->db->get('tbl_review_category');

        return $query->result();

    }

    

    function avgRateByCatID($rcatid, $property_id)

    {

        $sql = "select AVG(ratings) as avgr from tbl_property_review

          where property_id = " . $property_id . " and rcatid = ".$rcatid;

        $query = $this->db->query($sql);

        return $query->row();

    }

    

    function geAllReviews($property_id)

    {

        $sql = "select a.*, b.id as uid , b.first_name as ufname, b.last_name as ulname,

            b.profile_picture as upic from tbl_users b inner join tbl_reviews a

            on b.id = a.user_id

          where a.property_id = " . $property_id . " order by a.created_date desc";

        $query = $this->db->query($sql);

        return $query->result();

    }

    

    

}
