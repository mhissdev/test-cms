<?php
/*
* Navigation.php
* Base class for navigation menus
* Mark Hiscock 10.06.16
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Navigation_base
{
    // Base URL
    private $base_url = '';

	// Nav items
	private $items = array();

	/*******************************************************************************
    * Constructor
    *******************************************************************************/
    public function __construct()
    {
    	// Get Codeigniter object by reference
    	$CI =& get_instance();

    	// Assign base url
    	$this->base_url = $CI->config->item('base_url');
    }


    /*******************************************************************************
    * Add nav item
    *******************************************************************************/
	protected function addItem($name, $url = '')
	{
		// Add item to array
		array_push($this->items, array($name, $this->base_url . $url));
	}


	/*******************************************************************************
    * Ouputs Bootstrap 4.0 unordered list for navigation
    * $active is the name of current page
    *******************************************************************************/
    public function output($active = '')
    {
    	// Build opening HTML for unordered list
    	$str = '<ul class="navbar-nav mr-auto">';

    	foreach($this->items as $item)
    	{ 
    		if($item[0] == $active)
    		{
    			$str .= '<li class="nav-item active"><a class="nav-link" href="' . $item[1] . '">' . $item[0] .'</a></li>';
    		}
    		else
    		{
    			$str .= '<li class="nav-item"><a class="nav-link" href="' . $item[1] . '">' . $item[0] .'</a></li>';
    		}
    	}

    	// End list
    	$str .= '</ul>';

    	// Ouuput string
    	echo $str;
    }
}