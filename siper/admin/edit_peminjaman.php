<?php

include "../koneksi.php";
include "header_admin.php";
include "sidebar_admin.php";


if (isset($_GET['id'])) {
  $id_pinjam = ($_GET['id']);
  $query = "SELECT * FROM tbl_peminjaman INNER JOIN tbl_siswa ON tbl_peminjaman.nis = tbl_siswa.nis INNER JOIN tbl_buku ON tbl_peminjaman.id_buku=tbl_buku.id_buku where id_pinjam='$id_pinjam'";
  $result = mysqli_query($koneksi, $query);
  if (!$result) {
    die("Query gagal dijalankan : " . mysqli_errno($koneksi) . "-" . mysqli_error($koneksi));
  }
  $data = mysqli_fetch_assoc($result);
}
?>



<div class="container-fluid ">

  <div class="card">
    <div class="card-header">
      <b> Edit Peminjaman</b>
    </div>
    <div class="card-body">
      <form action="proses_peminjaman.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label>NIS</label>
          <input type="hidden" class="form-control" name="id_pinjam" value="<?php echo $data['id_pinjam']; ?>" readonly>
          <input type="text" class="form-control" name="nis" value="<?php echo $data['nis']; ?>" readonly>
        </div>
        <div class="form-group">
          <label>Nama</label>

          <input type="text" class="form-control" name="nama_siswa" value="<?php echo $data['nama_siswa']; ?>" readonly>
        </div>

        <label>Judul Buku</label>
        <div class="form-group">
          <select class="form-control" id="select1" name="id_buku">
            <option value="<?php echo $data['id_buku']; ?>"><?php echo $data['judul_buku']; ?></option>
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
          <label>Tanggal Pinjam</label>

          <input type="text" class="form-control" name="tgl_pinjam" value="<?php echo $data['tgl_pinjam']; ?>">
        </div>

        <div class="form-group">
          <label>Jumlah Pinjam</label>

          <input type="text" class="form-control" name="jumlah_pinjam" value="<?php echo $data['jumlah_pinjam']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
    </div>
  </div>

</div>

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