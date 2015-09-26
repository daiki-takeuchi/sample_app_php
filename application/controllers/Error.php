<?php

/**
 * Created by PhpStorm.
 * User: DaikiTakeuchi
 * Date: 2015/09/19
 * Time: 12:27
 */
class Error extends MY_Controller
{
    /**
     * エラー画面を表示
     */
    function error_404() {
        $this->output->set_status_header('404');
        $this->display('errors/404.tpl');
    }
}