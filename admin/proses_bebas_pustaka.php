<?php

session_start();
include "../koneksi.php";

if (isset($_POST['nis'])) {
    // Get data siswa by nis
    $nis = $_POST['nis'];
    $dtSiswa = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tbl_siswa WHERE nis='$nis'"));
    if (empty($dtSiswa)) {
        $_SESSION['error'] = "Data siswa dengan NIS $nis tidak ditemukan";
        header("Location: bebas_pustaka.php?nis=$nis");
        die;
    }

    // Cek status siswa
    if ($dtSiswa['status'] == 'aktif') {
        // Cek peminjaman
        $dtPeminjaman = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tbl_peminjaman WHERE nis='$nis' AND keterangan='Belum Kembali'"));
        if (!empty($dtPeminjaman)) {
            $_SESSION['error'] = "Data siswa dengan NIS $nis masih memiliki transaksi yang belum selesai";
            header("Location: bebas_pustaka.php?nis=$nis");
            die;
        }
        $newStatus = 'tidak';
        $pesan = 'Di-nonaktifkan';
    } else {
        $newStatus = 'aktif';
        $pesan = 'Diaktifkan';
    }

    // Update status
    if (mysqli_query($koneksi, "UPDATE tbl_siswa SET status='$newStatus' WHERE nis='$nis'")) {
        $_SESSION['error'] = "Data status siswa dengan NIS $nis berhasil $pesan";
    } else {
        $_SESSION['error'] = "Data status siswa dengan NIS $nis gagal $pesan";
    }
    header("Location: bebas_pustaka.php?nis=$nis");
    die;
}
