<?php

class Register_model extends CI_Model
{
    /**
     *Initialization
     */
    public function __construct()
	{
		parent::__construct();
		$this->load->helper('yurl');
	}

    /**
     * Generate random string
     *
     * @param string $length
     * @return string
     */
    public function genRandomString($length='')
    {
		if ($length=='') {
			$length = 20;
		}

		$characters = '12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ12345CARTN6789ABCDEFGHIJKMNPQRSTUVWXYZ';
		$string     = '';

		for ($p = 0; $p < $length; $p++)
        {
			$string .= $characters[mt_rand(0, strlen($characters))];
		}

		return $string;
	}

    /**
     * Save new user, generate activation code and return the activation code
     *
     * @param $business
     * @return string
     */
    public function newMember($business)
    {
		$activation_code = $this->genRandomString('12');
		$password        = $this->input->post('password');
		$pwd             = hash('sha256',$password);
        $accountNumber    = $this->getLatestAccountNumber();

		$data = array('first_name'          => $this->input->post('first_name'),
	                  'last_name'           => $this->input->post('last_name'),
	                  'email'               => $this->input->post('email'),
	                  'username'            => $this->input->post('username'),
	                  'password' 		    => $pwd,
	                  'phone' 		        =>	$this->input->post('phone'),
	                  'mobile'		        => $this->input->post('mobile'),
	                  'dob'                 => '0',
	                  'gender'		        => '0',
	                  'street_no' 		    => '',
	                  'street_name' 		=> '',
	                  'avenue' 		        => '0',
	                  'suburb' 	        	=>	'',
	                  'city'                =>	'',
	                  'country_title'       => '0',
	                  'country_id' 		    => '0',
	                  'city_id' 		    => '0',
	                  'post_code' 		    => 	'',
	                  'activation_code'     => $activation_code,
	                  'user_status'         => '0',
	                  'user_type'           => $this->input->post('user_type'),
	                  'user_created_date'   => date("Y-m-d H:i:s"),
	                  'profile_picture'     => '',
		              'is_business'         => $business,
		              'gst_num'             => $this->input->post('gst_number'),
		              'company_name'        => $this->input->post('company'),
                      'account_number'      => $accountNumber
                    );

		$this->db->insert('tbl_users', $data);
		return $activation_code;
	}

	public function image_upload($last_insert_id)
    {
		$config['overwrite'] = 'TRUE'; 
		$config['upload_path'] = './images/profile_img/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '200000';
		$config['max_width'] = '3000';
		$config['max_height'] = '40000';
		$this->load->library('upload', $config);
		$this->load->library('image_lib');
		if ( ! $this->upload->do_upload('profile_img'))
		{
			$error = array('error' => $this->upload->display_errors());
			$data['errors'] = $error;
			$data['main_client_view']			=		"register/register";
			$this->load->view('index', $data);
		}
		else
		{
			//                    print_r($_FILES);exit();
			$data1 = array('upload_data' => $this->upload->data());
			$image= $data1['upload_data']['file_name'];
			$configBig = array();
			$configBig['image_library'] = 'gd2';
			$configBig['source_image'] = './images/profile_img/'.$image;
			$configBig['create_thumb'] = TRUE;
			$configBig['maintain_ratio'] = TRUE;
			$configBig['width'] = 100;
			//                $configBig['height'] = 84;
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
			//                $configBig['height'] = 45;
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
			//                $configBig['height'] = 201;
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
			$rename = 'profile_'.$last_insert_id.$data1['upload_data']['file_ext'];
			rename('./images/profile_img/medium/' .$filename1, './images/profile_img/medium/' .$rename);
			rename('./images/profile_img/thumb/' .$filename2, './images/profile_img/thumb/' .$rename);
			rename('./images/profile_img/large/' .$filename3, './images/profile_img/large/' .$rename);
			unlink('./images/profile_img/'.$image);
			return $rename;
		}
	}

    function incrypt($pwd)
	{
		$temp="greatescapes";
		$a=md5(sha1($temp.$pwd));
		return $a;
	}
    function get_aleady_registered_username()
	{
		$this->db->where('username',$this->input->post('username'));
		$query = $this->db->get('tbl_users');
		if($query->num_rows()>0)
			return TRUE;
		else return NULL;
	}
	function get_aleady_registered_email()
	{
		$this->db->where('email',$this->input->post('email'));
		$query = $this->db->get('tbl_users');
		if($query->num_rows()>0)
			return TRUE;
		else return NULL;
	}

	function activated($activation_code, $from_email)
	{
		$this->db->where('activation_code',ydecode(udecode($activation_code),$this->config->item('encoder')));
		$query = $this->db->get('tbl_users');
		if($query->num_rows()>0)
		{
			$activation_code=ydecode(udecode($activation_code),$this->config->item('encoder'))	;
			$sql="select username,first_name,email,id FROM tbl_users WHERE activation_code='$activation_code'";		
			$query = $this->db->query($sql);
			$d= $query->row_array();
			$user_id=$d['id'];
			$data=array('user_status'=>'1','activation_code'=>$this->genRandomString('12'));
			$this->db->where('id',$user_id);
			$this->db->update('tbl_users',$data);
			return true;
		}
	}

    /**
     * Generate nre account number
     *
     * @return mixed
     */
    public function getLatestAccountNumber()
    {
        $this->db->select('MAX(account_number) as max');
        $this->db->from('tbl_users');

        return $this->db->get()->row()->max + 1;
    }
}
