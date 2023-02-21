<?php
include_once "../koneksi.php";
include "../assets/vendor/phpexcell/PHPExcel.php";

// Me-load template excel data buku
$excell = PHPExcel_IOFactory::createReader('Excel2007');
$excell = $excell->load('../assets/data/template_data_buku.xlsx');

// Isi data rak untuk template excel data buku
$excell->setActiveSheetIndex(1);
$dtRak = mysqli_query($koneksi, "SELECT * FROM tbl_rak");
$i = 1;
while ($dt = mysqli_fetch_assoc($dtRak)) {
    $excell->getActiveSheet()->setCellValue("A" . $i, $dt['nama_rak']);
    $i++;
}

// Isi data kategori untuk template excel data buku
$excell->setActiveSheetIndex(2);
$dtKategori = mysqli_query($koneksi, "SELECT * FROM tbl_kategori");
$i = 1;
while ($dt = mysqli_fetch_assoc($dtKategori)) {
    $excell->getActiveSheet()->setCellValue("A" . $i, $dt['nama_kategori']);
    $i++;
}

function setListFormula($excel, $column, $formula)
{
    for ($i = 2; $i < 10000; $i++) {
        $validationCell = $excel->getActiveSheet()->getCell($column . $i)->getDataValidation();
        $validationCell->setType(\PHPExcel_Cell_DataValidation::TYPE_LIST);
        $validationCell->setErrorStyle(\PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
        $validationCell->setAllowBlank(false);
        $validationCell->setShowInputMessage(true);
        $validationCell->setShowErrorMessage(true);
        $validationCell->setShowDropDown(true);
        $validationCell->setErrorTitle('Input error');
        $validationCell->setError('Nilai tidak terdaftar pada list.');
        $validationCell->setPromptTitle('Pilih dari list');
        $validationCell->setPrompt('Pilih nilai yang ada pada list!.');
        $validationCell->setFormula1($formula);
    }
}

// Set Formula list menu untuk kategori
$cellRange = '$A:$A';
$excell->setActiveSheetIndex(0);
setListFormula($excell, "F", "='Data Kategori'!" . $cellRange);

// Set Formula list menu untuk rak
setListFormula($excell, "G", "='DataRak'!" . $cellRange);

header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="Data Buku.xlsx"'); //tell browser what's the file name
header('Cache-Control: max-age=0');
$export = PHPExcel_IOFactory::createWriter($excell, 'Excel2007');
$export->save('php://output');
