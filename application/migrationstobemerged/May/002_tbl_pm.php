<?php
/**
 * Class Migration_Tbl_property
 *
 * PM table is updated
 *
 * @author Eftakhairul Islam <eftakhairul@gmial.com>
 */
class Migration_Tbl_pm extends CI_Migration
{

	public function up()
	{
        //New field  television_ created in tbl_sky_channels table
        $migrationQuery = "ALTER TABLE `tbl_pm` CHANGE `user1read` `is_read` TINYINT( 2 ) NOT NULL DEFAULT '0'";

        //Run the query
		mysql_query($migrationQuery);

        //Some fields name are changed. Owner became from_user
        $migrationQuery = "ALTER TABLE `tbl_pm` CHANGE `owner` `to_user` BIGINT( 20 ) NULL";

        //Run the query
		mysql_query($migrationQuery);

        //Some fields name are changed. Escape person became to_user
        $migrationQuery = "ALTER TABLE `tbl_pm` CHANGE `escape_person` `from_user` BIGINT( 20 ) NULL";

        //Run the query
		mysql_query($migrationQuery);
    }

	public function down()
    {
    }
}