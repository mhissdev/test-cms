<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* User_model.php
* Handles database interations for users  
* mhisdev 26.06.06
*/

class User_model extends CI_Model{

    /**
    * Checks the user email is unique
    * @param string 
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
    * @param array
    * @return void
    */
    public function insert($data)
    {
        // Build query
        $sql = 'INSERT INTO Users (User_Email, User_Password, User_Firstname, User_LastName, Group_ID) VALUES (?, ?, ?, ?, ?)';

        // Execute
        $this->db->query($sql, array(
            $data['email'],
            $data['password'],
            $data['firstname'],
            $data['lastname'],
            $data['group_id']
        ));
    }


    /**
    * Get user and user group by email
    * @param string
    * @return array
    */
    public function getByEmail($email)
    {
        // Build query
        $sql = 'SELECT User_ID, User_Email, User_Password, User_Firstname, Group_Title FROM Users ';
        $sql .= 'LEFT JOIN Groups ON Users.Group_ID = Groups.Group_ID ';
        $sql .= 'WHERE User_Email = ?;';

        // execute
        $query = $this->db->query($sql, array($email));

        // Return result
        return $query->row_array();
    }


    /**
    * Get user password
    * @param int User ID
    * @return array
    */
    public function getPassword($userID)
    {
        // Build query
        $sql = 'SELECT User_Password FROM Users WHERE User_ID = ?;';

        // execute
        $query = $this->db->query($sql, array($userID));

        // Return result
        return $query->row_array();
    }
}