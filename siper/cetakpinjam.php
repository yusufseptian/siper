<?php

include "../koneksi.php";
include "header_admin.php";
include "sidebar_admin.php";

?>

<?php

function combotgl($awal, $akhir, $var, $terpilih){

	echo "<select name=$var>";

	for ($i=$awal; $i<=$akhir; $i++){

		$lebar=strlen($i);

		switch($lebar){

			case 1:

			{

				$g="0".$i;

				break;    

			}

			case 2:

			{

				$g=$i;

				break;    

			}     

		} 

		if ($i==$terpilih)

			echo "<option value=$g selected>$g</option>";

		else

			echo "<option value=$g>$g</option>";

	}

	echo "</select> ";

}



function combobln($awal, $akhir, $var, $terpilih){

	echo "<select name=$var>";

	for ($bln=$awal; $bln<=$akhir; $bln++){

		$lebar=strlen($bln);

		switch($lebar){

			case 1:

			{

				$b="0".$bln;

				break;    

			}

			case 2:

			{

				$b=$bln;

				break;    

			}     

		} 

		if ($bln==$terpilih)

			echo "<option value=$b selected>$b</option>";

		else

			echo "<option value=$b>$b</option>";

	}

	echo "</select> ";

}



function combothn($awal, $akhir, $var, $terpilih){

	echo "<select name=$var>";

	for ($i=$awal; $i<=$akhir; $i++){

		if ($i==$terpilih)

			echo "<option value=$i selected>$i</option>";

		else

			echo "<option value=$i>$i</option>";

	}

	echo "</select> ";

}



function combonamabln($awal, $akhir, $var, $terpilih){

	$nama_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei",

		"Juni", "Juli", "Agustus", "September",

		"Oktober", "November", "Desember");

	echo "<select name=$var>";

	for ($bln=$awal; $bln<=$akhir; $bln++){

		if ($bln==$terpilih)

			echo "<option value=$bln selected>$nama_bln[$bln]</option>";

		else

			echo "<option value=$bln>$nama_bln[$bln]</option>";

	}

	echo "</select> ";

}



?>


<html>

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>Laporan Data</title>

</head>

<table class='table1'>

	<tr>

		<td align="center" colspan='2'>

			<h2>CONTOH DATA</h2>

			<h2>LAPORAN PENJUALAN PRODUK kodingbuton.com</h2>



		</td>

	</tr>

	<strong><hr></strong>



	<table border='1' class='table'>

	<tr>

			<th>No.</th>
             <th>NIS</th>
             <th>Nama Siswa</th>
             <th>Judul Buku</th>
             <th>Tanggal Pinjam</th>
             <th>Jumlah</th>
             <th>Tanggal Kembali</th>
             <th>Denda</th>
		</tr>



		<?php

		include "koneksi.php";

		include "fungsi_combobox.php";

		$tgl_awal = $_POST['thn_mulai']."-".$_POST['bln_mulai']."-".$_POST['tgl_mulai'];

		$tgl_akhir = $_POST['thn_selesai']."-".$_POST['bln_selesai']."-".$_POST['tgl_selesai'];

		$query=mysql_query("SELECT * FROM tbl_pengembalian INNER JOIN tbl_peminjaman ON 
          tbl_pengembalian.id_pinjam=tbl_peminjaman.id_pinjam INNER JOIN tbl_siswa ON 
          tbl_peminjaman.nis = tbl_siswa.nis  INNER JOIN tbl_buku ON 
          tbl_peminjaman.id_buku=tbl_buku.id_buku  INNER JOIN tbl_denda ON 
          tbl_pengembalian.id_denda=tbl_denda.id_denda");


		$cnt=1;

		while($row=mysql_fetch_array($query)){

			$tgl=tgl_indo($row['tgl_order']);

			$sale   = $row[harga]*$row[diskon]/100 * $row[jumlah];

			$subtotal    = $row[jumlah]*$row[harga]+$row[ongkos_kirim]- $sale;

			$total       = $total + $subtotal;

			$sub_jum    = $row[jumlah];  

			$total_j     = $total_j + $sub_jum; 

			?>

			<tr>

				<td align='center'><?php echo $cnt ?>.</td>

				<td align="center"><?php echo htmlentities($tgl);?></td>

				<td> &nbsp; <?php echo htmlentities($row['nama_produk']);?></td>

				<td> &nbsp; <?php echo $row['nama_kustomer'];?></td>

				<td> &nbsp; <?php echo $row['email'];?> / <?php echo $row['telpon'];?> </td>

				<td> &nbsp; <?php echo htmlentities($row['alamat']);?> </td>

				<td> <center><?php echo $row['jumlah'];?></center></td>

				<td><center> <?php echo $row['diskon'] ?> %</center></td>

				<td align="right">Rp. <?php echo format_rupiah(($row['harga'] * $row['jumlah']+$row['ongkos_kirim'] - $sale ));?>,-&nbsp;</td>



			</tr>

			<?php $cnt=$cnt+1; } ?>

			<tr> 

				<td colspan="6"><div align="left"><strong>TOTAL JUMLAH</strong></div></td>

				<td align="center"><strong><?php echo $total_j;?></strong></td>

				<td align="right" colspan="2"><strong>Rp. <?php echo format_rupiah( $total ) ;?>,-&nbsp;</strong></td>

			</tr>       

		</table>

		<body>

		</body>

		</html>

		<?php
		include "footer_admin.php";
		?>