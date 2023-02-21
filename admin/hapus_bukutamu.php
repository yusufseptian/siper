<?php
// include database connection file
include "../koneksi.php";

// Get id from URL to delete that user
$id_bukutamu = $_GET['id'];


// Delete user row from table based on given id
$result = mysqli_query($koneksi, "DELETE FROM tbl_bukutamu WHERE id_bukutamu=$id_bukutamu");

if (!$result) {
	die("Query gagal dijalankan : ".mysqli_errno($koneksi)."-".mysqli_error($koneksi));		
} else {
	echo "<script>alert('Data Berhasil dihapus.');window.location='data_bukutamu.php';</script>";
}

?>