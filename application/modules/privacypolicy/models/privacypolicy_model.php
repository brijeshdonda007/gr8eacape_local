<?php

class Privacypolicy_model extends CI_Model{
    function getPrivacyPolicy($id){
        $query = $this->db->get_where('tbl_pages', array('id'=> $id));
        $result = $query->row();
        return $result;
    }
    function getUserInfo($user_id)
    {
        $query = $this->db->get_where('tbl_users', array('id' => $user_id));
        return $query->row();
    }
}
