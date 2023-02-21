<?php

include "../koneksi.php";
include "header_siswa.php";
include "sidebar_siswa.php";

?>



<!-- Begin Page Content -->
<div class="container-fluid">


  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Buku Tamu</h1>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <a href="tambah_bukutamu.php" class="btn btn-primary"> + Isi Buku Tamu</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">

        <i style="float: left;font-size: 18px;color: red"> *Jika Anda telah mengisi ini, silahkan foto atau screenshoot dan tunjukkan ke petugas perpustakaan sebagai bukti Anda telah mengisi buku tamu</i><br>

        <br>
        <br>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No.</th>
              <th>Tanggal Kunjungan</th>
              <th>Nama</th>
              <th>Keperluan</th>
            </tr>
          </thead>

          <tbody>
            <?php
            $no = 1;
            $query = "SELECT *FROM tbl_bukutamu";
            $result = mysqli_query($koneksi, $query);
            if (!$result) {
              die("Query eror:" . mysqli_errno($koneksi) . "-" . mysqli_connect($koneksi));
            }

            while ($row = mysqli_fetch_assoc($result)) {

              ?>


              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['tgl_kunjungan']; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['keperluan']; ?></td>

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
    <form action="tambah_bukutamu.php" method="POST" enctype="multipart/form-data">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Buku Tamu</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php
            $query = "SELECT * FROM tbl_siswa WHERE nama_siswa = '" . $_SESSION['username'] . "'";
            $result = mysqli_query($koneksi, $query);
            if (!$result) {
              die("Query gagal dijalankan : " . mysqli_errno($koneksi) . "-" . mysqli_error($koneksi));
            }
            $data = mysqli_fetch_assoc($result);
            ?>
            <div class="form-group">
              <!--  <label>NIS</label> -->
              <input type="date" name="tgl_kunjungan" class="form-control" placeholder="Tanggal Kunjungan" required></input>
            </div>
            <div class="form-group">
              <!-- <label>Nama Siswa</label> -->
              <input type="text" name="nama" class="form-control" placeholder="Nama" value="<?php echo $data['nama_siswa']; ?>">
            </div>
            <! -->
            <div class="form-group">
              <select class="form-control" name="keperluan">
                <option value="">--Pilih Keperluan--</option>
                <option value="Membaca">Membaca</option>
                <option value="Meminjam Buku">Meminjam Buku</option>
                <option value="Mengerjakan Tugas">Mengerjakan Tugas</option>
              </select>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </div>
        </div>
      </form>
    </div>

    <?php
    include "footer_siswa.php";
    ?>