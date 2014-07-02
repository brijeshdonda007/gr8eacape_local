<?php

class Migration_Tbl_page extends CI_Migration
{
	public function up()
	{
		$upTableQuery = "ALTER TABLE  `tbl_pages` ADD  `url` VARCHAR( 255 ) NOT NULL";
        $this->db->query($upTableQuery);	
	}
		public function down(){}
}

?>