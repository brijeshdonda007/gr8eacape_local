<?php

class Search_model extends CI_Model{

      function loadBanners(){

        $status     =       1;

        $query      =       $this->db->order_by('banner_title','random');

        $query      =       $this->db->get_where('tbl_banner', array('banner_status'=>$status));

        $result     =       $query->result();

        return $result;

    }

    function getSearchResults($start, $limit)

    {

       

        if($_POST)

        {

        $keywords = trim($this->input->post('searchq'));

        }

        else

        {

        $link = $this->uri->segment(3);

        $search_param=base64_decode(urldecode($link));

        

            $array_search_param = array();

            $elems = explode("&", $search_param);

            foreach($elems as $elem){

                $items = explode("=", $elem);

                $array_search_param[$items[0]] = $items[1];

            }



        

        $keywords = $array_search_param['keywords'];

        }

            

            $sql = "select * from tbl_property where title like '%$keywords%' 

                or country_id=(select id from tbl_country where country_name like '%$keywords%') 

                    or city_id=(select id from tbl_city where city_name like '%$keywords%') 

                         or postcode like '%$keywords%' 

                             and admin_action != 'pending' and admin_action != 'declined' and property_status = 1 order by visited_count desc limit $limit, $start";

        $query = $this->db->query($sql);

        return $query->result();

        

    }

    function getAllSearchedCount()

    {

        if($_POST)

        {

        $keywords = trim($this->input->post('searchq'));

        }

        else

        {

        $link = $this->uri->segment(3);

        $search_param=base64_decode(urldecode($link));

        

            $array_search_param = array();

            $elems = explode("&", $search_param);

            foreach($elems as $elem){

                $items = explode("=", $elem);

                $array_search_param[$items[0]] = $items[1];

            }



        

        $keywords = $array_search_param['keywords'];

        }

        

        $sql = "select * from tbl_property where title like '%$keywords%' 

            or country_id=(select id from tbl_country where country_name like '%$keywords%') 

                or city_id=(select id from tbl_city where city_name like '%$keywords%') 

                    or postcode like '%$keywords%' 

                        and admin_action != 'pending' and admin_action != 'declined' and property_status = 1";

        

        $query = $this->db->query($sql);

        return $query->num_rows();

    }

    function getRefineSearchResults($start, $limit)
    {
        if($_POST)
        {
	        $keywords = trim($this->input->post('keywords'));
	        $country_id = $this->input->post('country_id');
	        $region_id = $this->input->post('region_id');
	        $city_id = $this->input->post('city_id');
	        $suburb_id = $this->input->post('suburb_id');
	        $category_id = $this->input->post('category_id');
	        $start_date = $this->input->post('start_date');
	        $end_date = $this->input->post('end_date');
	        $adult = $this->input->post('adult');
	        $children = $this->input->post('children');
	        $bedroom = $this->input->post('bedroom');
	        $bathroom = $this->input->post('bathroom');
	        $pet = $this->input->post('pet');
        }
        else
        {
	        $link = $this->uri->segment(3);
	        $search_param=base64_decode(urldecode($link));
	            $array_search_param = array();
	            $elems = explode("&", $search_param);
	            foreach($elems as $elem){
	                $items = explode("=", $elem);
	                $array_search_param[$items[0]] = $items[1];
	            }
	        $keywords = $array_search_param['keywords'];
	        $country_id = $array_search_param['country_id'];
	        $region_id = $array_search_param['rregion_id'];
	        $city_id = $array_search_param['city_id'];
	        $suburb_id = $array_search_param['suburb_id'];
	        $category_id = $array_search_param['category_id'];
	        $start_date = $array_search_param['start_date'];
	        $end_date = $array_search_param['end_date'];
	        $adult = $array_search_param['adult'];
	        $children = $array_search_param['children'];
	        $bedroom = $array_search_param['bedroom'];
	        $bathroom = $array_search_param['bathroom']; 
	        $pet = $array_search_param['pet']; 
        }
        $this->db->where('tbl_property.admin_action !=', 'pending');
        $this->db->where('tbl_property.admin_action !=', 'declined');
        //$this->db->where('tbl_property.property_status', '1');
        if($keywords != ''){
            $this->db->like('tbl_property.title',$keywords);
        }
        if($country_id > 0){
            $this->db->where('tbl_property.country_id',$country_id);
        }
        if($region_id > 0){
            $this->db->where('tbl_property.region_id',$region_id);
        }
        if($city_id > 0){
            $this->db->where('tbl_property.city_id',$city_id);
        }
        if($suburb_id > 0)
        {
            $this->db->where('tbl_property.suburb_id',$suburb_id);
        }
        if($category_id != '')
        {
            foreach($category_id as $catid)
            {
            $this->db->where('tbl_property_cats.category_id',$catid);
            }
        }
        if(($start_date != '') and ($end_date != ''))
        {
            $status_array = serialize(array('bb' => 5,'oo' => 5));
            $this->db->where("tbl_booking.status !=", $status_array);
            $this->db->where("tbl_booking.start_date NOT BETWEEN $start_date AND $end_date");
            $this->db->where("tbl_booking.end_date NOT BETWEEN $start_date AND $end_date");
//            $this->db->where('tbl_booking.start_date >=',$start_date);
//            $this->db->where('tbl_booking.end_date <=',$end_date);
        }
         if($adult > 0){
            $this->db->where('tbl_property.adult',$adult);
        }
        if($children > 0){
            $this->db->where('tbl_property.children',$children);
        }
        if($bedroom > 0){
            $this->db->where('tbl_property.bedroom',$bedroom);
        }
        if($bathroom > 0){
            $this->db->where('tbl_property.bathroom',$bathroom);
        }
        if($pet > 0){
            $this->db->where('tbl_property.pet',$pet);
        }
        $this->db->select('tbl_property.id,tbl_property.admin_action,tbl_property.country_id,tbl_property.region_id,
            tbl_property.city_id,tbl_property.owner_id,tbl_property.title,tbl_property.featured_image,tbl_property.custom_url,
            tbl_property.featured_image,tbl_property.price_night,tbl_users.id as user_id, tbl_users.profile_picture,tbl_users.first_name, tbl_country.short_name');
        $this->db->from('tbl_property');
        $this->db->join('tbl_booking','tbl_property.id=tbl_booking.property_id','INNER');
        $this->db->join('tbl_users','tbl_property.owner_id=tbl_users.id','INNER');
        $this->db->join('tbl_property_cats','tbl_property.id=tbl_property_cats.property_id','INNER');
		$this->db->join('tbl_country', 'tbl_property.country_id=tbl_country.id', 'LEFT');
        $this->db->group_by("tbl_property.id"); 
        $this->db->order_by('tbl_property.visited_count', 'desc');
        $this->db->limit( $start, $limit );
        //echo $this->db->last_query();exit();
        $result = $this->db->get();
        return ($result->result());
    }

    function getRefineSearchedCount()
    {
        if($_POST){
	        $keywords = trim($this->input->post('keywords'));
	        $country_id = $this->input->post('country_id');
	        $region_id = $this->input->post('region_id');
	        $city_id = $this->input->post('city_id');
	        $suburb_id = $this->input->post('suburb_id');
	        $category_id = $this->input->post('category_id');
	        $start_date = $this->input->post('start_date');
	        $end_date = $this->input->post('end_date');
	        $adult = $this->input->post('adult');
	        $children = $this->input->post('children');
	        $bedroom = $this->input->post('bedroom');
	        $bathroom = $this->input->post('bathroom');
	        $pet = $this->input->post('pet');
        }else{
	        $link = $this->uri->segment(3);
	        $search_param=base64_decode(urldecode($link));
            $array_search_param = array();
            $elems = explode("&", $search_param);
            foreach($elems as $elem){
                $items = explode("=", $elem);
                $array_search_param[$items[0]] = $items[1];
            }
	        $keywords = $array_search_param['keywords'];
	        $country_id = $array_search_param['country_id'];
	        $region_id = $array_search_param['rregion_id'];
	        $city_id = $array_search_param['city_id'];
	        $suburb_id = $array_search_param['suburb_id'];
	        $category_id = $array_search_param['category_id'];
	        $start_date = $array_search_param['start_date'];
	        $end_date = $array_search_param['end_date'];
	        $adult = $array_search_param['adult'];
	        $children = $array_search_param['children'];
	        $bedroom = $array_search_param['bedroom'];
	        $bathroom = $array_search_param['bathroom'];
	        $pet = $array_search_param['pet'];
        }
        $where = array();
        $this->db->where('tbl_property.admin_action !=', 'pending');
        $this->db->where('tbl_property.admin_action !=', 'declined');
        //$this->db->where('tbl_property.property_status', '1');
        if($keywords != ''){
            $this->db->like('tbl_property.title',$keywords);
        }
        if($country_id > 0){
            $this->db->where('tbl_property.country_id',$country_id);
        }
        if($region_id > 0){
            $this->db->where('tbl_property.region_id',$region_id);
        }
        if($city_id > 0){
            $this->db->where('tbl_property.city_id',$city_id);
        }
        if($suburb_id > 0)
        {
            $this->db->where('tbl_property.suburb_id',$suburb_id);
        }
        if($category_id != '')
        {
            foreach($category_id as $catid)
            {
            $this->db->where('tbl_property_cats.category_id',$catid);
            }
        }
        if(($start_date != '') and ($end_date != ''))
        {
            $status_array = serialize(array('bb' => 5,'oo' => 5));
            $this->db->where("tbl_booking.status !=", $status_array);
            $this->db->where("tbl_booking.start_date NOT BETWEEN $start_date AND $end_date");
            $this->db->where("tbl_booking.start_date NOT BETWEEN $start_date AND $end_date");
            $this->db->where("tbl_booking.end_date NOT BETWEEN $start_date AND $end_date");
        }
         if($adult > 0){
            $this->db->where('tbl_property.adult',$adult);
        }
        if($children > 0){
            $this->db->where('tbl_property.children',$children);
        }
        if($bedroom > 0){
            $this->db->where('tbl_property.bedroom',$bedroom);
        }
        if($bathroom > 0){
            $this->db->where('tbl_property.bathroom',$bathroom);
        }
        if($pet > 0){
            $this->db->where('tbl_property.pet',$pet);
        }
        $this->db->select('tbl_property.id,tbl_property.admin_action,tbl_property.country_id,tbl_property.region_id,tbl_property.city_id,tbl_property.title,tbl_property.featured_image,tbl_property.featured_image,tbl_property.price_night,tbl_users.profile_picture,tbl_users.first_name');
        $this->db->from('tbl_property');
        $this->db->join('tbl_booking','tbl_property.id=tbl_booking.property_id','INNER');
        $this->db->join('tbl_users','tbl_property.owner_id=tbl_users.id','INNER');
        $this->db->join('tbl_property_cats','tbl_property.id=tbl_property_cats.property_id','INNER');
        $this->db->group_by("tbl_property.id"); 
        $this->db->order_by('tbl_property.visited_count', 'desc');
        //echo $this->db->last_query();exit();
        $result = $this->db->get();
        return $result->num_rows();
    }

    function getUserInfo($user_id)

    {

        $query = $this->db->get_where('tbl_users', array('id' => $user_id));

        return $query->row();

    }

    function getOwnerByID($id)

    {

        $query			=	$this->db->get_where('tbl_users', array('id' => $id));				

        return $query->row();

    }

    function getAllCountries()

    {

        $query			=	$this->db->get('tbl_country');

        return $query->result();

    }

    

    function getAllCategories()

    {

       $sql = "select COUNT(p.id) as cp, c.* from tbl_property p inner join tbl_category c on p.category_id = c.id group by c.id order by cp desc";

       $query = $this->db->query($sql);

       return $query->result(); 

    }

    function getAllJustListed()

    {

        $sql = "select * from tbl_property where admin_action != 'pending' and admin_action != 'declined'  and property_status = 1 order by created_date desc limit 0, 3";

        $query = $this->db->query($sql);

        return $query->result();

    }

    

    function getPropertyByCategory($category_id, $start, $limit)

    {

        $this->db->where('tbl_property_cats.category_id',$category_id);

        $this->db->select('tbl_property.id,tbl_property.admin_action,tbl_property.title,tbl_property.featured_image,tbl_property.price_night,tbl_users.profile_picture,tbl_users.first_name');

        $this->db->from('tbl_property');

        $this->db->join('tbl_property_cats','tbl_property.id=tbl_property_cats.property_id','INNER');

        $this->db->join('tbl_users','tbl_property.owner_id=tbl_users.id','INNER');

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

        $this->db->select('tbl_property.id,tbl_property.admin_action,tbl_property.title,tbl_property.featured_image,tbl_property.price_night,tbl_users.profile_picture,tbl_users.first_name');

        $this->db->from('tbl_property');

        $this->db->join('tbl_property_cats','tbl_property.id=tbl_property_cats.property_id','INNER');

        $this->db->join('tbl_users','tbl_property.owner_id=tbl_users.id','INNER');

        

        $query = $this->db->get();

        return $query->num_rows();

    }

    function countPropertyByCategory($id)

    {

        $sql = "select p.* from tbl_users u inner join tbl_property p on p.owner_id = u.id where category_id = ".$id." group by p.id order by p.visited_count desc";

        $query = $this->db->query($sql);

        return $query->num_rows(); 

    }

    

    function getRegionByCountry($country_id)

        {

                $query			=	$this->db->get_where('tbl_region', array('country_id' => $country_id, 'region_status' => 1));

                return $query->result();

        }

        function getCityByRegion($region_id)

        {

                $query			=	$this->db->get_where('tbl_city', array('region_id' => $region_id, 'city_status' => 1));

                return $query->result();

        }

        

        function getSuburbByCity($city_id)

        {

                $query			=	$this->db->get_where('tbl_suburb', array('city_id' => $city_id, 'status' => 1));

                return $query->result();

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

    

    function capitalizeWords($words, $charList = null) {

    // Use ucwords if no delimiters are given

    if (!isset($charList)) {

        return ucwords($words);

    }

   

    // Go through all characters

    $capitalizeNext = true;

   

    for ($i = 0, $max = strlen($words); $i < $max; $i++) {

        if (strpos($charList, $words[$i]) !== false) {

            $capitalizeNext = true;

        } else if ($capitalizeNext) {

            $capitalizeNext = false;

            $words[$i] = strtoupper($words[$i]);

        }

    }

   

    return $words;

}


function get_all_category()
{
    $sql = "SELECT * FROM tbl_category WHERE category_status = 1";

    $query = $this->db->query($sql);

    return $query->result();
}

	

	

}
