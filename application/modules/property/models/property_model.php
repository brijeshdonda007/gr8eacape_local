<?php

class Property_model extends CI_Model {	

	

	function get_owner_info($user_id)

        {

            $query = $this->db->get_where('tbl_users', array('id' => $user_id));

            return $query->row();

        }

        function get_all_category()

        {

            $sql="select * from tbl_category";

            $query = $this->db->query($sql);

            return $query->result();

        }

	function listProperty($limit, $start){

                        

            if(isset($_POST['filter_property']))

            {

                        if(($this->input->post('category_id')) && ($this->input->post('admin_action') == ''))

                        {

                        $category_id = $this->input->post('category_id');

                        $sql = "SELECT tbl_property.*

                                FROM

                                tbl_property

                                INNER JOIN tbl_property_cats 

                                    ON (tbl_property.id = tbl_property_cats.property_id)

                                INNER JOIN tbl_category 

                                ON (tbl_property_cats.category_id = tbl_category.id)

                                WHERE tbl_property_cats.category_id = $category_id ORDER BY tbl_property.created_date DESC limit $start, $limit";

                        //echo $sql;exit();

                        }

                        elseif(($this->input->post('admin_action') != '') && !($this->input->post('category_id')))

                        {

                           $admin_action = $this->input->post('admin_action');

                           $sql = "SELECT *

                            FROM

                            tbl_property WHERE

                            admin_action = '$admin_action' ORDER BY created_date DESC limit $start, $limit";

                           

                           

                        }

                        elseif(($this->input->post('admin_action') != '') && ($this->input->post('category_id')))

                        {

                            $admin_action = $this->input->post('admin_action');

                            $category_id = $this->input->post('category_id');

                            $sql = "SELECT tbl_property.*

                            FROM

                            tbl_property

                            INNER JOIN tbl_property_cats 

                                ON (tbl_property.id = tbl_property_cats.property_id)

                            INNER JOIN tbl_category 

                            ON (tbl_property_cats.category_id = tbl_category.id)

                            WHERE tbl_property_cats.category_id = $category_id AND tbl_property.admin_action = '$admin_action' ORDER BY tbl_property.created_date DESC limit $start, $limit";

                        }

                        else

                        {

                        $sql = "select * from tbl_property";

                        }

            }

                        else

                        {

			$sql="select * from tbl_property order by created_date DESC limit $start, $limit";

                        }

                        $query = $this->db->query($sql);

                        return $query->result();

			

	}

        

        function listRegion($limit, $start){

			$sql = "Select a.*, b.country_name as country_name from tbl_region a inner join tbl_country b on a.country_id=b.id order by a.id asc limit $start, $limit";

                        $query = $this->db->query($sql);

                        return $query->result_array();

			

	}

        

         function getAllCountries()

        {

                $query			=	$this->db->get('tbl_country');

                return $query->result();

        }

        

        function addEditregion()

        {

            $col_data = true;

            $data = array(

                            'country_id' => $this->input->post('country_id'),

                            'region_name' => $this->input->post('region_name'),

                            'region_status' => $this->input->post('region_status')

                    );

		if($this->input->post('region_id') !=''):

				$this->db->update('tbl_region', $data, array('id' => $this->input->post('region_id')));

				$id = $this->input->post('region_id');

		else:

				$this->db->insert('tbl_region', $data);

				$id = $this->db->insert_id();

		endif;

		return $id;

        }

        

        function ediRegion($id) {

                $query			=	$this->db->get_where('tbl_region', array('id' => $id));				

                return $query->row();

        }

        

        

        function deleteRegion(){

                $deleteid			=	$this->uri->segment(3);

                $this->db->delete('tbl_region', array('id' => $deleteid)); 

	}

        

        function listCity($limit, $start){

                $query = $this->db->query("Select c.*, a.country_name as country_name, b.region_name as region_name from tbl_region b inner join tbl_country a on b.country_id=a.id inner join tbl_city c on c.region_id = b.id order by c.id asc limit $start, $limit");

		return $query->result();

			

	}

        

        function addEditCity() {

            

                $col_data = true;

                $data = array(

                            'country_id' => $this->input->post('country_id'),

                            'region_id' => $this->input->post('region_id'),

                            'city_name' => $this->input->post('city_name'),

                            'city_status' => $this->input->post('city_status'),

                    );

		if($this->input->post('city_id') !=''):

				$this->db->update('tbl_city', $data, array('id' => $this->input->post('city_id')));

				$id = $this->input->post('city_id');

		else:

				$this->db->insert('tbl_city', $data);

				$id = $this->db->insert_id();

		endif;

		return $id;

        }

        

        function ediCity($id) {

                $query			=	$this->db->get_where('tbl_city', array('id' => $id));				

                return $query->row();

        }

        

        function getRegions($country_id) {

                $query			=	$this->db->get_where('tbl_region', array('country_id' => $country_id));

                return $query->result();

        }

        function deleteCity()

        {

                $deleteid			=	$this->uri->segment(3);

                $this->db->delete('tbl_city', array('id' => $deleteid)); 

        }

        

        function record_count_category() {

                $sql = "select * from tbl_category";

                $query = $this->db->query($sql);

		return $query->num_rows();

        }

        

        function record_count_property() {

            

               if(isset($_POST['filter_property']))

            {

                        if(($this->input->post('category_id')) && ($this->input->post('admin_action') == ''))

                        {

                        $category_id = $this->input->post('category_id');

                        $sql = "SELECT tbl_property.*

                                FROM

                                tbl_property

                                INNER JOIN tbl_property_cats 

                                    ON (tbl_property.id = tbl_property_cats.property_id)

                                INNER JOIN tbl_category 

                                ON (tbl_property_cats.category_id = tbl_category.id)

                                WHERE tbl_property_cats.category_id = $category_id";

                        //echo $sql;exit();

                        }

                        elseif(($this->input->post('admin_action') != '') && !($this->input->post('category_id')))

                        {

                           $admin_action = $this->input->post('admin_action');

                           $sql = "SELECT *

                            FROM

                            tbl_property WHERE

                            admin_action = '$admin_action'";

                           

                           

                        }

                        elseif(($this->input->post('admin_action') != '') && ($this->input->post('category_id')))

                        {

                            $admin_action = $this->input->post('admin_action');

                            $category_id = $this->input->post('category_id');

                            $sql = "SELECT tbl_property.*

                            FROM

                            tbl_property

                            INNER JOIN tbl_property_cats 

                                ON (tbl_property.id = tbl_property_cats.property_id)

                            INNER JOIN tbl_category 

                            ON (tbl_property_cats.category_id = tbl_category.id)

                            WHERE tbl_property_cats.category_id = $category_id AND tbl_property.admin_action = '$admin_action'";

                        }

                        else

                        {

                        $sql = "select * from tbl_property";

                        }

            }

                else

                {

                $sql = "select * from tbl_property";

                }

                $query = $this->db->query($sql);

		return $query->num_rows();

        }

        function record_count_regionList() {

                $sql = "select * from tbl_region";

                $query = $this->db->query($sql);

		return $query->num_rows();

        }

        

             function record_count_city() {

                $sql = "select * from tbl_city";

                $query = $this->db->query($sql);

		return $query->num_rows();

        }

        

        function approveProperty($id)

        {

            $data = array(

               'admin_action' => 'approved',

            );



            $this->db->where('id', $id);

            $this->db->update('tbl_property', $data);

        }

        

        function verifyProperty($id)

        {

            $data = array(

               'admin_action' => 'verified',

            );



            $this->db->where('id', $id);

            $this->db->update('tbl_property', $data);

        }

	function declineProperty($id)

        {

            $data = array(

               'admin_action' => 'declined',

            );



            $this->db->where('id', $id);

            $this->db->update('tbl_property', $data);

        }

        

        function get_property_detail($porperty_id)

        {

            $this->db->where('tbl_property.id',$porperty_id);

            $this->db->select('tbl_property.id,tbl_property.admin_action,tbl_property.owner_id,

                tbl_property.title,tbl_property.featured_image,tbl_property.price_night,

                tbl_property.price_week, tbl_property.price_month, tbl_property.bedroom,

                tbl_property.bathroom,tbl_property.adult,tbl_property.children,tbl_property.pet,

                tbl_property.detail,tbl_property.amenities,tbl_property.termsncondition,

                tbl_property.guest_capacity,tbl_property.property_status,

                tbl_property.created_date,

                tbl_users.id as user_id,

                tbl_users.profile_picture,tbl_users.first_name, tbl_country.country_name, tbl_region.region_name,

                tbl_city.city_name, tbl_suburb.suburb_name');

            $this->db->from('tbl_property');

            $this->db->join('tbl_users','tbl_property.owner_id=tbl_users.id','INNER');

            $this->db->join('tbl_country','tbl_property.country_id=tbl_country.id','INNER');

            $this->db->join('tbl_region','tbl_property.region_id=tbl_region.id','INNER');

            $this->db->join('tbl_city','tbl_property.city_id=tbl_city.id','INNER');

            $this->db->join('tbl_suburb','tbl_property.suburb_id=tbl_suburb.id','INNER');

            $result = $this->db->get();

            return $result->row();

        }

	

	

		

}