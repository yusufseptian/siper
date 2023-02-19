<?php 
include "../koneksi.php";


$data_barang = mysqli_master_query($koneksi, "SELECT * FROM peminjaman");

$jumlah_barang = mysqli_num_rows($data_barang);


 ?>