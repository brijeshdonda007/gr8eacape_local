<?php

class Login_model extends CI_Model{

    function logincheck($username,$password){

        $pwd=$this->incrypt($this->input->post('password'));

        $array = array('username'=>$username,'password'=>$pwd);

        $this->table='tbl_users';

        $query = $this->db->get_where($this->table, $array);

   

        if($query->num_rows() > 0){

            return true;

        }

        else{

            return false;

        }

        

        

    }

    

    function fetch_details($username,$password){

        $pwd=$this->incrypt($this->input->post('password'));

        $this->table='tbl_users';

        $array = array('username'=>$username,'password'=>$pwd);

        $this->db->where($array);

        $query = $this->db->get($this->table,1);



        $result = $query->row();

        return $result;

    }

    

    function incrypt($pwd)

		{

			$temp="greatescapes";

			$a=md5(sha1($temp.$pwd));

			return $a;

		}

                

    

}