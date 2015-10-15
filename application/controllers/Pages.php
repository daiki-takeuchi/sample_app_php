<?php

class Pages extends MY_Controller
{
    public function index($page = 'home')
    {
        if (!file_exists(APPPATH . '/views/pages/' . $page . '.tpl')) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $this->display('pages/' . $page . '.tpl');
    }

    public function login()
    {
        // ログインしている場合はホームに移動
        if($this->session->userdata("is_logged_in")) {
            redirect(site_url());
        }

        if (isset($_POST)) {
            $this->_login_validation();
        }
        $data['post'] = $_POST;

        $this->smarty->assign($data);
        $this->display('pages/login.tpl');
    }

    private function _login_validation()
    {
        $this->load->library("form_validation");

        if ($this->form_validation->run('login') !== FALSE) {
            $email = $this->input->post("email");
            $user = $this->users_model->find_by_email($email);
            $data = array(
                "user" => $user,
                "is_logged_in" => 1
            );
//            var_dump($data);
            $this->session->set_userdata($data);
            redirect(site_url());
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(site_url());
    }

    public function about()
    {
        $this->display('pages/about.tpl');
    }

    public function contact()
    {
        $this->display('pages/contact.tpl');
    }

    public function help()
    {
        $this->display('pages/help.tpl');
    }
}