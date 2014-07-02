<?php

class Login extends CI_Controller{

    public function __construct(){

        parent::__construct();

        $this->load->model('login_model');

        $this->load->library('form_validation');

    }



    function index(){

        if($this->session->userdata('user_id') != ''){

            redirect('user/index');

        }

        $data['main_client_view']			=		"login/login";

        $data['page_title']                             =               'Login';

        $this->load->view('index', $data);

    }



    function logincheck(){

        $this->form_validation->set_rules('username','Username','trim|required|xss_clean');

        $this->form_validation->set_rules('password','Password','trim|required|min_length[6]|xss_clean');

        if (!$this->form_validation->run())

        {

            $data = array('login_msg'=>'Please Enter your Username and Password!');

            $this->session->set_userdata($data);

            redirect('login/login',$data);

        }

        else{

            if($this->login_model->logincheck($this->input->post('username'),$this->input->post('password')) == true)

            {

                $result = $this->login_model->fetch_details($this->input->post('username'),$this->input->post('password'));

                if($result->user_status == '1')

                {

                $array_user = array('user_id' => $result->id, 'user_type' => @$result->user_type, 'username' => $this->input->post('username'));

                $type= $result->user_type;

                

                $this->session->set_userdata($array_user);

                

                $bookingr_data = $this->session->userdata('bookingr_data');

                if($bookingr_data['urlx'])

                {

                    redirect($bookingr_data['urlx']);

                }

                else {

                redirect('user');

                }

                }

                else

                {

                    $data = array('login_msg'=>'Please Activate Your Account First!');

                    $this->session->set_userdata($data);

                    redirect('login/login', $data);

                }

            }

            else

            {

            $data = array('login_msg'=>'Incorrect Username or Password!');

            $this->session->set_userdata($data);

            redirect('login/login', $data);

            

            }

        }

    }

    

   

}