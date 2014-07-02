<?php
/**
* User controller
*
* @category Controller
* @author Eftakhairul Islam <eftakhairul@gmail.com> (http://eftakhairul.com)
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH .'modules/user/controllers/UserbaseController.php';
class User extends UserbaseController
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('pdf_model');
        $this->load->model('message_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<label class="error">', '</label>');
        $this->load->helper('form');
        $this->load->helper(array('dompdf', 'file'));
        $this->load->helper('csv_helper');
        $this->load->helper('directory_helper');
        $this->load->helper('Excel_helper');
        $this->load->helper('date');
    }

    public function index()
    {
        if($this->session->userdata('user_id') == FALSE){redirect('/login/index/','refresh');}
        $data['user_profile_info'] = $this->user_model->getUserInfo($this->session->userdata('user_id'));
        $data['user_country'] = $this->location_model->Country_user($data['user_profile_info']->country_id);
        $data['city'] = $this->location_model->getCityByID($data['user_profile_info']->city_id);
        $data['booking_requests'] = $this->user_model->getAllBokingRequest($data['user_profile_info']->id);
        $data['booking_requests_buyer'] = $this->user_model->getAllBokingRequestBuyer($data['user_profile_info']->id);
        $data['latest_escapes'] = $this->user_model->getAlllatestLists($data['user_profile_info']->id);
        $data['confirmed_booking'] = $this->user_model->getAllConfirmedBooking($data['user_profile_info']->id);
        $data['unread_notifications'] = $this->user_model->getUnreadNotifications($data['user_profile_info']->id);
        $data['inbox_unread_items'] = $this->message_model->getAllMessageUnreadByUser($this->session->userdata('user_id'));
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }

        if($data['user_profile_info']->user_type == 2)
        {
            $data['user_ratings'] = $this->user_ratings();
        }

        if($data['user_profile_info']->user_type == 1)
        {
            $data['rating_category'] = $this->user_model->get_user_ratings_category();
            $data['ratings_cat'] = $this->user_model->getAllRateCategory();
            $data['all_rates'] = $this->user_model->getTotalRate();
            $data['total_count'] = count($data['all_rates']);
        }

        $data['total_reviews'] = $this->user_model->geAllReviews($this->session->userdata('user_id'));
        $data['main_client_view']           =   'user/user-dashboard';
        $data['dashboard_content']          =   'user-main-content';
        $data['page_title']                 =   'Dashboard';

        $this->commonSetting();
        $this->load->view('user', $data);
    }

    public function editProfile()
    {
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        if(($this->input->post('edit_ptofile')==''))
        {
            $data['user_profile_info'] = $this->user_model->getUserInfo($this->session->userdata('user_id'));
            $data['country_user'] = $this->location_model->Country_user($data['user_profile_info']->country_id);
            $data['main_client_view']           =   'user/user-dashboard';
            $data['dashboard_content']          =   'user-main-content-edit';
            $data['countries_users'] = $this->location_model->getAllCountries_users();
            $data['unread_notifications'] = $this->user_model->getUnreadNotifications($data['user_profile_info']->id);
            $data['page_title'] = 'Edit Profile';
            $this->load->model('login/Site_setting_model');
            $data['settings'] = $this->Site_setting_model->get_site_info(1);
            $data['header_menus'] = $this->Site_setting_model->get_header_menu();
            $data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
            $data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();
            $this->load->view('user', $data);
        } else {

            if(($_FILES['profile_picture']['error'] != '4') and !empty($_FILES['profile_picture']['name'])) {
                $rename = $this->image_upload($this->session->userdata('user_id'));
            } else {
                $rename = $this->input->post('old_profile_picture');
            }

            $this->user_model->editProfileDetails($rename);

            if($this->uri->segment(3) == 'tolist')
            {
                $this->user_model->updateUserType($this->session->userdata('user_id'));
                $data = array('msg_upgraded'=>'Congratulations! Your account has been upgraded to list an Escape.');
                $this->session->set_userdata($data);
                redirect('user/addescape', $data);
            }
            else{
                $data = array('msg'=>'Your profile details has been updated successfully!');
                $this->session->set_userdata($data);
                redirect('user/index', $data);
            }
        }
    }

    public function image_upload($user_id)
    {
        $data['user_profile_info'] = $this->user_model->getUserInfo($this->session->userdata('user_id'));
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
            $rename = 'profile_'.$user_id.$data1['upload_data']['file_ext'];
            rename('./images/profile_img/medium/' .$filename1, './images/profile_img/medium/' .$rename);
            rename('./images/profile_img/thumb/' .$filename2, './images/profile_img/thumb/' .$rename);
            rename('./images/profile_img/large/' .$filename3, './images/profile_img/large/' .$rename);
            //unlink('./images/profile_img/'.$image);
            return $rename;
        }
    }

    public function certificate_upload($property_id)
    {
        if ($property_id != ''){
            $data['property_info'] = $this->user_model->getPropertyInfobyID($property_id);
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

    public function changePassword()
    {
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        $data['unread_notifications'] = $this->user_model->getUnreadNotifications($this->session->userdata('user_id'));
        if($this->session->userdata('user_type') == '2')
        {
            $data['user_profile_info'] = $this->user_model->getUserInfo($this->session->userdata('user_id'));
            $data['country'] = $this->location_model->Country($data['user_profile_info']->country_id);
            $data['main_client_view']           =   'user/user-dashboard';
            $data['dashboard_content']          =   'change-password';
            $data['page_title'] = 'Change Password';
            $this->load->model('login/Site_setting_model');
            $data['settings'] = $this->Site_setting_model->get_site_info(1);
            $data['header_menus'] = $this->Site_setting_model->get_header_menu();
            $data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
            $data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();
            $this->load->view('user', $data);
        }
        else
        {
            $data['user_profile_info'] = $this->user_model->getUserInfo($this->session->userdata('user_id'));
            $data['country'] = $this->location_model->Country($data['user_profile_info']->country_id);
            $data['page_title'] = 'Change Password';
            $data['main_client_view']           =   'user/user-dashboard';
            $data['dashboard_content']          =   'change-password';
            $this->load->model('login/Site_setting_model');
            $data['settings'] = $this->Site_setting_model->get_site_info(1);
            $data['header_menus'] = $this->Site_setting_model->get_header_menu();
            $data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
            $data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();
            $this->load->view('user', $data);
        }
    }

    public function changePasswordProcess()
    {
        $this->form_validation->set_rules('password', "Password",'callback_password_check');
        if($this->form_validation->run()==FALSE)
        {
            $data = array('profile_edit_msg'=>'Username And password Can Not Be Same!');
            $this->session->set_userdata($data);
            redirect('user/changePassword');
        }
        else{
            $this->user_model->changePasswordProcess($this->session->userdata('user_id'));
            $this->session->sess_destroy();
            $data = array('pwd_changemsg'=>'Your password has been changed. Please login with your new Password!');
            $this->session->set_userdata($data);
            $data['main_client_view']			=		"login/login";
            $data['page_title']                             =               'Login';
            $this->load->view('user', $data);
        }
    }

    public function password_check()
    {
        $userdetail = $this->user_model->getUserInfo($this->session->userdata('user_id'));
        $username = $userdetail->username;
        if($this->input->post('password')==$username)
        {
            $this->form_validation->set_message('password_check', 'Username And password Can Not Be Same.');
            return false;
        }
        return true;
    }

    public function escapeList()
    {
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        $data['unread_notifications'] = $this->user_model->getUnreadNotifications($this->session->userdata('user_id'));
        if(($this->session->userdata('user_id')))
        {
            $config = array();
            $config["base_url"] = base_url() . "user/escapeList";
            $config["total_rows"] = $this->user_model->record_all_Property($this->session->userdata('user_id'));
            $config["per_page"] = 100;
            $config["uri_segment"] = 3;
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data['user_profile_info'] = $this->user_model->getUserInfo($this->session->userdata('user_id'));
            $data['country'] = $this->location_model->Country($data['user_profile_info']->country_id);
            $data['city'] = $this->location_model->getCityByID($data['user_profile_info']->city_id);
            $data['all_properties'] = $this->user_model->getAllProperty($config["per_page"], $page);
            $data["links"] = $this->pagination->create_links();
            $data['unread_notifications'] = $this->user_model->getUnreadNotifications($data['user_profile_info']->id);
            $data['list_property_view']           =   'user/escape_list';
            $data['page_title'] = 'Escape List';
            $this->load->model('login/Site_setting_model');
            $data['settings'] = $this->Site_setting_model->get_site_info(1);
            $this->load->model('login/Site_setting_model');
            $data['settings'] = $this->Site_setting_model->get_site_info(1);
            $data['header_menus'] = $this->Site_setting_model->get_header_menu();
            $data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
            $data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();
            $this->load->view('list_property', $data);
        }
        else {
            redirect('login/index');
        }
    }

    public function accountInformation()
    {
        if ($this->session->userdata('Fb_user')) {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        $data['unread_notifications'] = $this->user_model->getUnreadNotifications($this->session->userdata('user_id'));

        if ($this->session->userdata('user_id')) {
            $config             = array();
            $config["base_url"] = base_url() . "user/accountinfo";
            $this->pagination->initialize($config);
            $data['page_title'] = 'Company Information';
            $this->load->model('login/Site_setting_model');
            $data['settings']          = $this->Site_setting_model->get_site_info(1);
            $this->load->model('login/Site_setting_model');
            $data['settings'] = $this->Site_setting_model->get_site_info(1);
            $data['header_menus'] = $this->Site_setting_model->get_header_menu();
            $data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
            $data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();
            $data['user_profile_info'] = $this->user_model->getUserInfo($this->session->userdata('user_id'));

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
            $data['dashboard_content'] = 'user/pages/accountInformation';

            $this->load->view('user', $data);

            if ($this->uri->segment(3) == 'save') {

                $this->form_validation->set_rules('accountName', 'Account Name', 'required');
                $this->form_validation->set_rules('payeeBank', 'Payee Bank', 'required');
                $this->form_validation->set_rules('payeeBranch', 'Payee Branch', 'required');
                $this->form_validation->set_rules('payeeAccount', 'Payee Account', 'required');
                $this->form_validation->set_rules('payeeSuffix', 'Payee Suffix', 'required');

                if ($this->form_validation->run() == FALSE) {

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
                    $data['dashboard_content'] = 'user/pages/accountInformation';

                } else {

                    if ($this->input->post('gst_reg')) {
                        $gst_reg = 1;
                    } else {
                        $gst_reg = 0;
                    }

                    $id = $this->session->userdata('user_id');

                    $insertData = array(

                        'company_name' => $this->input->post('company_name'),
                        'gst_reg' => $gst_reg,
                        'gst_num' => $this->input->post('gst_num'),
                        'accountName' => $this->input->post('accountName'),
                        'payeeBank' => $this->input->post('payeeBank'),
                        'payeeBranch' => $this->input->post('payeeBranch'),
                        'payeeAccount' => $this->input->post('payeeAccount'),
                        'payeeSuffix' => $this->input->post('payeeSuffix')
                    );

                    $this->user_model->accountInformationInsert($insertData, $id);

                    $data = array(
                        'msg' => 'Your company information has been updated successfully!'
                    );
                    $this->session->set_userdata($data);

                    redirect('user/accountInformation');
                } //ValEnd
            } //URICheck
        } // Session
    }

    public function addescape()
    {
        $this->csstyles->add(base_url() . 'assets/backend/js/dropzone/css/dropzone.css');
        $this->javascripts->add(base_url() . 'assets/backend/js/dropzone/dropzone.js');
        $this->javascripts->add(base_url() . 'assets/backend/js/ajaxfileupload.js');
        $data['javascriptsArray']	 = $this->javascripts->get();
        $data['csstyles']			 = $this->csstyles->get();
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        if($this->uri->segment(3) || $this->input->post('property_id') != '')
        {
            if ($this->uri->segment(3))
                $property_code = $this->uri->segment(3);
            else
                $property_code = $this->input->post('property_code');

            $data['property_info'] = $this->user_model->getPropertyInfobyCode($property_code);

            $data['amenities_detail'] = $this->user_model->getAmenitiesByID($data['property_info']->id);
            $data['gallery_images'] = $this->user_model->getAllGalleriesByID($data['property_info']->id);
            $data['extra_property'] = $this->user_model->getAllExtraProp($data['property_info']->id);
            $data['cities'] = $this->location_model->getCityByRegion($data['property_info']->region_id);
            $data['region'] = $this->location_model->getRegionByCountry($data['property_info']->country_id);
            $data['suburbs'] = $this->location_model->getSuburbCity($data['property_info']->city_id);
            $data['prop_cats'] = $this->user_model->get_property_category($data['property_info']->id);
            $data['prop_sky_channel'] = $this->user_model->get_property_sky_channel($data['property_info']->id);
            $data['prop_ames'] = $this->user_model->get_property_amenity($data['property_info']->id);
            $data['city_name'] = $this->user_model->get_city_name($data['property_info']->id);
        }
        $data['user_profile_info'] = $this->user_model->getUserInfo($this->session->userdata('user_id'));
        $data['countries'] = $this->location_model->getAllCountries();
        $data['categories'] = $this->user_model->getAllCategories();
        $data['skyChannel'] = $this->user_model->getAllSkyChannels();
        $data['amenities'] = $this->user_model->getAllAmenities();
        $data['escapes'] = $this->user_model->getAllEscapes();
        $data['calendar'] = $this->display($year = null, $month = null);
        $data['page_title'] = 'Add Escape';
        $data['add_property']   =   'user/add_property';
        $this->load->model('login/Site_setting_model');
        $data['settings'] = $this->Site_setting_model->get_site_info(1);
        $data['header_menus'] = $this->Site_setting_model->get_header_menu();
        $data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
        $data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();

        //$this->load->view('add_propertyx', $data);
        $this->load->view('new_add_propertyx', $data);
    }


    public function addeditescape()
    {
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        $property_id = $this->user_model->addEditEscape();
        if($property_id)
        {
            if(($_FILES['featured_image']['error'] != '4') and !empty($_FILES['featured_image']['name']))
            {
                $feature_img = $this->feature_image_upload($property_id);
            }
            else{
                $feature_img = $this->input->post('old_featured_image');
            }
            $gallery_img = $this->upload_array_files($property_id);
            $this->user_model->update_feature_img($property_id, $feature_img);
            $this->user_model->galleryImageUpload($property_id, $gallery_img);
            $this->user_model->propertyExtraInfo($property_id);
            $this->user_model->property_category($property_id);
            $this->user_model->propertySkyChannel($property_id);
        }
        $data['msg'] = "This property will be visible for all after admin approval.";
        $this->session->set_userdata($data);
        redirect('user/escapelist',$data);
    }

    public function addeditescape_general()
    {
        if($this->session->userdata('Fb_user')) {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }

        $ret = $this->user_model->addEditEscape_general();
        $temp = explode('|', $ret);
        $property_id = $temp[0];
        if($property_id)
        {
            if(($_FILES['featured_image']['error'] != '4') and !empty($_FILES['featured_image']['name']))
            {
                $feature_img = $this->feature_image_upload($property_id);
            }
            else{
                $feature_img = $this->input->post('old_featured_image');
            }
            $this->user_model->update_feature_img($property_id, $feature_img);
            $this->user_model->property_category($property_id);
            $this->user_model->propertySkyChannel($property_id);
        }
        $data['msg'] = "This escape will be visible for all after admin approval.";
        $this->session->set_userdata($data);
        redirect('user/addescape/'.$temp[1] , $data);
    }

    public function addeditescape_details()
    {
        $this->csstyles->add(base_url() . 'assets/backend/js/dropzone/css/dropzone.css');
        $this->javascripts->add(base_url() . 'assets/backend/js/dropzone/dropzone.js');
        $data['javascriptsArray']	 = $this->javascripts->get();
        $data['csstyles']			 = $this->csstyles->get();

        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }

        if(isset($_FILES['certificate']) and ($_FILES['certificate']['error'] != '4') and !empty($_FILES['certificate']['name'])) {
            if (@$this->input->post('property_id'))
                $rename = $this->certificate_upload($this->input->post('property_id'));
            else
                $rename = $this->certificate_upload('');
        }
        else
        {
            $rename = $this->input->post('old_certificate');
        }

        $ret = $this->user_model->update_property_details($rename);
        $temp = explode('|', $ret);
        $data['user_profile_info'] = $this->user_model->getUserInfo($this->session->userdata('user_id'));
        $data['msg'] = "This escape will be visible for all after admin approval.";
        $this->session->set_userdata($data);
        $data['owner'] = $this->user_model->getUserInfo($this->session->userdata('user_id'));
        $data['escape_name'] = $this->input->post('title');
        $data['private_code'] = $temp[1];
        $data['page_title'] = 'Add Escape';
        if(isset($_POST['property_id']) && !empty($_POST['property_id'])) {

            $data['add_property']           =   'user/add_edit_thanks';
        } else {
            $data['add_property']           =   'user/add_thanks';
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

        $this->load->view('add_propertyx', $data);

        //redirect('user/addescape/'.$property_id , $data);
    }
    public function addeditescape_terms()
    {
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        $ret = $this->user_model->addEditEscape_terms();
        $temp = explode('|', $ret);
        $property_id = $temp[0];
        $data['msg'] = "This escape will be visible for all after admin approval.";
        $this->session->set_userdata($data);
        redirect('user/addescape/'.$temp[1] , $data);
    }

    public function addeditescape_gallery()
    {
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        $gallery_img = $this->upload_array_files($this->input->post('property_id'));
        $this->user_model->galleryImageUpload('', $gallery_img);
        $data['msg'] = "This escape will be visible for all after admin approval.";
        $this->session->set_userdata($data);
        redirect('user/addescape/' . $this->input->post('private_code') , $data);
    }

    public function addeditescape_video()
    {
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        //$gallery_video = $this->upload_array_videos($this->input->post('property_id'));
        $this->user_model->galleryVideoUpload('');
        $data['msg'] = "This escape will be visible for all after admin approval.";
        $this->session->set_userdata($data);
        redirect('user/addescape/' . $this->input->post('private_code') , $data);
    }

    public function addeditescape_location()
    {
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        $ret = $this->user_model->addEditEscape_location();
        $temp = explode('|', $ret);
        $property_id = $temp[0];
        $data['msg'] = "This escape will be visible for all after admin approval.";
        $this->session->set_userdata($data);
        redirect('user/addescape/'.$temp[1] , $data);
    }

    public function addeditescape_detail()
    {
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        $ret = $this->user_model->addEditEscape_detail();
        $temp = explode('|', $ret);
        $property_id = $temp[0];
        $data['msg'] = "This escape will be visible for all after admin approval.";
        $this->session->set_userdata($data);
        redirect('user/addescape/'.$temp[1] , $data);
    }

    public function display($year = null, $month = null)
    {
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

    public function feature_image_upload($inserted_id)
    {
        $property_feat_img = $this->user_model->getPropertyInfobyID($inserted_id);
        if(@$property_feat_img->featured_image != '')
        {
            unlink('./images/property_img/featured/medium/'.$property_feat_img->featured_image);
            unlink('./images/property_img/featured/thumb/'.$property_feat_img->featured_image);
            unlink('./images/property_img/featured/'.$property_feat_img->featured_image);
        }
        $config['overwrite'] = 'TRUE';
        $config['upload_path'] = './images/property_img/featured/';
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
            redirect('user/addescape');
        }
        else
        {
            $data1 = array('upload_data' => $this->upload->data());
            $image= $data1['upload_data']['file_name'];
            $configBig = array();
            $configBig['image_library'] = 'gd2';
            $configBig['source_image'] = './images/property_img/featured/'.$image;
            $configBig['create_thumb'] = TRUE;
            $configBig['maintain_ratio'] = TRUE;
            $configBig['width'] = 705;
            $configBig['height'] = '1';
            $configBig['master_dim'] = 'width';
            $configBig['thumb_marker'] = "_big";
            $configBig['new_image'] = './images/property_img/featured/medium';
            $this->image_lib->initialize($configBig);
            $this->image_lib->resize();
            $this->image_lib->clear();
            unset($configBig);
            $configBig = array();
            $configBig['image_library'] = 'gd2';
            $configBig['source_image'] = './images/property_img/featured/'.$image;
            $configBig['create_thumb'] = TRUE;
            $configBig['maintain_ratio'] = FALSE;
            $configBig['width'] = 202;
            $configBig['height'] = 137;
            $configBig['thumb_marker'] = "_thumb";
            $configBig['new_image'] = './images/property_img/featured/thumb';
            $this->image_lib->initialize($configBig);
            $this->image_lib->resize();
            $this->image_lib->clear();
            unset($configBig);
            $filename1 = $data1['upload_data']['raw_name'].'_big'.$data1['upload_data']['file_ext'];
            $filename2 = $data1['upload_data']['raw_name'].'_thumb'.$data1['upload_data']['file_ext'];
            $filename3 = $data1['upload_data']['raw_name'].$data1['upload_data']['file_ext'];
            $rename = time().$inserted_id.$data1['upload_data']['file_ext'];
            rename('./images/property_img/featured/medium/' .$filename1, './images/property_img/featured/medium/' .$rename);
            rename('./images/property_img/featured/thumb/' .$filename2, './images/property_img/featured/thumb/' .$rename);
            rename('./images/property_img/featured/' .$filename3, './images/property_img/featured/' .$rename);
            return $rename;
        }
    }

    public function upload_array_files($inserted_id)
    {
        $this->load->library('upload');
        $upload_conf = array(
            'upload_path'   => './images/property_img/gallery/',
            'allowed_types' => 'gif|jpg|png',
            'max_size'      => '30000',
        );
        $this->upload->initialize( $upload_conf );
        // Change $_FILES to new vars and loop them
        foreach($_FILES['property_image'] as $key=>$val)
        {
            $i = 1;
            foreach($val as $v)
            {
                $field_name = "file_".$i;
                $_FILES[$field_name][$key] = $v;
                $i++;
            }
        }
        // Unset the useless one ;)
        unset($_FILES['property_image']);
        // Put each errors and upload data to an array
        $error = array();
        $success = array();
        // main action to upload each file
        $i=1;
        $j=1;
        $items = array();
        foreach($_FILES as $field_name => $file)
        {
            if($field_name != 'featured_image')
            {
                if ( ! $this->upload->do_upload($field_name))
                {
                    // if upload fail, grab error
                    $error['upload'][] = $this->upload->display_errors();
                }
                else
                {
                    $data1 = $this->upload->data();
                    $image= $data1['file_name'];
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
                    $configBig['maintain_ratio'] = TRUE;
                    $configBig['width'] = 202;
                    $configBig['height'] = 137;
                    $configBig['thumb_marker'] = "_thumb";
                    $configBig['new_image'] = './images/property_img/gallery/thumb';
                    $this->image_lib->initialize($configBig);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                    unset($configBig);
                    $filename1 = $data1['raw_name'].'_big'.$data1['file_ext'];
                    $filename2 = $data1['raw_name'].'_thumb'.$data1['file_ext'];
                    $filename3 = $data1['raw_name'].$data1['file_ext'];
                    $rename = time().$i.'_'.$inserted_id.$data1['file_ext'];
                    rename('./images/property_img/gallery/medium/' .$filename1, './images/property_img/gallery/medium/' .$rename);
                    rename('./images/property_img/gallery/thumb/' .$filename2, './images/property_img/gallery/thumb/' .$rename);
                    rename('./images/property_img/gallery/' .$filename3, './images/property_img/gallery/' .$rename);
                    $items[] = $rename;
                }
                $i++; }
        }
        // see what we get
        if(count($error > 0))
        {
            $data['error'] = $error;
        }
        else
        {
            $data['success'] = $upload_data;
        }
        return $items;
    }

    public function upload_array_videos($inserted_id)
    {
        $this->load->library('upload');
        $upload_conf = array(
            'upload_path'   => './images/videos/',
            'allowed_types' => 'mp4|avi|flv',
            'max_size'      => '3000000'
        );
        $this->upload->initialize( $upload_conf );
        // Change $_FILES to new vars and loop them
        // Unset the useless one ;)
        //unset($_FILES['property_video']);
        // Put each errors and upload data to an array
        $error = array();
        $success = array();
        // main action to upload each file
        $i=1;
        $j=1;
        $items = array();
        if (! $this->upload->do_upload('property_video')){
            $error['upload'][] = $this->upload->display_errors();
        } else {
            $data1 = $this->upload->data();
            $items[] = $data1['file_name'];
        }
        // see what we get
        if(count($error > 0))
        {
            $data['error'] = $error;
        }
        else
        {
            $data['success'] = $upload_data;
        }
        return $items;
    }

    public function escapeDetails($code)
    {
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        $data['user_profile_info'] = $this->user_model->getUserInfo($this->session->userdata('user_id'));
        $data['general_info_ID'] = $this->user_model->getPropertyInfobyCode($code);
        $data['unread_notifications'] = $this->user_model->getUnreadNotifications($this->session->userdata('user_id'));
        $data['country'] = $this->location_model->Country($data['user_profile_info']->country_id);
        $data['city'] = $this->location_model->getCityByID($data['user_profile_info']->city_id);
        $data['cities'] = $this->location_model->getCityByCountry($data['general_info_ID']->country_id);
        $data['countries'] = $this->location_model->getAllCountries();
        $data['categories'] = $this->user_model->getAllCategories();
        $data['skyChannel'] = $this->user_model->getAllSkyChannels();
        $data['list_property_view']           =   'user/escape_detail';
        $this->load->view('list_property', $data);
    }

    public function editgeneralInfo()
    {
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        $this->user_model->editgeneralInfo();
        if(($_FILES['featured_image']['error'] != '4') and !empty($_FILES['featured_image']['name'])){
            $rename = $this->feature_image_upload($this->input->post('prop_id'));
        }
        else{
            $rename = $this->input->post('old_featured_image');
        }
        $this->user_model->update_feature_img($rename, $this->input->post('prop_id'));
        redirect('user/amenities/'.$this->input->post('private_code'));
    }

    public function amenities(){
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        $data['user_profile_info'] = $this->user_model->getUserInfo($this->session->userdata('user_id'));
        $data['general_info_ID'] = $this->user_model->getPropertyInfobyCode($this->uri->segment('3'));
        $data['prop_amenities'] = $this->user_model->getAmenitiesbyCode($data['general_info_ID']->id);
        $data['list_property_view']           =   'user/amenities';
        $this->load->view('list_property', $data);
    }

    public function addEditamenities()
    {
        $this->user_model->addEditamenities();
        redirect('user/locationMap/'.$this->input->post('private_code'));
    }

    public function locationMap()
    {
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        $data['user_profile_info'] = $this->user_model->getUserInfo($this->session->userdata('user_id'));
        $data['general_info_ID'] = $this->user_model->getPropertyInfobyCode($this->uri->segment('3'));
        $data['location_maps'] = $this->user_model->getAmenitiesbyCode($data['general_info_ID']->id);
        $data['list_property_view']           =   'user/location_map';
        $this->load->view('list_property', $data);
    }

    public function addEditLocation()
    {
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        $this->user_model->addEditamenities();
        redirect('user/locationMap/'.$this->input->post('private_code'));
    }

    public function allbookings()
    {
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        $data['user_profile_info'] = $this->user_model->getUserInfo($this->session->userdata('user_id'));
        $data['unread_notifications'] = $this->user_model->getUnreadNotifications($this->session->userdata('user_id'));
        $data['country'] = $this->location_model->Country($data['user_profile_info']->country_id);
        $data['city'] = $this->location_model->getCityByID($data['user_profile_info']->city_id);
        $config = array();
        $config["base_url"] = base_url() . "user/allbookings";
        $config["total_rows"] = $this->user_model->record_all_bookingR($data['user_profile_info']->id);
        $config["per_page"] = 5;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['booking_requests'] = $this->user_model->getAllBokingRequestView($data['user_profile_info']->id, $config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['main_client_view']           =   'user/user-dashboard';
        $data['dashboard_content']          =    'user-main-content';
        $data['list_property_view']           =   'user/allbooking-lists';
        $data['page_title'] = 'All bookings';
        $this->load->model('login/Site_setting_model');
        $data['settings'] = $this->Site_setting_model->get_site_info(1);

        $this->load->view('list_property', $data);
        //$this->load->view('user', $data);
    }

    public function confirmedBookings()
    {
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        $data['user_profile_info'] = $this->user_model->getUserInfo($this->session->userdata('user_id'));
        $data['unread_notifications'] = $this->user_model->getUnreadNotifications($this->session->userdata('user_id'));
        $data['country'] = $this->location_model->Country($data['user_profile_info']->country_id);
        $data['city'] = $this->location_model->getCityByID($data['user_profile_info']->city_id);
        $config = array();
        $config["base_url"] = base_url() . "user/confirmedBookings";
        $config["total_rows"] = $this->user_model->record_all_cbookingR($data['user_profile_info']->id);
        $config["per_page"] = 5;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['booking_requests'] = $this->user_model->getAllcBokingRequestView($data['user_profile_info']->id, $config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $this->load->model('login/Site_setting_model');
        $data['settings'] = $this->Site_setting_model->get_site_info(1);
        $data['page_title'] = 'All confirmed Bookings';

        $data['main_client_view']           =   'user/user-dashboard';
        $data['dashboard_content']          =    'user-main-content';
        $data['list_property_view']           =   'user/allconfirmed-lists';
        $this->load->view('list_property', $data);
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('home');
    }

    public function fblogout()
    {
        $this->session->sess_destroy();
        redirect('home');
    }

    public function stopResume($code)
    {
        $this->user_model->stopResume($code);
        $ref = $this->input->server('HTTP_REFERER', TRUE);
        redirect($ref);
    }

    public function bookingRequests()
    {
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        $data['user_profile_info'] = $this->user_model->getUserInfo($this->session->userdata('user_id'));
        $data['unread_notifications'] = $this->user_model->getUnreadNotifications($this->session->userdata('user_id'));
        $data['country'] = $this->location_model->Country($data['user_profile_info']->country_id);
        $data['city'] = $this->location_model->getCityByID($data['user_profile_info']->city_id);
        $config = array();
        $config["base_url"] = base_url() . "user/allrequestBuyer";
        $config["total_rows"] = $this->user_model->record_all_bookingRB($data['user_profile_info']->id);
        $config["per_page"] = 5;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['booking_requests_buyer'] = $this->user_model->getAllrequestBuyer($data['user_profile_info']->id, $config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['main_client_view'] = 'user/user-dashboard';
        $data['dashboard_content'] = 'user-main-content';
        $data['list_property_view'] = 'user/booking-requests-b-all';
        $this->load->model('login/Site_setting_model');
        $data['settings'] = $this->Site_setting_model->get_site_info(1);
        $data['header_menus'] = $this->Site_setting_model->get_header_menu();
        $data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
        $data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();
        $data['page_title'] = 'My Bookings';
        $this->load->view('list_property', $data);
    }

    public function cancelBookingByBuyer($id)
    {
        $this->user_model->cancelBookingByBuyer($id);
        $ref = $this->input->server('HTTP_REFERER', TRUE);
        $data = array('msg'=>'You have canceled this request!');
        $this->session->set_userdata($data);
        redirect($ref, $data);
    }

    public function cancelBookingByOwner($id)
    {
        $this->user_model->cancelBookingByOwner($id);
        $ref = $this->input->server('HTTP_REFERER', TRUE);
        $data = array('msg'=>'You have declined this request!');
        $this->session->set_userdata($data);
        redirect($ref, $data);
    }

    public function confirmBookingByOwner($id)
    {
        $this->user_model->confirmBookingByOwner($id);
        $ref = $this->input->server('HTTP_REFERER', TRUE);
        $data = array('msg'=>'You have confirmed this request!');
        $this->session->set_userdata($data);
        redirect($ref, $data);
    }

    public function deleteBookingBuyera($id)
    {
        $this->user_model->deleteBookingBuyera($id);
        $data = array('msg'=>'You have deleted this request!');
        $this->session->set_userdata($data);
        redirect('user/allrequestBuyer', $data);
    }

    public function deleteBookingBuyer($id)
    {
        $this->user_model->deleteBookingBuyer($id);
        $ref = $this->input->server('HTTP_REFERER', TRUE);
        $data = array('msg'=>'You have deleted this request!');
        $this->session->set_userdata($data);
        redirect($ref, $data);
    }

    public function deleteBookingOwner($id)
    {
        $this->user_model->deleteBookingOwner($id);
        $ref = $this->input->server('HTTP_REFERER', TRUE);
        $data = array('msg'=>'You have deleted this request!');
        $this->session->set_userdata($data);
        redirect($ref, $data);
    }

    public function notifications()
    {
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        $data['user_profile_info'] = $this->user_model->getUserInfo($this->session->userdata('user_id'));
        $data['country'] = $this->location_model->Country($data['user_profile_info']->country_id);
        $data['city'] = $this->location_model->getCityByID($data['user_profile_info']->city_id);
        $data['all_notifications'] = $this->user_model->getAllNotifications($data['user_profile_info']->id);
        $data['unread_notifications'] = $this->user_model->getUnreadNotifications($data['user_profile_info']->id);
        $data['main_client_view']           =   'user/user-dashboard';
        $data['dashboard_content']          =    'user-main-content';
        $data['list_property_view']           =   'user/notifications';
        $data['page_title'] = 'Notifications';
        $this->load->model('login/Site_setting_model');
        $data['settings'] = $this->Site_setting_model->get_site_info(1);
        $data['header_menus'] = $this->Site_setting_model->get_header_menu();
        $data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
        $data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();

        $this->load->view('list_property', $data);
        //$this->load->view('user', $data);
    }
    function notifdetails(){
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        $data['user_profile_info'] = $this->user_model->getUserInfo($this->session->userdata('user_id'));
        $data['country'] = $this->location_model->Country($data['user_profile_info']->country_id);
        $data['city'] = $this->location_model->getCityByID($data['user_profile_info']->city_id);
        $data['notef_det'] = $this->user_model->getNotif($this->uri->segment(3));
        $data['unread_notifications'] = $this->user_model->getUnreadNotifications($data['user_profile_info']->id);
        $this->user_model->updateNotif($this->uri->segment(3));
        $data['main_client_view']           =   'user/user-dashboard';
        $data['dashboard_content']          =    'user-main-content';
        $data['list_property_view']           =   'user/notifications-det';
        $this->load->model('login/Site_setting_model');
        $data['settings'] = $this->Site_setting_model->get_site_info(1);
        $data['header_menus'] = $this->Site_setting_model->get_header_menu();
        $data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
        $data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();
        $data['page_title'] = 'Notification';
        $this->load->view('list_property', $data);
        $this->load->view('user', $data);
    }
    function deleteNotif()
    {
        $id = $this->uri->segment(3);
        $this->user_model->deleteNotif($id);
        $ref = $this->input->server('HTTP_REFERER', TRUE);
        $data = array('msg'=>'Notification successfully deleted');
        $this->session->set_userdata($data);
        redirect($ref, $data);
    }
    function currentBalance()
    {
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        $data['user_profile_info'] = $this->user_model->getUserInfo($this->session->userdata('user_id'));
        $data['unread_notifications'] = $this->user_model->getUnreadNotifications($data['user_profile_info']->id);
        $data['country'] = $this->location_model->Country($data['user_profile_info']->country_id);
        $data['city'] = $this->location_model->getCityByID($data['user_profile_info']->city_id);
        $data['previous_earn_records'] = $this->user_model->getPreviousMnthRecords($data['user_profile_info']->id);
        $data['previous_earn'] = $this->user_model->getPreviousMonthEarn($data['user_profile_info']->id);
        $data['main_client_view']           =   'user/user-dashboard';
        $data['dashboard_content']          =    'user-main-content';
        $data['list_property_view']           =   'user/previous-month-balance';
        $this->load->view('list_property', $data);
    }
    function pendingBalance()
    {
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        $data['user_profile_info'] = $this->user_model->getUserInfo($this->session->userdata('user_id'));
        $data['unread_notifications'] = $this->user_model->getUnreadNotifications($data['user_profile_info']->id);
        $data['country'] = $this->location_model->Country($data['user_profile_info']->country_id);
        $data['city'] = $this->location_model->getCityByID($data['user_profile_info']->city_id);
        $data['pending_balance'] = $this->user_model->getPendingBalance($data['user_profile_info']->id);
        $data['pending_balance_all'] = $this->user_model->getPendingBalanceAll($data['user_profile_info']->id);
        $data['main_client_view']           =   'user/user-dashboard';
        $data['dashboard_content']          =    'user-main-content';
        $data['list_property_view']           =   'user/current-balance-pending';
        $this->load->view('list_property', $data);
    }
    function allPendingTransCurrMnth()
    {
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        $data['user_profile_info'] = $this->user_model->getUserInfo($this->session->userdata('user_id'));
        $data['unread_notifications'] = $this->user_model->getUnreadNotifications($data['user_profile_info']->id);
        $data['country'] = $this->location_model->Country($data['user_profile_info']->country_id);
        $data['city'] = $this->location_model->getCityByID($data['user_profile_info']->city_id);
        $data['pending_balance'] = $this->user_model->getPendingBalanceD($data['user_profile_info']->id);
        $data['pending_balance_all'] = $this->user_model->getPendingBalanceAllD($data['user_profile_info']->id);
        if($this->input->post('month') == "")
        {
            $data['month'] = date('m');
        }
        else
        {
            $data['month'] = $this->input->post('month');
        }
        $data['main_client_view']           =   'user/user-dashboard';
        $data['dashboard_content']          =    'user-main-content';
        $data['list_property_view']           =   'user/current-balance-pending-all';
        $data['page_title'] = 'Pending Transactions';
        $this->load->model('login/Site_setting_model');
        $data['settings'] = $this->Site_setting_model->get_site_info(1);
        $data['header_menus'] = $this->Site_setting_model->get_header_menu();
        $data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
        $data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();

        $this->load->view('list_property', $data);
    }
    function allTransCurrMnth()
    {
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        $data['user_profile_info'] = $this->user_model->getUserInfo($this->session->userdata('user_id'));
        $data['unread_notifications'] = $this->user_model->getUnreadNotifications($data['user_profile_info']->id);
        $data['country'] = $this->location_model->Country($data['user_profile_info']->country_id);
        $data['city'] = $this->location_model->getCityByID($data['user_profile_info']->city_id);
        $data['prev_mnth_trnsx'] = $this->user_model->prevMnthTranx($data['user_profile_info']->id);
        $data['prev_balance'] = $this->user_model->getPrevMonthEarn($data['user_profile_info']->id);
        if($this->input->post('month') == "")
        {
            $data['month'] = date('m') - 1;
        }
        else
        {
            $data['month'] = $this->input->post('month');
        }
        $data['main_client_view']           =   'user/user-dashboard';
        $data['dashboard_content']          =    'user-main-content';
        $data['list_property_view']           =   'user/all-prev-balance';
        $data['page_title'] = 'All Transactions';
        $this->load->model('login/Site_setting_model');
        $data['settings'] = $this->Site_setting_model->get_site_info(1);
        $data['header_menus'] = $this->Site_setting_model->get_header_menu();
        $data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
        $data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();

        $this->load->view('list_property', $data);
    }
    function getPendingBalanceAll()
    {
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        $data['user_profile_info'] = $this->user_model->getUserInfo($this->session->userdata('user_id'));
        $data['unread_notifications'] = $this->user_model->getUnreadNotifications($data['user_profile_info']->id);
        $data['country'] = $this->location_model->Country($data['user_profile_info']->country_id);
        $data['city'] = $this->location_model->getCityByID($data['user_profile_info']->city_id);
        $data['curr_mnth_trnsx'] = $this->user_model->currMnthTranx($data['user_profile_info']->id);
        $data['current_balance'] = $this->user_model->getCurrentMonthEarn($data['user_profile_info']->id);
        $data['main_client_view']           =   'user/user-dashboard';
        $data['dashboard_content']          =    'user-main-content';
        $data['list_property_view']           =   'user/current-balance';
        $this->load->view('list_property', $data);
    }

    public function exportcsv($month)
    {
        $results = $this->user_model->downloadCsvByMonth($month);
        $plname = "Tnx";
        $csv_output="Property Name, Guest, Check In, Check Out, Booked Days, Total Price";
        $csv_output .= "\n";
        foreach ($results as $br)
        {
            $date = new DateTime($br->end_date);
            $date->modify('+1 day');
            $end_date = $date->format('Y-m-d');
            $usrx = $this->user_model->getUserInfo($br->user_id);
            $csv_output .= $br->prop_name.",";
            $csv_output .= $usrx->first_name.' '.$usrx->last_name.",";
            $csv_output .= $br->start_date.",";
            $csv_output .= $end_date.",";
            $csv_output .= $br->booked_days.",";
            $csv_output .= $br->total_price.",";
            $csv_output .= "\n";
        }
        $filename = $plname."_".date("d-m-Y_H-i",time());
        header("Content-type: application/vnd.ms-excel");
        header("Content-disposition: csv" . date("Y-m-d") . ".csv");
        header("Content-disposition: filename=".$filename.".csv");
        print $csv_output;
        exit;
    }
    function exportphpexcel($month)
    {
        $user_id = $this->session->userdata('user_id');
        $year = date("Y");
        $status_array = serialize(array('bb' => 5,'oo' => 5));
        $sql = "select a.*, b.title as Title, a.start_date as SD, a.end_date as ED,
		a.requested_date as RD, a.booked_days as BD, a.total_price as TP, a.no_of_guests as NG,
		a.transactionID as TID from tbl_property b inner join tbl_booking a
		on a.property_id = b.id inner join tbl_users c 
		on b.owner_id = c.id where c.id = " . $user_id . " and a.status = '" . $status_array . "' and month = '".$month."' and year = '".$year."' group by a.id order by a.requested_date desc";
        $query = $this->db->query($sql);
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
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getStyle('A1:L1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->setCellValue('A1','POPERTY NAME');
        $objPHPExcel->getActiveSheet()->setCellValue('B1','GUEST NAME');
        $objPHPExcel->getActiveSheet()->setCellValue('C1','CHECK IN DATE');
        $objPHPExcel->getActiveSheet()->setCellValue('D1','CHECK OUT DATE');
        $objPHPExcel->getActiveSheet()->setCellValue('E1','REQUESTED DATE');
        $objPHPExcel->getActiveSheet()->setCellValue('F1','DAYS');
        $objPHPExcel->getActiveSheet()->setCellValue('G1','TOTAL PRICE');
        $objPHPExcel->getActiveSheet()->setCellValue('H1','NO. OF GUESTS');
        $objPHPExcel->getActiveSheet()->setCellValue('I1','TRANSACTION ID');
        $query_rs = $query->result();
        $newarrayx1 = array();
        $i = 0;
        foreach($query_rs as $qrs)
        {
            $arr_me = $this->arrayOprn($qrs);
            $arryx = (object) $arr_me;
            array_push($newarrayx1, $arryx);
            $i++;}
        $fields = array('0' => 'Title', '1' => 'GuestName', '2' => 'SD', '3' => 'ED', '4' => 'RD',
            '5' => 'BD', '6' => 'TP', '7' => 'NG', '8' => 'TID');
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
        $objPHPExcel->setActiveSheetIndex(0);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Invoice_'.date('dMy').'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
    }
    function arrayOprn($arr)
    {
        $end_date = $arr->ED;
        $date = new DateTime($arr->ED);
        $date->modify('+1 day');
        $end_date = $date->format('Y-m-d');
        $uid = $arr->user_id;
        $sql = "select first_name, last_name from tbl_users where id = " . $uid . "";
        $query = $this->db->query($sql);
        $arr_usr = $query->row();
        $newarrayx->Title = $arr->Title;
        $newarrayx->GuestName = $arr_usr->first_name.' '.$arr_usr->last_name;
        $newarrayx->SD = $arr->SD;
        $newarrayx->ED = $end_date;
        $newarrayx->RD = $arr->RD;
        $newarrayx->BD = $arr->BD;
        $newarrayx->TP = $arr->TP;
        $newarrayx->NG = $arr->NG;
        $newarrayx->TID = $arr->TID;
        return $newarrayx;
    }

    //Messaging system begins from here
    public function countMessage()
    {
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        $user_id = $this->session->userdata('user_id');
        $data['user_profile_info'] = $this->user_model->getUserInfo($user_id);
        $data['new_messages'] = $this->user_model->countMessage($user_id);
        $data['main_client_view'] = 'user/user-dashboard';
    }

    public function inbox()
    {
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        $user_id = $this->session->userdata('user_id');
        $data['user_profile_info'] = $this->user_model->getUserInfo($this->session->userdata('user_id'));
        $data['unread_notifications'] = $this->user_model->getUnreadNotifications($data['user_profile_info']->id);
        $data['inbox_unread_items'] = $this->message_model->getAllMessageUnreadByUser($this->session->userdata('user_id'));
        $data['inbox_read_items'] = $this->message_model->getAllMessageReadByUser($this->session->userdata('user_id'));
        $data['main_client_view'] = 'user/user-dashboard';
        $data['dashboard_content'] = 'user/inbox_list';
        $data['page_title'] = 'Inbox';
        $this->load->model('login/Site_setting_model');
        $data['settings'] = $this->Site_setting_model->get_site_info(1);
        $data['header_menus'] = $this->Site_setting_model->get_header_menu();
        $data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
        $data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();

        $this->load->view('user', $data);
    }
    function readmsg($msgid)
    {
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        $user_id = $this->session->userdata('user_id');
        $data['user_profile_info'] = $this->user_model->getUserInfo($this->session->userdata('user_id'));
        $data['unread_notifications'] = $this->user_model->getUnreadNotifications($data['user_profile_info']->id);
        $data['main_message'] = $this->message_model->get_main_message($msgid);
        if(($data['main_message']->user1==$this->session->userdata('user_id')) or ($data['main_message']->user2==$this->session->userdata('user_id')))
        {
            //The discussion will be placed in read messages
            if($data['main_message']->user1==$this->session->userdata('user_id'))
            {
                $sql = 'update tbl_pm set user1read="yes" where id="'.$msgid.'" and id2="1"';
                $query = $this->db->query($sql);
                $data['user_partic'] = 2;
            }
            else
            {
                $sql = 'update tbl_pm set user2read="yes" where id="'.$msgid.'" and id2="1"';
                $query = $this->db->query($sql);
                $data['user_partic'] = 1;
            }
        }
        $data['dn2'] = $this->message_model->get_reply_messages($msgid);
        $data['page_title'] = 'Message Detail';
        $data['main_client_view'] = 'user/user-dashboard';
        $this->load->model('login/Site_setting_model');
        $data['header_menus'] = $this->Site_setting_model->get_header_menu();
        $data['footer_menus'] = $this->Site_setting_model->get_footer_menu();
        $data['footer_bottom_menus'] = $this->Site_setting_model->get_footer_bottom_menu();
        $data['dashboard_content'] = 'user/message_detail';
        $this->load->view('user', $data);
    }
    function replymessageinstant($mid)
    {
        $this->message_model->reply_instant($mid);
        $data = array('msg'=>'Your message has successfully been sent.');
        $this->session->set_userdata($data);
        redirect('user/readmsg/'.$mid, $data);
    }
    function sent(){
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        $user_id = $this->session->userdata('user_id');
        $data['user_profile_info'] = $this->user_model->getUserInfo($this->session->userdata('user_id'));
        $data['sent_items']	= $this->user_model->getSentItems($user_id);
        $type = $this->uri->segment(2);
        $array = array('type'=> $type);
        $this->session->set_userdata($array);
        $data['main_client_view'] = 'user/user-dashboard';
        $data['dashboard_content'] = 'user/sent';
        $this->load->view('user', $data);
    }
    function viewMessage($id){
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        if(!isset($id)){
            $data['user_profile_info'] = $this->user_model->getUserInfo($this->session->userdata('user_id'));
            $data['main_client_view'] = 'user/user-dashboard';
            $data['dashboard_content'] = 'user/404';
            $this->load->view('user', $data);
        }
        else{
            $data['user_profile_info'] = $this->user_model->getUserInfo($this->session->userdata('user_id'));
            $data['main_client_view'] = 'user/user-dashboard';
            $data['dashboard_content'] = 'user/view-message';
            $data['message']            =   $this->user_model->loadMessage($id);
            $data ['replies']           =   $this->user_model->loadReplies($id);
            $this->load->view('user', $data);
        }
    }
    function trashMessage(){
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        $msg_id = $this->uri->segment(3);
        $this->user_model->trashMessage();
        if($this->session->userdata('type') == 'inbox'){
            redirect('user/inbox');
        }
        elseif($this->session->userdata('type')== 'sent'){
            redirect('user/sent');
        }
    }
    function replyMessage($to_id){
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        $id = $this->uri->segment(3);
        $data['user_profile_info'] = $this->user_model->getUserInfo($this->session->userdata('user_id'));
        $data['main_client_view'] = 'user/user-dashboard';
        $data['dashboard_content'] = 'user/reply';
        $this->load->view('user', $data);
    }
    function sendMessage(){
        if($this->session->userdata('Fb_user'))
        {
            $data['fb_arr'] = $this->session->userdata('Fb_user');
        }
        $message = $this->input->post('reply-message');
        $new_msg = preg_replace("/([a-zA-Z0-9\._]+)(@[a-zA-Z0-9\-\.]+)/", "", $message);
        $this->user_model->sendMessage($new_msg);
        $msg = array('success_msg'=>'Your Message has been sent');
        $this->session->set_flashdata($msg);
        $this->session->keep_flashdata($msg);
        if(@$this->session->userdata('type') == 'inbox'){
            redirect('user/inbox');
        }
        elseif(@$this->session->userdata('type') == 'sent'){
            redirect('user/sent');
        }
        else{
            redirect('user/viewMessage/'.$this->uri->segment(3));
        }
    }
    function uploadifyUploader()
    {
        print_r('essss');exit;
        if (!empty($_FILES))
        {
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = './images/gallery/bigs/';
            $targetFile =  str_replace('//','/',$targetPath) . filesize($_FILES['Filedata']['tmp_name']) . $_FILES['Filedata']['name'];

            if ( ! @copy($tempFile,$targetFile))
            {
                if ( ! @move_uploaded_file($tempFile,$targetFile))
                {
                    echo "error";
                }
                else echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
            }
            else echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
        }
    }
    function filemanipulation($extension,$filename)
    {
        // you can insert the result into the database if you want.
        if($this->is_image($extension))
        {
            $config['image_library']  = 'gd2';
            $config['source_image']	  = './images/gallery/bigs/'.$filename;
            $config['new_image']      = './images/gallery/thumbs/';
            $config['create_thumb']   = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['thumb_marker']   = '';
            $config['width']	  = 100;
            $config['height']	  = 100;

            $this->load->library('image_lib', $config);

            $this->image_lib->resize();
            echo 'image';
        }
        else echo 'file';
    }

    private function is_image($imagetype)
    {
        $ext = array(
            '.jpg',
            '.gif',
            '.png',
            '.bmp'
        );
        if(in_array($imagetype, $ext)) return true;
        else return false;
    }
}