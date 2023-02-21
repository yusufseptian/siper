<?php 

include "../koneksi.php";
include "header_admin.php";
include "sidebar_admin.php";

 ?>



<!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Denda</h1>
                    
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
                                            <th>Denda</th>
                                            <th>Status</th>                                         
                                            <th>Aksi</th>
                                            
                                        </tr>
                                    </thead>
                                  
                                    <tbody>
                                        <?php 
                                            $no=1;
                                            $query = "SELECT *FROM tbl_denda";
                                            $result = mysqli_query($koneksi, $query);
                                            if (!$result) {
                                                die("Query eror:".mysqli_errno($koneksi)."-".mysqli_connect($koneksi));
                                            }

                                            while ($row = mysqli_fetch_assoc($result))
                                             {
                                            
                                         ?>


                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $row['denda']; ?></td>
                                            <td align="center">
                                            <form action="aksi_statusdenda.php" method="POST">
                                           <input type="hidden" name="id_denda" value="<?php echo $row['id_denda']; ?>">
                                           <input type="hidden" name="status" value="<?php echo $row['status']; ?>">

                                           <?php 
                                           if ($row['status']=='aktif') {
                                             ?>
                                             <button type="submit" class="btn btn-success btn-sm"> <i class="fa fa-check"></i></button>
                                           <?php 
                                          }else{
                                            ?>
                                             <button type="submit" class="btn btn-danger btn-sm"> <i class="fa fa-times"></i></button>
                                  <?php
                                           }
                                            ?>
                                         
                                            </form>
                                            <td>
                                                <a href="hapus_denda.php?id=<?php echo $row['id_denda']; ?>" class="btn btn
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
                <form action="tambah_denda.php" method="POST" enctype="multipart/form-data">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Tambah Data Denda</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                      <div class="form-group">
                          <label>Denda</label>
                          <input type="number" name="denda" class="form-control" placeholder="denda" required></input>
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