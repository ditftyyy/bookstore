Perancangan Sistem Informasi

Hak akses : 
1.Admin
2.Pelanggan
3.Pengunjung

Fitur fitur admin : 
1.Melakukan login dan logout
2.Mengelola data produk , melihat data pembelian , melihat laporan pembelian , mengelola data pribadi , melihat data pelanggan , melihat data pengiriman


Fitur fitur pelanggan : 
1.Melakukan login dan logout
2.Merubah informasi pribari
3.Melihat data produk
4.Memasukkan data produk ke keranjang
5.Melakukan proses transaksi
6.Melakukan Pembayaran

Fitur fitur pengunjung : 
1. Melihat data produk 
2. Registrasi akun pelanggan

Tabel : 

Pelanggan : 
1.id_pelanggan
2.username_pelanggan
3.password_pelanggan
4.jenis_kelamin_pelanggan
5.nik_pelanggan
6.hp_pelanggan
7.email_pelanggan
8.foto_pelanggan

Kategori
-id_kategori INT(11)
-nama_kategori VAR(100)

Produk
-id_produk
-id_kategori
-nama_produk
-harga_produk
-deskripsi_produk
-berat_produk
-stok_produk
-foto_produk

keranjang
-id_keranjang
-id_pelanggan
-id_produk
-jumlah

pembelian
-id_pembelian
-id_pelanggan
-tanggal_pembelian
-batas_pembayaran
-total_pembelian
-status

detail_pembelian
-id_detail_pembelian
-id_pembelian
-id_produk
-jumlah_beli
-nama_beli
-harga_beli
-berat_beli
-subharga_beli
-subberat_beli

pembayaran
-id_pembayaran
-id_pembelian
-nama_bayar
-bank_bayar
-tangga_bayar
-jumlah_bayar
-bukti_bayar