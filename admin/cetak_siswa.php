<?php 
include '../koneksi.php';
include 'header_admin.php';
session_start();

?>

<!DOCTYPE html>
<html>
<head>
  <title>Cetak Data Siswa</title>
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
    <h3 align="center">LAPORAN DATA SISWA</h3>
    <br>
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No.</th>
            <th>NIS</th>
            <th>Nama Siswa</th>
            <th>Jenis Kelamin</th>
            <th>Jurusan</th>
            <th>Kelas</th>
            <th>Alamat</th>
            <th>No. Hp</th>
            <th>Status</th>

          </tr>
        </thead>

        <tbody>
           <?php 
                                            $no=1;
                                            $query = "SELECT *FROM tbl_siswa";
                                            $result = mysqli_query($koneksi, $query);
                                            if (!$result) {
                                                die("Query eror:".mysqli_errno($koneksi)."-".mysqli_connect($koneksi));
                                            }

                                            while ($row = mysqli_fetch_assoc($result))
                                             {
                                            
                                         ?>


                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $row['nis']; ?></td>
                                           <!--  <td><?php $query = "SELECT *FROM tbl_user WHERE username = '".$row['nama_siswa']."'";
                                            $result2 = mysqli_query($koneksi, $query);
                                           $data = mysqli_fetch_assoc($result2);
                                              echo $data['username'];
                                            

                                             ?>
                                             
                                             </td> -->
                                            
                                            <td><?php echo $row['nama_siswa']; ?></td>
                                            <td><?php echo $row['jenis_kelamin']; ?></td>
                                            <td><?php echo $row['jurusan']; ?></td>
                                            <td><?php echo $row['kelas']; ?></td>
                                            <td><?php echo $row['alamat']; ?></td>
                                            <td><?php echo $row['no_hp']; ?></td>
                                            <td align="center">
                                            <form action="aksi_statussiwa.php" method="POST">
                                           <input type="hidden" name="nis" value="<?php echo $row['nis']; ?>">
                                           <input type="hidden" name="status" value="<?php echo $row['status']; ?>">

                                           <?php 
                                           if ($row['status']=='aktif') {
                                             ?>
                                             <button type="submit" class="btn btn-success btn-sm"> <i class="fa fa-check"></i></button>
                                           <?php 
                                          }else{
                                            ?>
                                             <button type="submit" class="btn btn-danger btn-sm"> <i class="fa fa-times"></i></button>
                                  <?php
                                           }
                                            ?>
                                         
                                            </form>
                                              
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
      
      <script>
        window.print();
      </script>
    </body>
    </html>