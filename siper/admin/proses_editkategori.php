<?php 
	include "../koneksi.php";

	$id_kategori=$_POST['id_kategori'];
	$nama_kategori=$_POST['nama_kategori'];
 
	$query = "UPDATE  tbl_kategori SET nama_kategori='$nama_kategori' WHERE id_kategori='$id_kategori'";
			

	$result = mysqli_query($koneksi, $query);

if (!$result) {
	die("Query gagal dijalankan : ".mysqli_errno($koneksi)."-".mysqli_error($koneksi));		
} else {
	echo "<script>alert('Data Berhasil diedit.');window.location='data_kategori.php';</script>";
}

 ?>