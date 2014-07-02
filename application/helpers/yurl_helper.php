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
if (!function_exists('uencode')) {

    function uencode($data) {
        return strtr(rtrim(base64_encode($data), '='), '+/', '-_');
    }

}
if (!function_exists('udecode')) {

    function udecode($base64) {
        return base64_decode(strtr($base64, '-_', '+/'));
    }

}

if (!function_exists('yencode')) {

    function yencode($string=null, $key=null) {
        if ($string == null || strlen($string) == 0 || trim($string) == '') {
            return false;
        }
        $CI = &get_instance();
        $string = $CI->config->item('default_salt') . trim($string);
        if ($key == null) {
            $key = $CI->config->item('encryption_key');
        }
        unset($CI);
        $key = sha1($key);
        $str_len = strlen($string);
        $key_len = strlen($key);
        $j = 0;
        $hash = "";
        for ($i = 0; $i < $str_len; $i++) {
            $ord_str = ord(substr($string, $i, 1));
            if ($j == $key_len) {
                $j = 0;
            }
            $ord_key = ord(substr($key, $j, 1));
            $j++;
            $hash .= strrev(base_convert(dechex($ord_str + $ord_key), 16, 36));
        }
        return $hash;
    }

}
if (!function_exists('ydecode')) {

    function ydecode($string=null, $key=null) {
        if ($string == null || strlen($string) == 0 || trim($string) == '') {
            return false;
        }
        $CI = &get_instance();
        $string = trim($string);
        $search = $CI->config->item('default_salt');
        if ($key == null) {
            $CI = &get_instance();
            $key = $CI->config->item('encryption_key');
        }
        unset($CI);
        $key = sha1($key);
        $str_len = strlen($string);
        $key_len = strlen($key);
        $j = 0;
        $hash = "";
        for ($i = 0; $i < $str_len; $i+=2) {
            $ord_str = hexdec(base_convert(strrev(substr($string, $i, 2)), 36, 16));
            if ($j == $key_len) {
                $j = 0;
            }
            $ord_key = ord(substr($key, $j, 1));
            $j++;
            $hash .= chr($ord_str - $ord_key);
        }
        return str_replace($search, '', $hash);
    }

}

if (!function_exists('current_ca')) {

    function current_ca() {
        $CI = get_instance();
        $controller = strtolower($CI->router->class);
        $method = strtolower($CI->router->method);
        $directory = strtolower($CI->router->directory);
        unset($CI);
        return array($controller, $method, $directory);
    }

}

if (!function_exists('get_msg')) {

    function get_msg($flash) {
        /* error;success;info */
        $CI = get_instance();
        $msg = '';
        $_msg = $CI->session->flashdata($flash);
        if ($_msg) {
            $msg = explode('~~', $_msg);
            $data['msg_class'] = $msg[0];
            $data['msg_content'] = $msg[1];
            $msg = $CI->load->view('common/message', $data, true);
        }
        unset($CI);
        return $msg;
    }

}
if (!function_exists('imager')) {
    
    function imager($img_path, $width, $height, $aspect_ratio = NULL) {
        $img_fpath = 'imager/index/';
        $img_fpath .= $width . "-" . $height;
        $img_fpath .= '-';
        if($aspect_ratio){
            $aspect_ratio = str_replace(':','-',$aspect_ratio);
            $img_fpath .= $aspect_ratio;
        }else{
            $img_fpath .= 0;
        }
        return site_url($img_fpath . '/' . $img_path);
    }

}
/* End of file yurl_helper.php */
/* Location: ./application/helpers/yurl_helper.php */