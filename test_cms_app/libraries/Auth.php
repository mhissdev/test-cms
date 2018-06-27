<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Auth.php
* A simple authentication library 
* mhisdev 26.06.06
*/

class Auth{

    // CI super obeject
    private $CI;

    /**
    * Constructor
    */
    public function __construct()
    {
        // Set CI Object by reference
        $this->CI =& get_instance();
    }


    /**
    * Add new user. Assumes data has been successfully validated
    * @return void
    */
    public function addUser($data)
    {
        // Encode and hash password
        $data['password'] = password_hash($this->encodePassword($data['password']), PASSWORD_BCRYPT);

        // Load user model

        // Add new user to default group
        $groupTitle = $this->CI->config->item('deafult_user_group');
        $this->CI->load->model('group_model');
        $data['group_id'] = $this->CI->group_model->getGroupID($groupTitle);

        // Insert new user into database
        $this->CI->load->model('user_model');
        $this->CI->user_model->insert($data);
    }


    /**
    * Authenticate user
    * @return bool
    */
    public function authenticate($email, $password)
    {

    }


    /**
    * Encode the passsword before hashing
    * @return string
    */
    private function encodePassword($password)
    {
        return base64_encode(hash('sha256', $password, true));
    }
}