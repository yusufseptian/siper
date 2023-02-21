<?php 
include "../koneksi.php";

$id_pinjam=$_POST['id_pinjam'];
$nis=$_POST['nis'];
$id_buku=$_POST['id_buku'];
$tgl_pinjam=$_POST['tgl_pinjam'];
$jumlah_pinjam=$_POST['jumlah_pinjam'];


$query = "UPDATE  tbl_peminjaman SET nis='$nis', id_buku='$id_buku', tgl_pinjam='$tgl_pinjam'
,jumlah_pinjam='$jumlah_pinjam' WHERE id_pinjam='$id_pinjam'";


$result = mysqli_query($koneksi, $query);

if (!$result) {
	die("Query gagal dijalankan : ".mysqli_errno($koneksi)."-".mysqli_error($koneksi));		
} else {
	echo "<script>alert('Data Berhasil diedit.');window.location='peminjaman.php';</script>";
}

?>