<?php
include "../koneksi.php";
session_start();

$nis = $_POST['nis'];
$id_buku = $_POST['id_buku'];
$tgl_pinjam = $_POST['tgl_pinjam'];
$jumlah_pinjam = $_POST['jumlah_pinjam'];
// $keterangan=$_POST['keterangan'];

$cek = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tbl_siswa WHERE nis = '$nis'"));
if (empty($cek)) {
	$_SESSION['error'] = 'data siswa tidak ditemukan';
	header('Location:peminjaman.php');
}
if ($cek['status'] != 'aktif') {
	$_SESSION['error'] = 'Akun Siswa Tidak Aktif';
	header('Location:peminjaman.php');
}
$query = "INSERT INTO tbl_peminjaman (id_pinjam, nis, id_buku, tgl_pinjam, jumlah_pinjam, keterangan)
VALUES (0,'$nis','$id_buku','$tgl_pinjam','$jumlah_pinjam','Belum Kembali')";
$result = mysqli_query($koneksi, $query);

if (!$result) {
	die("Query gagal dijalankan : " . mysqli_errno($koneksi) . "-" . mysqli_error($koneksi));
} else {
	echo "<script>alert('Data Berhasil ditambah.');window.location='peminjaman.php';</script>";
}
