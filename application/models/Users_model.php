<?php

class Users_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function can_log_in(){

        $this->db->where("email", $this->input->post("email"));
        $this->db->where("password", md5($this->input->post("email").$this->input->post("password")));
        $query = $this->db->get("users");

        if($query->num_rows() == 1){
            return true;
        }else{
            return false;
        }
    }

    public function get_users($id = FALSE)
    {
        if ($id === FALSE) {
            $this->db->select('id, email, name, password');
            $this->db->from('users');
            $this->db->order_by('id', 'desc');

            // SQLを実行
            $query = $this->db->get();
            log_message('info', $this->db->last_query());
            return $query->result_array();
        }

        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row_array();
    }

    public function get_users_by_email($email = FALSE)
    {
        if ($email === FALSE) {
            $this->db->select('id, email, name, password');
            $this->db->from('users');
            $this->db->order_by('id', 'desc');

            // SQLを実行
            $query = $this->db->get();
            log_message('info', $this->db->last_query());
            return $query->result_array();
        }

        $query = $this->db->get_where('users', array('email' => $email));
        return $query->row_array();
    }
}