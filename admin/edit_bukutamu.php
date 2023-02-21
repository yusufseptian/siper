<?php 

include "../koneksi.php";
include "header_admin.php";
include "sidebar_admin.php";


if (isset($_GET['id'])) {
	$id_bukutamu = ($_GET['id']);
	$query ="SELECT * FROM tbl_bukutamu WHERE id_bukutamu = '$id_bukutamu'";
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
     <b> Edit Buku Tamu</b>
   </div>
   <div class="card-body">
   <form action="proses_editbukutamu.php" method="POST">
      <div class="form-group">
        <input type="hidden" class="form-control" name="id_bukutamu" placeholder="NIS" value="<?php echo $data['id_bukutamu']; ?>">
      </div>
       <div class="form-group">
    <label>Tanggal Kunjungan</label>
    
    <input type="date" class="form-control" name="tgl_kunjungan"  value="<?php echo $data['tgl_kunjungan']; ?>">
  </div>
      <div class="form-group">
        <label>Nama</label>

        <input type="text" class="form-control" name="nama" placeholder="nama" value="<?php echo $data['nama']; ?>" readonly/>
      </div>
<div class="form-group">
        <label>Alamat</label>

        <input type="text" class="form-control" name="alamat" placeholder="alamat" value="<?php echo $data['alamat']; ?>" readonly/>
      </div>
      <div class="form-group">
        <label>Kelas</label>

        <input type="text" class="form-control" name="kelas" placeholder="kelas" value="<?php echo $data['kelas']; ?>"readonly/>
      </div>
      <div class="form-group">
        <label>Jurusan</label>

        <input type="text" class="form-control" name="jurusan" placeholder="jurusan" value="<?php echo $data['jurusan']; ?>"readonly/>
      </div>
      <div class="form-group">
        <label>Keperluan</label>

                         <select class="form-control" name="keperluan">
                            <option value="<?php echo $data['keperluan']; ?>"><?php echo $data['keperluan']; ?></option>
                            <option value="">--Pilih Keperluan--</option>
                            <option value="Membaca">Membaca</option>
                            <option value="Meminjam Buku">Meminjam Buku</option>
                            <option value="Mengembalikan Buku">Mengembalikan Buku</option>
                            <option value="Mengerjakan Tugas">Mengerjakan Tugas</option>
                            </select>
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</div>

</div>
</div>

<?php 
include "footer_admin.php";
?>