<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_images extends CI_Controller{

    // Data to pass to views
    private $data = [];


    public function __construct()
    {
        parent::__construct();

        // Load libraries
        $this->load->library(array('auth', 'navigation_admin'));

        // Check Login
        $this->auth->checkLogin();

        // Set nav name
        $this->data['nav_name'] = 'Images';

        // Set page title
        $this->data['page_title'] = $this->config->item('site_name') . ' | Images';
    }


    /**
    *   Default function: Admin Images Page
    *   @return void
    */
    public function index()
    {
        // Load view
        $this->load->view('admin/images', $this->data);
    }

}