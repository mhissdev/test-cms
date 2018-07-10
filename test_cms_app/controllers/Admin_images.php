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

        // Load Image model
        $this->load->model('image_model');

        // Get all images to output in a table
        $this->data['images'] = $this->image_model->getAll();

        // Get flash data
        if(!empty($this->session->flashdata('action_message')))
        {
            $this->data['action_message'] = $this->session->flashdata('action_message');
        }
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
     * Image Edit Page
     */
    public function edit($imageID = 0)
    {
        // Retrieve image data from database
        $data = $this->image_model->getByID($imageID);

        // Check we have image data
        if(empty($data))
        {
            // Something went wrong
            die('could not retrieve image data!');
        }

        // Copy data
        $this->data['image_title'] = $data['Image_Title'];
        $this->data['image_description'] = $data['Image_Description'];
        $this->data['image_filename'] = $data['Image_Filename'];


        // Check for POST data
        if(!empty($_POST['image_edit_submit']))
        {
            // Get POST data
            $this->data['image_id'] = $imageID;
            $this->data['image_title'] = $this->input->post('image_title');
            $this->data['image_description'] = $this->input->post('image_description');

            // Create rules
            $this->form_validation->set_rules('image_title', 'Image Title', 'trim|required|max_length[255]');

            // Check for validation errors
            if($this->form_validation->run() === false)
            {
                // Form contains validation errors
                $this->data['validation_errors'] = validation_errors('<li>', '</li>');
            }
            else
            {
                // Update database
                $this->image_model->update($this->data);

                // Set flash data message
                $this->session->set_flashdata('action_message', 'Image details successfully updated!');

                // Redirect to main images page
                header('Location: ' . base_url() . 'admin/images');
                die();
            }
        }

        // Load view
        $this->load->view('admin/images-edit', $this->data);
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
        $this->data['image_title'] = $this->input->post('image_upload_title');
        $this->data['image_description'] = $this->input->post('image_upload_description');

    }


    /**
     * Create validation rule for image upload form
     * @return void
     */
    private function createImageRules()
    {
        $this->form_validation->set_rules('image_upload_title', 'Image Title', 'trim|max_length[255]');
    }


    /**
     * Upload the image
     * @return void
     */
    private function uploadImage()
    {
        // Set config
        $config['upload_path'] = FCPATH . $this->config->item('image_upload_dir');
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 4096; // 4 MB
        $config['file_ext_tolower'] = true;
        $config['file_name'] = $this->getNewFilename();

        // Initialise CI upload class
        $this->load->library('upload', $config);

        // Attempt to opload file
        if($this->upload->do_upload('image_upload_file') === true)
        {
            // Upload success - Set image filename to data array
            $this->data['image_filename'] = $config['file_name'];

            // If image title field is empty we will use the original filename for a title without extension
            if(empty($this->data['image_title']))
            {
                $this->data['image_title'] = pathinfo($_FILES["image_upload_file"]["name"], PATHINFO_FILENAME);
            }

            // Insert record into database
            $this->image_model->insert($this->data);

            // Set success message
            $this->session->set_flashdata('action_message', 'Image has been successfully uploaded!');

            // Redirect to main images page
            header('Location: ' . base_url() . 'admin/images');
            die();
        }
        else
        {
            $this->data['validation_errors'] = $this->upload->display_errors('<li>', '</li>');
        }
    }


    /**
     * Gets a unique filename for uploaded image
     * @return string
     */
    private function getNewFilename()
    {
        $newFilename = '';

        // Check we have a file 
        if(!empty($_FILES["image_upload_file"]["name"]))
        {
            // Get original filename and extennsion
            $filename = $_FILES["image_upload_file"]["name"];
            $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

            // Ensure new filename is unique
            $isUnique = false;

            while($isUnique === false)
            {
                $newFilename = md5($filename . time()) . '.' . $extension;
                $isUnique = $this->image_model->isUnique($newFilename);
            }
        }

        // return new filename
        return $newFilename;
    }

}