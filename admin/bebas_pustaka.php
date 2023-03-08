<?php

include "../koneksi.php";
include "header_admin.php";
include "sidebar_admin.php";

if (isset($_GET['nis'])) {
    $nis = $_GET['nis'];
    if (!is_numeric($nis)) {
        $_SESSION['error'] = 'NIS tidak valid';
        echo "<script>window.location.href= '?'</script>";
        die;
    } else {
        $dtSiswa = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tbl_siswa WHERE nis='$nis'"));
        if (empty($dtSiswa)) {
            $_SESSION['error'] = "Data siswa dengan NIS $nis tidak ditemukan";
            echo "<script>window.location.href= '?'</script>";
            die;
        }
        $dtPeminjaman = mysqli_query($koneksi, "SELECT * FROM tbl_peminjaman INNER JOIN tbl_siswa ON tbl_siswa.nis = tbl_peminjaman.nis INNER JOIN tbl_buku ON tbl_peminjaman.id_buku = tbl_buku.id_buku WHERE tbl_peminjaman.nis='$nis' ORDER BY keterangan DESC");
    }
}

if (isset($_SESSION['error'])) {
?>
    <script>
        alert('<?= $_SESSION['error'] ?>')
    </script>
<?php
    unset($_SESSION['error']);
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Bebas Pustaka</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="form-inline" method="get">
                <input name="nis" class="form-control mr-sm-2" type="search" placeholder="Masukkan Nis" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cek</button>
            </form>
            <?php if (isset($_GET['nis'])) : ?>
                <div class="my-3 border-bottom border-top">
                    <table>
                        <tr>
                            <td>Nama</td>
                            <td class="mx-3">:</td>
                            <td><?= $dtSiswa['nama_siswa'] ?></td>
                        </tr>
                        <tr>
                            <td>NIS</td>
                            <td>:</td>
                            <td><?= $dtSiswa['nis'] ?></td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td>:</td>
                            <td><?= $dtSiswa['kelas'] . " " . $dtSiswa['jurusan'] ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td class="<?= ($dtSiswa['status'] == 'aktif') ? 'text-success' : 'text-danger' ?>">
                                <?= ($dtSiswa['status'] == 'aktif') ? 'Aktif' : 'Tidak Aktif' ?>
                            </td>
                        </tr>
                    </table>
                    <?php if (mysqli_num_rows($dtPeminjaman) == 0) : ?>
                        <small class="text-warning">
                            * Siswa ini belum pernah melakukan transaksi peminjaman buku
                        </small>
                    <?php endif ?>
                </div>
            <?php endif ?>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataPeminjaman" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <!-- <th>Aksi</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php $bebasPustaka = true ?>
                        <?php while ($dt = mysqli_fetch_assoc($dtPeminjaman)) : ?>
                            <tr class="<?= ($dt['keterangan'] == 'Belum Kembali') ? 'bg-danger text-white' : '' ?>">
                                <td><?= $no++ ?></td>
                                <td><?= $dt['nis'] ?></td>
                                <td><?= $dt['nama_siswa'] ?></td>
                                <td><?= $dt['judul_buku'] ?></td>
                                <td><?= date("d/m/Y", strtotime($dt['tgl_pinjam'])) ?></td>
                                <td><?= $dt['jumlah_pinjam'] ?></td>
                                <td><?= $dt['keterangan'] ?></td>
                            </tr>
                            <?php if ($dt['keterangan'] == 'Belum Kembali') {
                                $bebasPustaka = false;
                            } ?>
                        <?php endwhile ?>
                    </tbody>
                </table>
            </div>
            <?php if (isset($_GET['nis'])) : ?>
                <form action="proses_bebas_pustaka.php" method="post">
                    <input type="hidden" name="nis" value="<?= $dtSiswa['nis'] ?>">
                    <div class="text-right mt-3">
                        <?php if ($dtSiswa['status'] == 'aktif') : ?>
                            <button class="btn btn-danger">Non Aktifkan</button>
                        <?php else : ?>
                            <button class="btn btn-success">Aktifkan</button>
                        <?php endif ?>
                    </div>
                </form>
            <?php endif ?>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php
include "footer_admin.php";
?>


<script type="text/javascript">
    $('#select1').select2()

    $('#select2').select2()
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });

    $('#dataPeminjaman').dataTable({
        searching: false
    })
</script>