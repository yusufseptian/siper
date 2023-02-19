<?php 
	include "../koneksi.php";

	
	$gambar=$_FILES['gambar']['name'];
	$judul_buku=$_POST['judul_buku'];
	$penerbit=$_POST['penerbit'];
	$tahun_terbit=$_POST['tahun_terbit'];
	$stok=$_POST['stok'];
	$id_kategori=$_POST['id_kategori'];
	$id_rak=$_POST['id_rak'];
	$detail=$_POST['detail'];



	if ($gambar !="") {
		$ekstensi_diperpolehkan = array('png','jpg','jpeg');
		$x = explode('.', $gambar);
		$extensi=strtolower(end($x));
		$file_tmp=$_FILES['gambar']['tmp_name'];
		$angka_acak=rand(1,999);
		$nama_gambar_baru=$angka_acak.'-'.$gambar;
		if (in_array($extensi,$ekstensi_diperpolehkan) === true) {

			move_uploaded_file($file_tmp,'gambar_admin/'.$nama_gambar_baru);
			$query ="INSERT INTO tbl_buku(id_buku,gambar,judul_buku,penerbit,tahun_terbit,stok,id_kategori,id_rak, detail) 
			VALUES (0,'$nama_gambar_baru','$judul_buku','$penerbit','$tahun_terbit','$stok','$id_kategori','$id_rak','$detail')";
			$result = mysqli_query($koneksi, $query);
			
if (!$result) {
	die("Query gagal dijalankan : ".mysqli_errno($koneksi)."-".mysqli_error($koneksi));		
} else {
	echo "<script>alert('Data Berhasil ditambah.');window.location='data_buku.php';</script>";
}
}

}

else {

$query ="INSERT INTO tbl_buku(id_buku,judul_buku,penerbit,tahun_terbit,stok,id_kategori,id_rak,gambar,detail) VALUES ('','$gambar','$judul_buku','$penerbit','$tahun_terbit','$stok','$id_kategori','$id_rak','$detail')";
			$result = mysqli_query($koneksi, $query);
			
if (!$result) {
	die("Query gagal dijalankan : ".mysqli_errno($koneksi)."-".mysqli_error($koneksi));		
} else {
	echo "<script>alert('Data Berhasil ditambah.');window.location='data_buku.php';</script>";
 }

}
