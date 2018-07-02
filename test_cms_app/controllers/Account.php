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

        // Load libraries
        $this->load->library('auth');
    }


    /**
    *   Default function: User login page
    *   @return void
    */
    public function index()
    {
        // Login form
        if(!empty($_POST['login-submit']))
        {
            // Get POST data
            $this->getLoginPostData();

            // Validation rules
            $this->createLoginRules();

            // Check for validation errors
            if($this->form_validation->run() === false)
            {
                // Form contains validation errors
                $this->data['validation_errors'] = validation_errors('<li>', '</li>');
            }
            else
            {
                // Check email password combination
                if($this->auth->authenticate($this->data['email'], $this->data['password']) === true)
                {
                    // User login success - redirect to dashboard
                    header('Location: ' . base_url() . 'admin');
                    die();
                }
                else
                {
                    $this->data['validation_errors'] = '<li>Email and Password do NOT match</li>';
                }
            }
        }

        // Load view
        $this->load->view('login', $this->data);
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
        if(!empty($_POST['signup-submit']))
        {   
            // Get POST data
            $this->getSignupPostData();

            // Create validation rules for signup form
            $this->createSignupRules();

            // Check for validation errors
            if($this->form_validation->run() === false)
            {
                // Form contains validation errors
                $this->data['validation_errors'] = validation_errors('<li>', '</li>');
            }
            else
            {
                // Insert new user into database
                $this->auth->addUser($this->data);
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
        $this->data['firstname'] = $this->input->post('firstname');
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
        // CI 'is_unique' uses query builder therefore we have used a callback
        // to check email is unique
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[255]|callback__uniqueEmailCheck');
        $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required|max_length[255]');
        $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required|max_length[255]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('password2', 'Password Confirm', 'trim|required|min_length[8]|matches[password]');
    }


    /**
    *   Callback for form validation. Checks the supplied email is unique
    *   The undrscore is used to prevent access to the 'public' function
    *   @return void
    */
    public function _uniqueEmailCheck($email)
    {
        // Load user model
        $this->load->model('user_model');

        if($this->user_model->isUnique($email) === true)
        {
            // Email is unique
            return true;
        }
        else
        {
            // Email is NOT unique
            $this->form_validation->set_message('_uniqueEmailCheck', 'Email has already been registered');
            return false;
        }
    }


    /**
    *   Retrieves POST data from login form
    *   @return void
    */
    private function getLoginPostData()
    {
        // Get data from form fields
        $this->data['email'] = $this->input->post('email');
        $this->data['password'] = $this->input->post('password');
    }


    /**
    *   Creates validation rules for login form
    *   @return void
    */
    private function createLoginRules()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
    }
}