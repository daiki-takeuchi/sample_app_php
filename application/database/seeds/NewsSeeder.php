<?php

class NewsSeeder extends Seeder
{
    public function run()
    {
        $this->db->truncate('news');

        $data = [
            'title' => 'タイトル１',
            'slug' => 'タイトル１',
            'text' => '内容１',
        ];
        $this->db->insert('news', $data);

        $data = [
            'title' => 'タイトル２',
            'slug' => 'タイトル２',
            'text' => '内容２',
        ];
        $this->db->insert('news', $data);

        $data = [
            'title' => 'タイトル３',
            'slug' => 'タイトル３',
            'text' => '内容３',
        ];
        $this->db->insert('news', $data);
    }
}