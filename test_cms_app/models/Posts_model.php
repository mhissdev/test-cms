<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Posts_model.php
* Handles database interations for Posts
* mhisdev 02.07.2018
*/

class Posts_model extends CI_Model{

    
    /**
    * Insert new post into database
    * @return void
    */
    public function insert($data)
    {
        // Build query
        $sql = 'INSERT INTO Posts (Post_Title, Post_Slug, Post_Description, Post_Leading, Post_Content, Post_Date, ';
        $sql .= 'User_ID, Post_Status_ID, Post_Category_ID, Post_Date_Created, Post_Date_Updated) ';
        $sql .= 'VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);';

        // Get time
        $time = time();

        // Execute
        $this->db->query($sql, array(
            $data['post_title'],
            $data['post_slug'],
            $data['post_description'],
            $data['post_leading'],
            $data['post_content'],
            $data['post_date_timestamp'],
            $data['user_id'],
            $data['post_status_id'],
            $data['post_category_id'],
            $time,
            $time,
        ));
    }


    /**
    * Update post
    * @return void
    */
    public function update($data)
    {
        // Build query
        $sql = 'UPDATE Posts SET Post_Title = ?, Post_Slug = ?, Post_Description = ?, Post_Leading = ?, Post_Content = ?, ';
        $sql .= 'Post_Date = ?, User_ID = ?, Post_Status_ID = ?, Post_Category_ID = ?, Post_Date_Updated = ? ';
        $sql .= 'WHERE Post_ID = ?;';

        // Get time
        $time = time();

        // Execute
        $this->db->query($sql, array(
            $data['post_title'],
            $data['post_slug'],
            $data['post_description'],
            $data['post_leading'],
            $data['post_content'],
            $data['post_date_timestamp'],
            $data['user_id'],
            $data['post_status_id'],
            $data['post_category_id'],
            $time,
            $data['post_id'],
        ));
    }


    /**
    * Get post by post ID
    * @return array
    */
    public function getByID($postID)
    {
        // Build sql
        $sql = 'SELECT * FROM Posts WHERE Post_ID = ?;';

        // execute
        $query = $this->db->query($sql, array($postID));

        // Return result
        return $query->row_array();
    }


    /**
    * Get post list for post admin page table
    * @return array
    */
    public function getList()
    {
        // Build sql
        $sql = 'SELECT Post_ID, Post_Title, Post_Date, Post_Category_Title, Post_Status_Title, User_Firstname, User_Lastname FROM Posts ';
        $sql .= 'LEFT JOIN Post_Categories ON Posts.Post_Category_ID = Post_Categories.Post_Category_ID ';
        $sql .= 'LEFT JOIN Post_Statuses ON Posts.Post_Status_ID = Post_Statuses.Post_Status_ID ';
        $sql .= 'LEFT JOIN Users ON Posts.User_ID = Users.User_ID;';

        // execute
        $query = $this->db->query($sql);

        // Return results
        return $query->result_array();
    }

}