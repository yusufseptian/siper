<?php

include "../koneksi.php";
include "header_admin.php";
include "sidebar_admin.php";


if (isset($_GET['id'])) {
    $nis = ($_GET['id']);
    $query = "SELECT * FROM tbl_siswa WHERE nis='$nis'";
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
            <b> Edit Data Siswa</b>
        </div>
        <div class="card-body">
            <form action="proses_editdatasiswa.php" method="POST">
                <div class="form-group">
                    <label>Username</label>

                    <input type="text" class="form-control" name="username" value="<?php echo $data['nama_siswa']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>NIS</label>

                    <input type="text" class="form-control" name="nis" placeholder="NIS" value="<?php echo $data['nis']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label>Nama Siswa</label>

                    <input type="text" class="form-control" name="nama_siswa" placeholder="Nama Siswa" value="<?php echo $data['nama_siswa']; ?>">
                </div>
                <label>Jenis Kelamin</label>
                <div class="form-group">
                    <select class="form-control" name="jenis_kelamin">
                        <option value="<?php echo $data['jenis_kelamin']; ?>"><?php echo $data['jenis_kelamin']; ?></option>
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="pass" placeholder="Password" value="">
                    <small class="text-warning"><i>* Jika tidak ingin diubah silahkan kosongi, jika ingin diubah silahkan isi password baru</i></small>
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
                    <label>Alamat</label>

                    <input type="text" class="form-control" name="alamat" placeholder="Alamat" value="<?php echo $data['alamat']; ?>">
                </div>
                <div class="form-group">
                    <label>No. Hp</label>

                    <input type="text" class="form-control" name="no_hp" placeholder="No. Hp" value="<?php echo $data['no_hp']; ?>">
                </div>
                <div class="form-group">
                    <label>Status</label>

                    <input type="text" class="form-control" name="status" placeholder="Status" value="<?php echo $data['status']; ?>">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

</div>

<?php
include "footer_admin.php";
?>