<?php

/**
 * Class Migration_Tbl_property
 *
 * Add two fields: phone , min_nights are added to table  tbl_property
 *
 * @author Sajjad Saleem <sajjad.saleem@hotmail.com>
 */
class Migration_Tbl_property extends CI_Migration {

    public function up() {
        
        //Add two field to property table
        $migrationQuery = "ALTER TABLE `tbl_property` ADD `phone` VARCHAR( 20 ) NULL COMMENT 'escape phone' AFTER `youtube_video_id`";
        mysql_query($migrationQuery);
        
        $migrationQuery = "ALTER TABLE `tbl_property` ADD `min_nights` INT NOT NULL AFTER `summer_end_date`";
        mysql_query($migrationQuery);
        
    }

    public function down() {
        
    }

}

