-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Okt 2025 pada 15.17
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username_admin` varchar(30) NOT NULL,
  `password_admin` varchar(50) NOT NULL,
  `nama_admin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username_admin`, `password_admin`, `nama_admin`) VALUES
(1, 'admin1', '6c7ca345f63f835cb353ff15bd6c5e052ec08e7a', 'Aditya Nusa Syahputra'),
(2, 'admin2', '315f166c5aca63a157f7d41007675cb44a948b33', 'Cantika');

-- --------------------------------------------------------

--
-- Struktur dari tabel `chat`
--

CREATE TABLE `chat` (
  `id_chat` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `isi_chat` text NOT NULL,
  `pengirim_chat` enum('pelanggan','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Fiksi'),
(2, 'Novel'),
(3, 'Komik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `id_pelanggan`, `id_produk`, `jumlah`) VALUES
(5, 1, 30, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `username_pelanggan` varchar(100) NOT NULL,
  `password_pelanggan` varchar(100) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `jk_pelanggan` enum('laki laki','perempuan') NOT NULL,
  `alamat_pelanggan` text NOT NULL,
  `hp_pelanggan` varchar(15) NOT NULL,
  `email_pelanggan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `username_pelanggan`, `password_pelanggan`, `nama_pelanggan`, `jk_pelanggan`, `alamat_pelanggan`, `hp_pelanggan`, `email_pelanggan`) VALUES
(1, 'user1', 'b3daa77b4c04a9551b8781d03191fe098f325e67', 'Adit', 'laki laki', 'Jember', '085236416597', 'adit@gmail.com'),
(2, 'user2', 'a1881c06eec96db9901c7bbfe41c42a3f08e9cb4', 'Cantika', 'perempuan', 'Jogja', '085236416597', 'tika@gmail.com'),
(3, 'user3', '0b7f849446d3383546d15a480966084442cd2193', 'Erika', 'perempuan', 'Jember', '085236416597', 'erika@gmail.com'),
(4, 'user4', '06e6eef6adf2e5f54ea6c43c376d6d36605f810e', 'Anton', 'laki laki', 'Semarang', '085236416597', 'anton@gmail.com'),
(5, 'user5', '7d112681b8dd80723871a87ff506286613fa9cf6', 'Sari', 'perempuan', 'Jember', '089765476234', 'sarii@gmail.com'),
(6, 'user6', '312a46dc52117efa4e3096eda510370f01c83b27', 'Jessica', 'perempuan', 'Pati', '081234675891', 'jessica@gmail.com'),
(7, 'user7', '7bdeecc97cf8f9b9188ba2751aa1755dad9ff819', 'Cika', 'perempuan', 'Jember', '081233564325', 'cika@gmail.com'),
(8, 'user8', 'a14c955bda572b817deccc3a2135cc5f2518c1d3', 'Cici', 'perempuan', 'Kudus', '081234566782', 'cici@gmail.com'),
(9, 'user9', '86f28434210631fa6bda6db990aba7391f512774', 'Chiko', 'laki laki', 'Semarang', '085432777665', 'chiko@gmail.com'),
(10, 'user10', 'd089da97b9e447158a0466d15fe291f2c43b982e', 'Moza', 'perempuan', 'Demak', '081444678541', 'moza@gmail.com'),
(11, 'user11', '3d5cbfed48ce23d2f0dc0a0baa3ec2ee93867b2b', 'Nancy', 'perempuan', 'Jember', '089661542376', 'nancy@gmail.com'),
(12, 'user12', 'e45ed40f34005e1636649ab18bbd16ada02cb251', 'Prita', 'perempuan', 'Kudus', '081435677221', 'prita@gmail.com'),
(13, 'user13', 'd6fa2beb1c302491b40f447d8784fc0bcce1ca8e', 'Draco', 'laki laki', 'Demak', '085677543981', 'draco@gmail.com'),
(14, 'user14', 'be17881e010a71c3fa3f4e9650242341c764b39a', 'Kania', 'perempuan', 'Pati', '081655772345', 'kania@gmail.com'),
(15, 'user15', '5de2a2a23e0b3beee08b75a6b0c0cd3847f0d7be', 'Arimbi', 'perempuan', 'Semarang', '089111564786', 'arimbi@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama_bayar` varchar(100) NOT NULL,
  `bank_bayar` varchar(100) NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `bukti_bayar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama_bayar`, `bank_bayar`, `tanggal_bayar`, `jumlah_bayar`, `bukti_bayar`) VALUES
(38, 75, 'Aditya Nusa Syahputra', 'transfer', '2025-07-30', 115000, 'download.jpg20250730083910'),
(39, 76, 'Rizki Ananda', 'transfer', '2025-07-30', 87000, 'download.jpg20250730084940');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tanggal_pembelian` datetime NOT NULL,
  `batas_pembayaran` datetime NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `status_pembelian` enum('pending','lunas','kirim','selesai','batal') NOT NULL,
  `metode_pembayaran` enum('transfer','cod') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `tanggal_pembelian`, `batas_pembayaran`, `total_pembelian`, `status_pembelian`, `metode_pembayaran`) VALUES
(75, 1, '2025-07-30 15:29:23', '2025-07-31 15:29:23', 115000, 'selesai', 'transfer'),
(76, 1, '2025-07-30 15:41:42', '2025-07-31 15:41:42', 87000, 'kirim', 'transfer'),
(77, 1, '2025-07-30 15:52:45', '2025-07-31 15:52:45', 17000, 'pending', 'transfer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `nama_beli` varchar(100) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `berat_beli` int(11) NOT NULL,
  `subharga_beli` int(11) NOT NULL,
  `subberat_beli` int(11) NOT NULL,
  `rating_produk` int(11) NOT NULL,
  `ulasan_produk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah_beli`, `nama_beli`, `harga_beli`, `berat_beli`, `subharga_beli`, `subberat_beli`, `rating_produk`, `ulasan_produk`) VALUES
(105, 75, 29, 1, 'Bulan', 85000, 103, 85000, 103, 0, ''),
(106, 76, 30, 1, 'Si Juki Keroyokan', 74000, 102, 74000, 102, 0, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id_pengiriman` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama_penerima` varchar(100) NOT NULL,
  `hp_penerima` varchar(15) NOT NULL,
  `provinsi_penerima` varchar(100) NOT NULL,
  `distrik_penerima` varchar(100) NOT NULL,
  `tipe_penerima` enum('kota','kabupaten') NOT NULL,
  `kodepos_penerima` varchar(20) NOT NULL,
  `alamat_penerima` text NOT NULL,
  `ekspedisi_pengiriman` varchar(100) NOT NULL,
  `paket_pengiriman` varchar(100) NOT NULL,
  `estimasi_pengiriman` varchar(100) NOT NULL,
  `berat_pengiriman` int(11) NOT NULL,
  `ongkos_pengiriman` int(11) NOT NULL,
  `resi_pengiriman` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengiriman`
--

INSERT INTO `pengiriman` (`id_pengiriman`, `id_pembelian`, `nama_penerima`, `hp_penerima`, `provinsi_penerima`, `distrik_penerima`, `tipe_penerima`, `kodepos_penerima`, `alamat_penerima`, `ekspedisi_pengiriman`, `paket_pengiriman`, `estimasi_pengiriman`, `berat_pengiriman`, `ongkos_pengiriman`, `resi_pengiriman`) VALUES
(76, 75, 'Adit', '085236416597', 'Jember', 'Kabupaten Jember', 'kota', '23111', 'Jember', 'TIKI', 'ONS', '1', 103, 30000, '112112'),
(77, 76, 'Rizki Ananda', '085236416597', 'Lampung', 'Metro', 'kota', '34111', 'Jogja', 'TIKI', 'ECO', '4-7', 102, 13000, 'q1122'),
(78, 77, 'Cantika', '085236416597', 'Aceh', 'Langsa', 'kota', '24411', 'Jogja', 'TIKI', 'REG', '2-4', 0, 17000, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `stok_produk` int(11) NOT NULL,
  `berat_produk` int(11) NOT NULL,
  `foto_produk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `harga_produk`, `deskripsi_produk`, `stok_produk`, `berat_produk`, `foto_produk`) VALUES
(28, 1, 'Perahu Kertas', 70000, 'Perahu Kertas Karya Dee Lestari', 100, 100, '20250730081100OIP.jpg'),
(29, 2, 'Bulan', 85000, 'Buku Bulan', 299, 103, '20250730081235download.webp'),
(30, 3, 'Si Juki Keroyokan', 74000, 'Si juki', 542, 102, '20250730081340OIP.webp');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening`
--

CREATE TABLE `rekening` (
  `id_rekening` int(11) NOT NULL,
  `bank_rekening` varchar(50) NOT NULL,
  `nomor_rekening` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rekening`
--

INSERT INTO `rekening` (`id_rekening`, `bank_rekening`, `nomor_rekening`) VALUES
(1, 'MANDIRI', '1430033915610');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_chat`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indeks untuk tabel `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indeks untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id_pengiriman`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`id_rekening`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `chat`
--
ALTER TABLE `chat`
  MODIFY `id_chat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT untuk tabel `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id_rekening` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
