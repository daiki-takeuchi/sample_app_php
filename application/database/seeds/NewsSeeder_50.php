<?php

class NewsSeeder_50 extends Seeder
{
    public function run()
    {
        $this->db->truncate('news');

        $this->db->select_max('id');
        $query = $this->db->get('users')->result_array();
        $author_id = $query[0]['id'];

        for ($num = 1; $num < 50; $num++){
            $data = [
                'title' => 'タイトル'.$num,
                'text' => '内容'.$num,
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s'),
                'author_id' => $author_id
            ];
            $this->db->insert('news', $data);
        }
    }
}