<?php

class Forgotpassword_model extends CI_Model { 
	function __construct()
	{
		parent::__construct();
	}
	function check_email_forget($email)
	{
		$sql="SELECT id FROM tbl_users WHERE email='$email' ";
		$query = $this->db->query($sql);
		if($query->num_rows()>0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	function get_email_forget($str)
	{
		$sql="SELECT * FROM tbl_users WHERE email='$str' ";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	function update_password($email)
	{
		$password = hash('sha256', $this->input->post('password'));
		$data=array('password'=>$password);
		$this->db->where('email',$email);
		$this->db->update('tbl_users',$data);
	}
	function incrypt($pwd)
	{
		$temp="greatescapes";
		$a=md5(sha1($temp.$pwd));
		return $a;
	}
}
