<?php

class Contactsupport_model extends CI_Model{
    function gethowitworks($id){
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
