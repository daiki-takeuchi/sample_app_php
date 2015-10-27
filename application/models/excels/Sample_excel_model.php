<?php

class Sample_excel_model extends CI_Model
{
    public function download($data)
    {
        $this->load->library('Excel');
        $this->_setData($data);

        $this->excel->setCreator("Maarten Balliauw")
                    ->setLastModifiedBy("Maarten Balliauw")
                    ->setPropertyTitle("Office 2007 XLSX Test Document")
                    ->setSubject("Office 2007 XLSX Test Document")
                    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                    ->setKeywords("office 2007 openxml php")
                    ->setCategory("Test result file");

        $this->excel->setTitle('Simple');
        $this->excel->setFilename('01simple.xlsx');

        $this->excel->save();
    }

    private function _setData($data)
    {
        $this->excel->setCellValue('A1', $data['col1']);
        $this->excel->setCellValue('B2', $data['col2']);
        $this->excel->setCellValue('C1', $data['col3']);
        $this->excel->setCellValue('D2', $data['col4']);
    }
}