<!-- coding baru -->

<?php
include "../koneksi.php";

$username = $_POST['username'];
$pass = $_POST['pass'];
$level = $_POST['level'];

$cek = "SELECT * FROM tbl_user WHERE username ='$username' ";

$prosescek = mysqli_query($koneksi, $cek);
if (mysqli_num_rows($prosescek) > 0) {

	echo "<script>alert('Gagal Menyimpan, Username Sudah Ada.');window.location='data_user.php';</script>";
} else {
	$query = "INSERT INTO tbl_user (username, pass, level)
			VALUES ('$username','$pass','$level')";
	$result = mysqli_query($koneksi, $query);

	if (!$result) {
		die("Query gagal dijalankan : " . mysqli_errno($koneksi) . "-" . mysqli_error($koneksi));
	} else {
		echo "<script>alert('Data Berhasil ditambah.');window.location='data_user.php';</script>";
	}
}
?>