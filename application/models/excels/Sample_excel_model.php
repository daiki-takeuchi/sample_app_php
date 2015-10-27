<?php

class Sample_excel_model extends CI_Model
{
    public function download($data)
    {
        $this->load->library('Excel');

        $excel = new Excel();
        $this->set_Data($data, $excel);

        $excel->setCreator("Maarten Balliauw")
            ->setLastModifiedBy("Maarten Balliauw")
            ->setPropertyTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");

        $excel->setTitle('Simple');
        $excel->setFilename('01simple.xlsx');

        $excel->save();
    }

    private function set_Data($data, &$excel)
    {
        $excel->setCellValue('A1', $data['col1']);
        $excel->setCellValue('B2', $data['col2']);
        $excel->setCellValue('C1', $data['col3']);
        $excel->setCellValue('D2', $data['col4']);
    }
}