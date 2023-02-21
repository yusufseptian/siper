<?php
// include database connection file
include "../koneksi.php";

// Get id from URL to delete that user
$id_buku = $_GET['id'];


// Delete user row from table based on given id
$result = mysqli_query($koneksi, "DELETE FROM tbl_buku WHERE id_buku=$id_buku");

if (!$result) {
	die("Query gagal dijalankan : ".mysqli_errno($koneksi)."-".mysqli_error($koneksi));		
} else {
	echo "<script>alert('Data Berhasil dihapus.');window.location='data_buku.php';</script>";
}

?>