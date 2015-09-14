<?php
/**
 * Created by PhpStorm.
 * User: DaikiTakeuchi
 * Date: 2015/09/14
 * Time: 1:41
 */

class News_model_test extends TestCase
{

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();

        $CI =& get_instance();
        $CI->load->library('Seeder');
        $CI->seeder->call('NewsSeeder');
    }

    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('News_model');
        $this->obj = $this->CI->News_model;
    }

    /**
     * @test
     */
    public function ニュースを全件取得()
    {
        $limit = array(
            'limit' => 10,
            'offset' => 0
        );
        $actual = $this->obj->get_news(FALSE, $limit);
        $this->assertEquals(3, count($actual));
    }

}
