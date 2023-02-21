<?php
include "../koneksi.php";

$nama_rak = $_POST['nama_rak'];

$query = "INSERT INTO tbl_rak (id_rak, nama_rak)
			VALUES (0,'$nama_rak')";
$result = mysqli_query($koneksi, $query);

if (!$result) {
	die("Query gagal dijalankan : " . mysqli_errno($koneksi) . "-" . mysqli_error($koneksi));
} else {
	echo "<script>alert('Data Berhasil ditambah.');window.location='data_rak.php';</script>";
}
