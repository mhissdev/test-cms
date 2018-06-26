<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
*   20180622161600_add_posts.php
*   Creates the Posts table
*   mhissdev: 22.06.2018   
*/

class Migration_Add_posts extends CI_Migration{

    public function up()
    {   
        // Create fields
        $this->dbforge->add_field(array(
            'Post_ID' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'Post_Title' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'Post_Slug' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'Post_Description' => array(
                'type' => 'TEXT',
            ),
            'Post_Leading' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'Post_Content' => array(
                'type' => 'TEXT',
            ),
            'Post_Date' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'User_ID' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
            'Post_Status_ID' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
            'Post_Category_ID' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
        ));

        // Set primary key
        $this->dbforge->add_key('Post_ID', TRUE);

        // Create table
        $this->dbforge->create_table('Posts');
    }


    public function down()
    {
        $this->dbforge->drop_table('Posts');
    }

}