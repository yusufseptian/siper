<?php 
include "../koneksi.php";

$nis=$_POST['nis'];
$status=$_POST['status'];


if ($status == 'aktif') {
	$query ="UPDATE tbl_siswa SET status = 'tidak' WHERE nis='$nis'";

	$result = mysqli_query($koneksi, $query);

	if (!$result) {
	die("Query gagal dijalankan : ".mysqli_errno($koneksi)."-".mysqli_error($koneksi));		
} else {
	echo "<script>alert('Data Siswa Berhasil dinonaktifkan.');window.location='data_siswa.php';</script>";
}
}else{
	$query = "UPDATE tbl_siswa SET status ='aktif' WHERE nis='$nis' ";

	$result = mysqli_query($koneksi, $query);

	if (!$result) {
	die("Query gagal dijalankan : ".mysqli_errno($koneksi)."-".mysqli_error($koneksi));		
} else {
	echo "<script>alert('Data Siswa Berhasil diaktifkan.');window.location='data_siswa.php';</script>";
}
}



 ?>