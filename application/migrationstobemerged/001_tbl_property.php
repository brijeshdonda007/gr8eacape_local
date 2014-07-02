<?php
/**
 * Class Migration_Tbl_property
 *
 * Multiple table update q
 *
 * @author Eftakhairul Islam <eftakhairul@gmial.com>
 */
class Migration_Tbl_property extends CI_Migration
{
    /**
     * Forward Migration
     */
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
		
		);


		$this->dbforge->add_column('tbl_property',$columns);



        $migrationQuery	=	"CREATE TABLE IF NOT EXISTS `tbl_sky_channels` (
		                     `id` int(10) NOT NULL AUTO_INCREMENT,
		                     `name` varchar(255) CHARACTER SET utf8 NOT NULL,
		                     `description` varchar(5000) CHARACTER SET utf8 NOT NULL,
		                     `status` tinyint(4) NOT NULL DEFAULT '0',
		                     PRIMARY KEY (`id`)
		                      ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT = 1" ;
        //Run the query
		mysql_query($migrationQuery);



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
		);

		$this->dbforge->add_column('tbl_users',$columns);

		$columns = array('property_approve_status'  => array(
                         'type'                     => 'INT',
                         'constraint'               => '2',
                         'default'	                => '0',
                         'null'		                =>  FALSE
                                         ),
			            'expire_date'               => array(
                         'type'                     => 'date',
                         'null'             	    =>  TRUE
                                          )
		        );

		$this->dbforge->add_column('tbl_property',$columns);

		$upMigrationQuery = "INSERT INTO `tbl_pages` (`page_title`, `meta_description`, `page_name`, `page_description`, `status`) VALUES
                             ('Address Verification', 'Address Verification', 'Address Verification', '&lt;p&gt;\n                             Address Verified helps create a more trusted online marketplace.&lt;/p&gt;\n                            &lt;p&gt;\n                             &lt;b&gt;Owners&lt;/b&gt; who have verified their escape address will receive an envelope icon &lt;img src=&quot;/assets/frontend/images/Envelope.png&quot; /&gt; showing on their escape listing.&lt;/p&gt;\n                            &lt;p&gt;\n                             &lt;b&gt;For Guests&lt;/b&gt; who have verified their home address where they permanently reside they will also receive the envelope icon &lt;img src=&quot;/assets/frontend/images/Envelope.png&quot; /&gt;&lt;/p&gt;\n                            &lt;p&gt;\n                             &lt;b&gt;How do I get an Address Verified icon?&lt;/b&gt;&lt;br /&gt;\n                             We verify your street address by sending you a personal verification code in the post.&lt;/p&gt;\n                            &lt;p&gt;\n                             When you receive your code you enter it into Gr8 Escapes (from your dashboard) to complete the process. The code is unique to you and can only be used to verify the address for which you requested it.&lt;/p&gt;\n                            &lt;p&gt;\n                             &lt;b&gt;What are the benefits to Owners?&lt;/b&gt;&lt;br /&gt;\n                             Guests can make bookings from &amp;quot;Address Verified&amp;quot; Owners with greater confidence. Owners are therefore likely to increase the number of bookings they receive by showing the envelope icon &lt;img src=&quot;/assets/frontend/images/Envelope.png&quot; /&gt;&lt;/p&gt;\n                            &lt;p&gt;\n                             &lt;b&gt;What are the benefits to Guests?&lt;/b&gt;&lt;br /&gt;\n                             Owners prefer trusted Guests. It reduces the risk of the Guest behaving dishonestly or pulling-out of a booking - a real time-waster.&lt;/p&gt;\n                            &lt;p&gt;\n                             &lt;b&gt;Can Gr8 Escapes guarantee where an Owner&amp;rsquo;s Escape is located?&lt;/b&gt;&lt;br /&gt;\n                             We can&amp;#39;t guarantee the specific street address. Gr8 Escapes does, however, know with some confidence that the individual that signed-in and requested to become Address Verified is the same person that entered the Personal Verification Code we sent them.&lt;/p&gt;\n                            &lt;p&gt;\n                             &lt;b&gt;What if I move?&lt;/b&gt;&lt;br /&gt;\n                             You retain your Address Verified status when you move. Please keep your address details up to date on Gr8 Escapes.&lt;/p&gt;\n                            &lt;p&gt;\n                             &lt;b&gt;Does my Address Verified status expire?&lt;/b&gt;&lt;br /&gt;\n                             Your Address Verified status is valid for two years. After this time you will be required to apply to be &amp;quot;Address Verified&amp;quot; again. We will send you a reminder email six weeks before your status is due to expire.&lt;/p&gt;\n                            &lt;p&gt;\n                             &lt;b&gt;How much does it cost for Address Verified?&lt;/b&gt;&lt;br /&gt;\n                             Address Verified process costs $4.00 NZD + GST, you pay this after submitting your address details.&lt;/p&gt;\n                            &lt;p&gt;\n                             &lt;b&gt;Your privacy&lt;/b&gt;&lt;br /&gt;\n                             Protecting your personal information is very important to us.&lt;/p&gt;\n                            &lt;p&gt;\n                             In certain circumstances, Gr8 Escapes may be legally required to disclose personal information of a member for legal compliance/law enforcement reasons, as outlined in our privacy policy.&lt;/p&gt;\n                            &lt;p&gt;\n                             Your details may be made available to another Gr8 Escapes member when a statutory declaration is made requesting contact details for the sole purpose of making a Disputes Tribunal claim.&lt;/p&gt;\n                            &lt;p&gt;\n                             &lt;b&gt;Conditions&lt;/b&gt;&lt;br /&gt;\n                             Address Verified is optional. You must use a physical street address and cannot use a PO Box. Address Verified letters are can be sent anywhere in the world.&lt;/p&gt;\n                            &lt;p&gt;\n                             &lt;b&gt;Register Now&lt;/b&gt;&lt;br /&gt;\n                             It is free to renew your Address Verified status.&lt;/p&gt;\n                            &lt;p&gt;\n                             We will email you when we send your verification code. If you don&amp;#39;t receive the letter within 7 days of the email, we will send it again to the same address at no additional cost.&lt;/p&gt;\n                            ', 1);";
        $this->db->query($upMigrationQuery);


        $columns = array(
			'send_date' => array('type'       => 'date',
                                 'null'	      =>  TRUE
                           )
		);

		$this->dbforge->add_column('tbl_property',$columns);


		$migrationquery	=  'ALTER TABLE tbl_property
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
		
		mysql_query($migrationquery);
		
		$migrationquery	= 'CREATE TABLE IF NOT EXISTS `tbl_property_sky_channels` (
                           `id` int(11) NOT NULL AUTO_INCREMENT,
                           `property_id` int(11) NOT NULL,
                           `sky_channel_id` int(11) NOT NULL,
                            PRIMARY KEY (`id`)
                            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1';

		mysql_query($migrationquery);

		$columns = array(
			'status'  => array(
				'type'        => 'INT',
				'constraint'  => '11',
				'null'		  => FALSE
				),
		);

		$this->dbforge->add_column('tbl_property_images',$columns);

		$columns = array('check_in_date' => array('name' => 'check_in_date',
                                                  'type' => 'time'
                                                 ),
						'check_out_date' => array('name' => 'check_out_date',
                                                  'type' => 'time'
                                                )
						
					);

		$this->dbforge->modify_column('tbl_property',$columns);

        //Adding URL
		$upTableQuery = "ALTER TABLE  `tbl_pages` ADD  `url` VARCHAR( 255 ) NOT NULL";
        $this->db->query($upTableQuery);


        //Adding page
        $upTableQuery = "ALTER TABLE  `tbl_pages` ADD  `url` VARCHAR( 255 ) NOT NULL";
        $this->db->query($upTableQuery);

        //New table tbl_verification_payment is added
        $migrationQuery	=   "CREATE TABLE IF NOT EXISTS `tbl_verification_payment` (
                              `id` int(11) NOT NULL AUTO_INCREMENT,
                              `user_id` int(11) NOT NULL,
                              `property_id` int(11) DEFAULT NULL,
                              `total_amount` decimal(10,0) NOT NULL,
                              `verification_name` varchar(50) DEFAULT NULL,
                              `status` tinyint(2) NOT NULL DEFAULT '0',
                              `transaction_id` varchar(50) DEFAULT NULL,
                              `create_dater` date NOT NULL,
                              `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                              PRIMARY KEY (`id`),
                              KEY `user_id` (`user_id`,`property_id`)
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1" ;

        //Run the query
		mysql_query($migrationQuery);


        //property_approve_status drops from tbl_property table
        $migrationQuery	=   "ALTER TABLE `tbl_property` DROP `property_approve_status`" ;

        //Run the query
		mysql_query($migrationQuery);

        //New field  television_ created in tbl_sky_channels table
        $migrationQuery = "ALTER TABLE `tbl_sky_channels` ADD `television_type` INT NOT NULL AFTER `status`";

        //Run the query
		mysql_query($migrationQuery);

        /**
         *	Create TV channel table
         */
        $migrationQuery = "CREATE TABLE IF NOT EXISTS `tbl_tv_channels` (
                          `id` int(11) NOT NULL AUTO_INCREMENT,
                          `tv_category` varchar(255) NOT NULL,
                          `status` int(11) NOT NULL,
                          PRIMARY KEY (`id`)
                          ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT = 1";

        //Run the query
		mysql_query($migrationQuery);



		/*
		* Insert into TV channels
		*/
		$migrationQuery = "INSERT INTO `tbl_tv_channels` (`id`, `tv_category`, `status`) VALUES
                           (1, 'Sky TV', 1),
                           (2, 'Freeview', 1),
                           (3, 'Not Supplied', 1)";

		//Run the query
		mysql_query($migrationQuery);

		/**
		*  Truncating category table
		*/
		$migrationQuery = "truncate table tbl_category";

		//Run the query
		mysql_query($migrationQuery);



	    /**
		 *	Populating category table
		 */
		$migrationQuery = "INSERT INTO `tbl_category` (`id`, `category_title`, `category_status`, `category_description`) VALUES
                            (1, 'Family Friendly', 1, ''),
                            (2, 'Romantic', 1, ''),
                            (3, 'Honeymooners', 1, ''),
                            (4, 'Adventure Junkies', 1, ''),
                            (5, 'Tranquillity Seekers', 1, ''),
                            (6, 'Nature Lovers', 1, ''),
                            (7, 'Peace & Harmony', 1, ''),
                            (8, 'Beach Activities', 1, ''),
                            (9, 'Beachfront', 1, ''),
                            (10, 'Fitness', 1, ''),
                            (11, 'Bush', 1, ''),
                            (12, 'Health & Wellness', 1, ''),
                            (13, 'Mountains', 1, ''),
                            (14, 'Sport', 1, ''),
                            (15, 'Historical Value', 1, ''),
                            (16, 'Cultural Experience', 1, ''),
                            (17, 'Wilderness', 1, ''),
                            (18, 'Animal Lovers', 1, ''),
                            (19, 'Farm', 1, ''),
                            (20, 'Hunting', 1, ''),
                            (21, 'Fishing', 1, ''),
                            (22, 'Snow', 1, ''),
                            (23, 'Sea Lovers', 1, ''),
                            (24, 'Lakes', 1, ''),
                            (25, 'Scenic Sights', 1, ''),
                            (26, 'Rivers', 1, ''),
                            (27, 'Iconic Places', 1, '')";

				//Run the query
		        mysql_query($migrationQuery);


			   /**
				* Truncating sky channel table
				*/
				$migrationQuery = "truncate table tbl_sky_channels";


				//Run the query
		        mysql_query($migrationQuery);



			   /**
				* Populating sky channels
				*/
				$migrationQuery = "INSERT INTO `tbl_sky_channels` (`id`, `name`, `description`, `television_type`, `status`) VALUES
                                    (1, 'TV One', 'TV One', 1, 1),
                                    (2, 'TV2', 'TV2', 1, 1),
                                    (3, 'TV3', 'TV3', 1, 1),
                                    (4, 'Prime', 'Prime', 1, 1),
                                    (5, 'The BOX', 'The BOX', 1, 1),
                                    (6, 'Vibe', 'Vibe', 1, 1),
                                    (7, 'UK TV', 'UK TV', 1, 1),
                                    (8, 'The Living Channel', 'The Living Channel', 1, 1),
                                    (9, 'Food Television', 'Food Television', 1, 1),
                                    (10, 'Soho', 'Soho', 1, 1),
                                    (11, 'E!', 'E!', 1, 1),
                                    (12, 'FOUR', 'FOUR', 1, 1),
                                    (13, 'Jones', 'Jones', 1, 1),
                                    (14, 'MTV', 'MTV', 1, 1),
                                    (15, 'Comedy Central', 'Comedy Central', 1, 1),
                                    (16, 'TVNZ Heartland', 'TVNZ Heartland', 1, 1),
                                    (17, 'The Shopping Channel', 'The Shopping Channel', 1, 1),
                                    (18, 'Maori Television', 'Maori Television', 1, 1),
                                    (19, 'YESSHOP', 'YESSHOP', 1, 1),
                                    (20, 'TVSN', 'TVSN', 1, 1),
                                    (21, 'Travel Channel', 'Travel Channel', 1, 1),
                                    (22, 'Choice TV', 'Choice TV', 1, 1),
                                    (23, 'The Arts Channel', 'The Arts Channel', 1, 1),
                                    (24, 'TV One Plus 1', 'TV One Plus 1', 1, 1),
                                    (25, 'TV3 Plus 1', 'TV3 Plus 1', 1, 1),
                                    (26, 'SKY Sport 1', 'SKY Sport 1', 1, 1),
                                    (27, 'SKY Sport 2', 'SKY Sport 2', 1, 1),
                                    (28, 'SKY Sport 3', 'SKY Sport 3', 1, 1),
                                    (29, 'SKY Sport 4', 'SKY Sport 4', 1, 1),
                                    (30, 'SKY Sport 5', 'SKY Sport 5', 1, 1),
                                    (31, 'SKY Sport 6', 'SKY Sport 6', 1, 1),
                                    (32, 'ESPN', 'ESPN', 1, 1),
                                    (33, 'TAB TV', 'TAB TV', 1, 1),
                                    (34, 'Trackside', 'Trackside', 1, 1),
                                    (35, 'The Rugby Channel', 'The Rugby Channel', 1, 1),
                                    (36, 'SM Premiere', 'SM Premiere', 1, 1),
                                    (37, 'SKY Movies Extra', 'SKY Movies Extra', 1, 1),
                                    (38, 'SKY Movies Greats', 'SKY Movies Greats', 1, 1),
                                    (39, 'SKY Movies Classics', 'SKY Movies Classics', 1, 1),
                                    (40, 'SM Action', 'SM Action', 1, 1),
                                    (41, 'Radio Channel', 'Radio Channel', 1, 1),
                                    (42, 'TCM', 'TCM', 1, 1),
                                    (43, 'MTV Hits', 'MTV Hits', 1, 1),
                                    (44, 'MTV Classic', 'MTV Classic', 1, 1),
                                    (45, 'Juice TV', 'Juice TV', 1, 1),
                                    (46, 'J2', 'J2', 1, 1),
                                    (47, 'C4', 'C4', 1, 1),
                                    (48, 'Disney Channel', 'Disney Channel', 1, 1),
                                    (49, 'Nickelodeon', 'Nickelodeon', 1, 1),
                                    (50, 'Cartoon Network', 'Cartoon Network', 1, 1),
                                    (51, 'Nick Jr.', 'Nick Jr.', 1, 1),
                                    (52, 'Disney Junior', 'Disney Junior', 1, 1),
                                    (53, 'TVNZ kidzone24', 'TVNZ kidzone24', 1, 1),
                                    (54, 'Aljazeera', 'Aljazeera', 1, 1),
                                    (55, 'Discovery', 'Discovery', 1, 1),
                                    (56, 'Crime & Investigation Network', 'Crime & Investigation Network', 1, 1),
                                    (57, 'National Geographic', 'National Geographic', 1, 1),
                                    (58, 'The History Channel', 'The History Channel', 1, 1),
                                    (59, 'BBC Knowledge', 'BBC Knowledge', 1, 1),
                                    (60, 'Animal Planet', 'Animal Planet', 1, 1),
                                    (61, 'Country TV', 'Country TV', 1, 1),
                                    (62, 'Face TV', 'Face TV', 1, 1),
                                    (63, 'Sky News NZ', 'Sky News NZ', 1, 1),
                                    (64, 'CNN', 'CNN', 1, 1),
                                    (65, 'Fox News Channel', 'Fox News Channel', 1, 1),
                                    (66, 'BBC World News', 'BBC World News', 1, 1),
                                    (67, 'Parliament TV', 'Parliament TV', 1, 1),
                                    (68, 'CNBC', 'CNBC', 1, 1),
                                    (69, 'RT', 'RT', 1, 1),
                                    (70, 'FRANCE  24 French', 'FRANCE  24 French', 1, 1),
                                    (71, 'SKY Box Office 121', 'SKY Box Office 121', 1, 1),
                                    (72, 'SKY Box Office 122', 'SKY Box Office 122', 1, 1),
                                    (73, 'SKY Box Office 123', 'SKY Box Office 123', 1, 1),
                                    (74, 'SKY Box Office 124', 'SKY Box Office 124', 1, 1),
                                    (75, 'SKY Box Office 125', 'SKY Box Office 125', 1, 1),
                                    (76, 'SKY Box Office 126', 'SKY Box Office 126', 1, 1),
                                    (77, 'SKY Box Office 127', 'SKY Box Office 127', 1, 1),
                                    (78, 'SKY Box Office 128', 'SKY Box Office 128', 1, 1),
                                    (79, 'SKY Box Office 129', 'SKY Box Office 129', 1, 1),
                                    (80, 'SKY Box Office 130', 'SKY Box Office 130', 1, 1),
                                    (81, 'SKY Box Office 131', 'SKY Box Office 131', 1, 1),
                                    (82, 'CUE', 'CUE', 1, 1),
                                    (83, 'Shine TV', 'Shine TV', 1, 1),
                                    (84, 'Daystar', 'Daystar', 1, 1),
                                    (85, 'WTV JTV', 'WTV JTV', 1, 1),
                                    (86, 'WTV CTV1', 'WTV CTV1', 1, 1),
                                    (87, 'WTV CTV2', 'WTV CTV2', 1, 1),
                                    (88, 'WTV CTV3', 'WTV CTV3', 1, 1),
                                    (89, 'WTV CTV4', 'WTV CTV4', 1, 1),
                                    (90, 'WTV CTV5', 'WTV CTV5', 1, 1),
                                    (91, 'WTV CTV6', 'WTV CTV6', 1, 1),
                                    (92, 'WTV KTV1', 'WTV KTV1', 1, 1),
                                    (93, 'WTV CTV7', 'WTV CTV7', 1, 1),
                                    (94, 'WTV KTV2', 'WTV KTV2', 1, 1),
                                    (95, 'CCTV News', 'CCTV News', 1, 1),
                                    (96, 'WTV Real Good Life', 'WTV Real Good Life', 1, 1),
                                    (97, 'WTV New Supremo', 'WTV New Supremo', 1, 1),
                                    (98, 'STAR Plus Hindi Channel', 'STAR Plus Hindi Channel', 1, 1),
                                    (99, 'FreeView1', 'FreeView1', 2, 1),
                                    (100, 'FreeView2', 'FreeView2', 2, 1)";

				//Run the query
		        mysql_query($migrationQuery);
	}


    /**
     * Backward Query
     */
    public function down()
    {
    }

}