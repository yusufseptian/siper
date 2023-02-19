<?php
session_start();
include "koneksi.php";

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$pass = mysqli_real_escape_string($koneksi, $_POST['pass']);
$login = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$username' AND pass = '" . md5($pass) . "'");

$cek = mysqli_num_rows($login);

if ($cek > 0) {
	$data = mysqli_fetch_assoc($login);

	if ($data['level'] == 'admin') {
		$_SESSION['username'] = $username;
		$_SESSION['pass'] = $pass;

		header("location:admin/index_admin.php");
	} else if ($data['level'] == 'siswa') {
		$dt_siswa = mysqli_query($koneksi, "SELECT * FROM tbl_siswa WHERE user_id = '" . $data['id_user'] . "'");
		$dt_siswa = mysqli_fetch_assoc($dt_siswa);
		$_SESSION['id_user'] = $data['id_user'];
		$_SESSION['username'] = $username;
		$_SESSION['pass'] = $pass;
		$_SESSION['nis'] = $dt_siswa['nis'];
		$_SESSION['nama_siswa'] = $dt_siswa['nama_siswa'];

		header("location:siswa/index_siswa.php");
	} else {
		// echo "<script>alert('Gagal Menyimpan, NIS Sudah Ada.');window.location='index.php';</script>";
?>
		<script type="text/javascript">
			alert("Login gagal! Silahkan masukkan username dan password yang benar!");
			window.location.href = "index.php";
		</script>
	<?php

	}
} else {
	// echo "<script>alert('Gagal Menyimpan, NIS Sudah Ada.');window.location='index.php';</script>";
	?>
	<script type="text/javascript">
		alert("Login gagal! Silahkan masukkan username dan password yang benar!");
		window.location.href = "index.php";
	</script>
<?php

}


?>