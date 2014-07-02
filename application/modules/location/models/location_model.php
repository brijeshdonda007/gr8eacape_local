<?php

class Location_model extends CI_Model {	

	

	function listCountry($limit, $start){

			$sql="select * from tbl_country order by id asc limit $start, $limit";

                        $query = $this->db->query($sql);

                        return $query->result_array();

			

	}

	

	

	function addEditcountry()

	{	

                $col_data = true;

                $data = array(

                            'country_name' => $this->input->post('country_name'),

                            'status' => $this->input->post('status'),

                    );

		if($this->input->post('countryid') !=''):

				$this->db->update('tbl_country', $data, array('id' => $this->input->post('countryid')));

				$id = $this->input->post('countryid');

		else:

				$this->db->insert('tbl_country', $data);

				$id = $this->db->insert_id();

		endif;

		return $id;

	

	}

	



	

	

	

	function Country($id){

			$query			=	$this->db->get_where('tbl_country', array('id' => $id));				

			return $query->row();

	}

	

	

	

	

	

	

	

	

	function deleteCountry(){

			$deleteid			=	$this->uri->segment(3);

			$this->db->delete('tbl_country', array('id' => $deleteid)); 

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

                            'region_status' => $this->input->post('region_status'),

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

        

        function update_feature_img($id, $img_name)

        {

            $data = array(

                   'featured_image' => $img_name



                );



            $this->db->where('id', $id);

            $this->db->update('tbl_region', $data); 

        }

   

        function update_feature_img_c($id, $img_name)

        {

            $data = array(

                   'featured_image' => $img_name



                );



            $this->db->where('id', $id);

            $this->db->update('tbl_city', $data); 

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

        

        function getCities($region_id)

        {

             $query			=	$this->db->get_where('tbl_city', array('region_id' => $region_id));

             return $query->result();

        }

        function deleteCity()

        {

                $deleteid			=	$this->uri->segment(3);

                $this->db->delete('tbl_city', array('id' => $deleteid)); 

        }

        

        function record_count_country() {

                $sql = "select * from tbl_country";

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

        

          function get_region_by_CountryID($country_id) {

                $query			=	$this->db->get_where('tbl_region', array('country_id' => $country_id, 'region_status' => 1));

                return $query->result();

        }

        

        function list_suburb($limit, $start){

            

        $this->db->select('tbl_suburb.*, tbl_country.country_name,tbl_region.region_name,tbl_city.city_name');

        $this->db->from('tbl_suburb');

        $this->db->join('tbl_country','tbl_country.id=tbl_suburb.country_id','INNER');

        $this->db->join('tbl_region','tbl_region.id=tbl_suburb.region_id','INNER');

        $this->db->join('tbl_city','tbl_city.id=tbl_suburb.city_id','INNER');

        $this->db->order_by('tbl_suburb.suburb_name', 'desc');

        $this->db->limit( $limit, $start);

        $result = $this->db->get();

        //echo $this->db->last_query();exit();

        return ($result->result());

			

	}

        

        function record_count_suburb()

        {

            $sql = "select * from tbl_suburb";

            $query = $this->db->query($sql);

            return $query->num_rows();

        }

        

        function update_feature_img_s($id, $img_name)

        {

            $data = array(

                   'featured_image' => $img_name



                );



            $this->db->where('id', $id);

            $this->db->update('tbl_suburb', $data); 

        }

        function add_edit_suburb() {

            

                $col_data = true;

                $data = array(

                            'country_id' => $this->input->post('country_id'),

                            'region_id' => $this->input->post('region_id'),

                            'city_id' => $this->input->post('city_id'),

                            'suburb_name' => $this->input->post('suburb_name'),

                            'status' => $this->input->post('status'),

                    );

		if($this->input->post('suburb_id') !=''):

				$this->db->update('tbl_suburb', $data, array('id' => $this->input->post('suburb_id')));

				$id = $this->input->post('suburb_id');

		else:

				$this->db->insert('tbl_suburb', $data);

				$id = $this->db->insert_id();

		endif;

		return $id;

        }

        

        function edit_suburb($suburb_id)

        {

                $query			=	$this->db->get_where('tbl_suburb', array('id' => $suburb_id));				

                return $query->row();

        }

        

	function deletesuburb(){

			$deleteid			=	$this->uri->segment(3);

			$this->db->delete('tbl_suburb', array('id' => $deleteid)); 

	}


	

	

		

}