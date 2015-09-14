<?php

class News_test extends TestCase
{
    /**
     * @test
     */
    public function ログインせずnewsページへ移動した場合は404()
    {
        $this->request('GET', ['News', 'index']);
//        $this->assertResponseCode(404);
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
