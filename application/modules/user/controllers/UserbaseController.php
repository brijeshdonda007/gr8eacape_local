<?php

/**
* User Base Controller what serves all basic functionality for user
*
* @category Controller
* @author Eftakhairul Islam <eftakhairul@gmail.com> (http://eftakhairul.com)
*/
require_once APPPATH .'libraries/facebook/facebook.php';
class UserbaseController extends CI_Controller
{
    protected $data;

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('accesscontrol');
        Accesscontrol_helper::is_logged_in_front();
        $this->earnings = Accesscontrol_helper::get_earnings();

        $this->load->model('user_model');
        $this->load->model('message_model');
        $this->load->model('location_model');
        $this->load->library('image_lib');

        $this->config->load('facebook');


    }

    /**
     * Serve all common setting for a user page
     */
    public function commonSetting()
    {
        $this->load->model('login/Site_setting_model');
        $this->data['settings']                   = $this->Site_setting_model->get_site_info(1);
        $this->data['header_menus']               = $this->Site_setting_model->get_header_menu();
        $this->data['footer_menus']               = $this->Site_setting_model->get_footer_menu();
        $this->data['footer_bottom_menus']        = $this->Site_setting_model->get_footer_bottom_menu();
    }

    /**
     * Return user setting based on user id
     *
     * @return float
     */
    protected  function user_ratings()
    {
        $all_property  = $this->user_model->all_property_by_ownerID($this->session->userdata('user_id'));
        $tot_ratings = 0;
        $total_rated_prop = 0;
        foreach($all_property as $alp)
        {
            $total_rated_prop += $this->user_model->is_rated_propCheck($alp->id);
            $is_rated = $this->user_model->is_rated_prop($alp->id);
            if($is_rated > 0)
            {
                $tot_ratings += $this->user_model->get_rate_by_propID($alp->id);
            }
        }
        if($total_rated_prop > 0)
        {
            $rating = ($tot_ratings/$total_rated_prop)*(5/100);
            return $rating;
        }
    }
} 