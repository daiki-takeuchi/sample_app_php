<?php

class Generate_pagination
{
    private $CI;

    // ページネーションの生成
    public function get_links($path, $total, $per_page)
    {
        $this->CI =& get_instance();
        $this->CI->load->library('pagination');

        $config['base_url']   = $path;
        $config['total_rows'] = $total;
        $config['per_page']   = $per_page;

        $this->CI->pagination->initialize($config);
        return $this->CI->pagination->create_links();
    }
}