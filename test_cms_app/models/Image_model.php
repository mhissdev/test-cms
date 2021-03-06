<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Image_model.php
* Handles database interations for Images  
* mhisdev 10.07.2018
*/

class Image_model extends CI_Model{


    /**
    * Checks an image filename is unique
    * @return bool
    */
    public function isUnique($filename)
    {
        // Build query
        $sql = 'SELECT COUNT(Image_ID) AS num_images FROM Images WHERE Image_Filename = ?;';

        // Execute
        $query = $this->db->query($sql, array($filename));

        // Get result
        $result = $query->row_array();

        // Return true if supplied filename is unique
        return $result['num_images'] > 0 ? false :true;
    }


    /**
    * Insert new image record into database
    * @return void
    */
    public function insert($data)
    {
        // Build query
        $sql = 'INSERT INTO Images (Image_Upload_Date, Image_Filename, Image_Title, Image_Description) ';
        $sql .= 'VALUES (?, ?, ?, ?);';

        // Get current time
        $time = time();

        // Execute
        $query = $this->db->query($sql, array(
            $time,
            $data['image_filename'],
            $data['image_title'],
            $data['image_description']
        ));
    }


    /**
     * Update image details
     * @return void
     */
    public function update($data)
    {
        // Build query
        $sql = 'UPDATE Images SET Image_Title = ?, Image_Description = ? WHERE Image_ID = ?;';

        // Execute
        $this->db->query($sql, array(
            $data['image_title'],
            $data['image_description'],
            $data['image_id']
        ));
    }


    /**
    * Get all images
    * @return array
    */
    public function getAll()
    {
        // Build query
        $sql = 'SELECT * FROM Images ORDER BY Image_Upload_Date DESC';

        // Execute
        $query = $this->db->query($sql);

        // Return results 
        return $query->result_array();

    }


    /**
    * Get image by ID
    * @return array
    */
    public function getByID($imageID)
    {
        // Build query
        $sql = 'SELECT Image_Title, Image_Description, Image_Filename FROM Images WHERE Image_ID = ?';

        // Execute
        $query = $this->db->query($sql, array($imageID));

        // Return results 
        return $query->row_array();
    }
}