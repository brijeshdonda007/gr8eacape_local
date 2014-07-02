<?php
/**
 * Class Migration_Tbl_booking
 *
 * It adds a new field:reference to the booking table
 *
 * @author Eftakhairul Islam <eftakhairul@gmail.com>
 */
class Migration_Tbl_booking extends CI_Migration
{

	public function up()
	{
            //Reference field
            $migrationQuery = "ALTER TABLE `tbl_booking` ADD `reference` VARCHAR( 20 ) NULL AFTER `id`";

            //Run the query
            mysql_query($migrationQuery);

            //Update the exiting rows
            $migrationQuery = "UPDATE tbl_booking SET `reference` = CONCAT('GR8-', id)";

            //Run the query
            mysql_query($migrationQuery);
    }

	public function down()
    {
    }
}