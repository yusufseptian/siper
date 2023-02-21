<?php
include "../koneksi.php";

$id_user = $_POST['id_user'];
$username = $_POST['username'];
$pass = $_POST['pass'];
$level = $_POST['level'];

if (trim($pass) != "") {
	$pass = md5($pass);
	// Merubah data user
	// $query ="UPDATE tbl_user SET username = '$username', pass = '$pass', level ='$level' WHERE id_user ='$id_user'"; Dirubah untuk mengantisipasi inspek element html
	$query = "UPDATE tbl_user SET pass = '$pass' WHERE id_user ='$id_user'";
	$result1 = mysqli_query($koneksi, $query);
	// Merubah password pada data siswa (perhatian: kolom password pada data siswa apakah diperlukan?)
	$result2 = mysqli_query($koneksi, "UPDATE tbl_siswa SET pass = '$pass' WHERE user_id = '$id_user'");

	if (!$result1) {
		die("Query gagal dijalankan : " . mysqli_errno($koneksi) . "-" . mysqli_error($koneksi));
	} else {
		echo "<script>alert('Data Berhasil diedit.');</script>";
	}
}
?>
<script>
	window.location = 'data_user.php';
</script>