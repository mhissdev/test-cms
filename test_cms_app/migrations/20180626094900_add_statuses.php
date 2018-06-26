<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
*   20180626094900_add_statuses.php
*   Creates the Post_Statuses table
*   mhissdev: 26.06.2018   
*/

class Migration_Add_statuses extends CI_Migration{

    public function up()
    {   
        // Create fields
        $this->dbforge->add_field(array(
            'Post_Status_ID' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'Post_Status_Title' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
        ));

        // Set primary key
        $this->dbforge->add_key('Post_Status_ID', TRUE);

        // Create table
        $this->dbforge->create_table('Post_Statuses');
    }


    public function down()
    {
        $this->dbforge->drop_table('Statuses');
    }

}