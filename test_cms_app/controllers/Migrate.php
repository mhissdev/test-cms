<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller{

    public function index()
    {
        $this->load->library('migration');

        if($this->migration->current() === false)
        {
            // Something went wrong with migration
            show_error($this->migration->error_string());
        }
        else
        {
            // Output success
            echo 'Database updated successfullly';
        }
    }
}