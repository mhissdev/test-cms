<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
*   20180626102300_add_users.php
*   Creates the Users and Groups table
*   mhissdev: 26.06.2018   
*/

class Migration_Add_users extends CI_Migration{

    public function up()
    {   ////////////////////////////////////////////////
        // Create User fields
        ////////////////////////////////////////////////
        $this->dbforge->add_field(array(
            'User_ID' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'User_Email' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'User_Password' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'User_Firstname' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'User_Lastname' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'Group_ID' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
        ));

        // Set primary key
        $this->dbforge->add_key('User_ID', TRUE);

        // Create table
        $this->dbforge->create_table('Users');

        ////////////////////////////////////////////////
        // Create Groups fields
        ////////////////////////////////////////////////
        $this->dbforge->add_field(array(
            'Group_ID' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'Group_Title' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
        ));

        // Set primary key
        $this->dbforge->add_key('Group_ID', TRUE);

        // Create table
        $this->dbforge->create_table('Groups');

        // Seed table
        $this->seedUserGroups();
    }


    public function down()
    {
        $this->dbforge->drop_table('Groups');
        $this->dbforge->drop_table('Users');
    }


    /**
    * Seeds the Groups table
    * @return void
    */
    private function seedUserGroups()
    {
        // Load user groups model
        $this->load->model('group_model');
        $this->group_model->insert('Pending');
        $this->group_model->insert('Suspended');
        $this->group_model->insert('Admin');
        $this->group_model->insert('Editor');
        $this->group_model->insert('User');
    }

}