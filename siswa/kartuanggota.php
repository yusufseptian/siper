<?php
include '../koneksi.php';
include 'header_siswa.php';
session_start();

?>

<!DOCTYPE html>
<html>

<head>
	<title>Cetak Kartu Anggota</title>
</head>

<body>
	<div class="m-4">
		<div class="row">
			<div class="col-7 border card-body rounded-lg shadow-sm" style="width: 5cm;">
				<div class="row mb-2">
					<div class="col-3 text-center">
						<img src="../assets/img/LOGO-YPKK.jpeg" width="80">
					</div>
					<div class="col-9 text-center">
						<h6>PERPUSTAKAAN</h6>
						<h6>SMK YPKK 1 Sleman</h6>
						<h6>KARTU ANGGOTA PERPUSTAKAAN</h6>
					</div>
				</div>
				<div class="row border rounded-lg d-flex">
					<table class="table-borderless col-4 ml-3">
						<tbody>
							<?php
							$query = "SELECT *FROM tbl_siswa  WHERE nis = '" . $_SESSION['username'] . "'";
							$result = mysqli_query($koneksi, $query);
							if (!$result) {
								die("Query eror:" . mysqli_errno($koneksi) . "-" . mysqli_connect($koneksi));
							}
							while ($row = mysqli_fetch_assoc($result)) {
								?>
								<tr>
									<td>NIS</td>
									<td>:&nbsp;<?php echo $row['nis']; ?></td>
								</tr>
								<tr>
									<td>Nama Siswa</td>
									<td>:&nbsp;<?php echo $row['nama_siswa']; ?></td>
								</tr>
								<tr>
									<td>Jenis Kelamin</td>
									<td>:&nbsp;<?php echo $row['jenis_kelamin']; ?></td>
								</tr>
								<tr>
									<td>Kelas</td>
									<td>:&nbsp;<?php echo $row['kelas']; ?></td>
								</tr>
								<tr>
									<td>Telepon</td>
									<td>:&nbsp;<?php echo $row['no_hp']; ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
						<div class="row ml-auto mt-auto mr-3">
							<div class="col-12 text-center">
								Kepala Perpustakaan <br><br><br>
								Samidah
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php echo date('d-M-Y') ?></h6>
		<?php echo $_SESSION['username'] ?></h6>
		<script type="text/javascript">
			window.print();
		</script>
	</body>

	</html>