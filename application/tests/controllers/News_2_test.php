<?php

// ログインしない場合
class News_2_test extends TestCase
{

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();

        $CI =& get_instance();
        $CI->load->library('Seeder');
        $CI->seeder->call('UsersSeeder');
        $CI->seeder->call('NewsSeeder_50');
    }

    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('News_model');
        $this->news_model = $this->CI->News_model;
    }

    /**
     * @test
     */
    public function ログインせずnewsページへ移動した場合はホームに移動する()
    {
        $this->request('GET', ['News', 'index']);
        $this->assertRedirect('/');
    }
}