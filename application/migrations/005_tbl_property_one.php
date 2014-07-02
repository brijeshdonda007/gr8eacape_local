<?php

/**
 * Class Migration_Tbl_property
 *
 * Add 8 fields: cleaning , cleaner_first_name, cleaner_last_name, cleaner_email, cleaner_phone, cleaner_home_phone,arrange_cleaning,bed_lines are added to table  tbl_property
 *
 * @author Anoop Varghese <meanoopvarghese@gmail.com>
 */
class Migration_Tbl_property_one extends CI_Migration {

    public function up() {
        
        //Add 8 field to property table
        $migrationQuery = "ALTER TABLE `tbl_property` ADD `cleaning` INT NOT NULL AFTER `bond_amount`";
        mysql_query($migrationQuery);
        
        $migrationQuery = "ALTER TABLE `tbl_property` ADD `cleaner_first_name` VARCHAR( 255 ) NOT NULL AFTER `cleaning_fee` ,
                           ADD `cleaner_last_name` VARCHAR( 255 ) NOT NULL AFTER `cleaner_first_name` ,
                           ADD `cleaner_email` VARCHAR( 255 ) NOT NULL AFTER `cleaner_last_name` ,
                           ADD `cleaner_phone` VARCHAR( 255 ) NOT NULL AFTER `cleaner_email` ,
                           ADD `cleaner_home_phone` VARCHAR( 255 ) NOT NULL AFTER `cleaner_phone` ,
                           ADD `arrange_cleaning` INT NOT NULL AFTER `cleaner_home_phone` ,
                           ADD `bed_lines` INT NOT NULL AFTER `arrange_cleaning`";
        mysql_query($migrationQuery);
        
    }
    public function down() {
        
    }
}