<?php

/**
 * Migration: Add_columns_to_news
 *
 * Created by: Cli for CodeIgniter <https://github.com/kenjis/codeigniter-cli>
 * Created on: 2015/09/11 02:37:11
 */
class Migration_Add_columns_to_news extends CI_Migration
{
    public function up()
    {
        // Adding a Column to a Table
        $fields = array(
            'created_at' => array('type' => 'TIMESTAMP'),
            'updated_at' => array('type' => 'TIMESTAMP'),
        );
        $this->dbforge->add_column('news', $fields);
    }

    public function down()
    {
        // Dropping a Column From a Table
        $this->dbforge->drop_column('news', 'created_at');
    }
}
