<?php 
include "../koneksi.php";

$id_bukutamu=$_POST['id_bukutamu'];
$tgl_kunjungan=$_POST['tgl_kunjungan'];
$nama=$_POST['nama'];
$alamat=$_POST['alamat'];
$kelas=$_POST['kelas'];
$jurusan=$_POST['jurusan'];
$keperluan=$_POST['keperluan'];


$query = "UPDATE  tbl_bukutamu SET tgl_kunjungan='$tgl_kunjungan', nama='$nama', alamat='$alamat', kelas='$kelas'
,jurusan='$jurusan', keperluan='$keperluan' WHERE id_bukutamu='$id_bukutamu'";


$result = mysqli_query($koneksi, $query);

if (!$result) {
	die("Query gagal dijalankan : ".mysqli_errno($koneksi)."-".mysqli_error($koneksi));		
} else {
	echo "<script>alert('Data Berhasil diedit.');window.location='data_bukutamu.php';</script>";
}

?>