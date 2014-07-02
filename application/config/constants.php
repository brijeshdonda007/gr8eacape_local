<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * define the image upload path
 */
define('UPLOAD_PATH_PRODUCT', $_SERVER['DOCUMENT_ROOT']."/images/product_img/");
define('UPLOAD_PATH_BANNER', $_SERVER['DOCUMENT_ROOT']."/greatescapes/images/banner_img/");
define('UPLOAD_PATH_GALLERY', $_SERVER['DOCUMENT_ROOT']."/greatescapes/images/gallery_img/");
define('UPLOAD_PATH_CHECK', $_SERVER['DOCUMENT_ROOT']."/greatescapes/");
define('UPLOAD_PATH_PAGE', $_SERVER['DOCUMENT_ROOT']."/greatescapes/images/page_img/");
define('ARTICLE_PAGE_IMAGE', $_SERVER['DOCUMENT_ROOT']."/greatescapes/images/page_img/");
define('UPLOAD_PATH_PROFILE', $_SERVER['DOCUMENT_ROOT']."/greatescapes/images/profile_img/");

/*

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* End of file constants.php */
/* Location: ./application/config/constants.php */