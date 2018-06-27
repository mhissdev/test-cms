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
        // Load user model
        $this->CI->load->model('user_model');

        // Retrieve user data
        $data = $this->CI->user_model->getByEmail($email);

        // Check we have data
        if(!empty($data) && isset($data['User_Password']))
        {
            // Check user is not in denied group
            if($this->userInDeniedGroup($data['Group_Title']) === true)
            {
                // Deny user
                return false;
            }

            // Check passwordand email combination
            $hash = $data['User_Password'];
            $password = $this->encodePassword($password);

            if(password_verify($password, $hash) === true)
            {
                // Login Success
                $this->login($data);
                return true;
            }
        }

        // If we get here authentication failed
        return false;
    }


    /**
    *   Check user is in denied group
    *   @param string
    *   @return bool
    */
    private function userInDeniedGroup($groupTitle)
    {
        // Ensure group title is lowercase
        $groupTitle = strtolower($groupTitle);

        // Get denied groups from config
        $deniedGroups = $this->CI->config->item('deny_login_groups');
        $deniedGroups = array_map('strtolower', $deniedGroups);

        // Search
        return in_array($groupTitle, $deniedGroups, true);
    }


    /**
    *   Log user in and create session variables
    *   @param array
    *   @return void
    */
    private function login($data)
    {
        // Set session data
        $_SESSION['user_id'] = $data['User_ID'];
        $_SESSION['user_group'] = $data['Group_Title'];
        $_SESSION['firstname'] = $data['User_Firstname'];

        // Regenerate session ID for extra security
        session_regenerate_id(true);
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