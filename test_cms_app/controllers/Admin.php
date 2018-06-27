<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Admin.php
* Admin Controller
* mhisdev 27.06.06
*/

class Admin extends CI_Controller{

    // Data to pass to views
    private $data = [];

    public function __construct()
    {
        parent::__construct();

        // Load navigation library
        $this->load->library('navigation_admin');
    }


    /**
    *   Default function: Admin Dashboard Page
    *   @return void
    */
    public function index()
    {
        // Load view
        $this->load->view('admin/dashboard', $this->data);
    }
}