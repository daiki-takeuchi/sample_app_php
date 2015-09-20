<?php

class NewsSeeder extends Seeder
{
    public function run()
    {
        $this->db->truncate('news');

        $this->db->select_max('id');
        $query = $this->db->get('users')->result_array();
        $author_id = $query[0]['id'];

        $data = [
            'title' => 'タイトル１',
            'text' => '内容１',
            'created_at' => date('Y/m/d H:i:s'),
            'updated_at' => date('Y/m/d H:i:s'),
            'author_id' => $author_id
        ];
        $this->db->insert('news', $data);

        $data = [
            'title' => 'タイトル２',
            'text' => '内容２',
            'created_at' => date('Y/m/d H:i:s'),
            'updated_at' => date('Y/m/d H:i:s'),
            'author_id' => $author_id
        ];
        $this->db->insert('news', $data);

        $data = [
            'title' => 'タイトル３',
            'text' => '内容３',
            'created_at' => date('Y/m/d H:i:s'),
            'updated_at' => date('Y/m/d H:i:s'),
            'author_id' => $author_id
        ];
        $this->db->insert('news', $data);
    }
}