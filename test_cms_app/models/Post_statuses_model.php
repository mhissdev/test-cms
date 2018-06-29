<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Post_statuses_model.php
* Handles database interations for Post_statuses 
* mhisdev 29.06.06
*/

class Post_statuses_model extends CI_Model{

    
    /**
    * Insert new post status into database
    * @return void
    */
    public function insert($postStatusTitle)
    {
        // Build query
        $sql = 'INSERT INTO Post_statuses (Post_Status_Title) VALUES (?)';

        // Execute
        $this->db->query($sql, array($postStatusTitle));
    }


    /**
    * Get all Post statuses
    * @return int
    */
    public function getAll()
    {
        // Build query
        $sql = 'SELECT * FROM Post_Statuses ORDER BY Post_Status_Title;';

        // Execute
        $query = $this->db->query($sql);

        // Return result
        return $query->result_array();
    }
}