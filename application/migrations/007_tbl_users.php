<?php
/**
 * Class Migration_Tbl_users
 *
 * Add unique account_number column to tbl_users
 *
 * @author Eftakhairul Islam <eftakhairul@gmail.com>
 */
class Migration_Tbl_users extends CI_Migration
{

	public function up()
	{
            //create new column: account_number in tbl_users
            $migrationQuery = "ALTER TABLE `tbl_users` ADD `account_number` INT( 8 ) NULL AFTER `paypal_id` ";

            //Run the query
            mysql_query($migrationQuery);


            //Update the exiting column again
            $migrationQuery = "UPDATE `tbl_users` SET `account_number` = 1000011+ id";

            //Run the query
            mysql_query($migrationQuery);
    }

	public function down()
    {
    }
}