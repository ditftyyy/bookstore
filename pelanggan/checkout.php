<?php 
include "header.php";
$metode = $_GET["metode"];
//mengambil data keranjang berdarsakan id user
$ambil_keranjang = $koneksi ->query("SELECT * FROM keranjang LEFT JOIN produk ON produk.id_produk = keranjang.id_produk WHERE id_pelanggan = '$id_pelanggan'");
$keranjang = array();
$id_prd = array();
while ($tiap_keranjang = $ambil_keranjang->fetch_assoc()) 
{
	$keranjang[] = $tiap_keranjang;
	$id_produk = $tiap_keranjang["id_produk"];
	$id_prdk = $id_produk;
	$id_prd [$id_produk] = $id_prdk;
}

$ambil_produk = $koneksi -> query("SELECT * FROM produk");
$produk = array();
while ($tiap_produk = $ambil_produk -> fetch_assoc()) 
{
	$produk [] = $tiap_produk;
}
 
// echo "<pre>";
// print_r($keranjang);
// echo "</pre>";

function rp($harga)
{
	return 'Rp '.str_replace(',', '.', number_format($harga));
}
?>

<div class="min-vh-100">
	<div class="container">
		<div class="card mt-4">
			<div class="card-body"> 		
				
				<h5>Keranjang Belanja</h5>
				<hr>
				<div class="table-responsive">
					<table class="table table-hover text-nowrap">
						<thead>
							<tr>
								<th>No</th>
								<th>Produk</th>
								<th>Harga</th>
								<th width="15%">Jumlah</th>
								<th>Subharga</th>
							</tr>
						</thead>
						<tbody>
							<?php $total_harga = 0 ?>
							<?php $total_berat = 0 ?>
							<?php foreach ($keranjang as $key => $value): ?>
								<tr>
									<td><?php echo $key+1 ?></td>
									<td><?php echo $value['nama_produk'] ?></td>
									<td><?php echo rp($value['harga_produk']) ?></td>
									<td><?php echo $value['jumlah'] ?></td>
									<td><?php echo rp($value['jumlah']*$value['harga_produk']) ?></td>
								</tr>       
								<?php $total_harga += ($value['jumlah']*$value['harga_produk']) ?>
								<?php $total_berat += ($value['jumlah']*$value['berat_produk']) ?>
							<?php endforeach ?>
						</tbody>
						<tfoot>
							<tr>
								<th colspan="4">Total</th>
								<th colspan="2"><?php echo rp($total_harga) ?></th>
							</tr>
							<tr>
								<th colspan="4">Total Ongkir</th>
								<th id="total_ongkir"></th>
							</tr>
							<tr>
								<th colspan="4">Total Belanja</th>
								<th id="total_bayar"></th>
							</tr>
						</tfoot>
					</table>
				</div>

				<form method="post">
					<div class="row">
						<div class="col-sm-3">
							<div class="mb-3">
								<label class="form-label">Provinsi</label>
								<select class="form-select" name="provinsi">
									<option value="">Pilih Provinsi</option>
								</select>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="mb-3">
								<label class="form-label">Kota</label>
								<select class="form-select" name="kota"></select>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="mb-3">
								<label class="form-label">Ekspedisi</label>
								<select class="form-select" name="ekspedisi"></select>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="mb-3">
								<label class="form-label">Ongkir</label>
								<select class="form-select" name="ongkir"></select>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="mb-3">
								<label class="form-label">Nama Penerima</label>
								<input type="text" name="nama_penerima" class="form-control" value="<?php echo $_SESSION["pelanggan"] ["nama_pelanggan"]; ?>">
							</div>
						</div>

						<div class="col-sm-6">
							<div class="mb-3">
								<label class="form-label">Telepon Penerima</label>
								<input type="text" name="telepon_penerima" class="form-control" value="<?php echo $_SESSION["pelanggan"] ["hp_pelanggan"]; ?>">
							</div>
						</div>
					</div>
					<div class="mb-3">
						<label class="form-label">Alamat Penerima</label>
						<textarea class="form-control" name="alamat_penerima"><?php echo $_SESSION["pelanggan"] ["alamat_pelanggan"]; ?></textarea>
					</div>

					<input type="hidden" name="total_belanja" value="<?php echo $total_harga ?>">
					<input type="hidden" name="total_berat" value="<?php echo $total_berat ?>">
					<input type="hidden" name="nama_provinsi" placeholder="nama_provinsi">
					<input type="hidden" name="nama_kota" placeholder="nama_kota">
					<input type="hidden" name="tipe" placeholder="tipe">
					<input type="hidden" name="kodepos" placeholder="kodepos">
					<input type="hidden" name="nama_ekspedisi" placeholder="nama_ekspedisi">
					<input type="hidden" name="nama_paket" placeholder="nama_paket">
					<input type="hidden" name="biaya_paket" placeholder="biaya_paket">
					<input type="hidden" name="lama_paket" placeholder="lama_paket">
					<input type="hidden" name="total_bayar" placeholder="total_bayar">
					<button class="btn btn-primary" name="checkout">Beli Sekarang</button>
				</form>

				<?php
				if (isset($_POST['checkout'])) {
					date_default_timezone_set('Asia/Jakarta');
        // Disini akan menyimpan ke 3 tabel
        // Simpan ke tabel pembelian
					$id_p = $id_pelanggan;
					$tanggal_pembelian = date('Y-m-d H:i:s');
					$deadline_pembelian = date('Y-m-d H:i:s', strtotime('+1 days'));
					$total_pembelian = $_POST['total_bayar'];
					$status_pembelian = 'pending';
					$koneksi->query("INSERT INTO pembelian (id_pelanggan, tanggal_pembelian, batas_pembayaran, total_pembelian, status_pembelian,metode_pembayaran) VALUES ('$id_p', '$tanggal_pembelian', '$deadline_pembelian', '$total_pembelian', '$status_pembelian','$metode')");
					$id_pembelian = mysqli_insert_id($koneksi);

        	// Simpan ke tabel pembelian_produk
					foreach ($keranjang as $key => $value) {
						$id_pembelian = $id_pembelian;
						$id_produk = $value['id_produk'];
						$jumlah_beli = $value['jumlah'];
						$nama_beli = $value['nama_produk'];
						$harga_beli = $value['harga_produk'];
						$berat_beli = $value['berat_produk'];
						$subharga_beli = $value['harga_produk'] * $value['jumlah'];
						$subberat_beli = $value['berat_produk'] * $value['jumlah'];
						$koneksi->query("INSERT INTO pembelian_produk (id_pembelian, id_produk, jumlah_beli, nama_beli, harga_beli, berat_beli, subharga_beli, subberat_beli, rating_produk, ulasan_produk) VALUES ('$id_pembelian', '$id_produk', '$jumlah_beli', '$nama_beli', '$harga_beli', '$berat_beli', '$subharga_beli', '$subberat_beli', '0', '')");
						
					}

					//mengurangi stok produk
					foreach ($keranjang as $kp => $vp) 
					{
						$id_produk = $vp['id_produk'];
						$jumlah_beli = $vp['jumlah'];
						//mengurangi stok produk
						$koneksi -> query("UPDATE produk SET 
								stok_produk = (stok_produk - '$jumlah_beli') WHERE id_produk = '$id_produk'");
					}

        	// Simpan pengiriman
					$id_pembelian = $id_pembelian;
					$nama_penerima = $_POST['nama_penerima'];
					$telepon_penerima = $_POST['telepon_penerima'];
					$provinsi_penerima = $_POST['nama_provinsi'];
					$distrik_penerima = $_POST['nama_kota'];
					$tipe_penerima = $_POST['tipe'];
					$kodepos_penerima = $_POST['kodepos'];
					$alamat_penerima = $_POST['alamat_penerima'];
					$ekspedisi_pengiriman = $_POST['nama_ekspedisi'];
					$paket_pengiriman = $_POST['nama_paket'];
					$estimasi_pengiriman = $_POST['lama_paket'];
					$berat_pengiriman = $_POST['total_berat'];
					$ongkos_pengiriman = $_POST['biaya_paket'];
					$resi_pengiriman = '';
					$koneksi->query("INSERT INTO pengiriman (id_pembelian, nama_penerima, hp_penerima, provinsi_penerima, distrik_penerima, tipe_penerima, kodepos_penerima, alamat_penerima, ekspedisi_pengiriman, paket_pengiriman, estimasi_pengiriman, berat_pengiriman, ongkos_pengiriman, resi_pengiriman) VALUES ('$id_pembelian', '$nama_penerima', '$telepon_penerima', '$provinsi_penerima', '$distrik_penerima', '$tipe_penerima', '$kodepos_penerima', '$alamat_penerima', '$ekspedisi_pengiriman', '$paket_pengiriman', '$estimasi_pengiriman', '$berat_pengiriman', '$ongkos_pengiriman', '$resi_pengiriman')");

        	// Menghapus keranjang
					$koneksi->query("DELETE FROM keranjang WHERE id_pelanggan='$id_pelanggan'");
					echo "<script>location = 'pembayaran.php?id=$id_pembelian&metode=$metode'</script>";
				}
				?>
			</div>
		</div>
	</div>
</div>


<?php 
include "footer.php";
?>