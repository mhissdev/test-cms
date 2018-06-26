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
    * Add new user
    * @return bool
    */
    public function addUser($email, $password)
    {

    }


    /**
    * Authenticate user
    * @return bool
    */
    public function authenticate($email, $password)
    {

    }
}