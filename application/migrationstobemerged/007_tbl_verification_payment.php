<?php


/**
 * Class Migration_Tbl_verification_payment
 *
 * New table tbl_verification_payment is added
 *
 * @author Eftakhairul Islam <eftakhairul@gmial.com>
 */
class Migration_Tbl_verification_payment extends CI_Migration
{
    /**
     *
     */
    public function up()
	{
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
	}

    /**
     *
     */
    public function down() {}
}