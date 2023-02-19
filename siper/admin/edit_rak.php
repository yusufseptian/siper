<?php 

include "../koneksi.php";
include "header_admin.php";
include "sidebar_admin.php";


if (isset($_GET['id'])) {
	$id_rak = ($_GET['id']);
	$query ="SELECT * FROM tbl_rak WHERE id_rak = '$id_rak'";
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
   <b> Edit Rak</b>
  </div>
  <div class="card-body">
    <form action="proses_editrak.php" method="POST">
  <div class="form-group">
    <label>Nama Rak</label>
    <input type="hidden" class="form-control" name="id_rak" placeholder="Nama rak" value="<?php echo $data['id_rak']; ?>">
    <input type="text" class="form-control" name="nama_rak" placeholder="Nama rak" value="<?php echo $data['nama_rak']; ?>">
  </div>

    <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</div>

</div>

<?php 
include "footer_admin.php";
 ?>