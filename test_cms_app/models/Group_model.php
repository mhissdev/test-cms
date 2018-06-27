<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Group_model.php
* Handles database interations for Use Groups  
* mhisdev 27.06.06
*/

class Group_model extends CI_Model{

    
    /**
    * Insert new user into database
    * @return void
    */
    public function insert($groupTitle)
    {
        // Build query
        $sql = 'INSERT INTO Groups (Group_Title) VALUES (?)';

        // Execute
        $this->db->query($sql, array($groupTitle));
    }


    /**
    * Get group ID
    * @return int
    */
    public function getGroupID($groupTitle)
    {
        // Build query
        $sql = 'SELECT Group_ID FROM Groups WHERE Group_Title = ?;';

        // Execute
        $query = $this->db->query($sql, array($groupTitle));

        // Return ID
        $result = $query->row_array();
        return isset($result['Group_ID']) ? $result['Group_ID'] : 0;
    }
}