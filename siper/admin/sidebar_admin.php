<?php

include "../koneksi.php";
session_start();
// Notifikasi
if (isset($_SESSION['notify'])) :
?>
    <script>
        alert('<?= $_SESSION['notify'] ?>');
    </script>
<?php
    unset($_SESSION['notify']);
endif
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index_admin.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-book"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SIPER</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index_admin.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Master Data</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="data_kategori.php">Data Kategori</a>
                        <a class="collapse-item" href="data_rak.php">Rak</a>
                        <a class="collapse-item" href="data_buku.php">Data Buku</a>
                        <a class="collapse-item" href="data_siswa.php">Data Siswa</a>
                        <a class="collapse-item" href="data_user.php">Data User</a>
                        <a class="collapse-item" href="data_denda.php">Denda</a>
                        <a class="collapse-item" href="data_bukutamu.php">Buku Tamu</a>


                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Transaksi</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="peminjaman.php">Peminjaman Buku</a>
                        <a class="collapse-item" href="pengembalian.php">Pengembalian Buku</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapselaporan" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-download"></i>
                    <span>Laporan</span>
                </a>
                <div id="collapselaporan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" target="_blank" href="cetak_kategori.php">Data Kategori</a>
                        <a class="collapse-item" target="_blank" href="cetak_rak.php">Rak</a>
                        <a class="collapse-item" target="_blank" href="cetak_buku.php">Data Buku</a>
                        <a class="collapse-item" target="_blank" href="cetak_siswa.php">Data Siswa</a>
                        <a class="collapse-item" target="_blank" href="cetak_user.php">Data User</a>
                        <a class="collapse-item" target="_blank" href="cetak_denda.php">Denda</a>
                        <a class="collapse-item" href="index_cetakpinjam.php">Peminjaman Buku</a>
                        <a class="collapse-item" href="index_cetakkembali.php">Pengembalian Buku</a>
                        <a class="collapse-item" target="_blank" href="index_cetakbukutamu.php">Buku Tamu</a>

                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
        </ul>
        <!-- End of Sidebar -->


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>

                        </li>
                        <!-- Get Data Siswa yang telat pengembalian -->
                        <?php
                        $query = "select * from tbl_peminjaman inner join tbl_siswa on tbl_peminjaman.nis = tbl_siswa.nis where keterangan = 'Belum Kembali'";
                        $dtPeminjaman = mysqli_query($koneksi, $query);
                        ?>
                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts (Notifikasi)-->
                                <?php
                                $count = 0;
                                while ($data = mysqli_fetch_assoc($dtPeminjaman)) {
                                    $dateDiff = date_diff(date_create($data['tgl_pinjam']), date_create())->format('%r%a');
                                    if ($dateDiff > 7) {
                                        $count++;
                                    }
                                }
                                ?>
                                <?php if ($count > 0) : ?>
                                    <?php if ($count < 5) : ?>
                                        <span class="badge badge-danger badge-counter">
                                            <?= $count ?>
                                        </span>
                                    <?php else : ?>
                                        <span class="badge badge-danger badge-counter">
                                            +<?= $count ?>
                                        </span>
                                    <?php endif ?>
                                <?php endif ?>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <?php $i = 0; ?>
                                <?php $dtPeminjaman = mysqli_query($koneksi, $query) ?>
                                <?php while ($data = mysqli_fetch_assoc($dtPeminjaman)) : ?>
                                    <?php $dateDiff = date_diff(date_create($data['tgl_pinjam']), date_create())->format('%r%a') ?>
                                    <?php if ($dateDiff > 7) : ?>
                                        <a class="dropdown-item d-flex align-items-center" href="peminjaman.php">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-warning">
                                                    <i class="fas fa-file-alt text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-500">
                                                    <!-- date("d-m-Y", strtotime("+8 days", strtotime($data['tgl_pinjam'])))  -->
                                                    <?= date("d-m-Y") ?>
                                                </div>
                                                <span class="font-weight-bold">
                                                    <?= ucfirst($data['nama_siswa']) ?> telah telat mengembalikan buku selama
                                                    <?= date_diff(date_create($data['tgl_pinjam']), date_create())->format('%r%a hari.') ?>
                                                </span>
                                            </div>
                                        </a>
                                        <?php
                                        if ($i == 4) {
                                            break;
                                        }
                                        ?>
                                    <?php endif ?>
                                <?php endwhile ?>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Halo, Saya <?php echo $_SESSION['username']; ?></span>
                                <img src="../assets/img/logout.png" width="30">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <!--  <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a> --><!-- 
                              
                                <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="../logout.php"><!-- data-toggle="modal" data-target="#logoutModal" -->
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->