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

$cek = "SELECT * FROM tbl_siswa WHERE nis ='$nis' ";

$prosescek = mysqli_query($koneksi, $cek);
if (mysqli_num_rows($prosescek) > 0) {
	echo "<script>alert('Gagal Menyimpan, NIS Sudah Ada.');window.location='data_siswa.php';</script>";
} else {
	$pass = md5($pass);
	mysqli_query($koneksi, "insert into tbl_user (username, pass, level) values ('$nis','$pass','siswa')");
	$sql_user_id = mysqli_query($koneksi, "SELECT id_user FROM tbl_user order by id_user desc limit 1");
	$fetch_user_id = mysqli_fetch_assoc($sql_user_id);
	$user_id = $fetch_user_id['id_user'];
	$query = "INSERT INTO tbl_siswa (nis, nama_siswa, jenis_kelamin, pass, jurusan, kelas, alamat, no_hp, status, user_id)
	VALUES ('$nis', '$nama_siswa', '$jenis_kelamin', '$pass','$jurusan', '$kelas', '$alamat', '$no_hp', 'aktif', '$user_id')";
	// $query2 = "INSERT INTO tbl_user (id_user, username, pass, level)
	// VALUES ('','$nis', '$pass', 'siswa')";

	$result = mysqli_query($koneksi, $query);

	if (!$result) {
		die("Query gagal dijalankan : " . mysqli_errno($koneksi) . "-" . mysqli_error($koneksi));
	} else {
		echo "<script>alert('Data Berhasil ditambah.');window.location='data_siswa.php';</script>";
	}

	// $result2 = mysqli_query($koneksi, $query2);

	// if (!$result2) {
	// 	die("Query gagal dijalankan : " . mysqli_errno($koneksi) . "-" . mysqli_error($koneksi));
	// } else {
	// 	echo "<script>alert('Data Berhasil ditambah.');window.location='data_siswa.php';</script>";
	// }
}
