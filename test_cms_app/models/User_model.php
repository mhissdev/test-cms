<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* User_model.php
* Handles database interations for users  
* mhisdev 26.06.06
*/

class User_model extends CI_Model{

    /**
    * Checks the user email is unique
    * @return bool
    */
    public function isUnique($email)
    {
        // Build query
        $sql = 'SELECT COUNT(user_id) AS num_users FROM Users WHERE User_Email = ?';

        // execute
        $query = $this->db->query($sql, array($email));

        // Get result
        $result = $query->row_array();

        // Return true if supplied email is unique
        return $result['num_users'] > 0 ? false :true;
    }
    

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