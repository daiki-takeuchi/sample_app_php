<?php
class News_model extends MY_Model
{
    protected $table = 'news';
    protected $per_page = 10;

    public function get_news($offset = FALSE)
    {
        $this->db->order_by('id', 'desc');
        if($offset !== FALSE){
            $this->db->limit($this->per_page, $offset);
        }
        return $this->find();
    }
}