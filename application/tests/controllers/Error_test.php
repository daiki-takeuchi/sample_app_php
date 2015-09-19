<?php

class Error_test extends TestCase
{
    /**
     * @test
     */
    public function エラー画面に遷移する()
    {
        $output = $this->request('GET', ['Error', 'error_404']);
        $this->assertContains('404 Page Not Found', $output);
    }
}
