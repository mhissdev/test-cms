<?php
/*
* Navigation_admin.php
* Outputs the admin navigation bar
* mhissdev 27.06.2018
*/
defined('BASEPATH') OR exit('No direct script access allowed');

// Include base navigation class
require_once(APPPATH . '/libraries/Navigation_base.php'); 

class Navigation_admin extends Navigation_base
{

    /*******************************************************************************
    * Constructor
    *******************************************************************************/
    public function __construct()
    {
        parent::__construct();

        // Add navigation items
        $this->addItem('Dashboard', 'admin');
        $this->addItem('Categories', 'admin/categories');
        $this->addItem('Posts', 'admin/posts');
        $this->addItem('Images', 'admin/images');
        $this->addItem('Settings', 'admin/settings');
    }
}