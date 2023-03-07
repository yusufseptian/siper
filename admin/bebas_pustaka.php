<?php

include "../koneksi.php";
include "header_admin.php";
include "sidebar_admin.php";

if (isset($_SESSION['error'])) {
?>
    <script>
        alert('<?= $_SESSION['error'] ?>')
    </script>
<?php
    unset($_SESSION['error']);
}
?>



<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Bebas Pustaka</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">

            <form class="form-inline">
                <input class="form-control mr-sm-2" type="search" placeholder="Masukkan Nis" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cek</button>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

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


<script type="text/javascript">
    $('#select1').select2()

    $('#select2').select2()
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>