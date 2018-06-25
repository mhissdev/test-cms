<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
*   20180622170100_add_posts.php
*   Creates the Post_Categories table
*   mhissdev: 22.06.2018   
*/

class Migration_Add_categories extends CI_Migration{

    public function up()
    {   
        // Create fields
        $this->dbforge->add_field(array(
            'Post_Category_ID' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'Post_Category_Title' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
        ));

        // Set primary key
        $this->dbforge->add_key('Post_Category_ID', TRUE);

        // Create table
        $this->dbforge->create_table('Post_Categories');
    }


    public function down()
    {
        $this->dbforge->drop_table('Categories');
    }

}