<?php

/**
 * Migration: Add_columns_to_users
 *
 * Created by: Cli for CodeIgniter <https://github.com/kenjis/codeigniter-cli>
 * Created on: 2015/09/11 02:37:01
 */
class Migration_Add_columns_to_users extends CI_Migration
{
    public function up()
    {
        // Adding a Column to a Table
        $fields = array(
            'created_at' => array('type' => 'TIMESTAMP'),
            'updated_at' => array('type' => 'TIMESTAMP'),
        );
        $this->dbforge->add_column('users', $fields);
    }

    public function down()
    {
        // Dropping a Column From a Table
        $this->dbforge->drop_column('users', 'created_at');
        $this->dbforge->drop_column('users', 'updated_at');
    }
}
