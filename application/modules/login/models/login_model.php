<?php

class Login_model extends CI_Model{

    function logincheck($username,$password){

        $password = hash('sha256', $password);

        $array = array('username'=>$username,'password'=>$password);

        $this->table='tbl_users';

        $query = $this->db->get_where($this->table, $array);
   

        if($query->num_rows() > 0)
        {
            return true;
        }

        else
        {
			$array = array('email'=>$username, 'password'=>$password);
			$this->table='tbl_users';
			$query = $this->db->get_where($this->table, $array);
			if ($query->num_rows() > 0)
				return true;
            else
				return false;
        }
    }

    function fetch_details($username,$password){

        $password = hash('sha256', $password);

        $this->table='tbl_users';

        $array = array('username'=>$username,'password'=>$password);

        $this->db->where($array);

        $query = $this->db->get($this->table,1);

        $result = $query->row();
		if (empty($result)){
			$array = array('email'=>$username, 'password'=>$password);
			$this->db->where($array);
			$query = $this->db->get($this->table,1);
			$result = $query->row();
		}
		return $result;
    }

    function fetch_details_fb($user_email)

    {

        $query	= $this->db->get_where('tbl_users', array('email' => $user_email));				

        return $query->row();

    }
    function update_login_time($user_id){
    	$data = array('last_login' => date('Y-m-d H:i:s'));
    	$this->db->where('id', $user_id);
    	$this->db->update('tbl_users', $data);
    }

                

    

}