<?php

class Seeder_test extends TestCase
{
    public function setUp()
    {
        $this->obj = new Seeder();
        $this->resetInstance();
        $this->CI->load->model('News_model');
        $this->news_model = $this->CI->News_model;
    }

    /**
     * @test
     */
    public function Seederの実行()
    {
        $expected = 3;
        $this->obj->call('NewsSeeder');
        $this->assertEquals($expected, $this->news_model->get_count_all());
    }

    /**
     * @test
     */
    public function マジックメソッドの確認()
    {
        $expected = 3;
        $this->obj->load->model('Users_model');
        $this->obj->call('UsersSeeder');
        $this->users_model = $this->CI->Users_model;
        $sut = $this->users_model->find();

        $this->assertEquals($expected, count($sut));
    }
}