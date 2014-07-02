<?php

class Admin_model extends CI_Model
{
     public function __construct() {
        //parent::CI_Model();
    }
    function admin_login($username, $password)
    {
        $options = array('username'=>$username,
                        'password'=>hash('sha256', $password),
        );
        $query = $this->db->get_where('tbl_admin',$options);
        if($query->num_rows()>0)
        {
		$record = $query->row();
		if($record->username===$username && $record->password===hash('sha256', $password))
		{
			$unique_session_id = $this->generate_session_id();
			$update_date = array('lastlogin_date'=>time(),'sessionid'=>$unique_session_id);
			$this->db->where('id',$record->id);
			$this->db->update('tbl_admin',$update_date);
			$this->session->set_userdata(array('admin_user_id' => $record->id));
			$this->session->set_userdata(array('admin_user_name' => $record->username));
			$this->session->set_userdata(array('admin_first_name' => $record->first_name));
			$this->session->set_userdata(array('last_login' => date('jS M Y, H:i a',$record->lastlogin_date)));
			$this->session->set_userdata(array('admin_session_id' => $unique_session_id));
			return $record->id;
		}
		else
		{
			return 0;
		}
        }
        else
        {
	        $options = array('email'=>$username,
	                        'password'=>hash('sha256', $password),
	        );
	        $query = $this->db->get_where('tbl_admin',$options);
	        if ($query->num_rows() > 0){
			$record = $query->row();
			if($record->email===$username && $record->password===hash('sha256', $password))
			{
				$unique_session_id = $this->generate_session_id();
				$update_date = array('lastlogin_date'=>time(),'sessionid'=>$unique_session_id);
				$this->db->where('id',$record->id);
				$this->db->update('tbl_admin',$update_date);
				$this->session->set_userdata(array('admin_user_id' => $record->id));
				$this->session->set_userdata(array('admin_user_name' => $record->username));
				$this->session->set_userdata(array('admin_first_name' => $record->first_name));
				$this->session->set_userdata(array('last_login' => date('jS M Y, H:i a',$record->lastlogin_date)));
				$this->session->set_userdata(array('admin_session_id' => $unique_session_id));
				return $record->id;
			}
			else
			{
				return 0;
			}
	        }else{
            		return 0;
            }
        }
	}
	function checkID($id, $session_id)
	{
		$query = $this->db->get_where('tbl_admin', array('id' => $id, 'sessionid' => $session_id));
		if($query->num_rows() == 0)
		{
			return 0;
		}
		else
		{
			$row = $query->row();
			return $row->id;
		}
	}	
	function logout($id)
	{
		$data['sessionid'] = "";
		$this->db->update('tbl_admin', $data, array('id' => $id));
	}
	function generate_session_id()
	{
		$sessid = '';
		while (strlen($sessid) < 32)
		{
			$sessid .= mt_rand(0, mt_getrandmax());
		}
		$sessid .= $this->input->ip_address();
		return md5(uniqid($sessid, TRUE));
	}
	function incrypt($pwd)
	{
		$temp="reveal";
		$a=md5(sha1($temp.$pwd));
		return $a;
	}
	function get_email_forget($str)
	{
		$sql="SELECT * FROM tbl_admin WHERE email=? ";
		$query = $this->db->query($sql, array($str));
		return $query->row_array();
	}
	function check_email_forget($email)
	{
		$sql="SELECT id FROM tbl_admin WHERE email=? ";
		$query = $this->db->query($sql, array($email));
		if($query->num_rows()>0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	function update_password($email)
	{
		$password = hash('sha256', $this->input->post('password'));
		$data=array('password'=>$password);
		$this->db->where('email',$email);
		$this->db->update('tbl_admin',$data);
	}
    function latest_booking()
    {
        $status_array = serialize(array('bb' => 5,'oo' => 5));
        $sql = "select a.*,b.title as prop_name, b.owner_id as owner_id, c.first_name as fname, c.last_name as lname from tbl_property b inner join tbl_booking a
        on a.property_id = b.id inner join tbl_users c 
        on a.user_id = c.id where a.status = ? order by a.requested_date desc limit 5";
        $query = $this->db->query($sql, array($status_array));
        return $query->result();
    }
	function get_owner_info($user_id)
    {
        $query = $this->db->get_where('tbl_users', array('id' => $user_id));
        return $query->row();
    }
    function getUserInfo($user_id)
    {
        $query = $this->db->get_where('tbl_users', array('id' => $user_id));
        return $query->row();
    }
    function latest_users()
    {
        $sql = "select * from tbl_users order by user_created_date desc limit 5";
        $query = $this->db->query($sql);
        return $query->result();
    }
    function record_count_all_admins()
    {
        $sql = $this->db->get('tbl_admin');
        return $sql->num_rows();
    }
    function record_count_all_users()
    {
        $sql = "select * from tbl_users";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    function all_admins($limit, $start)
    {
        $sql = "select * FROM tbl_admin order by tbl_admin.admin_created desc limit ?, ?";
        $query = $this->db->query($sql,array($start,$limit));
        return $query->result();
    }
    function addAdmin(){
		$data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'admin_status' => $this->input->post('status'),
			'admin_type' => '1',
			'password' => hash('sha256', $this->input->post('password')),
			'admin_created' => date('Y-m-d H:i:s')
		);
		$this->db->insert('tbl_admin',$data);
		return $this->db->insert_id();
    }
    function addeditAdmin(){
    	if ($this->input->post('password') != ''){
			$data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'admin_status' => $this->input->post('status'),
				'admin_type' => '1',
				'password' => hash('sha256', $this->input->post('password')),
			);
		}else{
			$data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'admin_status' => $this->input->post('status'),
				'admin_type' => '1',
			);
		}
		$this->db->where('id', $this->input->post('adminid'));
		$this->db->update('tbl_admin', $data);
    }
    function deleteAdmin(){
    	$adminid = $this->uri->segment(3);
    	$this->db->where('id', $adminid);
    	$this->db->delete('tbl_admin');
    }
    function getAdminInfo($admin_id)
    {
        $this->db->where('tbl_admin.id', $admin_id);
        $query = $this->db->get('tbl_admin');
        if ($query->num_rows() > 0){
        	return $query->row();
        } else {
        	return NULL;
        }
    }
    function all_users($limit, $start)
    {
        $sql = "select tbl_users.*,tbl_usergroup.name as group_name from tbl_users LEFT JOIN tbl_usergroup ON tbl_usergroup.id=tbl_users.user_type order by tbl_users.user_created_date desc limit ?, ?";
        $query = $this->db->query($sql,array($start,$limit));
        return $query->result();
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
    function getUserInfo_cntry($user_id)
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
	function record_count_all_groups()
	{
		return $this->db->count_all('tbl_usergroup');;
	}
	function all_groups($limit, $start)
	{
		$this->db->select('*');
		$this->db->from('tbl_usergroup');
		$this->db->limit($limit, $start);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result();
		}else{
			return FALSE;
		}
	}
	function all_user_groups()
	{
		$sql = "select * from tbl_usergroup order by id DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}
 	function get_All_sections()
	{
		$query = $this->db->get_where('tbl_usergroup_section', array('status'=>'1'));
		return $query->result();
	}
	function get_All_property()
	{
		$query = $this->db->get_where('tbl_usergroup_property', array('status'=>'1'));
		return $query->result();
	}
	function addGroup()
	{
		$data = array(
			'name' => $this->input->post('groupname'),
			'status' => $this->input->post('status')
		);
		$this->db->insert('tbl_usergroup', $data);
		$group_id = $this->db->insert_id();

		$group_detail = $this->input->post('group_detail');
		foreach ($group_detail as $gr){
			$temp = explode('_', $gr);
			$data = array(
				'group_id' => $group_id,
				'section_id' => $temp[0],
				'prop_id' => $temp[1],
				'status' => '1'
			);
			$this->db->insert('tbl_usergroup_detail', $data);
		}

		return $group_id;
	}
	function get_group($group_id)
	{
		$query = $this->db->get_where('tbl_usergroup', array('id'=>$group_id));
		return $query->row();
	}
	function get_detail($group_id)
	{
		$ret_arr = array();
		$query = $this->db->get_where('tbl_usergroup_detail', array('group_id'=>$group_id));
		foreach ($query->result() as $re){
			array_push($ret_arr, $re->group_id.'_'.$re->section_id.'_'.$re->prop_id);
		}
		return $ret_arr;
	}
	function addeditGroup()
	{
		$data = array(
			'name' => $this->input->post('groupname'),
			'status' => $this->input->post('status')
		);
		$this->db->where('id', $this->input->post('groupid'));
		$this->db->update('tbl_usergroup', $data);
		
		$this->db->where('group_id', $this->input->post('groupid'));
		$this->db->delete('tbl_usergroup_detail');

		$group_detail = $this->input->post('group_detail');
		foreach ($group_detail as $gr){
			$temp = explode('_', $gr);
			$data = array(
				'group_id' => $temp[0],
				'section_id' => $temp[1],
				'prop_id' => $temp[2],
				'status' => '1'
			);
			$this->db->insert('tbl_usergroup_detail', $data);
		}

		return $this->input->post('groupid');
	}
 	function deleteGroup()
	{
		$group_id = $this->uri->segment(3);
		$this->db->where('id', $group_id);
		$this->db->delete('tbl_usergroup');

		$this->db->where('group_id', $group_id);
		$this->db->delete('tbl_usergroup_detail');
	}
	function record_count_bookings()
	{
		$status_array = serialize(array('bb' => 5,'oo' => 5));
		$sql = "select a.*,b.title as prop_name, b.owner_id as owner_id, c.first_name as fname, c.last_name as lname from tbl_property b inner join tbl_booking a
		on a.property_id = b.id inner join tbl_users c 
		on a.user_id = c.id where a.status = ?";
		$query = $this->db->query($sql, array($status_array));
		return $query->num_rows();
	}
	function all_bookings($limit, $start)
	{
		$status_array = serialize(array('bb' => 5,'oo' => 5));
		$sql = "select a.*,b.title as prop_name, b.owner_id as owner_id, c.first_name as fname, c.last_name as lname from tbl_property b inner join tbl_booking a
		on a.property_id = b.id inner join tbl_users c 
		on a.user_id = c.id where a.status = ? order by a.requested_date desc limit ?, ?";
		$query = $this->db->query($sql, array($status_array,$start,$limit));
		return $query->result();
	}
	function record_count_country() {
		return $this->db->count_all('tbl_country');
	}
	function listCountry($limit, $start){
		$this->db->select('*');
		$this->db->from('tbl_country');
		$this->db->limit($limit, $start);
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return FALSE;
		}
	}
	function Country($id){
		$query = $this->db->get_where('tbl_country', array('id' => $id));
		return $query->row();
	}
	function addEditcountry()
	{	
		$col_data = true;
		$data = array(
			'country_name' => $this->input->post('country_name'),
			'status' => $this->input->post('status'),
		);
		if($this->input->post('countryid') !=''):
			$this->db->update('tbl_country', $data, array('id' => $this->input->post('countryid')));
			$id = $this->input->post('countryid');
		else:
			$this->db->insert('tbl_country', $data);
			$id = $this->db->insert_id();
		endif;
		return $id;
	}
	function deleteCountry(){
		$deleteid			=	$this->uri->segment(3);
		$this->db->delete('tbl_country', array('id' => $deleteid)); 
	}
	function record_count_regionList() {
		return $this->db->count_all('tbl_region');
	}
	function listRegion($limit, $start){		
		$this->db->select('a.*, b.country_name as country_name');
		$this->db->from('tbl_region a');
		$this->db->join('tbl_country b', 'a.country_id = b.id', 'inner');
		$this->db->limit($limit, $start);
		$this->db->order_by('a.id','asc');
		$query = $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return FALSE;
		}
	}
	function getAllCountries()
	{
		$query = $this->db->get('tbl_country');
		return $query->result();
	}
	function addEditregion()
	{
		$col_data = true;
		$data = array(
			'country_id' => $this->input->post('country_id'),
			'region_name' => $this->input->post('region_name'),
			'region_status' => $this->input->post('region_status'),
		);
		if($this->input->post('region_id') !=''):
			$this->db->update('tbl_region', $data, array('id' => $this->input->post('region_id')));
			$id = $this->input->post('region_id');
		else:
			$this->db->insert('tbl_region', $data);
			$id = $this->db->insert_id();
		endif;
		return $id;
	}
	function update_feature_img($id, $img_name)
	{
		$data = array(
			'featured_image' => $img_name
		);
		$this->db->where('id', $id);
		$this->db->update('tbl_region', $data); 
	}
	function ediRegion($id) {
		$query = $this->db->get_where('tbl_region', array('id' => $id));				
		return $query->row();
	}
	function deleteRegion(){
		$deleteid			=	$this->uri->segment(3);
		$this->db->delete('tbl_region', array('id' => $deleteid)); 
	}
	function record_count_city() {
		return $this->db->count_all('tbl_city');
	}
	function listCity($limit, $start){		
		$this->db->select('c.*, a.country_name as country_name, b.region_name as region_name');
		$this->db->from('tbl_region b');
		$this->db->join('tbl_country a', 'b.country_id = a.id', 'inner');
		$this->db->join('tbl_city c', 'c.region_id = b.id', 'inner');
		$this->db->limit($limit, $start);
		$this->db->order_by('c.id','asc');
		$query = $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result();
		}else{
			return FALSE;
		}
	}
	function addEditCity() {
		$col_data = true;
		$data = array(
			'country_id' => $this->input->post('country_id'),
			'region_id' => $this->input->post('region_id'),
			'city_name' => $this->input->post('city_name'),
			'city_status' => $this->input->post('city_status'),
		);
		if($this->input->post('city_id') !=''):
			$this->db->update('tbl_city', $data, array('id' => $this->input->post('city_id')));
			$id = $this->input->post('city_id');
		else:
			$this->db->insert('tbl_city', $data);
			$id = $this->db->insert_id();
		endif;
		return $id;
	}
    function update_feature_img_c($id, $img_name)
    {
        $data = array(
               'featured_image' => $img_name
            );
        $this->db->where('id', $id);
        $this->db->update('tbl_city', $data); 
    }
	function ediCity($id) {
		$query = $this->db->get_where('tbl_city', array('id' => $id));
		return $query->row();
	}
	function getRegions($country_id) {
		$query=	$this->db->get_where('tbl_region', array('country_id' => $country_id));
		return $query->result();
	}
	function deleteCity()
	{
		$deleteid =	$this->uri->segment(3);
		$this->db->delete('tbl_city', array('id' => $deleteid)); 
	}
	function record_count_suburb()
	{
		$sql = "select * from tbl_suburb";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function list_suburb($limit, $start){
		$this->db->select('tbl_suburb.*, tbl_country.country_name,tbl_region.region_name,tbl_city.city_name');
		$this->db->from('tbl_suburb');
		$this->db->join('tbl_country','tbl_country.id=tbl_suburb.country_id','INNER');
		$this->db->join('tbl_region','tbl_region.id=tbl_suburb.region_id','INNER');
		$this->db->join('tbl_city','tbl_city.id=tbl_suburb.city_id','INNER');
		$this->db->order_by('tbl_suburb.suburb_name', 'desc');
		$this->db->limit( $limit, $start);
		$result = $this->db->get();
		//echo $this->db->last_query();exit();
		return ($result->result());
	}
	function edit_suburb($suburb_id)
	{
		$query = $this->db->get_where('tbl_suburb', array('id' => $suburb_id));				
		return $query->row();
	}
	function getCities($region_id)
	{
		$query = $this->db->get_where('tbl_city', array('region_id' => $region_id));
		return $query->result();
	}
	function add_edit_suburb() {
		$col_data = true;
		$data = array(
			'country_id' => $this->input->post('country_id'),
			'region_id' => $this->input->post('region_id'),
			'city_id' => $this->input->post('city_id'),
			'suburb_name' => $this->input->post('suburb_name'),
			'status' => $this->input->post('status'),
		);
		if($this->input->post('suburb_id') !=''):
			$this->db->update('tbl_suburb', $data, array('id' => $this->input->post('suburb_id')));
			$id = $this->input->post('suburb_id');
		else:
			$this->db->insert('tbl_suburb', $data);
			$id = $this->db->insert_id();
		endif;
		return $id;
	}
    function update_feature_img_s($id, $img_name)
    {
        $data = array(
               'featured_image' => $img_name
            );
        $this->db->where('id', $id);
        $this->db->update('tbl_suburb', $data); 
    }
	function deletesuburb(){
		$deleteid = $this->uri->segment(3);
		$this->db->delete('tbl_suburb', array('id' => $deleteid)); 
	}
    function get_all_category()
    {
        $sql="select * from tbl_category";
        $query = $this->db->query($sql);
        return $query->result();
    }
	function record_count_property() {
		if(isset($_POST['filter_property']))
		{
			if(($this->input->post('category_id')) && ($this->input->post('admin_action') == ''))
			{
				$category_id = $this->input->post('category_id');
				$sql = "SELECT tbl_property.* FROM tbl_property INNER JOIN tbl_property_cats 
					ON (tbl_property.id = tbl_property_cats.property_id)
					INNER JOIN tbl_category 
					ON (tbl_property_cats.category_id = tbl_category.id)
					WHERE tbl_property_cats.category_id = $category_id";
				//echo $sql;exit();
			}
			elseif(($this->input->post('admin_action') != '') && !($this->input->post('category_id')))
			{
				$admin_action = $this->input->post('admin_action');
				$sql = "SELECT *
					FROM
					tbl_property WHERE
					admin_action = ?";					
				$query = $this->db->query($sql,array($admin_action));
			}
			elseif(($this->input->post('admin_action') != '') && ($this->input->post('category_id')))
			{
				$admin_action = $this->input->post('admin_action');
				$category_id = $this->input->post('category_id');
				$sql = "SELECT tbl_property.* FROM tbl_property INNER JOIN tbl_property_cats 
					ON (tbl_property.id = tbl_property_cats.property_id)
					INNER JOIN tbl_category 
					ON (tbl_property_cats.category_id = tbl_category.id)
					WHERE tbl_property_cats.category_id = ? AND tbl_property.admin_action = ?";				
				$query = $this->db->query($sql,array($category_id,$admin_action));
			}
			else
			{
				$sql = "select * from tbl_property";
				$query = $this->db->query($sql);
			}
		}
		else
		{
			$sql = "select * from tbl_property";
			$query = $this->db->query($sql);
		}
		
		return $query->num_rows();
	}
	function listProperty($limit, $start){
		if(isset($_POST['filter_property']))
		{
			if(($this->input->post('category_id')) && ($this->input->post('admin_action') == ''))
			{
				$category_id = $this->input->post('category_id');
				$sql = "SELECT tbl_property.*
					FROM
					tbl_property
					INNER JOIN tbl_property_cats 
					ON (tbl_property.id = tbl_property_cats.property_id)
					INNER JOIN tbl_category 
					ON (tbl_property_cats.category_id = tbl_category.id)
					WHERE tbl_property_cats.category_id = ? ORDER BY tbl_property.created_date DESC limit ?,? ";
					//echo $sql;exit();
				$query = $this->db->query($sql,array($category_id, $start, $limit));
			}
			elseif(($this->input->post('admin_action') != '') && !($this->input->post('category_id')))
			{
				$admin_action = $this->input->post('admin_action');
				$sql = "SELECT *
					FROM
					tbl_property WHERE
					admin_action = ? ORDER BY created_date DESC limit ?,?";
					
				$query = $this->db->query($sql,array($admin_action, $start, $limit));
			}
			elseif(($this->input->post('admin_action') != '') && ($this->input->post('category_id')))
			{
				$admin_action = $this->input->post('admin_action');
				$category_id = $this->input->post('category_id');
				$sql = "SELECT tbl_property.*
					FROM
					tbl_property
					INNER JOIN tbl_property_cats 
					ON (tbl_property.id = tbl_property_cats.property_id)
					INNER JOIN tbl_category 
					ON (tbl_property_cats.category_id = tbl_category.id)
					WHERE tbl_property_cats.category_id = ? AND tbl_property.admin_action = ? ORDER BY tbl_property.created_date DESC limit ?, ?";					
				$query = $this->db->query($sql,array($category_id, $admin_action, $start, $limit));
			}
			else
			{
				$sql = "select * from tbl_property";
				$query = $this->db->query($sql);
			}
		}
		else
		{
			$sql="select * from tbl_property order by created_date DESC limit ?,? ";
			$query = $this->db->query($sql,array($start, $limit));
		}
		return $query->result();
	}
	function approveProperty($id)
	{
		$data = array(
			'admin_action' => 'approved',
		);
		$this->db->where('id', $id);
		$this->db->update('tbl_property', $data);
	}
	function verifyProperty($id)
	{
		$data = array(
			'admin_action' => 'verified',
		);
		$this->db->where('id', $id);
		$this->db->update('tbl_property', $data);
	}
	function declineProperty($id)
	{
		$data = array(
			'admin_action' => 'declined',
		);
		$this->db->where('id', $id);
		$this->db->update('tbl_property', $data);
	}
	function get_property_detail($porperty_id)
	{
		$this->db->where('tbl_property.id',$porperty_id);
		$this->db->select('tbl_property.id,tbl_property.admin_action,tbl_property.owner_id,
			tbl_property.title,tbl_property.featured_image,tbl_property.price_night,
			tbl_property.price_week, tbl_property.price_month, tbl_property.bedroom,
			tbl_property.bathroom,tbl_property.adult,tbl_property.children,tbl_property.pet,
			tbl_property.detail,tbl_property.amenities,tbl_property.termsncondition,
			tbl_property.guest_capacity,tbl_property.property_status,
			tbl_property.created_date,tbl_property.private_code,
			tbl_users.id as user_id,
			tbl_users.profile_picture,tbl_users.first_name, tbl_users.email, tbl_country.country_name, tbl_region.region_name,
			tbl_city.city_name, tbl_suburb.suburb_name');
		$this->db->from('tbl_property');
		$this->db->join('tbl_users','tbl_property.owner_id=tbl_users.id','INNER');
		$this->db->join('tbl_country','tbl_property.country_id=tbl_country.id','INNER');
		$this->db->join('tbl_region','tbl_property.region_id=tbl_region.id','INNER');
		$this->db->join('tbl_city','tbl_property.city_id=tbl_city.id','INNER');
		$this->db->join('tbl_suburb','tbl_property.suburb_id=tbl_suburb.id','INNER');
		$result = $this->db->get();
		return $result->row();
	}
    function record_count_category() {
		return $this->db->count_all('tbl_category');
    }
	function listCategory($limit, $start){
		$this->db->select('*');
		$this->db->from('tbl_category');
		$this->db->limit($limit, $start);
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result();
		}else{
			return FALSE;
		}
	}
    function editCategory()
    {
        $catid		=	$this->uri->segment(4);
		$query		=	$this->db->get_where('tbl_category', array('id' => $catid));				
		return	$query->row();
    }
	function addeditCategory()
	{
        $col_data = true;
        $data = array(
                    'category_title' => $this->input->post('category_title'),
                    'category_status' => $this->input->post('category_status'),
                    'category_description' => $this->input->post('category_description'),
        );
		
		if($this->input->post('categoryid') =='list'):
			$this->db->update('tbl_category', $data, array('id' => $this->input->post('categoryid')));
			$id = $this->input->post('categoryid');
		else:
			$this->db->insert('tbl_category', $data);
			$id = $this->db->insert_id();
		endif;
		return $id;
	}
	function deleteCategory(){
		$categoryid			=	$this->uri->segment(3);
		$this->db->delete('tbl_category', array('id' => $categoryid)); 
	}
	function listBanner(){
		$query				=		$this->db->get('tbl_banner');
		return $query->result();
	}
	function addupdatebanner($image){
		$data = array(
			'banner_title' 		=> 		$this->input->post('banner_name'),
			'banner_description'		=>		$this->input->post('banner_description'),
			'image' 			=>		$image,
			'banner_link'		=>		$this->input->post('banner_link'),
			'banner_status'		=>		$this->input->post('status')
		);	
		if($this->input->post('bannerid') !=''):						
			$this->db->update('tbl_banner', $data, array('id' => $this->input->post('bannerid')));
			$id 			= 		$this->input->post('bannerid');
		else:
			$this->db->insert('tbl_banner', $data);
			$id 			= 		$this->db->insert_id();
		endif;
		return $id;	
	}	
	function getbannercontent(){
		$banner_id			=		$this->uri->segment(4);
		$query				=		$this->db->get_where('tbl_banner', array('id' => $banner_id));				
		$result				=		$query->row();
		return $result;
	}
    function deletebanner(){
		$banner_id = $this->uri->segment(3);
		$this->db->delete('tbl_banner', array('id' => $banner_id));
    }
	function listPage(){
		$query = $this->db->get('tbl_pages');
		return $query->result();
	}

	function updatePage($data, $page_id)
	{
		$this->db->where('id', $page_id);
		$this->db->update('tbl_pages', $data);
	}

	function addPage($data)
	{
		$this->db->insert('tbl_pages',$data);
	}

	function deletePage($page_id){
		$this->db->delete('tbl_pages', array('id' => $page_id));  
    }
	function getPageData(){
		$page_id			=		$this->uri->segment(4);
		$query				=		$this->db->get_where('tbl_pages', array('id' => $page_id));				
		$result				=		$query->row();
		return $result;		
	}
    function month_name($int) {
	    return date( 'F' , mktime(1, 1, 1, (int)$int, 1) );
    }
	/*
    function previous_month_earn($limit, $start) {
        if($_POST)
        {
            $month = ($this->input->post('month')) - 1;
            $year = ($this->input->post('year'));
        }
        else {
            $month = date("m") - 1;
            $year = date("Y");
        }
        $status_array = serialize(array('bb' => 5, 'oo' => 5));
        $sql = "select a.*, sum(a.total_price) as sum_price, b.title as prop_name, b.owner_id as bowner_id, c.first_name as fname, c.last_name as lname from tbl_property b inner join tbl_booking a                on a.property_id = b.id inner join tbl_users c                 on b.owner_id = c.id where a.status = '" . $status_array . "' and month = '" . $month . "' and year = '" . $year . "' group by b.owner_id order by a.requested_date desc limit $start, $limit";
        $query = $this->db->query($sql);
        return $query->result();
    }
    function record_previous_month_earn() {
       if($_POST)
        {
            $month = ($this->input->post('month')) - 1;
            $year = ($this->input->post('year'));
        }
        else {
            $month = date("m") - 1;
            $year = date("Y");
        }
        $status_array = serialize(array('bb' => 5, 'oo' => 5));
        $sql = "select a.*,b.title as prop_name, b.owner_id as bowner_id, c.first_name as fname, c.last_name as lname from tbl_property b inner join tbl_booking a                on a.property_id = b.id inner join tbl_users c                 on b.owner_id = c.id where a.status = '" . $status_array . "' and month = '" . $month . "' and year = '" . $year . "' group by a.id";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    function previous_month_earn_filter($limit, $start) {
        $month = $this->input->post('month') - 1;
        $year = $this->input->post('year');
        $status_array = serialize(array('bb' => 5, 'oo' => 5));
        $sql = "select a.*, sum(a.total_price) as sum_price, b.title as prop_name, b.owner_id as bowner_id, c.first_name as fname, c.last_name as lname from tbl_property b inner join tbl_booking a                on a.property_id = b.id inner join tbl_users c                 on b.owner_id = c.id where a.status = '" . $status_array . "' and month = '" . $month . "' and year = '" . $year . "' group by b.owner_id order by a.requested_date desc limit $start, $limit";
        $query = $this->db->query($sql);
        return $query->result();
    }    
    function record_previous_month_earn_detail() {
        $owner_id = $this->uri->segment(5);
        $month = $this->uri->segment(3) - 1;
        $year = $this->uri->segment(4);
        $status_array = serialize(array('bb' => 5, 'oo' => 5));
        $sql = "select a.*,b.title as prop_name, b.owner_id as bowner_id,
            c.first_name as fname, c.last_name as lname from tbl_property b inner join tbl_booking a
            on a.property_id = b.id inner join tbl_users c 
            on b.owner_id = c.id where b.owner_id = $owner_id and a.status = '" . $status_array . "'
                and month = '" . $month . "' and year = '" . $year . "' group by a.id";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    function previous_month_earn_detail($limit, $start) {
        $owner_id = $this->uri->segment(5);
        $month = $this->uri->segment(3) - 1;
        $year = $this->uri->segment(4);
        $status_array = serialize(array('bb' => 5, 'oo' => 5));
        $sql = "select a.*, b.title as prop_name, b.owner_id as bowner_id,
            c.first_name as fname, c.last_name as lname from tbl_property b inner join tbl_booking a  
            on a.property_id = b.id inner join tbl_users c  on b.owner_id = c.id 
            where b.owner_id = $owner_id and a.status = '" . $status_array . "' and
                month = '" . $month . "' and year = '" . $year . "'
                    order by a.requested_date desc limit $start, $limit";
        //echo $sql;exit();
        $query = $this->db->query($sql);
        return $query->result();
    }
    function record_previous_month_earn_filter() {
        $month = $this->input->post('month') - 1;
        $year = $this->input->post('year');
        $status_array = serialize(array('bb' => 5, 'oo' => 5));
        $sql = "select a.*,b.title as prop_name, b.owner_id as bowner_id,
            c.first_name as fname, c.last_name as lname from tbl_property b inner join tbl_booking a 
            on a.property_id = b.id inner join tbl_users c 
            on b.owner_id = c.id where a.status = '" . $status_array . "' and month = '" . $month . "' 
                and year = '" . $year . "' group by a.id";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
	*/
	function getsetting(){
        $query 		=	 $this->db->get('tbl_setting');
        return $query->result();
	}
	function addUpdateSetting(){
		$data = array(
			'government_tax'	=>		$this->input->post('gst'),
			'site_service_tax'	=>		$this->input->post('service_tax'),
			'site_title'		=>		$this->input->post('site_title'),
			'contact_email'		=>		$this->input->post('email'),
			'facebook_link'		=>		$this->input->post('facebook'),
			'twitter_link'		=>		$this->input->post('twitter'),
			'video_link'		=>		$this->input->post('video'),
			'meta_title'		=>		$this->input->post('meta_title'),
			'meta_keyword'		=>		$this->input->post('meta_keywords'),
			'meta_description'	=>		$this->input->post('meta_description')
		);
		if($this->input->post('setting_id') != ''):
				$this->db->update('tbl_setting', $data, array('id' => $this->input->post('setting_id')));
		else:
				$this->db->insert('tbl_setting', $data); 
		endif;
	}
    function record_count_testi()
    {
        $this->db->select('*');
        $this->db->from('tbl_testimonials');
        $result = $this->db->get();
        return count($result->result());
    }
    function get_all_testi($limit, $offset)
    {
        $this->db->select('tbl_testimonials.*, tbl_users.profile_picture');
		$this->db->join('tbl_users', 'tbl_testimonials.guest_name=tbl_users.username','left');
        //$this->db->from('tbl_testimonials');
        $this->db->limit($limit, $offset);
        $result = $this->db->get('tbl_testimonials');
        return $result->result();
    }
   function edit_testi($id) {
        $query = $this->db->get_where('tbl_testimonials', array('id' => $id));
        return $query->row();
	}
   function add_edit_testimonials()
   {
        $col_data = true;
        $data = array(
            'guest_name' => $this->input->post('guest_name'),
            'detail' => $this->input->post('detail'),
            'created_date' => date("Y-m-d H:i:s"),
        );
        if($this->input->post('testi_id') !=''):
            $this->db->update('tbl_testimonials', $data, array('id' => $this->input->post('testi_id')));
            $id = $this->input->post('testi_id');
        else:
            $this->db->insert('tbl_testimonials', $data);
            $id = $this->db->insert_id();
        endif;
        return $id;
   }
    function update_feature_img_testi($id, $img_name)
    {
        $data = array(
           'image' => $img_name
        );
	    $this->db->where('id', $id);
	    $this->db->update('tbl_testimonials', $data); 
    }
    function delete_testi()
    {
		$deleteid =	$this->uri->segment(3);
		$this->db->delete('tbl_testimonials', array('id' => $deleteid)); 
    }
    function get_all_subscriber()
    {
        $this->db->select('*');
        $this->db->from('tbl_email_subscriber');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
    function export_csv()
    {
        $this->db->select('*');
        $this->db->from('tbl_email_subscriber');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get(); 
        if(!$query)
            return false;
        $this->load->helper('Excel_helper');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true); 
        $objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('A1','FULL NAME');
        $objPHPExcel->getActiveSheet()->setCellValue('B1','EMAIL');
        $query_rs = $query->result();
        $newarrayx1 = array();
        $i = 0;
        foreach($query_rs as $qrs)
        {
             $arr_me = $this->arrayOprn($qrs);
             $arryx = (object) $arr_me;
             array_push($newarrayx1, $arryx);
        	$i++;
        }
        $fields = array('0' => 'Fullname', '1' => 'Email');
        $row = 2;
        foreach($newarrayx1 as $data)
        {
            $col = 0;
            foreach ($fields as $field)
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                $col++;
            }
            $row++;
        }
        $objPHPExcel->setActiveSheetIndex(0);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Subscriber_'.date('dMy').'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
    }
    function arrayOprn($arr)
    {
        $newarrayx->Fullname = $arr->full_name;
        $newarrayx->Email = $arr->email_subscriber;
        return $newarrayx;
    }

        function get_all_mail_templates()
        {
            return $this->db->get('tbl_email_template')->result();
        }
    
        function update_forget_mail_template(){
		$data = array('content' => $this->input->post('content'));
		$this->db->where('name', 'forget_password');
		$this->db->update('tbl_email_template', $data);
	}
	function edit_forget_mail_template(){
		$this->db->where('name','forget_password');
		$query = $this->db->get('tbl_email_template');
		return $query->row();
	}
	function update_reg_mail_template(){
		$data = array('content' => $this->input->post('content'));
		$this->db->where('name', 'reg_confirm');
		$this->db->update('tbl_email_template', $data);
	}
	function edit_reg_mail_template(){
		$this->db->where('name','reg_confirm');
		$query = $this->db->get('tbl_email_template');
		return $query->row();
	}
	function update_activated_mail_template	(){
		$data = array('content' => $this->input->post('content'));
		$this->db->where('name', 'registered');
		$this->db->update('tbl_email_template', $data);
	}
	function edit_activated_mail_template(){
		$this->db->where('name','registered');
		$query = $this->db->get('tbl_email_template');
		return $query->row();
	}
	function update_booking_mail_template_to_buyer(){
		$data = array('content' => $this->input->post('content'));
		$this->db->where('name', 'booking_email_to_buyer');
		$this->db->update('tbl_email_template', $data);
	}
	function edit_booking_mail_template_to_buyer(){
		$this->db->where('name','booking_email_to_buyer');
		$query = $this->db->get('tbl_email_template');
		return $query->row();
	}
	function update_booking_mail_template_to_owner(){
		$data = array('content' => $this->input->post('content'));
		$this->db->where('name', 'booking_email_to_owner');
		$this->db->update('tbl_email_template', $data);
	}
	function edit_booking_mail_template_to_owner(){
		$this->db->where('name','booking_email_to_owner');
		$query = $this->db->get('tbl_email_template');
		return $query->row();
	}
	function update_booking_direct_mail_template_to_buyer(){
		$data = array('content' => $this->input->post('content'));
		$this->db->where('name', 'booking_direct_email_to_buyer');
		$this->db->update('tbl_email_template', $data);
	}
	function edit_booking_direct_mail_template_to_buyer(){
		$this->db->where('name','booking_direct_email_to_buyer');
		$query = $this->db->get('tbl_email_template');
		return $query->row();
	}
	function update_booking_direct_mail_template_to_owner(){
		$data = array('content' => $this->input->post('content'));
		$this->db->where('name', 'booking_direct_email_to_owner');
		$this->db->update('tbl_email_template', $data);
	}
	function edit_booking_direct_mail_template_to_owner(){
		$this->db->where('name','booking_direct_email_to_owner');
		$query = $this->db->get('tbl_email_template');
		return $query->row();
	}
        function get_email_template($name){
		$this->db->where('name',$name);
		$query = $this->db->get('tbl_email_template');
		return $query->row();
	}
        function update_email_template($name){
		$data = array('content' => $this->input->post('content'));
		$this->db->where('name', $name);
		$this->db->update('tbl_email_template', $data);
	}
	function get_menuSections(){
		$query = $this->db->get('tbl_menu_sections');
		if ($query->num_rows() > 0)
			return $query->result();
		else
			return NULL;
	}
	function add_new_menu_section(){
		$data = array('name' => $this->input->post('section_name'),
					'status' => $this->input->post('status'));
		$this->db->insert('tbl_menu_sections', $data);
		return $this->db->insert_id();
	}
	function get_menuInfo($section_id){
		$this->db->join('tbl_menu_sections', 'tbl_menu_sections.id=tbl_menu_items.section_id', 'LEFT');
		$this->db->where('tbl_menu_items.section_id', $section_id);
		$this->db->where('tbl_menu_items.status','1');
		$this->db->order_by('tbl_menu_items.order', 'ASC');
		$this->db->select('tbl_menu_items.*, tbl_menu_sections.name as section_name');
		$query = $this->db->get('tbl_menu_items');
		if ($query->num_rows() > 0)
			return $query->result();
		else
			return NULL;
	}
	function updateMenu(){
		$data = array('status' => '0');
		$this->db->where('section_id', $this->input->post('menu_id'));
		$this->db->update('tbl_menu_items', $data);
		
		$names = $this->input->post('name');
		$links = $this->input->post('link');
		$ids = $this->input->post('item_id');
		for ($i=0; $i<count($this->input->post('item_id')); $i++){
			$data = array('name' => $names[$i],
						'link' => $links[$i],
						'order' => $i,
						'status' => '1');
			$this->db->where('id', $ids[$i]);
			$this->db->update('tbl_menu_items', $data);
		}
	}
	function add_new_menu_item(){
		$data = array('name' => $_REQUEST['name'],
					'link' => $_REQUEST['link'],
					'section_id' => $_REQUEST['menu_id'],
					'order' => '99',
					'status' => '0'
		);
		$this->db->insert('tbl_menu_items', $data);
		return $this->db->insert_id();
	}
	function disable_menu_item(){
		$data = array('status' => '0');
		$this->db->where('id', $_REQUEST['item_id']);
		$this->db->update('tbl_menu_items', $data);
		return 'success';
	}
	function get_menu_section($id){
		$this->db->where('id', $id);
		$query = $this->db->get('tbl_menu_sections');
		if ($query->num_rows() > 0)
			return $query->row();
		else
			return NULL;
	}
	// Report Escapes Code By Syarif Hidayat
	function report_escapes($where=array())
    {
        $this->db->select('tp.*, tu.first_name, tu.last_name');
		$this->db->from('tbl_property tp');
		$this->db->join('tbl_users tu','tp.owner_id = tu.id');
		if(is_array($where)){
			$this->db->where($where);
		}
		
		$query = $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return FALSE;
		}
    }	
	function report_bookings($where=array())
    {
        $this->db->select('tb.*, tp.title, tp.owner_id, tu.first_name, tu.last_name, tg.first_name as first_gname, tg.last_name as last_gname');
		$this->db->from('tbl_booking tb');
		$this->db->join('tbl_property tp','tb.property_id = tp.id');
		$this->db->join('tbl_users tu','tp.owner_id = tu.id');
		$this->db->join('tbl_users tg','tb.user_id = tg.id');
		if(is_array($where)){
			$this->db->where($where);
		}
		
		$query = $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return FALSE;
		}
    }
	function report_income_sum($where=array())
    {		
		$this->db->select_sum('total_price');
		$this->db->from('tbl_booking tb');
		$this->db->join('tbl_property tp','tb.property_id = tp.id');
		$this->db->join('tbl_users tu','tp.owner_id = tu.id');
		$this->db->join('tbl_users tg','tb.user_id = tg.id');
		if(is_array($where)){
			$this->db->where($where);
		}
		
		$query = $this->db->get();
		if ($query->num_rows() > 0){
			return $query->row_array();
		}else{
			return FALSE;
		}
    }
	// End Code By Syarif Hidayat	
	//*************************************************************************//
	/**
	 * Function to Delete Category
	 *
	 */
	function deleteCategoryByAdmin(){
		$data = array('category_status' => '2');
		$this->db->where('id', $_POST['category_id']);
		if($this->db->update('tbl_category', $data)){
			return 1; 
		}else{
			return 0; 
		}
	}
	/**
	 * Function to Update Category Name
	 *
	 */
	function updateCategoryName(){
		$data = array('category_title' => $_POST['category_title']);
		$this->db->where('id', $_POST['category_id']);
		if($this->db->update('tbl_category', $data)){
			return 1; 
		}else{
			return 0; 
		}
	}
	/**
	 * Function to UPDATE PROPERTY Amenities
	 *
	 */
	function updateFacilities(){
		$data = array('name' => $_POST['facility_name'],'description' => $_POST['facility_desc']);
		$this->db->where('id', $_POST['id']);
		if($this->db->update('tbl_amenities', $data)){
			return 1; 
		}else{
			return 0; 
		}
	}
	/**
	 * Function to Delete Update
	 *
	 */
	function deleteUpdate(){
		
		$value = 2;
		$table_name = $_POST['table_name'];
		$field_name = $_POST['field_name'];
		$id = $_POST['id'];
		
		$data = array($field_name => $value);
		$this->db->where('id', $id);
		if($this->db->update($table_name, $data)){
			return 1; 
		}else{
			return 0; 
		}
	}
	/**
	 * Function to UPDATE SKY TV
	 *
	 */
	function updateSkyTv(){
		$data = array('name' => $_POST['tv_name'],'description' => $_POST['tv_desc'],'television_type' => $_POST['television_type']);
		$this->db->where('id', $_POST['id']);
		if($this->db->update('tbl_sky_channels', $data)){
			return 1; 
		}else{
			return 0; 
		}
	}
	/**
	 * Function to Update Status
	 *
	 */
	function updateStatus(){
		
		$value = $_POST['value'];
		$table_name = $_POST['table_name'];
		$field_name = $_POST['field_name'];
		$id = $_POST['id'];
		
		$data = array($field_name => $value);
		$this->db->where('id', $id);
		if($this->db->update($table_name, $data)){
			return 1; 
		}else{
			return 0; 
		}
	}
		/**
		* Function to Insert Facilities
		*
		*/
		function insertFacilities(){
			$data = array('name' => $_POST['name'],
						'description' => $_POST['desc'],
						'status' =>  $_POST['status'] );
			if($this->db->insert('tbl_amenities', $data)){
				return 1;
			}else{
				return 0;
			}
		}
		/**
		* Function to Insert Categories
		*
		*/
		function insertCategory(){
			$data = array('category_title' => $_POST['category_name'],
						'category_status' =>  $_POST['status'] );
			if($this->db->insert('tbl_category', $data)){
				return 1;
			}else{
				return 0;
			}
		}
		/**
		* Function to Insert SKY TV CHANNELS
		*
		*/
		function insertTvChannel(){
			$data = array('name' => $_POST['name'],
						'description' => $_POST['desc'],
						'status' =>  $_POST['status'],
						'television_type' => $_POST['television_type']
						);
			if($this->db->insert('tbl_sky_channels', $data)){
				return 1;
			}else{
				return 0;
			}
		}
		/**
		* Function to INSERT OR CHECK STATUS VALUE 7 in tables
		* for saving new row's for datatables.
		*/
		function checkStatus7($table_name,$field_name){
			$value = 7; // status used to insert new row in datatables.js
			$result =  $this->db->get_where($table_name, array($field_name => $value))->row_array();
			
			if( count($result) > 0 ){
			
				return 1;
				
			}else{
			
				$data = array($field_name => $value);
				if($this->db->insert($table_name, $data)){
					return 1;
				}else{
					return 0;
				}
			}
		}
		/**
		* Function to get Escape Images
		* 
		*/
		function getEscapeImages($escape_id){
			
			$sql_query = "SELECT * FROM tbl_property_images WHERE  property_id = '$escape_id' ORDER BY id DESC ";
			$query = $this->db->query($sql_query);
			$return_result = $query->result();
			
			return $return_result;

		}
		
		/**
		* Function to SAVE ESCAPE GALLERY IMAGES.
		* 
		*/
		function uploadEscapeImages($escape_id,$image_name){
			$table_name = "tbl_property_images";
		
			$data = array("property_id"=> $escape_id,"image"=>$image_name,"status"=>0);
			
				if($this->db->insert($table_name, $data)){
					return 1;
				}
		}
		/**
		* Function to Delete Escape Images.
		*
		*/
		function deleteEscapeImages($escape_id,$image_name){
		  $this->db->where('property_id', $escape_id);
		  $this->db->where('image', $image_name);
		  if($this->db->delete('tbl_property_images')){
			return 1;
		  }
		}
		
		/**
		* Function to get TV Categories
		* 
		*/
		function getTvCategories(){
			
			$sql_query = "SELECT * FROM tbl_tv_channels WHERE  status = '1' ORDER BY id ";
			$query = $this->db->query($sql_query);
			$return_result = $query->result();
			
			return $return_result;

		}
		/**
		 * Function TO ADD TV CATEGORIES.
		 *
		 */
		function addTvCategory(){
			$table_name = "tbl_tv_channels";
			$data = array("tv_category"=>$_POST['category_name'],"status"=>1);
				if($this->db->insert($table_name, $data)){
					return 1;
				}
		}
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////	
}