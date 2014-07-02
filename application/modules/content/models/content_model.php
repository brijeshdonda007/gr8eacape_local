<?php

class Content_model extends CI_Model{
    function getcontentbyurl($id){
        $query = $this->db->select('*')->get_where('tbl_pages', array('url'=> $id));
        $result = $query->row();
        return $result;
    }
    function getUserInfo($user_id)
    {
        $query = $this->db->get_where('tbl_users', array('id' => $user_id));
        return $query->row();
    }
}
