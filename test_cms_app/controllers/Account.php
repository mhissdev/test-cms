<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Account.php
* Publicly accessible account management controller  
* mhisdev 26.06.06
*/

class Account extends CI_Controller{

    // Data to pass to views
    private $data = [];


    /**
    * Constructor
    */
    public function __construct()
    {
        parent::__construct();
    }


    /**
    *   Default function: User login page
    *   @return void
    */
    public function index()
    {
        // TODO: Login from
    }


    /**
    *   User logout
    *   @return void
    */
    public function logout()
    {
        // TODO: Logout
    }


    /**
    *   User Signup page
    *   @return void
    */
    public function signup()
    {   
        // Check to see if we have post data from signup form
        if(isset($_POST['signup-submit']) && !empty($_POST['signup-submit']))
        {   
            // Get POST data
            $this->getSignupPostData();

            // Create validation rules for signup form
            $this->createSignupRules();

            // Check for validation errors
            if($this->form_validation->run() === false)
            {
                // From contains validation errors
                $this->data['validation_errors'] = validation_errors('<li>', '</li>');
            }
            else
            {
                // TODO: Insert into database
            }

        }

        // Load view
        $this->load->view('signup', $this->data);
    }


    /**
    *   Retrieves POST data from submitted signup form
    *   @return void
    */
    private function getSignupPostData()
    {
        // Get data from form fields
        $this->data['email'] = $this->input->post('email');
        $this->data['firsname'] = $this->input->post('firsname');
        $this->data['lastname'] = $this->input->post('lastname');
        $this->data['password'] = $this->input->post('password');
        $this->data['password2'] = $this->input->post('password2');
    }


    /**
    *   Creates validation rules for signup form
    *   @return void
    */
    private function createSignupRules()
    {
        // TODO: Ensure Email is unique 
        // CI 'is_unique' uses query builder therefore we may not want to use this
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[255]');
        $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required|max_length[255]');
        $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required|max_length[255]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('password2', 'Password Confirm', 'trim|required|min_length[8]|matches[password]');
    }
}