<?php

// @todo Too much controller. Relocate some functions

class Admin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		//$this->load->library('parser');
		$this->load->library('form_validation');
		$this->load->model('admin_model');
        $this->load->library('jpgraph');
	    $this->load->library('user_agent');
        $this->load->helper('text');
        $this->load->helper('form');

        
	}
	function index()
	{
		if($this->session->userdata('admin_user_id') && $this->session->userdata('admin_session_id'))
		  {
			   redirect('admin/dashboard');
		  }
		  else
		  {
			   $data['title']="GR8 Escapes:Cpanel Login";
			   $data['page_title'] = 'Admin Login';
			   $this->load->view('admin/login_form',$data);
		  }
	}
	function login()
	{
		$this->form_validation->set_rules('username', 'Username','trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password','trim|required|min_length[6]|xss_clean');
		if(!$this->form_validation->run())
		{
			$this->session->set_flashdata('message','Incorrect username or password');
			redirect('admin/index');
		}
		else
		{
            if ( $this->input->post( 'remember_me' ) ) // set sess_expire_on_close to 0 or FALSE when remember me is checked.
                $this->session->sess_expire_on_close = FALSE;
            else 
                $this->session->sess_expire_on_close = TRUE;
            
			$login_status = $this->admin_model->admin_login($this->input->post('username'), $this->input->post('password'));
			if($this->session->userdata('admin_user_id'))
			{
				redirect('admin/dashboard');
			}
			else
			{
				$this->session->set_flashdata('message','Incorrect username or password');
				redirect('admin/index');
			}
		}
	}
	function logout()
	{
		$admin_user_id = $this->session->userdata('admin_user_id');
		$admin_session_id = $this->session->userdata('admin_session_id');
		$user_id = $this->admin_model->checkID($admin_user_id,$admin_session_id);
		$this->admin_model->logout($user_id);
		$this->session->unset_userdata('admin_user_id');
		$this->session->unset_userdata('admin_session_id');
		$this->session->sess_destroy();
		redirect('admin/index');
	}
	function forgotpassword(){
		$data['page_title'] = 'Forgot password';
		$this->load->view('admin/email_form', $data);

	}
    function get_password()
    {
		$this->form_validation->set_rules('email', 'Email', 'required|email|callback_check_email_forget'); 
		if($this->form_validation->run()==FALSE)
		{
			$data['page_title'] = 'Forgot password';
			$this->load->view('admin/email_form', $data);
		}
		else
		{
			$this->load->model('login/Site_setting_model');
			$site_info=$this->Site_setting_model->get_site_info(1);
			$this->load->model('email/email_model');
			$this->email_model->forget_password_reminder_email_admin($site_info->contact_email);
            $data = array('msg'=>'Thanks a password reset link has been emailed to you!');
            $this->session->set_userdata($data);
			redirect('/admin/forgotpassword');
		}
	}
	function check_email_forget()
	{
		if($this->admin_model->check_email_forget($this->input->post('email'))==FALSE)
		{
			$this->form_validation->set_message('check_email_forget', 'Sorry your email does not exist!');
			return false;
		}
		else 
		{
			return true;
		}					
	}
	function change_process($email)
	{
		$em=ydecode(udecode($email),$this->config->item('encoder'));
		$data['email']=$email;
		if($this->admin_model->check_email_forget($em)==1)
		{
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[16]');
			$this->form_validation->set_rules('confirmation', 'Confirm Password', 'required|matches[password]');
			if($this->form_validation->run()==FALSE)
			{
				$data['page_title'] = 'Password Reset';
				$this->load->view('admin/change_password', $data);
			}
			else
			{
				$this->admin_model->update_password($em);
				$data = array('msg'=>'Thanks your password has been updated successfully.');
				$this->session->set_userdata($data);
				redirect('/admin/');
			}
		}
		else
		{
			redirect(site_url());
		}
	}
	function dashboard(){
        $data['latest_booking'] = $this->admin_model->latest_booking();
        $data['latest_users'] = $this->admin_model->latest_users();
		$data['main_content_view'] = 'dashboard/dashboard_content';
		$this->load->view('default', $data);
	}
	function admins_lists(){
        $config = array();
        $config["base_url"] = base_url() . "admin/admins_lists/";
        $config["total_rows"] = $this->admin_model->record_count_all_admins();
        $config["per_page"] = 30;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['all_admins']		=	$this->admin_model->all_admins($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['total_count'] = $config["total_rows"];
		$data['main_content_view']		=		'admins/lists';
		$this->load->view('default', $data);
	}
	function addadmin(){
		$data['form_title'] = 'Add New Administrator';
		$data['main_content_view'] = 'admins/add';
		$this->load->view('default', $data);
	}
	function newadmin(){
		$user_id = $this->admin_model->addAdmin();
		$data = array('msg'=>'Successfully Saved!');
		redirect('admin/admins/list',$data);
	}
	function editAdmin(){
		$data['admin'] = $this->admin_model->getAdminInfo($this->uri->segment(4));
		$data['form_title'] = 'Edit Administrator Info';
		$data['main_content_view'] = 'admins/edit';
		$this->load->view('default', $data);
	}
	function deleteAdmin(){
		$this->admin_model->deleteAdmin();
		$data = array('msg' => 'Successfully Deleted!');
		redirect('admin/admins/list', $data);
	}
	function addeditAdmin(){
		$this->admin_model->addeditAdmin();
		$data = array('msg'=>'Successfully Saved!');
		redirect('admin/admins/list',$data);
	}
	
	function users_lists(){
        $config = array();
        $config["base_url"] = base_url() . "admin/users_lists/";
        $config["total_rows"] = $this->admin_model->record_count_all_users();
        $config["per_page"] = 30;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['all_users']		=	$this->admin_model->all_users($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['total_count'] = $config["total_rows"];
		$data['main_content_view']		=		'users/lists';
		$this->load->view('default', $data);
	}
	function adduser(){
		$data['form_title'] = 'Add User';
		$data['country'] = $this->admin_model->getCountry();
		$data['usergroup'] = $this->admin_model->all_user_groups();
		$data['main_content_view'] = 'users/add';
		$this->load->view('default', $data);
	}
	function newuser(){
		$user_id = $this->admin_model->addUser();
		$image_name = '';
		if(!empty($_FILES['profile_picture']['name'])){
			$image_name = $this->user_image_upload($user_id);
		}
		if ($image_name != '')
			$this->admin_model->add_userImage($user_id, $image_name);
		$data = array('msg'=>'Successfully Saved!');
		redirect('admin/users_lists',$data);
	}
	function editUser(){
		$data['user'] = $this->admin_model->getUserInfo_cntry($this->uri->segment(4));
		$data['usergroup'] = $this->admin_model->all_user_groups();
		$data['country'] = $this->admin_model->getCountry();
		$data['form_title'] = 'Edit User';
		$data['main_content_view'] = 'users/edit';
		$this->load->view('default', $data);
	}
	function deleteUser(){
		$this->admin_model->deleteUser();
		$data = array('msg' => 'Successfully Deleted!');
		redirect('admin/users/list', $data);
	}
	function addeditUser(){
		$image_name = '';
		if(!empty($_FILES['profile_picture']['name'])){
			$image_name = $this->user_image_upload($this->input->post('userid'));
		}
		$this->admin_model->addeditUser($image_name);
		$data = array('msg'=>'Successfully Saved!');
		redirect('admin/users_lists',$data);
	}
	function editmenu(){
		$data['menu'] = $this->admin_model->get_menuInfo($this->uri->segment(4));
		$data['menu_id'] = $this->uri->segment(4);
		$data['main_content_view'] = 'menu/edit';
		$data['form_title'] = $this->admin_model->get_menu_section($this->uri->segment(4))->name;
		$this->load->view('default', $data);
	}
	function section_list(){
		$data['sections'] = $this->admin_model->get_menuSections();
		$data['main_content_view'] = 'menu/section_list';
		$this->load->view('default', $data);
	}
	function section_add(){
		$data['main_content_view'] = 'menu/new_section';
		$this->load->view('default',$data);
	}
	function add_new_menu_section(){
		$this->admin_model->add_new_menu_section();
		redirect('admin/menu/section/list');
	}
	function add_new_menu_item(){
		echo $this->admin_model->add_new_menu_item();
	}
	function disable_menu_item(){
		echo $this->admin_model->disable_menu_item();
	}
	function updateMenu(){
		$this->admin_model->updateMenu();
		redirect('admin/menu/section/list');
	}
    function user_image_upload($user_id){
	    $data['user_profile_info'] = $this->admin_model->getUserInfo_cntry($user_id);
	    $profile_pic = $data['user_profile_info']->profile_picture;
	    if($profile_pic != '')
	    {
		    unlink('./images/profile_img/medium/'.$profile_pic);
		    unlink('./images/profile_img/thumb/'.$profile_pic);
		    unlink('./images/profile_img/large/'.$profile_pic);
	    }
	    $config['overwrite'] = 'TRUE'; 
		$config['upload_path'] = './images/profile_img/';
	    $config['allowed_types'] = 'gif|jpg|png';
	    $config['max_size'] = '200000';
	    $config['max_width'] = '3000';
	    $config['max_height'] = '40000';
	    $this->load->library('upload', $config);
	    $this->load->library('image_lib');
	    if ( ! $this->upload->do_upload('profile_picture'))
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
		    $configBig = array();
		    $configBig['image_library'] = 'gd2';
		    $configBig['source_image'] = './images/profile_img/'.$image;
		    $configBig['create_thumb'] = TRUE;
		    $configBig['maintain_ratio'] = TRUE;
		    $configBig['width'] = 100;
		    $configBig['height'] = '1';
		    $configBig['master_dim'] = 'width';
		    $configBig['thumb_marker'] = "_big";
		    $configBig['new_image'] = './images/profile_img/medium';
		    $this->image_lib->initialize($configBig);
		    $this->image_lib->resize();
		    $this->image_lib->clear();
		    unset($configBig);
		    $configBig = array();
		    $configBig['image_library'] = 'gd2';
		    $configBig['source_image'] = './images/profile_img/'.$image;
		    $configBig['create_thumb'] = TRUE;
		    $configBig['maintain_ratio'] = TRUE;
		    $configBig['width'] = 45;
		    $configBig['height'] = '1';
		    $configBig['master_dim'] = 'width';
		    $configBig['thumb_marker'] = "_thumb";
		    $configBig['new_image'] = './images/profile_img/thumb';
		    $this->image_lib->initialize($configBig);
		    $this->image_lib->resize();
		    $this->image_lib->clear();
		    unset($configBig);
		    $configBig = array();
		    $configBig['image_library'] = 'gd2';
		    $configBig['source_image'] = './images/profile_img/'.$image;
		    $configBig['create_thumb'] = TRUE;
		    $configBig['maintain_ratio'] = TRUE;
		    $configBig['width'] = 223;
		    $configBig['height'] = '1';
		    $configBig['master_dim'] = 'width';
		    $configBig['thumb_marker'] = "_large";
		    $configBig['new_image'] = './images/profile_img/large';
		    $this->image_lib->initialize($configBig);
		    $this->image_lib->resize();
		    $this->image_lib->clear();
		    unset($configBig);
		    $filename1 = $data1['upload_data']['raw_name'].'_big'.$data1['upload_data']['file_ext'];
		    $filename2 = $data1['upload_data']['raw_name'].'_thumb'.$data1['upload_data']['file_ext'];
		    $filename3 = $data1['upload_data']['raw_name'].'_large'.$data1['upload_data']['file_ext'];
		    $rename = 'profile_'.$user_id.$data1['upload_data']['file_ext'];
		    rename('./images/profile_img/medium/' .$filename1, './images/profile_img/medium/' .$rename);
		    rename('./images/profile_img/thumb/' .$filename2, './images/profile_img/thumb/' .$rename);
		    rename('./images/profile_img/large/' .$filename3, './images/profile_img/large/' .$rename);
		    unlink('./images/profile_img/'.$image);
		    return $rename;
		}
	}
	function group_lists(){
		$config = array();
		$config["base_url"] = base_url() . "admin/group_lists/";
		$config["total_rows"] = $this->admin_model->record_count_all_groups();
		$config["per_page"] = 30;
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['all_groups'] = $this->admin_model->all_groups($config["per_page"], $page);
		$data["links"] = $this->pagination->create_links();
		$data['total_count'] = $config["total_rows"];
		$data['main_content_view'] = 'groups/lists';
		$this->load->view('default', $data);
	}
	function addgroup(){
		$data['form_title'] = 'Add Group';
		$data['sections'] = $this->admin_model->get_All_sections();
		$data['properties'] = $this->admin_model->get_All_property();
		$data['main_content_view'] = 'groups/add';
		$this->load->view('default', $data);
	}
	function newgroup(){
		$group_id = $this->admin_model->addGroup();
		$data = array('msg' => 'Successfully added!');
		redirect('admin/group_lists', $data);
	}
	function editgroup(){
		$data['group'] = $this->admin_model->get_group($this->uri->segment(4));
		$data['group_detail'] = $this->admin_model->get_detail($this->uri->segment(4));
		$data['form_title'] = 'Edit Group';
		$data['sections'] = $this->admin_model->get_All_sections();
		$data['properties'] = $this->admin_model->get_All_property();
		$data['main_content_view'] = 'groups/edit';
		$this->load->view('default', $data);
	}
	function addeditGroup(){
		$this->admin_model->addeditGroup();
		$data = array('msg' => 'Successfully edited!');
		redirect('admin/group_lists', $data);
	}
	function deleteGroup(){
		$this->admin_model->deleteGroup();
		$data = array('msg' => 'Successfully deleted!');
		redirect('admin/group_lists', $data);
	}
	function order_lists(){
		$config = array();
		$config["base_url"] = base_url() . "admin/order_lists/";
		$config["total_rows"] = $this->admin_model->record_count_bookings();
		$config["per_page"] = 30;
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['all_bookings']		=	$this->admin_model->all_bookings($config["per_page"], $page);
		$data["links"] = $this->pagination->create_links();
		$data['total_count'] = $config["total_rows"];
		$data['main_content_view']		=		'order/lists';
		$this->load->view('default', $data);
	}
	function countryList(){
		$config = array();
		$config["base_url"] = base_url() . "admin/countryList";
		$config["total_rows"] = $this->admin_model->record_count_country();
		$config["per_page"] = 20;
		$config["uri_segment"] = 4;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
		$data['mess'] = '';
		$data['all_country'] = $this->admin_model->listCountry($config["per_page"], $page);
		$data["links"] = $this->pagination->create_links();
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
		$data['country'] = $this->admin_model->Country($this->uri->segment(5));
		$data['main_content_view']= "location/country_form";			
		$this->load->view('default',$data);
	}
	function addeditCountry(){ 
		$data['mess'] = '';		
		$product_id = $this->admin_model->addEditcountry();					
		$data = array('msg'=>'Successfully Saved!');
		$this->session->set_userdata($data);
		redirect('admin/countryList',$data);	
	}
	function deleteCountry(){
		$this->admin_model->deleteCountry();
		$data = array('msg'=>'Successfully Deleted!');
		$this->session->set_userdata($data);
		redirect('admin/countryList',$data);
	}
	function regionList(){
		$config = array();
		$config["base_url"] = base_url() . "admin/regionList";
		$config["total_rows"] = $this->admin_model->record_count_regionList();
		$config["per_page"] = 30;
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
		$data['mess'] = '';
		$data['all_region']		=	$this->admin_model->listRegion($config["per_page"], $page);
		$data["links"] = $this->pagination->create_links();
		$data['main_content_view']= "location/list_region";
		$this->load->view('default',$data);
	}
    function newRegion() {
		$data['form_title'] = "Add New";
		$data['countries'] = $this->admin_model->getAllCountries();
		$data['main_content_view'] = "location/region_form";			
		$this->load->view('default',$data);
	}
	function addeditRegion() {
		$data['mess'] = '';		
		$region_id = $this->admin_model->addEditregion();
		if($region_id)
		{
			if(($_FILES['featured_image']['error'] != '4') and !empty($_FILES['featured_image']['name']))
			{
				$feature_img = $this->feature_image_upload($region_id);
			}
			else{
				$feature_img = $this->input->post('old_featured_image');
			}
			$this->admin_model->update_feature_img($region_id, $feature_img);
		}
		$data = array('msg'=>'Successfully Saved!');
		$this->session->set_userdata($data);
		redirect('admin/regionList',$data);	
	}
	function editRegion() {
		$data['form_title'] = "Edit";
		$data['region'] = $this->admin_model->ediRegion($this->uri->segment(5));
		$data['countries'] = $this->admin_model->getAllCountries();
		$data['main_content_view']= "location/region_form";			
		$this->load->view('default',$data);
	}
	function feature_image_upload($inserted_id){
		$region_feat_img = $this->admin_model->ediRegion($inserted_id);
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
		$this->admin_model->deleteRegion();
		$data = array('msg'=>'Successfully Deleted!');
		$this->session->set_userdata($data);
		redirect('admin/regionList',$data);
	}
	function cityList() {
		$config = array();
		$config["base_url"] = base_url() . "admin/cityList";
		$config["total_rows"] = $this->admin_model->record_count_city();
		$config["per_page"] = 500;
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
		$data['mess'] = '';
		$data['all_city'] = $this->admin_model->listCity($config["per_page"], $page);
		$data["links"] = $this->pagination->create_links();
		$data['main_content_view']= "location/list_city";			
		$this->load->view('default',$data);
	}
	function newCity() {
		$data['form_title'] = "Add New";
		$data['countries'] = $this->admin_model->getAllCountries();
		$data['main_content_view'] = "location/city_form";			
		$this->load->view('default',$data);
	}
	function addeditCity(){
		$data['mess'] = '';		
		$city_id = $this->admin_model->addEditCity();
		if($city_id)
		{
			if(($_FILES['featured_image']['error'] != '4') and !empty($_FILES['featured_image']['name']))
			{
				$feature_img = $this->feature_image_uploadc($city_id);
			}
			else{
				$feature_img = $this->input->post('old_featured_image');
			}
			$this->admin_model->update_feature_img_c($city_id, $feature_img);
		}
		$data = array('msg'=>'Successfully Saved!');
		$this->session->set_userdata($data);
		redirect('admin/cityList',$data);	
	}
	function feature_image_uploadc($inserted_id){
		$region_feat_img = $this->admin_model->ediRegion($inserted_id);
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
		$data['city'] = $this->admin_model->ediCity($this->uri->segment(5));
		$data['regions'] = $this->admin_model->getRegions($data['city']->country_id);
		$data['countries'] = $this->admin_model->getAllCountries();
		$data['main_content_view']= "location/city_form";			
		$this->load->view('default',$data);
	}
	function deleteCity() {
		$this->admin_model->deleteCity();
		$data = array('msg'=>'Successfully Deleted!');
		$this->session->set_userdata($data);
		redirect('admin/cityList',$data);
	}
	function suburbList()
	{
		$config = array();
		$config["base_url"] = base_url() . "admin/suburbList";
		$config["total_rows"] = $this->admin_model->record_count_suburb();
		$config["per_page"] = 500;
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
		$data['mess'] = '';
		$data['all_suburb'] = $this->admin_model->list_suburb($config["per_page"], $page);
		$data["links"] = $this->pagination->create_links();
		$data['main_content_view']= "location/list_suburb";			
		$this->load->view('default',$data);
	}
    function newsuburb()
    {
        $data['form_title'] = "Add New";
        $data['countries'] = $this->admin_model->getAllCountries();
        $data['main_content_view'] = "location/suburb_form";			
        $this->load->view('default',$data);
    }
	function editsuburb() {
		$data['form_title'] = "Edit";
		$data['suburb'] = $this->admin_model->edit_suburb($this->uri->segment(5));
		$data['cities'] = $this->admin_model->getCities($data['suburb']->region_id);
		$data['regions'] = $this->admin_model->getRegions($data['suburb']->country_id);
		$data['countries'] = $this->admin_model->getAllCountries();
		$data['main_content_view']= "location/suburb_form";			
		$this->load->view('default',$data);
	}
	function addeditsuburb()
	{
		$data['mess'] = '';		
		$suburb_id = $this->admin_model->add_edit_suburb();
		if($suburb_id)
		{
			if(($_FILES['featured_image']['error'] != '4') and !empty($_FILES['featured_image']['name']))
			{
				$feature_img = $this->feature_image_upload_s($suburb_id);
			}
			else{
				$feature_img = $this->input->post('old_featured_image');
			}
			$this->admin_model->update_feature_img_s($suburb_id, $feature_img);
		}
		$data = array('msg'=>'Successfully Saved!');
		$this->session->set_userdata($data);
		redirect('suburbList',$data);
	}
	function feature_image_upload_s($inserted_id){
		$suburb_feat_img = $this->admin_model->edit_suburb($inserted_id);
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
		$this->admin_model->deletesuburb();
		$data = array('msg'=>'Successfully Deleted!');
		$this->session->set_userdata($data);
		redirect('admin/suburbList',$data);
	}
     function escapeList(){

		$data['all_category'] = $this->admin_model->get_all_category();
		//$config = array();
		$config["base_url"] = base_url() . "admin/escapeList";
		$config["total_rows"] = $this->admin_model->record_count_property();
		$config["per_page"] = 30;
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['mess'] = '';
		$data['all_property'] =	$this->admin_model->listProperty($config["per_page"], $page);
		$data['property_count'] = $config["total_rows"];
		$data["links"] = $this->pagination->create_links();
		$data['main_content_view']= "escape/escape_list";			
		$this->load->view('default',$data);
	}
	function editProperty() { 
		$this->admin_model->editCategory();
	}
	function addeditEscape(){ 
		$data['mess'] = '';
		$product_id = $this->admin_model->addeditCategory();
		$data = array('msg'=>'Successfully Saved!');
		$this->session->set_userdata($data);
		redirect('admin/categoryList',$data);
	}
	function deleteEscape(){
		$this->admin_model->deleteCategory();
	}
    function approveEscape()
    {
    	$escape_detail = $this->admin_model->get_property_detail($this->uri->segment(3));
    	$this->load->model('email/email_model');
    	$this->email_model->escape_approve_mail($escape_detail->private_code, $escape_detail->email);
        $this->admin_model->approveProperty($this->uri->segment(3));
        $data = array('msg'=>'Successfully Approved!');
        $this->session->set_userdata($data);
        redirect('admin/escapeList',$data);	
    }
     function verifyEscape()
    {
        $this->admin_model->verifyProperty($this->uri->segment(3));
        $data = array('msg'=>'Successfully Verified!');
        $this->session->set_userdata($data);
        redirect('admin/escapeList',$data);	
    }
    function declineEscape($escape_id)
    {
		$this->form_validation->set_rules('message', 'Message','trim|required|xss_clean');		
		if($this->form_validation->run())
		{
			$this->load->model('mail/message_model');
			$messageModel        = new Message_model();
			$messageModel->save(array('message'          => $this->input->post("message"),
                                  'to_user'          => $this->input->post("owner"),
                                  'booking_id'       => $this->input->post("escape_id"),
                                  'from_user'        => $this->input->post("escape_person"),
                                  'subject'          => $this->input->post("subject")
                            )
            );			
			$this->admin_model->declineProperty($this->uri->segment(3));
			$data = array('msg'=>'Successfully Declined!');
			$this->session->set_userdata($data);
			redirect('admin/escapeList',$data);	
		}
/*       $data['detail'] = $this->admin_model->get_property_detail($this->uri->segment(4));
       $data['main_content_view'] = "escape/escape_detail";
       $this->load->view('default', $data); 		*/
	   
	    $this->load->model("escapedetails/escapedetails_model");
        $escapeDetailModel               = new Escapedetails_model();
        $escapeID                        = $escape_id;
        $EscapeInfo			             = $escapeDetailModel->findById($escapeID);
        $this->data['escape']            = $EscapeInfo;		
		$this->data['user_profile_info'] = $this->admin_model->getUserInfo_cntry($EscapeInfo['owner_id']);

        $this->data['main_client_view']  = 'user/user-dashboard-message';
		$this->data['dashboard_content'] = 'mail/DeclinenewMessage';
		$this->data['page_title']        = 'New Message';
		$this->load->view('user', $this->data);
	   
    }
    function escapeDetail()
    {
       $data['detail'] = $this->admin_model->get_property_detail($this->uri->segment(4));
       $data['main_content_view'] = "escape/escape_detail";
       $this->load->view('default', $data); 
    }
    function categoryList(){
		$config = array();
		$config["base_url"] = base_url() . "admin/categoryList";
		$config["total_rows"] = $this->admin_model->record_count_category();
		$config["per_page"] = 30;
		$config["uri_segment"] = 3;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['mess'] = '';
		$data['all_category'] =	$this->admin_model->listCategory($config["per_page"], $page);
		$data["links"] = $this->pagination->create_links();
		$data['main_content_view']= "categories/category_list";
		$this->load->view('default',$data);
	}
	function editCategory() { 
        $data['category'] = $this->admin_model->editCategory();
        $data['form_title'] = 'Edit Category';
        $data['main_content_view'] = "categories/category_form";
        $this->load->view('default', $data);
	}
	function addeditcategory(){ 
		$data['mess'] = '';
		$product_id = $this->admin_model->addeditCategory();
		$data = array('msg'=>'Successfully Saved!');
		$this->session->set_userdata($data);
		redirect('admin/categoryList',$data);
	}
	function deleteCategory(){
		$this->admin_model->deleteCategory();
		$data = array('msg'=>'Successfully deleted!');
		$this->session->set_userdata($data);
		redirect('admin/categoryList',$data);
	}
    function loadcategoryform()
    {
        $data['main_content_view'] = "categories/category_form";
        $data['form_title'] = 'Add New Category';
        $this->load->view('default', $data);
    }
	function banner_list(){
		$data['banners'] = $this->admin_model->listBanner();
		$data['main_content_view'] = 'banner/banner_list';
		$this->load->view('default', $data);
	}
	function loadBannerForm(){
		$data['main_content_view'] = 'banner/banner_form';
		$data['form_title'] = 'Add New Banner';
		$this->load->view('default', $data);
	}
	function addupdatebanner(){
		$path = UPLOAD_PATH_BANNER;
		$upload_img_name = $this->banner_image_upload();
		$old_img = $this->input->post('old_img');
		if(	$old_img !=''):
			if ($upload_img_name !=''){ 		
				$page_id = $this->admin_model->addupdatebanner($upload_img_name);
				$old_image = $path . $old_img;
				@unlink($old_image);
			}
			else {
				$banner_id = $this->admin_model->addupdatebanner($old_img);
			}				
		else:
			$banner_id = $this->admin_model->addupdatebanner($upload_img_name);
		endif;
		$data = array('msg'=>'Successfully Saved!');
		$this->session->set_userdata($data);
		redirect('admin/banner_list',$data);
	}
	function editbanner(){
		$data['banner_content'] = $this->admin_model->getbannercontent();
		$data['form_title'] = 'Update Banner';
		$data['main_content_view'] = 'banner/banner_form';
		$this->load->view('default', $data);
	}
	function deletebanner(){
		$this->admin_model->deletebanner();
		redirect('admin/banner_list');
	}
	function banner_image_upload(){
		$path = UPLOAD_PATH_BANNER;
		$name = $_FILES['banner']['name'];
		$size = $_FILES['banner']['size'];
		$valid_formats = array("jpg", "png", "gif", "jpeg");					
		$data = '';
		if(strlen($name))
		{					
			$ext = strtolower(pathinfo($name, PATHINFO_EXTENSION)); 
			if(in_array($ext,$valid_formats))
			{ 
				if($size<(1024*1024*3))
				{ 
					$old_image 		= 	$path . 'put the old image name';							
					$actual_image_name 	= 	time().$name;  
					$tmp 			= 	$_FILES['banner']['tmp_name'];
					move_uploaded_file($tmp, $path.$actual_image_name);
					$data 			= 	$actual_image_name;
				}
				else{
					echo "Image file size max 3 MB";
				}
			}
			else
			echo "Invalid file format..";	
		}				
		return @$data;	
	}
	function page_list(){
		$data['pages']= $this->admin_model->listPage();
		$data['main_content_view']		= 		'page/page_list';
		$this->load->view('default', $data);
	}
	function page_loadform(){
		$data['all_page'] = $this->admin_model->listPage();
		$data['form_title'] = 'Add New Page';
		$data['main_content_view'] = "page/form";
		$this->load->view('default', $data);
	}
	function slugify($text)
	{ 
	  // replace non letter or digits by -
	  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

	  // trim
	  $text = trim($text, '-');

	  // transliterate
	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	  // lowercase
	  $text = strtolower($text);

	  // remove unwanted characters
	  $text = preg_replace('~[^-\w]+~', '', $text);

	  if (empty($text))
	  {
	    return 'n-a';
	  }

	  return $text;
	}
	function addUpdatePage(){

		$page_id = $this->input->post('page_id');

        $data = array('page_name'           => htmlspecialchars($this->input->post('page_name')),
                      'page_description'    => ($this->input->post('content')),
                      'status'              => $this->input->post('status'),
                      'meta_description'    => htmlspecialchars($this->input->post('meta_description')),
                      'page_title'          => htmlspecialchars($this->input->post('page_title')),
                      'url'          		=> $this->slugify($this->input->post('page_name'))
                    );

		if($page_id != '')
		{
			$this->admin_model->updatePage($data, $page_id);

			$data = array('msg' => 'Page has been updated');

			$this->session->set_userdata($data);

			redirect('admin/page_list', $data);

		}else{

			$this->admin_model->addPage($data);

			$data = array('msg' => 'Page has been added');

			$this->session->set_userdata($data);

			redirect('admin/page_list', $data);
		}
	}

	function deletePage(){
		$page_id			=		$this->uri->segment(3);
		$this->admin_model->deletePage($page_id);
	}
	function editpage(){			
		$data['page_content']					=		$this->admin_model->getPageData();
		$data['form_title'] = 'Edit Page';
		$data['main_content_view']				=		'page/form';
		$this->load->view('default', $data);
	}
	/*
    function earning_lists() {
        $config = array();
        $config["base_url"] = base_url() . "admin/earning_lists/";
        $config["total_rows"] = $this->admin_model->record_previous_month_earn();
        $config["per_page"] = 4000000;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['mess'] = '';
        $data['current_earning'] = $this->admin_model->previous_month_earn($config["per_page"], $page);
        $data['count_earning'] = $config["total_rows"];
        $data["links"] = $this->pagination->create_links();
        $this->load->model('login/Site_setting_model');
        $data['service'] = $this->Site_setting_model->get_site_info(1);
        $data['month'] = date('n'); 
        $data['year'] = date('Y'); 
        $data['main_content_view'] = "earnings/view_balance";
        $this->load->view('default', $data);
    }
	*/
    function earning_detail() {
        $month = $this->uri->segment(3);
        $year = $this->uri->segment(4);
        $owner_id = $this->uri->segment(5);
        $config = array();
        $config["base_url"] = base_url() . "admin/earning_detail/".$month.'/'.$year.'/'.$owner_id;
        $config["total_rows"] = $this->admin_model->record_previous_month_earn_detail();
        $config["per_page"] = 4000000;
        $config["uri_segment"] = 6;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
        $data['mess'] = '';
        $data['current_earning'] = $this->admin_model->previous_month_earn_detail($config["per_page"], $page);
        $data['count_earning'] = $config["total_rows"];
        $data["links"] = $this->pagination->create_links();
        $data['owner_rs'] = $this->admin_model->getUserInfo($this->uri->segment(5));
		$this->load->model('login/Site_setting_model');
        $data['service'] = $this->Site_setting_model->get_site_info(1);
        $data['month'] =  date("F", mktime(0, 0, 0, $month, 10));
        $data['year'] = $year;
        $data['main_content_view'] = "earnings/view_detail";
        $this->load->view('default', $data);
    }
    function pendingBalance() {
        $config = array();
        $config["base_url"] = base_url() . "admin/pendingBalance";
        $config["total_rows"] = $this->admin_model->record_currentMonthEarn();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['mess'] = '';
        $data['pending_balance'] = $this->admin_model->currentMonthEarn($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['main_content_view'] = "earnings/pending_balance";
        $this->load->view('default', $data);
    }
    function earning_filter()
    {
        $config = array();
        $config["base_url"] = base_url() . "admin/earning_filter/";
        $config["total_rows"] = $this->admin_model->record_previous_month_earn_filter();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['mess'] = '';
        $data['current_earning'] = $this->admin_model->previous_month_earn_filter($config["per_page"], $page);
        $data['count_earning'] = $config["total_rows"];
        $data["links"] = $this->pagination->create_links();
		$this->load->model('login/Site_setting_model');
        $data['service'] = $this->Site_setting_model->get_site_info(1);
        $data['month'] = $this->input->post('month');
        $data['year'] = $this->input->post('year');
        $data['main_content_view'] = "earnings/view_balance";
        $this->load->view('default', $data);
    }
    function exportphpexcel()
    {
        $month = $this->uri->segment(3) - 1;
        $year = $this->uri->segment(4);
        $status_array = serialize(array('bb' => 5,'oo' => 5));
        $sql = "select a.*, sum(a.total_price) as sum_price, b.title as prop_name, b.owner_id as bowner_id, c.first_name as fname, c.last_name as lname from tbl_property b inner join tbl_booking a on a.property_id = b.id inner join tbl_users c  on b.owner_id = c.id where a.status = '" . $status_array . "' and month = '" . $month . "' and year = '" . $year . "' group by b.owner_id order by a.requested_date desc";
        $query = $this->db->query($sql); 
		$this->load->model('login/Site_setting_model');
        $service_tax = $this->Site_setting_model->get_site_info(1);
        if(!$query)
        return false;
        $this->load->helper('Excel_helper');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true); 
        $objPHPExcel->getActiveSheet()->setCellValue('A1','OWNER');
        $objPHPExcel->getActiveSheet()->setCellValue('B1','TOTAL');
        $objPHPExcel->getActiveSheet()->setCellValue('C1','SERVICE FEE');
        $objPHPExcel->getActiveSheet()->setCellValue('D1','GRAND TOTAL');
        $query_rs = $query->result();
        $newarrayx1 = array();
        $i = 0;
        $total1 = 0;
        $total2 = 0;
        $total3 = 0;
        foreach($query_rs as $qrs)
        {
            $total = ($service_tax->site_service_tax) * ($qrs->sum_price) / 100;
            $total1 += $qrs->sum_price;
            $total2 += $total;
            $grand_total = ($qrs->sum_price) - ($total);
            $total3 += $grand_total;
            $arr_me = $this->arrayOprn($qrs);
             $arryx = (object) $arr_me;
             array_push($newarrayx1, $arryx);
        $i++;}
        $fields = array('0' => 'Owner', '1' => 'Total', '2' => 'SF', '3' => 'GT');
        $row = 2;
        foreach($newarrayx1 as $data)
        {
            $col = 0;
            foreach ($fields as $field)
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                $col++;
            }
            $row++;
        }
        $one = $col+1;
        $objPHPExcel->getActiveSheet()->setCellValue("A$one" , 'Total');
        $objPHPExcel->getActiveSheet()->setCellValue("B$one" , $total1);
        $objPHPExcel->getActiveSheet()->setCellValue("C$one" , $total2);
        $objPHPExcel->getActiveSheet()->setCellValue("D$one" , $total3);
        $objPHPExcel->setActiveSheetIndex(0);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Invoice_'.date('dMy').'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
    }
	/*
    function chart()
    {
        $data['title'] = "Using JpGraph from CodeIgniter 1.5";
        $data['heading'] = "Example 0 in JpGraph 2.1.4";
        // Setup Chart
        $ydata = array(11,3,8,12,5,1,9,13,5,7); // this should come from the model        
        $graph = $this->jpgraph->linechart($ydata, 'This is a Line Chart');  // add more parameters to plugin function as required
        // File locations
        // Could possibly add to config file if necessary
        $graph_temp_directory = 'temp';  // in the webroot (add directory to .htaccess exclude)
        $graph_file_name = 'test.png';    
        $graph_file_location = $graph_temp_directory . '/' . $graph_file_name;
        @unlink('./temp/test.png');    
        $graph->Stroke('./'.$graph_file_location);  // create the graph and write to file
        $data['graph'] = $graph_file_location;
        $data['main_content_view'] = 'charts/chart_view';
        $this->load->view('default', $data);
    }
	*/
	function settings(){
		$data['settings'] = $this->admin_model->getsetting();
		$data['main_content_view'] = 'setting/setting_page';
		$this->load->view('default', $data);
	}
	function addUpdateSetting(){
		$this->admin_model->addUpdateSetting();
		$data = array('msg'=>'Successfully Saved!');
		$this->session->set_userdata($data);
		redirect('admin/settings',$data);
	}
    function view_all_testi(){
        $data['user_profile_info'] = $this->admin_model->getUserInfo($this->session->userdata('user_id'));
        $config = array();
        $config["base_url"] = base_url() . "admin/view_all_testi";
        $config["total_rows"] = $this->admin_model->record_count_testi();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['testimonials'] =	$this->admin_model->get_all_testi($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['main_content_view'] = 'testimonials/list';
        $this->load->view('default', $data);
    }
    function newTesti() {
        $data['form_title'] = "Add New";
		$data['main_content_view'] = "testimonials/testi_form";
		$this->load->view('default',$data);
	}
    function editTesti()
    {
        $data['form_title'] = "Edit";
        $data['sigle_testi'] = $this->admin_model->edit_testi($this->uri->segment(4));
		$data['main_content_view'] = "testimonials/testi_form";
		$this->load->view('default',$data);
    }
    function addeditTesti() {
        $data['mess'] = '';		
		$testi_id = $this->admin_model->add_edit_testimonials();
        if($testi_id)
        {
            if(($_FILES['image']['error'] != '4') and !empty($_FILES['image']['name']))
            {
                $feature_img = $this->testi_image_upload($testi_id);
            }
            else{
                 $feature_img = $this->input->post('old_image');
            }
            $this->admin_model->update_feature_img_testi($testi_id, $feature_img);
        }
		$data = array('msg'=>'Successfully added!');
		$this->session->set_userdata($data);
		redirect('admin/view_all_testi',$data);	
    }
    function testi_image_upload($inserted_id){
        $testi_feat_img = $this->admin_model->edit_testi($inserted_id);
        if(@$testi_feat_img->image != '')
        {
			unlink('./images/testimonials/'.$testi_feat_img->image);
        }
        $config['overwrite'] = 'TRUE'; 
		$config['upload_path'] = './images/testimonials/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '200000';
        $config['max_width'] = '3000';
        $config['max_height'] = '40000';
        $this->load->library('upload', $config);
        $this->load->library('image_lib');
        if ( ! $this->upload->do_upload('image'))
        {
            $error = array('error' => $this->upload->display_errors());
            $data['errors'] = $error;
            $this->session->set_userdata($data);
            redirect('testimonials/newTesti');
        }
        else
        {
	        $data1 = array('upload_data' => $this->upload->data());
	        $image= $data1['upload_data']['file_name'];
	        $configBig = array();
	        $configBig['image_library'] = 'gd2';
	        $configBig['source_image'] = './images/testimonials/'.$image;
	        $configBig['create_thumb'] = TRUE;
	        $configBig['maintain_ratio'] = TRUE;
	        $configBig['width'] = 95;
	        $configBig['height'] = '1';
	        $configBig['master_dim'] = 'width';
	        $configBig['thumb_marker'] = "_thumb";
	        $configBig['new_image'] = './images/testimonials';
	        $this->image_lib->initialize($configBig);
	        $this->image_lib->resize();
	        $this->image_lib->clear();
	        unset($configBig);
	        $filename2 = $data1['upload_data']['raw_name'].'_thumb'.$data1['upload_data']['file_ext'];
	        $filename3 = $data1['upload_data']['raw_name'].$data1['upload_data']['file_ext'];
	        $rename = time().$inserted_id.$data1['upload_data']['file_ext'];
	        rename('./images/testimonials/' .$filename2, './images/testimonials/' .$rename);
	        unlink('./images/testimonials/' .$filename3);
	        return $rename;
    	}
    }
    function deleteTesti()
    {
        $testi_feat_img = $this->admin_model->edit_testi($this->uri->segment(3));
        if($testi_feat_img->image != '')
        {
            unlink('./images/testimonials/'.$testi_feat_img->image);
        }
        $this->admin_model->delete_testi();
        $data = array('msg'=>'Successfully Deleted!');
        $this->session->set_userdata($data);
        redirect('admin/view_all_testi',$data);
    }
    function subscriber_all(){
        $data['subscribers'] = $this->admin_model->get_all_subscriber();
        $data['main_content_view'] = 'subscriber/list';
        $this->load->view('default', $data);
    }
	
        function list_mail_templates()
        {
            $data['all_templates'] = $this->admin_model->get_all_mail_templates();
            $data['main_content_view'] = "email_templates/templates_list";     
            $this->load->view('default',$data);
        }
        
        function update_forget_mail_template(){
		$this->admin_model->update_forget_mail_template();
		redirect('admin/email_template/forget');
	}
	function forget_mail_template(){
        $data['form_title'] = "Edit forget password mail template";
        $data['content'] = $this->admin_model->edit_forget_mail_template();
		$data['main_content_view'] = "email_templates/forget_mail";
		$this->load->view('default',$data);
	}
	function update_reg_mail_template(){
		$this->admin_model->update_reg_mail_template();
		redirect('admin/email_template/register');
	}
	function reg_confirm_mail_template(){
        $data['form_title'] = "Edit register mail template";
        $data['content'] = $this->admin_model->edit_reg_mail_template();
		$data['main_content_view'] = "email_templates/reg_mail";
		$this->load->view('default',$data);
	}
	function update_activated_mail_template(){
		$this->admin_model->update_activated_mail_template();
		redirect('admin/email_template/activated');
	}
	function activated_mail_template(){
        $data['form_title'] = "Edit account activated mail template";
        $data['content'] = $this->admin_model->edit_activated_mail_template();
		$data['main_content_view'] = "email_templates/activated_mail";
		$this->load->view('default',$data);
	}
	function update_booking_mail_template_to_buyer(){
		$this->admin_model->update_booking_mail_template_to_buyer();
		redirect('admin/email_template/booking_request_to_buyer');
	}
	function booking_mail_template_to_buyer(){
        $data['form_title'] = "Edit booking request mail template to buyer";
        $data['content'] = $this->admin_model->edit_booking_mail_template_to_buyer();
		$data['main_content_view'] = "email_templates/booking_mail_buyer";
		$this->load->view('default',$data);
	}
	function update_booking_mail_template_to_owner(){
		$this->admin_model->update_booking_mail_template_to_owner();
		redirect('admin/email_template/booking_request_to_owner');
	}
	function booking_mail_template_to_owner(){
        $data['form_title'] = "Edit booking request mail template to owner";
        $data['content'] = $this->admin_model->edit_booking_mail_template_to_owner();
		$data['main_content_view'] = "email_templates/booking_mail_owner";
		$this->load->view('default',$data);
	}

	function update_booking_direct_mail_template_to_buyer(){
		$this->admin_model->update_booking_direct_mail_template_to_buyer();
		redirect('admin/email_template/booking_to_buyer');
	}
	function booking_direct_mail_template_to_buyer(){
        $data['form_title'] = "Edit booking mail template to buyer";
        $data['content'] = $this->admin_model->edit_booking_direct_mail_template_to_buyer();
		$data['main_content_view'] = "email_templates/booking_direct_mail_buyer";
		$this->load->view('default',$data);
	}
	function update_booking_direct_mail_template_to_owner(){
		$this->admin_model->update_booking_direct_mail_template_to_owner();
		redirect('admin/email_template/booking_to_owner');
	}
	function booking_direct_mail_template_to_owner(){
        $data['form_title'] = "Edit booking mail template to owner";
        $data['content'] = $this->admin_model->edit_booking_direct_mail_template_to_owner();
		$data['main_content_view'] = "email_templates/booking_direct_mail_owner";
		$this->load->view('default',$data);
	}
        function pre_confirmation_email(){
            $data['form_title'] = "Edit Pre Confirmation Email";
            $data['content'] = $this->admin_model->get_email_template('pre_confirmation_email');
            $data['main_content_view'] = "email_templates/pre_confirmation_email";
            $this->load->view('default',$data);
	}
        function update_pre_confirmation_email(){
            $this->admin_model->update_email_template('pre_confirmation_email');
            redirect('admin/email_template/pre_confirmation_email');
	}
         function post_confirmation_email(){
            $data['form_title'] = "Edit Post Confirmation Email";
            $data['content'] = $this->admin_model->get_email_template('post_confirmation_email');
            $data['main_content_view'] = "email_templates/post_confirmation_email";
            $this->load->view('default',$data);
	}
        function update_post_confirmation_email(){
            $this->admin_model->update_email_template('post_confirmation_email');
            redirect('admin/email_template/post_confirmation_email');
	}
    function subscriber_export()
    {
        $this->admin_model->export_csv();
    }
	
	/* Syarif Hidayat */
	function reports_escapes($param='')
	{		
		$this->load->model('search/search_model');			
		if($param=='filter'){
			$this->session->unset_userdata(array('incomes_filter'=>'','bookings_filter'=>''));
			$filter = '';
			if($this->input->post('country')){$filter['tp.country_id']=$this->input->post('country');}
			if($this->input->post('region_id')){$filter['tp.region_id']=$this->input->post('region_id');}
			if($this->input->post('city_id')){$filter['tp.city_id']=$this->input->post('city_id');}
			if($this->input->post('suburb_id')){$filter['tp.suburb_id']=$this->input->post('suburb_id');}
			if($this->input->post('status')){$filter['admin_action']=$this->input->post('status');}
			
			$where = serialize($filter);
			$this->session->set_userdata('escapes_filter',$where);			
			$where = (unserialize($this->session->userdata('escapes_filter')));			
			
			$data['data_report'] =	$this->admin_model->report_escapes($where);
			$data['ajax'] = true;
			echo $this->load->view('reports/escapes_export',$data, true);
			die;
		}
		if($param=='export_csv'){
			$where = (unserialize($this->session->userdata('escapes_filter')));	
			$data_income =	$this->admin_model->report_escapes($where);
			
			$header = "Report Escapes \r\n\r\n";
			if($data_income){
				$i=1;
				$header .= "No"."\t"."Property Title"."\t"."Owner"."\t"."Added On"."\t"."Status"."\r\n";
				foreach($data_income as $dt){
					$header .= $i++."\t".$dt['title']."\t".$dt['first_name'].' '.$dt['last_name']."\t".$dt['created_date']."\t".$dt['admin_action']."\r\n";
				}
			}
			
			$file = 'reports_escapes.xls';
			header('Content-type: application/vnd.ms-excel'); 
			header('Content-Disposition: attachment; filename='.$file); 
			header('Pragma: no-cache'); 
			header('Expires: 0'); 
			echo $header;	
			die;
		}
		if($param=='export_pdf'){
			$where = (unserialize($this->session->userdata('escapes_filter')));	
			$data['data_report'] =	$this->admin_model->report_escapes($where);
			$html = $this->load->view('reports/escapes_export',$data,true);
			
			$this->load->library('pdf');
			$pdf = $this->pdf->load();
			$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); 
			$pdf->WriteHTML($html); 
			$pdf->Output('reports_escapes.pdf','D'); 
			die;
		}
				
		$data['category'] = $this->admin_model->get_all_category();	
		$data['data_report'] =	$this->admin_model->report_escapes();
		$data['country'] = $this->search_model->getAllCountries();		
		$data['main_content_view']= "reports/escapes";			
		$this->load->view('default',$data);
	}
	function reports_bookings($param='')
	{	
		$this->load->model('search/search_model');		
		if($param=='filter'){
			$this->session->unset_userdata(array('incomes_filter'=>'','escapes_filter'=>''));
			$filter = '';
			if($this->input->post('country')){$filter['tp.country_id']=$this->input->post('country');}
			if($this->input->post('region_id')){$filter['tp.region_id']=$this->input->post('region_id');}
			if($this->input->post('city_id')){$filter['tp.city_id']=$this->input->post('city_id');}
			if($this->input->post('suburb_id')){$filter['tp.suburb_id']=$this->input->post('suburb_id');}
			if($this->input->post('time')){
				if($this->input->post('timetype') == 'daily'){
					$filter['start_date']=date('d/m/y',strtotime($this->input->post('time')));
				} else if ($this->input->post('timetype') == 'weekly'){					
					$thedate = explode('-',$this->input->post('time'));
					$filter['start_date >']=$thedate[0];
					$filter['start_date <']=$thedate[1];
				} else if ($this->input->post('timetype') == 'monthly'){					
					$thedate = explode('/',$this->input->post('time'));
					$filter['YEAR(start_date)']=$thedate[0];
					$filter['MONTH(start_date)']=$thedate[1];
				} else if ($this->input->post('timetype') == 'yearly'){
					$filter['YEAR(start_date)']=$this->input->post('time');
				}
				
			}
			$where = serialize($filter);
			$this->session->set_userdata('bookings_filter',$where);		
			$where = (unserialize($this->session->userdata('bookings_filter')));
			
			$data['data_report'] =	$this->admin_model->report_bookings($where);
			$data['ajax'] = true;
			echo $this->load->view('reports/bookings_export',$data, true);
			die;
		}
		if($param=='export_csv'){
			$where = (unserialize($this->session->userdata('bookings_filter')));	
			$data_income =	$this->admin_model->report_bookings($where);
			
			$header = "Report Bookings \r\n\r\n";
			if($data_income){
				$i=1;
				$header .= "No"."\t"."Property Title"."\t"."Owner"."\t"."Guest Name"."\t"."Check In"."\t"."Check Out"."\t"."Status"."\r\n";
				foreach($data_income as $dt){
					$status = (strtotime($dt['end_date']) < strtotime(date('d/m/y', time())))? 'End Book' : 'Booked';
					$header .= $i++."\t".$dt['title']."\t".$dt['first_name'].' '.$dt['last_name']."\t".$dt['first_gname'].' '.$dt['last_gname']."\t".$dt['start_date']."\t".$dt['end_date']."\t".$status."\r\n";
				}
			}
			
			$file = 'reports_bookings.xls';
			header('Content-type: application/vnd.ms-excel'); 
			header('Content-Disposition: attachment; filename='.$file); 
			header('Pragma: no-cache'); 
			header('Expires: 0'); 
			echo $header;	
			die;
		}
		if($param=='export_pdf'){
			$where = (unserialize($this->session->userdata('bookings_filter')));	
			$data['data_report'] =	$this->admin_model->report_bookings($where);
			$html = $this->load->view('reports/bookings_export',$data,true);
			
			$this->load->library('pdf');
			$pdf = $this->pdf->load();
			$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); 
			$pdf->WriteHTML($html); 
			$pdf->Output('reports_bookings.pdf','D'); 
			die;
		}	
				
		$data['category'] = $this->admin_model->get_all_category();	
		$data['data_report'] =	$this->admin_model->report_bookings();
		$data['country'] = $this->search_model->getAllCountries();
		$data['main_content_view']= "reports/bookings";			
		$this->load->view('default',$data);
	}
	function reports_income($param='')
	{						
		$this->load->model('search/search_model');		
		if($param=='filter'){
			$this->session->unset_userdata(array('escapes_filter'=>'','bookings_filter'=>''));			
			$filter = '';
			if($this->input->post('time')){
				if($this->input->post('timetype') == 'daily'){
					$filter['start_date']=date('d/m/y',strtotime($this->input->post('time')));
				} else if ($this->input->post('timetype') == 'weekly'){					
					$thedate = explode('-',$this->input->post('time'));
					$filter['start_date >']=$thedate[0];
					$filter['start_date <']=$thedate[1];
				} else if ($this->input->post('timetype') == 'monthly'){					
					$thedate = explode('/',$this->input->post('time'));
					$filter['YEAR(start_date)']=$thedate[0];
					$filter['MONTH(start_date)']=$thedate[1];
				} else if ($this->input->post('timetype') == 'yearly'){
					$filter['YEAR(start_date)']=$this->input->post('time');
				}
				
			}
			$where = serialize($filter);
			$this->session->set_userdata('incomes_filter',$where);		 
			$where = (unserialize($this->session->userdata('incomes_filter')));		
			
			$data['data_report'] =	$this->admin_model->report_bookings($where);
			$data['total_income'] =	$this->admin_model->report_income_sum($where);
			$data['ajax'] = true;
			echo $this->load->view('reports/income_export',$data, true);
			die;
		}
		if($param=='export_csv'){
			$where = (unserialize($this->session->userdata('incomes_filter')));	
			$data_income =	$this->admin_model->report_bookings($where);
			$total_income =	$this->admin_model->report_income_sum($where);
			
			$header = "Report Income \r\n\r\n";
			if($data_income){
				$i=1;
				$header .= "Total Income"."\t ".number_format($total_income['total_price'], 2)."\r\n";	
				$header .= "No"."\t"."Property Title"."\t"."Owner"."\t"."Guest Name"."\t"."Check In"."\t"."Check Out"."\t"."Price"."\r\n";
				foreach($data_income as $dt){
					$header .= $i++."\t".$dt['title']."\t".$dt['first_name'].' '.$dt['last_name']."\t".$dt['first_gname'].' '.$dt['last_gname']."\t".$dt['start_date']."\t".$dt['end_date']."\t".number_format($dt['total_price'],2)."\r\n";
				}
			}
			
			$file = 'reports_income.xls';
			header('Content-type: application/vnd.ms-excel'); 
			header('Content-Disposition: attachment; filename='.$file); 
			header('Pragma: no-cache'); 
			header('Expires: 0'); 
			echo $header;	
			die;
		}
		if($param=='export_pdf'){
			$where = (unserialize($this->session->userdata('incomes_filter')));	
			$data['data_report'] =	$this->admin_model->report_bookings($where);
			$data['total_income'] =	$this->admin_model->report_income_sum($where);
			$html = $this->load->view('reports/income_export',$data,true);
			
			$this->load->library('pdf');
			$pdf = $this->pdf->load();
			$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); 
			$pdf->WriteHTML($html); 
			$pdf->Output('reports_income.pdf','D'); 
			die;
		}	
				
		$data['category'] = $this->admin_model->get_all_category();	
		$data['data_report'] =	$this->admin_model->report_bookings();
		$data['total_income'] =	$this->admin_model->report_income_sum();
		$data['country'] = $this->search_model->getAllCountries();
		$data['main_content_view']= "reports/income";					
		$this->load->view('default',$data);
	}
	function ajax_get_region($country_id=0)
	{		
		$this->load->model('ajax/ajax_model');
		$query_data = $this->ajax_model->getRegionAjax($country_id);
		$select = '<select name="region_id" class="form-control" onchange="GetCityByRegion(this.value)">';
		$select .= '<option value="">All Regions</option>';
		if($query_data){
			foreach($query_data as $dt){
				$select .= '<option value="'.$dt->id.'">'.$dt->region_name.'</option>';
			}
		}
		$select .= '</select>';
		echo $select;
	}
	function ajax_get_city($region_id=0)
	{		
		$this->load->model('ajax/ajax_model');
		$query_data = $this->ajax_model->getCityAjax($region_id);
		$select = '<select name="city_id" class="form-control" onchange="GetSuburbBycity(this.value)">';
		$select .= '<option value="">All Cities</option>';
		if($query_data){
			foreach($query_data as $dt){
				$select .= '<option value="'.$dt->id.'">'.$dt->city_name.'</option>';
			}
		}
		$select .= '</select>';
		echo $select;
	}
	function ajax_get_suburb($city_id=0)
	{		
		$this->load->model('ajax/ajax_model');
		$query_data = $this->ajax_model->getSuburbAjax($city_id);
		$select = '<select name="suburb_id" class="form-control">';
		$select .= '<option value="">All Suburbs</option>';
		if($query_data){
			foreach($query_data as $dt){
				$select .= '<option value="'.$dt->id.'">'.$dt->suburb_name.'</option>';
			}
		}
		$select .= '</select>';
		echo $select;
	}
	/**
	 * Function to Delete Category
	 *
	 */
	function deleteCategoryByAdmin(){
		return $this->admin_model->deleteCategoryByAdmin();
	}
	
	/**
	 * Function to Edit Category Name
	 *
	 */
	function updateCategoryName(){
		return $this->admin_model->updateCategoryName();
	}
	/**
	 * Function to Show Property Facilities
	 *
	 */
	
	function propertyFacilities(){
		$data['main_content_view'] = 'property/property_list';
		$this->load->view('default', $data);
	}
	/**
	 * Function to Get Categories
	 *
	 */
	function getAdmincategories(){
			$table	 = "tbl_category";
			$columns = array("category_title","category_description","category_status","id");
			$index 	 = "id";
			$joins 	 = "";
			$search  = "";
			
			if($_POST['add_row'] == 0){
				$where 	 = "category_status != 2 && category_status != '7'";
			}elseif($_POST['add_row'] == 1){
				if($this->admin_model->checkStatus7($table,'category_status') == 1){
					$where 	 = "category_status != 2 ";
				}
			}
			
			echo $this->datatables->generate($table, $columns, $index, $joins, $where, $search);
		}
	/**
	 * Function to PROPERTY Amenities
	 *
	 */
	function getPropertiesAmenities(){
			$table	 = "tbl_amenities";
			$columns = array("name","description","status","id");
			$index 	 = "id";
			$joins 	 = "";
			$search  = "";
			
			if($_POST['add_row'] == 0){
				$where 	 = "status != 2 && status != '7'";
			}elseif($_POST['add_row'] == 1){
				if($this->admin_model->checkStatus7($table,'status') == 1){
					$where 	 = "status != 2 ";
				}
			}
			
			echo $this->datatables->generate($table, $columns, $index, $joins, $where, $search);
	}
	
	/**
	 * Function to UPDATE PROPERTY Amenities
	 *
	 */
	function updateFacilities(){
		return $this->admin_model->updateFacilities();
	}
	/**
	 * Function to Delete Update
	 *
	 */
	function deleteUpdate(){
		return $this->admin_model->deleteUpdate();
	}
	/**
	 * Function to Sky Channels
	 *
	 */
	function skyChannels(){
		$data['tvCategories'] = $this->admin_model->getTvCategories();
		$data['main_content_view'] = 'skyTv/skyTv_list';
		$this->load->view('default', $data);
	}
	/**
	 * Function to GET SKY TV LIST
	 *
	 */
	function getSkyTvList(){

			$table	 = "tbl_sky_channels,tbl_tv_channels";
			$columns = array("tbl_sky_channels.name","tbl_sky_channels.description","tbl_sky_channels.status","tbl_sky_channels.id","tbl_tv_channels.tv_category");
			$index 	 = "tbl_sky_channels.id";
			$joins 	 = "";
			$search  = "";
	
		if($_POST['add_row'] == 0){
			$where 	 = "tbl_sky_channels.status != 2 && tbl_sky_channels.status != '7' AND tbl_tv_channels.id = tbl_sky_channels.television_type ";
		}elseif($_POST['add_row'] == 1){
			if($this->admin_model->checkStatus7('tbl_sky_channels','status') == 1){
			$where 	 = "tbl_sky_channels.status != 2 AND tbl_tv_channels.id = 1 ";
			}
		}
			echo $this->datatables->generate($table, $columns, $index, $joins, $where, $search);
	}
	/**
	 * Function to UPDATE SKY TV LIST
	 *
	 */
	function updateSkyTv(){
		return $this->admin_model->updateSkyTv();
	}
	/**
	 * Function to UPDATE VALUE OF ANY FIELD IN ANY TABLE
	 *
	 */
	function updateStatus(){
		return $this->admin_model->updateStatus();
	}
	
	/**
	 * Function to Insert Facilities
	 *
	 */
	function insertFacilities(){
		return $this->admin_model->insertFacilities();
	}
	/**
	 * Function to Insert Categories
	 *
	 */
	function insertCategory(){
		return $this->admin_model->insertCategory();
	}
	/**
	 * Function to Insert Sky Tv Channels
	 *
	 */
	function insertTvChannel(){
		return $this->admin_model->insertTvChannel();
	}
	/**
	 * Function to List Escape For Images.
	 *
	 */
    function escapeImages(){
		
		$data['main_content_view']= "escape_images/escape_list";
		$this->load->view('default',$data);
	}

    /**
     * It serves the page for send and view coe such sent date and expire date
     *
     * @route: /admin/verification
     */
    public function verification()
    {
        $this->load->model("escapedetails/escapedetails_model");

        $escapeModel            = new Escapedetails_model();
		$config["base_url"]     = base_url() . "admin/verification";
		$config["total_rows"]   = $escapeModel->getPropertyCount();
		$config["per_page"]     = 30;
		$config["uri_segment"]  = 3;

		$this->pagination->initialize($config);
		$page                       = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['mess']               = '';
		$data['all_property']       =	$this->admin_model->listProperty($config["per_page"], $page);
		$data['property_count']     = $config["total_rows"];
		$data["links"]              = $this->pagination->create_links();
		$data['main_content_view']  = "escape/verification_escape_list";

		$this->load->view('default',$data);
    }

    /**
     * It serves the page for send and view coe such sent date and expire date
     *
     * @route: /admin/sendVerificationCode
     */
    public function sendVerificationCode()
    {
        $escapeId = $this->input->post('escape_id');

        if(empty($escapeId)) {
            echo json_encode(array('status' => false));

        } else {
            $this->load->model("escapedetails/escapedetails_model");

            $escapeModel  = new Escapedetails_model();
            $today        = new DateTime();
            $afterTwoYear = clone $today;
            $afterTwoYear = $afterTwoYear->Modify("+2 year");


            $escapeModel->update($escapeId, array("send_date"   => $today->format("Y-m-d"),
                                                  "expire_date" => $afterTwoYear->format("Y-m-d")));


            echo json_encode(array('status' => true));
        }
    }

    /**
     * It serves ajax call for view code
     *
     * @route: /admin/viewVerificationCode
     */
    public function viewVerificationCode()
    {
         $escapeId = $this->input->post('escape_id');

        if(empty($escapeId)) {
            echo json_encode(array('status' => false));
        } else {
            $this->load->model("escapedetails/escapedetails_model");

            $escapeModel  = new Escapedetails_model();
            $escape       = $escapeModel->findById($escapeId);
            echo json_encode($escape);
        }

    }

	/**
	 * Function to get Escape List for Images
	 *
	 */
	function getEscapeList(){
			$table	 = "tbl_property,tbl_users";
			$columns = array("tbl_property.id","tbl_property.title","tbl_property.owner_id","tbl_property.property_status","tbl_users.first_name","tbl_users.last_name","tbl_property.admin_action");
			$index 	 = "tbl_property.id";
			$joins 	 = "";
			$search  = "";
			$where = "tbl_property.owner_id = tbl_users.id";
			
			
			echo $this->datatables->generate($table, $columns, $index, $joins, $where, $search);
	}
	/**
	 * Function to get Escape Images
	 *
	 */
	function getEscapeImages($escape_id){
		$this->csstyles->add(base_url() . 'assets/backend/js/fancybox/jquery.fancybox.css?v=2.1.5');
		$this->javascripts->add(base_url() . 'assets/backend/js/fancybox/jquery.fancybox.js?v=2.1.5'); 
		$data['javascriptsArray']	 = $this->javascripts->get();
		$data['csstyles']			 = $this->csstyles->get();
		$data['escape_id']			= $escape_id;
		$data['base_url']			= base_url();
		$data['imagesArray']	    = $this->admin_model->getEscapeImages($escape_id);
		
		$data['main_content_view']  = "escape_images/gallery";
		$this->load->view('default',$data);

	}
	/**
	 * Function to Add Images To Escape Galleries.
	 *
	 */
	function addEscapeImages($escape_id){
 		$this->csstyles->add(base_url() . 'assets/backend/js/dropzone/css/dropzone.css');
		$this->javascripts->add(base_url() . 'assets/backend/js/dropzone/dropzone.js'); 
		$data['javascriptsArray']	 = $this->javascripts->get();
		$data['csstyles']			 = $this->csstyles->get();
		
		$data['base_url']			= base_url();
		$data['escape_id']			= $escape_id;
		
		$data['main_content_view']  = "escape_images/add_images";
		$this->load->view('default',$data);
	}
	/**
	 * Function to Upload Images To Escape Galleries.
	 *
	 */
	function uploadEscapeImages(){
		$escape_id	 = $_REQUEST['escape_id'];
		$fileType	 = explode("/", $_FILES["file"]["type"]);
		$time		 = time();
		$imagefile	 = $_FILES["file"]["tmp_name"];
		$imageName	 = rand()."_".$time . "." . $fileType[1];
		
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

		$escape_id = $_POST['escape_id'];
		$this->admin_model->uploadEscapeImages($escape_id,$imageName);	
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
	 * Function to Delete Escape Images.
	 *
	 */
	function deleteEscapeImages($escape_id,$image_name){
	//	echo $escape_id;
	//	echo $image_name;
		$result =  $this->admin_model->deleteEscapeImages($escape_id,$image_name);

		if($result == 1){
			unlink("images/property_img/gallery/$image_name");
			unlink("images/property_img/gallery/thumb/$image_name");
			unlink("images/property_img/gallery/medium/$image_name");

			redirect(base_url().'admin/getEscapeImages/'.$escape_id);
		}
	}
	
	/**
	 * Function to SHOW FORM TO ADD TV CATEGORIES.
	 *
	 */
	function tvCategory(){
		$data['main_content_view'] = 'skyTv/tv_channel_form';
		$this->load->view('default', $data);
	}
	/**
	 * Function TO ADD TV CATEGORIES.
	 *
	 */
	function addTvCategory(){
	//	print_r($_POST); die;
		$result = $this->admin_model->addTvCategory();	
		if($result == 1){
			redirect(base_url().'admin/categories/escapes/skychannels');
		}
	}
}

