<?php

class News extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        // データベース接続モデルをロード
        $this->load->model('news_model');
        $this->load->model('users_model');
        $this->load->helper('url_helper');
        $this->load->helper('url');
        // ログインしていない場合はホームに移動する
        if( ! $this->session->userdata("is_logged_in")) {
            redirect(base_url());
        }
    }

    public function index()
    {
        $offset = $this->uri->segment(3 ,0);
        // 登録されているデータを全件取得
        $data['news'] = $this->news_model->get_news($offset);

        // paginationの作成
        $data['pagination'] = $this->news_model->get_pagination();

        $data['title'] = 'ニュース | サンプルアプリケーション ';

        // 各種viewを呼び出す
        $this->smarty->assign($data);
        $this->display('news/index.tpl');
    }

    public function pages()
    {
        $this->index();
    }

    public function view($id = NULL)
    {
        // 指定された記事を呼び出す
        $data['news_item'] = $this->news_model->find($id);
        $data['author'] = $this->users_model->find($data['news_item']['author_id'])['name'];

        // 記事が見つからない場合はNot Foundページ
        if (empty($data['news_item'])) {
            $this->display('news/not_found.tpl');
            return;
        }

        $data['title'] = $data['news_item']['title'];

        $this->smarty->assign($data);
        $this->display('news/view.tpl');
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

        if ($_POST) {
            $this->_save_news($news);
        }
        $data['news_item'] = $news;

        $this->smarty->assign($data);
        $this->display('news/news_form.tpl');
    }

    public function delete($id = NULL)
    {
        $news = $this->_get_news($id);
        if(isset($news['id'])) {
            $this->news_model->delete($news);
        }
        redirect('/news', 'refresh');
    }

    public function download()
    {
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

        // Set document properties
        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
            ->setLastModifiedBy("Maarten Balliauw")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");

        // Add some data
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Hello')
            ->setCellValue('B2', 'world!')
            ->setCellValue('C1', 'Hello')
            ->setCellValue('D2', 'world!');

        // Miscellaneous glyphs, UTF-8
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Miscellaneous glyphs')
            ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Simple');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="01simple.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }

    private function _get_news($id = NULL)
    {
        if ($id === NULL) {
            $news = array();
        } else {
            $news = $this->news_model->find($id);
        }
        return $news;
    }

    private function _save_news(&$news)
    {
        $news['title'] = $this->input->post('title');
        $news['text'] = $this->input->post('text');
        $news['author_id'] = $this->session->userdata('user')['id'];

        if ($this->form_validation->run('news') !== FALSE) {
            $this->news_model->save($news);
            redirect('/news/' . $news['id'], 'refresh');
        }
    }
}