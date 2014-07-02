<?php

class Migration_Tbl_property extends CI_Migration
{
	public function up()
	{
		$columns = array(

			'standard_rate'      => array(
				'type'       => 'int',
				'constraint' => '11',
				'default'	=> '0',
				'null'		 =>  FALSE
				),
			'winter_rate'      => array(
				'type'       => 'int',
				'constraint' => '11',
				'default'	=> '0',
				'null'		 =>  FALSE
				),
			'holiday_rate'      => array(
				'type'       => 'int',
				'constraint' => '11',
				'default'	=> '0',
				'null'		 =>  FALSE
				),
			'summer_rate'      => array(
				'type'       => 'int',
				'constraint' => '11',
				'default'	=> '0',
				'null'		 =>  FALSE
				),
			'standard_start_date'      => array(
				'type'       => 'date',
				'null'		 =>  FALSE
				),
			'standard_end_date'      => array(
				'type'       => 'date',
				
				'null'		 =>  FALSE
				),
			'winter_start_date'      => array(
				'type'       => 'date',
				
				'null'		 =>  FALSE
				),
			'winter_end_date'      => array(
				'type'       => 'date',
				
				'null'		 =>  FALSE
				),
			'holiday_start_date'      => array(
				'type'       => 'date',
				
				'null'		 =>  FALSE
				),
			'holiday_end_date'      => array(
				'type'       => 'date',
				
				'null'		 =>  FALSE
				),
			'summer_start_date'      => array(
				'type'       => 'date',
				
				'null'		 =>  FALSE
				),
			'summer_end_date'      => array(
				'type'       => 'date',
				
				'null'		 =>  FALSE
				),
			'region_name'  => array(
				'type'        => 'VARCHAR',
				'constraint'  => '50',
				'null'		  => FALSE
				),
			'city_name'      => array(
				'type'       => 'VARCHAR',
				'constraint' => '50',
				'null'		 =>  FALSE
				),
			'how_to_reach'      => array(
				'type'       => 'VARCHAR',
				'constraint' => '50',
				'null'		 =>  FALSE
				),
			'city_suburb'      => array(
				'type'       => 'VARCHAR',
				'constraint' => '50',
				'null'		 =>  FALSE
				)
		
		);// $columns array end

		$this->dbforge->add_column('tbl_property',$columns);

		$query	=	"CREATE TABLE IF NOT EXISTS `tbl_sky_channels` (
		`id` int(10) NOT NULL AUTO_INCREMENT,
		`name` varchar(255) CHARACTER SET utf8 NOT NULL,
		`description` varchar(5000) CHARACTER SET utf8 NOT NULL,
		`status` tinyint(4) NOT NULL DEFAULT '0',
		PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1" ;
		mysql_query($query);



		$columns = array(

			'payment_method'  => array(
				'type'        => 'VARCHAR',
				'constraint'  => '50',
				'null'		  => FALSE
				),
			'paypal_id'      => array(
				'type'       => 'VARCHAR',
				'constraint' => '255',
				'null'		 =>  FALSE

				),
		);// $columns array end

		$this->dbforge->add_column('tbl_users',$columns);

		$columns = array(
			'property_approve_status'  => array(
                                         'type'        => 'INT',
                                         'constraint'  => '2',
                                         'default'	   => '0',
                                         'null'		  =>  FALSE
                                         ),
			'expire_date'              => array(
                                         'type'       => 'date',
                                         'null'	      =>  TRUE
                                          )
		);

		$this->dbforge->add_column('tbl_property',$columns);
		$upMigrationQuery = "INSERT INTO `tbl_pages` (`page_title`, `meta_description`, `page_name`, `page_description`, `status`) VALUES
('Address Verification', 'Address Verification', 'Address Verification', '&lt;p&gt;\n                             Address Verified helps create a more trusted online marketplace.&lt;/p&gt;\n                            &lt;p&gt;\n                             &lt;b&gt;Owners&lt;/b&gt; who have verified their escape address will receive an envelope icon &lt;img src=&quot;/assets/frontend/images/Envelope.png&quot; /&gt; showing on their escape listing.&lt;/p&gt;\n                            &lt;p&gt;\n                             &lt;b&gt;For Guests&lt;/b&gt; who have verified their home address where they permanently reside they will also receive the envelope icon &lt;img src=&quot;/assets/frontend/images/Envelope.png&quot; /&gt;&lt;/p&gt;\n                            &lt;p&gt;\n                             &lt;b&gt;How do I get an Address Verified icon?&lt;/b&gt;&lt;br /&gt;\n                             We verify your street address by sending you a personal verification code in the post.&lt;/p&gt;\n                            &lt;p&gt;\n                             When you receive your code you enter it into Gr8 Escapes (from your dashboard) to complete the process. The code is unique to you and can only be used to verify the address for which you requested it.&lt;/p&gt;\n                            &lt;p&gt;\n                             &lt;b&gt;What are the benefits to Owners?&lt;/b&gt;&lt;br /&gt;\n                             Guests can make bookings from &amp;quot;Address Verified&amp;quot; Owners with greater confidence. Owners are therefore likely to increase the number of bookings they receive by showing the envelope icon &lt;img src=&quot;/assets/frontend/images/Envelope.png&quot; /&gt;&lt;/p&gt;\n                            &lt;p&gt;\n                             &lt;b&gt;What are the benefits to Guests?&lt;/b&gt;&lt;br /&gt;\n                             Owners prefer trusted Guests. It reduces the risk of the Guest behaving dishonestly or pulling-out of a booking - a real time-waster.&lt;/p&gt;\n                            &lt;p&gt;\n                             &lt;b&gt;Can Gr8 Escapes guarantee where an Owner&amp;rsquo;s Escape is located?&lt;/b&gt;&lt;br /&gt;\n                             We can&amp;#39;t guarantee the specific street address. Gr8 Escapes does, however, know with some confidence that the individual that signed-in and requested to become Address Verified is the same person that entered the Personal Verification Code we sent them.&lt;/p&gt;\n                            &lt;p&gt;\n                             &lt;b&gt;What if I move?&lt;/b&gt;&lt;br /&gt;\n                             You retain your Address Verified status when you move. Please keep your address details up to date on Gr8 Escapes.&lt;/p&gt;\n                            &lt;p&gt;\n                             &lt;b&gt;Does my Address Verified status expire?&lt;/b&gt;&lt;br /&gt;\n                             Your Address Verified status is valid for two years. After this time you will be required to apply to be &amp;quot;Address Verified&amp;quot; again. We will send you a reminder email six weeks before your status is due to expire.&lt;/p&gt;\n                            &lt;p&gt;\n                             &lt;b&gt;How much does it cost for Address Verified?&lt;/b&gt;&lt;br /&gt;\n                             Address Verified process costs $4.00 NZD + GST, you pay this after submitting your address details.&lt;/p&gt;\n                            &lt;p&gt;\n                             &lt;b&gt;Your privacy&lt;/b&gt;&lt;br /&gt;\n                             Protecting your personal information is very important to us.&lt;/p&gt;\n                            &lt;p&gt;\n                             In certain circumstances, Gr8 Escapes may be legally required to disclose personal information of a member for legal compliance/law enforcement reasons, as outlined in our privacy policy.&lt;/p&gt;\n                            &lt;p&gt;\n                             Your details may be made available to another Gr8 Escapes member when a statutory declaration is made requesting contact details for the sole purpose of making a Disputes Tribunal claim.&lt;/p&gt;\n                            &lt;p&gt;\n                             &lt;b&gt;Conditions&lt;/b&gt;&lt;br /&gt;\n                             Address Verified is optional. You must use a physical street address and cannot use a PO Box. Address Verified letters are can be sent anywhere in the world.&lt;/p&gt;\n                            &lt;p&gt;\n                             &lt;b&gt;Register Now&lt;/b&gt;&lt;br /&gt;\n                             It is free to renew your Address Verified status.&lt;/p&gt;\n                            &lt;p&gt;\n                             We will email you when we send your verification code. If you don&amp;#39;t receive the letter within 7 days of the email, we will send it again to the same address at no additional cost.&lt;/p&gt;\n                            ', 1);
";



        $this->db->query($upMigrationQuery);	
        $columns = array(
			'send_date' => array('type'       => 'date',
                                 'null'	      =>  TRUE
                           )
		);

		$this->dbforge->add_column('tbl_property',$columns);
		$update_query	=	'ALTER TABLE tbl_property
							ADD COLUMN `standard_price_night` float(10,2) NOT NULL AFTER `contact_name`,
							ADD COLUMN `standard_price_week` float(10,2) NOT NULL AFTER `standard_price_night`,
							ADD COLUMN `standard_price_month` float(10,2) NOT NULL AFTER `standard_price_week`,
							ADD COLUMN `winter_price_night` float(10,2) NOT NULL AFTER `standard_price_month`,
							ADD COLUMN `winter_price_week` float(10,2) NOT NULL AFTER `winter_price_night`,
							ADD COLUMN `winter_price_month` float(10,2) NOT NULL AFTER `winter_price_week`,
							ADD COLUMN `holiday_price_night` float(10,2) NOT NULL AFTER `winter_price_month`,
							ADD COLUMN `holiday_price_week` float(10,2) NOT NULL AFTER `holiday_price_night`,
							ADD COLUMN `holiday_price_month` float(10,2) NOT NULL AFTER `holiday_price_week`,
							ADD COLUMN `summer_price_night` float(10,2) NOT NULL AFTER `holiday_price_month`,
							ADD COLUMN `summer_price_week` float(10,2) NOT NULL AFTER `summer_price_night`,
							ADD COLUMN `summer_price_month` float(10,2) NOT NULL AFTER `summer_price_week`';
		
		mysql_query($update_query);
		
		$add_query	=	'CREATE TABLE IF NOT EXISTS `tbl_property_sky_channels` (
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`property_id` int(11) NOT NULL,
		`sky_channel_id` int(11) NOT NULL,
		PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1';
		mysql_query($add_query);
		$columns = array(

			'status'  => array(
				'type'        => 'INT',
				'constraint'  => '11',
				'null'		  => FALSE
				),
		);// $columns array end

		$this->dbforge->add_column('tbl_property_images',$columns);
		$columns = array(
                        'check_in_date' => array(
                                                         'name' => 'check_in_date',
                                                         'type' => 'time'
                                                ),
						'check_out_date' => array(
                                                         'name' => 'check_out_date',
                                                         'type' => 'time'
                                                )
						
					);

		$this->dbforge->modify_column('tbl_property',$columns);
		$upTableQuery = "ALTER TABLE  `tbl_pages` ADD  `url` VARCHAR( 255 ) NOT NULL";
        $this->db->query($upTableQuery);	
	}
		public function down(){}
}

?>