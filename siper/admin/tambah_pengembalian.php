<?php
include "../koneksi.php";

$id_pinjam = $_POST['id_pinjam'];
$tgl_kembali = $_POST['tgl_kembali'];
$id_denda = $_POST['denda'];

// Get data peminjaman
$dtPinjam = mysqli_fetch_assoc(mysqli_query($koneksi, "select * from tbl_peminjaman where id_pinjam='$id_pinjam'"));
if (empty($dtPinjam)) {
	echo "<script>window.location.href='pengembalian.php?errID'</script>";
}
// Cek tanggal kembali jangan kurang dari tanggal pinjam
$dateDiff = date_diff(date_create($dtPinjam['tgl_pinjam']), date_create($tgl_kembali))->format('%r%a');
if ($dateDiff < 0) {
	echo "<script>window.location.href='pengembalian.php?errTglKembali'</script>";
}

$query = "INSERT INTO tbl_pengembalian (id_pinjam, tgl_kembali, id_denda)
VALUES ('$id_pinjam','$tgl_kembali','$id_denda')";
$result = mysqli_query($koneksi, $query);

mysqli_query($koneksi, "update tbl_peminjaman set keterangan='kembali' where id_pinjam='$id_pinjam'");

if (!$result) {
	die("Query gagal dijalankan : " . mysqli_errno($koneksi) . "-" . mysqli_error($koneksi));
} else {
	echo "<script>alert('Data Berhasil ditambah.');window.location='pengembalian.php';</script>";
}
