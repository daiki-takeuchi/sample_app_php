<?php

class UsersSeeder extends Seeder
{
    public function run()
    {
        $this->db->truncate('users');

        $data = [
            'email' => 'email1@example.com',
            'name' => '名前１',
            'password' => sha1('email1@example.com'.'password'),
            'created_at' => date('Y/m/d H:i:s'),
            'updated_at' => date('Y/m/d H:i:s')
        ];
        $this->db->insert('users', $data);

        $data = [
            'email' => 'email2@example.com',
            'name' => '名前２',
            'password' => sha1('email2@example.com'.'password'),
            'created_at' => date('Y/m/d H:i:s'),
            'updated_at' => date('Y/m/d H:i:s')
        ];
        $this->db->insert('users', $data);

        $data = [
            'email' => 'email3@example.com',
            'name' => '名前３',
            'password' => sha1('email3@example.com'.'password'),
            'created_at' => date('Y/m/d H:i:s'),
            'updated_at' => date('Y/m/d H:i:s')
        ];
        $this->db->insert('users', $data);
    }
}