<?php

class Image_model extends CI_Model{

	function addUpdatePage($image){

		$data = array(

		   			'page_name' 		=> 		strtolower($this->input->post('page_title')),

					'page_description'	=>		$this->input->post('page_content'),

					'page_image' 		=>		trim($image),						

					'status'		=>		$this->input->post('status'),

                                        'meta_keywords'         =>              $this->input->post('meta_keywords'),

                                        'meta_description'      =>              $this->input->post('meta_description')

				);	

		if($this->input->post('page_id') !=''):						

				$this->db->update('tbl_pages', $data, array('id' => $this->input->post('page_id')));

				$id 			= 		$this->input->post('page_id');

		else:

				$this->db->insert('tbl_pages', $data);

				$id 			= 		$this->db->insert_id();

		endif;

		return $id;

	}

	

	function listPage(){

		$query 					= 		$this->db->get('tbl_pages');

		return $query->result();

	}

	

	function deletePage(){

			$page_id			=		$this->uri->segment(3);

			$this->db->delete('tbl_pages', array('id' => $page_id));  

			echo $page_id;

	}

	

	function getPageData(){

			$page_id			=		$this->uri->segment(3);

			$query				=		$this->db->get_where('tbl_pages', array('id' => $page_id));				

			$result				=		$query->row();

			return $result;		

	}

}

?>