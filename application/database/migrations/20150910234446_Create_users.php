<?php

/**
 * Migration: Create_users
 *
 * Created by: Cli for CodeIgniter <https://github.com/kenjis/codeigniter-cli>
 * Created on: 2015/09/10 23:44:46
 */
class Migration_Create_users extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'bigserial',
                'auto_increment' => TRUE
            ),
            'email' => array(
                'type' => 'varchar',
                'constraint' => '255',
            ),
            'name' => array(
                'type' => 'varchar',
                'constraint' => '50',
            ),
            'password' => array(
                'type' => 'varchar',
                'constraint' => '255',
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users');
    }

    public function down()
    {
        $this->dbforge->drop_table('users');
    }
}
