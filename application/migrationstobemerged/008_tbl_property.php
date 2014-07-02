<?php

/**
 * Class Migration_Tbl_property
 *
 * One filed: property_approve_status drops from tbl_property table
 *
 * @author Eftakhairul Islam <eftakhairul@gmial.com>
 */
class Migration_Tbl_property extends CI_Migration
{
	public function up()
	{
		$migrationQuery	=   "ALTER TABLE `tbl_property` DROP `property_approve_status`" ;

        //Run the query
		mysql_query($migrationQuery);
	}

	public function down() {}
}