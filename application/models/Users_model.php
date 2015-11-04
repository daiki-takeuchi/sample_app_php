<?php

class Users_model extends MY_Model
{
    protected $table = 'users';

    public function can_log_in($email, $password){

        $this->db->where("email", $email);
        $this->db->where("password", sha1($email.$password));
        $query = $this->db->get($this->table);

        if($query->num_rows() === 1){
            return true;
        }else{
            return false;
        }
    }

    public function find_by_email($email = FALSE)
    {
        $query = $this->db->get_where($this->table, array('email' => $email));
        return $query->row_array();
    }

    public function get_users($offset = FALSE)
    {
        $this->db->order_by('id', 'desc');
        if($offset !== FALSE){
            $this->db->limit($this->per_page, $offset);
        }
        return $this->find();
    }
}