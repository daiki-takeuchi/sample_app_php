<?php

/**
 * Migration: Create_news
 *
 * Created by: Cli for CodeIgniter <https://github.com/kenjis/codeigniter-cli>
 * Created on: 2015/09/10 16:15:47
 */
class Migration_Create_news extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'bigserial',
                'auto_increment' => TRUE
            ),
            'title' => array(
                'type' => 'varchar',
                'constraint' => '128',
            ),
            'slug' => array(
                'type' => 'varchar',
                'constraint' => '128',
            ),
            'text' => array(
                'type' => 'text',
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('news');
    }

    public function down()
    {
        $this->dbforge->drop_table('news');
    }
}
