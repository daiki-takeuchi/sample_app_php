<?php

class Pages extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->smarty->template_dir = APPPATH . 'views';
        $this->smarty->compile_dir = APPPATH . 'views/templates_c';
    }

    public function index($page = 'home')
    {
        if (!file_exists(APPPATH . '/views/pages/' . $page . '.tpl')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $this->smarty->display('pages/' . $page . '.tpl');
    }

    public function about()
    {
        $this->smarty->display('pages/about.tpl');
    }

    public function contact()
    {
        $this->smarty->display('pages/contact.tpl');
    }

    public function help()
    {
        $this->smarty->display('pages/help.tpl');
    }
}