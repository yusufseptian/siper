<?php 

include "../koneksi.php";
include "header_admin.php";
include "sidebar_admin.php";

?>



<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Data Buku</h1>

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
              <th>Gambar</th>
              <th>Judul Buku</th>
              <th>Penerbit</th>
              <th>Tahun Terbit</th>
              <th>Stok</th>
              <th>Kategori</th>
              <th>Rak</th>
              <th>Detail</th>
              <th>Aksi</th>
            </tr>
          </thead>

          <tbody>
            <?php 
            $no=1;
            $query = "SELECT *FROM tbl_buku INNER JOIN tbl_kategori ON tbl_buku.id_kategori = tbl_kategori.id_kategori INNER JOIN tbl_rak ON tbl_buku.id_rak=tbl_rak.id_rak";
            $result = mysqli_query($koneksi, $query);
            if (!$result) {
              die("Query eror:".mysqli_errno($koneksi)."-".mysqli_connect($koneksi));
            }

            while ($row = mysqli_fetch_assoc($result))
            {

             ?>


             <tr>
              <td><?php echo $no++; ?></td>
              <td><img class="d-block" src="gambar_admin/<?php echo $row['gambar'];?>" width ="100"></td>
              <td><?php echo $row['judul_buku']; ?></td>
              <td><?php echo $row['penerbit']; ?></td>
              <td><?php echo $row['tahun_terbit']; ?></td>
              <td><?php echo $row['stok']; ?></td>
              <td><?php echo $row['nama_kategori']; ?></td>
              <td><?php echo $row['nama_rak']; ?></td>
              <td><?php echo $row['detail']; ?></td>

            </td>
            <td>
              <a href="edit_databuku.php?id=<?php echo $row['id_buku']; ?>" class="btn btn
                btn-warning ">Edit</a>
                <a href="hapus_databuku.php?id=<?php echo $row['id_buku'];?>" class="btn btn
                  btn-danger " onclick="return confirm('Anda Yakin Akan Menghapus?')">Hapus</a>
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
    <form action="tambah_databuku.php" method="POST" enctype="multipart/form-data">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Buku</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <div class="form-group">
              <input type="text" name="judul_buku" class="form-control" placeholder="Judul Buku" required></input>
            </div>
            <div class="form-group">
              <input type="text" name="penerbit" class="form-control" placeholder="Penerbit" required></input>
            </div>
            <div class="form-group">
              <input type="number" name="tahun_terbit" class="form-control" placeholder="Tahun Terbit" required></input>
            </div>
            <div class="form-group">
              <input type="number" name="stok" class="form-control" placeholder="Stok" required></input>
            </div>
            <div class="form-group">
            <select class="form-control" id="select1" name="id_kategori">
                <option value="">---Pilih Kategori---</option>
                <?php
                $query= "SELECT * FROM tbl_kategori";
                $result=mysqli_query($koneksi, $query);
                if (!$result) {
                  die("Query Eror:".mysqli_errno($koneksi)."-".mysqli_error($koneksi));
                }

                while ($row = mysqli_fetch_assoc($result)) {
                  echo '<option value="'.$row['id_kategori'].'">'.$row['nama_kategori'].'</option>';

                }


                ?>
              </select>

            </div>
            <div class="form-group">
              <select class="form-control" id="select2"  name="id_rak">
                <option value="">---Pilih Rak---</option>
                <?php
                $query= "SELECT * FROM tbl_rak";
                $result=mysqli_query($koneksi, $query);
                if (!$result) {
                  die("Query Eror:".mysqli_errno($koneksi)."-".mysqli_error($koneksi));
                }

                while ($row = mysqli_fetch_assoc($result)) {
                  echo '<option value="'.$row['id_rak'].'">'.$row['nama_rak'].'</option>';

                }


                ?>
              </select>

            </div>
            <div class="form-group">
              <label>Gambar</label>
              <input type="file" name="gambar" class="form-control" placeholder="Gambar" required></input>
                      </div><!-- 
                      <label>Detail</label> -->
                      <div class="form-group">
                        <textarea name="detail" class="form-control" placeholder="Detail Buku" required></textarea>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>

            <?php 
            include "footer_admin.php";
            ?>

            <script type="text/javascript">

              $('#select1').select2()


              $('#select2').select2()
              $(document).ready(function(){
                $('.js-example-basic-multiple').select2();
              });

            </script>
