<?php

include_once(BASEPATH . "helpers/dompdf/dompdf_config.inc.php");
class Ajax_model extends My_Model
{

    public function __construct()
    {
        parent::__construct();
    }
	

   function getRegionAjax($country_id)

        {

                $query			=	$this->db->get_where('tbl_region', array('country_id' => $country_id, 'region_status' => 1));

                return $query->result();

        }

	

    function getCityAjax($region_id)

        {

                $query			=	$this->db->get_where('tbl_city', array('region_id' => $region_id, 'city_status' => 1));
				
                return $query->result();

        }

    /**
     * return all channels by by ID
     *
     * @param $id
     * @return mixed
     */
    public function getChannelsByAjax($id)
    {

        $query = $this->db->get_where('tbl_sky_channels', array('television_type' => $id,
                                                                'status'          => 1)
                                      );

        return $query->result();
    }

    /**
     * @param $city_id
     * @return mixed
     */
    function getSuburbAjax($city_id)
    {
         $query = $this->db->get_where('tbl_suburb', array('city_id' => $city_id, 'status' => 1));
         return $query->result();
    }

	    function getGalleryImgByID($id)

        {

                $query			=	$this->db->get_where('tbl_property_images', array('id' => $id));

                return $query->row();

        }

        function updateGalleryImg($img)

        {

            

            $data = array('image' => $img);

            $this->db->where('id', $this->input->post('id'));

            $this->db->update('tbl_property_images', $data); 

        }

        function deleteExtraProp()

        {

            $id = $this->uri->segment(3);

            $this->db->delete('tbl_extra_property', array('id' => $id)); 

        }

        

        function getAllExtraProp($id)

    {

         $query = $this->db->get_where('tbl_extra_property',array('property_id' => $id));

         return $query->result();

    }

    function getAllGalleriesByID($id)

    {

         $query = $this->db->get_where('tbl_property_images',array('property_id' => $id));

         return $query->result();

    }

    function getSingleImg($id)

    {

        $query = $this->db->get_where('tbl_property_images',array('id' => $id));

         return $query->row();

    }

       function getPropertyInfobyID($id)

    {

        $query = $this->db->get_where('tbl_property',array('id' => $id));

        return $query->row();

    } 

     function deleteGallery()

    {

        $id = $this->uri->segment(3);



        $this->db->delete('tbl_property_images', array('id' => $id)); 

    }

    function getAllExtraInfoByID($id)

    {

        $query = $this->db->get_where('tbl_extra_property',array('property_id' => $id));

        return $query->result();

    }

    function getExPropertyInfo($id)

    {

        $query = $this->db->get_where('tbl_extra_property',array('id' => $id));

        return $query->row();

    }

    function updateExtraInfoByID($id)

    {

            $data = array('image' => $img);

            $this->db->where('id', $this->input->post('id'));

            $this->db->update('tbl_property_images', $data); 

    }

    function getSinglePropByID($id)

    {

        $query = $this->db->get_where('tbl_extra_property',array('id' => $id));

        return $query->row();

    }

    function updateSingleExtra()

    {

        $type = trim(strtolower($this->input->post('type')));

        $value = trim(strtolower($this->input->post('value')));

        $data = array('type' => $type,'value' => $value);

        $this->db->where('id', $this->input->post('info_id'));

        $this->db->update('tbl_extra_property', $data); 

    }

    

     function getProperty()

    {

         

        $pageLimit = $this->input->post('pageLimit');

        $sql = "Select c.short_name, a.*, b.first_name as owner_name, b.profile_picture as owner_pic from tbl_property a inner join tbl_users b on a.owner_id=b.id LEFT JOIN tbl_country c ON c.id=a.country_id where admin_action != 'pending' and admin_action != 'declined' and property_status = 1 group by a.id order by a.visited_count desc limit $pageLimit";

        $query = $this->db->query($sql);

        return $query->result();

        

        

        

    }

    function get_all_propery()

    {

        $sql = "Select * from tbl_property where admin_action != 'pending' and admin_action != 'declined' and property_status = 1";

        $query = $this->db->query($sql);

        return count($query->result());

    }

    function dataByPriceRange()

    {

        $min_range = $this->input->post('minrange');

        $maxrange = $this->input->post('maxrange');

        $sql = "Select * from tbl_property where price_night >= $min_range and price_night <= $maxrange group by id order by price_night asc";

        $query = $this->db->query($sql);

        return $query->result();

    }

    function getOwnerByID($id)

    {

        $query			=	$this->db->get_where('tbl_users', array('id' => $id));				

        return $query->row();

    }

    

    function loadHomeSearchResults()

    {

     

        

        $pageLimit = $this->input->post('pageLimit');

        $searchq = $this->input->post('searchq');

        

            $sql = "select * from tbl_property where title like '%$searchq%' 

            or country_id=(select id from tbl_country where country_name like '%$searchq%') 

                or city_id=(select id from tbl_city where city_name like '%$searchq%') 

                    or category_id=(select id from tbl_category where category_title like '%$searchq%') 

                        or postcode like '%$searchq%' 

                            or suburb like '%$searchq%'

                                or avenue like '%$searchq%' admin_action != 'pending' and admin_action != 'declined' and property_status = 1 order by visited_count desc limit 0, $pageLimit";

        

        $query = $this->db->query($sql);

        return $query->result();

   

    }

    function getHomeSearchResultsCounts()

    {

        $searchq = $this->input->post('searchq');

        

        $sql = "select * from tbl_property where title like '%$searchq%' 

            or country_id=(select id from tbl_country where country_name like '%$searchq%') 

                or city_id=(select id from tbl_city where city_name like '%$searchq%') 

                    or category_id=(select id from tbl_category where category_title like '%$searchq%') 

                        or postcode like '%$searchq%' 

                            or suburb like '%$searchq%'

                                or avenue like '%$searchq%' and admin_action != 'pending' and admin_action != 'declined' and property_status = 1";

       

        $query = $this->db->query($sql);

        return $query->num_rows();

        

    }

    function loadRefineSearchResults()

    {

     

        

        $pageLimit = $this->input->post('pageLimit');

        $keywords = trim($this->input->post('keywords'));

        $country_id = $this->input->post('country_id');

        $region_id = $this->input->post('region_id');

        $city_id = $this->input->post('city_id');

        $suburb = $this->input->post('suburb');

        $adult = $this->input->post('adult');

        $children = $this->input->post('children');

        $where = array();

        $this->db->where('tbl_property.admin_action !=', 'pending');

        $this->db->where('tbl_property.admin_action !=', 'declined');

        $this->db->where('tbl_property.property_status', '1');

        if($keywords){

            $this->db->like('title',$keywords);

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

        if($suburb != '')

        {

            $this->db->like('tbl_property.suburb',$suburb);

        }

         if($adult > 0){

            $this->db->where('tbl_extra_property.type','adult');

            $this->db->like('tbl_extra_property.value',$adult);

        }

        if($children > 0){

            $this->db->where('tbl_extra_property.type','children');

            $this->db->where('tbl_extra_property.value',$children);

        }

 

		

        $this->db->select('tbl_property.id,tbl_property.admin_action,tbl_property.country_id,tbl_property.region_id,

            tbl_property.city_id,tbl_property.owner_id,tbl_property.title,tbl_property.featured_image,

            tbl_property.featured_image,tbl_property.price_night,tbl_users.profile_picture,tbl_users.first_name');

        $this->db->from('tbl_property');

        $this->db->join('tbl_users','tbl_property.owner_id=tbl_users.id','INNER');

        $this->db->join('tbl_extra_property','tbl_property.id=tbl_extra_property.property_id','INNER');

        $this->db->group_by("tbl_property.id"); 

        $this->db->order_by('tbl_property.visited_count','desc');

        $this->db->limit( $pageLimit );

        $result = $this->db->get();

        return $result->result();

   

    }

    function getRefineSearchResultsCounts()

    {

        $keywords = trim($this->input->post('keywords'));



        $country_id = $this->input->post('country_id');

        $region_id = $this->input->post('region_id');

        $city_id = $this->input->post('city_id');

        $suburb = $this->input->post('suburb');

        $adult = $this->input->post('adult');

        $children = $this->input->post('children');

        $where = array();

        $this->db->where('tbl_property.admin_action !=', 'pending');

        $this->db->where('tbl_property.admin_action !=', 'declined');

        $this->db->where('tbl_property.property_status', '1');

        if($keywords){

            $this->db->like('title',$keywords);

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

        if($suburb != '')

        {

            $this->db->like('tbl_property.suburb',$suburb);

        }

         if($adult > 0){

            $this->db->where('tbl_extra_property.type','adult');

            $this->db->like('tbl_extra_property.value',$adult);

        }

        if($children > 0){

            $this->db->where('tbl_extra_property.type','children');

            $this->db->like('tbl_extra_property.value',$children);

        }

 

		

        $this->db->select('tbl_property.id,tbl_property.admin_action,tbl_property.country_id,tbl_property.region_id,tbl_property.city_id,tbl_property.title,tbl_property.featured_image,tbl_property.featured_image,tbl_property.price_night,tbl_users.profile_picture,tbl_users.first_name');

        $this->db->from('tbl_property');

        $this->db->join('tbl_users','tbl_property.owner_id=tbl_users.id','INNER');

        $this->db->join('tbl_extra_property','tbl_property.id=tbl_extra_property.property_id','INNER');

        $this->db->group_by("tbl_property.id"); 

        $this->db->order_by('tbl_property.visited_count','desc');

        $result = $this->db->get();

        return $result->num_rows();

        

    }

    function loadPropertyByCat()

    {

        $per_page = 0;

        $pageLimit = $this->input->post('pageLimit');

        $catid = $this->uri->segment(3);

       

        $sql = "select p.*, u.first_name as owner_name, u.id as owner_id, u.profile_picture as owner_picture from tbl_users u inner join tbl_property p on p.owner_id = u.id where p.category_id = ".$catid." and p.admin_action != 'pending' and p.admin_action != 'declined' and p.property_status = 1 group by p.id order by p.visited_count desc limit $per_page, $pageLimit";

        $query = $this->db->query($sql);

        return $query->result(); 

        

    }

    function countPropertyByCategory($id)

    {

        $sql = "select p.*, u.first_name as owner_name, u.id as owner_id, u.profile_picture as owner_picture from tbl_users u inner join tbl_property p on p.owner_id = u.id where p.category_id = ".$id." and p.admin_action != 'pending' and p.admin_action != 'declined' and p.property_status = 1 group by p.id order by p.visited_count desc";

        $query = $this->db->query($sql);

        return $query->num_rows(); 

    }

    function checkAvailability()
    {
        $property_id  = $this->input->post('property_id');
        $start_date   = $this->input->post('start_date');
        $end_date     = $this->input->post('end_date');
        $price_text   = $this->input->post('price_text');
        $no_of_guests = $this->input->post('no_of_guests');
        $no_of_guests = ($no_of_guests == 0)? 1:$no_of_guests;
        $start_date = DateTime::createFromFormat('d/m/Y', $start_date);
        $end_date   = DateTime::createFromFormat('d/m/Y', $end_date);
        $total_requested_days = date_diff($start_date, $end_date);
        $total_requested_days = $total_requested_days->days;


        $property_rs = $this->getPropertyInfobyID($property_id);
        $price_night = $property_rs->price_night;
        $price_week  = $property_rs->price_week;
        $price_month = $property_rs->price_month;

        if($total_requested_days < 7) {

            $output_type = 'daily';

            $total_price = round($total_requested_days * $price_night);

            $noof_days = $total_requested_days;

            $total_price_nights = $total_price;

            $noof_weeks = '';

            $total_week_price = '';

            $price_night = round($property_rs->price_night);

        } elseif( $total_requested_days >= 7) {

            $output_type = 'weekly';

            $week_cal_details = $this->priceCalcWeekly($total_requested_days, $price_night, $price_week);

            $noof_weeks = $week_cal_details['total_weeks'];

            $noof_days = $week_cal_details['total_days'];

            $total_week_price = $week_cal_details['total_week_price'];

            $total_price_nights = $week_cal_details['total_price_nights'];

            $total_price = $total_week_price + $total_price_nights;

            $price_night = round($property_rs->price_night);
        }



            $total_price_final = $total_price * $no_of_guests;

            $value= array('success'             => 1,
                          'output_type'         => $output_type,
                          'total_price'         => $total_price,
                          'noof_days'           => $noof_days,
                          'noof_weeks'          => $noof_weeks,
                          'total_week_price'    => $total_week_price,
                          'total_price_nights'  => $total_price_nights,
                          'price_night'         => $price_night,
                          'price_week'          => $price_week,
                          'total_price_final'   => $total_price_final,
                          'booked_days'         => $total_requested_days,
                          'start_date'          => $start_date,
                          'end_date'            => $end_date,
                          'property_id'         => $property_id);

            return $value;
    }

    function priceCalcWeekly($days, $prn, $prw)

    {

        if($days == 7)

        {

            return array('total_weeks' => 1, 'total_week_price' => round($prw), 'total_days' => '','total_price_nights' => '');

            

        }

        elseif($days > 7)

        {

            $div = round($days/7);

            $reminder = ($days%7);

            $price_weeks = round($div * $prw);

            $price_nights = round($reminder * $prn);

            $total_price = round($price_weeks + $price_nights);

            return array('total_weeks' => $div, 'total_days' => $reminder, 'total_week_price' => $price_weeks, 'total_price_nights' => $price_nights);

        }

    }

    

    function getProperty_owner()

    {

         

        $per_page = 8;

        $pageLimit = $this->input->post('pageLimit');

        $owner_id = $this->uri->segment(3);

        $sql = "Select a.*, b.first_name as owner_name, b.profile_picture as owner_pic from tbl_property a inner join tbl_users b on a.owner_id=b.id where a.owner_id = ".$owner_id." and admin_action != 'pending' and admin_action != 'declined' and property_status = 1 group by a.id order by a.visited_count desc limit $pageLimit,".$per_page;

        $query = $this->db->query($sql);

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



function editEachfixedProp()

{

    

    $ex_prop_id = $this->input->post('pid');

    $fieldx = $this->input->post('fieldx');

    $colx = $this->input->post('colx');

    if($colx == 'bedroom')

    {

        $data = array('bedroom' => $fieldx);

    }

    elseif($colx == 'bathroom')

    {

        $data = array('bathroom' => $fieldx);

    }

    elseif($colx == 'adult')

    {

        $data = array('adult' => $fieldx);

    }

    elseif($colx == 'children')

    {

        $data = array('children' => $fieldx);

    }

    

    $this->db->where('id', $ex_prop_id);

    $this->db->update('tbl_property', $data); 

    

    return $ex_prop_id;

    

}



function editEachcustomProp()

{

    $ex_prop_id = $this->input->post('pid');

    $type = $this->input->post('type');

    $value = $this->input->post('value');

    $data = array('type' => $type, 'value' => $value);

    $this->db->where('id', $ex_prop_id);

    $this->db->update('tbl_extra_property', $data); 

    return $ex_prop_id;

    

}



function get_this_value($id)

{

    $sql = "select * from tbl_extra_property where id=$id";

    $query = $this->db->query($sql);

    return $query->row();

    

}



function update_pet()

{

    $ex_prop_id = $this->input->post('pid');

    $pet = $this->input->post('pet');

    $data = array('pet' => $pet);

    $this->db->where('id', $ex_prop_id);

    $this->db->update('tbl_property', $data);  

}


	function delete_escapes(){
		$ids = $_REQUEST['escape_ids'];
		$id_arr = explode(',', $ids);
		$this->db->where_in("id",$id_arr);
		$this->db->delete('tbl_property');
	}
}
