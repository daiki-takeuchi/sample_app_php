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
        $data = [
            'email' => 'email1@example.com',
            'password' => 'password',
        ];
        // ログインする
        $this->request('POST', ['Pages', 'login'], $data);

        $this->resetInstance();
        $this->CI->load->model('News_model');
        $this->news_model = $this->CI->News_model;
    }

    public function tearDown()
    {
        // Teardown ログアウト
        $this->request('GET', ['Pages', 'logout']);
    }

    /**
     * @test
     */
    public function newsページへ移動した場合は一覧ページを表示()
    {
        // Verify
        $output = $this->request('GET', ['News', 'index']);
        $this->assertContains('ニュース一覧', $output);
    }


    /**
     * @test
     */
    public function paginationで次のページへ移動する()
    {
        // Exercise
        $output = $this->request('GET', ['News', 'pages', '10']);

        // Verify
        $this->assertContains('タイトル30', $output);
    }

    /**
     * @test
     */
    public function ニュース詳細に遷移する()
    {
        // SetUp データ
        $news = array(
            'title' => '単体テスト_title_ニュース詳細遷移',
            'text' => '単体テスト_text_ニュース詳細遷移',
        );
        $this->news_model->save($news);

        // Exercise
        $output = $this->request('GET', ['News', 'view' ,$news['id']]);

        // Verify
        $this->assertContains('単体テスト_title_ニュース詳細遷移', $output);

        // Teardown データ
        $this->news_model->delete($news);
    }

    /**
     * @test
     */
    public function 存在しないニュース詳細に遷移すると記事が存在しないページへ遷移()
    {
        // SetUp データ
        $news = array(
            'title' => '単体テスト_title_ニュース詳細遷移',
            'text' => '単体テスト_text_ニュース詳細遷移',
        );
        $this->news_model->save($news);

        // Exercise
        $output = $this->request('GET', ['News', 'view' ,$news['id'] + 1]);

        // Verify
        $this->assertContains('News Not Found', $output);

        // TearDown データ
        $this->news_model->delete($news);
    }

    /**
     * @test
     */
    public function 新規登録画面に遷移する()
    {
        $output = $this->request('GET', ['News', 'create']);
        $this->assertContains('ニュース登録', $output);
    }

    /**
     * @test
     */
    public function ニュース登録できること()
    {
        $before = count($this->news_model->find());

        // Exercise
        $news = [
            'title' => 'タイトル_テスト',
            'text' => '内容_テスト',
        ];
        $this->request('POST', ['News', 'create'], $news);

        $after = count($this->news_model->find());

        // 更新前の件数に1件追加されている
        $this->assertEquals($before + 1, $after);
    }

    /**
     * @test
     */
    public function タイトルを入力してない場合は登録できない()
    {
        $before = count($this->news_model->get_news());

        $news = [
            'title' => '',
            'text' => '内容_テスト',
        ];
        $output = $this->request('POST', ['News', 'create'], $news);
        $this->assertContains('タイトル 欄は必須です。', $output);

        $after = count($this->news_model->get_news());

        // 更新前後で件数が変わらない
        $this->assertEquals($before, $after);
    }

    /**
     * @test
     */
    public function 内容を入力してない場合は登録できない()
    {
        $before = count($this->news_model->get_news());

        $news = [
            'title' => 'タイトル_テスト',
            'text' => '',
        ];
        $output = $this->request('POST', ['News', 'create'], $news);
        $this->assertContains('内容 欄は必須です。', $output);

        $after = count($this->news_model->get_news());

        // 更新前後で件数が変わらない
        $this->assertEquals($before, $after);
    }

    /**
     * @test
     */
    public function ニュース編集に遷移する()
    {
        // SetUp データ
        $news = array(
            'title' => '単体テスト_title_ニュース編集遷移',
            'text' => '単体テスト_text_ニュース編集遷移',
        );
        $this->request('POST', ['News', 'create'], $news);
        $this->news_model->save($news);

        // Exercise
        $output = $this->request('GET', ['News', 'edit' ,$news['id']]);

        // Verify
        $this->assertContains('単体テスト_title_ニュース編集遷移', $output);

        // Teardown データ
        $this->news_model->delete($news);
    }

    /**
     * @test
     */
    public function ニュースが編集できる()
    {
        // SetUp データ
        $news = array(
            'title' => 'タイトル変更前',
            'text' => '内容変更前',
        );
        $this->news_model->save($news);

        $post = [
            'title' => 'タイトル変更後',
            'text' => '内容変更後',
        ];
        // Exercise
        $this->request('POST', ['News', 'edit' ,$news['id']], $post);
        $sut = $this->news_model->find($news['id']);

        // Verify
        $this->assertEquals('タイトル変更後', $sut['title']);
        $this->assertEquals('内容変更後', $sut['text']);
        // 詳細ページにリダイレクトする
        $this->assertRedirect('/news/'.$news['id']);

        // Teardown データ
        $this->news_model->delete($news);
    }

    /**
     * @test
     */
    public function ニュースが削除できる()
    {
        $news = array(
            'title' => '単体テスト_title_削除用',
            'text' => '単体テスト_text_削除用',
        );
        $this->news_model->save($news);

        $before = count($this->news_model->find());

        $this->request('GET', ['News', 'delete', $news['id']]);

        $after = count($this->news_model->find());

        // 更新前の件数に1件削除されている
        $this->assertEquals($before - 1, $after);
    }

    /**
     * @test
     */
    public function 存在しないニュースは削除できない()
    {
        $news = $this->news_model->get_news()[0];

        $before = count($this->news_model->find());

        $this->request('GET', ['News', 'delete', $news['id'] + 1]);

        $after = count($this->news_model->find());

        // 更新前後の件数が変わらない
        $this->assertEquals($before, $after);
    }

    /**
     * @test
     */
    public function 引数Nullの場合は削除できない()
    {
        $before = count($this->news_model->find());

        $this->request('GET', ['News', 'delete']);

        $after = count($this->news_model->find());

        // 更新前後の件数が変わらない
        $this->assertEquals($before, $after);
    }

    /**
     * @test
     */
    public function エクセルをダウンロードする()
    {
        $this->request('GET', ['News', 'download']);
    }

    /**
     * @test
     */
    public function test_method_404()
    {
        $this->request('GET', ['News', 'method_not_exist']);
        $this->assertResponseCode(404);
    }
}