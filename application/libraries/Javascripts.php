<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* Javascripts:: a class that stores an array of javascripts to be output in the view
* looks in your config for: $config['javascripts'] = array('jquery.js', 'jquery2.js'); 
*/

class Javascripts
{
    
    private $javascripts;
    private $CI;

    function __construct($params=NULL)
    {
        $this->clear();
        $this->CI =& get_instance();
        $config = $this->CI->config->item('javascript_files');
        if ($config) $this->add($config);
        if ($params) $this->add($params);
    }

    // clear all javascripts
    function clear()
    {
        $this->javascripts = array();
    }

    // add a javascript
    function add($items)
    {
        if (is_array($items)) {
            foreach ($items as $item) {
                if (!in_array($item, $this->javascripts)) {
                    $this->javascripts[] = $item;
                }
            }
        } else {
            if (!in_array($items, $this->javascripts)) {
                $this->javascripts[] = $items;
            }
        }
    }

    // return the array of javascripts
    function get()
    {
        return $this->javascripts;
    }

    // output the array of javascripts
    function to_string()
    {
        return 'javascripts are: '.implode(',', $this->javascripts);
    }
}
?>