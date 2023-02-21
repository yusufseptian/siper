-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Feb 2023 pada 17.09
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siper`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_buku`
--

CREATE TABLE `tbl_buku` (
  `id_buku` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `judul_buku` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `tahun_terbit` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_rak` int(11) NOT NULL,
  `detail` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_buku`
--

INSERT INTO `tbl_buku` (`id_buku`, `gambar`, `judul_buku`, `penerbit`, `tahun_terbit`, `stok`, `id_kategori`, `id_rak`, `detail`) VALUES
(11, '477-cover.jpg', 'Pemrograman', 'Erlangga', 2020, 4, 27, 3, 'Buku pemrograman ini membahas tentang berbagai macam program'),
(12, '886-basis.jpg', 'Basis Data', 'Erlangga', 2020, 10, 27, 3, 'Ini buku basis data'),
(13, '211-corel.jpg', 'Belajar Corel Draw', 'Erlangga', 2020, 6, 27, 3, 'Ini buku belajar corel draw'),
(16, '518-cover.jpg', 'PBO', 'Erlangga', 2020, 2, 27, 3, 'Ini Buku PBO');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_bukutamu`
--

CREATE TABLE `tbl_bukutamu` (
  `id_bukutamu` int(11) NOT NULL,
  `tgl_kunjungan` date NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kelas` int(11) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `keperluan` enum('Membaca','Meminjam Buku','Mengembalikan Buku','Mengerjakan Tugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_bukutamu`
--

INSERT INTO `tbl_bukutamu` (`id_bukutamu`, `tgl_kunjungan`, `nama`, `alamat`, `kelas`, `jurusan`, `keperluan`) VALUES
(43, '2023-01-11', 'Wahdah', 'Pemalang', 12, 'RPL', 'Mengembalikan Buku'),
(44, '2023-01-18', 'Zee', 'w', 12, 'RPL', 'Membaca'),
(45, '2023-01-19', 'Zee', 'w', 12, 'RPL', 'Membaca'),
(46, '2023-02-03', 'Wardani', 'Pemalang', 12, 'RPL', 'Meminjam Buku');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_denda`
--

CREATE TABLE `tbl_denda` (
  `id_denda` int(11) NOT NULL,
  `denda` int(11) NOT NULL,
  `status` enum('aktif','tidak','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_denda`
--

INSERT INTO `tbl_denda` (`id_denda`, `denda`, `status`) VALUES
(3, 200, 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`) VALUES
(27, 'Buku Pelajaran'),
(28, 'Novel'),
(29, 'Pengetahuan Umum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_peminjaman`
--

CREATE TABLE `tbl_peminjaman` (
  `id_pinjam` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `jumlah_pinjam` int(11) NOT NULL,
  `keterangan` enum('Kembali','Belum Kembali','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_peminjaman`
--

INSERT INTO `tbl_peminjaman` (`id_pinjam`, `nis`, `id_buku`, `tgl_pinjam`, `jumlah_pinjam`, `keterangan`) VALUES
(12, 234, 12, '2023-01-17', 2, 'Kembali'),
(16, 234, 13, '2023-01-21', 1, 'Kembali'),
(18, 234, 16, '2023-01-06', 1, 'Kembali'),
(20, 519, 13, '2023-01-25', 1, 'Kembali'),
(22, 234, 11, '2023-01-09', 1, 'Kembali'),
(23, 519, 12, '2023-01-25', 1, 'Kembali'),
(24, 519, 12, '2023-01-25', 1, 'Belum Kembali');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengembalian`
--

CREATE TABLE `tbl_pengembalian` (
  `id_kembali` int(11) NOT NULL,
  `id_pinjam` int(11) NOT NULL,
  `tgl_kembali` date NOT NULL,
  `id_denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_pengembalian`
--

INSERT INTO `tbl_pengembalian` (`id_kembali`, `id_pinjam`, `tgl_kembali`, `id_denda`) VALUES
(8, 12, '2023-01-27', 3),
(9, 16, '2023-01-31', 3),
(12, 18, '2023-01-13', 3),
(13, 20, '2023-03-25', 3),
(14, 22, '2023-02-10', 3),
(15, 23, '2023-02-03', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rak`
--

CREATE TABLE `tbl_rak` (
  `id_rak` int(11) NOT NULL,
  `nama_rak` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_rak`
--

INSERT INTO `tbl_rak` (`id_rak`, `nama_rak`) VALUES
(3, 'Rak 1'),
(4, 'Rak 2'),
(5, 'Rak 3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_siswa`
--

CREATE TABLE `tbl_siswa` (
  `nis` int(11) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `pass` varchar(255) NOT NULL,
  `jurusan` varchar(25) NOT NULL,
  `kelas` varchar(25) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(11) NOT NULL,
  `status` enum('aktif','tidak') NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_siswa`
--

INSERT INTO `tbl_siswa` (`nis`, `nama_siswa`, `jenis_kelamin`, `pass`, `jurusan`, `kelas`, `alamat`, `no_hp`, `status`, `user_id`) VALUES
(157, 'Hana Farida', 'L', '4f4adcbf8c6f66dcfc8a3282ac2bf10a', 'RPL', '10', 'Sleman', '08266272627', 'aktif', 30),
(234, 'Wardani', 'P', '202cb962ac59075b964b07152d234b70', 'RPL', '12', 'Pemalang', '0987622618', 'aktif', 22),
(519, 'yusuf', 'L', '202cb962ac59075b964b07152d234b70', 'RPL', '12', 'Jogja', '0897654211', 'aktif', 26);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `level` enum('admin','siswa','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `pass`, `level`) VALUES
(10, 'Samidah', '81dc9bdb52d04dc20036dbd8313ed055', 'admin'),
(22, '234', '202cb962ac59075b964b07152d234b70', 'siswa'),
(26, '519', '202cb962ac59075b964b07152d234b70', 'siswa'),
(30, '157', '4f4adcbf8c6f66dcfc8a3282ac2bf10a', 'siswa');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_buku`
--
ALTER TABLE `tbl_buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_katergori` (`id_kategori`,`id_rak`),
  ADD KEY `id_rak` (`id_rak`);

--
-- Indeks untuk tabel `tbl_bukutamu`
--
ALTER TABLE `tbl_bukutamu`
  ADD PRIMARY KEY (`id_bukutamu`);

--
-- Indeks untuk tabel `tbl_denda`
--
ALTER TABLE `tbl_denda`
  ADD PRIMARY KEY (`id_denda`);

--
-- Indeks untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tbl_peminjaman`
--
ALTER TABLE `tbl_peminjaman`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `nis` (`nis`,`id_buku`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indeks untuk tabel `tbl_pengembalian`
--
ALTER TABLE `tbl_pengembalian`
  ADD PRIMARY KEY (`id_kembali`),
  ADD KEY `id_buku` (`id_pinjam`),
  ADD KEY `id_pinjam` (`id_pinjam`),
  ADD KEY `id_denda` (`id_denda`);

--
-- Indeks untuk tabel `tbl_rak`
--
ALTER TABLE `tbl_rak`
  ADD PRIMARY KEY (`id_rak`);

--
-- Indeks untuk tabel `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_buku`
--
ALTER TABLE `tbl_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `tbl_bukutamu`
--
ALTER TABLE `tbl_bukutamu`
  MODIFY `id_bukutamu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `tbl_denda`
--
ALTER TABLE `tbl_denda`
  MODIFY `id_denda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `tbl_peminjaman`
--
ALTER TABLE `tbl_peminjaman`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tbl_pengembalian`
--
ALTER TABLE `tbl_pengembalian`
  MODIFY `id_kembali` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tbl_rak`
--
ALTER TABLE `tbl_rak`
  MODIFY `id_rak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_buku`
--
ALTER TABLE `tbl_buku`
  ADD CONSTRAINT `tbl_buku_ibfk_1` FOREIGN KEY (`id_rak`) REFERENCES `tbl_rak` (`id_rak`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_buku_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `tbl_kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_peminjaman`
--
ALTER TABLE `tbl_peminjaman`
  ADD CONSTRAINT `tbl_peminjaman_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `tbl_siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_peminjaman_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `tbl_buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_pengembalian`
--
ALTER TABLE `tbl_pengembalian`
  ADD CONSTRAINT `tbl_pengembalian_ibfk_3` FOREIGN KEY (`id_pinjam`) REFERENCES `tbl_peminjaman` (`id_pinjam`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pengembalian_ibfk_4` FOREIGN KEY (`id_denda`) REFERENCES `tbl_denda` (`id_denda`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD CONSTRAINT `tbl_siswa_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
