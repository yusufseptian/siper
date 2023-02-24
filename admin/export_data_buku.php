<?php
// Untuk menyembunyikan error jika ada perbedaan versi server atau versi php
error_reporting(0);
include_once "../koneksi.php";
include "../assets/vendor/phpexcell/PHPExcel.php";

// Me-load template excel data siswa
$excell = PHPExcel_IOFactory::createReader('Excel2007');
$excell = $excell->load('../assets/data/template_data_buku.xlsx');

$excell->setActiveSheetIndex(0);
$data_buku = mysqli_query($koneksi, 'SELECT *FROM tbl_buku INNER JOIN tbl_kategori ON tbl_buku.id_kategori = tbl_kategori.id_kategori INNER JOIN tbl_rak ON tbl_buku.id_rak=tbl_rak.id_rak');
$i = 2;
$edit = $excell->getActiveSheet();
$edit->setCellValue('I1', "");
while ($data = mysqli_fetch_assoc($data_buku)) {
    $edit->setCellValue('A' . $i, $i - 1);
    $edit->setCellValue('B' . $i, $data['judul_buku']);
    $edit->setCellValue('C' . $i, $data['penerbit']);
    $edit->setCellValue('D' . $i, $data['tahun_terbit']);
    $edit->setCellValue('E' . $i, $data['stok']);
    $edit->setCellValue('F' . $i, $data['nama_kategori']);
    $edit->setCellValue('G' . $i, $data['nama_rak']);
    $edit->setCellValue('H' . $i, $data['detail']);
    $i++;
}
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Data Buku.xlsx"');
header('Cache-Control: max-age=0');
$export = PHPExcel_IOFactory::createWriter($excell, 'Excel2007');
$export->save('php://output');
