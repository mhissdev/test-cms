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

        // Get all categories
        $this->data['categories'] = $this->post_categories_model->getAll();

        // Escape categories before passing to view
        $this->escapeCategories();
    }


    /**
    *   Default function: Categories Page
    *   @return void
    */
    public function index($categoryID = 0)
    {
        // Set form mode and title
        $this->data['category_id'] = $categoryID;

        if($categoryID === 0)
        {
            // New category
            $this->formMode = 'add';
            $this->data['form_title'] = 'Add New Category';
            $this->data['form_button_value'] = 'Add New';
        }
        else
        {
            // Edit existing category
            $this->formMode = 'edit';
            $this->data['form_title'] = 'Edit Category';
            $this->data['form_button_value'] = 'Update';
        }

        // Set form default values
        $this->setCategoryDefaultValues();

        // Process POST data
        $this->processPostData();

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
        else if(empty($_POST['category_submit']))
        {
            // Retrieve data from database if NOT POST request
            $data = $this->post_categories_model->getByID($this->data['category_id']);
            $this->data['category_title'] = $data['Post_Category_Title'];
        }
    }


    /**
    *   Process POST data
    *   @return void
    */
    private function processPostData()
    {
        //Check we have POST data
       if(!empty($_POST['category_submit']))
       {    
            // Get POST data
            $this->getCategoryPostData();

            // Set rules
            $this->createCategoryRules();

            // Check for validation errors
            if($this->form_validation->run() === false)
            {
                // Form contains validation errors
                $this->data['validation_errors'] = validation_errors('<li>', '</li>');
            }
            else
            {
                // Form validation OK
                if($this->formMode === 'add')
                {
                    // Insert category
                    $this->post_categories_model->insert($this->data['category_title']);

                    // Set flash data message
                    $this->session->set_flashdata('action_message', '<p>Category Successfully Added!</p>');

                    // Redirect to clear form
                    // Note: We can ether redirect to clear form or NOT use CI 'set_value'
                    // function to populate form fields
                    header('Location: ' . base_url() . 'admin/categories');
                    die();
                }
                else if($this->formMode === 'edit')
                {
                    // Update category
                    $this->post_categories_model->update($this->data);

                    // Set flash data message
                    $this->session->set_flashdata('action_message', '<p>Category Successfully Updated!</p>');

                    // Redirect to main category page
                    header('Location: ' . base_url() . 'admin/categories');
                    die();
                }
            }
       }
    }


    /**
    *   Retrieves POST data from submitted categories form
    *   @return void
    */
    private function getCategoryPostData()
    {
        // Get data from form fields
        $this->data['category_title'] = $this->input->post('category_title');
    }


    /**
    *   Create validation rules for category form
    *   @return void
    */
    private function createCategoryRules()
    {
        // Get data from form fields
        $this->form_validation->set_rules('category_title', 'Category Title', 'trim|required|max_length[255]');
    }


    /**
    *   Escape categories for output
    *   @return void
    */
    private function escapeCategories()
    {
        foreach($this->data['categories'] as $key => $category)
        {
            $this->data['categories'][$key]['Post_Category_Title'] = $this->security->xss_clean($category['Post_Category_Title'] );
        }
    }
}