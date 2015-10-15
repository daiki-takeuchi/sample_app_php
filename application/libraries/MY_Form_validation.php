<?php

/**
 * Created by PhpStorm.
 * User: DaikiTakeuchi
 * Date: 2015/10/16
 * Time: 2:46
 */
class MY_Form_validation extends CI_Form_validation
{
    function validate_credentials()
    {
        $email = $this->CI->input->post("email");
        $password = $this->CI->input->post("password");
        $this->CI->load->model("users_model");

        if($this->CI->users_model->can_log_in($email, $password)) {
            return true;
        } else {
            $this->set_message("validate_credentials", "ユーザー名かパスワードが異なります。");
            return false;
        }
    }
}