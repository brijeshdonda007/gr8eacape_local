<?php
class Users_model extends CI_Model{
    function all_users($limit, $start)
    {
        $sql = "select tbl_users.*,tbl_usergroup.name as group_name from tbl_users LEFT JOIN tbl_usergroup ON tbl_usergroup.id=tbl_users.user_type order by tbl_users.user_created_date desc limit $start, $limit";
        $query = $this->db->query($sql);
        return $query->result();
    }
	function all_groups()
	{
		$sql = "select * from tbl_usergroup order by id DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}
    function record_count_all_users()
    {
        $sql = "select * from tbl_users";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    function getCountry(){
    	$this->db->select('*');
    	$query = $this->db->get('tbl_users_country');
    	if ($query->num_rows() > 0){
    		return $query->result();
    	}else{
    		return NULL;
    	}
    }
    function getUserInfo($user_id)
    {
    	$this->db->select('tbl_users.*, tbl_users_country.countryname');
    	$this->db->join('tbl_users_country', 'tbl_users.country_id = tbl_users_country.id', 'left');
        $this->db->where('tbl_users.id', $user_id);
        $query = $this->db->get('tbl_users');
        if ($query->num_rows() > 0){
        	return $query->row();
        } else {
        	return NULL;
        }
    }
    function deleteUser(){
    	$userid = $this->uri->segment(3);
    	$this->db->where('id', $userid);
    	$this->db->delete('tbl_users');
    }
    function addeditUser($image_name){
		if ($this->input->post('is_business'))
			$is_business = '1';
		else
			$is_business = '0';

    	if ($image_name == ''){
			$data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'gender' => $this->input->post('gender'),
				'user_description' => $this->input->post('user_description'),
				'street_no' => $this->input->post('street_no'),
				'street_name' => $this->input->post('street_name'),
				'suburb' => $this->input->post('suburb'),
				'city' => $this->input->post('city'),
				'region' => $this->input->post('region'),
				'country_id' => $this->input->post('country_id'),
				'phone' => $this->input->post('phone'),
				'mobile' => $this->input->post('mobile'),
				'post_code' => $this->input->post('post_code'),
				'about_yourself' => $this->input->post('about_yourself'),
				'user_status' => $this->input->post('status'),
				'user_type' => $this->input->post('user_type'),
				'is_business' => $is_business,
				'gst_num' => $this->input->post('gst_num'),
				'company_name' => $this->input->post('company_name')
			);
		}else {
			$data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'gender' => $this->input->post('gender'),
				'user_description' => $this->input->post('user_description'),
				'street_no' => $this->input->post('street_no'),
				'street_name' => $this->input->post('street_name'),
				'suburb' => $this->input->post('suburb'),
				'city' => $this->input->post('city'),
				'region' => $this->input->post('region'),
				'country_id' => $this->input->post('country_id'),
				'phone' => $this->input->post('phone'),
				'mobile' => $this->input->post('mobile'),
				'post_code' => $this->input->post('post_code'),
				'about_yourself' => $this->input->post('about_yourself'),
				'user_status' => $this->input->post('status'),
				'user_type' => $this->input->post('user_type'),
				'profile_picture' => $image_name,
				'is_business' => $is_business,
				'gst_num' => $this->input->post('gst_num'),
				'company_name' => $this->input->post('company_name')
			);
		}
		$this->db->where('id', $this->input->post('userid'));
		$this->db->update('tbl_users', $data);
    }
    function addUser(){
		if ($this->input->post('is_business'))
			$is_business = '1';
		else
			$is_business = '0';
		$data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'gender' => $this->input->post('gender'),
			'user_description' => $this->input->post('user_description'),
			'street_no' => $this->input->post('street_no'),
			'street_name' => $this->input->post('street_name'),
			'suburb' => $this->input->post('suburb'),
			'city' => $this->input->post('city'),
			'region' => $this->input->post('region'),
			'country_id' => $this->input->post('country_id'),
			'phone' => $this->input->post('phone'),
			'mobile' => $this->input->post('mobile'),
			'post_code' => $this->input->post('post_code'),
			'about_yourself' => $this->input->post('about_yourself'),
			'user_status' => $this->input->post('status'),
			'user_type' => $this->input->post('user_type'),
			'is_business' => $is_business,
			'gst_num' => $this->input->post('gst_num'),
			'company_name' => $this->input->post('company_name')
		);
		$this->db->insert('tbl_users',$data);
		return $this->db->insert_id();
    }
	function add_userImage($user_id, $image_name){
		$data = array('profile_picture' => $image_name);
		$this->db->where('id', $user_id);
		$this->db->update('tbl_users', $data);
	}
}
