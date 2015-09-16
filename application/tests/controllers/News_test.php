<?php

class News_test extends TestCase
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
    public function ログインせずnewsページへ移動した場合はアクセス禁止ページを表示()
    {
        // TODO アクセス禁止ページはこれから作る予定
        $this->request('GET', ['News', 'index']);
    }

    /**
     * @test
     */
    public function newsページへ移動した場合は一覧ページを表示()
    {
        $data = [
            'email' => 'email1@example.com',
            'password' => 'password',
        ];
        // ログインする
        $this->request('POST', ['Pages', 'login'], $data);

        // Verify
        $output = $this->request('GET', ['News', 'index']);
        $this->assertContains('ニュース一覧', $output);

        // Teardown ログアウト
        $this->request('GET', ['Pages', 'logout']);

    }


    /**
     * @test
     */
    public function paginationで次のページへ移動する()
    {
        // Setup ログイン
        $data = [
            'email' => 'email1@example.com',
            'password' => 'password',
        ];
        $this->request('POST', ['Pages', 'login'], $data);

        // Exercise
        $output = $this->request('GET', ['News', 'pages', '10']);

        // Verify
        $this->assertContains('タイトル30', $output);

        // Teardown ログアウト
        $this->request('GET', ['Pages', 'logout']);
    }

    /**
     * @test
     */
    public function ニュース詳細に遷移する()
    {
        // Setup ログイン
        $data = [
            'email' => 'email1@example.com',
            'password' => 'password',
        ];
        $this->request('POST', ['Pages', 'login'], $data);

        // SetUp データ
        $news = array(
            'title' => '単体テスト_title_ニュース詳細遷移',
            'text' => '単体テスト_text_ニュース詳細遷移',
            'slug' => url_title('単体テスト_title_ニュース詳細遷移', 'dash', TRUE),
        );
        $this->news_model->save($news);

        // Exercise
        $output = $this->request('GET', ['News', 'view' ,$news['id']]);

        // Verify
        $this->assertContains('単体テスト_title_ニュース詳細遷移', $output);

        // Teardown ログアウト
        $this->request('GET', ['Pages', 'logout']);
    }

    /**
     * @test
     */
    public function test_method_404()
    {
        $this->request('GET', ['News', 'method_not_exist']);
        $this->assertResponseCode(404);
    }

    /**
     * @test
     */
    public function test_APPPATH()
    {
        $actual = realpath(APPPATH);
        $expected = realpath(__DIR__ . '/../..');
        $this->assertEquals(
            $expected,
            $actual,
            'Your APPPATH seems to be wrong. Check your $application_folder in tests/Bootstrap.php'
        );
    }
}
