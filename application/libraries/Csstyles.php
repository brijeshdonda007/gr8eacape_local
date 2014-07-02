<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* Csstyles:: a class that stores an array of csstyles to be output in the view
* looks in your config for: $config['csstyles'] = array('design.css', 'test_table.css'); 
*/

class Csstyles
{
    
    private $csstyles;
    private $CI;

    function __construct($params=NULL)
    {
        $this->clear();
        $this->CI =& get_instance();
        $config = $this->CI->config->item('csstyle_files');
        if ($config) $this->add($config);
        if ($params) $this->add($params);
    }

    // clear all csstyles
    function clear()
    {
        $this->csstyles = array();
    }

    // add a csstyle
    function add($items)
    {
        if (is_array($items)) {
            foreach ($items as $item) {
                if (!in_array($item, $this->csstyles)) {
                    $this->csstyles[] = $item;
                }
            }
        } else {
            if (!in_array($items, $this->csstyles)) {
                $this->csstyles[] = $items;
            }
        }
    }

    // return the array of csstyles
    function get()
    {
        return $this->csstyles;
    }

    // output the array of csstyles
    function to_string()
    {
        return 'csstyles are: '.implode(',', $this->csstyles);
    }
}
?>