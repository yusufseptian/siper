<?php 
include "../koneksi.php";

$id_denda=$_POST['id_denda'];
$status=$_POST['status'];


if ($status == 'aktif') {
	$query ="UPDATE tbl_denda SET status = 'tidak' WHERE id_denda='$id_denda'";

	$result = mysqli_query($koneksi, $query);

	if (!$result) {
	die("Query gagal dijalankan : ".mysqli_errno($koneksi)."-".mysqli_error($koneksi));		
} else {
	echo "<script>alert('Data Denda Berhasil dinonaktifkan.');window.location='data_denda.php';</script>";
}
}else{
	$query = "UPDATE tbl_denda SET status ='aktif' WHERE id_denda='$id_denda' ";

	$result = mysqli_query($koneksi, $query);

	if (!$result) {
	die("Query gagal dijalankan : ".mysqli_errno($koneksi)."-".mysqli_error($koneksi));		
} else {
	echo "<script>alert('Data Denda Berhasil diaktifkan.');window.location='data_denda.php';</script>";
}
}



 ?>