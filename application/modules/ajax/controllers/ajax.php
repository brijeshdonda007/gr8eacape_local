<?php



class Ajax extends CI_Controller
{

	

	function __construct(){

                parent::__construct();

                $this->load->helper('url');

                $this->load->library('session');

                $this->load->model('ajax_model');

//                $this->load->library('image_lib');

                $this->load->helper('form');

                $this->load->helper('ratings');

                $this->load->model('ratings_model');

                $this->load->library('form_validation');

                $this->load->database();

	}

	

	function index(){

               

		

	}

        

        function getRegionAjax($country_id)

        {

                $data['ajax_region'] = $this->ajax_model->getRegionAjax($country_id);
				if(empty($data['ajax_region'])) {
					echo '<input type="text" name="country_region" id="country_region" onblur="getLocationValues();">
						<input type="hidden" name="is_region" id="is_region" value="1">';

				} else{ 
					$this->load->view('ajax/region',$data);
				}
                

        }

         function getCityAjax($region_id)

        {

                $data['ajax_city'] = $this->ajax_model->getCityAjax($region_id);
				if(empty($data['ajax_city'])) {
					echo '<input type="text" name="region_city" id="region_city" value="" onblur="getLocationValues();"> 
				  	      <input type="hidden" name="is_city" id="is_city" value="1">';

				} else{
					$this->load->view('ajax/city',$data);
				}
                

        }

    function getSkyChannelAjax($televisionTypeid)
    {
            $data['ajax_channels'] = $this->ajax_model->getChannelsByAjax($televisionTypeid);

            if(!empty($data['ajax_channels'])) {
                $this->load->view('ajax/channels',$data);

            } else {
                echo '';
            }
    }



        
////////////////////////////////////////////////////////////// modified ////////////////////////////////////////
         function getSuburbAjax($city_id)

        {

                $data['ajax_suburb'] = $this->ajax_model->getSuburbAjax($city_id);
				if(empty($data['ajax_suburb'])) {
					echo '<input type="text" name="city_suburb" id="city_suburb" onblur="getLocationValues();"> 
					<input type="hidden" name="is_suburb" id="is_suburb" value="1">';

				} else{
					$this->load->view('ajax/suburb',$data);
				}


        }
/////////////////////////////////////////////////////////////////////////////////////////////////////////
        function editpropertygalleryimg()

        {



            $img = $this->ajax_model->getGalleryImgByID($this->input->post('imgid'));

            $property_id = $img->property_id;

            $gallery_img = $img->image;

            $rename = $this->image_upload($gallery_img);

            $this->ajax_model->updateGalleryImg($rename);

            redirect('ajax/editGalleryImg/'.$property_id);

        }

        function image_upload($gallery_img){

                unlink('./images/property_img/gallery/medium/'.$gallery_img);

                unlink('./images/property_img/gallery/thumb/'.$gallery_img);

                unlink('./images/property_img/gallery/'.$gallery_img);

                $config['overwrite'] = 'TRUE'; 

		$config['upload_path'] = './images/property_img/gallery/';

                $config['allowed_types'] = 'gif|jpg|png';

                $config['max_size'] = '200000';

                $config['max_width'] = '3000';

                $config['max_height'] = '40000';

                

                $this->load->library('upload', $config);

                $this->load->library('image_lib');

                if ( ! $this->upload->do_upload('photoimg'))

                {

                        $error = array('error' => $this->upload->display_errors());

                        $data['errors'] = $error;

                }

                else

                {



                $data1 = array('upload_data' => $this->upload->data());



                $image= $data1['upload_data']['file_name'];



                $configBig = array();

                $configBig['image_library'] = 'gd2';

                $configBig['source_image'] = './images/property_img/gallery/'.$image;

                $configBig['create_thumb'] = TRUE;

                $configBig['maintain_ratio'] = TRUE;

                

                $configBig['width'] = 705;

                $configBig['height'] = '1';

                $configBig['master_dim'] = 'width';

                $configBig['thumb_marker'] = "_big";

                $configBig['new_image'] = './images/property_img/gallery/medium';

                $this->image_lib->initialize($configBig);

                $this->image_lib->resize();

                $this->image_lib->clear();

                unset($configBig);



                $configBig = array();

                $configBig['image_library'] = 'gd2';

                $configBig['source_image'] = './images/property_img/gallery/'.$image;

                $configBig['create_thumb'] = TRUE;

                $configBig['maintain_ratio'] = FALSE;

//                $configBig['master_dim'] = 'auto';

                $configBig['width'] = 202;

                $configBig['height'] = 137;

//                $configBig['height'] = '1';

//                $configBig['master_dim'] = 'width';

                $configBig['thumb_marker'] = "_thumb";

                $configBig['new_image'] = './images/property_img/gallery/thumb';

                $this->image_lib->initialize($configBig);

                $this->image_lib->resize();

                $this->image_lib->clear();

                unset($configBig);



                $filename1 = $data1['upload_data']['raw_name'].'_big'.$data1['upload_data']['file_ext'];

                $filename2 = $data1['upload_data']['raw_name'].'_thumb'.$data1['upload_data']['file_ext'];

                $filename3 = $data1['upload_data']['raw_name'].$data1['upload_data']['file_ext'];

                $pieces = explode(".", $gallery_img);

                

                $rename = $pieces[0].$data1['upload_data']['file_ext'];

                rename('./images/property_img/gallery/medium/' .$filename1, './images/property_img/gallery/medium/' .$rename);

                rename('./images/property_img/gallery/thumb/' .$filename2, './images/property_img/gallery/thumb/' .$rename);

                rename('./images/property_img/gallery/' .$filename3, './images/property_img/gallery/' .$rename);

                return $rename;

        }

        }

        function editGalleryImg()

        {

            $data['gallery_images'] = $this->ajax_model->getAllGalleriesByID($this->uri->segment(3));

            $this->load->view('ajax/edit_gallery_img',$data);

        }

        function editSingleImgForm()

        {

            $data['single_img'] = $this->ajax_model->getSingleImg($this->uri->segment(3));

            $this->load->view('ajax/edit_single_img_form',$data);

        }

        function deleteGalleryImg()

        {

            $imgs = $this->ajax_model->getGalleryImgByID($this->uri->segment(3));

            $image_name = $imgs->image;

            $property_id = $imgs->property_id;

            unlink('./images/gallery/bigs/'.$image_name);

            $this->ajax_model->deleteGallery();



            redirect('ajax/editGalleryImg/'.$property_id);

            

        }

       

        function removeExtraProp()

        {

            $id = $this->uri->segment(3);

            $exinfo = $this->ajax_model->getExPropertyInfo($id);

            $this->ajax_model->deleteExtraProp();

            redirect('ajax/editExtraInfo/'.$exinfo->property_id);

        }

        function editExtraInfo()

        {

            $property_id = $this->uri->segment(3);

            $data['prop_info'] = $this->ajax_model->getPropertyInfobyID($property_id);

            $data['extra_property'] = $this->ajax_model->getAllExtraInfoByID($property_id);

            $this->load->view('ajax/edit_extra_info',$data);

        }

        function updateExtraInfoByID()

        {

            $id = $this->uri->segment(3);

            $data['single_info'] = $this->ajax_model->getSinglePropByID($id);

            $this->load->view('ajax/update_extra_info_single',$data);

            

        }

        function updateSingleExtra()

        {

            $this->ajax_model->updateSingleExtra();

            redirect('ajax/editExtraInfo/'.$this->input->post('property_id'));

        }

	function loadMore()

        {

            $data['property_lists']          =    $this->ajax_model->getProperty();

            $data['ratings_cat'] = $this->ajax_model->getAllRateCategory();

            $data['property_count'] = $this->ajax_model->get_all_propery();

            $pageLimit = $this->input->post('pageLimit');

            if($pageLimit == 12)

            {

                $config = array();

                $config["base_url"] = base_url() . "home/index";

                $config["total_rows"] = $this->ajax_model->get_all_propery();

                $config["per_page"] = 4;

                $config["uri_segment"] = 3;

                $this->pagination->initialize($config);

                $data["links"] = $this->pagination->create_links();

            }

            $this->load->view('ajax/load_more',$data);

        }

        function dataByRange()

        {

            

            $data['search_results'] = $this->ajax_model->dataByPriceRange();



            $this->load->view('ajax/range_slider_results',$data);

            

        }

        

        function loadHomeSearchResults()

        {

            $data['total_ajax_search'] = $this->ajax_model->getHomeSearchResultsCounts();

            $data['search_results'] = $this->ajax_model->loadHomeSearchResults();

            $data['ratings_cat'] = $this->ajax_model->getAllRateCategory();

            $this->load->view('ajax/main_search_results',$data);

        }

         function loadRefineSearchResults()

        {

            $data['total_ajax_search'] = $this->ajax_model->getRefineSearchResultsCounts();

            $data['search_results'] = $this->ajax_model->loadRefineSearchResults();

            $data['ratings_cat'] = $this->ajax_model->getAllRateCategory();

            $this->load->view('ajax/refine_search_results',$data);

        }

        

        function loadPropertyByCat()

        {

            $data['search_results'] = $this->ajax_model->loadPropertyByCat();

            $data['prop_count_bycat'] = $this->ajax_model->countPropertyByCategory($this->uri->segment(3));

            $this->load->view('ajax/property_bycat',$data);

        }

        

        function checkAvailability()

        {

            

                $arr = $this->ajax_model->checkAvailability();

                echo json_encode($arr);

                

        }
	function delete_escapes(){
		$this->ajax_model->delete_escapes();
	}

	function loadMore_owner()

        {

            $data['property_lists']          =    $this->ajax_model->getProperty_owner();

            $data['ratings_cat'] = $this->ajax_model->getAllRateCategory();

            $this->load->view('ajax/load_more_ajax',$data);

        }

        

        function ratings()

        {

            $arr = $this->ratings_model->insertRate();

            echo json_encode($arr);

        }

        

        function ratings_users()

        {

            $arr = $this->ratings_model->insertRate_users();

            echo json_encode($arr);

        }



	function sendenquiry()

        {
			$this->load->model('email/email_model');
            $enquiry = $this->email_model->sendEnquiry();

            echo $enquiry;

        }

        

        function editEachfixedProp()

        {

            

            $id = $this->ajax_model->editEachfixedProp();

            if($id)

            {

                $data['prop_info'] = $this->ajax_model->get_this_value($id);

                $data['fieldx'] = $this->input->post('fieldx');

                $this->load->view('ajax/single_extra', $data);

            }

            

        }

        function editEachcustomProp()

        {

            $id = $this->ajax_model->editEachcustomProp();

            $data['i'] = $this->input->post('eid');

            if($id)

            {

                $data['exp'] = $this->ajax_model->get_this_value($id);

                

                $this->load->view('ajax/single_extra_custom', $data);

            }

        }

        

        function savepet()

        {

            $this->ajax_model->update_pet();

        }

        

        function subscribe()
        {  
            
            $this->load->library('form_validation');
            $this->form_validation->set_rules('full_name', 'Input Field', 'trim|required|xss_clean');
            $this->form_validation->set_rules('subscribe_email',"Email",'trim|required|xss_clean');
            if($this->form_validation->run()==TRUE)
		{
            $this->load->model('login/Site_setting_model');
            $site_info = $this->Site_setting_model->get_site_info(1);
			$this->load->model('email/email_model');
            $result = $this->email_model->subscribe_email($site_info->contact_email);
                }
                echo $result;exit();
            if($result == 0)

            {

                echo 0;

            }

            else

            {

                echo 1;

            }

        }

		function getLocationValues(){
			$sQuery = $_POST['country_name'].' '.$_POST['state'].' '.$_POST['city'].' '.$_POST['Suburb'];
	
			$sURL = 'http://maps.googleapis.com/maps/api/geocode/json?address=' .urlencode($sQuery). '&sensor=false&region=en&language=en';
				print_r(file_get_contents($sURL));
		
		}
		
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}