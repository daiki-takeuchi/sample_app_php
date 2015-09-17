<?php

class Users_test extends TestCase
{

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();

        $CI =& get_instance();
        $CI->load->library('Seeder');
        $CI->seeder->call('UsersSeeder');
    }

    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('Users_model');
        $this->users_model = $this->CI->Users_model;
    }

    /**
     * @test
     */
    public function 詳細ページに遷移できる()
    {
        $user = $this->users_model->get_users()[0];

        // Verify
        $output = $this->request('GET', ['Users', 'view', $user['id']]);
        $this->assertContains($user['name'], $output);
    }

    /**
     * @test
     */
    public function 存在しないユーザーの場合は存在しませんページに遷移する()
    {
        $user = $this->users_model->get_users()[0];

        // Verify
        $output = $this->request('GET', ['Users', 'view', $user['id'] + 1]);
//        $this->assertContains($user['name'], $output);
    }
}
