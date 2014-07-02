<?php

include_once(BASEPATH . "helpers/dompdf/dompdf_config.inc.php");
class Addescape_model extends My_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->loadTable('tbl_property', 'id');
    }

	function getUserInfo($user_id)
	{
		$query = $this->db->get_where('tbl_users', array('id' => $user_id));
		return $query->row();
	}

	function editProfileDetails($profile_picture)
	{
		$data = array('first_name'        => $this->input->post('first_name'),
		              'last_name'         => $this->input->post('last_name'),
		              'street_no'         => $this->input->post('street_no'),
		              'street_name'       => $this->input->post('street_name'),
		              'suburb'            => $this->input->post('suburb'),
		              'city'              => $this->input->post('city'),
		              'region'            => $this->input->post('region'),
		              'country_id'        => $this->input->post('country_id'),
		              'phone'             => $this->input->post('phone'),
		              'mobile'            => $this->input->post('mobile'),
		              'post_code'         => $this->input->post('post_code'),
		              'profile_picture'   => $profile_picture,
		              'about_yourself'    => $this->input->post('about_yourself'),
		              'youtube_id'        => $this->input->post('youtube_id')
		);

		$this->db->where('id', $this->input->post('user_id'));
		$this->db->update('tbl_users', $data); 
	}
	function accountInformationInsert($insertData, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('tbl_users', $insertData);
	}
	function changePasswordProcess($user_id)
	{
		$pwd= hash('sha256', $this->input->post('password'));
		$data = array(
		'password' => $pwd
		);
		$this->db->where('id', $user_id);
		$this->db->update('tbl_users', $data); 
	}
	function incrypt($pwd)
	{
		$temp="greatescapes";
		$a=md5(sha1($temp.$pwd));
		return $a;
	}
	function getAllCategories()
	{
		$query = $this->db->get_where('tbl_category', array('category_status' => '1'));
		return $query->result();
	}
	/*
	* Function to Get All Sky Channels
	*/
	function getAllSkyChannels()
	{
		$query = $this->db->get_where('tbl_tv_channels', array('status' => '1'));
		return $query->result();
	}


	/*
	* Function to Get All Free View Channels
	*/
	function getAllChannels()
	{
		$query = $this->db->get_where('tbl_sky_channels', array('status' => '1'));
		return $query->result();
	}
	function getAllAmenities(){
		$query = $this->db->get_where('tbl_amenities', array('status' => '1'));
		return $query->result();
	}
	function update_property_details($certificate)
	{
		$property_id = $this->input->post('property_id');
		if ($this->input->post('save_property_id') != 0){
				$property_id = $this->input->post('save_property_id');
		}

		if(!empty($property_id)) {
			$this->db->where('property_id', $property_id);
			$this->db->delete('tbl_property_amenities');

			$this->db->where('property_id', $property_id);
			$this->db->delete('tbl_property_cats');
			
			$this->db->where('property_id', $property_id);
			$this->db->delete('tbl_property_sky_channels');
			if ($this->input->post('save_property_id') != 0){
				$this->db->where('id', $this->input->post('save_property_id'));
				$this->db->select('private_code');
				$this->db->select('created_date');
				$query = $this->db->get('tbl_property');
				if ($query->num_rows() > 0){
					$private_code = $query->row()->private_code;
					$created_date = $query->row()->created_date;
				}
			} else {
				$private_code = $this->input->post('property_code');
				$created_date = $this->input->post('created_date');
			}
		}
		else
		{
			$private_code = $this->genRandomString('12'); 
			$created_date = date("Y-m-d H:i:s");
		}
		if ($this->input->post('bond_amount'))
			$bond = $this->input->post('bond_amount');
		else
			$bond = '0';
		if ($this->input->post('street_no'))
			$street_no = $this->input->post('street_no');
		else
			$street_no = '';
		if ($this->input->post('street_name'))
			$street_name = $this->input->post('street_name');
		else
			$street_name = '';
		if ($this->input->post('safety_children'))
			$safety_children = $this->input->post('safety_children');
		else
			$safety_children = '';
			
			
			$check_in_date = date("H:i", strtotime($this->input->post('check_in_date'))); 
			$check_out_date = date("H:i", strtotime($this->input->post('check_out_date'))); 
			
			
			@$standard_start_date='';
			@$standard_end_date='';
			@$winter_start_date='';
			@$winter_end_date='';
			@$holiday_start_date='';
			@$holiday_end_date='';
			@$summer_start_date='';
			@$summer_end_date='';
			
			@$standard_rate=0;
			@$winter_rate=0;
			@$holiday_rate=0;
			@$summer_rate=0;

			if($this->input->post('standard_changed')== 1) {
				@$standard_rate = 1;
				$start = explode('/',$this->input->post('standard_start_date')); 
				@$standard_start_date=$start[2]."-".$start[1]."-".$start[0]; 
				@$end = explode('/',$this->input->post('standard_end_date')); 
				@$standard_end_date=$end[2]."-".$end[1]."-".$end[0]; 
			}

			if($this->input->post('winter_changed')== 1) {
				@$winter_rate = 1;
				@$start = explode('/',$this->input->post('winter_start_date')); 
			    @$winter_start_date=$start[2]."-".$start[1]."-".$start[0]; 
				@$end = explode('/',$this->input->post('winter_end_date')); 
			    @$winter_end_date=$end[2]."-".$end[1]."-".$end[0]; 
			}

			if($this->input->post('holiday_changed')== 1) {
				@$holiday_rate = 1;
				@$start = explode('/',$this->input->post('holiday_start_date')); 
				@$holiday_start_date=$start[2]."-".$start[1]."-".$start[0]; 
				@$end = explode('/',$this->input->post('holiday_end_date')); 
			    @$holiday_end_date=$end[2]."-".$end[1]."-".$end[0]; 
			}

			if($this->input->post('summer_changed')== 1) {
				@$summer_rate = 1;
				@$start = explode('/',$this->input->post('summer_start_date')); 
			    @$summer_start_date=$start[2]."-".$start[1]."-".$start[0]; 
				@$end = explode('/',$this->input->post('summer_end_date')); 
			    @$summer_end_date=$end[2]."-".$end[1]."-".$end[0]; 
			}
			
		$data = array(  'title'                     => $this->input->post('title'),
                        'detail'                    => $this->input->post('detail'),
                        'booking_type'              => $this->input->post('booking_type'),
                        'type_escape_id'            => $this->input->post('type_escape_id'),
                        'guest_capacity'            => $this->input->post('guest_capacity'),
                        'children'                  => $this->input->post('children'),
                        'safety_children'           => $safety_children,
                        'pet'                       => $this->input->post('pet'),
                        'check_in_date'             => $check_in_date,
                        'check_out_date'            => $check_out_date,
                        'smoking'                   => $this->input->post('smoking'),
                        'photographer'              => $this->input->post('photographer'),
                        'youtube_video_id'          => $this->input->post('property_video'),
                        'phone'                     => $this->input->post('escape_phone'),
                        'age'                       => $this->input->post('age'),
                        'dwelling'                  => $this->input->post('dwelling'),
                        'bedroom'                   => $this->input->post('bedrooms'),
                        'bathroom'                  => $this->input->post('bathrooms'),
                        'curtain'                   => $this->input->post('curtains'),
                        'appliance'                 => $this->input->post('appliances'),
                        'cutlery'                   => $this->input->post('cutlery'),
                        'carpet'                    => $this->input->post('carpet'),
                        'furniture'                 => $this->input->post('furniture'),
                        'utensil'                   => $this->input->post('utensil'),
                        'mattress'                  => $this->input->post('mattress'),
                        'cleaning'                  => $this->input->post('cleaner'),
                        'cleaning_fee'              => $this->input->post('charge'),
                        'cleaning_amount'           => $this->input->post('charge_amount_value'),
                        'cleaner_first_name'        => $this->input->post('first_name'),
                        'cleaner_last_name'         => $this->input->post('last_name'),
                        'cleaner_email'             => $this->input->post('email'),
                        'cleaner_phone'             => $this->input->post('phone'),
                        'cleaner_home_phone'        => $this->input->post('home_phone'),
                        'arrange_cleaning'          => $this->input->post('cleaner_help'),
                        'bed_lines'                 => $this->input->post('escape_bed_line'),
                        'price_night'               => $this->input->post('price_night'),
                        'price_week'                => $this->input->post('price_week'),
                        'price_month'               => $this->input->post('price_month'),
                        'standard_rate'             => $standard_rate,
                        'winter_rate'               => $winter_rate,
                        'holiday_rate'              => $holiday_rate,
                        'summer_rate'               => $summer_rate,
                        'standard_start_date'       => $standard_start_date,
                        'standard_end_date'         => $standard_end_date,
                        'winter_start_date'         => $winter_start_date,
                        'winter_end_date'           => $winter_end_date,
                        'holiday_start_date'        => $holiday_start_date,
                        'holiday_end_date'          => $holiday_end_date,
                        'summer_start_date'         => $summer_start_date,
                        'summer_end_date'           => $summer_end_date,
                        'standard_price_night'      => $this->input->post('standard_price_night'),
                        'standard_price_week'       => $this->input->post('standard_price_week'),
                        'standard_price_month'      =>$this->input->post('standard_price_month'),
                        'winter_price_night'        => $this->input->post('winter_price_night'),
                        'winter_price_week'         => $this->input->post('winter_price_week'),
                        'winter_price_month'        => $this->input->post('winter_price_month'),
                        'holiday_price_night'       => $this->input->post('holiday_price_night'),
                        'holiday_price_week'        => $this->input->post('holiday_price_week'),
                        'holiday_price_month'       => $this->input->post('holiday_price_month'),
                        'summer_price_night'        => $this->input->post('summer_price_night'),
                        'summer_price_week'         => $this->input->post('summer_price_week'),
                        'summer_price_month'        => $this->input->post('summer_price_month'),
                        'booking_cancelation'       => $this->input->post('booking_cancelation'),
                        'bond_amount'               => $bond,
                        'min_nights'                => $this->input->post('min_nights'),
                        'street_enable'             => $this->input->post('is_street_enable'),
                        'street_visible'            => $this->input->post('is_street_visible'),
                        'street_no'                 => $street_no,
                        'street_name'               => $street_name,
                        'how_to_reach'              => $this->input->post('how_to_reach'),
                        'country_id'                => $this->input->post('country_id'),
                        'region_id'                 => $this->input->post('region_id'),
                        'region_name'               => $this->input->post('country_region'),
                        'city_id'                   => $this->input->post('city_id'),
                        'city_name'                 => $this->input->post('region_city'),
                        'suburb_id'                 => $this->input->post('suburb_id'),
                        'city_suburb'               => $this->input->post('city_suburb'),
                        'postcode'                  => $this->input->post('postcode'),
                        'property_status'           => '0',
                        'owner_id'                  => $this->session->userdata('user_id'),
                        'private_code'              => $private_code,
                        'created_date'              => $created_date,
                        'admin_action'              => 'pending'
		);
		
		if($property_id != '') {
			$this->db->update('tbl_property', $data, array('id' => $property_id));
			$id = $property_id;
			$channels = $this->input->post('channels');
			if(!empty($channels)) {
				for ($i=0; $i < count($channels); $i++){
					$data = array('property_id'=>$id, 'sky_channel_id'=>$channels[$i]);
					$this->db->insert('tbl_property_sky_channels', $data);
				}
			}
			$property_category = $this->input->post('property_category');
			if(!empty($property_category)) {
				for ($i=0; $i < count($property_category); $i++){
					$data = array('property_id'=>$id, 'category_id'=>$property_category[$i]);
					$this->db->insert('tbl_property_cats', $data);
				}
			}
		} else {
			$this->db->insert('tbl_property', $data);
			$id = $this->db->insert_id();
			$property_category = $this->input->post('property_category');
			if(!empty($property_category)) {
				for ($i=0; $i < count($property_category); $i++){
					$data = array('property_id'=>$id, 'category_id'=>$property_category[$i]);
					$this->db->insert('tbl_property_cats', $data);
				}
			}
			$channels = $this->input->post('channels');
			if(!empty($channels)) {
				for ($i=0; $i < count($channels); $i++){
					$data = array('property_id'=>$id, 'sky_channel_id'=>$channels[$i]);
					$this->db->insert('tbl_property_sky_channels', $data);
				}
			}
		}
		$property_amenity = $this->input->post('property_amenity');
			if(!empty($property_amenity)) { 
					for ($i=0; $i < count($property_amenity); $i++){
						$data = array('property_id'=>$id, 'amenities_id'=>$property_amenity[$i]);
						$this->db->insert('tbl_property_amenities', $data);
					}
			}
		if ( @$this->input->post('gallery_imgs')){
			$this->db->where('property_id', $property_id);
			$this->db->delete('tbl_property_images');
			
			$property_gallery = $this->input->post('gallery_imgs');
			for ($i=0; $i < count($property_gallery); $i++){
				$data = array('property_id'=>$id, 'image'=>$property_gallery[$i]);
				$this->db->insert('tbl_property_images', $data);
			}
		}
		
		$this->db->where('id', $this->input->post('country_id'));
		$this->db->select('short_name');
		$query = $this->db->get('tbl_country');
		if ($query->num_rows() > 0){
			$short_name = $query->row()->short_name;
		}else{
			$short_name = 'NZ';
		}
		$data = array('custom_url' => $short_name.'0'.$id);
		$this->db->where('id', $id);
		$this->db->update('tbl_property', $data);
		return $id.'|'.$private_code;
	}
	function addEditEscape_general()
	{
		if($this->input->post('property_id'))
		{
			$private_code = $this->input->post('private_code');
			$created_date = $this->input->post('created_date');
		}
		else
		{
			$private_code = $this->genRandomString('12'); 
			$created_date = date("Y-m-d H:i:s");
		}
		$updated_date = date("Y-m-d H:i:s");
		if ($this->input->post('bond_amount'))
			$bond = $this->input->post('bond_amount');
		else
			$bond = '0';
		$data = array(
			'type_escape_id' => $this->input->post('type_escape_id'),
			'title' => $this->input->post('title'),
			'detail' => $this->input->post('detail'),
			'price_night' => $this->input->post('price_night'),
			'price_week' => $this->input->post('price_week'),
			'price_month' => $this->input->post('price_month'),
			'property_status' => '0',
			'owner_id' => $this->session->userdata('user_id'),
			'private_code' => $private_code,
			'created_date' => $created_date,
			'updated_date' => $updated_date,
			'admin_action' => 'pending',
			'guest_capacity' => $this->input->post('guest_capacity'),
			'booking_type' => $this->input->post('booking_type'),
			'priority_booking' => $this->input->post('priority_booking'),
			'booking_cancelation' => $this->input->post('booking_cancelation'),
			'bond_amount' => $bond,
                        'min_nights' => $this->input->post('min_nghts')
		);
		if($this->input->post('property_id') !=''):
			$this->db->update('tbl_property', $data, array('id' => $this->input->post('property_id')));
			$id = $this->input->post('property_id');
		else:
			$this->db->insert('tbl_property', $data);
			$id = $this->db->insert_id();
		endif;

		$this->db->where('id', $id);
		$this->db->select('custom_url');
		$query = $this->db->get('tbl_property');
		if ($query->num_rows() > 0){
			if ($query->row()->custom_url == ''){
				$data = array('custom_url' => 'NZ0'.$id);
				$this->db->where('id', $id);
				$this->db->update('tbl_property', $data);
			}
		}

		return $id . '|' . $private_code;
	}
	function addEditEscape_amenities()
	{
		if($this->input->post('property_id'))
		{
			$private_code = $this->input->post('private_code');
			$created_date = $this->input->post('created_date');
		}
		else
		{
			$private_code = $this->genRandomString('12'); 
			$created_date = date("Y-m-d H:i:s");
		}
		$updated_date = date("Y-m-d H:i:s");
		$data = array(
			'amenities' => $this->input->post('amenities_detail'),
			'owner_id' => $this->session->userdata('user_id'),
			'private_code' => $private_code,
			'created_date' => $created_date,
			'updated_date' => $updated_date,
			'property_status' => '0',
			'admin_action' => 'pending'
		);
		if($this->input->post('property_id') !=''):
			$this->db->update('tbl_property', $data, array('id' => $this->input->post('property_id')));
			$id = $this->input->post('property_id');
		else:
			$this->db->insert('tbl_property', $data);
			$id = $this->db->insert_id();
		endif;
		return $id . '|' . $private_code;
	}
	function addEditEscape_terms()
	{
		if($this->input->post('property_id'))
		{
			$private_code = $this->input->post('private_code');
			$created_date = $this->input->post('created_date');
		}
		else
		{
			$private_code = $this->genRandomString('12'); 
			$created_date = date("Y-m-d H:i:s");
		}
		$updated_date = date("Y-m-d H:i:s");
		$data = array(
			'termsncondition' => $this->input->post('termsncondition'),
			'owner_id' => $this->session->userdata('user_id'),
			'private_code' => $private_code,
			'created_date' => $created_date,
			'updated_date' => $updated_date,
			'property_status' => '0',
			'admin_action' => 'pending'
		);
		if($this->input->post('property_id') !=''):
			$this->db->update('tbl_property', $data, array('id' => $this->input->post('property_id')));
			$id = $this->input->post('property_id');
		else:
			$this->db->insert('tbl_property', $data);
			$id = $this->db->insert_id();
		endif;
		return $id . '|' . $private_code;
	}
	function addEditEscape_gallery()
	{
		if($this->input->post('property_id'))
		{
			$private_code = $this->input->post('private_code');
			$created_date = $this->input->post('created_date');
		}
		else
		{
			$private_code = $this->genRandomString('12'); 
			$created_date = date("Y-m-d H:i:s");
		}
		$updated_date = date("Y-m-d H:i:s");
		$data = array(
			'property_status'    => '0',
			'owner_id'           => $this->session->userdata('user_id'),
			'private_code'       => $private_code,
			'created_date'       => $created_date,
			'updated_date'       => $updated_date,
			'admin_action'       => 'pending',
			);
		if($this->input->post('property_id') !=''):
			$this->db->update('tbl_property', $data, array('id' => $this->input->post('property_id')));
			$id = $this->input->post('property_id');
		else:
			$this->db->insert('tbl_property', $data);
			$id = $this->db->insert_id();
		endif;
		return $id . '|' . $private_code;
	}
	function addEditEscape_location()
	{
		if($this->input->post('property_id'))
		{
			$private_code = $this->input->post('private_code');
			$created_date = $this->input->post('created_date');
		}
		else
		{
			$private_code = $this->genRandomString('12'); 
			$created_date = date("Y-m-d H:i:s");
		}
		$updated_date = date("Y-m-d H:i:s");
		$data = array(
			'country_id' => $this->input->post('country_id'),
			'region_id' => $this->input->post('region_id'),
			'city_id' => $this->input->post('city_id'),
			'suburb_id' => $this->input->post('suburb_id'),
		
			'street_no' => $this->input->post('street_no'),
			'street_name' => $this->input->post('street_name'),
			'suburb' => $this->input->post('suburb'),
			'postcode' => $this->input->post('postcode'),
			'property_status' => '0',
			'owner_id' => $this->session->userdata('user_id'),
			'private_code' => $private_code,
			'created_date' => $created_date,
			'updated_date' => $updated_date,
			'admin_action' => 'pending'
		);
		if($this->input->post('property_id') !=''):
			$this->db->update('tbl_property', $data, array('id' => $this->input->post('property_id')));
			$id = $this->input->post('property_id');
		else:
			$this->db->insert('tbl_property', $data);
			$id = $this->db->insert_id();
		endif;
		$this->db->where('id', $this->input->post('country_id'));
		$this->db->select('short_name');
		$query = $this->db->get('tbl_country');
		if ($query->num_rows() > 0){
			$short_name = $query->row()->short_name;
		}else{
			$short_name = 'NZ';
		}
		$data = array('custom_url' => $short_name.'0'.$id);
		$this->db->where('id', $id);
		$this->db->update('tbl_property', $data);
		return $id . '|' . $private_code;
	}
	function addEditEscape_detail()
	{
		if($this->input->post('property_id'))
		{
			$private_code = $this->input->post('private_code');
			$created_date = $this->input->post('created_date');
		}
		else
		{
			$private_code = $this->genRandomString('12'); 
			$created_date = date("Y-m-d H:i:s");
		}
		$updated_date = date("Y-m-d H:i:s");
		$data = array(
			'bedroom' => $this->input->post('bedroom'),
			'bathroom' => $this->input->post('bathroom'),
			'adult' => $this->input->post('adult'),
			'children' => $this->input->post('children'),
			'pet' => $this->input->post('pet'),
			'property_status' => '0',
			'owner_id' => $this->session->userdata('user_id'),
			'private_code' => $private_code,
			'created_date' => $created_date,
			'updated_date' => $updated_date,
			'admin_action' => 'pending'
		);
		if($this->input->post('property_id') !=''):
			$this->db->update('tbl_property', $data, array('id' => $this->input->post('property_id')));
			$id = $this->input->post('property_id');
		else:
			$this->db->insert('tbl_property', $data);
			$id = $this->db->insert_id();
		endif;
		return $id . '|' . $private_code;
	}
	function getAllProperty($limit, $start)
	{
		$owner_id = $this->session->userdata('user_id');
		$sql = "select * from tbl_property where owner_id = '" . $owner_id . "' order by created_date desc limit $start, $limit";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function record_all_Property()
	{
		$owner_id = $this->session->userdata('user_id');
		$sql = "select * from tbl_property where owner_id = '" . $owner_id . "'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function getPropertyInfo()
	{
		$query = $this->db->get_where('tbl_property');
		return $query->row();
	}
	function getPropertyInfobyID($id)
	{
		$query = $this->db->get_where('tbl_property',array('id' => $id));
		return $query->row();
	}
	function getPropertyInfobyCode($code)
	{
		$query = $this->db->get_where('tbl_property',array('private_code' => $code));
		return $query->row();
	}
	function addgeneralinfo()
	{
		$private_code = $this->genRandomString('12');
		$data = array(
			'country_id' => $this->input->post('country_id'),
			'city_id' => $this->input->post('city_id'),
			'category_id' => $this->input->post('category_id'),
			'title' => $this->input->post('title'),
			'detail' => $this->input->post('detail'),
			'street_no' => $this->input->post('street_no'),
			'street_name' => $this->input->post('street_name'),
			'suburb' => $this->input->post('suburb'),
			'avenue' => $this->input->post('avenue'),
			'postcode' => $this->input->post('postcode'),
			'price_night' => $this->input->post('price_night'),
			'price_week' => $this->input->post('price_week'),
			'price_month' => $this->input->post('price_month'),
			'owner_id' => $this->session->userdata('user_id'),
			'private_code' => $private_code,
		);
		$this->db->insert('tbl_property', $data);
		$id = $this->db->insert_id();
		return $id;
	}
	function update_feature_img($id, $img_name)
	{
		$data = array(
			'featured_image' => $img_name
		);
		$this->db->where('id', $id);
		$this->db->update('tbl_property', $data); 
	}
	function genRandomString($length='') {
		if($length=='')
		{
			$length =20;
		}
		$characters = '12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ';
		$string = '';    
		for ($p = 0; $p < $length; $p++) {
			$string .= $characters[mt_rand(0, strlen($characters))];
		}
		return $string;
	}
	function editgeneralInfo()
	{
		$id = $this->input->post('prop_id');
		$data = array(
			'country_id' => $this->input->post('country_id'),
			'city_id' => $this->input->post('city_id'),
			'category_id' => $this->input->post('category_id'),
			'title' => $this->input->post('title'),
			'detail' => $this->input->post('detail'),
			'street_no' => $this->input->post('street_no'),
			'street_name' => $this->input->post('street_name'),
			'suburb' => $this->input->post('suburb'),
			'avenue' => $this->input->post('avenue'),
			'postcode' => $this->input->post('postcode'),
			'price_night' => $this->input->post('price_night'),
			'price_week' => $this->input->post('price_week'),
			'price_month' => $this->input->post('price_month'),
			'owner_id' => $this->session->userdata('user_id'),
		);
		$this->db->where('id', $id);
		$this->db->update('tbl_property', $data); 
	}
    function getAmenitiesByID($id)
    {
        $query = $this->db->get_where('tbl_property',array('id' => $id));
        return $query->row();
    }
    function addEditamenities(){
        $data = array('amenities' => $this->input->post('amenities_detail'));
        $this->db->where('id', $this->input->post('prop_id'));
        $this->db->update('tbl_property', $data); 
    }
    function galleryImageUpload($id, $img_array)
    {
        $escape_id = $this->input->post('property_id');
        foreach($img_array as $key => $val)
        {
            $data = array('property_id' =>  $escape_id, 'image' => $val);
            $this->db->insert('tbl_property_images', $data); 
        }
    }
	function galleryVideoUpload($id)
	{
		$escape_id = $this->input->post('property_id');
		/*$this->db->delete('tbl_property_videos', array('property_id'=>$escape_id));
		foreach($video_array as $key => $val)
		{
			$data = array('property_id' =>  $escape_id, 'video' => $val);
			$this->db->insert('tbl_property_videos', $data); 
		}*/
		$data = array('youtube_video_id' => $this->input->post('property_video'));
		$this->db->where('id', $escape_id);
		$this->db->update('tbl_property', $data);
	}
	function propertyExtraInfo($id)
	{
		//echo '<pre>';print_r($_POST);echo '</pre>';exit();
		if(array_key_exists('bedroom',$_POST))
		{
			$bedroom = $this->input->post('bedroom');
			$bathroom = $this->input->post('bathroom');
			$adult = $this->input->post('adult');
			$children = $this->input->post('children');
			$pet = $this->input->post('pet');
			$datax = array('bedroom' => $bedroom,
				'bathroom' => $bathroom,
				'adult' => $adult,
				'children' => $children,
				'pet' => $pet
			);
			$this->db->where('id', $id);
			$this->db->update('tbl_property', $datax); 
		}
		if (array_key_exists('item', $_POST)) {
			$items = $_POST['item'];
			foreach($items as $a)
			{
				if(($a['type'] != '') && ($a['value'] != ''))
				{
					$data = array('property_id' =>  $id, 'type' => trim(strtolower($a['type'])), 'value' => trim(strtolower($a['value'])));
					$this->db->insert('tbl_extra_property', $data); 
				}
			}
		}
	}
    function getAllGalleriesByID($id)
    {
         $query = $this->db->get_where('tbl_property_images',array('property_id' => $id));
         return $query->result();
    }
    function getAllExtraProp($id)
    {
         $query = $this->db->get_where('tbl_extra_property',array('property_id' => $id));
         return $query->result();
    }
    function deleteGallery()
    {
        $id = $this->uri->segment(3);
        $this->db->delete('tbl_property_images', array('id' => $id)); 
    }
	function getGalleryImgByID($id)
	{
		$query = $this->db->get_where('tbl_property_images', array('id' => $id));
		return $query->row();
	}
	function getAllBokingRequest($user_id)
	{
		$status_array = serialize(array('bb' => 2,'oo' => 2));
		$status_array1 = serialize(array('bb' => 1,'oo' => 1));
		$sql = "select a.*,b.title as prop_name, c.first_name as fname, c.last_name as lname from tbl_property b inner join tbl_booking a
		on a.property_id = b.id inner join tbl_users c 
		on b.owner_id = c.id where c.id = " . $user_id . " and a.status != '" . $status_array . "' and  a.status != '".$status_array1."' group by a.id order by a.requested_date desc limit 5";
		//echo $sql;exit();
		$query = $this->db->query($sql);
		return $query->result();
	}
	function getAllBokingRequestBuyer($user_id)
	{
		$status_array = serialize(array('bb' => 1,'oo' => 1));
		$sql = "select a.*,b.title as prop_name, b.owner_id from tbl_property b inner join tbl_booking a
		on a.property_id = b.id inner join tbl_users c 
		on c.id = a.user_id  where a.status != '".$status_array."' and c.id = " . $user_id . " group by a.id order by a.requested_date desc limit 5";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function getAllBokingRequestView($user_id, $limit, $start)
	{
		$status_array = serialize(array('bb' => 2,'oo' => 2));
		$status_array1 = serialize(array('bb' => 1,'oo' => 1));
		$sql = "select a.*,b.title as prop_name, c.first_name as fname, c.last_name as lname from tbl_property b inner join tbl_booking a
		on a.property_id = b.id inner join tbl_users c 
		on b.owner_id = c.id where c.id = " . $user_id . " and a.status != '" . $status_array . "' and  a.status != '".$status_array1."' group by a.requested_date desc limit $start, $limit";
		//echo $sql;exit();
		$query = $this->db->query($sql);
		return $query->result();
	}
	function record_all_bookingR($user_id)
	{
		$status_array = serialize(array('bb' => 2,'oo' => 2));
		$status_array1 = serialize(array('bb' => 1,'oo' => 1));
		$sql = "select a.*,b.title as prop_name, c.first_name as fname, c.last_name as lname from tbl_property b inner join tbl_booking a
		on a.property_id = b.id inner join tbl_users c 
		on b.owner_id = c.id where c.id = " . $user_id . " and a.status != '" . $status_array . "' and  a.status != '".$status_array1."' group by a.id order by a.requested_date desc";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function getAlllatestLists($user_id)
	{
		$sql = "select * from tbl_property where owner_id = " . $user_id . " order by created_date desc limit 5";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function stopResume($code)
	{
		$sql = "select * from tbl_property where private_code = '" . $code . "'";
		$query = $this->db->query($sql);
		$rs = $query->row();
		if($rs->property_status == 0)
		{
			$property_status = 1;
		}
		else{
			$property_status = 0;
		}
		$sql = "update tbl_property set property_status = ".$property_status." where private_code = '" . $code . "'";
		$query = $this->db->query($sql);
	}
	function getAllPropertyView()
	{
		$sql = "select * from tbl_property where owner_id = '" . $user_id . "' order by created_date desc";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function getAlllatestListsx($user_id)
	{
		$sql = "select * from tbl_property where owner_id = " . $user_id . " order by created_date desc limit 5";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function getAllcBokingRequestView($user_id, $limit, $start)
	{
		$status_array = serialize(array('bb' => 2,'oo' => 2));
		$sql = "select a.*,b.title as prop_name,d.short_name, c.first_name as fname, c.last_name as lname from tbl_property b inner join tbl_booking a
			on a.property_id = b.id inner join tbl_users c 
			on b.owner_id = c.id left join tbl_country d on b.country_id=d.id where c.id = " . $user_id . " and a.status = '" . $status_array . "' group by a.id order by a.requested_date desc limit $start, $limit";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function record_all_cbookingR($user_id)
	{
		$status_array = serialize(array('bb' => 2,'oo' => 2));
		$sql = "select a.*,b.title as prop_name, c.first_name as fname, c.last_name as lname from tbl_property b inner join tbl_booking a
			on a.property_id = b.id inner join tbl_users c 
			on b.owner_id = c.id where c.id = " . $user_id . " and a.status = '" . $status_array . "' group by a.id order by a.requested_date";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function getAllConfirmedBooking($user_id)
	{
		$status_array = serialize(array('bb' => 2,'oo' => 2));
		$status_array1 = serialize(array('bb' => 5,'oo' => 5));
		$sql = "select a.*,b.title as prop_name, c.first_name as fname, c.last_name as lname from tbl_property b LEFT join tbl_booking a
			on a.property_id = b.id LEFT join tbl_users c 
			on b.owner_id = c.id where (c.id = '" . $user_id . "') and (a.status = '" . $status_array . "' or a.status = '" . $status_array1 . "') group by a.id order by a.requested_date desc limit 5";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function getAllrequestBuyer($user_id)
	{   
		$status_array = serialize(array('bb' => 0,'oo' => 0));
		$sql = "SELECT tbl_booking.* FROM
			tbl_users
			INNER JOIN tbl_booking 
			ON (tbl_users.id = tbl_booking.user_id) WHERE tbl_booking.status = '$status_array' AND tbl_booking.user_id = $user_id ORDER BY tbl_booking.requested_date DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function record_all_bookingRB($user_id)
	{
		$status_array = serialize(array('bb' => 1,'oo' => 1));
		$sql = "SELECT tbl_booking.* FROM
			tbl_users
			INNER JOIN tbl_booking 
			ON (tbl_users.id = tbl_booking.user_id) WHERE tbl_booking.status = '$status_array' AND tbl_booking.user_id = $user_id ORDER BY tbl_booking.requested_date DESC";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function cancelBookingByBuyer($id)
	{
		$status_array = serialize(array('bb' => 1,'oo' => 0));
		$object = array('status' => $status_array);
		$this->db->where('id', $id);
		$this->db->update('tbl_booking', $object); 
		$booking = $this->getBookingByID($id);
		$property = $this->getPropByID($booking->property_id);
		$ownerrs = $this->getUserByID($property->owner_id);
		$buyer = $this->getUserByID($booking->user_id);
		$date = new DateTime($booking->end_date);
		$date->modify('+1 day');
		$end_date = $date->format('Y-m-d');
		//notification
		$title_notes = 'Booking request for '.$property->title.' has been cancelled by guest.';
		$detail_notes = $title_notes.'. The details are as following<br>';
		$detail_notes .= 'Property: ' . $property->title.'<br>';
		$detail_notes .= 'Check In: ' . $booking->start_date.'<br>';
		$detail_notes .= 'Check Out: ' . $end_date .'<br>';
		$detail_notes .= 'Total Booked Days: ' . $booking->booked_days.'<br>';
		$detail_notes .= 'No. of Guests: ' . $booking->no_of_guests .'<br>';
		$detail_notes .= 'Total Price: ' . $booking->total_price .'<br>';
		$notesf = array('title' => $title_notes, 'detail' => $detail_notes, 'created_date' => date("Y-m-d H:i:s"), 'status' => 0, 'user_id' => $property->owner_id);
		$this->db->insert('tbl_notifications', $notesf); 
		//notification
		///sending emal to owner start
		$from_email = "info@gr8escapes.com";
		$detail = 'Property: ' . $property->title.'<br>';
		$detail .= 'Check In: ' . $booking->start_date.'<br>';
		$detail .= 'Check Out: ' . $end_date .'<br>';
		$detail .= 'Total Booked Days: ' . $booking->booked_days.'<br>';
		$detail .= 'No. of Guests: ' . $booking->no_of_guests .'<br>';
		$detail .= 'Total Price: ' . $booking->total_price .'<br>';
		$headers = "From: ".$from_email."\r\n" .
		"Reply-To: ".$from_email."\r\n" .
		'X-Mailer: PHP/' . phpversion() . "\r\n" .
		"MIME-Version: 1.0\r\n" .
		"Content-Type: text/html; charset=utf-8\r\n" .
		"Content-Transfer-Encoding: 8bit\r\n\r\n";
		$subject='Cancellation of Booking request for '.$property->title.'!';
		$emailbody = '<p>Dear '.$ownerrs->first_name.' '.$ownerrs->last_name. ',</p><br/>';
		$emailbody .= '<p>The booking request for '.$property->title.' has been cancelled. The details are as following</p><br/>';
		$emailbody .= $detail;
		$emailbody .= '<br/>';
		$emailbody .= 'Thank You<br/><strong>Support Team</strong><br/><strong>gr8 escapes</strong>';
		@mail($ownerrs->email,$subject,$emailbody,$headers);
		///sending emal to owner end
		///sending emal to buyer start
		$headers1 = "From: ".$from_email."\r\n" .
		"Reply-To: ".$from_email."\r\n" .
		'X-Mailer: PHP/' . phpversion() . "\r\n" .
		"MIME-Version: 1.0\r\n" .
		"Content-Type: text/html; charset=utf-8\r\n" .
		"Content-Transfer-Encoding: 8bit\r\n\r\n";
		$subject1='Cancellation of Booking request for '.$property->title.'!';
		$emailbody1 = '<p>Dear '.$buyer->first_name.' '.$buyer->last_name. ',</p><br/>';
		$emailbody1 .= '<p>The Booking request for '.$property->title.' has been cancelled. The details are as following</p><br/>';
		$emailbody1 .= $detail;
		$emailbody1 .= '<br/>';
		$emailbody1 .= 'Thank You<br/><strong>Support Team</strong><br/><strong>gr8 escapes</strong>';
		@mail($buyer->email,$subject1,$emailbody1,$headers1);
	}
	function getBookingByID($bid)
	{
		$query = $this->db->get_where('tbl_booking', array('id' => $bid));
		return $query->row();
	}
	function getPropByID($propid)
	{
		$query = $this->db->get_where('tbl_property', array('id' => $propid));
		return $query->row();
	}
	function getUserByID($usrid)
	{
		$query = $this->db->get_where('tbl_users', array('id' => $usrid));
		return $query->row();
	}
	function cancelBookingByOwner($id)
	{
		$status_array = serialize(array('bb' => 0,'oo' => 1));
		$object = array('status' => $status_array);
		$this->db->where('id', $id);
		$this->db->update('tbl_booking', $object); 
		$booking = $this->getBookingByID($id);
		$property = $this->getPropByID($booking->property_id);
		$ownerrs = $this->getUserByID($property->owner_id);
		$buyer = $this->getUserByID($booking->user_id);
		$date = new DateTime($booking->end_date);
		$date->modify('+1 day');
		$end_date = $date->format('Y-m-d');
		//notification
		$title_notes = 'Booking request for '.$property->title.' has been declined by owner.';
		$detail_notes = $title_notes.'. The details are as following<br>';
		$detail_notes .= 'Property: ' . $property->title.'<br>';
		$detail_notes .= 'Check In: ' . $booking->start_date.'<br>';
		$detail_notes .= 'Check Out: ' . $end_date .'<br>';
		$detail_notes .= 'Total Booked Days: ' . $booking->booked_days.'<br>';
		$detail_notes .= 'No. of Guests: ' . $booking->no_of_guests .'<br>';
		$detail_notes .= 'Total Price: ' . $booking->total_price .'<br>';
		$notesf = array('title' => $title_notes, 'detail' => $detail_notes, 'created_date' => date("Y-m-d H:i:s"), 'status' => 0, 'user_id' => $booking->user_id);
		$this->db->insert('tbl_notifications', $notesf); 
		//notification
		///sending emal to owner start
		$from_email = "info@gr8escapes.com";
		$detail = 'Property: ' . $property->title.'<br>';
		$detail .= 'Check In: ' . $booking->start_date.'<br>';
		$detail .= 'Check Out: ' . $end_date .'<br>';
		$detail .= 'Total Booked Days: ' . $booking->booked_days.'<br>';
		$detail .= 'No. of Guests: ' . $booking->no_of_guests .'<br>';
		$detail .= 'Total Price: ' . $booking->total_price .'<br>';
		$headers = "From: ".$from_email."\r\n" .
		"Reply-To: ".$from_email."\r\n" .
		'X-Mailer: PHP/' . phpversion() . "\r\n" .
		"MIME-Version: 1.0\r\n" .
		"Content-Type: text/html; charset=utf-8\r\n" .
		"Content-Transfer-Encoding: 8bit\r\n\r\n";
		$subject='Cancellation of Booking request for '.$property->title.'!';
		$emailbody = '<p>Dear '.$ownerrs->first_name.' '.$ownerrs->last_name. ',</p><br/>';
		$emailbody .= '<p>The booking request for '.$property->title.' has been cancelled. The details are as following</p><br/>';
		$emailbody .= $detail;
		$emailbody .= '<br/>';
		$emailbody .= 'Thank You<br/><strong>Support Team</strong><br/><strong>gr8 escapes</strong>';
		@mail($ownerrs->email,$subject,$emailbody,$headers);
		///sending emal to owner end
		///sending emal to buyer start
		$headers1 = "From: ".$from_email."\r\n" .
		"Reply-To: ".$from_email."\r\n" .
		'X-Mailer: PHP/' . phpversion() . "\r\n" .
		"MIME-Version: 1.0\r\n" .
		"Content-Type: text/html; charset=utf-8\r\n" .
		"Content-Transfer-Encoding: 8bit\r\n\r\n";
		$subject1='Cancellation of Booking request for '.$property->title.'!';
		$emailbody1 = '<p>Dear '.$buyer->first_name.' '.$buyer->last_name. ',</p><br/>';
		$emailbody1 .= '<p>The Booking request for '.$property->title.' has been cancelled. The details are as following</p><br/>';
		$emailbody1 .= $detail;
		$emailbody1 .= '<br/>';
		$emailbody1 .= 'Thank You<br/><strong>Support Team</strong><br/><strong>gr8 escapes</strong>';
		@mail($buyer->email,$subject1,$emailbody1,$headers1);
		///sending emal to buyer end
	}
	function confirmBookingByOwner($id)
	{
		$status_array = serialize(array('bb' => 2,'oo' => 2));
		$object = array('status' => $status_array);
		$this->db->where('id', $id);
		$this->db->update('tbl_booking', $object); 
		$booking = $this->getBookingByID($id);
		$property = $this->getPropByID($booking->property_id);
		$ownerrs = $this->getUserByID($property->owner_id);
		$buyer = $this->getUserByID($booking->user_id);
		$date = new DateTime($booking->end_date);
		$date->modify('+1 day');
		$end_date = $date->format('Y-m-d');
		//notification
		$title_notes = 'Booking request for '.$property->title.' has been confirmed by owner.';
		$detail_notes = $title_notes.'. The details are as following<br>';
		$detail_notes .= 'Property: ' . $property->title.'<br>';
		$detail_notes .= 'Check In: ' . $booking->start_date.'<br>';
		$detail_notes .= 'Check Out: ' . $end_date .'<br>';
		$detail_notes .= 'Total Booked Days: ' . $booking->booked_days.'<br>';
		$detail_notes .= 'No. of Guests: ' . $booking->no_of_guests .'<br>';
		$detail_notes .= 'Total Price: ' . $booking->total_price .'<br>';
		$notesf = array('title' => $title_notes, 'detail' => $detail_notes, 'created_date' => date("Y-m-d H:i:s"), 'status' => 0, 'user_id' => $booking->user_id);
		$this->db->insert('tbl_notifications', $notesf); 
		//notification
		///sending emal to owner start
		$from_email = "info@gr8escapes.com";
		$detail = 'Property: ' . $property->title.'<br>';
		$detail .= 'Check In: ' . $booking->start_date.'<br>';
		$detail .= 'Check Out: ' . $end_date .'<br>';
		$detail .= 'Total Booked Days: ' . $booking->booked_days.'<br>';
		$detail .= 'No. of Guests: ' . $booking->no_of_guests .'<br>';
		$detail .= 'Total Price: ' . $booking->total_price .'<br>';
		$headers = "From: ".$from_email."\r\n" .
		"Reply-To: ".$from_email."\r\n" .
		'X-Mailer: PHP/' . phpversion() . "\r\n" .
		"MIME-Version: 1.0\r\n" .
		"Content-Type: text/html; charset=utf-8\r\n" .
		"Content-Transfer-Encoding: 8bit\r\n\r\n";
		$subject='Confirmation of Booking request for '.$property->title.'!';
		$emailbody = '<p>Dear '.$ownerrs->first_name.' '.$ownerrs->last_name. ',</p><br/>';
		$emailbody .= '<p>The booking request for '.$property->title.' has been confirmed. The details are as following</p><br/>';
		$emailbody .= $detail;
		$emailbody .= '<br/>';
		$emailbody .= 'Thank You<br/><strong>Support Team</strong><br/><strong>gr8 escapes</strong>';
		@mail($ownerrs->email,$subject,$emailbody,$headers);
		///sending emal to owner end
		///sending emal to buyer start
		$headers1 = "From: ".$from_email."\r\n" .
		"Reply-To: ".$from_email."\r\n" .
		'X-Mailer: PHP/' . phpversion() . "\r\n" .
		"MIME-Version: 1.0\r\n" .
		"Content-Type: text/html; charset=utf-8\r\n" .
		"Content-Transfer-Encoding: 8bit\r\n\r\n";
		$subject1='Confirmation of Booking request for '.$property->title.'!';
		$emailbody1 = '<p>Dear '.$buyer->first_name.' '.$buyer->last_name. ',</p><br/>';
		$emailbody1 .= '<p>The Booking request for '.$property->title.' has been confirmed. The details are as following</p><br/>';
		$emailbody1 .= $detail;
		$emailbody1 .= '<br/>';
		$emailbody1 .= 'Thank You<br/><strong>Support Team</strong><br/><strong>gr8 escapes</strong>';
		@mail($buyer->email,$subject1,$emailbody1,$headers1);
	}
	function deleteBookingBuyer($id)
	{
		$status_array = serialize(array('bb' => 1,'oo' => 1));
		$object = array('status' => $status_array);
		$this->db->where('id', $id);
		$this->db->update('tbl_booking', $object); 
	}
	function deleteBookingBuyera($id)
	{
		$status_array = serialize(array('bb' => 1,'oo' => 1));
		$object = array('status' => $status_array);
		$this->db->where('id', $id);
		$this->db->update('tbl_booking', $object); 
	}
	function deleteBookingOwner($id)
	{
		$status_array = serialize(array('bb' => 1,'oo' => 1));
		$object = array('status' => $status_array);
		$this->db->where('id', $id);
		$this->db->update('tbl_booking', $object); 
	}
	function getUnreadNotifications($user_id)
	{
		$query = $this->db->get_where('tbl_notifications', array('user_id' => $user_id, 'status' => 0));
		return $query->num_rows();
	}
	function getAllNotifications($user_id)
	{
		$query = $this->db->select('*');
		$query = $this->db->from('tbl_notifications');
		$query = $this->db->where(array('user_id' => $user_id));
		$query = $this->db->order_by('created_date','desc');
		$query = $this->db->get();
		return $query->result();
	}
	function getNotif($id)
	{
		$query = $this->db->get_where('tbl_notifications', array('id' => $id));
		return $query->row();
	}
	function updateNotif($id)
	{
		$data = array('status' => 1);
		$this->db->where(array('id' => $id));
		$this->db->update('tbl_notifications', $data);
	}
	function deleteNotif($id)
	{
		$this->db->where(array('id' => $id));
		$this->db->delete('tbl_notifications'); 
	}
	function getPendingBalance($user_id)
	{
		$month = date("m");
		$year = date("Y");
		$status_array = serialize(array('bb' => 5,'oo' => 5));
		$sql = "select a.*,b.title as prop_name, c.first_name as fname, c.last_name as lname from tbl_property b inner join tbl_booking a
			on a.property_id = b.id inner join tbl_users c 
			on b.owner_id = c.id where c.id = " . $user_id . " and a.status = '" . $status_array . "' and month = '".$month."' and year = '".$year."' group by a.id order by a.requested_date desc limit 10";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function getPendingBalanceAll($user_id)
	{
		$month =  date("m");
		$year = date("Y");
		$status_array = serialize(array('bb' => 5,'oo' => 5));
		$sql = "select sum(a.total_price) as grand_total from tbl_property b inner join tbl_booking a
			on a.property_id = b.id inner join tbl_users c 
			on b.owner_id = c.id where c.id = " . $user_id . " and a.status = '" . $status_array . "' and month = '".$month."' and year = '".$year."'";
		$query = $this->db->query($sql);
		return $query->row();
	}
	function getPendingBalanceD($user_id)
	{
		if($this->input->post('filter_month') == 1)
		{
			$month = $this->input->post('month');
			$year = date("Y");
			$status_array = serialize(array('bb' => 5,'oo' => 5));
			$sql = "select a.*,b.title as prop_name, c.first_name as fname, c.last_name as lname from tbl_property b inner join tbl_booking a
				on a.property_id = b.id inner join tbl_users c 
				on b.owner_id = c.id where c.id = " . $user_id . " and a.status = '" . $status_array . "' and month = '".$month."' and year = '".$year."' group by a.id order by a.requested_date desc";
		}
		else
		{
			$month = date("m");
			$year = date("Y");
			$status_array = serialize(array('bb' => 5,'oo' => 5));
			$sql = "select a.*,b.title as prop_name, c.first_name as fname, c.last_name as lname from tbl_property b inner join tbl_booking a
				on a.property_id = b.id inner join tbl_users c 
				on b.owner_id = c.id where c.id = " . $user_id . " and a.status = '" . $status_array . "' and month = '".$month."' and year = '".$year."' group by a.id order by a.requested_date desc";
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	function getPendingBalanceAllD($user_id)
	{
		if($this->input->post('filter_month') == 1)
		{
			$month = $this->input->post('month');
			$year = date("Y");
			$status_array = serialize(array('bb' => 5,'oo' => 5));
			$sql = "select sum(a.total_price) as grand_total from tbl_property b inner join tbl_booking a
				on a.property_id = b.id inner join tbl_users c 
				on b.owner_id = c.id where c.id = " . $user_id . " and a.status = '" . $status_array . "' and month = '".$month."' and year = '".$year."'";
		}
		else
		{
			$month =  date("m");
			$year = date("Y");
			$status_array = serialize(array('bb' => 5,'oo' => 5));
			$sql = "select sum(a.total_price) as grand_total from tbl_property b inner join tbl_booking a
				on a.property_id = b.id inner join tbl_users c 
				on b.owner_id = c.id where c.id = " . $user_id . " and a.status = '" . $status_array . "' and month = '".$month."' and year = '".$year."'";
		}
		$query = $this->db->query($sql);
		return $query->row();
	}
	function getPreviousMnthRecords($user_id)
	{
		$month =  date("m") - 1;
		$year = date("Y");
		$status_array = serialize(array('bb' => 5,'oo' => 5));
		$sql = "select sum(a.total_price) as grand_total from tbl_property b inner join tbl_booking a
			on a.property_id = b.id inner join tbl_users c 
			on b.owner_id = c.id where c.id = " . $user_id . " and a.status = '" . $status_array . "' and month = '".$month."' and year = '".$year."'";
		$query = $this->db->query($sql);
		return $query->row();
	}
	function getPreviousMonthEarn($user_id)
	{
		$month =  date("m") - 1;
		$year = date("Y");
		$status_array = serialize(array('bb' => 5,'oo' => 5));
		$sql = "select a.*,b.title as prop_name, c.first_name as fname, c.last_name as lname from tbl_property b inner join tbl_booking a
			on a.property_id = b.id inner join tbl_users c 
			on b.owner_id = c.id where c.id = " . $user_id . " and a.status = '" . $status_array . "' and month = '".$month."' and year = '".$year."' group by a.id order by a.requested_date desc limit 10";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function getPrevMonthEarn($user_id)
	{
		$month =  date("m") - 1;
		$year = date("Y");
		$status_array = serialize(array('bb' => 5,'oo' => 5));
		$sql = "select sum(a.total_price) as grand_total from tbl_property b inner join tbl_booking a
			on a.property_id = b.id inner join tbl_users c 
			on b.owner_id = c.id where c.id = " . $user_id . " and a.status = '" . $status_array . "' and month = '".$month."' and year = '".$year."'";
		//            echo $sql;exit();
		$query = $this->db->query($sql);
		return $query->row();
	}
	function prevMnthTranx($user_id)
	{
		$month =  date("m") - 1;
		$year = date("Y");
		$status_array = serialize(array('bb' => 5,'oo' => 5));
		$sql = "select a.*,b.title as prop_name, c.first_name as fname, c.last_name as lname from tbl_property b inner join tbl_booking a
			on a.property_id = b.id inner join tbl_users c 
			on b.owner_id = c.id where c.id = " . $user_id . " and a.status = '" . $status_array . "' and month = '".$month."' and year = '".$year."' group by a.id order by a.requested_date desc";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function month_name($int) {
		return date( 'F' , mktime(1, 1, 1, (int)$int, 1) );
	}
	function downloadCsvByMonth($m)
	{
		$user_id = $this->session->userdata('user_id');
		$month = $m;
		$year = date("Y");
		$status_array = serialize(array('bb' => 5,'oo' => 5));
		$sql = "select a.*,b.title as prop_name, c.first_name as fname, c.last_name as lname from tbl_property b inner join tbl_booking a
			on a.property_id = b.id inner join tbl_users c 
			on b.owner_id = c.id where c.id = " . $user_id . " and a.status = '" . $status_array . "' and month = '".$month."' and year = '".$year."' group by a.id order by a.requested_date desc";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function updateUserType($user_id)
	{
		$data = array('user_type' => 2);
		$this->db->where(array('id' => $user_id));
		$this->db->update('tbl_users', $data);
	}
	///message
	function getInboxItems($to_id){
		$query = $this->db->select('*');
		$query = $this->db->from('tbl_users');
		$query = $this->db->join('tbl_message' , 'tbl_users.id = tbl_message.from','inner' );
		$query = $this->db->where(array('to_action'=>1, 'to'=> $to_id));
		$query = $this->db->get();
		//$query = $this->db->get_where('tbl_message', array('to'=>$to_id,'to_action'=> 1));
		return $query->result();
	}
	function getSentItems($from_id){
		$query = $this->db->select('*');
		$query = $this->db->from('tbl_users');
		$query = $this->db->join('tbl_message' , 'tbl_message.to = tbl_users.id','inner' );
		$query = $this->db->where(array('from_action'=>1, 'from'=> $from_id));
		$query = $this->db->get();
		return $query->result();
	}
	function countMessage($id){
		$query = $this->db->get_where('tbl_message',array('to'=> $id, 'from_status'=> 1));
		$count = $query->num_rows();
		return $count;
	}
	function loadMessage($id){
		$data = array('from_status'=> 2);
		$query = $this->db->where('m_id', $id);
		$query = $this->db->update('tbl_message', $data);
		$query = $this->db->select('*');
		$query = $this->db->from('tbl_users');
		$query = $this->db->where(array('m_id'=> $id));
		$query = $this->db->join('tbl_message' , 'tbl_message.from = tbl_users.id','inner' );
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	function trashMessage(){
		if($this->session->userdata('type') == 'inbox'){
			$data = array('to_action'=> 2);
		}
		elseif($this->session->userdata('type') == 'sent'){
			$data = array('from_action'=> 2);
		}
		else{
			echo 'Error'.mysql_error(); die();
		}
		$mid = $this->uri->segment(3);
		$query = $this->db->where(array('m_id'=>$mid));
		$query = $this->db->update('tbl_message', $data);
		$q = $this->db->select('from_action, to_action');
		$q = $this->db->from('tbl_message');
		$q = $this->db->where(array('m_id'=> $mid));
		$q = $this->db->get();
		$res = $q->row();
		if(@$res->from_action == 2 && $res->to_action == 2){
			$this->db->delete('tbl_message', array('m_id'=> $mid));
			$this->db->delete('tbl_message_details',array('message_id'=>$mid));
			$this->session->unset_userdata('type');
		}
	}
	function sendMessage($msg){
		$message = $msg;
		$data = array(
			'message_id' => $this->input->post('message_id'),
			'detail'   =>  $message,
		);
		$this->db->insert('tbl_message_details', $data);
	}
	function loadReplies($id){
		$query = $this->db->get_where('tbl_message_details',array('message_id'=>$id));
		$result = $query->result();
		return $result;
	}
	//message
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
	function all_property_by_ownerID($user_id)
	{
		$sql = 'select * from tbl_property where owner_id = ' . $user_id;
		$query = $this->db->query($sql);
		return $query->result();
	}
	function is_rated_prop($propid)
	{
		$sql = 'select * from tbl_property_review where property_id = ' . $propid;
		$query = $this->db->query($sql);
		return count($query->result());
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
	function get_avg_rate_by_prop($rated_prop)
	{
		$reviews_cat = $this->get_all_reviews_cat();
		$total_avgt = 0;
		foreach($reviews_cat as $rc)
		{
			$sql = "select AVG(ratings) as avgr from tbl_property_review
			where property_id = " . $rated_prop->property_id . " and rcatid = ".$rc->rcatid;
			$query = $this->db->query($sql);
			$eachcat_avg_rate =  $query->row();
			$total_avgt +=  $eachcat_avg_rate->avgr;
		}
		return $total_avgt;
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
	function get_user_ratings_category()
	{
		$sql = "select * from tbl_users_ratings_category order by id asc";
		$query = $this->db->query($sql);
		return $query->result();
	}
    function getAllRateCategory()
    {
        $query = $this->db->get('tbl_users_ratings_category');
        return $query->result();
    }
	function getTotalRate()
	{
		$user_id = $this->session->userdata('user_id');
		$sql = "select * from tbl_users_rate_review
			where user_id = " . $user_id . "";
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
    function getAllEscapes()
    {
        $sql = "select * from tbl_types_escape";
        $query = $this->db->query($sql);
        return $query->result();
    }
    function property_category($property_id)
    {
        $this->db->where('property_id', $property_id);
        $this->db->delete('tbl_property_cats');
	if (isset($_POST['property_category'])){
		$property_category = $_POST['property_category'];
		foreach($property_category  as $pc)
		{
		    $data = array(
		      'property_id' => $property_id,
		      'category_id'   => $pc
		    );
		    $this->db->insert('tbl_property_cats', $data);
		}
	}
    }
	function propertySkyChannel($property_id)
    {
        $this->db->where('property_id', $property_id);
        $this->db->delete('tbl_property_sky_channels');
	if (isset($_POST['property_sky_channel'])){
		$property_sky_channel = $_POST['property_sky_channel'];
		foreach($property_sky_channel  as $pc)
		{
		    $data = array(
		      'property_id' => $property_id,
		      'category_id'   => $pc
		    );
		    $this->db->insert('tbl_property_sky_channel', $data);
		}
	}
    }
	
	
	function property_amenities()
	{
		if ($this->input->post('property_id')){
			$this->db->where('property_id', $this->input->post('property_id'));
			$this->db->delete('tbl_property_amenities');
		}
		$property_amenity = $_POST['property_amenity'];
		if($this->input->post('property_id'))
		{
			$private_code = $this->input->post('private_code');
			$created_date = $this->input->post('created_date');
		}
		else
		{
			$private_code = $this->genRandomString('12'); 
			$created_date = date("Y-m-d H:i:s");
		}
		$updated_date = date("Y-m-d H:i:s");
		$data = array(
			'owner_id' => $this->session->userdata('user_id'),
			'private_code' => $private_code,
			'created_date' => $created_date,
			'updated_date' => $updated_date,
			'property_status' => '0',
			'admin_action' => 'pending'
		);
		if($this->input->post('property_id') !=''):
			$this->db->update('tbl_property', $data, array('id' => $this->input->post('property_id')));
			$id = $this->input->post('property_id');
		else:
			$this->db->insert('tbl_property', $data);
			$id = $this->db->insert_id();
		endif;
		foreach($property_amenity as $pa){
			$data = array('property_id'=>$id, 'amenities_id'=>$pa);
			$this->db->insert('tbl_property_amenities', $data);
		}
		return $id . '|' . $private_code;
	}
	function get_property_category($property_id)
	{
		$query = $this->db->get_where('tbl_property_cats',array('property_id'=>$property_id));
		$terms = $query->result();
		$output = array();
		foreach($terms as $term){
			array_push($output, $term->category_id);
		}
		return $output;
	}
	/*
	* Function to get all Property Sky channels
	*/
	function get_property_sky_channel($property_id)
	{
		$query = $this->db->get_where('tbl_property_sky_channels',array('property_id'=>$property_id));
		$terms = $query->result();
		$output = array();
		foreach($terms as $term){
			array_push($output, $term->sky_channel_id);
		}
		return $output;
	}
	function get_property_amenity($property_id){
		$query = $this->db->get_where('tbl_property_amenities', array('property_id'=>$property_id));
		$terms = $query->result();
		$output = array();
		foreach($terms as $term){
			array_push($output, $term->amenities_id);
		}
		return $output;
	}
	function get_city_name($property_id){
		$query = $this->db->select('tbl_city.city_name');
		$query = $this->db->from('tbl_city');
		$query = $this->db->where('tbl_property.id', $property_id);
		$query = $this->db->join('tbl_property' , 'tbl_property.city_id = tbl_city.id','inner' );
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	function get_type_escape_name($type_id){
		$this->db->where('id', $type_id);
		$this->db->limit(1);
		$query = $this->db->get('tbl_types_escape');
		return $query->row();
	}
	function get_country_name_by_id($id){
		$this->db->where('id', $id);
		$this->db->limit(1);
		$query = $this->db->get('tbl_country');
		return $query->row();
	}
	function get_region_name_by_id($id){
		$this->db->where('id', $id);
		$this->db->limit(1);
		$query = $this->db->get('tbl_region');
		return $query->row();
	}
	function get_city_name_by_id($id){
		$this->db->where('id', $id);
		$this->db->limit(1);
		$query = $this->db->get('tbl_city');
		return $query->row();
	}
	function get_suburb_name_by_id($id){
		$this->db->where('id', $id);
		$this->db->limit(1);
		$query = $this->db->get('tbl_suburb');
		return $query->row();
	}
	
	/*
	* Function to save/update Information
	*/
	function saveInformation()
    {
		$private_code           =   '';
		$created_date           =   '';
		$existing_amenities_id  =   '';
		$check_in_time          =   '';
		$check_out_time         =   '';
		$check_in_time          =   '';
		$check_out_time         =   '';
		$standard_start_date    =   '';
		$standard_end_date      =   '';
		$standard_start         =   '';
		$standard_end           =   '';
		$custom_url             =   '';
		
		$winter_start_date      = '';
		$winter_end_date        = '';
		$winter_start           = '';
		$winter_end             = '';
		
		$holiday_start_date = '';
		$holiday_end_date = '';
		$holiday_start = '';
		$holiday_end = '';
		
		$summer_start_date = '';
		$summer_end_date = '';
		$summer_start = '';
		$summer_end = '';  
		
		///// custom url of the selected country ///////////////////
		
		/* if(isset($_POST['country_id']) && $_POST['country_id']!=0) {
			$this->db->where('id', $_POST['country_id']);
			$this->db->select('short_name');
			$query = $this->db->get('tbl_country');
			if ($query->num_rows() > 0){
				$custom_url = $query->row()->short_name;
			}else{
				$custom_url = 'NZ';
			}
			
		} */
	
		if(isset($_POST['check_in_date']) && !empty($_POST['check_in_date'])) {
			$check_in_time = date("H:i", strtotime($_POST['check_in_date'])); 
		}
		if(isset($_POST['check_out_date']) && !empty($_POST['check_out_date'])) {
			$check_out_time = date("H:i", strtotime($_POST['check_out_date']));
		}
		
		//////// season rates in YYYY-MM-DD fo storage in database
		if(!empty($_POST['standard_start_date'])) {
			$standard_start_date = $this->changeToYYYY($_POST['standard_start_date']);
		}	
		
		if(!empty($_POST['standard_end_date'])) {
			$standard_end_date = $this->changeToYYYY($_POST['standard_end_date']);
		}	
		if(!empty($_POST['winter_start_date'])) {
			$winter_start_date = $this->changeToYYYY($_POST['winter_start_date']);
		}
		if(!empty($_POST['winter_end_date'])) {
			$winter_end_date = $this->changeToYYYY($_POST['winter_end_date']);
		}
		if(!empty($_POST['holiday_start_date'])) {
			$holiday_start_date = $this->changeToYYYY($_POST['holiday_start_date']);
		}
		if(!empty($_POST['holiday_end_date'])) {
			$holiday_end_date = $this->changeToYYYY($_POST['holiday_end_date']);
		}
		if(!empty($_POST['summer_start_date'])) {
			$summer_start_date = $this->changeToYYYY($_POST['summer_start_date']);
		}
		if(!empty($_POST['summer_end_date'])) {
			$summer_end_date = $this->changeToYYYY($_POST['summer_end_date']); 
		}
		
		
		
		$data=array();
		if(isset($_POST['property_id']) && !empty($_POST['property_id']) ) {
			$private_code = $_POST['property_code'];
			$created_date = $_POST['created_date'];
		} else {
			$private_code = $this->genRandomString('12'); 
			$created_date = date("Y-m-d H:i:s");
		}
		
		if($_POST['current_index']==0) { 
	
					$data = array(
						'title' =>$_POST['escape_title'],
						'detail' => $_POST['escape_detail'],
						'booking_type' => $_POST['booking_type'],
						'type_escape_id' => $_POST['type_of_escape'],
						'guest_capacity' => $_POST['guest_capacity'],
						'children' => $_POST['children_allowed'],
						'safety_children' => $_POST['safety_children'],
						'pet' => $_POST['pet_allowed'],
						'check_in_date' => $check_in_time,
						'check_out_date' => $check_out_time,
						'smoking' => $_POST['smoking'],
						'photographer' => $_POST['photographer'],
						'youtube_video_id' => $_POST['property_video'],
                                                'phone' => $_POST['escape_phone'] ? $_POST['escape_phone'] : FALSE,
						'age' => $_POST['age'],
						'dwelling' => $_POST['dwelling'],
						'bedroom' => $_POST['bedrooms'],
						'bathroom' => $_POST['bathrooms'],
						'curtain' => $_POST['curtains'],
						'appliance' => $_POST['appliances'],
						'cutlery' => $_POST['cutlery'],
						'carpet' => $_POST['carpet'],
						'furniture' => $_POST['furniture'],
						'utensil' => $_POST['utensil'],
						'mattress' => $_POST['mattress'],
						
						'cleaning' => $_POST['cleaning'],
						'cleaning_fee' => $_POST['cleaning_fee'],
						'cleaning_amount' => $_POST['cleaning_amount'],
						'cleaner_first_name' => $_POST['first_name'],
						'cleaner_last_name' => $_POST['last_name'],
						'cleaner_email' => $_POST['email'],
						'cleaner_phone' => $_POST['phone'],
						'cleaner_home_phone' => $_POST['home_phone'],
						'arrange_cleaning' => $_POST['arrange_cleaning'],
						'bed_lines' => $_POST['bed_lines'],
						
						'property_status' => $_POST['property_status'],
						'owner_id' => $this->session->userdata('user_id'),
						'private_code' => $private_code,
						'created_date' => $created_date,
						'admin_action' => $_POST['admin_action'],
					);
			
			if(isset($_POST['property_id']) && !empty($_POST['property_id']) ) {

                $this->update($data, $_POST['property_id']);
				echo "Information saved Successfully/Edit ";
			} elseif (isset($_POST['save_property_id']) && !empty($_POST['save_property_id'])) {
                $this->update($data, $_POST['save_property_id']);
				echo $_POST['save_property_id'];
			} else  {
                $id = $this->insert($data);
				echo $id;
            }
			
		} elseif($_POST['current_index']==1) {
            if(isset($_POST['step1_save']) && $_POST['step1_save'] ==1) {

                $data = array('price_night' => $_POST['price_night'],
							  'price_week' => $_POST['price_week'],
							  'price_month' => $_POST['price_month'],
							
						  	'winter_price_night' => $_POST['winter_price_night'],
							'winter_price_week' => $_POST['winter_price_week'],
							'winter_price_month' => $_POST['winter_price_month'],
							
							'holiday_price_night' => $_POST['holiday_price_night'],
							'holiday_price_week' => $_POST['holiday_price_week'],
							'holiday_price_month' => $_POST['holiday_price_month'],
							
							'summer_price_night' => $_POST['summer_price_night'],
							'summer_price_week' => $_POST['summer_price_week'],
							'summer_price_month' => $_POST['summer_price_month'],
							
							'standard_rate' => $_POST['standard_changed'],
							'winter_rate' => $_POST['winter_changed'],
							'holiday_rate' => $_POST['holiday_changed'],
							'summer_rate' => $_POST['summer_changed'],
							
							'standard_start_date' => $standard_start_date,
							'standard_end_date' => $standard_end_date,
							'winter_start_date' => $winter_start_date,
							'winter_end_date' => $winter_end_date,
							'holiday_start_date' => $holiday_start_date,
							'holiday_end_date' => $holiday_end_date,
							'summer_start_date' => $summer_start_date,
							'summer_end_date' => $summer_end_date,
							
							'booking_cancelation' => $_POST['booking_name_radio'],
							'bond_amount' => $_POST['bond_amount'] ,
                                                        'min_nights' => $_POST['min_nights'] 
							
						);
            } else {
                    $data = array(

                        'title' =>$_POST['escape_title'],
                        'detail' => $_POST['escape_detail'],
                        'booking_type' => $_POST['booking_type'],
                        'type_escape_id' => $_POST['type_of_escape'],
                        'guest_capacity' => $_POST['guest_capacity'],
                        'children' => $_POST['children_allowed'],
                        'safety_children' => $_POST['safety_children'],
                        'pet' => $_POST['pet_allowed'],
                        'check_in_date' => $check_in_time,
                        'check_out_date' => $check_out_time,
                        'smoking' => $_POST['smoking'],
                        'photographer' => $_POST['photographer'],
                        'youtube_video_id' => $_POST['property_video'],
                        'phone' => $_POST['escape_phone'],
                        'age' => $_POST['age'],
                        'dwelling' => $_POST['dwelling'],
                        'bedroom' => $_POST['bedrooms'],
                        'bathroom' => $_POST['bathrooms'],
                        'curtain' => $_POST['curtains'],
                        'appliance' => $_POST['appliances'],
                        'cutlery' => $_POST['cutlery'],
                        'carpet' => $_POST['carpet'],
                        'furniture' => $_POST['furniture'],
                        'utensil' => $_POST['utensil'],
                        'mattress' => $_POST['mattress'],
                        'cleaning' => $_POST['cleaning'],
                        'cleaning_fee' => $_POST['cleaning_fee'],
                        'cleaning_amount' => $_POST['cleaning_amount'],
                        'cleaner_first_name' => $_POST['first_name'],
                        'cleaner_last_name' => $_POST['last_name'],
                        'cleaner_email' => $_POST['email'],
                        'cleaner_phone' => $_POST['phone'],
                        'cleaner_home_phone' => $_POST['home_phone'],
                        'arrange_cleaning' => $_POST['arrange_cleaning'],
                        'bed_lines' => $_POST['bed_lines'],
                        'price_night' => $_POST['price_night'],
                        'price_week' => $_POST['price_week'],
                        'price_month' => $_POST['price_month'],

                        'winter_price_night' => $_POST['winter_price_night'],
                        'winter_price_week' => $_POST['winter_price_week'],
                        'winter_price_month' => $_POST['winter_price_month'],

                        'holiday_price_night' => $_POST['holiday_price_night'],
                        'holiday_price_week' => $_POST['holiday_price_week'],
                        'holiday_price_month' => $_POST['holiday_price_month'],

                        'summer_price_night' => $_POST['summer_price_night'],
                        'summer_price_week' => $_POST['summer_price_week'],
                        'summer_price_month' => $_POST['summer_price_month'],

                        'standard_rate' => $_POST['standard_changed'],
                        'winter_rate' => $_POST['winter_changed'],
                        'holiday_rate' => $_POST['holiday_changed'],
                        'summer_rate' => $_POST['summer_changed'],
                        'private_code' => $private_code,
                        'created_date' => $created_date,
                        'owner_id' => $this->session->userdata('user_id'),
                        'admin_action' => $_POST['admin_action'],

                        'standard_start_date' => $standard_start_date,
                        'standard_end_date' => $standard_end_date,
                        'winter_start_date' => $winter_start_date,
                        'winter_end_date' => $winter_end_date,
                        'holiday_start_date' => $holiday_start_date,
                        'holiday_end_date' => $holiday_end_date,
                        'summer_start_date' => $summer_start_date,
                        'summer_end_date' => $summer_end_date,
                        'booking_cancelation' => $_POST['booking_name_radio'],
                        'bond_amount' => $_POST['bond_amount'],
                        'min_nights' => $_POST['min_nights']
                    );
            }
				
				
				if (isset($_POST['property_id']) && !empty($_POST['property_id']) ) {

					if ($this->update($data, $_POST['property_id'])) {
							echo "Edit Information saved";
					}else{
						echo  "No Edit Information saved";
					} 
				
				} else if(isset($_POST['save_property_id']) && !empty($_POST['save_property_id']) ) {

						if ($this->update($data, $_POST['save_property_id'])) {
								echo $_POST['save_property_id'];
						} else {
							echo "No Save/Edit Information saved";
						}
				} else {

					$id = $this->insert($data);
					echo $id;
				}
		} else if($_POST['current_index']==2) {
			
				if(isset($_POST['step2_save']) && $_POST['step2_save'] ==1) {
						$data = array(
							'country_id' => $_POST['country_id'],
							'region_id' => $_POST['region_id'],
							'city_id' => $_POST['city_id'],
							'suburb_id' => $_POST['suburb_id'],
							'region_name' => $_POST['country_region'],
							'city_name' => $_POST['region_city'],
							'city_suburb' => $_POST['city_suburb'],
							'street_no' => $_POST['street_no'],
							'street_name' => $_POST['street_name'],
							'how_to_reach' => $_POST['how_to_reach'],
							'street_enable' => $_POST['is_street_enable'],
							'street_visible' => $_POST['is_visible'],
							'certificate' => $_POST['certificate_upload'],
							'postcode' => $_POST['postcode'],
							
						);
				} else if(isset($_POST['step1_save']) && $_POST['step1_save'] ==1) { 
						$data = array(
							
							
							'price_night' => $_POST['price_night'],
							'price_week' => $_POST['price_week'],
							'price_month' => $_POST['price_month'],
							
							'winter_price_night' => $_POST['winter_price_night'],
							'winter_price_week' => $_POST['winter_price_week'],
							'winter_price_month' => $_POST['winter_price_month'],
							
							'holiday_price_night' => $_POST['holiday_price_night'],
							'holiday_price_week' => $_POST['holiday_price_week'],
							'holiday_price_month' => $_POST['holiday_price_month'],
							
							'summer_price_night' => $_POST['summer_price_night'],
							'summer_price_week' => $_POST['summer_price_week'],
							'summer_price_month' => $_POST['summer_price_month'],
							
							'standard_rate' => $_POST['standard_changed'],
							'winter_rate' => $_POST['winter_changed'],
							'holiday_rate' => $_POST['holiday_changed'],
							'summer_rate' => $_POST['summer_changed'],
							'private_code' => $private_code,
							'created_date' => $created_date,
							'admin_action' => $_POST['admin_action'],
							
							'standard_start_date' => $standard_start_date,
							'standard_end_date' => $standard_end_date,
							'winter_start_date' => $winter_start_date,
							'winter_end_date' => $winter_end_date,
							'holiday_start_date' => $holiday_start_date,
							'holiday_end_date' => $holiday_end_date,
							'summer_start_date' => $summer_start_date,
							'summer_end_date' => $summer_end_date,
							
							'booking_cancelation' => $_POST['booking_name_radio'],
							'bond_amount' => $_POST['bond_amount'] ,
                                                        'min_nights' => $_POST['min_nights'],
							'country_id' => $_POST['country_id'],
							'region_name' => $_POST['country_region'],
							'region_id' => $_POST['region_id'],
							'city_id' => $_POST['city_id'],
							'city_name' => $_POST['region_city'],
							'city_suburb' => $_POST['city_suburb'],
							'street_no' => $_POST['street_no'],
							
							'street_name' => $_POST['street_name'],
							'how_to_reach' => $_POST['how_to_reach'],
							'street_enable' => $_POST['is_street_enable'],
							'street_visible' => $_POST['is_visible'],
							'certificate' => $_POST['certificate_upload'],
							'postcode' => $_POST['postcode'],
							
							
						);
				} else  {
						$data = array(
							
							'title' =>$_POST['escape_title'],
							'detail' => $_POST['escape_detail'],
							'booking_type' => $_POST['booking_type'],
							'type_escape_id' => $_POST['type_of_escape'],
							'guest_capacity' => $_POST['guest_capacity'],
							'children' => $_POST['children_allowed'],
							'safety_children' => $_POST['safety_children'],
							'pet' => $_POST['pet_allowed'],
							'check_in_date' => $check_in_time,
							'check_out_date' => $check_out_time,
							'smoking' => $_POST['smoking'],
							'photographer' => $_POST['photographer'],
							'youtube_video_id' => $_POST['property_video'],
                            'phone' => $_POST['escape_phone'],
							'age' => $_POST['age'],
							'dwelling' => $_POST['dwelling'],
							'bedroom' => $_POST['bedrooms'],
							'bathroom' => $_POST['bathrooms'],
							'curtain' => $_POST['curtains'],
							'appliance' => $_POST['appliances'],
							'cutlery' => $_POST['cutlery'],
							'carpet' => $_POST['carpet'],
							'furniture' => $_POST['furniture'],
							'utensil' => $_POST['utensil'],
							'mattress' => $_POST['mattress'],
							'cleaning' => $_POST['cleaning'],
							'cleaning_fee' => $_POST['cleaning_fee'],
							'cleaning_amount' => $_POST['cleaning_amount'],
							'cleaner_first_name' => $_POST['first_name'],
							'cleaner_last_name' => $_POST['last_name'],
							'cleaner_email' => $_POST['email'],
							'cleaner_phone' => $_POST['phone'],
							'cleaner_home_phone' => $_POST['home_phone'],
							'arrange_cleaning' => $_POST['arrange_cleaning'],
							'bed_lines' => $_POST['bed_lines'],
							'price_night' => $_POST['price_night'],
							'price_week' => $_POST['price_week'],
							'price_month' => $_POST['price_month'],
							
							'winter_price_night' => $_POST['winter_price_night'],
							'winter_price_week' => $_POST['winter_price_week'],
							'winter_price_month' => $_POST['winter_price_month'],
							
							'holiday_price_night' => $_POST['holiday_price_night'],
							'holiday_price_week' => $_POST['holiday_price_week'],
							'holiday_price_month' => $_POST['holiday_price_month'],
							
							'summer_price_night' => $_POST['summer_price_night'],
							'summer_price_week' => $_POST['summer_price_week'],
							'summer_price_month' => $_POST['summer_price_month'],
							
							'standard_rate' => $_POST['standard_changed'],
							'winter_rate' => $_POST['winter_changed'],
							'holiday_rate' => $_POST['holiday_changed'],
							'summer_rate' => $_POST['summer_changed'],
							'private_code' => $private_code,
							'created_date' => $created_date,
							'admin_action' => $_POST['admin_action'],
							
							'standard_start_date' => $standard_start_date,
							'standard_end_date' => $standard_end_date,
							'winter_start_date' => $winter_start_date,
							'winter_end_date' => $winter_end_date,
							'holiday_start_date' => $holiday_start_date,
							'holiday_end_date' => $holiday_end_date,
							'summer_start_date' => $summer_start_date,
							'summer_end_date' => $summer_end_date,
							
							'booking_cancelation' => $_POST['booking_name_radio'],
							'bond_amount' => $_POST['bond_amount'] ,
                                                        'min_nights' => $_POST['min_nights'],
							'country_id' => $_POST['country_id'],
							'region_name' => $_POST['country_region'],
							'region_id' => $_POST['region_id'],
							'city_name' => $_POST['region_city'],
							'city_id' => $_POST['city_id'],
							'city_suburb' => $_POST['city_suburb'],
							
							
							'street_no' => $_POST['street_no'],
							'street_name' => $_POST['street_name'],
							'how_to_reach' => $_POST['how_to_reach'],
							'street_enable' => $_POST['is_street_enable'],
							'street_visible' => $_POST['is_visible'],
							'certificate' => $_POST['certificate_upload'],
							'postcode' => $_POST['postcode'],
						
							'property_status' => $_POST['property_status'],
							'owner_id' => $this->session->userdata('user_id'),
							'private_code' => $private_code,
							'created_date' => $created_date,
							'admin_action' => $_POST['admin_action'],
							
						);
				}
			
				if(isset($_POST['property_id']) && !empty($_POST['property_id']) ) {

                    $this->update($data, $_POST['property_id']);
				
				} else if(isset($_POST['save_property_id']) && !empty($_POST['save_property_id']) ) {

                    $this->update($data, $_POST['save_property_id']);
                    echo $_POST['save_property_id'];
				} else {
					$id = $this->insert($data);
					echo $id;
				}
		
		} elseif($_POST['current_index']==3) {
		
				if(isset($_POST['status']) && $_POST['status']!=1) {
					if(isset($_POST['step2_save']) && $_POST['step2_save'] ==1) {
									$data = array(
										
										'country_id' => $_POST['country_id'],
										'region_id' => $_POST['region_id'],
										'city_id' => $_POST['city_id'],
										'region_name' => $_POST['country_region'],
										'city_name' => $_POST['region_city'],
										'city_suburb' => $_POST['city_suburb'],
										'street_no' => $_POST['street_no'],
										
										'street_name' => $_POST['street_name'],
										'how_to_reach' => $_POST['how_to_reach'],
										'street_enable' => $_POST['is_street_enable'],
										'street_visible' => $_POST['is_visible'],
										'region_active' => $_POST['region_active'],
										'certificate' => $_POST['certificate_upload'],
										'postcode' => $_POST['postcode']
										
										
									);
							} else if(isset($_POST['step1_save']) && $_POST['step1_save'] ==1) { 
									$data = array(
										
										'price_night' => $_POST['price_night'],
										'price_week' => $_POST['price_week'],
										'price_month' => $_POST['price_month'],
										
										'winter_price_night' => $_POST['winter_price_night'],
										'winter_price_week' => $_POST['winter_price_week'],
										'winter_price_month' => $_POST['winter_price_month'],
										
										'holiday_price_night' => $_POST['holiday_price_night'],
										'holiday_price_week' => $_POST['holiday_price_week'],
										'holiday_price_month' => $_POST['holiday_price_month'],
										
										'summer_price_night' => $_POST['summer_price_night'],
										'summer_price_week' => $_POST['summer_price_week'],
										'summer_price_month' => $_POST['summer_price_month'],
													
										'standard_rate' => $_POST['standard_changed'],
										'winter_rate' => $_POST['winter_changed'],
										'holiday_rate' => $_POST['holiday_changed'],
										'summer_rate' => $_POST['summer_changed'],
										'private_code' => $private_code,
										'created_date' => $created_date,
										'admin_action' => $_POST['admin_action'],
										
										'standard_start_date' => $standard_start_date,
										'standard_end_date' => $standard_end_date,
										'winter_start_date' => $winter_start_date,
										'winter_end_date' => $winter_end_date,
										'holiday_start_date' => $holiday_start_date,
										'holiday_end_date' => $holiday_end_date,
										'summer_start_date' => $summer_start_date,
										'summer_end_date' => $summer_end_date,
										
										'booking_cancelation' => $_POST['booking_name_radio'],
										'bond_amount' => $_POST['bond_amount'] ,
                                                                                'min_nights' => $_POST['min_nights'],
										'country_id' => $_POST['country_id'],
										'region_id' => $_POST['region_id'],
										'city_id' => $_POST['city_id'],
										'region_name' => $_POST['country_region'],
										'city_name' => $_POST['region_city'],
										'city_suburb' => $_POST['city_suburb'],
										'street_no' => $_POST['street_no'],
										'certificate' => $_POST['certificate_upload'],
										'street_name' => $_POST['street_name'],
										'how_to_reach' => $_POST['how_to_reach'],
										'street_enable' => $_POST['is_street_enable'],
										'street_visible' => $_POST['is_visible'],
										'region_active' => $_POST['region_active'],
										'postcode' => $_POST['postcode']
									
									);
							} else  {
									$data = array(
										
										'title' =>$_POST['escape_title'],
										'detail' => $_POST['escape_detail'],
										'booking_type' => $_POST['booking_type'],
										'type_escape_id' => $_POST['type_of_escape'],
										'guest_capacity' => $_POST['guest_capacity'],
										'children' => $_POST['children_allowed'],
										'safety_children' => $_POST['safety_children'],
										'pet' => $_POST['pet_allowed'],
										'check_in_date' => $check_in_time,
										'check_out_date' => $check_out_time,
										'smoking' => $_POST['smoking'],
										'photographer' => $_POST['photographer'],
										'youtube_video_id' => $_POST['property_video'],
										'phone' => $_POST['escape_phone'],
                                                                                'age' => $_POST['age'],
										'dwelling' => $_POST['dwelling'],
										'bedroom' => $_POST['bedrooms'],
										'bathroom' => $_POST['bathrooms'],
										'curtain' => $_POST['curtains'],
										'appliance' => $_POST['appliances'],
										'cutlery' => $_POST['cutlery'],
										'carpet' => $_POST['carpet'],
										'furniture' => $_POST['furniture'],
										'utensil' => $_POST['utensil'],
										'mattress' => $_POST['mattress'],
										'cleaning' => $_POST['cleaning'],
										'cleaning_fee' => $_POST['cleaning_fee'],
										'cleaning_amount' => $_POST['cleaning_amount'],
										'cleaner_first_name' => $_POST['first_name'],
										'cleaner_last_name' => $_POST['last_name'],
										'cleaner_email' => $_POST['email'],
										'cleaner_phone' => $_POST['phone'],
										'cleaner_home_phone' => $_POST['home_phone'],
										'arrange_cleaning' => $_POST['arrange_cleaning'],
										'bed_lines' => $_POST['bed_lines'],
										'price_night' => $_POST['price_night'],
										'price_week' => $_POST['price_week'],
										'price_month' => $_POST['price_month'],
										
										'winter_price_night' => $_POST['winter_price_night'],
										'winter_price_week' => $_POST['winter_price_week'],
										'winter_price_month' => $_POST['winter_price_month'],
										
										'holiday_price_night' => $_POST['holiday_price_night'],
										'holiday_price_week' => $_POST['holiday_price_week'],
										'holiday_price_month' => $_POST['holiday_price_month'],
										
										'summer_price_night' => $_POST['summer_price_night'],
										'summer_price_week' => $_POST['summer_price_week'],
										'summer_price_month' => $_POST['summer_price_month'],
										
										'standard_rate' => $_POST['standard_changed'],
										'winter_rate' => $_POST['winter_changed'],
										'holiday_rate' => $_POST['holiday_changed'],
										'summer_rate' => $_POST['summer_changed'],
										'private_code' => $private_code,
										'created_date' => $created_date,
										'admin_action' => $_POST['admin_action'],
										
										'standard_start_date' => $standard_start_date,
										'standard_end_date' => $standard_end_date,
										'winter_start_date' => $winter_start_date,
										'winter_end_date' => $winter_end_date,
										'holiday_start_date' => $holiday_start_date,
										'holiday_end_date' => $holiday_end_date,
										'summer_start_date' => $summer_start_date,
										'summer_end_date' => $summer_end_date,
										
										'booking_cancelation' => $_POST['booking_name_radio'],
										'bond_amount' => $_POST['bond_amount'] ,
                                                                                'min_nights' => $_POST['min_nights'],
										'country_id' => $_POST['country_id'],
										'region_id' => $_POST['region_id'],
										'city_id' => $_POST['city_id'],
										'region_name' => $_POST['country_region'],
										'city_name' => $_POST['region_city'],
										'city_suburb' => $_POST['city_suburb'],
										'street_no' => $_POST['street_no'],
										'certificate' => $_POST['certificate_upload'],
										'street_name' => $_POST['street_name'],
										'how_to_reach' => $_POST['how_to_reach'],
										'street_enable' => $_POST['is_street_enable'],
										'street_visible' => $_POST['is_visible'],
										'region_active' => $_POST['region_active'],
										'postcode' => $_POST['postcode'],
										
										'property_status' => $_POST['property_status'],
										'owner_id' => $this->session->userdata('user_id'),
										'private_code' => $private_code,
										'created_date' => $created_date,
										'admin_action' => $_POST['admin_action'],
										
									);
							}
				}
				
				
				 if(isset($_POST['property_id']) && !empty($_POST['property_id']) ) {

                    if(!empty($data)) {
                        $this->update($data, $_POST['property_id']);
                    }

                    if(isset($_POST['amenitiesArr']) && !empty($_POST['amenitiesArr'])) {
                        for ($i=0; $i < count($_POST['amenitiesArr']); $i++){
                            $existing_amenities_id = $this->checkAmenitiesId($_POST['amenitiesArr']
                            [$i],$_POST['property_id']);

                             if(empty($existing_amenities_id)) {
                                $dataArr = array('property_id'  => $_POST['property_id'],
                                                 'amenities_id' => $_POST['amenitiesArr'][$i]);

                                 $this->setTable('tbl_property_amenities')->insert($dataArr);
                                 $this->setTable('tbl_property');
                            }

                        }
                    }
                     if(isset($_POST['amenitiesDeleteArr']) &&  !empty($_POST['amenitiesDeleteArr'])) {

                        for ($i=0; $i < count($_POST['amenitiesDeleteArr']); $i++){
                            $this->db->where(array('property_id'  => $_POST['property_id'],
                                                   'amenities_id' => $_POST['amenitiesDeleteArr'][$i]));

                            $this->db->delete('tbl_property_amenities');
                        }
                    }
							
					
				} else if(isset($_POST['save_property_id']) && !empty($_POST['save_property_id']) ) {
                    if(!empty($data)) {

                        $this->update($data, $_POST['save_property_id']);
                        echo $_POST['save_property_id'];
                    }

                    if( isset($_POST['amenitiesArr']) &&  !empty($_POST['amenitiesArr'])) {
                        for ($i=0; $i < count($_POST['amenitiesArr']); $i++){
                            $existing_amenities_id = $this->checkAmenitiesId($_POST['amenitiesArr']
                            [$i],$_POST['save_property_id']);

                            if(empty($existing_amenities_id)) {
                                $dataArr = array('property_id'  => $_POST['save_property_id'],
                                                 'amenities_id' => $_POST['amenitiesArr'][$i]);

                                $this->setTable('tbl_property_amenities')->insert($dataArr);
                                $this->setTable('tbl_property');
                            }

                        }
                    }

                    if(isset($_POST['amenitiesDeleteArr']) &&  !empty($_POST['amenitiesDeleteArr'])) {
                        for ($i=0; $i < count($_POST['amenitiesDeleteArr']); $i++){
                            $this->db->where(array('property_id' => $_POST['save_property_id'],'amenities_id' => $_POST['amenitiesDeleteArr'][$i]));
                            $this->db->delete('tbl_property_amenities');
                        }
                    }
					
				} else {
					$this->setTable('tbl_property');
					$id = $this->insert($data);

                    $this->setTable('tbl_property_amenities');
					if(!empty($_POST['amenitiesArr'])) {
						for ($i=0; $i < count($_POST['amenitiesArr']); $i++){
							$dataArr = array('property_id'=>$id, 'amenities_id'=>$_POST['amenitiesArr'][$i]);
                            $this->insert($dataArr);
						}
					}
                    $this->setTable('tbl_property');

					echo $id;
				}
		
		} elseif($_POST['current_index']==4) { 
			if(isset($_POST['status']) && $_POST['status']!=1) {
				if(isset($_POST['step2_save']) && $_POST['step2_save'] ==1) {
                    $data = array(
                        'country_id' => $_POST['country_id'],
                        'region_id' => $_POST['region_id'],
                        'city_id' => $_POST['city_id'],
                        'region_name' => $_POST['country_region'],
                        'city_name' => $_POST['region_city'],
                        'city_suburb' => $_POST['city_suburb'],
                        'street_no' => $_POST['street_no'],

                        'street_name' => $_POST['street_name'],
                        'how_to_reach' => $_POST['how_to_reach'],
                        'street_enable' => $_POST['is_street_enable'],
                        'street_visible' => $_POST['is_visible'],
                        'region_active' => $_POST['region_active'],
                        'certificate' => $_POST['certificate_upload'],
                        'postcode' => $_POST['postcode']



                    );
                } else if(isset($_POST['step1_save']) && $_POST['step1_save'] ==1) {
                        $data = array(

                            'price_night' => $_POST['price_night'],
                            'price_week' => $_POST['price_week'],
                            'price_month' => $_POST['price_month'],

                            'winter_price_night' => $_POST['winter_price_night'],
                            'winter_price_week' => $_POST['winter_price_week'],
                            'winter_price_month' => $_POST['winter_price_month'],

                            'holiday_price_night' => $_POST['holiday_price_night'],
                            'holiday_price_week' => $_POST['holiday_price_week'],
                            'holiday_price_month' => $_POST['holiday_price_month'],

                            'summer_price_night' => $_POST['summer_price_night'],
                            'summer_price_week' => $_POST['summer_price_week'],
                            'summer_price_month' => $_POST['summer_price_month'],

                            'standard_rate' => $_POST['standard_changed'],
                            'winter_rate' => $_POST['winter_changed'],
                            'holiday_rate' => $_POST['holiday_changed'],
                            'summer_rate' => $_POST['summer_changed'],
                            'private_code' => $private_code,
                            'created_date' => $created_date,
                            'admin_action' => $_POST['admin_action'],

                            'standard_start_date' => $standard_start_date,
                            'standard_end_date' => $standard_end_date,
                            'winter_start_date' => $winter_start_date,
                            'winter_end_date' => $winter_end_date,
                            'holiday_start_date' => $holiday_start_date,
                            'holiday_end_date' => $holiday_end_date,
                            'summer_start_date' => $summer_start_date,
                            'summer_end_date' => $summer_end_date,

                            'booking_cancelation' => $_POST['booking_name_radio'],
                            'bond_amount' => $_POST['bond_amount'] ,
                            'min_nights' => $_POST['min_nights'],
                            'country_id' => $_POST['country_id'],
                            'region_id' => $_POST['region_id'],
                            'city_id' => $_POST['city_id'],
                            'region_name' => $_POST['country_region'],
                            'city_name' => $_POST['region_city'],
                            'city_suburb' => $_POST['city_suburb'],
                            'street_no' => $_POST['street_no'],
                            'certificate' => $_POST['certificate_upload'],
                            'street_name' => $_POST['street_name'],
                            'how_to_reach' => $_POST['how_to_reach'],
                            'street_enable' => $_POST['is_street_enable'],
                            'street_visible' => $_POST['is_visible'],
                            'region_active' => $_POST['region_active'],
                            'postcode' => $_POST['postcode'],


                        );
                } else  {
                        $data = array(
                            'title' =>$_POST['escape_title'],
                            'detail' => $_POST['escape_detail'],
                            'booking_type' => $_POST['booking_type'],
                            'type_escape_id' => $_POST['type_of_escape'],
                            'guest_capacity' => $_POST['guest_capacity'],
                            'children' => $_POST['children_allowed'],
                            'safety_children' => $_POST['safety_children'],
                            'pet' => $_POST['pet_allowed'],
                            'check_in_date' => $check_in_time,
                            'check_out_date' => $check_out_time,
                            'smoking' => $_POST['smoking'],
                            'photographer' => $_POST['photographer'],
                            'youtube_video_id' => $_POST['property_video'],
                            'phone' => $_POST['escape_phone'],
                            'age' => $_POST['age'],
                            'dwelling' => $_POST['dwelling'],
                            'bedroom' => $_POST['bedrooms'],
                            'bathroom' => $_POST['bathrooms'],
                            'curtain' => $_POST['curtains'],
                            'appliance' => $_POST['appliances'],
                            'cutlery' => $_POST['cutlery'],
                            'carpet' => $_POST['carpet'],
                            'furniture' => $_POST['furniture'],
                            'utensil' => $_POST['utensil'],
                            'mattress' => $_POST['mattress'],
                            'cleaning' => $_POST['cleaning'],
                            'cleaning_fee' => $_POST['cleaning_fee'],
                            'cleaning_amount' => $_POST['cleaning_amount'],
                            'cleaner_first_name' => $_POST['first_name'],
                            'cleaner_last_name' => $_POST['last_name'],
                            'cleaner_email' => $_POST['email'],
                            'cleaner_phone' => $_POST['phone'],
                            'cleaner_home_phone' => $_POST['home_phone'],
                            'arrange_cleaning' => $_POST['arrange_cleaning'],
                            'bed_lines' => $_POST['bed_lines'],
                            'price_night' => $_POST['price_night'],
                            'price_week' => $_POST['price_week'],
                            'price_month' => $_POST['price_month'],

                            'winter_price_night' => $_POST['winter_price_night'],
                            'winter_price_week' => $_POST['winter_price_week'],
                            'winter_price_month' => $_POST['winter_price_month'],

                            'holiday_price_night' => $_POST['holiday_price_night'],
                            'holiday_price_week' => $_POST['holiday_price_week'],
                            'holiday_price_month' => $_POST['holiday_price_month'],

                            'summer_price_night' => $_POST['summer_price_night'],
                            'summer_price_week' => $_POST['summer_price_week'],
                            'summer_price_month' => $_POST['summer_price_month'],

                            'standard_rate' => $_POST['standard_changed'],
                            'winter_rate' => $_POST['winter_changed'],
                            'holiday_rate' => $_POST['holiday_changed'],
                            'summer_rate' => $_POST['summer_changed'],
                            'private_code' => $private_code,
                            'created_date' => $created_date,
                            'admin_action' => $_POST['admin_action'],

                            'standard_start_date' => $standard_start_date,
                            'standard_end_date' => $standard_end_date,
                            'winter_start_date' => $winter_start_date,
                            'winter_end_date' => $winter_end_date,
                            'holiday_start_date' => $holiday_start_date,
                            'holiday_end_date' => $holiday_end_date,
                            'summer_start_date' => $summer_start_date,
                            'summer_end_date' => $summer_end_date,

                            'booking_cancelation' => $_POST['booking_name_radio'],
                            'bond_amount' => $_POST['bond_amount'] ,
                            'min_nights' => $_POST['min_nights'],
                            'country_id' => $_POST['country_id'],
                            'region_id' => $_POST['region_id'],
                            'city_id' => $_POST['city_id'],
                            'region_name' => $_POST['country_region'],
                            'city_name' => $_POST['region_city'],
                            'city_suburb' => $_POST['city_suburb'],
                            'street_no' => $_POST['street_no'],

                            'street_name' => $_POST['street_name'],
                            'how_to_reach' => $_POST['how_to_reach'],
                            'street_enable' => $_POST['is_street_enable'],
                            'street_visible' => $_POST['is_visible'],
                            'region_active' => $_POST['region_active'],
                            'certificate' => $_POST['certificate_upload'],
                            'postcode' => $_POST['postcode'],

                            'property_status' => $_POST['property_status'],
                            'owner_id' => $this->session->userdata('user_id'),
                            'private_code' => $private_code,
                            'created_date' => $created_date,
                            'admin_action' => $_POST['admin_action'],

                        );
                }
			}
			
			if(isset($_POST['property_id']) && !empty($_POST['property_id']) ) {
                if(!empty($data)) {
                    $this->update($data, $_POST['property_id']);
                }
                if(!empty($_POST['amenitiesArr'])) {
                    for ($i=0; $i < count($_POST['amenitiesArr']); $i++){

                        $existing_amenities_id = $this->checkAmenitiesId($_POST['amenitiesArr']
                        [$i],$_POST['property_id']);
                        if(empty($existing_amenities_id)) {
                            $dataArr = array('property_id'=>$_POST['property_id'], 'amenities_id'=>$_POST['amenitiesArr'][$i]);

                            $this->setTable('tbl_property_amenities')->insert($dataArr);
                            $this->setTable('tbl_property');
                        }
                    }
                }
                if(isset($_POST['amenitiesDeleteArr']) &&  !empty($_POST['amenitiesDeleteArr'])) {
                    for ($i=0; $i < count($_POST['amenitiesDeleteArr']); $i++){
                        $dataArr = array('property_id'=>$_POST['property_id'], 'amenities_id'=>$_POST['amenitiesDeleteArr']
                        [$i]);
                        $this->db->where(array('property_id'=>$_POST['property_id'],'amenities_id' => $_POST['amenitiesDeleteArr'][$i]));
                        $this->db->delete('tbl_property_amenities');

                    }
                 }
                if(!empty($_POST['categoryArr'])) {
                    for ($i=0; $i < count($_POST['categoryArr']); $i++){
                        $existing_category_id = $this->checkCategoryId($_POST['categoryArr']
                        [$i],$_POST['property_id']);
                        if(empty($existing_category_id)) {
                            $dataArr = array('property_id'=>$_POST['property_id'], 'category_id'=>$_POST['categoryArr'][$i]);

                            $this->setTable('tbl_property_cats')->insert($dataArr);
                            $this->setTable('tbl_property');
                        }
                    }
                }
                if(isset($_POST['categoryDeleteArr']) &&  !empty($_POST['categoryDeleteArr'])) {
                    for ($i=0; $i < count($_POST['categoryDeleteArr']); $i++){


                        $this->db->where(array('property_id'=>$_POST['property_id'],'category_id' =>$_POST['categoryDeleteArr'][$i]));
                        $this->db->delete('tbl_property_cats');

                    }
                }
						
						
			} else if(isset($_POST['save_property_id']) && !empty($_POST['save_property_id']) ) {
                        if(!empty($data)) {
                                $this->update($data, $_POST['save_property_id']);
                                echo $_POST['save_property_id'];
                        }
                        if(!empty($_POST['amenitiesArr'])) {
                            for ($i=0; $i < count($_POST['amenitiesArr']); $i++){
                                $existing_amenities_id = $this->checkAmenitiesId($_POST['amenitiesArr']
                                [$i],$_POST['save_property_id']);
                                if(empty($existing_amenities_id)) {
                                    $dataArr = array('property_id'=>$_POST['save_property_id'], 'amenities_id'=>$_POST['amenitiesArr'][$i]);

                                    $this->setTable('tbl_property_amenities')->insert($dataArr);
                                    $this->setTable('tbl_property');
                                }
                            }
                        }
                         if(isset($_POST['amenitiesDeleteArr']) &&  !empty($_POST['amenitiesDeleteArr'])) {
                            for ($i=0; $i < count($_POST['amenitiesDeleteArr']); $i++){


                                $this->db->where(array('property_id'=>$_POST['save_property_id'],'amenities_id' => $_POST['amenitiesDeleteArr'][$i]));
                                $this->db->delete('tbl_property_amenities');

                            }
                         }

                        if(!empty($_POST['categoryArr'])) {
                            for ($i=0; $i < count($_POST['categoryArr']); $i++){
                                $existing_category_id = $this->checkCategoryId($_POST['categoryArr']
                                [$i],$_POST['save_property_id']);
                                if(empty($existing_category_id)) {
                                    $dataArr = array('property_id'=>$_POST['save_property_id'], 'category_id'=>$_POST['categoryArr'][$i]);
                                    $this->setTable('tbl_property_cats')->insert($dataArr);
                                    $this->setTable('tbl_property');
                                }

                            }
                        }

                         if(isset($_POST['categoryDeleteArr']) &&  !empty($_POST['categoryDeleteArr'])) {
                            for ($i=0; $i < count($_POST['categoryDeleteArr']); $i++){

                                $this->db->where(array('property_id'=>$_POST['save_property_id'],'category_id' => $_POST['categoryDeleteArr'][$i]));
                                $this->db->delete('tbl_property_cats');

                            }
                        }
					
					}  else {
							$this->db->insert('tbl_property', $data);
							$id = $this->db->insert_id();
					
								if(!empty($_POST['amenitiesArr'])) {
									for ($i=0; $i < count($_POST['amenitiesArr']); $i++){
										$dataArr = array('property_id'=>$id, 'amenities_id'=>$_POST['amenitiesArr']
										[$i]);

                                        $this->setTable('tbl_property_amenities')->insert($dataArr);
                                        $this->setTable('tbl_property');
									}
								} 
								 
								if(!empty($_POST['categoryArr'])) {

                                    $this->setTable('tbl_property_cats');
									for ($i=0; $i < count($_POST['categoryArr']); $i++){
										$dataArr = array('property_id'=>$id, 'category_id'=>$_POST['categoryArr'][$i]);
                                        $this->insert($dataArr);
									}
                                    $this->setTable('tbl_property');

								}
								echo  $id;
					}
		
		} elseif($_POST['current_index']==5){ 
			if(isset($_POST['status']) && $_POST['status']!=1) {
				if(isset($_POST['step2_save']) && $_POST['step2_save'] ==1) {
									$data = array(
										
										'country_id' => $_POST['country_id'],
										'region_id' => $_POST['region_id'],
										'city_id' => $_POST['city_id'],
										'region_name' => $_POST['country_region'],
										'city_name' => $_POST['region_city'],
										'city_suburb' => $_POST['city_suburb'],
										'street_no' => $_POST['street_no'],
										
										'street_name' => $_POST['street_name'],
										'how_to_reach' => $_POST['how_to_reach'],
										'street_enable' => $_POST['is_street_enable'],
										'street_visible' => $_POST['is_visible'],
										'region_active' => $_POST['region_active'],
										'certificate' => $_POST['certificate_upload'],
										'postcode' => $_POST['postcode']
										
										
										
									);
							} else if(isset($_POST['step1_save']) && $_POST['step1_save'] ==1) { 
									$data = array(
										
										'price_night' => $_POST['price_night'],
										'price_week' => $_POST['price_week'],
										'price_month' => $_POST['price_month'],
										
										'winter_price_night' => $_POST['winter_price_night'],
										'winter_price_week' => $_POST['winter_price_week'],
										'winter_price_month' => $_POST['winter_price_month'],
										
										'holiday_price_night' => $_POST['holiday_price_night'],
										'holiday_price_week' => $_POST['holiday_price_week'],
										'holiday_price_month' => $_POST['holiday_price_month'],
										
										'summer_price_night' => $_POST['summer_price_night'],
										'summer_price_week' => $_POST['summer_price_week'],
										'summer_price_month' => $_POST['summer_price_month'],
										
										'standard_rate' => $_POST['standard_changed'],
										'winter_rate' => $_POST['winter_changed'],
										'holiday_rate' => $_POST['holiday_changed'],
										'summer_rate' => $_POST['summer_changed'],
										'private_code' => $private_code,
										'created_date' => $created_date,
										'admin_action' => $_POST['admin_action'],
										
										'standard_start_date' => $standard_start_date,
										'standard_end_date' => $standard_end_date,
										'winter_start_date' => $winter_start_date,
										'winter_end_date' => $winter_end_date,
										'holiday_start_date' => $holiday_start_date,
										'holiday_end_date' => $holiday_end_date,
										'summer_start_date' => $summer_start_date,
										'summer_end_date' => $summer_end_date,
										
										'booking_cancelation' => $_POST['booking_name_radio'],
										'bond_amount' => $_POST['bond_amount'] ,
                                                                                'min_nights' => $_POST['min_nights'],
										'country_id' => $_POST['country_id'],
										'region_id' => $_POST['region_id'],
										'city_id' => $_POST['city_id'],
										'region_name' => $_POST['country_region'],
										'city_name' => $_POST['region_city'],
										'city_suburb' => $_POST['city_suburb'],
										'street_no' => $_POST['street_no'],
										
										'street_name' => $_POST['street_name'],
										'how_to_reach' => $_POST['how_to_reach'],
										'street_enable' => $_POST['is_street_enable'],
										'street_visible' => $_POST['is_visible'],
										'region_active' => $_POST['region_active'],
										'certificate' => $_POST['certificate_upload'],
										'postcode' => $_POST['postcode'],
										
										
									);
							} else  {
									$data = array(
										
										'title' =>$_POST['escape_title'],
										'detail' => $_POST['escape_detail'],
										'booking_type' => $_POST['booking_type'],
										'type_escape_id' => $_POST['type_of_escape'],
										'guest_capacity' => $_POST['guest_capacity'],
										'children' => $_POST['children_allowed'],
										'safety_children' => $_POST['safety_children'],
										'pet' => $_POST['pet_allowed'],
										'check_in_date' => $check_in_time,
										'check_out_date' => $check_out_time,
										'smoking' => $_POST['smoking'],
										'photographer' => $_POST['photographer'],
										'youtube_video_id' => $_POST['property_video'],
										'phone' => $_POST['escape_phone'],
                                                                                'age' => $_POST['age'],
										'dwelling' => $_POST['dwelling'],
										'bedroom' => $_POST['bedrooms'],
										'bathroom' => $_POST['bathrooms'],
										'curtain' => $_POST['curtains'],
										'appliance' => $_POST['appliances'],
										'cutlery' => $_POST['cutlery'],
										'carpet' => $_POST['carpet'],
										'furniture' => $_POST['furniture'],
										'utensil' => $_POST['utensil'],
										'mattress' => $_POST['mattress'],
										'cleaning' => $_POST['cleaning'],
										'cleaning_fee' => $_POST['cleaning_fee'],
										'cleaning_amount' => $_POST['cleaning_amount'],
										'cleaner_first_name' => $_POST['first_name'],
										'cleaner_last_name' => $_POST['last_name'],
										'cleaner_email' => $_POST['email'],
										'cleaner_phone' => $_POST['phone'],
										'cleaner_home_phone' => $_POST['home_phone'],
										'arrange_cleaning' => $_POST['arrange_cleaning'],
										'bed_lines' => $_POST['bed_lines'],
										'price_night' => $_POST['price_night'],
										'price_week' => $_POST['price_week'],
										'price_month' => $_POST['price_month'],
										
										'winter_price_night' => $_POST['winter_price_night'],
										'winter_price_week' => $_POST['winter_price_week'],
										'winter_price_month' => $_POST['winter_price_month'],
										
										'holiday_price_night' => $_POST['holiday_price_night'],
										'holiday_price_week' => $_POST['holiday_price_week'],
										'holiday_price_month' => $_POST['holiday_price_month'],
										
										'summer_price_night' => $_POST['summer_price_night'],
										'summer_price_week' => $_POST['summer_price_week'],
										'summer_price_month' => $_POST['summer_price_month'],
										
										'standard_rate' => $_POST['standard_changed'],
										'winter_rate' => $_POST['winter_changed'],
										'holiday_rate' => $_POST['holiday_changed'],
										'summer_rate' => $_POST['summer_changed'],
										'private_code' => $private_code,
										'created_date' => $created_date,
										'admin_action' => $_POST['admin_action'],
										
										'standard_start_date' => $standard_start_date,
										'standard_end_date' => $standard_end_date,
										'winter_start_date' => $winter_start_date,
										'winter_end_date' => $winter_end_date,
										'holiday_start_date' => $holiday_start_date,
										'holiday_end_date' => $holiday_end_date,
										'summer_start_date' => $summer_start_date,
										'summer_end_date' => $summer_end_date,
										
										'booking_cancelation' => $_POST['booking_name_radio'],
										'bond_amount' => $_POST['bond_amount'] ,
                                                                                'min_nights' => $_POST['min_nights'],
										'country_id' => $_POST['country_id'],
										'region_id' => $_POST['region_id'],
										'city_id' => $_POST['city_id'],
										'region_name' => $_POST['country_region'],
										'city_name' => $_POST['region_city'],
										'city_suburb' => $_POST['city_suburb'],
										'street_no' => $_POST['street_no'],
										
										'street_name' => $_POST['street_name'],
										'how_to_reach' => $_POST['how_to_reach'],
										'street_enable' => $_POST['is_street_enable'],
										'street_visible' => $_POST['is_visible'],
										'region_active' => $_POST['region_active'],
										'certificate' => $_POST['certificate_upload'],
										'postcode' => $_POST['postcode'],
									
										'property_status' => $_POST['property_status'],
										'owner_id' => $this->session->userdata('user_id'),
										'private_code' => $private_code,
										'created_date' => $created_date,
										'admin_action' => $_POST['admin_action'],
										
									);
							}
			}
				 if(isset($_POST['property_id']) && !empty($_POST['property_id']) ) {
								if(!empty($data)) {
                                    $this->update($data, $_POST['property_id']);
								}			
								if(!empty($_POST['amenitiesArr'])) {
									for ($i=0; $i < count($_POST['amenitiesArr']); $i++){
										$existing_amenities_id = $this->checkAmenitiesId($_POST['amenitiesArr']
										[$i],$_POST['property_id']);
										if(empty($existing_amenities_id)) {
											$dataArr = array('property_id'=>$_POST['property_id'], 'amenities_id'=>$_POST['amenitiesArr'][$i]);

                                            $this->setTable('tbl_property_amenities')->insert($dataArr);
                                            $this->setTable('tbl_property');
										}
										
									}
								} 
								 if(isset($_POST['amenitiesDeleteArr']) &&  !empty($_POST['amenitiesDeleteArr'])) {
									for ($i=0; $i < count($_POST['amenitiesDeleteArr']); $i++){
										
										$this->db->where(array('property_id'=>$_POST['property_id'],'amenities_id' => $_POST['amenitiesDeleteArr'][$i]));
										$this->db->delete('tbl_property_amenities');
										
									}
								 }
								 
								if(!empty($_POST['categoryArr'])) {

                                    $this->setTable('tbl_property_cats');
									for ($i=0; $i < count($_POST['categoryArr']); $i++){
										$existing_category_id = $this->checkCategoryId($_POST['categoryArr']
										[$i],$_POST['property_id']);

                                        if(empty($existing_category_id)) {
											$dataArr = array('property_id'=>$_POST['property_id'], 'category_id'=>$_POST['categoryArr'][$i]);
                                            $this->insert($dataArr);
										}
									}
                                    $this->setTable('tbl_property');
								}	
								
								if(isset($_POST['categoryDeleteArr']) &&  !empty($_POST['categoryDeleteArr'])) {
									for ($i=0; $i < count($_POST['categoryDeleteArr']); $i++){
										
										$this->db->where(array('property_id'=>$_POST['property_id'],'category_id' => $_POST['categoryDeleteArr'][$i]));
										$this->db->delete('tbl_property_cats');
										
									}
								}
										
								//if(!empty($_POST['skyChannelArr'])) {
//                                    $this->setTable('tbl_property_tv_channels');
//									for ($i=0; $i < count($_POST['skyChannelArr']); $i++){
//										$existing_sky_channel_id = $this->checkSkyChannelId($_POST['skyChannelArr']
//										[$i],$_POST['property_id']);
//										if(empty($existing_sky_channel_id)) {
//											$dataArr = array('property_id'=>$_POST['property_id'], 'tv_channel_id'=>$_POST['skyChannelArr'][$i]);
//                                            $this->insert($dataArr);
//										}
//										
//									}
//                                    $this->setTable('tbl_property');
//								}
								
								//if(isset($_POST['skyChannelDeleteArr']) &&  !empty($_POST['skyChannelDeleteArr'])) {
//									for ($i=0; $i < count($_POST['skyChannelDeleteArr']); $i++){
//										
//										$this->db->where(array('property_id'=>$_POST['property_id'], 'tv_channel_id' => $_POST['skyChannelDeleteArr'][$i]));
//										$this->db->delete('tbl_property_sky_channels');
//										
//									}
//								}


                                if(!empty($_POST['channels'])) {
                                    $this->setTable('tbl_property_sky_channels');
									for ($i=0; $i < count($_POST['channels']); $i++){
										$existing_sky_channel_id = $this->checkSkyChannelId($_POST['channels']
										[$i],$_POST['property_id']);
										if(empty($existing_sky_channel_id)) {
											$dataArr = array('property_id'=>$_POST['property_id'], 'sky_channel_id'=>$_POST['channels'][$i]);
                                            $this->insert($dataArr);
										}

									}
                                    $this->setTable('tbl_property');
								}

								if(isset($_POST['delete_channels']) &&  !empty($_POST['delete_channels'])) {
									for ($i=0; $i < count($_POST['delete_channels']); $i++){

										$this->db->where(array('property_id'=>$_POST['property_id'],'sky_channel_id' => $_POST['delete_channels'][$i]));
										$this->db->delete('tbl_property_sky_channels');

									}
								}
						
					} else if(isset($_POST['save_property_id']) && !empty($_POST['save_property_id']) ) {

											if(!empty($data)) {
                                    $this->update($data,$_POST['save_property_id']);
								    echo $_POST['save_property_id'];
								}

								if(!empty($_POST['amenitiesArr'])) {
									for ($i=0; $i < count($_POST['amenitiesArr']); $i++){
									$existing_amenities_id = $this->checkAmenitiesId($_POST['amenitiesArr']
									[$i],$_POST['save_property_id']);
										if(empty($existing_amenities_id)) {
											$dataArr = array('property_id'=>$_POST['save_property_id'], 'amenities_id'=>$_POST['amenitiesArr'][$i]);

                                            $this->setTable('tbl_property_amenities')->insert($dataArr);
											$this->setTable('tbl_property');
										}
									
									}
								} 
								if(isset($_POST['amenitiesDeleteArr']) &&  !empty($_POST['amenitiesDeleteArr'])) {
									for ($i=0; $i < count($_POST['amenitiesDeleteArr']); $i++){
										
										$this->db->where(array('property_id'=>$_POST['save_property_id'],'amenities_id' => $_POST['amenitiesDeleteArr'][$i]));
										$this->db->delete('tbl_property_amenities');
										
									}
								 }
							 
								if(!empty($_POST['categoryArr'])) {
                                    $this->setTable('tbl_property_cats');
									for ($i=0; $i < count($_POST['categoryArr']); $i++){
										$existing_category_id = $this->checkCategoryId($_POST['categoryArr']
										[$i],$_POST['save_property_id']);

										if(empty($existing_category_id)) {
											$dataArr = array('property_id'=>$_POST['save_property_id'], 'category_id'=>$_POST['categoryArr'][$i]);
											$this->insert($dataArr);
										}
										
									}
                                    $this->setTable('tbl_property');
								}	
								
								if(isset($_POST['categoryDeleteArr']) &&  !empty($_POST['categoryDeleteArr'])) {
									for ($i=0; $i < count($_POST['categoryDeleteArr']); $i++){
										
										$this->db->where(array('property_id'=>$_POST['save_property_id'],'category_id' => $_POST['categoryDeleteArr'][$i]));
										$this->db->delete('tbl_property_cats');
										
									}
								}
										
								if(!empty($_POST['skyChannelArr'])) {

                                    $this->setTable('tbl_property_sky_channels');
									for ($i=0; $i < count($_POST['skyChannelArr']); $i++){
										$existing_sky_channel_id = $this->checkSkyChannelId($_POST['skyChannelArr']
										[$i],$_POST['save_property_id']);
										if(empty($existing_sky_channel_id)) {
											$dataArr = array('property_id'=>$_POST['save_property_id'], 'sky_channel_id'=>$_POST['skyChannelArr'][$i]);
											$this->insert($dataArr);
										}
										
									}

                                    $this->setTable('tbl_property');
								}
								
								if(isset($_POST['skyChannelDeleteArr']) &&  !empty($_POST['skyChannelDeleteArr'])) {
									for ($i=0; $i < count($_POST['skyChannelDeleteArr']); $i++) {
										
										$this->db->where(array('property_id'   => $_POST['save_property_id'],
                                                               'sky_channel_id' => $_POST['skyChannelDeleteArr'][$i]));

										$this->db->delete('tbl_property_sky_channels');
									}
								}


                                if(!empty($_POST['channels'])) {

                                    $this->setTable('tbl_property_sky_channels');
									for ($i=0; $i < count($_POST['channels']); $i++){
										$existing_sky_channel_id = $this->checkSkyChannelId($_POST['channels']
										[$i],$_POST['save_property_id']);
										if(empty($existing_sky_channel_id)) {
											$dataArr = array('property_id'=>$_POST['save_property_id'], 'sky_channel_id'=>$_POST['channels'][$i]);
											$this->insert($dataArr);
										}

									}

                                    $this->setTable('tbl_property');
								}

								if(isset($_POST['delete_channels']) &&  !empty($_POST['delete_channels'])) {
									for ($i=0; $i < count($_POST['delete_channels']); $i++) {

										$this->db->where(array('property_id'    =>  $_POST['save_property_id'],
                                                               'sky_channel_id' =>  $_POST['delete_channels'][$i]));

										$this->db->delete('tbl_property_sky_channels');

									}
								}
								
						
							
							  
					}  else {
							$id = $this->insert($data);
							if(!empty($_POST['amenitiesArr'])) {

                                $this->setTable('tbl_property_amenities');
								for ($i=0; $i < count($_POST['amenitiesArr']); $i++){
									$dataArr = array('property_id'=>$id, 'amenities_id'=>$_POST['amenitiesArr']
									[$i]);
									$this->insert( $dataArr);
								}
                                $this->setTable('tbl_property');
							} 
							 
							if(!empty($_POST['categoryArr'])) {
                                $this->setTable('tbl_property_cats');
								for ($i=0; $i < count($_POST['categoryArr']); $i++){
									$dataArr = array('property_id'=>$id, 'category_id'=>$_POST['categoryArr'][$i]);
									$this->insert($dataArr);
								}
                                $this->setTable('tbl_property');
							}	
							
							if(!empty($_POST['skyChannelArr'])) {

                                $this->setTable('tbl_property_sky_channels');
								for ($i=0; $i < count($_POST['skyChannelArr']); $i++){
									$dataArr = array('property_id'  =>  $id,
                                                    'tv_channel_id' =>  $_POST['skyChannelArr'][$i]);
									$this->insert($dataArr);
								}

                                $this->setTable('tbl_property');
							}

                            if(!empty($_POST['channels'])) {

                                $this->setTable('tbl_property_sky_channels');
								for ($i=0; $i < count($_POST['channels']); $i++){
									$dataArr = array('property_id'=>$id, 'sky_channel_id'=>$_POST['channels'][$i]);
									$this->insert($dataArr);
								}

                                $this->setTable('tbl_property');
							}
						echo $id;
					}
		}
	}
	
	/*
	*
	* Function to check whether selected Amenities ID exists 
	*/
	function checkAmenitiesId($amenities_id,$property_id) {
		 return $this->db->get_where('tbl_property_amenities', array('property_id' => $property_id,'amenities_id' => $amenities_id))->row();
	}
	
	/*
	*
	* Function to check whether selected Category ID exists 
	*/
	function checkCategoryId($category_id,$property_id) {
		 return $this->db->get_where('tbl_property_cats', array('property_id' => $property_id,'category_id' => $category_id))->row();
	}
	
	/*
	*
	* Function to check whether selected Sky channel ID exists 
	*/
	function checkSkyChannelId($sky_channel_id,$property_id) {
		 return $this->db->get_where('tbl_property_sky_channels', array('property_id' => $property_id,'sky_channel_id' => $sky_channel_id))->row();
	}
	
	/*
	* Function to change date in YYYY-MM-DD Format
	*
	*/ 
	function changeToYYYY($date) {
		
		$recieved_date_format = explode('/',$date); 
		
		$changed_date_format=$recieved_date_format[2]."-".$recieved_date_format[1]."-".$recieved_date_format[0];
		return $changed_date_format;
		
	}
	/*
	* Function to TO GET IMAGE GALLERY FOR ESCAPE
	*
	*/ 
	function getImageGallery($escape_id) {
		
			$sql_query = "SELECT * FROM tbl_property_images WHERE  property_id = '$escape_id' ORDER BY id DESC ";
			$query = $this->db->query($sql_query);
			$return_result = $query->result();
			
			return $return_result;
		
	}
	/**
	* Function to SAVE ESCAPE GALLERY IMAGES.
	* 
	*/
	function uploadEscapeImages($escape_id,$image_name){
		$table_name = "tbl_property_images";
	
		$data = array("property_id"=> $escape_id,"image"=>$image_name,"status"=>0);
		
			if($this->db->insert($table_name, $data)){
				return 1;
			}
	}
	/**
	* Function to INSERT ESCAPE AND GET LAST INSERTED ID FOR GALLERY MANAGEMENT.
	* 
	*/
	function getLastInsertedEscape(){
		$table_name = "tbl_property";
		$private_code = $this->genRandomString('12'); 
		$data = array("private_code"=>$private_code);
		
			if($this->db->insert($table_name, $data)){
				return $this->db->insert_id();
			}
	}
	/**
	* Function to Delete Escape Images.
	*
	*/
	function deleteEscapeImages($escape_id,$image_name){
	  $this->db->where('property_id', $escape_id);
	  $this->db->where('image', $image_name);
	  if($this->db->delete('tbl_property_images')){
		return 1;
	  }
	}
	/*
	* FUNCTION TO GET All TV Channels ACCORDING TO CHANNEL TYPE.
	*/
	function getAllTvChannels()
	{
		$query = $this->db->get_where('tbl_sky_channels', array('status' => '1'));
		$result = $query->result();
		
		$channelsArray = array();
		
		foreach($result as $channels){
			$channelsArray[$channels->television_type][] = $channels;
		}
		return $channelsArray;
	}
	/*
	* FUNCTION TO GET Total TV Channels Types
	*/
	function getTotalTvChannelsType()
	{
		$query = $this->db->get_where('tbl_tv_channels', array('status' => '1'));
		return $query->result();
	}

    /**
     * Remove a escape/property by private code
     *
     * @param $privateCode
     * @return bool
     */
    public function removeEscapeByPrivateCode($privateCode)
    {
        if(empty($privateCode)) return false;

        $this->db->where('private_code', $privateCode);
	    $this->db->delete('tbl_property');
        return true;
    }
}