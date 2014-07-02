<?php

if (!function_exists('sortarray')) {
    function sortarray($array, $index, $order='asc', $natsort=FALSE, $case_sensitive=FALSE) {
        if (is_array($array) && count($array) > 0) {
            foreach (array_keys($array) as $key)
                $temp[$key] = $array[$key][$index];
            if (!$natsort) {
                if ($order == 'asc')
                    asort($temp);
                else
                    arsort($temp);
            }
            else {
                if ($case_sensitive === true)
                    natsort($temp);
                else
                    natcasesort($temp);
                if ($order != 'asc')
                    $temp = array_reverse($temp, TRUE);
            }
            foreach (array_keys($temp) as $key)
                if (is_numeric($key))
                    $sorted[] = $array[$key];
                else
                    $sorted[$key] = $array[$key];
            return $sorted;
        }
        return $sorted;
    }

}
if (!function_exists('upload_image')) {

    function upload_image($dir_name, $file_name, $file_type, $max_size = '2000') {
        $CI = & get_instance();
		
		

        $config['upload_path'] = './files/' . $dir_name;
        $config['allowed_types'] = $file_type;
        $config['max_size'] = $max_size;
       $config['encrypt_name'] = TRUE;
        $CI->load->library('upload');
        $CI->upload->initialize($config);
        // Do the file upload
        $CI->upload->do_upload($file_name);
        // Get upload errors
        $errors = $CI->upload->display_errors();
		echo $errors; exit;
		
        if($errors){
		
            return FALSE;
        }else{
            return $CI->upload->data();
        }
    }

}

if (!function_exists('twodim_to_keyval')) {

    function twodim_to_keyval($data) {
        if (is_array($data) && sizeof($data) > 0) {
            $dataNew = array();
            foreach ($data as $key => $value) {
                $valTmp = array();
                foreach ($value as $val) {
                    $valTmp[] = $val;
                }
                $dataNew[] = array($valTmp[0] => $valTmp[1]);
            }
            return $dataNew;
        } else {
            return array(array('No Data!'));
        }
    }

}
?>
