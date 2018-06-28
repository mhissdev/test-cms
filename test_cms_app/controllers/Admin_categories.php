<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Admin_categories.php
* Admin Categories Controller
* mhisdev 28.06.06
*/

class Admin_categories extends CI_Controller{

    // Data to pass to views
    private $data = [];

    // Form mode (add or edit)
    private $formMode;

    public function __construct()
    {
        parent::__construct();

        // Load libraries
        $this->load->library(array('auth', 'navigation_admin'));

        // Check Login
        $this->auth->checkLogin();

        // Set nav name
        $this->data['nav_name'] = 'Categories';

        // Set page title
        $this->data['page_title'] = $this->config->item('site_name') . ' | Categories';

        // Load Post Categories model
        $this->load->model('post_categories_model');
    }


    /**
    *   Default function: Categories Page
    *   @return void
    */
    public function index($categoryID = 0)
    {
        // Set form mode
        $this->data['category_id'] = $categoryID;
        $this->formMode = $categoryID === 0 ? 'add' : 'edit';

        // Set form default values
        $this->setCategoryDefaultValues();

        // Load view
        $this->load->view('admin/categories', $this->data);
    }


    /**
    *   Sets the form values depending on form mode
    *   @return void
    */
    private function setCategoryDefaultValues()
    {
        if($this->formMode === 'add')
        {
            $this->data['category_title'] = '';
        }
        else
        {
            // Retrieve data from database
            $this->data['category_title'] = 'TODO:';
        }
    }

}