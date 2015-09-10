<?php

class UsersSeeder extends Seeder
{
    public function run()
    {
        $this->db->truncate('users');

        $data = [
            'email' => 'email1@example.com',
            'name' => '名前１',
            'password' => md5('email1@example.com'.'password'),
        ];
        $this->db->insert('users', $data);

        $data = [
            'email' => 'email2@example.com',
            'name' => '名前２',
            'password' => md5('email2@example.com'.'password'),
        ];
        $this->db->insert('users', $data);

        $data = [
            'email' => 'email3@example.com',
            'name' => '名前３',
            'password' => md5('email3@example.com'.'password'),
        ];
        $this->db->insert('users', $data);
    }
}