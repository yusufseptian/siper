<?php 

include "../koneksi.php";
include "header_admin.php";
include "sidebar_admin.php";

?>



<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Buku Tamu</h1>
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        
        <div class="card-header py-3">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal Kunjungan</th>
                            <th>Nama</th>
                            <th>Alamat</th> 
                            <th>Kelas</th>
                            <th>Jurusan</th>
                            <th>Keperluan</th>  
                            <th>Aksi</th>                                             
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php 
                        $no=1;
                        $query = "SELECT *FROM tbl_bukutamu";
                        $result = mysqli_query($koneksi, $query);
                        if (!$result) {
                            die("Query eror:".mysqli_errno($koneksi)."-".mysqli_connect($koneksi));
                        }

                        while ($row = mysqli_fetch_assoc($result))
                        {
                            
                           ?>


                           <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['tgl_kunjungan']; ?></td>
                            <td><?php echo $row['nama']; ?></td>
                            <td><?php echo $row['alamat']; ?></td>
                            <td><?php echo $row['kelas']; ?></td>
                            <td><?php echo $row['jurusan']; ?></td>
                            <td><?php echo $row['keperluan']; ?></td>
                            <td>
                                <a href="edit_bukutamu.php?id=<?php echo $row['id_bukutamu']; ?>" class="btn btn
                                    btn-warning">Edit</a>
                                    <a href="hapus_bukutamu.php?id=<?php echo $row['id_bukutamu']; ?>" class="btn btn
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

        
        <?php 
        include "footer_admin.php";
        ?>