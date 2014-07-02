<?php
/**
 * Class Migration_Tbl_property_tv_channels
 *
 * New table: tbl_property_tv_channels is created here
 *
 * @author Eftakhairul Islam <eftakhairul@gmial.com>
 */
class Migration_Tbl_property_tv_channels extends CI_Migration
{

	public function up()
	{
        //create new table
        $migrationQuery = "CREATE TABLE IF NOT EXISTS `tbl_property_tv_channels` (
                          `id` int(11) NOT NULL AUTO_INCREMENT,
                          `property_id` int(11) NOT NULL,
                          `tv_channel_id` int(11) NOT NULL,
                           PRIMARY KEY (`id`)
                           ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
                           SET FOREIGN_KEY_CHECKS=1;";

        //Run the query
		mysql_query($migrationQuery);
    }

	public function down()
    {
    }
}




