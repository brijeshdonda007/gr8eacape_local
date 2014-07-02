<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of yurl_helper
 *
 * @author mrigess
 * @copyright mrigess
 * @name mrigess
 */
if (!function_exists('generate_doc')) {

    function generate_doc($file_name,$data,$ob_clean=true,$download=true) {
        //clean filename
        $file_name = url_title($file_name);
        $file_name = str_replace('.doc', '', $file_name);
        $data = str_replace('<table', '<table border=1 ', $data);
        //clean any buffer available
        if($ob_clean)
            ob_clean();
        $CI = &get_instance();
        $data_file = array();
        $data_file['title'] = $file_name;
        $data_file['content'] = $data;
        //load Word View file
        $file = $CI->load->view('common/doc.php',$data_file,TRUE);
        header("Cache-Control: ");// leave blank to avoid IE errors
        header("Pragma: ");// leave blank to avoid IE errors
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"$file_name.doc\"");
        print_r($file);
    }

}
if (!function_exists('generate_xls')) {

    function generate_xls($file_name,$data,$ob_clean=true,$download=true) {
        //clean filename
        $file_name = url_title($file_name);
        $file_name = str_replace('.xls', '', $file_name);
        $data = str_replace('<table', '<table border=1 ', $data);
        //clean any buffer available
        if($ob_clean)
            ob_clean();
        $CI = &get_instance();
        $data_file = array();
        $data_file['title'] = $file_name;
        $data_file['content'] = $data;
        //load Word View file
        $file = $CI->load->view('common/xls.php',$data_file,TRUE);
        header("Cache-Control: ");// leave blank to avoid IE errors
        header("Pragma: ");// leave blank to avoid IE errors
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"$file_name.xls\"");
        print_r($file);
    }

}

/* End of file office_helper.php */
/* Location: ./application/helpers/office_helper.php */