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
        $this->news_model = $this->CI->News_model;
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
        $actual = $this->news_model->get_news(FALSE, $limit);
        $this->assertEquals($expected, count($actual));
    }

    /**
     * @test
     */
    public function idを指定してニュースを取得()
    {

        // setUp
        $news = array(
            'title' => '単体テスト_title_id指定',
            'text' => '単体テスト_text_id指定',
            'slug' => url_title('単体テスト_title_id指定', 'dash', TRUE),
        );
        $this->news_model->save($news);

        // exercise
        $expected = $news;
        $limit = array(
            'limit' => 1,
            'offset' => 0
        );
        $actual = $this->news_model->get_news($news['id'], $limit);

        // verify
        $this->assertEquals(sort($expected), sort($actual));

        // tearDown
        $this->news_model->delete($news);
    }

    /**
     * @test
     */
    public function ニュースの件数を取得()
    {
        $expected = 3;
        $actual = $this->news_model->get_count_all();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function ニュースを新規登録する()
    {
        // test
        $news = array(
            'title' => '単体テスト_title',
            'text' => '単体テスト_text',
            'slug' => url_title('単体テスト_title', 'dash', TRUE),
        );
        $this->news_model->save($news);

        // tearDown
        $this->news_model->delete($news);

    }

    /**
     * @test
     */
    public function ニュースを更新する()
    {
        $expected = '単体テスト_title_更新';

        // setUp
        $news = array(
            'title' => '単体テスト_title_更新前',
            'text' => '単体テスト_text_更新前',
            'slug' => url_title('単体テスト_title_更新前', 'dash', TRUE),
        );
        $this->news_model->save($news);

        $sut = $this->news_model->get_news($news['id']);
        $sut['title'] = $expected;

        // test
        $this->news_model->save($sut);

        $actual = $this->news_model->get_news($news['id'])['title'];

        $this->assertEquals($expected, $actual);

        // tearDown
        $this->news_model->delete($news);
    }
}
