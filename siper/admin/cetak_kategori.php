<?php 
include '../koneksi.php';
include 'header_admin.php';
session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Cetak Data Kategori</title>
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
			<h3 align="center">LAPORAN DATA KATEGORI</h3>
			<br>
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No.</th>
							<th>Nama Kategori</th>


						</tr>
					</thead>

					<tbody>
						<?php 
						$no=1;
						$query = "SELECT *FROM tbl_kategori";
						$result = mysqli_query($koneksi, $query);
						if (!$result) {
							die("Query eror:".mysqli_errno($koneksi)."-".mysqli_connect($koneksi));
						}

						while ($row = mysqli_fetch_assoc($result))
						{

							?>


							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo $row['nama_kategori']; ?></td>


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
				
			</body>
			</html>
			<script type="text/javascript">
				window.print();
			</script>