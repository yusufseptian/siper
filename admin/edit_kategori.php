<?php 

include "../koneksi.php";
include "header_admin.php";
include "sidebar_admin.php";


if (isset($_GET['id'])) {
	$id_kategori = ($_GET['id']);
	$query ="SELECT * FROM tbl_kategori WHERE id_kategori = '$id_kategori'";
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
   <b> Edit Kategori</b>
  </div>
  <div class="card-body">
    <form action="proses_editkategori.php" method="POST">
  <div class="form-group">
    <label>Nama Kategori</label>
    <input type="hidden" class="form-control" name="id_kategori" placeholder="Nama Kategori" value="<?php echo $data['id_kategori']; ?>">
    <input type="text" class="form-control" name="nama_kategori" placeholder="Nama Kategori" value="<?php echo $data['nama_kategori']; ?>">
  </div>

    <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</div>

</div>

<?php 
include "footer_admin.php";
 ?>