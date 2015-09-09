<?php

class News extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // データベース接続モデルをロード
        $this->load->model('news_model');
        $this->load->helper('url_helper');
        $this->load->helper('url');
        $this->smarty->template_dir = APPPATH . 'views';
        $this->smarty->compile_dir = APPPATH . 'views/templates_c';
    }

    public function index()
    {
        $this->load->library('pagination');

        $limit = array(
            'limit' => 10,
            'offset' => ($this->uri->segment(3) !== '') ? $this->uri->segment(3) : 0
        );
        // 登録されているデータを全件取得
        $data['news'] = $this->news_model->get_news(FALSE, $limit);

        $config['base_url'] = base_url() . "/news/pages";
        $config['total_rows'] = $this->news_model->get_count_all();
        $config['per_page'] = $limit['limit'];
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

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $data['title'] = 'ニュース | サンプルアプリケーション ';

        // 各種viewを呼び出す
        $this->smarty->assign($data);
        $this->smarty->display('news/index.tpl');
    }

    public function pages()
    {
        $this->index();
    }

    public function view($id = NULL)
    {
        // 指定された記事を呼び出す
        $data['news_item'] = $this->news_model->get_news($id);

        // 記事が見つからない場合は404エラー
        if (empty($data['news_item'])) {
            show_404();
        }

        $data['title'] = $data['news_item']['title'];

        $this->smarty->assign($data);
        $this->smarty->display('news/view.tpl');
    }

    public function create()
    {
        $this->edit();
    }

    public function edit($id = NULL)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $news = $this->_get_news($id);
        if ($id === NULL) {
            $data['title'] = 'ニュース登録';
        } else {
            $data['title'] = 'ニュース編集';
        }

//		echo var_dump($id);
        if ($_POST) {
            $this->_save_news($news);
        }
        $data['news_item'] = $news;

        $this->smarty->assign($data);
        $this->smarty->display('news/news_form.tpl');
    }

    public function delete($id = NULL)
    {
        $news = $this->_get_news($id);
        $this->news_model->delete($news);
        redirect('/news', 'refresh');
    }

    private function _get_news($id = NULL)
    {
        if ($id === NULL) {
            $news = array();
        } else {
            $news = $this->news_model->get_news($id);
        }
        return $news;
    }

    private function _save_news(&$news)
    {
        $this->form_validation->set_rules('title', 'タイトル', 'required');
        $this->form_validation->set_rules('text', '内容', 'required');
        if ($this->form_validation->run() !== FALSE) {
            $this->load->helper('url');

            $news['title'] = $this->input->post('title');
            $news['slug'] = url_title($news['title'], 'dash', TRUE);
            $news['text'] = $this->input->post('text');

            $this->news_model->save($news);
            redirect('/news/' . $news['id'], 'refresh');
        }
    }
}