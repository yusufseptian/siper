<?php

include "../koneksi.php";
include "header_admin.php";
include "sidebar_admin.php";

?>

<?php



$koneksi = new PDO("mysql:host=localhost;dbname=siper", "root", "");

$start_date_error = '';

$end_date_error = '';

if(isset($_POST["export"]))

{

	if(empty($_POST["start_date"]))

	{

		$start_date_error = '<label class="text-danger">Start Date is required</label>';

	}

	else if(empty($_POST["end_date"]))

	{

		$end_date_error = '<label class="text-danger">End Date is required</label>';

	}

	else

	{

		$file_name = 'Peminjaman.csv';

		header("Content-Description: File Transfer");

		header("Content-Disposition: attachment; filename=$file_name");

		header("Content-Type: application/csv;");



		$file = fopen('php://output', 'w');



		$header = array( "NIS", "Nama Siswa", "Judul Buku", "Tanggal Pinjam", "Jumlah", "Keterangan");



		fputcsv($file, $header);



		// $query = "SELECT * FROM tbl_peminjaman WHERE tgl_pinjam>= '".$_POST["start_date"]."' AND tgl_pinjam<= '".$_POST["end_date"]."' ORDER BY tgl_pinjam DESC";


		  


		$query = "SELECT *FROM tbl_peminjaman INNER JOIN tbl_siswa ON tbl_peminjaman.nis = tbl_siswa.nis INNER JOIN tbl_buku ON tbl_peminjaman.id_buku=tbl_buku.id_buku WHERE tgl_pinjam>= '".$_POST["start_date"]."' AND tgl_pinjam<= '".$_POST["end_date"]."' ORDER BY tgl_pinjam DESC";

		$statement = $koneksi->prepare($query);

		$statement->execute();

		$result = $statement->fetchAll();

		foreach($result as $row)

		{

			$data = array();

			$data[] = $row["nis"];

			$data[] = $row["nama_siswa"];

			$data[] = $row["judul_buku"];

			$data[] = $row["tgl_pinjam"];

			$data[] = $row["jumlah_pinjam"];
			$data[] = $row["keterangan"];

			fputcsv($file, $data);

		}

		fclose($file);

		exit;

	}

}



$query = "SELECT *FROM tbl_peminjaman INNER JOIN tbl_siswa ON tbl_peminjaman.nis = tbl_siswa.nis INNER JOIN tbl_buku ON tbl_peminjaman.id_buku=tbl_buku.id_buku ORDER BY tgl_pinjam DESC";



$statement = $koneksi->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

?>

<!DOCTYPE html>
<html>

<head>

	<title>Membuat export data berdasarkan range tanggal menggunakan php</title>

	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css"/>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

</head>

<body>

	<div class="container box">

		<h1 align="center">Membuat export data berdasarkan range tanggal menggunakan php</h1>

		<div class="table-responsive">

			<div class="row">

				<form method="post">

					<div class="input-daterange">

						<div class="col-md-4">

							<input type="text" name="start_date" class="form-control">

							<?php echo $start_date_error; ?>

						</div>

						<div class="col-md-4">

							<input type="text" name="end_date" class="form-control" >

							<?php echo $end_date_error; ?>

						</div>

					</div>

					<div class="col-md-2">

						<input type="submit" name="export" value="Export" class="btnbtn-info"/>

					</div>

				</form>

			</div>

			<table class="table table-bordered table-striped">

				<thead>

					<tr>
						<th>NIS</th>
						<th>Nama Siswa</th>
						<th>Judul Buku</th>
						<th>Tanggal Pinjam</th>
						<th>Jumlah</th>
						<th>Keterangan</th>

					</tr>

				</thead>

				<tbody>

					<?php

					foreach($result as $row)

					{

						echo '

						<tr>
							<td>'.$row["nis"].'</td>

							<td>'.$row["nama_siswa"].'</td>

							<td>'.$row["judul_buku"].'</td>

							<td>$'.$row["tgl_pinjam"].'</td>

							<td>'.$row["jumlah_pinjam"].'</td>
							<td>'.$row["keterangan"].'</td>

						</tr>

						';

					}

					?>

				</tbody>

			</table>

		</div>

	</div>

</body>

</html>



<script>



	$(document).ready(function(){

		$('.input-daterange').datepicker({

			todayBtn:'linked',

			format:"yyyy-mm-dd",

			autoclose:true

		});

	});



</script>

<?php
include "footer_admin.php";
?>