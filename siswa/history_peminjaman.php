<?php
include "../koneksi.php";
include "header_siswa.php";
include "sidebar_siswa.php";

?>
<!-- Get Denda aktif -->
<?php
$dtDenda = mysqli_fetch_assoc(mysqli_query($koneksi, "select * from tbl_denda where status='aktif'"))
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Transaksi Peminjaman Buku</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
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
                            <th>Keterangan (kembalikan/belum)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;

                        $query = "SELECT * FROM tbl_peminjaman 
                        INNER JOIN tbl_siswa ON tbl_peminjaman.nis = tbl_siswa.nis
                        INNER JOIN tbl_buku ON tbl_peminjaman.id_buku=tbl_buku.id_buku where tbl_peminjaman.nis = '" . $_SESSION['nis'] . "'";
                        $result = mysqli_query($koneksi, $query);
                        if (!$result) {
                            die("Query eror:" . mysqli_errno($koneksi) . "-" . mysqli_connect($koneksi));
                        }
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $row['nis']; ?></td>
                                <td><?php echo $row['nama_siswa']; ?></td>
                                <td><?php echo $row['judul_buku']; ?></td>
                                <td><?php echo $row['tgl_pinjam']; ?></td>
                                <td><?php echo $row['jumlah_pinjam']; ?></td>
                                <td>
                                    <?php $dt = mysqli_fetch_assoc(mysqli_query($koneksi, "select * from tbl_pengembalian where id_pinjam='" . $row['id_pinjam'] . "'")) ?>
                                    <?= (empty($dt)) ? '-' : $dt['tgl_kembali'] ?>
                                </td>
                                <td>
                                    <?php if (empty($dt)) : ?>
                                        <?= ((int)date_diff(date_create($row['tgl_pinjam']), date_create())->format('%r%a') - 7) * $dtDenda['denda'] * $row['jumlah_pinjam'] ?>
                                    <?php else : ?>
                                        <?= ((int)date_diff(date_create($row['tgl_pinjam']), date_create($dt['tgl_kembali']))->format('%r%a') - 7) * $dtDenda['denda'] * $row['jumlah_pinjam']  ?>
                                    <?php endif ?>
                                </td>
                                <td><?php echo $row['keterangan']; ?></td>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    <?php echo $jsArray; ?>

    function changeValue(x) {
        document.getElementById('nama_siswa').value = prdName[x].nama_siswa;
        document.getElementById('jurusan').value = prdName[x].jurusan;
        document.getElementById('kelas').value = prdName[x].kelas;
        document.getElementById('judul_buku').value = prdName[x].judul_buku;
        document.getElementById('tgl_pinjam').value = prdName[x].tgl_pinjam;
        document.getElementById('jumlah_pinjam').value = prdName[x].jumlah_pinjam;
    };
</script>
<?php
include "footer_siswa.php";
?>