<?php
include_once "../koneksi.php";
include "../assets/vendor/phpexcell/PHPExcel.php";

//create phpexcel object

$objPHPExcel = new PHPExcel();
$objConditional1 = new PHPExcel_Style_Conditional();

//create header excel

$objConditional1->setActiveSheetIndex(0)->setCellValue("A1", "No");
$objConditional1->setActiveSheetIndex(0)->setCellValue("B1", "Gambar");
$objConditional1->setActiveSheetIndex(0)->setCellValue("C1", "Judul Buku");
$objConditional1->setActiveSheetIndex(0)->setCellValue("D1", "Penerbit");
$objConditional1->setActiveSheetIndex(0)->setCellValue("E1", "Tahun Terbit");
$objConditional1->setActiveSheetIndex(0)->setCellValue("F1", "Stok");
$objConditional1->setActiveSheetIndex(0)->setCellValue("G1", "Kategori");
$objConditional1->setActiveSheetIndex(0)->setCellValue("H1", "Rak");
$objConditional1->setActiveSheetIndex(0)->setCellValue("I1", "Detail");
