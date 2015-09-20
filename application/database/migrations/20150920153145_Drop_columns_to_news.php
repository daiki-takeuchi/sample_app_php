<?php

/**
 * Migration: Drop_columns_to_news
 *
 * Created by: Cli for CodeIgniter <https://github.com/kenjis/codeigniter-cli>
 * Created on: 2015/09/20 15:31:45
 */
class Migration_Drop_columns_to_news extends CI_Migration
{

    public function up()
    {
        // Dropping a Column From a Table
        $this->dbforge->drop_column('news', 'slug');
    }

    public function down()
    {
        // Adding a Column to a Table
        $fields = array(
            'slug' => array(
                'type' => 'varchar',
                'constraint' => '128',
            )
        );
        $this->dbforge->add_column('news', $fields);
    }
}