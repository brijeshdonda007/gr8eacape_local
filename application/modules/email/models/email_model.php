<?php
class Email_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->helper('yurl');
	}
	function template_header(){
		$template = '<html><style>body,a{font-size:18px;margin:0;font-family:Arial;} a{font-weight:normal;} .italic{font-style:italic;} p{font-size:20px;font-weight:700;color:#1194B2;margin:5px 0;} .normal{font-weight:normal;} h2{color:#EF3873;margin:5px 0;} .content{background-image:url(http://gr8escapes.com/assets/frontend/images/email_template_header.png); background-repeat:no-repeat;width:900px;margin:0 auto;padding-top:200px;} .footer{background-image:url(http://gr8escapes.com/assets/frontend/images/email_template_footer.png); background-repeat:no-repeat;width:900px;margin:0 auto;height:105px;} .text{margin:0 70px;}</style><body><div><div class="content"><div class="text">';
		return $template;
	}
	function template_footer(){
		$template = '</div></div>';
		$template .= '<div class="footer" style="position:relative;">';
		$template .= '<a href="http://gr8escapes.com" style="position:relative;top:50px;margin-left: 72px;color: white;">www.gr8escapes.com</a>';
		$template .= '<a href="http://facebook.com/Gr8Escapes" style="position:relative;top:50px;margin-left: 110px;color: white;">www.facebook.com/Gr8Escapes</a>';
		$template .= '<a href="https://twitter.com/gr8_escapes" style="position:relative;top:50px;margin-left: 125px;color: white;">Gr8_Escapes</a>';
		$template .= '</div></div>';
		$template .= '</body></html>';
		return $template;
	}
	function register_confirmation_email($activation_code, $from_email)
	{
		$first_name = $this->input->post('first_name');
		$user_name = $this->input->post('username');

		$this->db->where('name', 'reg_confirm');
		$query = $this->db->get('tbl_email_template');
		$content = $query->row()->content;
		
		$headers = "From: ".$from_email."\r\n" .
		"Reply-To: ".$from_email."\r\n" .
		'X-Mailer: PHP/' . phpversion() . "\r\n" .
		"MIME-Version: 1.0\r\n" .
		"Content-Type: text/html; charset=utf-8\r\n" .
		"Content-Transfer-Encoding: 8bit\r\n\r\n";
		$subject='Welcome to GR8 escapes. Please Activate your Account Now!';
		$url="<p class='normal'><a href='".site_url('register/activation_process/'.uencode(yencode($activation_code,$this->config->item('encoder'))))."'>".site_url('register/activation_process/'.uencode(yencode($activation_code,$this->config->item('encoder'))))."</a></p>";
		$temp = str_replace('$url', $url, $content);
		$temp = str_replace('$first_name', $first_name, $temp);
		$temp = str_replace('$user_name', $user_name, $temp);
		$emailbody = $this->template_header();
		$emailbody .= $temp;
		$emailbody .= $this->template_footer();
		@mail($this->input->post('email'),$subject,$emailbody,$headers);
	}
	function registered_email($activation_code, $from_email)
	{
		$sql="SELECT * FROM tbl_users WHERE activation_code='$activation_code'";
		$query1 = $this->db->query($sql);
		$first_name = $query1->row()->first_name;
		$email_address = $query1->row()->email;
		
		$this->db->where('name', 'registered');
		$query = $this->db->get('tbl_email_template');
		$content = $query->row()->content;
		
		$headers = "From: ".$from_email."\r\n" .
		"Reply-To: ".$from_email."\r\n" .
		'X-Mailer: PHP/' . phpversion() . "\r\n" .
		"MIME-Version: 1.0\r\n" .
		"Content-Type: text/html; charset=utf-8\r\n" .
		"Content-Transfer-Encoding: 8bit\r\n\r\n";
		$subject='Account Activated!';
		//$temp = str_replace('$url', $url, $content);
		$temp = str_replace('$first_name', $first_name, $content);
		//$temp = str_replace('$user_name', $user_name, $temp);
		$emailbody = $this->template_header();
		$emailbody .= $temp;
		$emailbody .= $this->template_footer();
		@mail($email_address, $subject, $emailbody, $headers);
	}
	function get_email_forget($str)
	{
		$sql="SELECT * FROM tbl_users WHERE email='$str' ";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
	function forget_password_reminder_email($from_email)
	{
		$information=$this->get_email_forget($this->input->post('email'));
		$first_name = $information['first_name'];
		$username = $information['username'];
		$this->db->where('name', 'forget_password');
		$query = $this->db->get('tbl_email_template');
		$content = $query->row()->content;
		$headers = "From: ".$from_email."\r\n" .
			"Reply-To: ".$from_email."\r\n" .
			'X-Mailer: PHP/' . phpversion() . "\r\n" .
			"MIME-Version: 1.0\r\n" .
			"Content-Type: text/html; charset=utf-8\r\n" .
			"Content-Transfer-Encoding: 8bit\r\n\r\n";
		$subject='Forgot Password!';
		$url = "<a href='".site_url('forgotpassword/change_process/'.uencode(yencode($this->input->post('email'),$this->config->item('encoder'))))."'>".site_url('forgotpassword/change_process/'.uencode(yencode($this->input->post('email'),$this->config->item('encoder'))))."</a>";
		$emailbody = $this->template_header();
		$temp = str_replace('$url', $url, $content);
		$temp = str_replace('$username', $username, $temp);
		$emailbody .= $temp;
		$emailbody .= $this->template_footer();
		@mail($this->input->post('email'),$subject,$emailbody,$headers);
	}
	function get_email_forget_admin($str)
	{
		$sql="SELECT * FROM tbl_admin WHERE email='$str' ";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	function forget_password_reminder_email_admin($from_email)
	{
		$information=$this->get_email_forget_admin($this->input->post('email'));
		$headers = "From: ".$from_email."\r\n" .
			"Reply-To: ".$from_email."\r\n" .
			'X-Mailer: PHP/' . phpversion() . "\r\n" .
			"MIME-Version: 1.0\r\n" .
			"Content-Type: text/html; charset=utf-8\r\n" .
			"Content-Transfer-Encoding: 8bit\r\n\r\n";
		$subject='Forgot Password!';
		$confirm="<p><a href='".site_url('admin/change_process/'.uencode(yencode($this->input->post('email'),$this->config->item('encoder'))))."'>".site_url('admin/change_process/'.uencode(yencode($this->input->post('email'),$this->config->item('encoder'))))."</a></p>";
		$emailbody = $this->template_header();
		$emailbody .= '<p><h2>Dear '.$information['first_name']. '</h2></p>';
		$emailbody .= '<p>Please click the link below to change your password.</p>';
		$emailbody .= $confirm;
		$emailbody .= '<br/>';
		$emailbody .= '<p>Your login information is as follows:</p>';
		$emailbody .= '<p>Username: <strong>'.$information['username'].'</strong></p><br/>';
		$emailbody .= '<p><h2 class="italic">The team at Gr8 Escapes</h2></p>';
		$emailbody .= $this->template_footer();
		@mail($this->input->post('email'),$subject,$emailbody,$headers);
	}
    function sendEnquiry()
    {
		///sending emal to Gr8 Escapes start
		$from_email = $this->input->post('email');
		$gr8escape_email = "keshgrg@responsive-pixel.com";
		$headers = "From: ".$from_email."\r\n" .
		"Reply-To: ".$from_email."\r\n" .
		'X-Mailer: PHP/' . phpversion() . "\r\n" .
		"MIME-Version: 1.0\r\n" .
		"Content-Type: text/html; charset=utf-8\r\n" .
		"Content-Transfer-Encoding: 8bit\r\n\r\n";
		$subject='General Enquiry!';
		$emailbody = $this->template_header();
		$emailbody .= '<p><h2>An enquiry from '.$this->input->post('name').',</h2></p><br/>';
		$emailbody .= '<p>'.$this->input->post('message').'</p>';
		$emailbody .= '<p><h2 class="italic">The team at Gr8 Escapes</h2></p>';
		$emailbody .= $this->template_footer();
		@mail($gr8escape_email,$subject,$emailbody,$headers);
		return 1;
    }
	function subscribe_email($from_email)
	{
	    $full_name = $this->input->post('full_name');
	    $subscribe_email = $this->input->post('subscribe_email');
	    $query = $this->db->get_where('tbl_email_subscriber',array('email_subscriber' => $subscribe_email));
	    $count = $query->num_rows();
	    if($count > 0)
	    {
	        return 0;
	    }
	    else
	    {
	    $data = array('full_name' => $full_name, 'email_subscriber' => $subscribe_email);
	    $this->db->insert('tbl_email_subscriber', $data);
	    if($this->db->insert_id())
	    {
			$headers = "From: ".$from_email."\r\n" .
			"Reply-To: ".$from_email."\r\n" .
			'X-Mailer: PHP/' . phpversion() . "\r\n" .
			"MIME-Version: 1.0\r\n" .
			"Content-Type: text/html; charset=utf-8\r\n" .
			"Content-Transfer-Encoding: 8bit\r\n\r\n";
			$subject='You have subscribed with Gr8 Escapes!';
			$emailbody = $this->template_header();
			$emailbody .= '<p><h2>Dear subscriber,</h2></p>';
			$emailbody .= '<p>Thank you for subscribing with us.You have been added to our mailing lists</p><br/>';
			$emailbody .= '<p><h2 class="italic">The team at Gr8 Escapes</h2></p>';
			$emailbody .= $this->template_footer();
			@mail($subscribe_email,$subject,$emailbody,$headers);
	    }
	    return 1;
	    }
	}
    function send_contact_enquiry()
    {
        $full_name = $this->input->post('full_name');
        $email = $this->input->post('email');
        $phone_number = $this->input->post('phone_number');
        $message = $this->input->post('message');
        //send mail
        $site_info=$this->get_site_info(1);
        $to_email = "keshgrg@responsive-pixel.com";
        //$to_email = "jhyang0310@gmail.com";
        $headers = "From: ".$email."\r\n" .
        "Reply-To: ".$email."\r\n" .
        'X-Mailer: PHP/' . phpversion() . "\r\n" .
        "MIME-Version: 1.0\r\n" .
        "Content-Type: text/html; charset=utf-8\r\n" .
        "Content-Transfer-Encoding: 8bit\r\n\r\n";
		$subject='General Enquiry!';
		$emailbody = $this->template_header();
		$emailbody .= "<p><h2>Dear Administrator;</h2></p><p>You have received an enquiry message from $full_name.The detail is as following</p>";
		$emailbody .= "<br/>";
		$emailbody .= "<p>Full Name: $full_name </p>";
		$emailbody .= "<p>Email: $email </p>";
		$emailbody .= "<p>Phone: $phone_number</p>";
		$emailbody .= "<p>Message: <br/>$message</p>";
		$emailbody .= '<p><h2 class="italic">The team at Gr8 Escapes</h2></p>';
		$emailbody .= $this->template_footer();
		@mail($to_email,$subject,$emailbody,$headers);
		return TRUE;
    }
	function send_contact_help()
    {
        $full_name = $this->input->post('full_name');
        $email = $this->input->post('email');
        $phone_number = $this->input->post('phone_number');
        $message = $this->input->post('message');
        //send mail
        $site_info=$this->get_site_info(1);
        $to_email = "keshgrg@responsive-pixel.com";
        //$to_email = "jhyang0310@gmail.com";
        $headers = "From: ".$email."\r\n" .
        "Reply-To: ".$email."\r\n" .
        'X-Mailer: PHP/' . phpversion() . "\r\n" .
        "MIME-Version: 1.0\r\n" .
        "Content-Type: text/html; charset=utf-8\r\n" .
        "Content-Transfer-Encoding: 8bit\r\n\r\n";
		$subject='Help support!';
		$emailbody = $this->template_header();
		$emailbody .= "<p><h2>Dear Administrator;</h2></p><p>You have received an help & support message from $full_name.The detail is as following</p>";
		$emailbody .= "<p>Full Name: $full_name </p>";
		$emailbody .= "<p>Email: $email </p>";
		$emailbody .= "<p>Phone: $phone_number</p>";
		$emailbody .= "<p>Message: <br/>$message</p>";
		$emailbody .= '<p><h2 class="italic">The team at Gr8 Escapes</h2></p>';
		$emailbody .= $this->template_footer();
		@mail($to_email,$subject,$emailbody,$headers);
		return TRUE;
    }
	function booking_email_to_buyer($title, $start_date, $end_date, $booked_days, $no_of_guests, $total_price, $buyer_email, $buyer_name){
		$from_email = "info@gr8escapes.com";
		$headers = "From: ".$from_email."\r\n" .
		"Reply-To: ".$from_email."\r\n" .
		'X-Mailer: PHP/' . phpversion() . "\r\n" .
		"MIME-Version: 1.0\r\n" .
		"Content-Type: text/html; charset=utf-8\r\n" .
		"Content-Transfer-Encoding: 8bit\r\n\r\n";
		$subject ='Booking request for '.$title.'!';
		$this->db->where('name', 'booking_email_to_buyer');
		$query = $this->db->get('tbl_email_template');
		$content = $query->row()->content;
		$content = str_replace('$buyer_name', $buyer_name, $content);
		$content = str_replace('$title', $title, $content);
		$content = str_replace('$start_date', $start_date, $content);
		$content = str_replace('$end_date', $end_date, $content);
		$content = str_replace('$booked_days', $booked_days, $content);
		$content = str_replace('$no_of_guests', $no_of_guests, $content);
		$content = str_replace('$total_price', $total_price, $content);
		$emailbody = $this->template_header();
		$emailbody .= $content;
		//$emailbody .= '<p><h2>Dear $buyer_name,</h2></p><p>You have requested for $title. The details are as following</p><p>Property: $title</p><p>Check In: $start_date</p><p>Check Out: $end_date </p><p>Total Booked Days: $booked_days</p>No. of Guests: $no_of_guests<p>Total Price: $total_price</p><br/><p><h2 class="italic">The team at Gr8 Escapes</h2></p>';
		$emailbody .= $this->template_footer();
		@mail($buyer_email,$subject,$emailbody,$headers);
	}
	function booking_direct_email_to_buyer($title, $start_date, $end_date, $booked_days, $no_of_guests, $total_price, $buyer_email, $buyer_name){
		$from_email = "info@gr8escapes.com";
		$headers = "From: ".$from_email."\r\n" .
		"Reply-To: ".$from_email."\r\n" .
		'X-Mailer: PHP/' . phpversion() . "\r\n" .
		"MIME-Version: 1.0\r\n" .
		"Content-Type: text/html; charset=utf-8\r\n" .
		"Content-Transfer-Encoding: 8bit\r\n\r\n";

		$this->db->where('name', 'booking_direct_email_to_buyer');
		$query = $this->db->get('tbl_email_template');
		$content = $query->row()->content;
		$content = str_replace('$buyer_name', $buyer_name, $content);
		$content = str_replace('$title', $title, $content);
		$content = str_replace('$start_date', $start_date, $content);
		$content = str_replace('$end_date', $end_date, $content);
		$content = str_replace('$booked_days', $booked_days, $content);
		$content = str_replace('$no_of_guests', $no_of_guests, $content);
		$content = str_replace('$total_price', $total_price, $content);

		$subject ='Booking for '.$title.'!';
		$emailbody = $this->template_header();
		$emailbody .= $content;
		//$emailbody .= '<p><h2>Dear $buyer_name,</h2></p><p>You have booked for $title. The details are as following</p><p>Property: $title</p><p>Check In: $start_date</p><p>Check Out: $end_date</p><p>Total Booked Days: $booked_days</p><p>No. of Guests: $no_of_guests</p><p>Total Price: $total_price</p><br/><p><h2 class="italic">The team at Gr8 Escapes</h2></p>';
		$emailbody .= $this->template_footer();
		@mail($buyer_email,$subject,$emailbody,$headers);
	}
	function booking_email_to_owner($title, $start_date, $end_date, $booked_days, $no_of_guests, $total_price, $owner_email, $owner_name){
		$from_email = "info@gr8escapes.com";
		$headers = "From: ".$from_email."\r\n" .
		"Reply-To: ".$from_email."\r\n" .
		'X-Mailer: PHP/' . phpversion() . "\r\n" .
		"MIME-Version: 1.0\r\n" .
		"Content-Type: text/html; charset=utf-8\r\n" .
		"Content-Transfer-Encoding: 8bit\r\n\r\n";
		$this->db->where('name', 'booking_email_to_owner');
		$query = $this->db->get('tbl_email_template');
		$content = $query->row()->content;
		$content = str_replace('$owner_name', $owner_name, $content);
		$content = str_replace('$title', $title, $content);
		$content = str_replace('$start_date', $start_date, $content);
		$content = str_replace('$end_date', $end_date, $content);
		$content = str_replace('$booked_days', $booked_days, $content);
		$content = str_replace('$no_of_guests', $no_of_guests, $content);
		$content = str_replace('$total_price', $total_price, $content);

		$subject='Booking request for '.$title.'!';
		$emailbody = $this->template_header();
		$emailbody .= $content;
		//$emailbody .= '<p><h2>Dear $owner_name,</h2></p><p>You have got the booking request for $title. The details are as following</p><p>Property: $title</p><p>Check In: $start_date</p><p>Check Out: $end_date</p><p>Total Booked Days: $booked_days</p><p>No. of Guests: $no_of_guests</p><p>Total Price: $total_price</p><br/><p><h2 class="italic">The team at Gr8 Escapes</h2></p>';
		$emailbody .= $this->template_footer();
		@mail($owner_email,$subject,$emailbody,$headers);
	}
	function booking_direct_email_to_owner($title, $start_date, $end_date, $booked_days, $no_of_guests, $total_price, $owner_email, $owner_name){
		$from_email = "info@gr8escapes.com";
		$headers = "From: ".$from_email."\r\n" .
		"Reply-To: ".$from_email."\r\n" .
		'X-Mailer: PHP/' . phpversion() . "\r\n" .
		"MIME-Version: 1.0\r\n" .
		"Content-Type: text/html; charset=utf-8\r\n" .
		"Content-Transfer-Encoding: 8bit\r\n\r\n";
		$this->db->where('name', 'booking_direct_email_to_owner');
		$query = $this->db->get('tbl_email_template');
		$content = $query->row()->content;
		$content = str_replace('$owner_name', $owner_name, $content);
		$content = str_replace('$title', $title, $content);
		$content = str_replace('$start_date', $start_date, $content);
		$content = str_replace('$end_date', $end_date, $content);
		$content = str_replace('$booked_days', $booked_days, $content);
		$content = str_replace('$no_of_guests', $no_of_guests, $content);
		$content = str_replace('$total_price', $total_price, $content);

		$subject='Booking for '.$title.'!';
		$emailbody = $this->template_header();
		$emailbody .= $content;
		//$emailbody .= '<p><h2>Dear $owner_name,</h2></p><p>You have got the booking for $title. The details are as following</p><p>Property: $title</p><p>Check In: $start_date</p><p>Check Out: $end_date</p><p>Total Booked Days: $booked_days</p><p>No. of Guests: $no_of_guests</p><p>Total Price: $total_price</p><br/><p><h2 class="italic">The team at Gr8 Escapes</h2></p>';
		$emailbody .= $this->template_footer();
		@mail($owner_email,$subject,$emailbody,$headers);
	}
	
	/*
	* Function to send notification emails about adding/editing escapes
	*/
	function add_escape_mail($escape_name, $private_code, $user_email){
		$from_email = "info@gr8escapes.com";
		$headers = "From: ".$from_email."\r\n" .
		"Reply-To: ".$from_email."\r\n" .
		'X-Mailer: PHP/' . phpversion() . "\r\n" .
		"MIME-Version: 1.0\r\n" .
		"Content-Type: text/html; charset=utf-8\r\n" .
		"Content-Transfer-Encoding: 8bit\r\n\r\n";
		$subject ='Added new escape';
		$emailbody = $this->template_header();
		if(isset($_POST['property_id'])){
			$emailbody .= '<p>Thank you <b>'.$escape_name.'</b> details edited successfully. </p><p>Our Customer Service team has been notified and you will receive an email when it has been accepted</p><p>When a listing is added it will need to be marked for acceptance by an admin user:</p><p>When it gets accepted they will get sent an email stating that their "listing" has been accepted by "admin user" date and time and can now be viewed by clicking here.</p><p><h2 class="italic">Thank you, Gr8 Escapes Customer Service Team</h2></p>';
		}else{
			$emailbody .= '<p>Thank you for adding <b>'.$escape_name.'.</b> </p><p>Our Customer Service team has been notified and you will receive an email when it has been accepted</p><p>When a listing is added it will need to be marked for acceptance by an admin user:</p><p>When it gets accepted they will get sent an email stating that their "listing" has been accepted by "admin user" date and time and can now be viewed by clicking here.</p><p><h2 class="italic">Thank you, Gr8 Escapes Customer Service Team</h2></p>';
		}
		
		$emailbody .= $this->template_footer();
		@mail($user_email,$subject,$emailbody,$headers);
	}
	
	function escape_approve_mail($private_code, $user_email){
		$from_email = "info@gr8escapes.com";
		$headers = "From: ".$from_email."\r\n" .
		"Reply-To: ".$from_email."\r\n" .
		'X-Mailer: PHP/' . phpversion() . "\r\n" .
		"MIME-Version: 1.0\r\n" .
		"Content-Type: text/html; charset=utf-8\r\n" .
		"Content-Transfer-Encoding: 8bit\r\n\r\n";
		$subject ='Escape is accepted by admin';
		$emailbody = $this->template_header();
		$emailbody .= '<p>Your "listing" has been accepted by "admin user" on '.date("Y-m-d H:i:s").' and can now be viewed by clicking <a href="http://gr8escapes.com/user/addescape/' .$private_code. '">here</a></p><p><h2 class="italic">Thank you, Gr8 Escapes Customer Service Team</h2></p>';
		$emailbody .= $this->template_footer();
		@mail($user_email,$subject,$emailbody,$headers);
	}


    function verification_accepted_mail($user_email, $escapeName)
    {
		$from_email = "info@gr8escapes.com";
		$headers = "From: ".$from_email."\r\n" .
		"Reply-To: ".$from_email."\r\n" .
		'X-Mailer: PHP/' . phpversion() . "\r\n" .
		"MIME-Version: 1.0\r\n" .
		"Content-Type: text/html; charset=utf-8\r\n" .
		"Content-Transfer-Encoding: 8bit\r\n\r\n";
		$subject = "Your verification for #{escapeName} has been sent";
		$emailbody = $this->template_header();
		$emailbody .= '<p>Payment is successfully accepted. And, your escape has been accepted by "admin user" on '. date("Y-m-d H:i:s").' </p><p><h2 class="italic">Thank you, Gr8 Escapes Customer Service Team</h2></p>';
		$emailbody .= $this->template_footer();
		@mail($user_email,$subject,$emailbody,$headers);
	}
    function get_site_info($site_id)
    {
		$data=array();
		$options=array('id'=>$site_id);
		$query = $this->db->get_where('tbl_setting',$options);
		return $query->row();
    }
}