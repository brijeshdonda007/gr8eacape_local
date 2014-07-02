<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2010, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Form Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/form_helper.html
 */

// -----------------------------    Function Added Later     ----------------------

    /**
     * Radio Button
     *
     * @access	public
     * @param	mixed
     * @param	string
     * @param	strint
     * @param	string
     * @param	string
     * @param	integer
     * @return	string
     */
    if ( ! function_exists('get_radio'))
    {
        function get_radio($dataRadio, $name, $class='', $sel='', $click='', $column=4)
        {
            $html = "";
            if (is_array($dataRadio)) {
                $swapper = 0;
                $td = array();
                foreach ($dataRadio as $key => $value) {
                    $valueNew = array();
                    foreach ($value as $k => $val) {
                        $valueNew[] = $val;
                    }
                    $id = str_replace('[]', '', $name) . "_" . $valueNew[0];
                    $td[$swapper] .= "<label class='nobold'><input type='radio' name='$name' id='$id'  onclick='$click' class='$class' value='$valueNew[0]' ";
                    $td[$swapper] .= ( $sel != null && $sel == $valueNew[0]) ? "checked='checked'" : "";
                    $td[$swapper] .=" />" . $valueNew[1] . "</label>\r\n";
                    $swapper = ($swapper == ($column - 1)) ? 0 : $swapper + 1;
                }
                $html .= "
                            <table class='no-border'>
                                    <tr>";
                foreach ($td as $ktd => $tdh) {
                    $html .= "<td>$td[$ktd]</td>";
                }
                $html .="	</tr>
                            </table>";
            }
            return $html;
        }
    }

    /**
     * Checkbox
     *
     * @access	public
     * @param	mixed
     * @param	string
     * @param	strint
     * @param	string
     * @param	string
     * @param	integer
     * @return	string
     */
    if ( ! function_exists('get_checkbox'))
    {
        function get_checkbox($dataRadio, $name, $class=null, $selArr=null, $click=null, $column=4)
        {
            
            $html = "";
            if (is_array($dataRadio)) {
                $swapper = 0;
                $td = array();
                foreach ($dataRadio as $key => $value) {
                    $valueNew = array();
                    foreach ($value as $k => $val) {
                        $valueNew[] = $val;
                    }
                   
                    $id = str_replace('[]', '', $name) . "_" . $valueNew[0];
                    $td[$swapper] .= "<label class='nobold block'><input type='checkbox' id='$id' name='" . $name . "' onclick='$click' class='$class' value='$valueNew[0]' ";
                    if (is_array($selArr)) {
                        $td[$swapper] .= ( in_array($valueNew[0], $selArr)) ? "checked='checked'" : "";
                    }
                    $td[$swapper] .=" />" . $valueNew[1] . "</label>\r\n";
                    $swapper = ($swapper == ($column - 1)) ? 0 : $swapper + 1;
                }
                $html .= "
                        <table class='no-border'>
                                <tr>";
                foreach ($td as $ktd => $tdh) {
                    $html .= "<td>$td[$ktd]</td>";
                }
                $html .="	</tr>
                        </table>";
            }
            return $html;
        }
    }
	
	if ( ! function_exists('get_checklist'))
    {
        function get_checklist($dataRadio, $name, $class=null, $selArr=null, $click=null, $column=4)
        {
            
            $html = "";
            if (is_array($dataRadio)) {
                $swapper = 0;
                $td = array();
                foreach ($dataRadio as $key => $value) {
                    $valueNew = array();
                    foreach ($value as $k => $val) {
                        $valueNew[] = $val;
                    }
                   
                    $id = str_replace('[]', '', $name) . "_" . $valueNew[0];
                    $td[$swapper] .= "<label class='nobold block'> ";
                    if (is_array($selArr)) {						
                        $td[$swapper] .= ( in_array($valueNew[0], $selArr)) ? " - ".$valueNew[1] : "" . "</label>\r\n";
                    }
                   
                    $swapper = ($swapper == ($column - 1)) ? 0 : $swapper + 1;
                }
                $html .= "
                        <table class='no-border'>
                                <tr>";
                foreach ($td as $ktd => $tdh) {
                    $html .= "<td>$td[$ktd]</td>";
                }
                $html .="	</tr>
                        </table>";
            }
            return $html;
        }
    }


    /**
     * Select Option
     *
     * @access	public
     * @param	array
     * @param	mixed
     * @return	string
     */
    if ( ! function_exists('get_select_options'))
    {
        function get_select_options($arr, $selection) {
            $multiple = (is_array($selection)) ? true : false;
            if (is_array($arr) && sizeof($arr) > 0) {
                foreach ($arr as $value){
                    $valueNew = array();
                    foreach ($value as $k => $val) {
                        $valueNew[] = $val;
                    }
                    $html .= "<option value='$valueNew[0]' ";
                    if ($multiple) {
                        $html .= ( in_array($valueNew[0], $selection)) ? "selected='selected'" : "";
                    } else {
                        $html .= ( $selection != null && $selection == $valueNew[0]) ? "selected='selected'" : "";
                    }
                    $html .=" >" . $valueNew[1] . "</option>\r\n";
                }
                return $html;
            } else {
                return false;
            }
        }
    }
	
	if ( ! function_exists('get_select_name'))
    {        
        function get_select_name($arr, $selection) {
			$html = "";
            $multiple = (is_array($selection)) ? true : false;
            if (is_array($arr) && sizeof($arr) > 0) {
                foreach ($arr as $value){
                    $valueNew = array();
                    foreach ($value as $k => $val) {
                        $valueNew[] = $val;
                    }
                    $html .= "";
                    if ($multiple) {
                        $html .= ( in_array($valueNew[0], $selection)) ? $valueNew[1] : "";
                    } else {
                        $html .= ( $selection != null && $selection == $valueNew[0]) ? $valueNew[1] : "";
                    }                    
                }
                return $html;
            } else {
                return false;
            }
        }
    }
	
	
/* End of file yform_helper.php */
/* Location: ./application/helpers/yform_helper.php */