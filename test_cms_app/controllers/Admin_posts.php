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

        // Load posts model
        $this->load->model('posts_model');

        // Load image model
        $this->load->model('image_model');
    }


    /**
    *   Default function: Admin Posts Page
    *   @return void
    */
    public function index()
    {
        // Load post List to display in table
        $this->data['posts'] = $this->posts_model->getList();

        // Escape posts befor being passed to view
        $this->escapePosts();

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

        // Process POST data
        $this->processPostData();

        // Load images to display in modal
        $this->data['modal_images'] = $this->image_model->getAll();

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
            // Default value
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
            // Retrieve post values from database
            $data = $this->posts_model->getByID($this->data['post_id']);

            // Check we have data
            if(empty($data))
            {
                // Something went wrong - Probably an invalid Post ID
                die('Unable to retrieve post');
            }

            // Copy values form database query
            $this->data['post_title'] = $data['Post_Title'];
            $this->data['post_description'] = $data['Post_Description'];
            $this->data['post_leading'] = $data['Post_Leading'];;
            $this->data['post_content'] = $data['Post_Content'];;
            $this->data['post_date'] = date('Y-m-d', $data['Post_Date']);
            $this->data['post_status_id'] = $data['Post_Status_ID'];
            $this->data['post_category_id'] = $data['Post_Category_ID'];
            $this->data['user_id'] = $data['User_ID'];
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
        $options = array('' => '-- Select --');

        // Get categories from database
        $this->load->model('post_categories_model');
        $categories = $this->post_categories_model->getAll();

        foreach($categories as $category)
        {
            // The intention was to Cast ID to a string
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
        $options = array('' => '-- Select --');

        // Get categories from database
        $this->load->model('post_statuses_model');
        $statuses = $this->post_statuses_model->getAll();

        foreach($statuses as $status)
        {
            // The intention was to Cast ID to a string
            // However this still gets added as an int into the array
            $key =  (string)$status['Post_Status_ID'];
            $options[$key] = $status['Post_Status_Title'];
        }

        $this->data['post_statuses'] = $options;
    }


    /**
    *   Process POST data
    *   @return void
    */
    private function processPostData()
    {
        // Check we have POST data
        if(!empty($_POST['post_submit']))
        {
            // Get post POST data
            $this->getPostPostData();

            // Create validation rules
            $this->createPostRules();

            // Check for validation errors
            if($this->form_validation->run() === false)
            {
                // Form contains validation errors
                $this->data['validation_errors'] = validation_errors('<li>', '</li>');
            }
            else
            {
                // Validation OK - Insert or update data for post
                $this->insertUpdatePost();
            }
        }
    }


    /**
    *   Retrieve POST data for posts
    *   @return void
    */
    private function getPostPostData()
    {
        // Get data from form fields
        $this->data['post_title'] = $this->input->post('post_title');
        $this->data['post_description'] = $this->input->post('post_description');
        $this->data['post_leading'] = $this->input->post('post_leading');
        $this->data['post_content'] = $this->input->post('post_content');
        $this->data['post_date'] = $this->input->post('post_date');
        $this->data['post_status_id'] = $this->input->post('post_status_id');
        $this->data['post_category_id'] = $this->input->post('post_category_id');
    }


    /**
    *   Create validation rules for posts
    *   @return void
    */
    public function createPostRules()
    {
        $this->form_validation->set_rules('post_title', 'Post Title', 'trim|required|max_length[255]|callback__postTitleRegex');
        $this->form_validation->set_rules('post_date', 'Post Date', 'trim|required|callback__postDate');
        $this->form_validation->set_rules('post_category_id', 'Post Category', 'required');
        $this->form_validation->set_rules('post_status_id', 'Post Status', 'required');
    }


    /**
    *   Callback function for post title validation
    *   @return bool
    */
    public function _postTitleRegex($postTitle)
    {
        if(preg_match("/^[a-zA-Z0-9\s-']*$/", $postTitle))
        {
            return true;
        }

        // Validation failed
        $this->form_validation->set_message('_postTitleRegex', 'The {field} field may only contain alpha-numeric characters, dashes, and spaces.');
        return false;
    }


    /**
    *   Callback function for post date validation
    *   Date MUST be 'Y-m-d' format
    *   @return bool
    */
     public function _postDate($postDate)
     {
        // Validation success flag
        $valid = false;

        // Get date elements
        $dateElements = explode('-', $postDate);

        // Make sure dateElements array has a length of 3
        if(count($dateElements) === 3)
        {
            $valid = checkdate($dateElements[1], $dateElements[2], $dateElements[0]);
        }

        // Return result
        if($valid)
        {
            return true;
        }

        // Validation failed
        $this->form_validation->set_message('_postDate', 'The {field} field must contain a valid date.');
        return false;

     }


    /**
    *   Generate slug from post title
    *   @return string
    */
    private function generateSlug($postTitle)
    {
        // Remove apostrophes
        $slug = str_replace("'", '', $postTitle);

        // Replace white space with dash
        $slug = str_replace(' ', '-', $slug);

        // Return lowercase
        return strtolower($slug);
    }


    /**
    *   Insert or update data into database
    *   @return void
    */
    private function insertUpdatePost()
    {
        // Convert date to timestamp
        $date = DateTime::createFromFormat('Y-m-d', $this->data['post_date']);
        $this->data['post_date_timestamp'] = $date->getTimestamp();

        // Generate slug
        $this->data['post_slug'] = $this->generateSlug($this->data['post_title']);


        if($this->formMode === 'add')
        {
            // Get user ID
            $this->data['user_id'] = $this->auth->getUserID();

            // Insert ito database
            $this->posts_model->insert($this->data);

            // Set success message
            $this->session->set_flashdata('action_message', 'Post Successfully Added!');

            // Redirect to main admin posts page
            header('Location: ' . base_url() . 'admin/posts');
            die();
        }
        else
        {
            // Update database
            $this->posts_model->update($this->data);

            // Set success message
            $this->session->set_flashdata('action_message', 'Post Successfully Updated!');

            // Redirect to main admin posts page
            header('Location: ' . base_url() . 'admin/posts');
            die();
        }
    }


    /**
    *   Escape post before being passed to view
    *   @return void
    */
    private function escapePosts()
    {
        foreach ($this->data['posts'] as $key => $post) 
        {
            $this->data['posts'][$key]['Post_Title'] = $this->security->xss_clean($post['Post_Title']);
            $this->data['posts'][$key]['Post_Category_Title'] = $this->security->xss_clean($post['Post_Category_Title']);
            $this->data['posts'][$key]['Post_Title'] = $this->security->xss_clean($post['Post_Title']);
            $this->data['posts'][$key]['User_Firstname'] = $this->security->xss_clean($post['User_Firstname']);
            $this->data['posts'][$key]['User_Lastname'] = $this->security->xss_clean($post['User_Lastname']);
        }
    }
}