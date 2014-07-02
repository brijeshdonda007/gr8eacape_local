<?php

class Booking_model extends CI_Model
{
    public function sendPreConfirmationEmail(&$data)
    {
        $from_email = "info@gr8escapes.com";
        $headers    = "From: ".$from_email."\r\n" .
		              "Reply-To: ".$from_email."\r\n" .
		              'X-Mailer: PHP/' . phpversion() . "\r\n" .
		              "MIME-Version: 1.0\r\n" .
		              "Content-Type: text/html; charset=utf-8\r\n" .
		              "Content-Transfer-Encoding: 8bit\r\n\r\n";

		$subject    = "Escape Confirmation - {$data['escapeDetails']->title}";

		@mail($data['user_profile_info']->email,
              $subject,
              $data['email_message'],
              $headers);
    }

    function request($data)
    {
        $status_array = serialize(array('bb' => 0,'oo' => 0));
        $string = $data['start_date'];
        $day    = substr($string, 8, 2);
        $month  = substr($string, 5, 2);
        $year   = substr($string, 0, 4);

        $new_arr = array('property_id'      => $data['property_id'],
                         'start_date'       => $data['start_date'],
                         'end_date'         => $data['end_date'],
                         'requested_date'   => date("Y-m-d H:i:s"),
                         'status'           => $status_array,
                         'booked_days'      => $data['booked_days'],
                         'total_price'      => $data['total_price'],
                         'user_id'          => $this->session->userdata('user_id'),
                         'no_of_guests'     => $data['no_of_guests'],
                         'month'            => $month,
                         'year'             => $year,
        );

        $this->db->insert('tbl_booking', $new_arr);
        $bookingId = $this->db->insert_id();

        //update the reference column
        $this->db->where('id', $bookingId);
        $this->db->update('tbl_booking', array('reference' => 'GR8-00' . $bookingId));

        if($bookingId)
        {
            $date = new DateTime($data['end_date']);
            $date->modify('+1 day');

            $end_date = $date->format('Y-m-d');
            $resultp  = $this->getPropInfoByID($data['property_id']);
            $buyer    = $this->getUserInfo($this->session->userdata('user_id'));
            $owner    = $this->getUserInfo($resultp->owner_id);

            $message  = 'Booking request for '.$resultp->title.' from '.$buyer->first_name.' '.$buyer->last_name.'
                         from '.$data['start_date'].' to '.$data['end_date'].' for '.$data['booked_days'].' days with '.$data['no_of_guests'].' guests';

            $sql_pm    = 'select count(id) as recip, id as recipid, (select count(*) from tbl_pm) as npm from tbl_users where id="'.$resultp->owner_id.'"
						  GROUP BY recipid';

            $query_pm  = $this->db->query($sql_pm);
            $rs_pm     = $query_pm->row();

            if($rs_pm->recip==1)
		    {
                if($rs_pm->recipid != $this->session->userdata('user_id'))
                {
                    $message = array('subject'       => 'Booking Request for',
                                     'from_user'     => $this->session->userdata('user_id'),
                                     'to_user'       => $resultp->owner_id,
                                     'message'       => $message,
                                     'timestamp'     => time(),
                                     'is_read'       => 0,
                                     'user2read'     =>'no',
                                     'booking_id'    => $this->db->insert_id()
                    );

                    $this->db->insert('tbl_pm', $message);
                }
            }

            //notification
            $title_notes   = 'Booking request for '.$resultp->title;
            $detail_notes  = $title_notes.'. The details are as following';
            $detail_notes .= 'Property: ' . $resultp->title.'<br>';
            $detail_notes .= 'Check In: ' . $data['start_date'].'<br>';
            $detail_notes .= 'Check Out: ' . $end_date .'<br>';
            $detail_notes .= 'Total Booked Days: ' . $data['booked_days'].'<br>';
            $detail_notes .= 'No. of Guests: ' . $data['no_of_guests'] .'<br>';
            $detail_notes .= 'Total Price: ' . $data['total_price'] .'<br>';

            $notesf        = array('title'          => $title_notes,
                                   'detail'         => $detail_notes,
                                   'created_date'   => date("Y-m-d H:i:s"),
                                   'status'         => 0,
                                   'user_id'        => $resultp->owner_id);

            $this->db->insert('tbl_notifications', $notesf);

            $this->session->unset_userdata('bookingr_data');
            return $this->db->insert_id();
        }
    }

    function booking_direct($data)
    {
        $status_array   = serialize(array('bb' => 2,'oo' => 2));
        $string         = $data['start_date'];
        $day            = substr($string, 8, 2);
        $month          = substr($string, 5, 2);
        $year           = substr($string, 0, 4);
        $new_arr        = array('property_id'       => $data['property_id'],
                                'start_date'        => $data['start_date'],
                                'end_date'          => $data['end_date'],
                                'requested_date'    => date("Y-m-d H:i:s"),
                                'status'            => $status_array,
                                'booked_days'       => $data['booked_days'],
                                'total_price'       => $data['total_price'],
                                'user_id'           => $this->session->userdata('user_id'),
                                'no_of_guests'      => $data['no_of_guests'],
                                'month'             => $month,
                                'year'              => $year,
                            );

        $this->db->insert('tbl_booking', $new_arr);
	    $ret_id = $this->db->insert_id();

        //update the reference column
        $this->db->where('id', $ret_id);
        $this->db->update('tbl_booking', array('reference' => 'GR8-00' . $ret_id));
	    return $ret_id;
    }

    function getUserInfo($user_id)
    {
        $query = $this->db->get_where('tbl_users', array('id' => $user_id));
        return $query->row();
    }

    function getPropInfoByID($id)
    {
        $this->db->where('tbl_property.id',$id);
        $this->db->select('tbl_property.*, tbl_country.country_name, tbl_region.region_name, tbl_city.city_name');
        $this->db->join('tbl_country','tbl_country.id=tbl_property.country_id','left');
        $this->db->join('tbl_region','tbl_region.id=tbl_property.region_id','left');
        $this->db->join('tbl_city','tbl_city.id=tbl_property.city_id','left');
        $this->db->from('tbl_property');
        $result = $this->db->get();

        return $result->row();
    }

    /**
     * Return refertence number by booking ID
     *
     * @param $id
     * @return bool|string
     */
    public function getReferenceNoByID($id)
    {
        if(empty($id)) return false;

        $query = $this->db->get_where('tbl_users', array('id' => $id));
        $row   = $query->row();

        return (empty($id))? false:$row->reference;
    }

    /**
     * Return booking details with associated property title
     *
     * @param $id
     * @return mixed
     */
    function getBookingByID($id)
    {
        $sql = "select a.*,b.title
                from tbl_property b
                inner join tbl_booking a on a.property_id = b.id
                where a.id = '".$id."'";

        $query = $this->db->query($sql);
        return $query->row();
    }

    function post_to_url($url, $body)
    {
        $this->load->library('curl');
        $result = $this->curl->simple_get($url, $body);
        return $result;
    }

    function bookingStatusUpdate($data)
    {
		$status_array   = serialize(array('bb' => 5,'oo' => 5));
		$payment_data   = $data;
		$trans_id       = $payment_data['trans_id'];
		$booking_id     = $payment_data['id'];
		$object         = array('status' => $status_array, 'transactionID' => $trans_id);

		$this->db->where('id', $booking_id);
		$this->db->update('tbl_booking', $object);

		$file_name      = time();
		$booking_arrx   = $this->getBookingByID($booking_id);
		$buyer_id       = $booking_arrx->user_id;
		$buyer          = $this->getUserInfo($buyer_id);
		$emailAddress   = $buyer->email;

		//USE INVOICES MODEL AND CREATE INVOICE
        $CI =& get_instance();
        $CI->load->model('invoice/invoice_model');

        $invoiceModel           =  new Invoice_model();
        $data['pdf_download']   = $this->downloadEachTrnsx($booking_id);        //PDF Creation
        $html                   = $CI->load->view('invoice/booking_payment_invoice', $data, true);
        $pdfFile                = $invoiceModel->createPdfInvoice($html);

		$config['protocol']     = 'mail';
		$config['charset']      = 'iso-8859-1';
		$config['mailtype']     = 'html';
		$config['wordwrap']     = TRUE;

		$this->email->initialize($config);
		$this->email->from('info@gr8escapes.com');
		$this->email->to($emailAddress);
		$this->email->subject($file_name);

		$style  = "<style>";
		$style .= "body {";
		$style .= "font-family: Calibri, Arial";
		$style .= "}";
		$style .= "</style>";
		$message = 'Thank you for your payment. Please download attachment to see the details';

		$this->email->message($message);
		$this->email->attach($pdfFile);

        if ($this->email->send()) {
            $this->session->set_flashdata('success','<p align="center" class="error"><strong>Multiple invoices have been <span class="red_header">successfully</span> emailed! Memory Used: '.$this->benchmark->memory_usage().'</strong></p><p>&nbsp;</p>');
        } else {
            $this->session->set_flashdata('success','<p align="center" class="error"><strong>Multiple invoices have <span class="red_header">failed</span> to send!</strong></p><p>&nbsp;</p>');
        }

		$booking_data = $this->session->userdata('bookingr_data');
		$date = new DateTime($booking_data['end_date']);
		$date->modify('+1 day');
		$end_date = $date->format('Y-m-d');
		$resultp = $this->getPropInfoByID($booking_data['property_id']);
		$buyer = $this->getUserInfo($this->session->userdata('user_id'));
		$owner = $this->getUserInfo($resultp->owner_id);
		//notification
		$title_notes = 'Booking for '.$resultp->title;
		$detail_notes = $title_notes.'. The details are as following';
		$detail_notes .= 'Property: ' . $resultp->title.'<br>';
		$detail_notes .= 'Check In: ' . $booking_data['start_date'].'<br>';
		$detail_notes .= 'Check Out: ' . $end_date .'<br>';
		$detail_notes .= 'Total Booked Days: ' . $booking_data['booked_days'].'<br>';
		$detail_notes .= 'No. of Guests: ' . $booking_data['no_of_guests'] .'<br>';
		$detail_notes .= 'Total Price: ' . $booking_data['total_price'] .'<br>';
		$notesf = array('title' => $title_notes, 'detail' => $detail_notes, 'created_date' => date("Y-m-d H:i:s"), 'status' => 0, 'user_id' => $resultp->owner_id);
		$this->db->insert('tbl_notifications', $notesf); 
		//notification
		///sending emal to owner start
		$this->load->model('email/email_model');
		$this->email_model->booking_direct_email_to_owner($resultp->title, $booking_data['start_date'], $end_date, $booking_data['booked_days'], $booking_data['no_of_guests'], $booking_data['total_price'], $owner->email, $owner->first_name.' '.$owner->last_name);
		///sending emal to owner end
		///sending emal to buyer start
		$this->email_model->booking_direct_email_to_buyer($resultp->title, $booking_data['start_date'], $end_date, $booking_data['booked_days'], $booking_data['no_of_guests'], $booking_data['total_price'], $buyer->email, $buyer->first_name.' '.$buyer->last_name);
		$this->session->unset_userdata('bookingr_data');

    }
    function create_invoice($id, $file_name)
    {    
        //GET INVOICE SETTINGS AND LAYOUT
       $data['pdf_download'] = $this->downloadEachTrnsx($id);
        //DO PDF CREATION
        $html = $this->load->view('booking/pdf/each_transaction', $data, true);
        pdf_create($html, $file_name, false);
    }
    function downloadEachTrnsx($id)
    {
        $sql = "select a.*,b.title as prop_name, c.first_name as ufname, c.last_name as ulname
                from tbl_property b
                inner join tbl_booking a on a.property_id = b.id
                inner join tbl_users c on a.user_id = c.id
                where a.id = '" . $id . "'";

        $query = $this->db->query($sql);
        return $query->row();
    }
    function saveSessionTransID($trid)
    {
        $payment_data = $this->session->userdata('payment_data');
        $payment_data['trans_id'] = $trid;
        $this->session->set_userdata('payment_data',$payment_data);
    }

    /**
     * Special insertion function address verification payment
     *
     * @param array $data
     * @return bool
     */
    public function verificationProcessRequest(array $data = array())
    {
        if(empty($data)) return false;

        $status_array = serialize(array('bb' => 0,'oo' => 0));
        $new_arr = array('property_id'    => $data['property_id'],
                         'requested_date' => date("Y-m-d H:i:s"),
                         'status'         => $status_array,
                         'total_price'    => $data['total_price'],
                         'user_id'        => $this->session->userdata('user_id')
                        );

        $this->db->insert('tbl_booking', $new_arr);

        if($this->db->insert_id())
        {
            $resultp        = $this->getPropInfoByID($data['property_id']);
            $buyer          = $this->getUserInfo($this->session->userdata('user_id'));
            $owner          = $this->getUserInfo($resultp->owner_id);
            $message        = 'Address verification request for '. $resultp->title
                                                          . ' from '
                                                          . $buyer->first_name
                                                          . ' '
                                                          . $buyer->last_name;

            $sql_pm         = 'select count(id) as recip, id as recipid, (select count(*) from tbl_pm) as npm from tbl_users where id="'.$resultp->owner_id.'"
						       GROUP BY recipid';

            $query_pm       = $this->db->query($sql_pm);
            $rs_pm          = $query_pm->row();

            if($rs_pm->recip==1)
		    {
                if($rs_pm->recipid != $this->session->userdata('user_id'))
			    {
                    $id       = $rs_pm->npm+1;
                    $messagex = array('id' => $id,
                                      'id2' => '1',
                                      'title' => 'Address Verification Request for',
                                      'user1' => $this->session->userdata('user_id'),
                                      'user2' => $resultp->owner_id,
                                      'message' => $message,
                                      'timestamp' => time(),
                                      'user1read' => 'yes',
                                      'user2read' =>'no',
                                      'booking_id' => $this->db->insert_id()
                                    );

                    $this->db->insert('tbl_pm', $messagex);
                }
            }

            //notification
            $title_notes  = 'Address verification request for '.$resultp->title;
            $detail_notes = $title_notes.'. The details are as following';
            $detail_notes .= 'Property: ' . $resultp->title.'<br>';
            $detail_notes .= 'Total Price: ' . $data['total_price'] .'<br>';
            $notesf = array('title' => $title_notes, 'detail' => $detail_notes, 'created_date' => date("Y-m-d H:i:s"), 'status' => 0, 'user_id' => $resultp->owner_id);
            $this->db->insert('tbl_notifications', $notesf);
			$this->load->model('email/email_model');
			$this->email_model->booking_email_to_owner($resultp->title, null, null, 0, 0, $data['total_price'], $owner->email, $owner->first_name.' '.$owner->last_name);
			$this->email_model->booking_email_to_buyer($resultp->title, null, null, 0, 0, $data['total_price'], $buyer->email, $buyer->first_name.' '.$buyer->last_name);
            $this->session->unset_userdata('bookingr_data');

            return $this->db->insert_id();
        }
    }

    /**
     *  Direct pay for address verification
     *
     * @param array $data
     * @return bool
     */
    public function addressVerificationPaymentDirect(array $data = array())
    {
        if(empty($data)) return false;

        $status_array = serialize(array('bb' => 2,
                                        'oo' => 2));

        $new_arr = array('property_id'       => $data['property_id'],
                         'requested_date'    => date("Y-m-d H:i:s"),
                         'status'            => $status_array,
                         'total_price'       => $data['total_price'],
                         'user_id'           => $this->session->userdata('user_id')
                         );

        $this->db->insert('tbl_booking', $new_arr);
	    return $this->db->insert_id();
    }

    public function getDetailsByBookingId($id)
    {
        if(empty($id)) return false;

        $this->db->select("*");
        $this->db->from("tbl_booking");
        $this->db->where('id', $id);

        return $this->db->get()->row();
    }
}
