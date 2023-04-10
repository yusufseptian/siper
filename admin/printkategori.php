<?php ob_start();
session_start(); ?>
<html>

<head>

  <title>Cetak PDF</title>
  <style>
    .table {
      border-collapse: collapse;
      table-layout: fixed;
      width: 630px;
    }

    .table th {
      padding: 5px;
    }

    .table td {
      word-wrap: break-word;
      width: 20%;
      padding: 5px;
    }
  </style>
</head>

<body>
  <?php
  // Load file koneksi.php
  include "../koneksi.php";

  $query = "SELECT *FROM tbl_bukutamu";

  $label = "Semua Data Buku Tamu";

  ?>

  <h4 style="margin-bottom: 5px;">Laporan Kategori</h4>
  <?php echo $label ?>

  <table class="table" border="1" style="margin-right: 1px;">
    <thead>
      <tr>
        <th>Nama Kategori</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      $query = "SELECT *FROM tbl_kategori";
      $result = mysqli_query($koneksi, $query);
      if (!$result) {
        die("Query eror:" . mysqli_errno($koneksi) . "-" . mysqli_connect($koneksi));
      }

      while ($row = mysqli_fetch_assoc($result)) {

      ?>


        <tr>
          <td><?php echo $row['nama_kategori']; ?></td>


        </tr>
      <?php } ?>
    </tbody>
  </table>
  <h6 align="right">Yogyakarta, <?php echo date('d-M-Y') ?> <br><br>
    Petugas Perpustakaan</h6>
  <br>
  <h6 align="right"><?php echo $_SESSION['username'] ?></h6>
</body>

</html>
<?php
$html = ob_get_contents();

require 'libraries/html2pdf/autoload.php';

$pdf = new Spipu\Html2Pdf\Html2Pdf('P', 'A4', 'en');
$pdf->WriteHTML($html);
ob_end_clean();
$pdf->Output('Laporan Kategori.pdf', 'I');
?>