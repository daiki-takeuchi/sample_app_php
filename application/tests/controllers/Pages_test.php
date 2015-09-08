<?php

/**
 * Created by PhpStorm.
 * User: daiki_takeuchi
 * Date: 2015/09/08
 * Time: 8:41
 */
class Pages_test extends TestCase
{
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
        $output = $this->request('GET', ['Pages', 'index', 'aaa']);
        $this->assertResponseCode(404);
    }

    /**
     * @test
     */
    public function aboutページ遷移する()
    {
        $output = $this->request('GET', ['Pages', 'about']);
        $this->assertContains('about', $output);
    }

    /**
     * @test
     */
    public function contactページ遷移する()
    {
        $output = $this->request('GET', ['Pages', 'contact']);
        $this->assertContains('Contact', $output);
    }

    /**
     * @test
     */
    public function helpページ遷移する()
    {
        $output = $this->request('GET', ['Pages', 'help']);
        $this->assertContains('ヘルプ | サンプルアプリケーション', $output);
    }

    /**
     * @test
     */
    public function test_method_404()
    {
        $this->request('GET', ['Page', 'method_not_exist']);
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
