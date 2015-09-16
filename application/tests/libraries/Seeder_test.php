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
        $this->obj->call('NewsSeeder');
        $this->assertEquals(3, $this->news_model->get_count_all());
    }

    /**
     * @test
     */
    public function マジックメソッドの確認()
    {
        $seeder = new Seeder();
        $seeder->load;
//        $expected = 3;
//        $this->obj->abc = $expected;
//        $actual = $this->obj->abc;
//        $this->assertEquals($expected, $actual);
    }
}