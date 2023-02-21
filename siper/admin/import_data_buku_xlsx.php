<?php
session_start();

include_once "../koneksi.php";
include_once "../assets/vendor/phpexcell/PHPExcel.php";

// Cek uploaded xlsx file
$file = $_FILES['upload']['tmp_name'];
$fileExtention = strtolower(pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION));
if ($fileExtention != "xlsx") {
    $_SESSION['notify'] = 'Jenis file yang di-upload tidak sesuai';
    header("Location:data_buku.php");
}

// Create object reader file from upload
try {
    $xlsx = PHPExcel_IOFactory::identify($file);
    $xlsxReader = PHPExcel_IOFactory::createReader($xlsx);
    $obj = $xlsxReader->load($file);
} catch (Exception $e) {
    $_SESSION['notify'] = 'Ada masalah dalam pembacaan file. Error: ' . $e->getMessage();
    header("Location:data_buku.php");
}
$obj->setActiveSheetIndex(0);

// Get row tertinggi/terakhir
$highestRow = $obj->getActiveSheet()->getHighestDataRow();

// Set variable for count success and failed import data
$success = 0;
$failed = 0;
$totalData = 0;

// Save data rak pada array
$dtRak = mysqli_query($koneksi, "SELECT * FROM tbl_rak");
$dtRakArray = [];
while ($dt = mysqli_fetch_assoc($dtRak)) {
    $dtRakArray[str_replace(" ", "", $dt['nama_rak'])] = $dt['id_rak'];
}

// Save data kategori pada array
$dtKategori = mysqli_query($koneksi, "SELECT * FROM tbl_kategori");
$dtKategoriArray = [];
while ($dt = mysqli_fetch_assoc($dtKategori)) {
    $dtKategoriArray[str_replace(" ", "", $dt['nama_kategori'])] = $dt['id_kategori'];
}

// Looping data to save in mysql
for ($i = 2; $i <= $highestRow; $i++) { // i dimulai dari 2 karena baris pertama adalah header. Sehingga data dimulai dari bari kedua. Cth: cell A2
    $no = $obj->getActiveSheet()->getCellByColumnAndRow(0, $i)->getValue();
    if (empty(trim($no))) {
        // Jika nomor telah kosong maka input data akan dibatalkan
        break;
    }
    $judul = $obj->getActiveSheet()->getCellByColumnAndRow(1, $i)->getValue();
    $penerbit = $obj->getActiveSheet()->getCellByColumnAndRow(2, $i)->getValue();
    $tahunTerbit = $obj->getActiveSheet()->getCellByColumnAndRow(3, $i)->getValue();
    $stok = $obj->getActiveSheet()->getCellByColumnAndRow(4, $i)->getValue();
    $kategori = $obj->getActiveSheet()->getCellByColumnAndRow(5, $i)->getValue();
    $rak = $obj->getActiveSheet()->getCellByColumnAndRow(6, $i)->getValue();
    $detail = $obj->getActiveSheet()->getCellByColumnAndRow(7, $i)->getValue();

    // Validate type data and value
    if (
        empty(trim($judul)) ||
        empty(trim($penerbit)) ||
        empty(trim($tahunTerbit)) ||
        !is_numeric($tahunTerbit) ||
        empty(trim($stok)) ||
        !is_numeric($stok) ||
        empty(trim($kategori)) ||
        empty(trim($rak)) ||
        empty(trim($detail))
    ) {
        $failed++;
    } else {
        // Cek data rak
        $tmp_rak = "";
        try {
            $tmp_rak = $dtRakArray[str_replace(" ", "", $rak)];
        } catch (Exception $e) {
            $failed++;
            $totalData++;
            continue;
        }
        // Save data kategori
        $tmp_kategori = "";
        try {
            $tmp_kategori = $dtKategoriArray[str_replace(" ", "", $kategori)];
        } catch (Exception $e) {
            $failed++;
            $totalData++;
            continue;
        }
        if (
            empty(trim($tmp_kategori)) ||
            !is_numeric($tmp_kategori) ||
            empty(trim($tmp_rak)) ||
            !is_numeric($tmp_rak)
        ) {
            $failed++;
            $totalData++;
            continue;
        }

        // Input ke database
        $query = mysqli_query($koneksi, "INSERT INTO tbl_buku VALUES (0, 'book_default.png', '$judul', '$penerbit', '$tahunTerbit', '$stok', '$tmp_kategori', '$tmp_rak', '$detail')");
        if ($query) {
            $success++;
        } else {
            $failed++;
        }
    }
    $totalData++;
}

// Setting notifikasi import buku
if ($totalData == 0) {
    $_SESSION['notify'] = "Tidak ada data buku yang dapat di import.";
} else {
    if ($success == $totalData) {
        $_SESSION['notify'] = "Semua buku berhasil di import. (Jumlah $totalData buku)";
    } elseif ($failed == $totalData) {
        $_SESSION['notify'] = "Semua buku gagal di import. (Jumlah $totalData buku)";
    } else {
        $_SESSION['notify'] = "Import $success buku berhasil dari total $totalData buku. (Jumlah buku yang gagal di import sebanyak $failed buku)";
    }
}
header("Location:data_buku.php?err");
