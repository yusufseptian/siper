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
      width: 13%;
      padding: 2px;
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
    $query = "SELECT * FROM tbl_pengembalian INNER JOIN tbl_peminjaman ON 
    tbl_pengembalian.id_pinjam=tbl_peminjaman.id_pinjam INNER JOIN tbl_siswa ON 
    tbl_peminjaman.nis = tbl_siswa.nis  INNER JOIN tbl_buku ON 
    tbl_peminjaman.id_buku=tbl_buku.id_buku  INNER JOIN tbl_denda ON 
    tbl_pengembalian.id_denda=tbl_denda.id_denda";

    $label = "Semua Data Pengembalian Buku";
  } else { // Jika terisi
    // Buat query untuk menampilkan data transaksi sesuai periode tanggal
    $query = "SELECT * FROM tbl_pengembalian INNER JOIN tbl_peminjaman ON 
    tbl_pengembalian.id_pinjam=tbl_peminjaman.id_pinjam INNER JOIN tbl_siswa ON 
    tbl_peminjaman.nis = tbl_siswa.nis  INNER JOIN tbl_buku ON 
    tbl_peminjaman.id_buku=tbl_buku.id_buku  INNER JOIN tbl_denda ON 
    tbl_pengembalian.id_denda=tbl_denda.id_denda WHERE (tgl_kembali BETWEEN '" . $tgl_awal . "' AND '" . $tgl_akhir . "')";

    $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
    $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
    $label = 'Periode Pengembalian Buku Tanggal ' . $tgl_awal . ' s/d ' . $tgl_akhir;
  }
  ?>



  <h4 style="margin-bottom: 5px;">Laporan Pengembalian Buku di Perpustakaan SMK YPKK 1 Sleman</h4>

  <?php echo $label ?>

  <table class="table" border="1" style="margin-right: 1px;">
    <thead>
      <tr>
        <th>NIS</th>
        <th>Nama Siswa</th>
        <th>Judul Buku</th>
        <th>Tanggal Pinjam</th>
        <th>Jumlah</th>
        <th>Tanggal Kembali</th>
        <th>Denda</th>
        <th>Keterangan</th>
      </tr>
    </thead>
    <tbody>

      <?php
      $sql = mysqli_query($koneksi, $query); // Eksekusi/Jalankan query dari variabel $query
      $row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql

      if ($row > 0) { // Jika jumlah data lebih dari 0 (Berarti jika data ada)
        while ($data = mysqli_fetch_array($sql)) { // Ambil semua data dari hasil eksekusi $sql
          $tgl = date('d-m-Y', strtotime($data['tgl_kembali'])); // Ubah format tanggal jadi dd-mm-yyyy
          $denda = $data['denda'] * ((int)date_diff(date_create($data['tgl_pinjam']), date_create($data['tgl_kembali']))->format('%r%a') - 7) * $data['jumlah_pinjam'];
          echo "<tr>";
          echo "<td>" . $data['nis'] . "</td>";
          echo "<td>" . $data['nama_siswa'] . "</td>";
          echo "<td>" . $data['judul_buku'] . "</td>";
          echo "<td>" . $data['tgl_pinjam'] . "</td>";
          echo "<td>" . $data['jumlah_pinjam'] . "</td>";
          echo "<td>" . $data['tgl_kembali'] . "</td>";
          echo "<td>" . $denda . "</td>";
          echo "<td>" . $data['keterangan'] . "</td>";
          echo "</tr>";
        }
      } else { // Jika data tidak ada
        echo "<tr><td colspan='8'>Data tidak ada</td></tr>";
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
ob_end_clean();

require 'libraries/html2pdf/autoload.php';

$pdf = new Spipu\Html2Pdf\Html2Pdf('P', 'A4', 'en');
$pdf->WriteHTML($html);
$pdf->Output('Laporan Peminjaman.pdf', 'I');
?>