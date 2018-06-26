<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
*   20180626110200_add_images.php
*   Creates Images and Post_Images tables
*   mhissdev: 26.06.2018   
*/

class Migration_Add_images extends CI_Migration{

    public function up()
    {   ////////////////////////////////////////////////
        // Create Image fields
        ////////////////////////////////////////////////
        $this->dbforge->add_field(array(
            'Image_ID' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'Image_Filename' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'Image_Title' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'Image_Description' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
        ));

        // Set primary key
        $this->dbforge->add_key('Image_ID', TRUE);

        // Create table
        $this->dbforge->create_table('Images');

        ////////////////////////////////////////////////
        // Create Posts_Images fields
        ////////////////////////////////////////////////
        $this->dbforge->add_field(array(
            'Posts_Images_ID' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'Image_ID' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
            'Post_ID' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
        ));

        // Set primary key
        $this->dbforge->add_key('Posts_Images_ID', TRUE);

        // Create table
        $this->dbforge->create_table('Posts_Images');
    }


    public function down()
    {
        $this->dbforge->drop_table('Groups');
        $this->dbforge->drop_table('Posts_Images');
    }

}