<?php 

include "../koneksi.php";
include "header_admin.php";
include "sidebar_admin.php";

 ?>



<!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Data User</h1>
                    
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
                                            <th>Username</th>
                                            <th>Level</th>
                                            <th>Aksi</th>
                                            
                                        </tr>
                                    </thead>
                                  
                                    <tbody>
                                        <?php 
                                            $no=1;
                                            $query = "SELECT *FROM tbl_user";
                                            $result = mysqli_query($koneksi, $query);
                                            if (!$result) {
                                                die("Query eror:".mysqli_errno($koneksi)."-".mysqli_connect($koneksi));
                                            }

                                            while ($row = mysqli_fetch_assoc($result))
                                             {
                                            
                                         ?>


                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $row['username']; ?></td>
                                            <td><?php echo $row['level']; ?></td>
                                            <td>
                                                <a href="edit_datauser.php?id=<?php echo $row['id_user']; ?>" class="btn btn
                                                btn-warning">Edit</a>
                                                <a href="hapus_user.php?id=<?php echo $row['id_user']; ?>" class="btn btn
                                                btn-danger" onclick="return confirm('Anda Yakin Akan Menghapus?')">Hapus</a>
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
                <form action="tambah_user.php" method="POST" enctype="multipart/form-data">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Tambah User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                      <div class="form-group">
                          <label>Username</label>
                          <input type="text" name="username" class="form-control" placeholder="Username" required></input>
                      </div>
                       <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="pass" class="form-control" placeholder="Password" required></input>
                      </div>
                       <div class="form-group">
                         <select class="form-control" name="level">
                            <option value="">--Pilih Level--</option>
                            <option value="admin">Admin</option>
                            <option value="siswa">Siswa</option>
                          </select>
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

<?php 
include "footer_admin.php";
 ?>