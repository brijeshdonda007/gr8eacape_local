<?php
class Users extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('image_lib');
        $this->load->helper('form');
		$this->load->model('users_model');
		$this->load->database();
	}
	function lists(){
        $config = array();
        $config["base_url"] = base_url() . "users/lists/";
        $config["total_rows"] = $this->users_model->record_count_all_users();
        $config["per_page"] = 30;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['all_users']		=	$this->users_model->all_users($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['total_count'] = $config["total_rows"];
		$data['main_content_view']		=		'users/lists';
		$this->load->view('default', $data);
	}
	function adduser(){
		$data['form_title'] = 'Add User';
		$data['country'] = $this->users_model->getCountry();
		$data['usergroup'] = $this->users_model->all_groups();
		$data['main_content_view'] = 'users/add';
		$this->load->view('default', $data);
	}
	function newuser(){
		$user_id = $this->users_model->addUser();
		$image_name = '';
		if(!empty($_FILES['profile_picture']['name'])){
			$image_name = $this->image_upload($user_id);
		}
		if ($image_name != '')
			$this->users_model->add_userImage($user_id, $image_name);
		$data = array('msg'=>'Successfully Saved!');
		redirect('users/lists',$data);
	}
	function editUser(){
		$data['user'] = $this->users_model->getUserInfo($this->uri->segment(3));
		$data['usergroup'] = $this->users_model->all_groups();
		$data['country'] = $this->users_model->getCountry();
		$data['form_title'] = 'Edit User';
		$data['main_content_view'] = 'users/edit';
		$this->load->view('default', $data);
	}
	function deleteUser(){
		$this->users_model->deleteUser();
		$data = array('msg' => 'Successfully Deleted!');
		redirect('users/lists', $data);
	}
	function addeditUser(){
		$image_name = '';
		if(!empty($_FILES['profile_picture']['name'])){
			$image_name = $this->image_upload($this->input->post('userid'));
		}
		$this->users_model->addeditUser($image_name);
		$data = array('msg'=>'Successfully Saved!');
		redirect('users/lists',$data);
	}
    function image_upload($user_id){
	    $data['user_profile_info'] = $this->users_model->getUserInfo($user_id);
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
}
