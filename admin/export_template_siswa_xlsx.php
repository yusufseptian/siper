<?php

include_once "../koneksi.php";
include "../assets/vendor/phpexcell/PHPExcel.php";

// Me-load template excel data siswa
$excell = PHPExcel_IOFactory::createReader('Excel2007');
$excell = $excell->load('../assets/data/template_data_siswa.xlsx');

$excell->setActiveSheetIndex(0);
for ($i = 2; $i < 10000; $i++) {
    $validationCell = $excell->getActiveSheet()->getCell('C' . $i)->getDataValidation();
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
    $validationCell->setFormula1('"L,P"');
}

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Data Siswa.xlsx"');
header('Cache-Control: max-age=0');
$export = PHPExcel_IOFactory::createWriter($excell, 'Excel2007');
$export->save('php://output');
