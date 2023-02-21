<?php

include "../koneksi.php";
include "header_admin.php";
include "sidebar_admin.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Laporan PDF Plus Filter Periode Tanggal</title>

    <!-- Include file CSS Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Include library Bootstrap Datepicker -->
    <link href="libraries/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

    <!-- Include File jQuery -->
    <script src="js/jquery.min.js"></script>
</head>
<body>
    <div style="padding: 15px;">
        <h3 style="margin-top: 0;"><b>Laporan Buku Tamu</b></h3>
        <hr />

        <form method="get" action="index_cetakbukutamu.php">
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label>Filter Tanggal</label>
                        <div class="input-group">
                            <input type="text" name="tgl_awal" value="<?= @$_GET['tgl_awal'] ?>" class="form-control tgl_awal" placeholder="Tanggal Awal">
                            <span class="input-group-addon"> s/d </span>
                            <input type="text" name="tgl_akhir" value="<?= @$_GET['tgl_akhir'] ?>" class="form-control tgl_akhir" placeholder="Tanggal Akhir">
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" name="filter" value="true" class="btn btn-primary">TAMPILKAN</button>

            <?php
            if(isset($_GET['filter'])) // Jika user mengisi filter tanggal, maka munculkan tombol untuk reset filter
            echo '<a href="index_cetakbukutamu.php" class="btn btn-default">RESET</a>';
            ?>
        </form>

        <?php
        // Load file koneksi.php
        include "../koneksi.php";

        $tgl_awal = @$_GET['tgl_awal']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        $tgl_akhir = @$_GET['tgl_akhir']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)

        if(empty($tgl_awal) or empty($tgl_akhir)){ // Cek jika tgl_awal atau tgl_akhir kosong, maka :
            // Buat query untuk menampilkan semua data transaksi
            $query = 
            $query = "SELECT *FROM tbl_bukutamu";
            $url_cetak = "printbukutamu.php";
            $label = "Semua Data Buku Tamu";
        }else{ // Jika terisi
            // Buat query untuk menampilkan data transaksi sesuai periode tanggal
            $query =  "SELECT *FROM tbl_bukutamu WHERE (tgl_kunjungan BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."')";
            $url_cetak = "printbukutamu.php?tgl_awal=".$tgl_awal."&tgl_akhir=".$tgl_akhir."&filter=true";
            $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
            $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
            $label = 'Periode Buku Tamu Tanggal '.$tgl_awal.' s/d '.$tgl_akhir;

        }
        ?>
        <hr /><!-- 
        <h4 style="margin-bottom: 5px;"><b>Laporan Peminjaman Buku</b></h4> -->
        
        <?php echo $label ?><br />

        <div style="margin-top: 5px;">
            <a target="_blank" href="<?php echo $url_cetak ?>">CETAK PDF</a>
        </div>
        <br>
        <div class="table-responsive" style="margin-left: 10px;">
            <table class="table table-bordered">
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

                    if($row > 0){ // Jika jumlah data lebih dari 0 (Berarti jika data ada)
                        while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
                            $tgl = date('d-m-Y', strtotime($data['tgl_kunjungan'])); // Ubah format tanggal jadi dd-mm-yyyy

                            echo "<tr>";
                            echo "<td>".$data['tgl_kunjungan']."</td>";
                            echo "<td>".$data['nama']."</td>";
                            echo "<td>".$data['alamat']."</td>";
                            echo "<td>".$data['kelas']."</td>";
                            echo "<td>".$data['jurusan']."</td>";
                            echo "<td>".$data['keperluan']."</td>";
                            echo "</tr>";
                        }
                    }else{ // Jika data tidak ada
                        echo "<tr><td colspan='6'>Data tidak ada</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Include File JS Bootstrap -->
<script src="js/bootstrap.min.js"></script>

<!-- Include library Bootstrap Datepicker -->
<script src="libraries/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<!-- Include File JS Custom (untuk fungsi Datepicker) -->
<script src="js/custom.js"></script>

<script>
    $(document).ready(function(){
        setDateRangePicker(".tgl_awal", ".tgl_akhir")
    })
</script>
</body>
</html>

<?php 
include "footer_admin.php";
?>