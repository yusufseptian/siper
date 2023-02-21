<?php
// include database connection file
include "../koneksi.php";

// Get id from URL to delete that user
$id_denda = $_GET['id'];


// Delete user row from table based on given id
$result = mysqli_query($koneksi, "DELETE FROM tbl_denda WHERE id_denda=$id_denda");

if (!$result) {
	die("Query gagal dijalankan : ".mysqli_errno($koneksi)."-".mysqli_error($koneksi));		
} else {
	echo "<script>alert('Data Berhasil dihapus.');window.location='data_denda.php';</script>";
}

?>