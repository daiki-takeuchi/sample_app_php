<?php

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->helper('url');
        $this->smarty->template_dir = APPPATH . 'views';
        $this->smarty->compile_dir = APPPATH . 'views/templates_c';
    }

    public function view($id = NULL)
    {
        $data['user_item'] = $this->users_model->get_users($id);

        if (empty($data['user_item'])) {
            show_404();
        }

        $data['title'] = $data['user_item']['name'];

        $this->smarty->assign($data);
        $this->smarty->display('users/view.tpl');

    }

    public function create()
    {
        $this->edit();
    }

    public function edit($id = NULL)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $user = $this->_get_user($id);
        $data['title'] = $this->_get_title($user);

        if ($_POST) {
            $this->_save_user($user);
        }
        $data['user_item'] = $user;

        $this->smarty->assign($data);
        $this->smarty->display('users/user_form.tpl');
    }

    private function _get_user($id = NULL)
    {
        if ($id === NULL) {
            $user = array();
        } else {
            $user = $this->users_model->get_users($id);
        }
        return $user;
    }

    private function _get_title($user)
    {
        if ( ! isset($user['id'])) {
            return 'ユーザー登録';
        } else {
            return 'ユーザー編集';
        }
    }

    private function _save_user(&$user)
    {
        $this->form_validation->set_rules("email", "メールアドレス", "required|trim|valid_email");
        $this->form_validation->set_rules('name', '名前', 'required');
        $this->form_validation->set_rules("password", "パスワード", "required|trim|matches[password_confirmation]");
        $this->form_validation->set_rules("password_confirmation", "パスワードの確認", "required|trim");

        $user['email'] = $this->input->post('email');
        $user['name'] = $this->input->post('name');
        $user['password'] = sha1($this->input->post('email').$this->input->post('password'));

        if ($this->form_validation->run() !== FALSE) {

            $this->users_model->save($user);
            $data = array(
                "user" => $user,
                "is_logged_in" => 1
            );
            $this->session->set_userdata($data);
            redirect('/users/' . $user['id'], 'refresh');
        }
    }
}