<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


 class Facebook_helper{
     public function __construct(){
		parent::__construct();
                $this->config->load('facebook');
                
	}
 function getFacebookProfileInfo()
 {
    $CI =& get_instance();
    	$facebook = new Facebook(array(
		'appId'		=>  $this->config->item('appID'), 
		'secret'	=> $this->config->item('appSecret'),
		));
		
		$user = $facebook->getUser(); // Get the facebook user id 
		
		if($user){
			
			try{
				$user_profile = $facebook->api('/me');  //Get the facebook user profile data
				
				$params = array('next' => $base_url.'fbci/logout');
				
				$ses_user=array('User'=>$user_profile,
				   'logout' =>$facebook->getLogoutUrl($params)   //generating the logout url for facebook 
				);
		        $this->session->set_userdata($ses_user);
				header('Location: '.$base_url);
			}catch(FacebookApiException $e){
				error_log($e);
				$user = NULL;
			}		
		}	
 }
 

 }