<?php

class Addescape extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('accesscontrol');
		$this->load->model('addescape_model');
		$this->load->model('location_model');
		$this->load->library('form_validation');
        Accesscontrol_helper::is_logged_in_front();
		$this->earnings = Accesscontrol_helper::get_earnings();
		$this->form_validation->set_error_delimiters('<label class="error">', '</label>');
		$this->load->library('image_lib');
		$this->load->helper('form');
		$this->load->helper(array('dompdf', 'file'));
		$this->load->helper('csv_helper');
		$this->load->helper('directory_helper');
		$this->load->helper('Excel_helper');
		$this->config->load('facebook');
		$this->load->helper('date');
	}

	function index()
	{
		$this->csstyles->add(base_url() . 'assets/frontend/css/wizard.css');
		$this->csstyles->add(base_url() . 'assets/frontend/css/jquery-ui.css');
		$this->csstyles->add(base_url() . 'assets/frontend/css/jquery.ptTimeSelect.css');
		$this->csstyles->add('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/themes/redmond/jquery-ui.css');
				
		$this->javascripts->add(base_url() . 'assets/frontend/js/jquery-ui.js');
		$this->javascripts->add(base_url() . 'assets/frontend/js/jquery.steps.js');
		$this->javascripts->add(base_url() . 'assets/frontend/js/modal.js');
		$this->javascripts->add(base_url() . 'assets/frontend/js/bootbox.min.js');
	//	$this->javascripts->add(base_url() . 'assets/frontend/js/uploadify/swfobject.js');
	//	$this->javascripts->add(base_url() . 'assets/frontend/js/uploadify/jquery.uploadify.v2.1.4.min.js');
	//	$this->javascripts->add(base_url() . 'assets/frontend/js/uploadify/vortexdev.js');
		$this->javascripts->add(base_url() . 'assets/frontend/js/jquery.ptTimeSelect.js');
		
		$this->csstyles->add(base_url() . 'assets/frontend/css/custom.css'); 

		//remove the dropzone file uplaoder
		//$this->csstyles->add(base_url() . 'assets/backend/js/dropzone/css/dropzone.css');
		//$this->javascripts->add(base_url() . 'assets/backend/js/dropzone/dropzone.js');
	
		//$this->javascripts->add(base_url() . 'assets/backend/js/ajaxfileupload.js');
		
		$data['javascriptsArray']	 = $this->javascripts->get();
		$data['csstyles']			 = $this->csstyles->get();
		
		$data['base_url']			 = base_url();
		
		if($this->session->userdata('Fb_user'))
		{
			$data['fb_arr'] = $this->session->userdata('Fb_user');
		}
		if($this->uri->segment(2) || $this->input->post('property_id') != '')
		{
			if ($this->uri->segment(2))
				$property_code = $this->uri->segment(2);
			else
				$property_code = $this->input->post('property_code');
			
			$data['property_info'] = $this->addescape_model->getPropertyInfobyCode($property_code);
			
			$data['amenities_detail'] = $this->addescape_model->getAmenitiesByID($data['property_info']->id);
			$data['gallery_images'] = $this->addescape_model->getAllGalleriesByID($data['property_info']->id);
			$data['extra_property'] = $this->addescape_model->getAllExtraProp($data['property_info']->id);
			$data['cities'] = $this->location_model->getCityByRegion($data['property_info']->region_id);
			$data['region'] = $this->location_model->getRegionByCountry($data['property_info']->country_id);
			$data['suburbs'] = $this->location_model->getSuburbCity($data['property_info']->city_id);
			$data['prop_cats'] = $this->addescape_model->get_property_category($data['property_info']->id);
			$data['prop_sky_channel'] = $this->addescape_model->get_property_sky_channel($data['property_info']->id);
			$data['prop_ames'] = $this->addescape_model->get_property_amenity($data['property_info']->id);
			$data['city_name'] = $this->addescape_model->get_city_name($data['property_info']->id);
		}
		$data['user_profile_info'] = $this->addescape_model->getUserInfo($this->session->userdata('user_id'));
		$data['countries'] = $this->location_model->getAllCountries();
		$data['categories'] = $this->addescape_model->getAllCategories();
		$data['skyChannel'] = $this->addescape_model->getAllSkyChannels();
		$data['freeviewChannel'] = $this->addescape_model->getAllChannels();
		$data['tvChannelsArray'] = $this->addescape_model->getTotalTvChannelsType();
		$data['channelsArray'] = $this->addescape_model->getAllTvChannels();
		$data['amenities'] = $this->addescape_model->getAllAmenities();
		$data['escapes'] = $this->addescape_model->getAllEscapes();
		$data['calendar'] = $this->display($year = null, $month = null);
		$data['page_title'] = 'Add Escape';

		$data['add_property']   =   'addescape/add_escape';
		
		$this->load->model('login/Site_setting_model');
		
		$data['settings'] = $this->Site_setting_model->get_site_info(1);
		$data['header_menus'] = $this->Site_setting_model->get_header_menu();
		$data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
		$data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();




		$this->load->view('new_add_propertyx', $data);
	}
	/*
	*  Function to SAVE OR UPDATE ESCAPE DETAILS.
	*
	*/
	function updateEscape(){
		if($this->session->userdata('Fb_user'))
		{
			$data['fb_arr'] = $this->session->userdata('Fb_user');
		}
		
		/* if(isset($_FILES['certificate']) and ($_FILES['certificate']['error'] != '4') and !empty($_FILES['certificate']['name'])) {
		
			if ($this->input->post('save_property_id') != 0){
				$rename = $this->certificate_upload($this->input->post('save_property_id'));
			}elseif (@$this->input->post('property_id')){
				$rename = $this->certificate_upload($this->input->post('property_id'));
			}else{
				$rename = $this->certificate_upload('');
			}
		}
		else
		{
			$rename = $this->input->post('old_certificate');
		} */ // CRETIFICATES NOT IN USE.
		$rename = '';
		
		$ret = $this->addescape_model->update_property_details($rename);
		$temp = explode('|', $ret);
		$data['user_profile_info'] = $this->addescape_model->getUserInfo($this->session->userdata('user_id'));
		$data['msg'] = "This escape will be visible for all after admin approval.";
		$this->session->set_userdata($data);
		$data['owner'] = $this->addescape_model->getUserInfo($this->session->userdata('user_id'));
		$data['escape_name'] = $this->input->post('title');
		$data['private_code'] = $temp[1];
		$data['page_title'] = 'Add Escape';
		if(isset($_POST['property_id']) && !empty($_POST['property_id'])) {
		
			$data['add_property']           =   'addescape/add_edit_thanks';
		} else {
			$data['add_property']           =   'addescape/add_thanks';
		}
		$this->load->model('login/Site_setting_model');
		$data['settings'] = $this->Site_setting_model->get_site_info(1);
		$data['header_menus'] = $this->Site_setting_model->get_header_menu();
		$data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
		$data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();
		
		if (!@$this->input->post($this->input->post('property_id'))){
			$this->load->model('email/email_model');
			$this->email_model->add_escape_mail($data['escape_name'], $data['private_code'], $data['user_profile_info']->email);
		}

		$this->load->view('new_add_propertyx', $data);
	}
	/*
	*  Function ---------------------------------
	*
	*/
	function display($year = null, $month = null) {
		if (!$year) {
			$year = date('Y');
		}
		if (!$month) {
			$month = date('m');
		}
		$this->load->model('Mycal_model');
		if ($day = $this->input->post('day')) {
			$this->Mycal_model->add_calendar_data(
				"$year-$month-$day",
				$this->input->post('data')
				);
		}
		return $this->Mycal_model->generate($year, $month);
	}

	/*
	*  Function ---------------------------------
	*
	*/
	function certificate_upload($property_id){
    	if ($property_id != ''){
			$data['property_info'] = $this->addescape_model->getPropertyInfobyID($property_id);
			$certificate = $data['property_info']->certificate;
		}else{
			$certificate = '';
		}
		if($certificate != '')
		{
			unlink('./images/files/'.$certificate);
		}
		$config['overwrite'] = 'TRUE'; 
		$config['upload_path'] = './images/files/';
		$config['allowed_types'] = '*';
		$config['max_size'] = '200000';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('certificate'))
		{
			$error = array('error' => $this->upload->display_errors());
			$data['errors'] = $error;
			$data['main_client_view']           =   'user/user-dashboard';
			$data['dashboard_content']          =   'user-main-content-edit';
			$this->load->view('user', $data);
		}
		else
		{
			$data1 = array('upload_data' => $this->upload->data());
			$image= $data1['upload_data']['file_name'];

			$filename1 = $data1['upload_data']['raw_name'].$data1['upload_data']['file_ext'];
			$rename = time() . $this->session->userdata('user_id') .$data1['upload_data']['file_ext'];
			rename('./images/files/' .$filename1, './images/files/' .$rename);
			return $rename;
		}
	}
	
	/*
	* Function to save information
	*
	*/
	function saveInformation()
    {
		if (!empty($_POST)) {
			$this->addescape_model->saveInformation();
		}
	}
	
	/*
	*  Function to upload file
	*
	*/
	function imageUpload() {
		if(isset($_FILES['certificate']) && !empty($_FILES['certificate'])) {
			$upload = $_FILES['certificate'];
			$file_name= rand()."_".time()."_".$upload['name']; 
			$file_path= $upload['tmp_name']; 
			$target_path = 'images/files/'.$file_name;
			//move_uploaded_file($file_path,"assets/upload/documents/$document_id/$image_name");
			 if(move_uploaded_file($file_path,$target_path)) {
				echo $file_name;
			 } 
		}
	}
	/*
	*  Function to TO GET IMAGE GALLERY FOR ESCAPE
	*
	*/
	function getImageGallery() {

        $escape_id              = $_GET['id'];
		$data['base_url'] 		= base_url();
		$data['escape_id']  	= $escape_id;
		$data['imagesArray'] 	= $this->addescape_model->getImageGallery($escape_id);

		echo $this->load->view('addescape/gallery',$data);
	}

   /**
	*  Function TO INSERT ESCAPE AND GET ESCAPE ID in RETURN FOR IMAGE GALLERY.
	*/
	function insertEscape() {
		echo $this->addescape_model->getLastInsertedEscape();
	}
	
	/**
	 * Function to Delete Escape Images.
	 *
	 */
	function deleteEscapeImages($escape_id,$image_name){
		$result =  $this->addescape_model->deleteEscapeImages($escape_id,$image_name);

		if($result == 1){
			unlink("images/property_img/gallery/$image_name");
			unlink("images/property_img/gallery/thumb/$image_name");
			unlink("images/property_img/gallery/medium/$image_name");
		
			echo 1;
		}
	}
	/**
	 * Function to Upload Images To Escape Galleries. it serve ajax call
	 */
	function uploadEscapeImages()
    {
		$escape_id	 = $_GET['id'];
		$fileType	 = explode("/", $_FILES['upl']["type"]);
		$time		 = time();
		$imagefile	 = $_FILES['upl']["tmp_name"];
		$imageName	 = $escape_id."_".rand()."_".$time . "." . $fileType[1];
		//$imageName	 = $escape_id."_".$time . "." . $fileType[1];
		
		move_uploaded_file($imagefile, "images/property_img/gallery/$imageName");
		
		$src = "images/property_img/gallery/$imageName";
		
		//**** FOR WATERMARK ****//
		$watermark = 'images/watermark/escape_watermark.png';
		$this->waterMark($src,$watermark);
		//**** FOR WATERMARK ENDS****//
		
		
		//**** FOR THUMBS ****//
		$dst = "images/property_img/gallery/thumb/$imageName";
		$height = 132;
		$width = 202;
		$this->image_resize($src, $dst, $width, $height, 1);
		//**** FOR THUMBS ENDS ****//
		
		//**** FOR Medium ****//
		$dst = "images/property_img/gallery/medium/$imageName";
		$height = 530;
		$width = 705;
		$this->image_resize($src, $dst, $width, $height, 1);
		//**** FOR Medium ENDS ****//


		$this->addescape_model->uploadEscapeImages($escape_id,$imageName);	
	}
	/**
	 * Function to Make THUMBS and MIDDLE Size Images.
	 *
	 */
	function image_resize($src, $dst, $width, $height, $crop=0){
	  if(!list($w, $h) = getimagesize($src)) return "Unsupported picture type!";
	  $type = strtolower(substr(strrchr($src,"."),1));
	  if($type == 'jpeg') $type = 'jpg';
	  if($type == 'giff') $type = 'gif';
	  switch($type){
		case 'bmp': $img = imagecreatefromwbmp($src); break;
		case 'gif': $img = imagecreatefromgif($src); break;
		case 'jpg': $img = imagecreatefromjpeg($src); break;
		case 'png': $img = imagecreatefrompng($src); break;
		default : return "Unsupported picture type!";
	  }

	  // resize
	  if($crop){
		//if($w < $width or $h < $height) return "Picture is too small!";
		$ratio = max($width/$w, $height/$h);
		$h = $height / $ratio;
		$x = ($w - $width / $ratio) / 2;
		$w = $width / $ratio;
	  }
	  else{
		//if($w < $width and $h < $height) return "Picture is too small!";
		$ratio = min($width/$w, $height/$h);
		$width = $w * $ratio;
		$height = $h * $ratio;
		$x = 0;
	  }

	  $new = imagecreatetruecolor($width, $height);

	  // preserve transparency
	  if($type == "gif" or $type == "png"){
		imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
		imagealphablending($new, false);
		imagesavealpha($new, true);
	  }

	  imagecopyresampled($new, $img, 0, 0, $x, 0, $width, $height, $w, $h);

	  switch($type){
		case 'bmp': imagewbmp($new, $dst); break;
		case 'gif': imagegif($new, $dst); break;
		case 'jpg': imagejpeg($new, $dst); break;
		case 'png': imagepng($new, $dst); break;
	  }
	  
		//**** FOR WATERMARK ****//
		/* $watermark = 'images/watermark/escape_watermark.png';
		$this->waterMark($dst,$watermark); */
		//**** FOR WATERMARK ENDS****//
		
	  return true;
	}
	/**
	 * Function to Create Watermark
	 *
	 */
	function waterMark($image_src,$watermark){
		// Load the stamp and the photo to apply the watermark to
		$stamp = imagecreatefrompng($watermark);
		$im = imagecreatefromjpeg($image_src);

		// Set the margins for the stamp and get the height/width of the stamp image
		$marge_right = 10;
		$marge_bottom = 10;
		$sx = imagesx($stamp);
		$sy = imagesy($stamp);

		// Copy the stamp image onto our photo using the margin offsets and the photo 
		// width to calculate positioning of the stamp. 
		imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
		
		//imagecopymerge($im, $stamp, imagesx($im) - $sx - $marge_right,imagesy($im) - $sy - $marge_bottom, 0, 0,imagesx($stamp),imagesy($stamp), 50);

		imagejpeg($im,$image_src,100);
		//imagepng($im);
		imagedestroy($im); 
	}

    /**
     * Delete an escape based on private code.
     */
    public function deleteEscape()
    {
        $propertyPrivateCode     = $this->input->get('id');
        $addescapeModel          = new Addescape_model();

        $addescapeModel->removeEscapeByPrivateCode($propertyPrivateCode);
        redirect('user/escapeList');
    }
}