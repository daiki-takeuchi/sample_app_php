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
        $expected = 3;
        $limit = array(
            'limit' => 10,
            'offset' => 0
        );
        $actual = $this->obj->get_news(FALSE, $limit);
        $this->assertEquals($expected, count($actual));
    }

    /**
     * @test
     */
    public function ニュースの件数を取得()
    {
        $expected = 3;
        $actual = $this->obj->get_count_all();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function ニュースを新規登録する()
    {
        $news = array(
            'title' => '単体テスト_title',
            'text' => '単体テスト_text',
            'slug' => url_title('単体テスト_title', 'dash', TRUE),
        );
        $this->obj->save($news);
    }
}
