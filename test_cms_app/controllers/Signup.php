<?php defined('BASEPATH') OR exit('No direct script access allowed');

// Publicly accessible account management controller

class Account extends CI_Controller{

    // Data to pass to views
    private $data = [];

    /**
    *   Default function: User Login
    *   @param return void
    */
    public function index()
    {
        echo "TODO: Login";
    }


    public function signup()
    {
        $this->load->view('signup', $this->data);
    }
}