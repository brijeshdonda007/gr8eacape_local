<?php
/**
 * Class Migration_Tbl_property
 *
 * Auto_increment is added to the table
 *
 * @author Eftakhairul Islam <eftakhairul@gmial.com>
 */
class Migration_Tbl_pm extends CI_Migration
{

	public function up()
	{
        //Make table empty
        $migrationQuery = "TRUNCATE TABLE `tbl_pm`";

        //Run the query
		mysql_query($migrationQuery);

        //make the id as primary
        $migrationQuery = "ALTER TABLE `tbl_pm` ADD PRIMARY KEY ( `id` )";

        //Run the query
		mysql_query($migrationQuery);

        //Add the auto_increment to id
        $migrationQuery = "ALTER TABLE `tbl_pm` CHANGE `id` `id` BIGINT( 20 ) NOT NULL AUTO_INCREMENT";

        //Run the query
		mysql_query($migrationQuery);
    }

	public function down()
    {
    }
}




