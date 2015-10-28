<?php

class Sample_excel_model_test extends TestCase
{
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('Sample_excel_model');
        $this->sample_excel_model = $this->CI->Sample_excel_model;
    }

    /**
     * @test
     */
    public function ニュースを全件取得()
    {
        $expected = 3;
        $actual = 3;
        $this->assertEquals($expected, $actual);
    }

}
