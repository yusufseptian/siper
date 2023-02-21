<?php
include "../koneksi.php";
include "header_siswa.php";
include "sidebar_siswa.php";
?>


<div class="container-fluid">

    <form class="d- none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="GET" action="data_buku.php">
        <div class="input-group">
            <input type="text" name="cari" value="<?php if (isset($_GET['cari'])) {
                echo $_GET['cari'];
            } ?>" class="form-control border-0 small" placeholder="Search for..." arial-label="Search" aria-describedby="basic-addon2">
            <button class="btn btn-primary" type="submit">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </input>
    </div>

</form>

<div class="row text-center mt-3">
    <?php
    if (isset($_GET['cari'])) {
        $pencarian = $_GET['cari'];
        $query = "SELECT *FROM tbl_buku INNER JOIN tbl_kategori ON tbl_buku.id_kategori = tbl_kategori.id_kategori INNER JOIN tbl_rak ON tbl_buku.id_rak=tbl_rak.id_rak where judul_buku like '%" . $pencarian . "%'";
    } else {
        $query = "SELECT *FROM tbl_buku INNER JOIN tbl_kategori ON tbl_buku.id_kategori = tbl_kategori.id_kategori INNER JOIN tbl_rak ON tbl_buku.id_rak=tbl_rak.id_rak";
    }
    $result = mysqli_query($koneksi, $query);
    if (!$result) {
        die("Query eror:" . mysqli_errno($koneksi) . "-" . mysqli_connect($koneksi));
    }
    while ($row = mysqli_fetch_assoc($result)) {

        ?>
        <div class="card ml-3 mb-3" style="width: 16rem;">
            <img class="card-img-top" src="../admin/gambar_admin/<?php echo $row['gambar']; ?>" alt="Card image cap" width="100" height="250">
            <div class="card-body">
                <h5 class="card-title mb-1">
                    <b><?php echo $row['judul_buku']; ?></b>
                </h5>
                <small>
                    <?php echo $row['detail']; ?>
                </small>
                <br>
                <br>
                <span class="badge badge-pill badge-success mb-3">Stok <?php echo $row['stok']; ?></span>
                <span class="badge badge-pill badge-primary mb-3">Nama <?php echo $row['nama_rak']; ?></span>
            </div>
        </div>
        <?php
    }
    ?>
</div>
</div>
<?php
include "footer_siswa.php";
?>