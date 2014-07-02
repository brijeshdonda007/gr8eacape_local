<?php

class Owner_model extends CI_Model {	

	function ownerDetail($ownerid){

			$query			=	$this->db->get_where('tbl_users', array('id' => $ownerid));				

			return $query->row();

	}

	function getUserInfo($user_id)

        {

            $query = $this->db->get_where('tbl_users', array('id' => $user_id));

            return $query->row();

        }

		

        function getCityByID($id) {

                $query			=	$this->db->get_where('tbl_city', array('id' => $id));				

                return $query->row();

        }

          function getCountryByID($id) {

                $query			=	$this->db->get_where('tbl_users_country', array('id' => $id));				

                return $query->row();

        }

        

         function getPropertyByOwner($owner_id)

        {

            $sql = "select * from tbl_property where owner_id = " . $owner_id ." and admin_action != 'pending' and admin_action != 'declined'";

            $query = $this->db->query($sql);

            return $query->result();

        }

        

        function get_user_ratings_category()

        {

            $sql = "select * from tbl_users_ratings_category order by id asc";

            $query = $this->db->query($sql);

            return $query->result();

        }

        

    function addReview()

    {

        $user_id = $this->input->post('user_id');

        $user_id_by = $this->session->userdata('user_id');

        $data = array('user_id' => $user_id, 'user_id_by' => $user_id_by,

            'reviews' => $this->input->post('limitedtextarea'),

            'created_date' => date('Y-m-d H:i:s'));

        $this->db->insert('tbl_users_reviews', $data);

        return $this->db->insert_id();

        

    }

    

    function getReviewByUser($user_id)

    {

        $user_id_by = $this->session->userdata('user_id');

        $sql = "select * from tbl_users_reviews where user_id = '".$user_id."' and user_id_by = '".$user_id_by."'";

        $query = $this->db->query($sql);

        return $query->num_rows();

    }

    function hasRatedAllCats($property_id)

    {

        $user_id = $this->session->userdata('user_id');

        $allcats = $this->getAllRateCategory();

        $allcats_count = count($allcats);

        $nums=0;

        foreach($allcats as $alc)

        {

            $nums += $this->isRatedByUsr($property_id, $alc->id);

        }

        if($allcats_count == $nums)

        {

            return 1;

        }

        else

        {

            return 0;

        }

    }

    function getAllRateCategory()

    {

        $query = $this->db->get('tbl_users_ratings_category');

        return $query->result();

    }

    

    function isRatedByUsr($user_id, $rcatid)

    {

        $user_id_by = $this->session->userdata('user_id');

        $sql = "select * from tbl_users_rate_review

          where user_id = $user_id and rcatid = $rcatid and user_id_by = $user_id_by";

        $query = $this->db->query($sql);

        return $query->num_rows();

    }

    

    function has_booked_by_user($user_id)

    {   

        $owner_id = $this->session->userdata('user_id');

        $status_array = serialize(array('bb' => 5,'oo' => 5));

        $sql = "select * from tbl_booking where user_id = $user_id and status = '$status_array'";

        $query = $this->db->query($sql);

        $result = $query->result();

        $owner_id_arr = $this->get_related_owner_id($result);

        //print_r($owner_id_arr);exit();

        if(!empty($owner_id_arr))

        {

            if(in_array($owner_id, $owner_id_arr))

            {

                return 1;

            }

            else

            {

                return 0;

            }

        }

        

    }

    function get_related_owner_id($arrx)

    {

        $arr = array();

        $i = 0;

        foreach($arrx as $a)

        {

            $sql = 'select * from tbl_property where id = ' . $a->property_id;

            $query = $this->db->query($sql);

            $result = $query->row();

            $owner_id = $result->owner_id;

            $arr[$i] = $owner_id;

        $i++;}

        return $arr;

    }

    function getTotalRate()

    {

        $user_id = $this->uri->segment(3);

        $sql = "select * from tbl_users_rate_review

            where user_id = " . $user_id . "";

        $query = $this->db->query($sql);

        return $query->result();

        

    }

    

    

     function geAllReviews($user_id)

    {

        $sql = "select a.*, b.id as uid , b.first_name as ufname, b.last_name as ulname,

            b.profile_picture as upic from tbl_users b inner join tbl_users_reviews a

            on b.id = a.user_id_by

          where a.user_id = " . $user_id . " order by a.created_date desc";

        $query = $this->db->query($sql);

        return $query->result();

    }

    function avgRateByCatID($rcatid, $user_id)

    {

       

        $sql = "select AVG(ratings) as avgr from tbl_users_rate_review

        where user_id = " . $user_id . " and rcatid = ".$rcatid;

        $query = $this->db->query($sql);

        return $query->row();

    }

    

    function all_property_by_ownerID($user_id)

        {

            $sql = 'select * from tbl_property where owner_id = ' . $user_id;

            $query = $this->db->query($sql);

            return $query->result();

        }

        

         function is_rated_propCheck($propid)

        {

            $sql = 'select * from tbl_property_review where property_id = ' . $propid;

            $query = $this->db->query($sql);

            $arr = $query->num_rows();

            if($arr > 0)

            {

                return 1;

            }

            else {

                return 0;

            }

           

        }

        

        function is_rated_prop($propid)

        {

            $sql = 'select * from tbl_property_review where property_id = ' . $propid;

            $query = $this->db->query($sql);

            return count($query->result());

           

        }

        function get_rate_by_propID($prop_id)

        {

            $reviews_cat = $this->get_all_reviews_cat();

            $total_avgt = 0;

            foreach($reviews_cat as $rc)

            {

                $sql = "select AVG(ratings) as avgr from tbl_property_review

                    where property_id = " . $prop_id . " and rcatid = ".$rc->id;

                $query = $this->db->query($sql);

                $eachcat_avg_rate =  $query->row();

                

                $total_avgt +=  $eachcat_avg_rate->avgr;

            }

            return $total_avgt;

            

           

        }

         function get_all_reviews_cat()

        {

            $sql = 'select * from tbl_review_category';

            $query = $this->db->query($sql);

            return $query->result();

        }

        

        function getOwnerEscapes($owner_id)

        {
            $sql = "Select a.*, b.first_name as owner_name, b.profile_picture as owner_pic from tbl_property a inner join tbl_users b on a.owner_id=b.id where a.owner_id = ".$owner_id." and property_status = 0";

            $query = $this->db->query($sql);

            return $query->result();
        }

        

        function get_count_property($owner_id)

        {

            $sql = "Select a.*, b.first_name as owner_name, b.profile_picture as owner_pic from tbl_property a inner join tbl_users b on a.owner_id=b.id where a.owner_id = ".$owner_id." and property_status = 0 group by a.id";

            $query = $this->db->query($sql);

            return $query->num_rows();
        }

     function getAllRateCategory_prop()

    {

        $query = $this->db->get('tbl_review_category');

        return $query->result();

    }

    

     function avgRateByCatID_prop($rcatid, $property_id)

    {

        $sql = "select AVG(ratings) as avgr from tbl_property_review

          where property_id = " . $property_id . " and rcatid = ".$rcatid;

        $query = $this->db->query($sql);

        return $query->row();

    }

    

    function geAllReviews_prop($property_id)

    {

        $sql = "select a.*, b.id as uid , b.first_name as ufname, b.last_name as ulname,

            b.profile_picture as upic from tbl_users b inner join tbl_reviews a

            on b.id = a.user_id

          where a.property_id = " . $property_id . " order by a.created_date desc";

        $query = $this->db->query($sql);

        return $query->result();

    }

}