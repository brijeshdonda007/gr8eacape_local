<?php
/**
 * Class Migration_Tbl_booking
 *
 * Update reference table and generate new reference numbers
 *
 * @author Eftakhairul Islam <eftakhairul@gmail.com>
 */
class Migration_Tbl_book extends CI_Migration
{

	public function up()
	{
            //Reference field
            $migrationQuery = "UPDATE tbl_booking SET `reference` = ''";

            //Run the query
            mysql_query($migrationQuery);

            //Update the exiting rows again
            $migrationQuery = "UPDATE tbl_booking SET `reference` = CONCAT('GR8-00', id)";

            //Run the query
            mysql_query($migrationQuery);
    }

	public function down()
    {
    }
}