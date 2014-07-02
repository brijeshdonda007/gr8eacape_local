<?php
class Groups_model extends CI_Model{
	function all_groups($limit, $start)
	{
		$sql = "select * from tbl_usergroup order by id DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function record_count_all_groups()
	{
		$sql = "select * from tbl_usergroup";
		$query = $this->db->query($sql);
		return $query->num_rows();
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
}
