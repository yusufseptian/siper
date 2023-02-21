<?php

include "../koneksi.php";
include "header_admin.php";
include "sidebar_admin.php";


if (isset($_GET['id'])) {
  $id_user = ($_GET['id']);
  $query = "SELECT * FROM tbl_user WHERE id_user = '$id_user'";
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
      <b> Edit Data User</b>
    </div>
    <div class="card-body">
      <form action="proses_edituserbaru.php" method="POST">
        <div class="form-group">
          <input type="hidden" class="form-control" name="id_user" placeholder="NIS" value="<?php echo $data['id_user']; ?>">
        </div>
        <div class="form-group">
          <label>Username</label>

          <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $data['username']; ?>" readonly />
        </div>

        <div class="form-group">
          <label>Password</label>

          <input type="password" class="form-control" name="pass" value="">
          <i style="float: left;font-size: 11px;color: red">Abaikan jika tidak ingin merubah password</i><br>
        </div>

        <div class="form-group">
          <label>Level</label>
          <select class="form-control" name="level">
            <option value="<?php echo $data['level']; ?>"><?php echo $data['level']; ?></option>
            <option value="admin">Admin</option>
            <option value="siswa">Siswa</option>
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