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
        <h3 style="margin-top: 0; "><b>Laporan Pengembalian Buku</b></h3>
        <hr />

        <form method="get" action="keuangan_denda.php">
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label>Filter Tanggal Kembali</label>
                        <div class="input-group">
                            <input type="date" name="tgl_awal" value="<?= @$_GET['tgl_awal'] ?>" class="form-control tgl_awal" placeholder="Tanggal Awal">
                            <span class="input-group-addon"> s/d </span>
                            <input type="date" name="tgl_akhir" value="<?= @$_GET['tgl_akhir'] ?>" class="form-control tgl_akhir" placeholder="Tanggal Akhir">
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" name="filter" value="true" class="btn btn-primary">TAMPILKAN</button>

            <?php
            if (isset($_GET['filter'])) // Jika user mengisi filter tanggal, maka munculkan tombol untuk reset filter
                echo '<a href="index_cetakkembali.php" class="btn btn-default">RESET</a>';
            ?>
        </form>

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
            $url_cetak = "printkeuangandenda.php";
            $label = "Semua Data Pengembalian Buku";
        } else { // Jika terisi
            // Buat query untuk menampilkan data transaksi sesuai periode tanggal
            $query = "SELECT * FROM tbl_pengembalian INNER JOIN tbl_peminjaman ON 
            tbl_pengembalian.id_pinjam=tbl_peminjaman.id_pinjam INNER JOIN tbl_siswa ON 
            tbl_peminjaman.nis = tbl_siswa.nis  INNER JOIN tbl_buku ON 
            tbl_peminjaman.id_buku=tbl_buku.id_buku  INNER JOIN tbl_denda ON 
            tbl_pengembalian.id_denda=tbl_denda.id_denda WHERE (tgl_kembali BETWEEN '" . $tgl_awal . "' AND '" . $tgl_akhir . "')";
            $url_cetak = "printkeuangandenda.php?tgl_awal=" . $tgl_awal . "&tgl_akhir=" . $tgl_akhir . "&filter=true";
            $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
            $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
            $label = 'Periode Pengembalian Buku Tanggal ' . $tgl_awal . ' s/d ' . $tgl_akhir;
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
                    $sql = mysqli_query($koneksi, $query); // Eksekusi/Jalankan query dari variabel $query
                    $row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql
                    $totalDenda = 0;
                    if ($row > 0) { // Jika jumlah data lebih dari 0 (Berarti jika data ada)
                        while ($data = mysqli_fetch_array($sql)) { // Ambil semua data dari hasil eksekusi $sql
                            $tgl = date('d-m-Y', strtotime($data['tgl_kembali'])); // Ubah format tanggal jadi dd-mm-yyyy
                            $denda = $data['denda'] * ((int)date_diff(date_create($data['tgl_pinjam']), date_create($data['tgl_kembali']))->format('%r%a') - 7) * $data['jumlah_pinjam'];
                            if ($denda > 0) {
                                $totalDenda += $denda;
                                echo "<tr>";
                                echo "<td>" . $data['nis'] . "</td>";
                                echo "<td>" . $data['nama_siswa'] . "</td>";
                                echo "<td>" . $data['judul_buku'] . "</td>";
                                echo "<td>" . $data['tgl_pinjam'] . "</td>";
                                echo "<td>" . $data['jumlah_pinjam'] . "</td>";
                                echo "<td>" . $data['tgl_kembali'] . "</td>";
                                echo "<td>Rp " . $denda . "</td>";
                                echo "</tr>";
                            }
                        }
                    ?>
                        <tr>
                            <th colspan="6" class="text-center">
                                Total Denda
                            </th>
                            <th colspan="6">
                                Rp <?= $totalDenda ?>
                            </th>
                        </tr>
                    <?php
                    } else { // Jika data tidak ada
                        echo "<tr><td colspan='8'>Data tidak ada</td></tr>";
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>

    <!-- Include File JS Bootstrap -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Include library Bootstrap Datepicker -->
    <script src="libraries/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

    <!-- Include File JS Custom (untuk fungsi Datepicker) -->
    <script src="js/custom.js"></script>

    <script>
        $(document).ready(function() {
            setDateRangePicker(".tgl_awal", ".tgl_akhir");
        })
    </script>
</body>

</html>

<?php
include "footer_admin.php";
?>