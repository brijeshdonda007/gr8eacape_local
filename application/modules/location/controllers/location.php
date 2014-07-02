<?php
class Location extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('location_model');
        $this->load->database();
        $this->load->library('pagination');
	}
	function countryList(){
        $config = array();
        $config["base_url"] = base_url() . "location/countryList";
        $config["total_rows"] = $this->location_model->record_count_country();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['mess'] = '';
		$data['all_country']		=	$this->location_model->listCountry($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		$this->load->model('login/Site_setting_model');
		$data['header_menus'] = $this->Site_setting_model->get_header_menu();
		$data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
		$data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();
		$data['main_content_view']= "location/list_country";			
		$this->load->view('default',$data);
	}
    function newCountry() {
		$data['form_title'] = "Add New";
		$data['main_content_view'] = "location/country_form";			
		$this->load->view('default',$data);
	}
	function editCountry() { 
        $data['form_title'] = "Edit";
		$data['country'] = $this->location_model->Country($this->uri->segment(3));
		$data['main_content_view']= "location/country_form";			
		$this->load->view('default',$data);
	}
	function addeditCountry(){ 
		$data['mess'] = '';		
		$product_id = $this->location_model->addEditcountry();					
		$data = array('msg'=>'Successfully Saved!');
		$this->session->set_userdata($data);
		redirect('location/countryList',$data);	
	}
	function deleteCountry(){
        $this->location_model->deleteCountry();
        $data = array('msg'=>'Successfully Deleted!');
        $this->session->set_userdata($data);
        redirect('location/countryList',$data);
	}
     function regionList(){
        $config = array();
        $config["base_url"] = base_url() . "location/regionList";
        $config["total_rows"] = $this->location_model->record_count_regionList();
        $config["per_page"] = 30;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['mess'] = '';
        $data['all_region']		=	$this->location_model->listRegion($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['main_content_view']= "location/list_region";
        $this->load->view('default',$data);
	}
        function newRegion() {

                $data['form_title'] = "Add New";

                $data['countries'] = $this->location_model->getAllCountries();

		$data['main_content_view'] = "location/region_form";			

		$this->load->view('default',$data);

	}

        

        function addeditRegion() {

            

                $data['mess'] = '';		

		$region_id = $this->location_model->addEditregion();

                if($region_id)

                {

                    

                    if(($_FILES['featured_image']['error'] != '4') and !empty($_FILES['featured_image']['name']))

                    {

                        $feature_img = $this->feature_image_upload($region_id);

                    }

                    else{

                         $feature_img = $this->input->post('old_featured_image');

                    }

                

                    $this->location_model->update_feature_img($region_id, $feature_img);

                   

                }

                

		$data = array('msg'=>'Successfully Saved!');

		$this->session->set_userdata($data);

		redirect('location/regionList',$data);	

                

                

        }

        

        function editRegion() {

                $data['form_title'] = "Edit";

		$data['region'] = $this->location_model->ediRegion($this->uri->segment(3));

                $data['countries'] = $this->location_model->getAllCountries();

		$data['main_content_view']= "location/region_form";			

		$this->load->view('default',$data);

                

        }

        

        function feature_image_upload($inserted_id){

                $region_feat_img = $this->location_model->ediRegion($inserted_id);

                if(@$region_feat_img->featured_image != '')

                {

                

                unlink('./images/region/thumb/'.$region_feat_img->featured_image);

                }

                $config['overwrite'] = 'TRUE'; 

		$config['upload_path'] = './images/region/';

                $config['allowed_types'] = 'gif|jpg|png';

                $config['max_size'] = '200000';

                $config['max_width'] = '3000';

                $config['max_height'] = '40000';

                

                $this->load->library('upload', $config);

                $this->load->library('image_lib');

                if ( ! $this->upload->do_upload('featured_image'))

                {

                        $error = array('error' => $this->upload->display_errors());

                        $data['errors'] = $error;

                        $this->session->set_userdata($data);

                        redirect('location/newRegion');

			

                }

                else

                {

                $data1 = array('upload_data' => $this->upload->data());

                $image= $data1['upload_data']['file_name'];





                $configBig = array();

                $configBig['image_library'] = 'gd2';

                $configBig['source_image'] = './images/region/'.$image;

                $configBig['create_thumb'] = TRUE;

                $configBig['maintain_ratio'] = FALSE;

                $configBig['quality'] = '100%';

                $configBig['width'] = 202;

                $configBig['height'] = 137;

                $configBig['thumb_marker'] = "_thumb";

                $configBig['new_image'] = './images/region/thumb';

                $this->image_lib->initialize($configBig);

                $this->image_lib->resize();

                $this->image_lib->clear();

                unset($configBig);



                $filename2 = $data1['upload_data']['raw_name'].'_thumb'.$data1['upload_data']['file_ext'];

                $filename3 = $data1['upload_data']['raw_name'].$data1['upload_data']['file_ext'];

                $rename = time().$inserted_id.$data1['upload_data']['file_ext'];

                rename('./images/region/thumb/' .$filename2, './images/region/thumb/' .$rename);

                rename('./images/region/' .$filename3, './images/region/' .$rename);

                return $rename;

        }

        }

        function deleteRegion() {

                $this->location_model->deleteRegion();

                $data = array('msg'=>'Successfully Deleted!');

                $this->session->set_userdata($data);

                redirect('location/regionList',$data);

        }

        

        function cityList() {

                $config = array();

                $config["base_url"] = base_url() . "location/cityList";

                $config["total_rows"] = $this->location_model->record_count_city();

                $config["per_page"] = 500;

                $config["uri_segment"] = 3;



                $this->pagination->initialize($config);

                

                $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

                $data['mess'] = '';

                $data['all_city']		=	$this->location_model->listCity($config["per_page"], $page);

                $data["links"] = $this->pagination->create_links();

                $data['main_content_view']= "location/list_city";			

                $this->load->view('default',$data);

        }

        

        function newCity() {

                $data['form_title'] = "Add New";

                $data['countries'] = $this->location_model->getAllCountries();

		$data['main_content_view'] = "location/city_form";			

		$this->load->view('default',$data);

	}

        

        function addeditCity(){ 

		$data['mess'] = '';		

		$city_id = $this->location_model->addEditCity();

                

                if($city_id)

                {

                    

                    if(($_FILES['featured_image']['error'] != '4') and !empty($_FILES['featured_image']['name']))

                    {

                        $feature_img = $this->feature_image_uploadc($city_id);

                    }

                    else{

                         $feature_img = $this->input->post('old_featured_image');

                    }

                

                    $this->location_model->update_feature_img_c($city_id, $feature_img);

                   

                }

                

		$data = array('msg'=>'Successfully Saved!');

		$this->session->set_userdata($data);

		redirect('location/cityList',$data);	

	}

        

        function feature_image_uploadc($inserted_id){

                $region_feat_img = $this->location_model->ediRegion($inserted_id);

                if(@$region_feat_img->featured_image != '')

                {

                

                unlink('./images/city/thumb/'.$region_feat_img->featured_image);

                }

                $config['overwrite'] = 'TRUE'; 

		$config['upload_path'] = './images/city/';

                $config['allowed_types'] = 'gif|jpg|png';

                $config['max_size'] = '200000';

                $config['max_width'] = '3000';

                $config['max_height'] = '40000';

                

                $this->load->library('upload', $config);

                $this->load->library('image_lib');

                if ( ! $this->upload->do_upload('featured_image'))

                {

                        $error = array('error' => $this->upload->display_errors());

                        $data['errors'] = $error;

                        $this->session->set_userdata($data);

                        redirect('location/newCity');

			

                }

                else

                {

                $data1 = array('upload_data' => $this->upload->data());

                $image= $data1['upload_data']['file_name'];





                $configBig = array();

                $configBig['image_library'] = 'gd2';

                $configBig['source_image'] = './images/city/'.$image;

                $configBig['create_thumb'] = TRUE;

                $configBig['maintain_ratio'] = FALSE;

                $configBig['width'] = 202;

                $configBig['height'] = 137;

                $configBig['thumb_marker'] = "_thumb";

                $configBig['quality'] = '100%';

                $configBig['new_image'] = './images/city/thumb';

                $this->image_lib->initialize($configBig);

                $this->image_lib->resize();

                $this->image_lib->clear();

                unset($configBig);



                //$filename1 = $data1['upload_data']['raw_name'].'_big'.$data1['upload_data']['file_ext'];

                $filename2 = $data1['upload_data']['raw_name'].'_thumb'.$data1['upload_data']['file_ext'];

                $filename3 = $data1['upload_data']['raw_name'].$data1['upload_data']['file_ext'];

                $rename = time().$inserted_id.$data1['upload_data']['file_ext'];

                //rename('./images/city/medium/' .$filename1, './images/city/medium/' .$rename);

                rename('./images/city/thumb/' .$filename2, './images/city/thumb/' .$rename);

                return $rename;

        }

        }

        

        function editCity() {

                $data['form_title'] = "Edit";

		$data['city'] = $this->location_model->ediCity($this->uri->segment(3));

                $data['regions'] = $this->location_model->getRegions($data['city']->country_id);

                $data['countries'] = $this->location_model->getAllCountries();

		$data['main_content_view']= "location/city_form";			

		$this->load->view('default',$data);

        }

        

        function deleteCity() {

                $this->location_model->deleteCity();

                $data = array('msg'=>'Successfully Deleted!');

                $this->session->set_userdata($data);

                redirect('location/cityList',$data);

        }

        

        function suburbList()

        {

                $config = array();

                $config["base_url"] = base_url() . "location/suburbList";

                $config["total_rows"] = $this->location_model->record_count_suburb();

                $config["per_page"] = 500;

                $config["uri_segment"] = 3;



                $this->pagination->initialize($config);

                

                $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

                $data['mess'] = '';

                $data['all_suburb']		=	$this->location_model->list_suburb($config["per_page"], $page);

                $data["links"] = $this->pagination->create_links();

                $data['main_content_view']= "location/list_suburb";			

                $this->load->view('default',$data);

        }

        

        function newsuburb()

        {

            $data['form_title'] = "Add New";

            $data['countries'] = $this->location_model->getAllCountries();

            $data['main_content_view'] = "location/suburb_form";			

            $this->load->view('default',$data);

        }

        function editsuburb() {

                $data['form_title'] = "Edit";

		$data['suburb'] = $this->location_model->edit_suburb($this->uri->segment(3));

                $data['cities'] = $this->location_model->getCities($data['suburb']->region_id);

                $data['regions'] = $this->location_model->getRegions($data['suburb']->country_id);

                $data['countries'] = $this->location_model->getAllCountries();

		$data['main_content_view']= "location/suburb_form";			

		$this->load->view('default',$data);

        }

        function addeditsuburb()

        {

            $data['mess'] = '';		

            $suburb_id = $this->location_model->add_edit_suburb();



            if($suburb_id)

            {



                if(($_FILES['featured_image']['error'] != '4') and !empty($_FILES['featured_image']['name']))

                {

                    $feature_img = $this->feature_image_upload_s($suburb_id);

                }

                else{

                     $feature_img = $this->input->post('old_featured_image');

                }



                $this->location_model->update_feature_img_s($suburb_id, $feature_img);



            }



            $data = array('msg'=>'Successfully Saved!');

            $this->session->set_userdata($data);

            redirect('location/suburbList',$data);

        }

        function feature_image_upload_s($inserted_id){

                $suburb_feat_img = $this->location_model->edit_suburb($inserted_id);

                if(@$suburb_feat_img->featured_image != '')

                {

                

                unlink('./images/suburb/thumb/'.$suburb_feat_img->featured_image);

                }

                $config['overwrite'] = 'TRUE'; 

		$config['upload_path'] = './images/suburb/';

                $config['allowed_types'] = 'gif|jpg|png';

                $config['max_size'] = '200000';

                $config['max_width'] = '3000';

                $config['max_height'] = '40000';

                

                $this->load->library('upload', $config);

                $this->load->library('image_lib');

                if ( ! $this->upload->do_upload('featured_image'))

                {

                        $error = array('error' => $this->upload->display_errors());

                        $data['errors'] = $error;

                        $this->session->set_userdata($data);

                        redirect('location/newsuburb');

			

                }

                else

                {

                $data1 = array('upload_data' => $this->upload->data());

                $image= $data1['upload_data']['file_name'];



                $configBig = array();

                $configBig['image_library'] = 'gd2';

                $configBig['source_image'] = './images/suburb/'.$image;

                $configBig['create_thumb'] = TRUE;

                $configBig['maintain_ratio'] = FALSE;

                $configBig['width'] = 202;

                $configBig['height'] = 137;

                $configBig['quality'] = '100%';

                $configBig['thumb_marker'] = "_thumb";

                $configBig['new_image'] = './images/suburb/thumb';

                $this->image_lib->initialize($configBig);

                $this->image_lib->resize();

                $this->image_lib->clear();

                unset($configBig);



                //$filename1 = $data1['upload_data']['raw_name'].'_big'.$data1['upload_data']['file_ext'];

                $filename2 = $data1['upload_data']['raw_name'].'_thumb'.$data1['upload_data']['file_ext'];

                $filename3 = $data1['upload_data']['raw_name'].$data1['upload_data']['file_ext'];

                $rename = time().$inserted_id.$data1['upload_data']['file_ext'];

                //rename('./images/suburb/medium/' .$filename1, './images/suburb/medium/' .$rename);

                rename('./images/suburb/thumb/' .$filename2, './images/suburb/thumb/' .$rename);

                return $rename;

        }

        }
        
        function deletesuburb(){

                $this->location_model->deletesuburb();

                $data = array('msg'=>'Successfully Deleted!');

                $this->session->set_userdata($data);

                redirect('location/suburbList',$data);

			

	}

        

}