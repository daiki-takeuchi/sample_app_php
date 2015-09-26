<?php

/**
 * Created by PhpStorm.
 * User: DaikiTakeuchi
 * Date: 2015/09/26
 * Time: 14:20
 */
class MY_Controller extends CI_Controller
{
    protected $template;

    public function __construct()
    {
        parent::__construct();
        $this->smarty->template_dir = APPPATH . 'views';
        $this->smarty->compile_dir = APPPATH . 'views/templates_c';

        $this->load->helper('url');
    }

    public function display($template)
    {
//        $this->template = $template;
        $this->smarty->display($template);
    }

//    public function _output($output)
//    {
//        if (strlen($output) > 0) {
//            echo $output;
//        } else {
//            $this->smarty->display($this->template);
//        }
//    }
}