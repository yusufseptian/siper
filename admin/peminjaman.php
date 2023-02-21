<?php

include "../koneksi.php";
include "header_admin.php";
include "sidebar_admin.php";

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
  <h1 class="h3 mb-2 text-gray-800">Peminjaman Buku</h1>

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
              <th>Keterangan</th>
              <th>Aksi</th>
            </tr>
          </thead>

          <tbody>
            <?php
            $no = 1;
            $query = "SELECT *FROM tbl_peminjaman INNER JOIN tbl_siswa ON tbl_peminjaman.nis = tbl_siswa.nis INNER JOIN tbl_buku ON tbl_peminjaman.id_buku=tbl_buku.id_buku";
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
                <td><?php echo $row['keterangan']; ?></td>

                </td>
                <td>
                  <?php if ($row['keterangan'] == 'Belum Kembali') : ?>
                    <a href="edit_peminjaman.php?id=<?php echo $row['id_pinjam']; ?>" class="btn btn
                btn-warning ">Edit</a>
                    <a href="hapus_peminjaman.php?id=<?php echo $row['id_pinjam']; ?>" class="btn btn
                  btn-danger " onclick="return confirm('Anda Yakin Akan Menghapus?')">Hapus</a>
                </td>
              <?php endif ?>

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
  <form action="tambah_peminjaman.php" method="POST" enctype="multipart/form-data">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Peminjaman</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">

            <select class="form-control" id="select1" name="nis" onchange="changeValue(this.value)">
              <option value="">---Pilih NIS---</option>
              <?php
              $query = "SELECT * FROM tbl_siswa WHERE status = 'aktif'";
              $jsArray = "var prdName = new Array();\n";
              $result = mysqli_query($koneksi, $query);
              if (!$result) {
                die("Query Eror:" . mysqli_errno($koneksi) . "-" . mysqli_error($koneksi));
              }

              while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row['nis'] . '">' . $row['nis'] . '</option>';
                $jsArray .= "prdName['" . $row['nis'] . "'] = {nama_siswa:'" . addslashes($row['nama_siswa']) . "', jurusan:'" . addslashes($row['jurusan']) . "', kelas:'" . addslashes($row['kelas']) . "'};\n";
              }


              ?>
            </select>
          </div>

          <div class="form-group">
            <input type="text" name="nama_siswa" class="form-control" placeholder="Nama Siswa" id="nama_siswa" required></input>
          </div>


          <div class="form-group">
            <input type="text" name="jurusan" class="form-control" placeholder="jurusan" id="jurusan" required></input>
          </div>

          <div class="form-group">
            <input type="text" name="kelas" class="form-control" placeholder="Kelas" id="kelas" required></input>
          </div>
          </select>
          <div class="form-group">
            <select class="form-control" id="select2" name="id_buku">
              <option value="">---Pilih Buku---</option>
              <?php
              $query = "SELECT * FROM tbl_buku";
              $result = mysqli_query($koneksi, $query);
              if (!$result) {
                die("Query Eror:" . mysqli_errno($koneksi) . "-" . mysqli_error($koneksi));
              }

              while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row['id_buku'] . '">' . $row['judul_buku'] . '</option>';
              }


              ?>
            </select>
          </div>
          <div class="form-group">
            <input type="date" name="tgl_pinjam" class="form-control" placeholder="Tanggal Pinjam" required></input>
          </div>
          <div class="form-group">
            <input type="number" name="jumlah_pinjam" class="form-control" placeholder="Jumlah" required></input>
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

<script type="text/javascript">
  <?php echo $jsArray; ?>

  function changeValue(x) {
    document.getElementById('nama_siswa').value = prdName[x].nama_siswa;
    document.getElementById('jurusan').value = prdName[x].jurusan;
    document.getElementById('kelas').value = prdName[x].kelas;
  };
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