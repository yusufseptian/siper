<?php 
	include "../koneksi.php";

	$denda=$_POST['denda'];
 
	$query = "INSERT INTO tbl_denda (id_denda, denda, status)
			VALUES ('','$denda','aktif')";
	$result = mysqli_query($koneksi, $query);

if (!$result) {
	die("Query gagal dijalankan : ".mysqli_errno($koneksi)."-".mysqli_error($koneksi));		
} else {
	echo "<script>alert('Data Berhasil ditambah.');window.location='data_denda.php';</script>";
}


 ?>