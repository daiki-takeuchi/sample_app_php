<?php

class News extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // データベース接続モデルをロード
        $this->load->model('news_model');
        $this->load->model('users_model');
        $this->load->helper('url_helper');
        $this->load->helper('url');
        $this->smarty->template_dir = APPPATH . 'views';
        $this->smarty->compile_dir = APPPATH . 'views/templates_c';
        // ログインしていない場合はホームに移動する
        if( ! $this->session->userdata("is_logged_in")) {
            redirect(base_url());
        }
    }

    public function index()
    {
        $limit = array(
            'limit' => 10,
            'offset' => $this->uri->segment(3 ,0)
        );
        // 登録されているデータを全件取得
        $data['news'] = $this->news_model->get_news(FALSE, $limit);

        // paginationの作成
        $this->load->library('Generate_pagination');
        $total = $this->news_model->get_count_all();
        $path = base_url() . "/news/pages";
        $data['pagination'] = $this->generate_pagination->get_links($path, $total, $limit['limit']);

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
        $data['author'] = $this->users_model->get_users($data['news_item']['author_id'])['name'];

        // 記事が見つからない場合はNot Foundページ
        if (empty($data['news_item'])) {
            $this->smarty->display('news/not_found.tpl');
            return;
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

        $news = NULL;
        if ($id === NULL) {
            $data['title'] = 'ニュース登録';
        } else {
            $news = $this->_get_news($id);
            $data['title'] = 'ニュース編集';
        }

//      echo var_dump($id);
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

            $news['title'] = $this->input->post('title');
            $news['text'] = $this->input->post('text');
            $news['author_id'] = $this->session->userdata('user')['id'];

            $this->news_model->save($news);
            redirect('/news/' . $news['id'], 'refresh');
        }
    }
}