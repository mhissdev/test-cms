<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_settings extends CI_Controller{

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
        $this->data['nav_name'] = 'Settings';

        // Set page title
        $this->data['page_title'] = $this->config->item('site_name') . ' | Settings';
    }


    /**
    *   Default function: Admin Settings Page
    *   @return void
    */
    public function index()
    {
        // Process change password POST data
        if(!empty($_POST['password_submit']))
        {
            $this->processPasswordPostData();
        }

        // Load view
        $this->load->view('admin/settings', $this->data);
    }


    /**
    *   Process password POST data
    *   @return void
    */
    private function processPasswordPostData()
    {
        // Create rules
        $this->form_validation->set_rules('password_old', 'Old Password', 'trim|required|callback__checkOldPassword');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('password2', 'Password Re-enter', 'trim|required|min_length[8]|matches[password]');

         if($this->form_validation->run() === false)
         {
            // Form contains validation errors
            $this->data['validation_errors'] = validation_errors('<li>', '</li>');
         }
         else
         {
            // Get new password from POST data
            $password = $this->input->post('password');

            // Update password
            $this->auth->updatePassword($password);

            // Set success message
            $this->data['action_message'] = 'Password Successfully updated';
         }
    }


    /**
    *   Callback: Check supplied 'old password' is correct
    *   @param string old password
    *   @return bool
    */
    public function _checkOldPassword($oldPassword)
    {
        $valid = $this->auth->checkCurrentUserPassword($oldPassword);

        if($valid === true)
        {
            return true;
        }

        $this->form_validation->set_message('_checkOldPassword', 'Incorrect Old Password');
        return false;
    }
}