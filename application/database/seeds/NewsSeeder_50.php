<?php

class NewsSeeder_50 extends Seeder
{
    public function run()
    {
        $this->db->truncate('news');

        for ($num = 1; $num < 50; $num++){
            $data = [
                'title' => 'タイトル'.$num,
                'slug' => 'タイトル'.$num,
                'text' => '内容'.$num,
                'created_at' => date('Y/m/d H:i:s'),
                'updated_at' => date('Y/m/d H:i:s')
            ];
            $this->db->insert('news', $data);
        }
    }
}