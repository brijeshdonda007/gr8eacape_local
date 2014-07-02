<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accesscontrol_helper
{
     function is_logged_in_front()
     {
        $CI           =& get_instance();
        $is_logged_in = $CI->session->userdata('user_id');

        if(!isset($is_logged_in) || $is_logged_in != true) {
         print"<script>window.location='". site_url('login/index') ."'</script>";
         die();
        }
     }
 
    function getUserInfo($user_id)
    {
        $CI =& get_instance();
        $query = $CI->db->get_where('tbl_users', array('id' => $user_id));
        return $query->row();
    }
    
    function get_earnings()
    {
        $CI             =& get_instance();
        $user_id        = $CI->session->userdata('user_id');
        $month          =  date("m") - 1;
        $year           = date("Y");
        $status_array   = serialize(array('bb' => 5,'oo' => 5));

        $sql = "select sum(a.total_price) as grand_total
                from tbl_property b
                inner join tbl_booking a on a.property_id = b.id
                inner join tbl_users c on b.owner_id = c.id
                where c.id = " . $user_id . " and a.status = '" . $status_array . "' and month = '".$month."' and year = '".$year."'";
        $query = $CI->db->query($sql);

        return $query->row();
    }
 }