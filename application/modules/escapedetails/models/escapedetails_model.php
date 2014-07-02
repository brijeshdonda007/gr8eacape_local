<?php

class Escapedetails_model extends CI_Model{

    function getPropertyDetailByID($id)

    {
	//$this->output->enable_profiler(true);
	$this->db->where('tbl_property.id',$id);
	$this->db->select('tbl_property.*, tbl_country.country_name, tbl_region.region_name AS get_region_name, tbl_city.city_name  AS get_city_name, tbl_suburb.suburb_name as suburb_name');
	$this->db->join('tbl_country','tbl_country.id=tbl_property.country_id','left');
	$this->db->join('tbl_suburb','tbl_suburb.id=tbl_property.suburb_id','left');
	$this->db->join('tbl_region','tbl_region.id=tbl_property.region_id','left');
	$this->db->join('tbl_city','tbl_city.id=tbl_property.city_id','left');
	$this->db->from('tbl_property');
	$result = $this->db->get();
        //$query = $this->db->get_where('tbl_property', array('id' => $id));
        return $result->row();

    }
    function getAmenities(){
	$this->db->order_by('tbl_amenities.id', 'asc');
	$this->db->group_by('tbl_amenities.name');
	$this->db->select('tbl_amenities.*, tbl_property_amenities.property_id');
	$this->db->join('tbl_property_amenities', 'tbl_amenities.id = tbl_property_amenities.amenities_id','left');
	$query = $this->db->get('tbl_amenities');
	return $query->result();
    }
    function getPropertyAmenitiesByID($id){
	$query = $this->db->get_where('tbl_property_amenities',array('property_id'=>$id));
	$ret_array = array();
	foreach ($query->result() as $row){
		array_push($ret_array, $row->amenities_id);
	}
	return $ret_array;
    }
	
    function getGalleryByPropID($id) {
		$status = 1; // FOR PUBLISHED IMAGES.
        $query = $this->db->get_where('tbl_property_images', array('property_id' => $id,'status' => $status));
        return $query->result();
    }

    function getVideoByPropID($id)

    {

        $query = $this->db->get_where('tbl_property_videos', array('property_id' => $id));

        return $query->row();

    }

    function getPropertyExtraByID($id)

    {

        $query = $this->db->get_where('tbl_extra_property', array('property_id' => $id));

        return $query->result();

    }

    function getUserInfo($user_id)

    {

        $query = $this->db->get_where('tbl_users', array('id' => $user_id));

        return $query->row();

    }

    

    function getCountryByID($country_id)

    {

        $query = $this->db->get_where('tbl_country', array('id' => $country_id));

        return $query->row();

    }

    

     function getCityByID($city_id)

    {

        $query = $this->db->get_where('tbl_city', array('id' => $city_id));

        return $query->row();

    }

    function get_suburb_by_ID($suburb_id)

    {

        $query = $this->db->get_where('tbl_suburb', array('id' => $suburb_id));

        return $query->row();

    }

     function getRegionByID($region_id)

    {

        $query = $this->db->get_where('tbl_region', array('id' => $region_id));

        return $query->row();

    }

    

     function getOwnerInfoByID($owner_id)

    {

        $query = $this->db->get_where('tbl_users', array('id' => $owner_id));

        return $query->row();

    }

    function updateVisitCount($id, $count)

    {

        

         $data = array(

               'visited_count' => $count+1,

            );



        $this->db->where('id', $id);

        $this->db->update('tbl_property', $data);

    }

    function getOtherOwnerList($owner_id, $prop_id)

    {

        $limit = 2;

        $this->db->where('tbl_property.id !=',$prop_id);

        $this->db->where('tbl_property.owner_id',$owner_id);

        $this->db->select('tbl_property.id, tbl_property.owner_id, tbl_property.title,tbl_property.custom_url, tbl_property.featured_image, tbl_property.price_night, tbl_country.short_name');

        $this->db->from('tbl_property');

		$this->db->join('tbl_country', 'tbl_property.country_id=tbl_country.id', 'LEFT');

        $this->db->order_by('RAND()');

        $this->db->limit( $limit );

        $result = $this->db->get();

        return $result->result();

    }

    

    function getPropYouLove($country_name, $city_name, $catid)

    {

        $pageLimit = 4;

        $this->db->like('tbl_city.city_name',$city_name);

        $this->db->like('tbl_country.country_name',$country_name);

        

		

        $this->db->select('tbl_property.id,tbl_property.country_id,

            tbl_property.city_id,tbl_property.owner_id,tbl_property.title,tbl_property.featured_image,

            tbl_property.price_night,tbl_property.category_id');

        $this->db->from('tbl_property');

        $this->db->join('tbl_city','tbl_property.city_id=tbl_city.id','INNER');

        $this->db->join('tbl_country','tbl_property.country_id=tbl_country.id','INNER');

        

        $this->db->group_by("tbl_property.id");

        $this->db->order_by('RAND()');

        $this->db->limit( $pageLimit );

        $result = $this->db->get();

        return $result->result();

    }

    

    function getAllRateCategory()

    {

        $query = $this->db->get('tbl_review_category');

        return $query->result();

    }

    function addReview()

    {

        $property_id = $this->input->post('property_id');

        $user_id = $this->session->userdata('user_id');

        $data = array('property_id' => $property_id, 'user_id' => $user_id,

            'reviews' => $this->input->post('limitedtextarea'),

            'created_date' => date('Y-m-d H:i:s'));

        $this->db->insert('tbl_reviews', $data);

        

    }

    function getTotalRate()

    {
		$str = $this->uri->segment(2);
		preg_match_all('!\d+!', $str, $matches);
		$prop_id = intval($matches[0][0]);

        $property_id = $prop_id;

        $sql = "select * from tbl_property_review

            where property_id = " . $property_id . "";

        $query = $this->db->query($sql);

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

    function getReviewByUser($property_id)

    {

        $user_id = $this->session->userdata('user_id');

        $sql = "select * from tbl_reviews where property_id = '".$property_id."' and user_id = '".$user_id."'";

        $query = $this->db->query($sql);

        return $query->num_rows();

    }

    

    function isRatedByUsr($property_id, $rcatid)

    {

        $user_id = $this->session->userdata('user_id');
		$str = $property_id;
		preg_match_all('!\d+!', $str, $matches);
		$prop_id = intval($matches[0][0]);

        $sql = "select * from tbl_property_review

          where property_id = " . $prop_id . " and rcatid = ".$rcatid." and user_id = ".$user_id."";

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

    

    function has_booked_by_user($property_id)

    {   

        $user_id = $this->session->userdata('user_id');

        $status_array = serialize(array('bb' => 5,'oo' => 5));

        $sql = "select * from tbl_booking where user_id = $user_id and property_id = $property_id and status = '$status_array'";

        $query = $this->db->query($sql);

        if($query->num_rows() > 0)

        {

            return 1;

        }

        else

        {

            return 0;

        }

    }

    

    function type_escape($type_id)

    {

        $query = $this->db->get_where('tbl_types_escape', array('id' => $type_id));

        return $query->row();

    }



    /**
     * Take id and array of key pair value for update the table
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, array $data = array())
    {
        if(empty($data) OR empty($id)) return false;

        $this->db->where('id', $id);
        $this->db->update('tbl_property', $data);

        return true;
    }

    /**
     * Get all by Property ID
     *
     * @param $id
     * @return array|bool
     */
    public function findById($id)
    {
        if(empty($id)) return false;

        $query  = $this->db->get_where('tbl_property', array('id' => $id));
        $result =  $query->row_array();

        return empty($result)? array():$result;
    }

    /**
     * Get the count all property
     *
     * @return int
     */
    public function getPropertyCount()
    {
        $this->db->select("count(id) AS count");
        $this->db->from("tbl_property");
        $result =  $this->db->get()->row();

        return empty($result)? array() : $result->count;
    }

    public function getAll($page, $limit = 10)
    {
        $this->db->select("*");
        $this->db->from("tbl_property");
        $this->db->limit($limit, $page);

        $result =  $this->db->get()->result();

        return empty($result)? array() : $result;
    }
	/*
	* FUNCTION TO GET ALL ESCAPE CHANNELS
	*
	*/
	function getAllEscapeChannels($property_id)
	{
		$sql_query = "select tbl_sky_channels.name,tbl_tv_channels.tv_category from tbl_property_sky_channels, tbl_sky_channels,tbl_tv_channels where 	tbl_property_sky_channels.sky_channel_id=tbl_sky_channels.id and tbl_property_sky_channels.property_id= '$property_id' and tbl_tv_channels.id=tbl_sky_channels.television_type";
		$query = $this->db->query($sql_query);
		$result =  $query->result();
		$channelsArray = array();
		
		foreach($result as $channels){
			$channelsArray[$channels->tv_category][] = $channels;
		}
		return $channelsArray;
		
	}

     /**
     * @param int $ownerid
     * @return bool|array
     */
    public function getAcceptedPropertyByOwnerId($ownerid)
    {
        if(empty($ownerid)) return false;
        return $this->getPropertyByOwnerId($ownerid, array('tbl_verification_payment.status' => 1));

    }

    /**
     * @param int $ownerid
     * @return bool|array
     */
    public function getUnapprovePropertyByOwnerId($ownerid)
    {
        if(empty($ownerid)) return false;
        return $this->getPropertyByOwnerId($ownerid, "tbl_verification_payment.status is null");
    }

    private function getPropertyByOwnerId($ownerid, $statusWhereClause)
    {
        $this->db->select("tbl_property.*, tbl_verification_payment.status");
        $this->db->from("tbl_property");
        $this->db->join('tbl_verification_payment', 'tbl_property.id = tbl_verification_payment.property_id', 'left');
        $this->db->where(array('owner_id' => $ownerid));
        $this->db->where($statusWhereClause);

        $result =  $this->db->get()->result_array();
        return empty($result)? array():$result;
    }
}
