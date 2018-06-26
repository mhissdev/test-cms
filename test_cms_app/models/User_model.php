<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* User_model.php
* Handles database interations for users  
* mhisdev 26.06.06
*/

class User_model extends CI_Model{
    
    /**
    * Insert new user into database
    * @return void
    */
    public insert($data)
    {
        // Build query
        $sql = 'INSERT INTO Users (User_Email, User_Password, User_Firstname, User_LastName, User_Group_ID) VALUES (?, ?, ?, ?, ?)';

        // Execute
        $this->db->query($sql, array(
            $data['email'],
            $data['password'],
            $data['firstname'],
            $data['lastname'],
            $data['email'],
            $data['group_id']
        ));
    }
}