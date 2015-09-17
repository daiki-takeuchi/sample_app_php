<?php

class TestCase extends CIPHPUnitTestCase
{
    protected static $databaseSetup = false;

    public function __construct()
    {
        $this->setUpDatabase();
    }

    protected function setUpDatabase()
    {
        if (static::$databaseSetup) {
            return;
        }
        $this->CI =& get_instance();
        $this->CI->load->library('migration');
        if ( ! $this->CI->migration->current())
        {
            $this->CI->migration->latest();
        }
        static::$databaseSetup = true;
    }
}
