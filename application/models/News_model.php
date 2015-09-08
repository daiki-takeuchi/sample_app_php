<?php
class News_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_news($id = FALSE, $limit = array())
    {
        if ($id === FALSE) {
            $this->db->select('id, title, slug, text');
            $this->db->from('news');
            $this->db->order_by('id', 'desc');
            $this->db->limit($limit['limit'], $limit['offset']);

            // SQLを実行
            $query = $this->db->get();
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

    public function set_news()
    {
        $this->load->helper('url');

        $slug = url_title($this->input->post('title'), 'dash', TRUE);

        $data = array(
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'text' => $this->input->post('text')
        );

        return $this->db->insert('news', $data);
    }

    public function save(&$news)
    {
        if (!isset($news['id'])) {
            $this->db->insert('news', $news);
            $news['id'] = $this->db->insert_id();
        } else {
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