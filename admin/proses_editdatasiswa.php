<?php
include "../koneksi.php";

$nis = $_POST['nis'];
$nama_siswa = $_POST['nama_siswa'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$pass = $_POST['pass'];
$jurusan = $_POST['jurusan'];
$kelas = $_POST['kelas'];
$alamat = $_POST['alamat'];
$no_hp = $_POST['no_hp'];
$status = $_POST['status'];

if (empty(trim($pass))) {
	// Jika password tidak dirubah
	$query = "UPDATE  tbl_siswa SET  nama_siswa='$nama_siswa', jenis_kelamin='$jenis_kelamin', jurusan='$jurusan', kelas='$kelas', alamat='$alamat', no_hp='$no_hp', status='$status' WHERE nis='$nis'";
} else {
	// Jika password dirubah
	$pass = md5($pass);
	$query = "UPDATE  tbl_siswa SET  nama_siswa='$nama_siswa', pass='$pass', jenis_kelamin='$jenis_kelamin', jurusan='$jurusan', kelas='$kelas', alamat='$alamat', no_hp='$no_hp', status='$status' WHERE nis='$nis'";
	$dt_siswa = mysqli_query($koneksi, "SELECT * FROM tbl_siswa WHERE nis = '" . $nis . "'");
	$dt_siswa = mysqli_fetch_assoc($dt_siswa);
	$editUser = mysqli_query($koneksi, "UPDATE tbl_user SET pass='$pass' where id_user = '" . $dt_siswa['user_id'] . "'");
}

$result = mysqli_query($koneksi, $query);

if (!$result) {
	die("Query gagal dijalankan : " . mysqli_errno($koneksi) . "-" . mysqli_error($koneksi));
} else {
	echo "<script>alert('Data Berhasil diedit.');window.location='data_siswa.php';</script>";
}
