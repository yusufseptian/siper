<?php 

include "../koneksi.php";
include "header_admin.php";
include "sidebar_admin.php";


if (isset($_GET['id'])) {
	$id_buku = ($_GET['id']);
	$query ="SELECT * FROM tbl_buku  INNER JOIN tbl_kategori ON tbl_buku.id_kategori=tbl_kategori.id_kategori INNER JOIN tbl_rak ON tbl_buku.id_rak=tbl_rak.id_rak WHERE id_buku='$id_buku'";
	$result = mysqli_query($koneksi, $query);
	if (!$result) {
			die("Query gagal dijalankan : ".mysqli_errno($koneksi)."-".mysqli_error($koneksi));		
} 
$data = mysqli_fetch_assoc($result);

}
 ?>



<div class="container-fluid ">

<div class="card">
  <div class="card-header">
   <b> Edit Data Buku</b>
  </div>
  <div class="card-body">
    <form action="proses_editdatabuku.php" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label>Gambar</label>
    <img class="d-block" src="gambar_admin/<?php echo $data['gambar'];?>" width ="200">
    <br>
    <input type="file" class="form-control" name="gambar" placeholder="gambar" >
  </div>
  <div class="form-group">
    <label>Judul Buku</label>
    <input type="hidden" class="form-control" name="id_buku" placeholder="Id Buku" value="<?php echo $data['id_buku']; ?>"> 
    <input type="text" class="form-control" name="judul_buku" placeholder="Judul Buku" value="<?php echo $data['judul_buku']; ?>">
  </div>
  <div class="form-group">
    <label>Penerbit</label>
    
    <input type="text" class="form-control" name="penerbit" placeholder="Penerbit" value="<?php echo $data['penerbit']; ?>">
  </div>
  <div class="form-group">
    <label>Tahun Terbit</label>
    
    <input type="text" class="form-control" name="tahun_terbit" placeholder="tahun_terbit" value="<?php echo $data['tahun_terbit']; ?>">
  </div>
  <div class="form-group">
    <label>Stok</label>
    
    <input type="text" class="form-control" name="stok" placeholder="Stok" value="<?php echo $data['stok']; ?>">
  </div>
   <div class="form-group">
                      <select class="form-control" id="select1" name="id_kategori">
                        <option value="<?php echo $data['id_kategori']; ?>"><?php echo $data['nama_kategori']; ?></option>
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
                      <select class="form-control" id="select2" name="id_rak">
                        <option value="<?php echo $data['id_rak']; ?>"><?php echo $data['nama_rak']; ?></option>
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
    <label>Detail</label>
    
    <input type="text" class="form-control" name="detail" placeholder="Detail Buku" value="<?php echo $data['detail']; ?>">
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
              $(document).ready(function(){
                $('.js-example-basic-multiple').select2();
              });

            </script>