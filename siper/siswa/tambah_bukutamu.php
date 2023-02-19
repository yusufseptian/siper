<?php 
include "../koneksi.php";
include "header_siswa.php";
include "sidebar_siswa.php";



	$query ="SELECT * FROM tbl_siswa WHERE nis = '".$_SESSION['username']."'";
	$result = mysqli_query($koneksi, $query);
	if (!$result) {
			die("Query gagal dijalankan : ".mysqli_errno($koneksi)."-".mysqli_error($koneksi));		
} 
$data = mysqli_fetch_assoc($result);


 ?>



<div class="container-fluid ">

<div class="card">
  <div class="card-header">
   <b> Buku Tamu</b>
  </div>
  <div class="card-body">
    <form action="proses_bukutamu.php" method="POST">
  <div class="form-group">
    <label>Tanggal Kunjungan</label>
    
    <input type="date" class="form-control" name="tgl_kunjungan" placeholder="Tanggal Kunjungan">
  </div>
  <div class="form-group">
    <label>Username</label>
    
    <input type="text" class="form-control" name="nama" placeholder="Nama" value="<?php echo $data['nama_siswa']; ?>" readonly/>
  </div><!-- 
  <div class="form-group">
    <label>Nama </label>
    
    <input type="text" class="form-control" name="nama" placeholder="Nama" value="<?php echo $data['nama']; ?>">
  </div> -->

  <div class="form-group">
    <label>Alamat</label>
    
    <input type="text" class="form-control" name="alamat" placeholder="Alamat" value="<?php echo $data['alamat']; ?>">
  </div>

  <div class="form-group">
    <label>Jurusan</label>
    
    <input type="text" class="form-control" name="jurusan" placeholder="Jurusan" value="<?php echo $data['jurusan']; ?>">
  </div>
  <div class="form-group">
    <label>Kelas</label>
    
    <input type="text" class="form-control" name="kelas" placeholder="Kelas" value="<?php echo $data['kelas']; ?>">
  </div>
  <div class="form-group">
                         <select class="form-control" name="keperluan">
                            <option value="">--Pilih Keperluan--</option>
                            <option value="Membaca">Membaca</option>
                            <option value="Meminjam Buku">Meminjam Buku</option>
                            <option value="Mengembalikan Buku">Mengembalikan Buku</option>
                            <option value="Mengerjakan Tugas">Mengerjakan Tugas</option>
                          </select>
                      </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
  </div>
</div>

</div>

<?php 
include "footer_siswa.php";
 ?>