<?php

class Contactus_model extends CI_Model{
    function getUserInfo($user_id)
    {
        $query = $this->db->get_where('tbl_users', array('id' => $user_id));
        return $query->row();
    }
}
