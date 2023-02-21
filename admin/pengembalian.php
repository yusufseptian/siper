<?php

include "../koneksi.php";
include "header_admin.php";
include "sidebar_admin.php";

$denda = mysqli_fetch_assoc(mysqli_query($koneksi, "select * from tbl_denda where status='aktif'"));
?>
<!-- Set denda -->
<script>
    const denda = Number(<?= $denda['denda'] ?>);
</script>
<!-- Notifikasi -->
<?php if (isset($_GET['errID'])) : ?>
    <script>
        alert("ID Peminjaman tidak valid");
    </script>
<?php endif ?>
<?php if (isset($_GET['errTglKembali'])) : ?>
    <script>
        alert("Tanggal pengembalian tidak valid");
    </script>
<?php endif ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Pengembalian Buku</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah">+Tambah</button>
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
                            <!-- <th>Aksi</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;

                        $query = "SELECT * FROM tbl_pengembalian INNER JOIN tbl_peminjaman ON 
                            tbl_pengembalian.id_pinjam=tbl_peminjaman.id_pinjam INNER JOIN tbl_siswa ON 
                            tbl_peminjaman.nis = tbl_siswa.nis  INNER JOIN tbl_buku ON 
                            tbl_peminjaman.id_buku=tbl_buku.id_buku  INNER JOIN tbl_denda ON 
                            tbl_pengembalian.id_denda=tbl_denda.id_denda";

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
                                <td><?php echo $row['tgl_kembali']; ?></td>
                                <td>
                                    <?=
                                    ((int)date_diff(date_create($row['tgl_pinjam']), date_create($row['tgl_kembali']))->format('%r%a') - 7) * $row['denda'] * $row['jumlah_pinjam'] ?>
                                </td>

                                </td>
                                <!-- <td>
                                    <a href="hapus_pengembalian.php?id=<?php echo $row['id_kembali']; ?>" class="btn btn
                                        btn-danger " onclick="return confirm('Anda Yakin Akan Menghapus?')">Hapus</a>
                                </td> -->

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<div class="modal fade" id="tambah">
    <form action="tambah_pengembalian.php" method="POST" enctype="multipart/form-data">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pengembalian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <select class="form-control" id="select1" name="nis" onchange="changeValue(this.value)">
                            <option value="">---Pilih NIS---</option>
                            <?php
                            $query = "SELECT *FROM tbl_peminjaman INNER JOIN 
                                        tbl_siswa ON tbl_peminjaman.nis = tbl_siswa.nis INNER JOIN 
                                        tbl_buku ON tbl_peminjaman.id_buku=tbl_buku.id_buku
                                        WHERE keterangan='Belum Kembali'";
                            $jsArray = "var prdName = new Array();\n";
                            $result = mysqli_query($koneksi, $query);
                            if (!$result) {
                                die("Query Eror:" . mysqli_errno($koneksi) . "-" . mysqli_error($koneksi));
                            }
                            while ($row = mysqli_fetch_assoc($result)) {
                                // echo '<option value="' . $row['nis'] . '">' . $row['nis'] . '</option>';
                                $jsArray .= "prdName['" . $row['id_pinjam'] . "'] = {
                                    nama_siswa:'" . addslashes($row['nama_siswa']) .
                                    "', nis:'" . addslashes($row['nis']) .
                                    "', id_pinjam:'" . addslashes($row['id_pinjam']) .
                                    "', jurusan:'" . addslashes($row['jurusan']) .
                                    "', kelas:'" . addslashes($row['kelas']) .
                                    "', judul_buku:'" . addslashes($row['judul_buku']) .
                                    "',tgl_pinjam:'" . addslashes($row['tgl_pinjam']) .
                                    "', jumlah_pinjam:'" . addslashes($row['jumlah_pinjam']) . "'};\n";
                            }
                            $query = "SELECT DISTINCT nis FROM tbl_peminjaman where keterangan='Belum Kembali'";
                            $result = mysqli_query($koneksi, $query);
                            if (!$result) {
                                die("Query Eror:" . mysqli_errno($koneksi) . "-" . mysqli_error($koneksi));
                            }
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['nis'] . '">' . $row['nis'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <label>Nama Siswa</label>
                    <div class="form-group">
                        <input type="text" name="nama_siswa" class="form-control" placeholder="Nama Siswa" id="nama_siswa" required readonly></input>
                    </div>
                    <div class="form-group">
                        <label>Jurusan</label>
                        <input type="text" name="jurusan" class="form-control" placeholder="jurusan" id="jurusan" required readonly></input>
                    </div>
                    <div class="form-group">
                        <label>Kelas</label>
                        <input type="text" name="kelas" class="form-control" placeholder="Kelas" id="kelas" required readonly></input>
                    </div>
                    <div class="form-group">
                        <select class="form-control"  name="id_pinjam" id="id_pinjam" onchange="changeBook(this.value)">
                            <option value="">---Pilih Judul Buku---</option>


                        </select>
                        <script>

                        </script>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Buku yang dipinjam</label>
                        <input type="text" name="jumlah_pinjam" class="form-control" placeholder="Jumlah Buku" id="jumlah_pinjam" required readonly></input>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Pinjam</label>
                        <input type="text" name="tgl_pinjam" class="form-control" placeholder="Tanggal Pinjam" id="tgl_pinjam" required readonly></input>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Kembali</label>
                        <input type="date" name="tgl_kembali" class="form-control" placeholder="tgl_kembali" required onchange="changeTglKembali(this.value)"></input>
                    </div>
                    <div class="form-group">
                        <label>Denda</label>
                        <input type="number" name="id_denda" id="id_denda" class="form-control" placeholder="denda" required readonly></input>
                        <input type="hidden" name="denda" value="<?= $denda['id_denda'] ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btnSimpan">Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>
</div>

<script type="text/javascript">
    <?php echo $jsArray; ?>

    function changeValue(x) {
        var sContainer = document.getElementById('id_pinjam');
        while (sContainer.hasChildNodes()) {
            sContainer.removeChild(sContainer.firstChild);
        }
        prdName.forEach(function(element) {
            if (element.nis == x) {
                document.getElementById('nama_siswa').value = element.nama_siswa;
                document.getElementById('jurusan').value = element.jurusan;
                document.getElementById('kelas').value = element.kelas;
                // break;
            }
        });
        prdName.forEach(function(element) {
            if (element.nis == x) {
                let option = document.createElement('option');
                option.setAttribute("value", element.id_pinjam);
                option.innerHTML = element.judul_buku;
                sContainer.append(option);
            }
        });
        changeBook(sContainer.value);
    }

    function changeBook(x) {
        prdName.forEach(function(element) {
            if (element.id_pinjam == x) {
                document.getElementById('jumlah_pinjam').setAttribute('value', element.jumlah_pinjam);
                document.getElementById('tgl_pinjam').setAttribute('value', element.tgl_pinjam);
            }
        });
        changeTglKembali(document.getElementById('tgl_kembali').value);
    }

    function changeTglKembali(x) {
        try {
            datePinjam = new Date(document.getElementById('tgl_pinjam').value);
            dateKembali = new Date(x);
            var dateDiff = (dateKembali.getTime() - datePinjam.getTime()) / (1000 * 3600 * 24);
            if (dateDiff < 0) {
                alert('Tanggal tidak sesuai');
                document.getElementById("btnSimpan").disabled = true;
            } else {
                document.getElementById("btnSimpan").disabled = false;
            }
            var txtDenda = document.getElementById('id_denda');
            if (dateDiff > 7) {
                txtDenda.value = denda * (dateDiff - 7) * Number(document.getElementById('jumlah_pinjam').value);
            } else {
                txtDenda.value = 0;
            }
        } catch (error) {
            document.getElementById("btnSimpan").disabled = true;
        }
    }
    document.getElementById("btnSimpan").disabled = true;
</script>
<?php
include "footer_admin.php";
?>


<script type="text/javascript">
  $('#select1').select2()


  $('#select2').select2()
  $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
  });
</script>