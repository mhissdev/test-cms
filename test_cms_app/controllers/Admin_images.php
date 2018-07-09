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
        // Process POST data
        $this->processPostData();

        // Load view
        $this->load->view('admin/images', $this->data);
    }


    /**
     * Process POST data
     * @return void
     */
    private function processPostData()
    {
        if(!empty($_POST['image_upload_submit']))
        { 
            // Get POST data
            $this->getImagePostData();

            // Set validation rules
            $this->createImageRules();

            // Check for validation errors
            if($this->form_validation->run() === false)
            {
                // Form contains validation errors
                $this->data['validation_errors'] = validation_errors('<li>', '</li>');
            }
            else
            {
                // Upload image
                $this->uploadImage();
            }
        }
    }


    /**
    *   Retrieves POST data from submitted image upload form
    *   @return void
    */
    private function getImagePostData()
    {
        // Get data from form fields
        $this->data['image_upload_title'] = $this->input->post('image_upload_title');
        $this->data['image_upload_description'] = $this->input->post('image_upload_description');
        $this->data['image_upload_file'] = $this->input->post('image_upload_file');
    }


    /**
     * Create validation rule for image upload form
     * @return void
     */
    private function createImageRules()
    {
        $this->form_validation->set_rules('image_upload_title', 'Image Title', 'trim|required|max_length[255]');
        //$this->form_validation->set_rules('image_upload_file', 'Select Image', 'required');
    }


    /**
     * Upload the image
     * @return void
     */
    private function uploadImage()
    {
        // Set config
        $config['upload_path'] = FCPATH . '/uploads/images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 4096; // 4 MB

        // Initialise CI upload class
        $this->load->library('upload', $config);

        // Attempt to opload file
        if($this->upload->do_upload('image_upload_file') === true)
        {
            // Upload success
        }
        else
        {
            $this->data['validation_errors'] = $this->upload->display_errors('<li>', '</li>');
        }
    }

}