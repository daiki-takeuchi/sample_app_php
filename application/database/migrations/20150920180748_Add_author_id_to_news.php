<?php

/**
 * Migration: Add_author_id_to_news
 *
 * Created by: Cli for CodeIgniter <https://github.com/kenjis/codeigniter-cli>
 * Created on: 2015/09/20 18:07:48
 */
class Migration_Add_author_id_to_news extends CI_Migration
{

    public function up()
    {
        // Adding a Column to a Table
        $fields = array(
            'author_id' => array('type' => 'int'),
        );
        $this->dbforge->add_column('news', $fields);
    }

    public function down()
    {
        // Dropping a Column From a Table
        $this->dbforge->drop_column('news', 'author_id');
    }

}
