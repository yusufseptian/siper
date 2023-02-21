<?php
// include database connection file
include "../koneksi.php";

// Get id from URL to delete that user
$id_kategori = $_GET['id'];


// Delete user row from table based on given id
$result = mysqli_query($koneksi, "DELETE FROM tbl_kategori WHERE id_kategori=$id_kategori");

if (!$result) {
	die("Query gagal dijalankan : ".mysqli_errno($koneksi)."-".mysqli_error($koneksi));		
} else {
	echo "<script>alert('Data Berhasil dihapus.');window.location='data_kategori.php';</script>";
}

?>