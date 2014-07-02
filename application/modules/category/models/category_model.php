<?php

class Category_model extends CI_Model{

    function getAllCategory()

    {

       $sql = "select COUNT(p.id) as cp, c.* from tbl_property p inner join tbl_category c on p.category_id = c.id group by c.id order by cp desc";

       $query = $this->db->query($sql);

       return $query->result(); 

    }

    function getUserInfo($user_id)

    {

        $query = $this->db->get_where('tbl_users', array('id' => $user_id));

        return $query->row();

    }

    

    function getPropertyByCategory($category_id, $start, $limit)

    {

        $this->db->where('tbl_property_cats.category_id',$category_id);

        $this->db->select('tbl_property.id,tbl_property.admin_action,tbl_property.title,tbl_property.featured_image, tbl_property.owner_id,tbl_property.price_night,tbl_property.custom_url, tbl_users.profile_picture,tbl_users.first_name, tbl_country.short_name');

        $this->db->from('tbl_property');

        $this->db->join('tbl_property_cats','tbl_property.id=tbl_property_cats.property_id','INNER');

        $this->db->join('tbl_users','tbl_property.owner_id=tbl_users.id','INNER');

		$this->db->join('tbl_country', 'tbl_property.country_id=tbl_country.id', 'LEFT');

        $this->db->group_by("tbl_property.id"); 

        $this->db->order_by('tbl_property.visited_count', 'desc');

        $this->db->order_by('tbl_property.visited_count', 'desc');

        $this->db->limit( $start, $limit );

        $query = $this->db->get();

         return $query->result();

    }

    

    function get_count_property_by_category($category_id)

    {

        $this->db->where('tbl_property_cats.category_id',$category_id);

        $this->db->select('*');

        $this->db->from('tbl_property');

        $this->db->join('tbl_property_cats','tbl_property.id=tbl_property_cats.property_id','INNER');

        $this->db->join('tbl_users','tbl_property.owner_id=tbl_users.id','INNER');

        

        $query = $this->db->get();

        return $query->num_rows();

    }

    

     function getAllRateCategory()

    {

        $query = $this->db->get('tbl_review_category');

        return $query->result();

    }

      function avgRateByCatID($rcatid, $property_id)

    {

        $sql = "select AVG(ratings) as avgr from tbl_property_review

          where property_id = " . $property_id . " and rcatid = ".$rcatid;

        $query = $this->db->query($sql);

        return $query->row();

    }

    

    function geAllReviews($property_id)

    {

        $sql = "select a.*, b.id as uid , b.first_name as ufname, b.last_name as ulname,

            b.profile_picture as upic from tbl_users b inner join tbl_reviews a

            on b.id = a.user_id

          where a.property_id = " . $property_id . " order by a.created_date desc";

        $query = $this->db->query($sql);

        return $query->result();

    }

    

    function get_category_byID($catid)

    {

        $query = $this->db->get_where('tbl_category', array('id' => $catid));

        return $query->row();

    }

    

    function get_all_category()

    {

              /*   $sql = "SELECT COUNT(c.id) as numberc, c.id as catid, c.category_title, p.id as property_id

                FROM

                tbl_category c

                INNER JOIN tbl_property_cats pc 

                    ON (c.id = pc.category_id)

                INNER JOIN tbl_property p

                ON (pc.property_id = p.id) WHERE c.category_status = 1 AND p.property_status = 1 GROUP BY c.id;"; */
				
				//$sql = "SELECT tbl_category.category_title as category_title,tbl_category.id as catid,COUNT(tbl_property_cats.id) AS numberc FROM tbl_category,tbl_property_cats WHERE tbl_category.id = tbl_property_cats.category_id AND tbl_category.category_status = 1 GROUP BY tbl_category.id ORDER BY tbl_category.id ASC";
				
				$sql = "SELECT tbl_category.category_title as category_title,tbl_category.id as catid,COUNT(tbl_property.id) AS numberc FROM tbl_category,tbl_property_cats LEFT JOIN tbl_property ON tbl_property.id = tbl_property_cats.property_id  WHERE tbl_category.id = tbl_property_cats.category_id  AND tbl_category.category_status = 1 GROUP BY tbl_category.id ORDER BY numberc DESC";
				
                $query = $this->db->query($sql);
                return $query->result();

    }

}
