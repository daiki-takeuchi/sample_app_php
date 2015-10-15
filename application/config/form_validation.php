<?php
$config = array(
    'user' => array(
        array(
            'field' => 'name',
            'label' => '名前',
            'rules' => 'required'
        ),
        array(
            'field' => 'email',
            'label' => 'メールアドレス',
            'rules' => 'required|trim|valid_email'
        ),
        array(
            'field' => 'password',
            'label' => 'パスワード',
            'rules' => 'required|trim|matches[password_confirmation]'
        ),
        array(
            'field' => 'password_confirmation',
            'label' => 'パスワードの確認',
            'rules' => 'required|trim'
        )
    ),
    'news' => array(
        array(
            'field' => 'title',
            'label' => 'タイトル',
            'rules' => 'required'
        ),
        array(
            'field' => 'text',
            'label' => '内容',
            'rules' => 'required'
        )
    )
);