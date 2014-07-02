<?php

class Home_model extends CI_Model{
    function loadBanners(){
        $status     =       1;
        $query      =       $this->db->order_by('banner_title','random');
        $query      =       $this->db->get_where('tbl_banner', array('banner_status'=>$status));
        $result     =       $query->result();
        return $result;
    }
    function loadBanners_first(){
        $status     =       1;
        $query      =       $this->db->order_by('banner_title','random');
        $query      =       $this->db->get_where('tbl_banner', array('banner_status'=>$status));
        $result     =       $query->row();
        return $result;
    }
    function getSettings(){
        $query      =       $this->db->get('tbl_setting');
        $result     =       $query->row();
        return $result;
    }
    function getPageTitle(){
        $query  =   $this->db->get_where('tbl_pages', array('status' => 1));
        $result =   $query->result();
    }
    function getUserInfo($user_id)
    {
        $query = $this->db->get_where('tbl_users', array('id' => $user_id));
        return $query->row();
    }
    function getAllProperty()
    {
        $sql = "Select c.short_name, a.*, b.first_name as owner_name, b.profile_picture as owner_pic from tbl_property a inner join tbl_users b on a.owner_id=b.id LEFT JOIN tbl_country c ON a.country_id=c.id where admin_action != 'pending' and admin_action != 'declined' and property_status = 1 group by a.id order by a.visited_count desc limit 0, 4";
        $query = $this->db->query($sql);
        return $query->result();
    }
    function get_all_propery()
    {
        $sql = "Select * from tbl_property where admin_action != 'pending' and admin_action != 'declined' and property_status = 1";
        $query = $this->db->query($sql);
        return count($query->result());
    }
    function get_all_property_pagination($limit, $start)
    {
        $sql = "Select c.short_name, a.*, b.first_name as owner_name, b.profile_picture as owner_pic from tbl_property a inner join tbl_users b on a.owner_id=b.id LEFT JOIN tbl_country c on c.id=a.country_id where admin_action != 'pending' and admin_action != 'declined' and property_status = 1 group by a.id order by a.visited_count desc limit $start, $limit";
        $query = $this->db->query($sql);
        return $query->result();
    }
    function getAllJustListed()
    {
        $limit = 10;
        $this->db->where('tbl_property.admin_action !=','pending');
		$this->db->where('tbl_property.admin_action !=','declined');
		$this->db->where('tbl_property.property_status','1');
		$this->db->select('tbl_property.*, tbl_country.short_name');
		$this->db->from('tbl_property');
		$this->db->join('tbl_country', 'tbl_property.country_id=tbl_country.id', 'LEFT');
		$this->db->order_by('tbl_property.created_date','DESC');
		$this->db->limit( $limit );
        $query = $this->db->get();
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
    function get_testimonials()
    {
        $sql = "select * from tbl_testimonials order by rand() limit 2";
        $query = $this->db->query($sql);
        return $query->result();
    }
    function save_faq()
    {
        $full_name = $this->input->post('full_name');
        $email = $this->input->post('email');
        $faq_question = $this->input->post('faq_question');
        $data = array('full_name' => $full_name, 'email' => $email, 'faq_question' => $faq_question, 'asked_date' => date("Y-m-d H:i:s"), 'status' => 0);
        $this->db->insert('tbl_faq', $data);
        return $this->db->insert_id();
    }
    
    function list_faq()
    {
        $this->db->where('status', 1);
        $this->db->select('*');
        $this->db->from('tbl_faq');
        $this->db->order_by('asked_date', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    

    function get_site_info($site_id)
    {
            $data=array();
            $options=array('id'=>$site_id);
            $query = $this->db->get_where('tbl_setting',$options);
            return $query->row();
    }
}
