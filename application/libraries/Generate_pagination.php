<?php

class Generate_pagination
{
    private $CI;

    // ページネーションの生成
    public function get_links($path, $total, $limit)
    {
        $this->CI =& get_instance();
        $this->CI->load->library('pagination');

        $config = [];
        $config['base_url']       = $path;
        $config['total_rows']     = $total;
        $config['per_page']       = $limit;
//        $config['reuse_query_string'] = TRUE;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_links'] = 5;
        $config['prev_link'] = '&lt; 前';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '次 &gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;

        $this->CI->pagination->initialize($config);
        return $this->CI->pagination->create_links();
    }
}