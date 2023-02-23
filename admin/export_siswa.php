<?php

include_once "../koneksi.php";
include "../assets/vendor/phpexcell/PHPExcel.php";

// Me-load template excel data siswa
$excell = PHPExcel_IOFactory::createReader('Excel2007');
$excell = $excell->load('../assets/data/template_data_siswa.xlsx');

$excell->setActiveSheetIndex(0);
$data_siswa = mysqli_query($koneksi, 'SELECT * FROM tbl_siswa INNER JOIN tbl_user ON user_id = id_user');
$i = 2;
$edit = $excell->getActiveSheet();
$edit->setCellValue('I1', "");
while ($data = mysqli_fetch_assoc($data_siswa)) {
    $edit->setCellValue('A' . $i, $data['nis']);
    $edit->setCellValue('B' . $i, $data['nama_siswa']);
    $edit->setCellValue('C' . $i, $data['jenis_kelamin']);
    $edit->setCellValue('D' . $i, $data['jurusan']);
    $edit->setCellValue('E' . $i, $data['kelas']);
    $edit->setCellValue('F' . $i, $data['alamat']);
    $edit->setCellValue('G' . $i, $data['no_hp']);
    $edit->setCellValue('H' . $i, $data['username']);
    // $edit->setCellValue('I' . $i, $data['pass']);
    $i++;
}

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Data Siswa.xlsx"');
header('Cache-Control: max-age=0');
$export = PHPExcel_IOFactory::createWriter($excell, 'Excel2007');
$export->save('php://output');
