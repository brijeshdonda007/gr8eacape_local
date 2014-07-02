<?php

class Order_model extends CI_Model{

    

    function all_bookings($limit, $start)

    {

        $status_array = serialize(array('bb' => 5,'oo' => 5));

        $sql = "select a.*,b.title as prop_name, b.owner_id as owner_id, c.first_name as fname, c.last_name as lname from tbl_property b inner join tbl_booking a

        on a.property_id = b.id inner join tbl_users c 

        on a.user_id = c.id where a.status = '" . $status_array . "' order by a.requested_date desc limit $start, $limit";

        $query = $this->db->query($sql);

        return $query->result();

    }

     function record_count_bookings()

    {

        $status_array = serialize(array('bb' => 5,'oo' => 5));

        $sql = "select a.*,b.title as prop_name, b.owner_id as owner_id, c.first_name as fname, c.last_name as lname from tbl_property b inner join tbl_booking a

        on a.property_id = b.id inner join tbl_users c 

        on a.user_id = c.id where a.status = '" . $status_array . "'";

        $query = $this->db->query($sql);

        return $query->num_rows();

    }

    

    function getUserInfo($user_id)

    {

        $query = $this->db->get_where('tbl_users', array('id' => $user_id));

        return $query->row();

    }

}