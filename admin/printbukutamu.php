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
      width: 18%;
      padding: 4px;
    }
  </style>
</head>

<body>
  <?php
  // Load file koneksi.php
  include "../koneksi.php";

  $tgl_awal = @$_GET['tgl_awal']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
  $tgl_akhir = @$_GET['tgl_akhir']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)

  if (empty($tgl_awal) or empty($tgl_akhir)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :
    // Buat query untuk menampilkan semua data transaksi

    $query = "SELECT *FROM tbl_bukutamu";

    $label = "Semua Data Buku Tamu";
  } else { // Jika terisi
    // Buat query untuk menampilkan data transaksi sesuai periode tanggal

    $query = "SELECT *FROM tbl_bukutamu WHERE (tgl_kunjungan BETWEEN '" . $tgl_awal . "' AND '" . $tgl_akhir . "')";

    $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
    $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
    $label = 'Periode Buku Tamu Tanggal ' . $tgl_awal . ' s/d ' . $tgl_akhir;
  }
  ?>

  <h4 style="margin-bottom: 5px;">Laporan Buku Tamu Kunjungan di Perpustakaan SMK YPKK 1 Sleman</h4>
  <?php echo $label ?>

  <table class="table" border="1" style="margin-right: 1px;">
    <thead>
      <tr>
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
      $sql = mysqli_query($koneksi, $query); // Eksekusi/Jalankan query dari variabel $query
      $row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql

      if ($row > 0) { // Jika jumlah data lebih dari 0 (Berarti jika data ada)
        while ($data = mysqli_fetch_array($sql)) { // Ambil semua data dari hasil eksekusi $sql
          $tgl = date('d-m-Y', strtotime($data['tgl_kunjungan'])); // Ubah format tanggal jadi dd-mm-yyyy

          echo "<tr>";
          echo "<td>" . $data['tgl_kunjungan'] . "</td>";
          echo "<td>" . $data['nama'] . "</td>";
          echo "<td>" . $data['alamat'] . "</td>";
          echo "<td>" . $data['kelas'] . "</td>";
          echo "<td>" . $data['jurusan'] . "</td>";
          echo "<td>" . $data['keperluan'] . "</td>";
          echo "</tr>";
        }
      } else { // Jika data tidak ada
        echo "<tr><td colspan='6'>Data tidak ada</td></tr>";
      }
      ?>
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
$pdf->Output('Laporan Buku Tamu.pdf', 'I');
?>