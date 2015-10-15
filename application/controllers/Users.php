<?php

class Users extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
    }

    public function view($id = NULL)
    {
        $data['user_item'] = $this->users_model->find($id);

        if (empty($data['user_item'])) {
            $this->display('users/not_found.tpl');
            return;
        }

        $data['title'] = $data['user_item']['name'];

        $this->smarty->assign($data);
        $this->display('users/view.tpl');

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
        $this->display('users/user_form.tpl');
    }

    private function _get_user($id = NULL)
    {
        if ($id === NULL) {
            $user = array();
        } else {
            $user = $this->users_model->find($id);
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

        $user['email'] = $this->input->post('email');
        $user['name'] = $this->input->post('name');
        $user['password'] = sha1($this->input->post('email').$this->input->post('password'));

        if ($this->form_validation->run('user') !== FALSE) {

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