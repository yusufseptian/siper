<?php
include_once "../koneksi.php";
include "../assets/vendor/phpexcell/PHPExcel.php";

// Me-load template excel data buku
$excell = PHPExcel_IOFactory::createReader('Excel2007');
$excell = $excell->load('../assets/data/template_data_buku.xlsx');
$excell->setActiveSheetIndex(0);

$excell->getActiveSheet()->setCellValue('A2', '1');



header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="Data Buku.xlsx"'); //tell browser what's the file name
header('Cache-Control: max-age=0');
$export = PHPExcel_IOFactory::createWriter($excell, 'Excel2007');
$export->save('php://output');
