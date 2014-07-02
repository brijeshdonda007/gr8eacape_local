<?php 

/* -----------------------------------------------------------------------------------------

   IdiotMinds - http://idiotminds.com

   -----------------------------------------------------------------------------------------

*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');



//include the facebook.php from libraries directory

require_once APPPATH.'libraries/facebook/facebook.php';

class Login extends CI_Controller
{
    /**
     * Initializing
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->library('form_validation');
        $this->load->model('Site_setting_model');
        $this->config->load('facebook');
        $this->load->helper('html');
    }

    /**
     * Server the login page
     *
     * @route /login/login
     */
    public function index()
    {
        if($this->session->userdata('user_id') != ''){
            redirect('user/index');
        }

        $data['main_client_view'] = "login/login";
		$this->load->model('login/Site_setting_model');
		$data['settings'] = $this->Site_setting_model->get_site_info(1);
		$data['header_menus'] = $this->Site_setting_model->get_header_menu();
		$data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
		$data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();
        $data['page_title'] = 'Login';
        $this->load->view('index', $data);
    }


    /**
     * Serve the login post request
     *
     * @route /login/logincheck
     */
    public function logincheck()
    {
        $this->form_validation->set_rules('username','Username','trim|required|xss_clean');
        $this->form_validation->set_rules('password','Password','trim|required|min_length[6]|xss_clean');

        if (!$this->form_validation->run()) {

            $data = array('login_msg'=>'Please Enter your Username and Password!');
            $this->session->set_userdata($data);
            redirect('login/login',$data);

        } else {

            if ($this->login_model->logincheck($this->input->post('username'),$this->input->post('password')) == true) {

                $result = $this->login_model->fetch_details($this->input->post('username'),$this->input->post('password'));

                if($result->user_status == '1') {
                	$this->login_model->update_login_time($result->id);
                    $array_user = array('user_id' => $result->id, 'user_type' => @$result->user_type, 'username' => $this->input->post('username'));
                    $type= $result->user_type;
                    $this->session->set_userdata($array_user);
                    $bookingr_data = $this->session->userdata('bookingr_data');

                    if ($bookingr_data['urlx']) {
					    $this->session->set_userdata('booking_redirect','1');
                        redirect($bookingr_data['urlx']);
                    } else {
                        $this->load->model('user/user_model');
                        if((int)$result->user_type == User_model::GUEST) redirect('guest');
                        if((int)$result->user_type == User_model::OWNER) redirect('owner');
                	    redirect('user');
                    }

                } else {

					$code = uencode(yencode($result->activation_code, $this->config->item('encoder')));
					$url = site_url('register/activation_process/'.$code);
                    $data = array('login_msg'=>'Please Activate Your Account First!', 'active_url' => $url);
                    $this->session->set_userdata($data);
                    redirect('login/login', $data);
                }
            } else {

                $data = array('login_msg'=>'Incorrect Username or Password!');
                $this->session->set_userdata($data);
                redirect('login/login', $data);
            }
        }
    }

    /**
     * Serve fb login
     *
     * @route /login/fblogin
     */
    public function fblogin()
    {
		//get the Facebook appId and app secret from facebook.php which located in config directory for the creating the object for Facebook class
                $facebook = new Facebook(array(
		'appId'		=>  $this->config->item('appID'), 
		'secret'	=> $this->config->item('appSecret'),
		));
		$user = $facebook->getUser(); // Get the facebook user id 
		if($user){
			try{
				$user_profile = $facebook->api('/me');  //Get the facebook user profile data
                                if($user_profile['gender'] == 'male')
                                {
                                    $gender = 1;
                                }
                                else
                                {
                                   $gender = 0; 
                                }
                                $result = $this->login_model->fetch_details_fb($user_profile['email']);
                                if(count($result) < 1)
                                {
                                $data = array('email' => $user_profile['email'], 
                                    'first_name' => $user_profile['first_name'],
                                    'last_name' => $user_profile['last_name'],
                                    'facebook_id' => $user_profile['id'], 
                                    'user_status' => 1, 
                                    'user_type' => 1,
                                    'gender' => $gender, 'user_created_date' => date("Y-m-d H:i:s"));
                                $this->db->insert('tbl_users', $data);
                                $last_insert_id = $this->db->insert_id();
                                $array_user = array('user_id' => $last_insert_id, 'facebook_id' => $user_profile['id'], 'Fb_user'=>$user_profile,
				   );
                                $this->session->set_userdata($array_user);
                                }
                                else
                                {
                                $array_user = array('user_id' => $result->id, 'facebook_id' => $user_profile['id'], 'Fb_user' => $user_profile,
				   );
                                $this->session->set_userdata($array_user);
                                }
                                $bookingr_data = $this->session->userdata('bookingr_data');
                                if($bookingr_data['urlx'])
                                {
                                    redirect($bookingr_data['urlx']);
                                }
                                else {
                                    redirect('user');
                                }
			}catch(FacebookApiException $e){
				error_log($e);
				$user = NULL;
			}
		}
	}
}
