<?php
class News_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_news($id = FALSE, $limit = NULL)
    {
        if ($id === FALSE) {
            $this->db->order_by('id', 'desc');
            if(isset($limit)){
                $this->db->limit($limit['limit'], $limit['offset']);
            }

            // SQLを実行
            $query = $this->db->get('news');
            log_message('info', $this->db->last_query());
            return $query->result_array();
        }

        $query = $this->db->get_where('news', array('id' => $id));
        return $query->row_array();
    }

    public function get_count_all()
    {
        return $this->db->count_all_results('news');
    }

    public function save(&$news)
    {
        if (!isset($news['id'])) {
            $news['created_at'] = date('Y/m/d H:i:s');
            $news['updated_at'] = date('Y/m/d H:i:s');
            $this->db->insert('news', $news);
            $news['id'] = $this->db->insert_id();
        } else {
            $news['updated_at'] = date('Y/m/d H:i:s');
            $this->db->where('id', $news['id']);
            $this->db->update('news', $news);
        }
        log_message('info', $this->db->last_query());
    }

    public function delete(&$news)
    {
        $this->db->where('id', $news['id']);
        $this->db->delete('news');
        log_message('info', $this->db->last_query());
    }
}