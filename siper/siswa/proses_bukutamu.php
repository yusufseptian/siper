<?php 
	include "../koneksi.php";

	$tgl_kunjungan=$_POST['tgl_kunjungan'];
	$nama=($_POST['nama']);
	$alamat=$_POST['alamat'];
	$kelas=$_POST['kelas'];
	$jurusan=$_POST['jurusan'];
	$keperluan=$_POST['keperluan'];

	$query = "INSERT INTO tbl_bukutamu (id_bukutamu, tgl_kunjungan, nama, alamat, kelas, jurusan, keperluan)
			VALUES (0,'$tgl_kunjungan','$nama','$alamat','$kelas','$jurusan','$keperluan')";
	$result = mysqli_query($koneksi, $query);

if (!$result) {
	die("Query gagal dijalankan : ".mysqli_errno($koneksi)."-".mysqli_error($koneksi));		
} else {
	echo "<script>alert('Data Berhasil.');window.location='data_bukutamusiswa.php';</script>";
}
