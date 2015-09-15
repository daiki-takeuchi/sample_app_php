<?php

class Users_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function can_log_in($email, $password){

        $this->db->where("email", $email);
        $this->db->where("password", sha1($email.$password));
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
            $this->db->order_by('id', 'desc');
            $query = $this->db->get('users');

            log_message('info', $this->db->last_query());
            return $query->result_array();
        }

        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row_array();
    }

    public function get_users_by_email($email = FALSE)
    {
        $query = $this->db->get_where('users', array('email' => $email));
        return $query->row_array();
    }


    public function save(&$users)
    {
        if (!isset($users['id'])) {
            $users['created_at'] = date('Y/m/d H:i:s');
            $users['updated_at'] = date('Y/m/d H:i:s');
            $this->db->insert('users', $users);
            $users['id'] = $this->db->insert_id();
        } else {
            $users['updated_at'] = date('Y/m/d H:i:s');
            $this->db->where('id', $users['id']);
            $this->db->update('users', $users);
        }
        log_message('info', $this->db->last_query());
    }

    public function delete(&$users)
    {
        $this->db->where('id', $users['id']);
        $this->db->delete('users');
        log_message('info', $this->db->last_query());
    }
}