<?php 
include '../koneksi.php';
include 'header_admin.php';
session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Cetak Data Buku Tamu</title>
</head>
<body>

	<div class="card-body"></div>

	<center><img src="../assets/img/LOGO-YPKK.jpeg" width="100"></center>
	<br>

	<h3 align="center"> PERPUSTAKAAN </h3>
	<h3 align="center"> SMK YPKK 1 Sleman</h3>
	<h4 align="center"> Alamat: Jl. Sayangan 05 Meijing Wetan, Ambarketawang, Gamping Sleman</h3>
	<h4 align="center">  Daerah Istimewa Yogyakarta, 55294. Telp. (0274) 798806</h3>

		<hr/>
		<h3 align="center">LAPORAN DATA BUKU TAMU</h3>
		<br>
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>No.</th> 
						<th>Tanggal Kunjungan</th>
						<th>Nama</th>
						<th>Alamat</th> 
						<th>Kelas</th>
						<th>Jurusan</th>
						<th>Keperluan</th>


					</tr>
				</thead>

				<tbody>
					<?php 
					$no=1;
					$query = "SELECT *FROM tbl_bukutamu";
					$result = mysqli_query($koneksi, $query);
					if (!$result) {
						die("Query eror:".mysqli_errno($koneksi)."-".mysqli_connect($koneksi));
					}

					while ($row = mysqli_fetch_assoc($result))
					{

						?>


						<tr>
							<td><?php echo $no++; ?></td> 
							<td><?php echo $row['tgl_kunjungan']; ?></td>
							<td><?php echo $row['nama']; ?></td>
							<td><?php echo $row['alamat']; ?></td>
							<td><?php echo $row['kelas']; ?></td>
							<td><?php echo $row['jurusan']; ?></td>
							<td><?php echo $row['keperluan']; ?></td>


						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<br><br>
			<h6 align="right">Yogyakarta, <?php echo date('d-M-Y') ?></h6>
			<h6 align="right">Petugas Perpustakaan</h6>
			<br><br>
			<br><br>
			<h6 align="right"><?php echo $_SESSION['username'] ?></h6> 
			
			<script type="text/javascript">
				window.print();
			</script>

		</body>
		</html>