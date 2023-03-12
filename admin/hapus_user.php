<?php
session_start();
// include database connection file
include "../koneksi.php";

// Get id from URL to delete that user
$id_user = $_GET['id'];

// Get data siswa by id user
$dtSiswa = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tbl_user INNER JOIN tbl_siswa ON id_user=user_id WHERE id_user='$id_user'"));
if (empty($dtSiswa)) {
	$_SESSION['notify'] = 'Data tidak valid';
	header("Location: data_user.php");
	die;
}

// Check data peminjaman
if (mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tbl_peminjaman WHERE nis='" . $dtSiswa['nis'] . "' AND keterangan='Belum Kembali'")) > 0) {
	$_SESSION['notify'] = 'User dengan username ' . strtoupper($dtSiswa['username']) . ' masih memiliki transaksi yang belum selesai. Penghapusan dibatalkan.';
	header("Location: data_user.php");
	die;
}

// Delete user row from table based on given id
$result = mysqli_query($koneksi, "DELETE FROM tbl_user WHERE id_user=$id_user");

if (!$result) {
	die("Query gagal dijalankan : " . mysqli_errno($koneksi) . "-" . mysqli_error($koneksi));
} else {
	echo "<script>alert('Data Berhasil dihapus.');window.location='data_user.php';</script>";
}
