<?php

class Excel
{
    private $excel;
    private $activeSheetIndex;
    private $filename;

    public function __construct()
    {
        $this->excel = new PHPExcel();
        $this->filename = 'book1.xlsx';
        $this->activeSheetIndex = 0;
    }

    public function setCellValue($cell, $value)
    {
        $this->excel->setActiveSheetIndex($this->activeSheetIndex)
            ->setCellValue($cell, $value);
    }

    public function setActiveSheetIndex($activeSheetIndex)
    {
        $this->activeSheetIndex = $activeSheetIndex;
    }

    public function setTitle($title)
    {
        $this->excel->setActiveSheetIndex($this->activeSheetIndex)
            ->setTitle($title);
    }

    public function setCreator($creator)
    {
        $this->excel->getProperties()->setCreator($creator);
        return $this;
    }

    public function setLastModifiedBy($lastModified)
    {
        $this->excel->getProperties()->setLastModifiedBy($lastModified);
        return $this;
    }

    public function setPropertyTitle($title)
    {
        $this->excel->getProperties()->setTitle($title);
        return $this;
    }

    public function setSubject($subject)
    {
        $this->excel->getProperties()->setSubject($subject);
        return $this;
    }

    public function setDescription($description)
    {
        $this->excel->getProperties()->setDescription($description);
        return $this;
    }

    public function setKeywords($keywords)
    {
        $this->excel->getProperties()->setKeywords($keywords);
        return $this;
    }

    public function setCategory($category)
    {
        $this->excel->getProperties()->setCategory($category);
        return $this;
    }

    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    public function save()
    {
        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $this->filename . '"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        $objWriter->save('php://output');
    }
}