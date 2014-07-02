<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');


include_once( BASEPATH . '/helpers/form_helper'.EXT);
//include_once("./ckeditor/ckeditor.php");
//include_once("./ckfinder/ckfinder.php");
  
  function form_fckeditor($name = '', $value = '', $extra = '')
{
  
            $ckeditor = new CKEditor();
            $ckeditor->basePath	= site_url().'ckeditor/';
            $config = array();
            $config['width']=690;
            $config['height']=400;
			/*
            $config['toolbar'] = array(
                                    array('Source'),
                                    array('Subscript','Superscript','Maximize'),
                                    array('Image','Flash','Link','Unlink'),
                                    array( 'Bold', 'Italic', 'Underline', 'Strike' ),
                                    array('NumberedList','BulletedList'),
                                    '/',
                                    array('TextColor','BGColor'),
                                    array('JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'),
                                    array('Format','Font','FontSize')
                            );
			*/
			if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=='om')
					{
				        $ckeditor_basepath = "/r/";
					}		
			else
					{
				        $ckeditor_basepath   = "/reveal/";
					}
          
            CKFinder::SetupCKEditor($ckeditor,$ckeditor_basepath.'ckfinder') ;
            return $ckeditor->editor($name,$value,$config);
			
}
?>