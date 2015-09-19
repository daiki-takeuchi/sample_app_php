<?php

/**
 * Created by PhpStorm.
 * User: DaikiTakeuchi
 * Date: 2015/09/19
 * Time: 12:27
 */
class Error extends CI_Controller
{
    /**
     * コンストラクタ
     */
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->smarty->template_dir = APPPATH . 'views';
        $this->smarty->compile_dir = APPPATH . 'views/templates_c';
    }

    /**
     * エラー画面を表示
     */
    function error_404() {
        $this->output->set_status_header('404');
        $this->smarty->display('errors/404.tpl');
    }
}