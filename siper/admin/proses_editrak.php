<?php 
	include "../koneksi.php";

	$id_rak=$_POST['id_rak'];
	$nama_rak=$_POST['nama_rak'];
 
	$query = "UPDATE  tbl_rak SET nama_rak='$nama_rak' WHERE id_rak='$id_rak'";
			

	$result = mysqli_query($koneksi, $query);

if (!$result) {
	die("Query gagal dijalankan : ".mysqli_errno($koneksi)."-".mysqli_error($koneksi));		
} else {
	echo "<script>alert('Data Berhasil diedit.');window.location='data_rak.php';</script>";
}

 ?>