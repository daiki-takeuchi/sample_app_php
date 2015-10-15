<?php

/**
 * Created by PhpStorm.
 * User: DaikiTakeuchi
 * Date: 2015/09/26
 * Time: 14:20
 */
class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->smarty->template_dir = APPPATH . 'views';
        $this->smarty->compile_dir = APPPATH . 'views/templates_c';

        $this->load->helper('url');
    }

    /**
     * @param String $template
     * @return void
     */
    public function display($template)
    {
        $this->smarty->display($template);
    }
}