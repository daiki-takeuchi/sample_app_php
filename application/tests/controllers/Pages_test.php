<?php

/**
 * Created by PhpStorm.
 * User: daiki_takeuchi
 * Date: 2015/09/08
 * Time: 8:41
 */
class Pages_test extends TestCase
{

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();

        $CI =& get_instance();
        $CI->load->library('Seeder');
        $CI->seeder->call('UsersSeeder');
    }

    /**
     * @test
     */
    public function 引数なしでindexページへ移動した場合はホームへ遷移()
    {
        $output = $this->request('GET', ['Pages', 'index']);
        $this->assertContains('ようこそホームへ！', $output);
    }

    /**
     * @test
     */
    public function 引数にaboutを指定した場合はaboutページへ遷移()
    {
        $output = $this->request('GET', ['Pages', 'index','about']);
        $this->assertContains('about', $output);
    }

    /**
     * @test
     */
    public function 引数に存在しないページを指定した場合は404へ遷移()
    {
        $this->request('GET', ['Pages', 'index', 'aaa']);
        $this->assertResponseCode(404);
    }

    /**
     * @test
     */
    public function aboutページ遷移する()
    {
        $output = $this->request('GET', 'about');
        $this->assertContains('about', $output);
    }

    /**
     * @test
     */
    public function contactページ遷移する()
    {
        $output = $this->request('GET', 'contact');
        $this->assertContains('<title>Contact</title>', $output);
    }

    /**
     * @test
     */
    public function helpページ遷移する()
    {
        $output = $this->request('GET', 'help');
        $this->assertContains('<title>Help</title>', $output);
    }

    /**
     * @test
     */
    public function ログインページに遷移する()
    {
        $output = $this->request('GET', 'login');
        $this->assertContains('ログインページ', $output);
    }

    /**
     * @test
     */
    public function ログインしている場合にログインするとホームに遷移()
    {
        $data = [
            'email' => 'email1@example.com',
            'password' => 'password',
        ];
        // ログインするとホームに遷移する
        $this->request('POST', 'login', $data);
        $this->assertRedirect('/', 302);

        // ログイン状態でログイン画面に遷移するとホームに遷移する
        $this->request('GET', 'login');
        $this->assertRedirect('/', 302);
    }

    /**
     * @test
     */
    public function ログインしている場合にログアウトするとホームに遷移()
    {
        $data = [
            'email' => 'email1@example.com',
            'password' => 'password',
        ];
        // ログインする
        $this->request('POST', 'login', $data);

        // ログアウトするとホームに遷移する
        $this->request('GET', 'logout');
        $this->assertRedirect('/', 302);
    }

    /**
     * @test
     */
    public function パスワードが違う場合はログインできない()
    {
        $data = [
            'email' => 'email1@example.com',
            'password' => 'bad password',
        ];
        // ログインする
        $output = $this->request('POST', 'login', $data);
        $this->assertContains('ユーザー名かパスワードが異なります。', $output);
    }

    /**
     * @test
     */
    public function 存在しないemailの場合はログインできない()
    {
        $data = [
            'email' => 'not_exist_email@example.com',
            'password' => 'password',
        ];
        // ログインする
        $output = $this->request('POST', 'login', $data);
        $this->assertContains('ユーザー名かパスワードが異なります。', $output);
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
