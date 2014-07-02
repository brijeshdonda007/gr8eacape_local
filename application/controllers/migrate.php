<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Migrate extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('migration');
	}

	public function index()
	{
		$version = $this->uri->segment(2);

		if($version === FALSE)
		{
			echo '<h1>Please Enter A Version Number</h1>';
		}else{

			$migration = $this->migration->version($version);

			if(!$migration)
			{
				echo $this->migration->error_string();
			}else{
				echo 'Migrations done'.PHP_EOL;
			}

		}
	}
}

?>