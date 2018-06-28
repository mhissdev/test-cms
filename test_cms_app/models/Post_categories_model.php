<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Post_categories_model.php
* Handles database interations for Post_categories  
* mhisdev 28.06.06
*/

class Post_categories_model extends CI_Model{

    
    /**
    * Insert new category into database
    * @return void
    */
    public function insert($categoryTitle)
    {
        // Build query
        $sql = 'INSERT INTO Post_Categories (Post_Category_Title) VALUES (?)';

        // Execute
        $this->db->query($sql, array($categoryTitle));
    }


    /**
    * Update category
    * @return void
    */
    public function update($data)
    {
        // Build query
        $sql = 'UPDATE Post_Categories SET Post_Category_Title = ? WHERE Post_Category_ID = ?;';

        // Execute
        $this->db->query($sql, array(
            $data['category_title'],
            $data['category_id']
        ));
    }


    /**
    * Get all categories
    * @return array
    */
    public function getAll()
    {
        // Build query
        $sql = 'SELECT * FROM Post_Categories ORDER BY Post_Category_Title';

        // Execute
        $query = $this->db->query($sql);

        // Return results 
        return $query->result_array();
    }


    /**
    * Get category by ID
    * @return array
    */
    public function getByID($categoryID)
    {
        // Build query
        $sql = 'SELECT * FROM Post_Categories WHERE Post_Category_ID = ?';

        // Execute
        $query = $this->db->query($sql, array($categoryID));

        // Return single result 
        return $query->row_array();
    }

}