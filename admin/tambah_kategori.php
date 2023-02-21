<?php 
	include "../koneksi.php";

	$nama_kategori=$_POST['nama_kategori'];
 
	$query = "INSERT INTO tbl_kategori (id_kategori, nama_kategori)
			VALUES ('','$nama_kategori')";
	$result = mysqli_query($koneksi, $query);

if (!$result) {
	die("Query gagal dijalankan : ".mysqli_errno($koneksi)."-".mysqli_error($koneksi));		
} else {
	echo "<script>alert('Data Berhasil ditambah.');window.location='data_kategori.php';</script>";
}


 ?>