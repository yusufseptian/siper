<?php

include "../koneksi.php";
include "header_admin.php";
include "sidebar_admin.php";
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Siswa</h1>

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
                            <th>NIS</th><!-- 
                                            <th>Username</th> -->
                            <th>Nama Siswa</th>
                            <th>Jenis Kelamin</th>
                            <th>Jurusan</th>
                            <th>Kelas</th>
                            <th>Alamat</th>
                            <th>No. Hp</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;
                        $query = "SELECT *FROM tbl_siswa";
                        $result = mysqli_query($koneksi, $query);
                        if (!$result) {
                            die("Query eror:" . mysqli_errno($koneksi) . "-" . mysqli_connect($koneksi));
                        }

                        while ($row = mysqli_fetch_assoc($result)) {

                        ?>


                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $row['nis']; ?></td>
                                <!--  <td><?php $query = "SELECT *FROM tbl_user WHERE username = '" . $row['nama_siswa'] . "'";
                                            $result2 = mysqli_query($koneksi, $query);
                                            $data = mysqli_fetch_assoc($result2);
                                            echo $data['username'];


                                            ?>
                                             
                                             </td>
                                             -->
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
                                        if ($row['status'] == 'aktif') {
                                        ?>
                                            <button type="submit" class="btn btn-success btn-sm"> <i class="fa fa-check"></i></button>
                                        <?php
                                        } else {
                                        ?>
                                            <button type="submit" class="btn btn-danger btn-sm"> <i class="fa fa-times"></i></button>
                                        <?php
                                        }
                                        ?>

                                    </form>

                                </td>
                                <td>
                                    <a href="edit_datasiswa.php?id=<?php echo $row['nis']; ?>" class="btn btn
                                                btn-warning">Edit</a>
                                    <a href="hapus_siswa.php?id=<?php echo $row['nis']; ?>" class="btn btn
                                                btn-danger" onclick="return confirm('Anda Yakin Akan Menghapus?')">Hapus</a>
                                </td>

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
    <form action="tambah_siswa.php" method="POST" enctype="multipart/form-data">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <!--  <label>NIS</label> -->
                        <input type="number" name="nis" class="form-control" placeholder="NIS" required></input>
                    </div>

                    <div class="form-group">
                        <!-- <label>Nama Siswa</label> -->
                        <input type="text" name="nama_siswa" class="form-control" placeholder="Nama Siswa" required></input>
                    </div>
                    <div class="form-group">
                        <!--  <label >Jenis Kelamin</label> -->
                        <select class="form-control" name="jenis_kelamin">
                            <option value="">--Pilih Jenis Kelamin--</option>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <!-- <label>Password</label> -->
                        <input type="text" name="pass" class="form-control" placeholder="Password" required></input>
                    </div>
                    <div class="form-group">
                        <!-- <label>Jurusan</label> -->
                        <input type="text" name="jurusan" class="form-control" placeholder="Jurusan" required></input>
                    </div>
                    <div class="form-group">
                        <!--  <label>Kelas</label> -->
                        <input type="number" name="kelas" class="form-control" placeholder="Kelas" required></input>
                    </div>
                    <div class="form-group">
                        <!-- <label>Alamat</label> -->
                        <textarea name="alamat" class="form-control" placeholder="Alamat" required></textarea>

                    </div>
                    <div class="form-group">
                        <!-- <label>No. Hp</label> -->
                        <input type="number" name="no_hp" class="form-control" placeholder="No. Hp" required></input>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>
</div>

<?php
include "footer_admin.php";
?>