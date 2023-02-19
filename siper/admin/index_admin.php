<?php  
include "header_admin.php";
include "../koneksi.php";


$data_barang = mysqli_query($koneksi, "SELECT * FROM tbl_peminjaman");

$jumlah_barang = mysqli_num_rows($data_barang);




$data_barang2 = mysqli_query($koneksi, "SELECT * FROM tbl_buku");

$jumlah_barang2 = mysqli_num_rows($data_barang2);



$data_barang3 = mysqli_query($koneksi, "SELECT * FROM tbl_bukutamu");

$jumlah_barang3 = mysqli_num_rows($data_barang3);



$data_barang4 = mysqli_query($koneksi, "SELECT * FROM tbl_pengembalian");

$jumlah_barang4 = mysqli_num_rows($data_barang4);

?>


<?php  
include "sidebar_admin.php";

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Pengembalian</div><!-- 
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div> -->
                                <a href="hitung_pinjam.php"><?php echo $jumlah_barang4 ?></a>

                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Peminjaman</div><!-- 
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div> -->


                                    <a href="hitung_pinjam.php"><?php echo $jumlah_barang ?></a>


                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Daftar Buku
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto"><!-- 
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                        -->

                                        <a href="hitung_pinjam.php"><?php echo $jumlah_barang2 ?>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <!-- <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar"
                                            style="width: 30%" aria-valuenow="50" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Buku Tamu</div><!-- 
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">18</div> -->
                                    <a href="hitung_pinjam.php"><?php echo $jumlah_barang3 ?></a>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="../assets/img/ypkk1.jpeg" class="d-block w-100" alt="..." width="20">
              </div>
              <div class="carousel-item">
                  <img src="../assets/img/ypkk2.jpeg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                  <img src="../assets/img/ypkk3.jpeg" class="d-block w-100" alt="...">
              </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


</div>
<!-- /.container-fluid -->










<?php  
include "footer_admin.php";

?>
</html>