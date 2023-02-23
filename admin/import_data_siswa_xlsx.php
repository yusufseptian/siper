<?php
session_start();

include_once "../koneksi.php";
include_once "../assets/vendor/phpexcell/PHPExcel.php";

// Cek uploaded xlsx file
$file = $_FILES['upload']['tmp_name'];
$fileExtention = strtolower(pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION));
if ($fileExtention != "xlsx") {
    $_SESSION['notify'] = 'Jenis file yang di-upload tidak sesuai';
    header("Location:data_siswa.php");
}

// Create object reader file from upload
try {
    $xlsx = PHPExcel_IOFactory::identify($file);
    $xlsxReader = PHPExcel_IOFactory::createReader($xlsx);
    $obj = $xlsxReader->load($file);
} catch (Exception $e) {
    $_SESSION['notify'] = 'Ada masalah dalam pembacaan file. Error: ' . $e->getMessage();
    header("Location:data_siswa.php");
}
$obj->setActiveSheetIndex(0);

// Get row tertinggi/terakhir
$highestRow = $obj->getActiveSheet()->getHighestDataRow();

// Set variable for count success and failed import data
$success = 0;
$failed = 0;
$totalData = 0;

// Looping data to save in mysql
for ($i = 2; $i <= $highestRow; $i++) { // i dimulai dari 2 karena baris pertama adalah header. Sehingga data dimulai dari bari kedua. Cth: cell A2
    $no = $obj->getActiveSheet()->getCellByColumnAndRow(0, $i)->getValue();
    if (empty(trim($no))) {
        // Jika nomor telah kosong maka input data akan dibatalkan
        break;
    }
    $nis = $obj->getActiveSheet()->getCellByColumnAndRow(1, $i)->getValue();
    $nama_siswa = $obj->getActiveSheet()->getCellByColumnAndRow(2, $i)->getValue();
    $jenis_kelamin = $obj->getActiveSheet()->getCellByColumnAndRow(3, $i)->getValue();
    $jurusan = $obj->getActiveSheet()->getCellByColumnAndRow(4, $i)->getValue();
    $kelas = $obj->getActiveSheet()->getCellByColumnAndRow(5, $i)->getValue();
    $alamat = $obj->getActiveSheet()->getCellByColumnAndRow(6, $i)->getValue();
    $no_hp = $obj->getActiveSheet()->getCellByColumnAndRow(7, $i)->getValue();
    $status = $obj->getActiveSheet()->getCellByColumnAndRow(8, $i)->getValue();

    // Validate type data and value
    if (
        empty(trim($nis)) ||
        !is_numeric($nis) ||
        empty(trim($nama_siswa)) ||
        empty(trim($jenis_kelamin)) ||
        empty(trim($jurusan)) ||
        empty(trim($kelas)) ||
        !is_numeric($kelas) ||
        empty(trim($alamat)) ||
        empty(trim($no_hp)) ||
        !is_numeric($no_hp) ||
        empty(trim($status))
    ) {
        $failed++;
    } else {
        // Input ke database
        $query = mysqli_query($koneksi, "INSERT INTO tbl_siswa VALUES (0, '$nis', '$nama_siswa', '$jenis_kelamin','', '$jurusan', '$kelas', '$alamat', '$no_hp', '$status')");
        if ($query) {
            $success++;
        } else {
            $failed++;
        }
    }
    $totalData++;
}

// Setting notifikasi import siswa
if ($totalData == 0) {
    $_SESSION['notify'] = "Tidak ada data siswa yang dapat di import.";
} else {
    if ($success == $totalData) {
        $_SESSION['notify'] = "Semua siswa berhasil di import. (Jumlah $totalData siswa)";
    } elseif ($failed == $totalData) {
        $_SESSION['notify'] = "Semua siswa gagal di import. (Jumlah $totalData siswa)";
    } else {
        $_SESSION['notify'] = "Import $success siswa berhasil dari total $totalData siswa. (Jumlah siswa yang gagal di import sebanyak $failed siswa)";
    }
}
header("Location:data_siswa.php?err");
