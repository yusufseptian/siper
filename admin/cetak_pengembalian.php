<?php 
include '../koneksi.php';
include 'header_admin.php';
session_start();

?>

<!DOCTYPE html>
<html>
<head>
  <title>Cetak Data Pengembalian Buku</title>
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
      <h3 align="center">LAPORAN DATA PENGEMBALIAN BUKU</h3>
      <br>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
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
         </thead>

         <tbody>
          <?php 
          $no=1;
          
          $query = "SELECT * FROM tbl_pengembalian INNER JOIN tbl_peminjaman ON 
          tbl_pengembalian.id_pinjam=tbl_peminjaman.id_pinjam INNER JOIN tbl_siswa ON 
          tbl_peminjaman.nis = tbl_siswa.nis  INNER JOIN tbl_buku ON 
          tbl_peminjaman.id_buku=tbl_buku.id_buku  INNER JOIN tbl_denda ON 
          tbl_pengembalian.id_denda=tbl_denda.id_denda";
          

            // $query="SELECT tbl_peminjaman.nis, tbl_siswa.nama_siswa, tbl_buku.judul_buku, tbl_peminjaman.tgl_pinjam, tbl_peminjaman.jumlah_pinjam, tbl_pengembalian.tgl_pengembalian, tbl_denda.denda FROM tbl_pengembalian INNER JOIN tbl_peminjaman ON tbl_peminjaman.nis = tbl_siswa.nis INNER JOIN tbl_buku ON tbl_peminjaman.id_buku=tbl_buku.id_buku INNER JOIN tbl_pengembalian ON tbl_peminjaman.id_pinjam=tbl_pengembalian.id_pinjam INNER JOIN tbl_denda ON tbl_peminjaman.id_denda=tbl_denda.id_denda";            
          
          $result = mysqli_query($koneksi, $query);
          if (!$result) {
            die("Query eror:".mysqli_errno($koneksi)."-".mysqli_connect($koneksi));
          }

          while ($row = mysqli_fetch_assoc($result))
          {
            //   $result2 = mysqli_query($koneksi, $query2);

            //   if (!$result2) {
            //     die("Query gagal dijalankan : ".mysqli_errno($koneksi)."-".mysqli_error($koneksi));   
            //   } while ($row = mysqli_fetch_assoc($result2))
            

            ?>


            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $row['nis']; ?></td>
              <td><?php echo $row['nama_siswa']; ?></td>
              <td><?php echo $row['judul_buku']; ?></td>
              <td><?php echo $row['tgl_pinjam']; ?></td>
              <td><?php echo $row['jumlah_pinjam']; ?></td>
              <td><?php echo $row['tgl_kembali']; ?></td>
              <td>
                <?=
                ((int)date_diff(date_create($row['tgl_pinjam']), date_create($row['tgl_kembali']))->format('%r%a') - 7) * $row['denda'] * $row['jumlah_pinjam'] ?>
              </td>

            </td>
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