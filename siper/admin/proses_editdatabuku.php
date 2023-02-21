<?php
include "../koneksi.php";

$id_buku = $_POST['id_buku'];
$gambar = $_FILES['gambar']['name'];
$judul_buku = $_POST['judul_buku'];
$penerbit = $_POST['penerbit'];
$tahun_terbit = $_POST['tahun_terbit'];
$stok = $_POST['stok'];
$id_kategori = $_POST['id_kategori'];
$id_rak = $_POST['id_rak'];
$detail = $_POST['detail'];



if ($gambar != "") {
	$ekstensi_diperpolehkan = array('png', 'jpg', 'jpeg');
	$x = explode('.', $gambar);
	$extensi = strtolower(end($x));
	$file_tmp = $_FILES['gambar']['tmp_name'];
	$angka_acak = rand(1, 999);
	$nama_gambar_baru = $angka_acak . '-' . $gambar;
	if (in_array($extensi, $ekstensi_diperpolehkan) === true) {
		// Catatan: Ketika melakukan update gambar sebelumnya masih belum dihapus.
		move_uploaded_file($file_tmp, 'gambar_admin/' . $nama_gambar_baru);
		$query = "UPDATE  tbl_buku SET gambar='$nama_gambar_baru', judul_buku='$judul_buku', penerbit='$penerbit', tahun_terbit='$tahun_terbit', stok='$stok', id_kategori='$id_kategori', id_rak='$id_rak', detail='$detail'  WHERE id_buku='$id_buku'";

		$result = mysqli_query($koneksi, $query);
		if (!$result) {
			die("Query gagal dijalankan : " . mysqli_errno($koneksi) . "-" . mysqli_error($koneksi));
		} else {
			echo "<script>alert('Ekstensi gambar harus png, jpg, atau jpeg.');window.location='data_buku.php';</script>";
		}
	} else {
		echo "<script>alert('Data Berhasil diedit.');window.location='data_buku.php';</script>";
	}
} else {

	$query = "UPDATE  tbl_buku SET judul_buku='$judul_buku', penerbit='$penerbit', tahun_terbit='$tahun_terbit', stok='$stok', id_kategori='$id_kategori', id_rak='$id_rak', detail='$detail'  WHERE id_buku='$id_buku'";
	$result = mysqli_query($koneksi, $query);

	if (!$result) {
		die("Query gagal dijalankan : " . mysqli_errno($koneksi) . "-" . mysqli_error($koneksi));
	} else {
		echo "<script>alert('Data Berhasil diedit.');window.location='data_buku.php';</script>";
	}
}
