<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Admin_posts.php
* Admin Posts Controller
* mhisdev 27.06.06
*/

class Admin_posts extends CI_Controller{

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
        $this->data['nav_name'] = 'Posts';

        // Set page title
        $this->data['page_title'] = $this->config->item('site_name') . ' | Posts';
    }


    /**
    *   Default function: Admin Posts Page
    *   @return void
    */
    public function index()
    {
        // Load view
        $this->load->view('admin/posts', $this->data);
    }


    /**
    *   Add and Edit posts page
    *   @return void
    */
    public function manage($postID = 0)
    {
        // Set form mode and title
        $this->data['post_id'] = $postID;

        if($postID === 0)
        {
            // New post
            $this->formMode = 'add';
            $this->data['form_title'] = 'Add New Post';
            $this->data['form_button_value'] = 'Submit';
        }
        else
        {
            // Edit existing post
            $this->formMode = 'edit';
            $this->data['form_title'] = 'Edit Post';
            $this->data['form_button_value'] = 'Update';
        }

        // Retrieve menu data
        $this->setCategoriesSelectData();
        $this->setPostStatusesSelectData();

        // Set post default values
        $this->setPostDefaultValues();

        // Load view
        $this->load->view('admin/posts_manage', $this->data);
    }


    /**
    *   Sets post default values
    *   @return void
    */
    private function setPostDefaultValues()
    {
        if($this->formMode === 'add')
        {
            $this->data['post_title'] = '';
            $this->data['post_description'] = '';
            $this->data['post_leading'] = '';
            $this->data['post_content'] = '';
            $this->data['post_date'] = date('Y-m-d');
            $this->data['post_status_id'] = '';
            $this->data['post_category_id'] = '';
        }
        else
        {
            // TODO: Retrieve post from database
        }
    }


    /**
    *   Sets data for categories select menu
    *
    *   @return void
    */
    private function setCategoriesSelectData()
    {
        // Set First option
        $options = [];
        $options['0'] = '-- Select --';

        // Get categories from database
        $this->load->model('post_categories_model');
        $categories = $this->post_categories_model->getAll();

        foreach($categories as $category)
        {
            // My intention was to Cast ID to a string
            // However this still gets added as an int into the array
            $key =  (string)$category['Post_Category_ID'];
            $options[$key] = $category['Post_Category_Title'];
        }

        $this->data['post_categories'] = $options;
    }


    /**
    *   Sets data for post statuses select menu
    *
    *   @return void
    */
    private function setPostStatusesSelectData()
    {
        // Set First option
        $options = [];
        $options['0'] = '-- Select --';

        // Get categories from database
        $this->load->model('post_statuses_model');
        $statuses = $this->post_statuses_model->getAll();

        foreach($statuses as $status)
        {
            // My intention was to Cast ID to a string
            // However this still gets added as an int into the array
            $key =  (string)$status['Post_Status_ID'];
            $options[$key] = $status['Post_Status_Title'];
        }

        $this->data['post_statuses'] = $options;
    }
}