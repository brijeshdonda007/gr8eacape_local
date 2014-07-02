<?php

class Message_model extends CI_Model {

    

    //@TODO Move all query to active record pattern
    function getAllMessageUnreadByUser($user_id)

    {

        $sql = 'select m1.id, m1.message as title, m1.timestamp, count(m2.id) as reps, tbl_users.id as userid, tbl_users.first_name, tbl_users.last_name
               from tbl_pm as m1, tbl_pm as m2, tbl_users
               where ((m1.to_user="'.$user_id.'" and m1.is_read=0 and tbl_users.id=m1.from_user) or (m1.from_user="'.$user_id.'" and tbl_users.id=m1.to_user)) and m2.id=m1.id
               group by m1.id
               order by m1.id desc';

        $query = $this->db->query($sql);

        return $query->result();

        

    }

    function getAllMessageReadByUser($user_id)

    {

        $sql = 'select m1.id, m1.message as title, m1.timestamp, count(m2.id) as reps, tbl_users.id as userid, tbl_users.first_name, tbl_users.last_name
                from tbl_pm as m1, tbl_pm as m2,tbl_users
                where ((m1.to_user="'.$user_id.'" and m1.is_read=1 and tbl_users.id=m1.from_user) or (m1.from_user="'.$user_id.'" and tbl_users.id=m1.from_user)) and m2.id=m1.id
                group by m1.id
                order by m1.id desc';

        $query = $this->db->query($sql);

        return $query->result();

        

    }

    

    function get_main_message($mid)

    {

        $sql = 'select title, user1, user2
                from tbl_pm
                where id="'.$mid.'" and id2="1"';

        $query = $this->db->query($sql);

        return $query->row();

    }

    

    function get_reply_messages($mid)

    {

        $sql = 'select tbl_pm.timestamp, tbl_pm.message, tbl_users.id as userid, tbl_users.first_name, tbl_users.last_name, tbl_users.profile_picture
                from tbl_pm, tbl_users
                where tbl_pm.id="'.$mid.'" and tbl_users.id=tbl_pm.user1
                order by tbl_pm.id2 desc';

        $query = $this->db->query($sql);

        return $query->result();

    }

    function reply_instant($mid)

    {

    if(isset($_POST['message']) and $_POST['message']!='')

    {

	$message = $this->input->post('message');

        $user_partic = $this->input->post('user_partic');

	//We remove slashes depending on the configuration

	if(get_magic_quotes_gpc())

	{

		$message = stripslashes($message);

	}

        

        $abc = (intval($this->input->post('reply_count'))+1);

	//We protect the variables

	$message = mysql_real_escape_string(nl2br(htmlentities($message, ENT_QUOTES, 'UTF-8')));

	//We send the message and we change the status of the discussion to unread for the recipient

	$sql = 'insert into tbl_pm (id, id2, title, user1, user2, message, timestamp, user1read, user2read)values("'.$mid.'", "'.$abc.'", "", "'.$this->session->userdata('user_id').'", "", "'.$message.'", "'.time().'", "", "")';

        $query1 = $this->db->query($sql);

        $sql2 = 'update tbl_pm set user'.$user_partic.'read="yes" where id="'.$mid.'" and id2="1"';

        $query = $this->db->query($sql2);

	

    }

    }

}