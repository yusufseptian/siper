<?php

session_start();

// include database connection file
include "../koneksi.php";

// Get id from URL to delete that user
$nis = $_GET['id'];

// Check transaction
$dtTransaction = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tbl_peminjaman WHERE nis='$nis' AND keterangan='Belum Kembali'"));
if ($dtTransaction > 0) {
	$_SESSION['notify'] = "Siswa dengan NIS $nis, masih memiliki transaksi yang belum selesai. Penghapusan data gagal.";
	header('Location: data_siswa.php');
	die;
}

// Get data siswa
$dtSiswa = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tbl_siswa WHERE nis='$nis'"));
$idUser = $dtSiswa['user_id'];

// Delete user row from table based on given id
// $result = mysqli_query($koneksi, "DELETE FROM tbl_siswa WHERE nis=$nis");

// Hapus data user
$hapusUser = mysqli_query($koneksi, "DELETE FROM tbl_user WHERE id_user='$idUser'");

if (!$hapusUser) {
	die("Query gagal dijalankan : " . mysqli_errno($koneksi) . "-" . mysqli_error($koneksi));
} else {
	echo "<script>alert('Data Berhasil dihapus.');window.location='data_siswa.php';</script>";
}
