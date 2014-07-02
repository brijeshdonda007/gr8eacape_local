<?php

class Site_setting_model extends CI_Model {
     public function __construct() {
        //parent::CI_Model();
    }
    function get_header_menu(){
    	$this->db->where('tbl_menu_items.section_id', 1);
    	$this->db->where('tbl_menu_items.status','1');
    	$this->db->join('tbl_menu_sections', 'tbl_menu_items.section_id=tbl_menu_sections.id', 'LEFT');
    	$this->db->select('tbl_menu_items.*, tbl_menu_sections.name as section_name');
    	$query = $this->db->get('tbl_menu_items');
    	if ($query->num_rows() > 0)
    		return $query->result();
    	else
    		return NULL;
    }
    function get_footer_menu(){
    	$this->db->where('tbl_menu_items.section_id', 2);
    	$this->db->where('tbl_menu_items.status','1');
    	$this->db->join('tbl_menu_sections', 'tbl_menu_items.section_id=tbl_menu_sections.id', 'LEFT');
    	$this->db->select('tbl_menu_items.*, tbl_menu_sections.name as section_name');
    	$query = $this->db->get('tbl_menu_items');
    	if ($query->num_rows() > 0)
    		return $query->result();
    	else
    		return NULL;
    }
    function get_footer_bottom_menu(){
    	$this->db->where('tbl_menu_items.section_id', 4);
    	$this->db->where('tbl_menu_items.status','1');
    	$this->db->join('tbl_menu_sections', 'tbl_menu_items.section_id=tbl_menu_sections.id', 'LEFT');
    	$this->db->select('tbl_menu_items.*, tbl_menu_sections.name as section_name');
    	$query = $this->db->get('tbl_menu_items');
    	if ($query->num_rows() > 0)
    		return $query->result();
    	else
    		return NULL;
    }
	function get_site_info($site_id)
	{
		$data=array();
		$options=array('id'=>$site_id);
		$query = $this->db->get_where('tbl_setting',$options);
		return $query->row();
	}
	function update_site_settings()
	{
		$data=array('site_name'=>$this->input->post('site_name'),
			'site_title'=>$this->input->post('site_title'),
			'site_offline_msg'=>$this->input->post('site_offline_msg'),
			'site_email'=>$this->input->post('site_email'),
			'site_buss_email'=>$this->input->post('site_buss_email'),
			'site_meta_desc'=>$this->input->post('site_meta_desc'),
			'site_meta_keywords'=>$this->input->post('site_meta_keywords'),
			'queue_auction'=>$this->input->post('queue_auction'),
			'maximum_ok'=>$this->input->post('maximum_ok'),
			'home_auction'=>$this->input->post('home_auction'),
			'queue_auction_penny'=>$this->input->post('queue_auction_penny'),
			'maximum_ok_penny'=>$this->input->post('maximum_ok_penny'),
			'home_auction_penny'=>$this->input->post('home_auction_penny'),
			'penny_reset'=>$this->input->post('penny_reset'),
			'global_reduction'=>$this->input->post('global_reduction'),
			'reveal_timer'=>$this->input->post('reveal_timer'),
			'closing_time'=>$this->input->post('closing_time'),
			'show_sold'=>$this->input->post('show_sold'),
			'bid_cost'=>$this->input->post('bid_cost'),
			'conversion_factor'=>$this->input->post('conversion_factor'),
			'referrer_bids'=>$this->input->post('referrer_bids'),
			'referrer_puremoney'=>$this->input->post('referrer_puremoney'),
			'fb_top'=>addslashes($this->input->post('fb_top')),
			'tw_top'=>addslashes($this->input->post('tw_top')),
			'fb_bottom'=>addslashes($this->input->post('fb_bottom')),
			'tw_bottom'=>addslashes($this->input->post('tw_bottom')),
			'youtube'=>addslashes($this->input->post('youtube')),
			'paypal_email'=>$this->input->post('paypal_email'),
			'reveal_limit'=>$this->input->post('reveal_limit'),
			'tax_calulation'=>$this->input->post('tax_calulation'),
			'currency_code'=>$this->input->post('cur_code'),
			'currency'=>$this->input->post('currency'),
			'site_status'=>$this->input->post('site_status'));
		$this->db->where('site_id','1');
		$this->db->update('tblsite_setting',$data);
	}
}
/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */