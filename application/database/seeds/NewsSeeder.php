<?php

class NewsSeeder extends Seeder
{
    public function run()
    {
        $this->db->truncate('news');

        $data = [
            'title' => 'タイトル１',
            'text' => '内容１',
            'created_at' => date('Y/m/d H:i:s'),
            'updated_at' => date('Y/m/d H:i:s')
        ];
        $this->db->insert('news', $data);

        $data = [
            'title' => 'タイトル２',
            'text' => '内容２',
            'created_at' => date('Y/m/d H:i:s'),
            'updated_at' => date('Y/m/d H:i:s')
        ];
        $this->db->insert('news', $data);

        $data = [
            'title' => 'タイトル３',
            'text' => '内容３',
            'created_at' => date('Y/m/d H:i:s'),
            'updated_at' => date('Y/m/d H:i:s')
        ];
        $this->db->insert('news', $data);
    }
}