<?php
/**
 * Class Migration_Tbl_property
 *
 * Add two fields: cleaning_fee, cleanign_amount are added to table  tbl_property
 *
 * @author Eftakhairul Islam <eftakhairul@gmial.com>
 */
class Migration_Tbl_property extends CI_Migration
{

	public function up()
	{
        //Add two field to property table
        $migrationQuery = "ALTER TABLE `tbl_property` ADD `cleaning_amount` INT NULL AFTER `bond_amount` ,
                           ADD `cleaning_fee` TINYINT NULL AFTER `cleaning_amount`";

        //Run the query
		mysql_query($migrationQuery);
    }

	public function down()
    {
    }
}




