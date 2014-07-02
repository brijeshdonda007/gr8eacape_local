<?php
/**
* Account Controller
*
* @category Controller
* @author Eftakhairul Islam <eftakhairul@gmail.com> (http://eftakhairul.com)
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Account extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('accesscontrol');
        Accesscontrol_helper::is_logged_in_front();
        $this->earnings = Accesscontrol_helper::get_earnings();
        $this->load->model('user_model');
        $this->load->model('location_model');
        $this->load->model('pdf_model');
        $this->load->model('message_model');
        $this->load->library('form_validation');
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

    /**
     * Show me the banking and billing information
     */
    public function billing()
    {
        if ($this->session->userdata('Fb_user')) {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        $data['unread_notifications'] = $this->user_model->getUnreadNotifications($this->session->userdata('user_id'));

        if ($this->session->userdata('user_id')) {
            $config                         = array();
            $config["base_url"]             = base_url() . "user/accountinfo";
            $this->pagination->initialize($config);
            $data['page_title']             = 'Company Information';
            $this->load->model('login/Site_setting_model');
            $data['settings']               = $this->Site_setting_model->get_site_info(1);
            $this->load->model('login/Site_setting_model');
            $data['settings']               = $this->Site_setting_model->get_site_info(1);
            $data['header_menus']           = $this->Site_setting_model->get_header_menu();
            $data['footer_menus']           = $this->Site_setting_model->get_footer_menu();
            $data['footer_bottom_menus']    = $this->Site_setting_model->get_footer_bottom_menu();
            $data['user_profile_info']      = $this->user_model->getUserInfo($this->session->userdata('user_id'));

            $user_profile_info = $this->user_model->getUserInfo($this->session->userdata('user_id'));

            $accountName  = $user_profile_info->accountName;
            $payeeBank    = $user_profile_info->payeeBank;
            $payeeBranch  = $user_profile_info->payeeBranch;
            $payeeAccount = $user_profile_info->payeeAccount;
            $payeeSuffix  = $user_profile_info->payeeSuffix;

            $data['accountName']  = set_value('accountName') == false ? $accountName : set_value('accountName');
            $data['payeeBank']    = set_value('payeeBank') == false ? $payeeBank : set_value('payeeBank');
            $data['payeeBranch']  = set_value('payeeBranch') == false ? $payeeBranch : set_value('payeeBranch');
            $data['payeeAccount'] = set_value('payeeAccount') == false ? $payeeAccount : set_value('payeeAccount');
            $data['payeeSuffix']  = set_value('payeeSuffix') == false ? $payeeSuffix : set_value('payeeSuffix');

            $data['main_client_view']  = 'user/user-dashboard';
            $data['dashboard_content'] = 'user/pages/billing';

            $this->load->view('user', $data);
        } else {
            redirect('login/index');
        }
    }

    public function company()
    {
        if ($this->session->userdata('Fb_user')) {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        $data['unread_notifications'] = $this->user_model->getUnreadNotifications($this->session->userdata('user_id'));

        if ($this->session->userdata('user_id')) {
            $config                         = array();
            $config["base_url"]             = base_url() . "user/accountinfo";
            $this->pagination->initialize($config);
            $data['page_title']             = 'Company Information';
            $this->load->model('login/Site_setting_model');
            $data['settings']               = $this->Site_setting_model->get_site_info(1);
            $this->load->model('login/Site_setting_model');
            $data['settings']               = $this->Site_setting_model->get_site_info(1);
            $data['header_menus']           = $this->Site_setting_model->get_header_menu();
            $data['footer_menus']           = $this->Site_setting_model->get_footer_menu();
            $data['footer_bottom_menus']    = $this->Site_setting_model->get_footer_bottom_menu();
            $data['user_profile_info']      = $this->user_model->getUserInfo($this->session->userdata('user_id'));
            $data['main_client_view']       = 'user/user-dashboard';
            $data['dashboard_content']      = 'user/pages/account';

            $this->load->view('user', $data);
        } else {
            redirect('login/index');
        }

    }

    public function saveBillingInformation()
    {
        if ($this->session->userdata('user_id')) {

            $this->form_validation->set_rules('accountName', 'Account Name', 'required');
            $this->form_validation->set_rules('payeeBank', 'Payee Bank', 'required');
            $this->form_validation->set_rules('payeeBranch', 'Payee Branch', 'required');
            $this->form_validation->set_rules('payeeAccount', 'Payee Account', 'required');
            $this->form_validation->set_rules('payeeSuffix', 'Payee Suffix', 'required');

            if ($this->form_validation->run() == FALSE) {
                $config                         = array();
                $config["base_url"]             = base_url() . "user/accountinfo";
                $this->pagination->initialize($config);
                $data['page_title']             = 'Company Information';
                $this->load->model('login/Site_setting_model');
                $data['settings']               = $this->Site_setting_model->get_site_info(1);
                $this->load->model('login/Site_setting_model');
                $data['settings']               = $this->Site_setting_model->get_site_info(1);
                $data['header_menus']           = $this->Site_setting_model->get_header_menu();
                $data['footer_menus']           = $this->Site_setting_model->get_footer_menu();
                $data['footer_bottom_menus']    = $this->Site_setting_model->get_footer_bottom_menu();
                $data['user_profile_info']      = $this->user_model->getUserInfo($this->session->userdata('user_id'));
            } else {
                $data       = $_POST;
                $data['id'] = $this->session->userdata('user_id');
                $this->user_model->updateUserData($data);
                $this->session->set_flashdata('success_msg', 'Billing information is updated Successfully.');
                redirect('user/account/billing');

            }
        } else {
            redirect('login/index');
        }
    }

    public function saveCompanyInformation()
    {
        if ($this->session->userdata('user_id')) {
            $data       = $_POST;
            $data['id'] = $this->session->userdata('user_id');
            $this->user_model->updateUserData($data);
            $this->session->set_flashdata('success_msg', 'Company information is updated Successfully.');
            redirect('user/account/company');

        } else {
            redirect('login/index');
        }

    }
}