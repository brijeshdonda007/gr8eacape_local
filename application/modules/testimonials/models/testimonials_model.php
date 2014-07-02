<?php

class Testimonials_model extends CI_Model{
    function getUserInfo($user_id)
    {
        $query = $this->db->get_where('tbl_users', array('id' => $user_id));
        return $query->row();
    }
    function get_all_testi($limit, $offset)
    {
        $this->db->select('tbl_testimonials.*, tbl_users.profile_picture');
		$this->db->join('tbl_users', 'tbl_testimonials.guest_name=tbl_users.username','left');
        //$this->db->from('tbl_testimonials');
        $this->db->limit( $limit );
        $this->db->offset( $offset );
        $result = $this->db->get('tbl_testimonials');
        return $result->result();
    }
    function record_count_testi()
    {
        $this->db->select('*');
        $this->db->from('tbl_testimonials');
        $result = $this->db->get();
        return count($result->result());
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
   function edit_testi($id) {
        $query = $this->db->get_where('tbl_testimonials', array('id' => $id));
        return $query->row();
	}
    function update_feature_img($id, $img_name)
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
}