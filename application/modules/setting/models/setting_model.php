<?php

class Setting_model extends CI_Model{

	function addUpdateSetting(){

		$data = array(

			'government_tax'	=>		$this->input->post('gst'),

			'site_service_tax'	=>		$this->input->post('service_tax'),

			'site_title'		=>		$this->input->post('site_title'),

			'contact_email'		=>		$this->input->post('email'),

			'facebook_link'		=>		$this->input->post('facebook'),

			'twitter_link'		=>		$this->input->post('twitter'),

			'video_link'		=>		$this->input->post('video'),

			'meta_title'		=>		$this->input->post('meta_title'),

			'meta_keyword'		=>		$this->input->post('meta_keywords'),

			'meta_description'	=>		$this->input->post('meta_description')

		);

		

		if($this->input->post('setting_id') != ''):

				$this->db->update('tbl_setting', $data, array('id' => $this->input->post('setting_id')));

		else:

				$this->db->insert('tbl_setting', $data); 

		endif;

	}

	

	function getsetting(){

                $query 		=	 $this->db->get('tbl_setting');

                return $query->result();

	}

}
