<?php  
include "header.php";

$id_pembelian = $_GET["id"];
$ambil_pembelian = $koneksi->query("SELECT * FROM pembelian LEFT JOIN pelanggan ON pelanggan.id_pelanggan = pembelian.id_pelanggan WHERE id_pembelian= '$id_pembelian'");
$pembelian = $ambil_pembelian->fetch_assoc();

$ambil_pengiriman = $koneksi -> query("SELECT * FROM pengiriman WHERE id_pembelian= '$id_pembelian'");
$pengiriman = $ambil_pengiriman->fetch_assoc();

// echo "<pre>";
// print_r($pengiriman);
// echo "</pre>";
?>

<div class="container mt-3">
	<h3>Pengiriman</h3>
	<hr>
	<div class="row">
		<div class="col-md-4">
			<table class="table">
				<tr>
					<th>Nama</th>
					<td>: <?php echo $pembelian["nama_pelanggan"]; ?></td>
				</tr>
				<tr>
					<th>Email</th>
					<td>: <?php echo $pembelian["email_pelanggan"]; ?></td>
				</tr>
				<tr>
					<th>No HP</th>
					<td>: <?php echo $pembelian["hp_pelanggan"]; ?></td>
				</tr>
				<tr>
					<th>Tanggal Transaksi</th>
					<td>: <?php echo date("d M Y, h:i:s",strtotime($pembelian["tanggal_pembelian"])); ?></td>
				</tr>
				<tr>
					<th>Total</th>
					<td>: Rp <?php echo number_format($pembelian["total_pembelian"]); ?></td>
				</tr>
				<tr>
					<th>Status</th>
					<td>:
<?php
$status = $pembelian["status_pembelian"];
$resi = isset($pengiriman["resi_pengiriman"]) ? $pengiriman["resi_pengiriman"] : "";
if ($status == "batal") {
    echo "Transaksi Batal";
} elseif ($status == "selesai") {
    echo "Pesanan Selesai";
} elseif ($status == "kirim" && !empty($resi)) {
    echo "Dalam Pengiriman";
} elseif ($status == "lunas" && empty($resi)) {
    echo "Menunggu Resi";
} else {
    echo "Dalam Proses";
}
?>
					</td>
				</tr>
				<?php if ($status == "kirim" && !empty($resi)): ?>
				<tr>
					<th></th>
					<td>
						<form method="post">
						<div class="mb-3">
							<select class="form-control" name="status">
								<option value="selesai">Selesaikan Pesanan</option>
							</select>
						</div>
						<div class="mb-3">
							<button onclick="return confirm('Pesanan sudah sesuai ?')" class="btn-sm btn btn-success" name="selesai">Selesaikan Pesanan</button>
						</div>
						</form>
						<?php 
						if (isset($_POST["selesai"])) {
							$selesai = $_POST["status"];
							$koneksi -> query("UPDATE pembelian SET status_pembelian = '$selesai' WHERE id_pembelian = '$id_pembelian'");
							echo "<script>alert('Pesanan Selesai')</script>";
							echo "<script>location='riwayat.php'</script>";
						}
						?>
					</td>
				</tr>
				<?php endif; ?>
			</table>
		</div>
	</div>

<?php if (isset($pengiriman)): ?>
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>Provinsi</th>
					<th>Distrik</th>
					<th>Tipe</th>
					<th>Kode Pos</th>
					<th>Alamat</th>
					<th>Ekspedisi</th>
					<th>Paket Pengiriman</th>
					<th>Estimasi</th>
					<th>Berat</th>
					<th>Ongkos</th>
					<th>Resi</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo $pengiriman["provinsi_penerima"]; ?></td>
					<td><?php echo $pengiriman["distrik_penerima"]; ?></td>
					<td><?php echo $pengiriman["tipe_penerima"]; ?></td>
					<td><?php echo $pengiriman["kodepos_penerima"]; ?></td>
					<td><?php echo $pengiriman["alamat_penerima"] ?></td>
					<td><?php echo $pengiriman["ekspedisi_pengiriman"]; ?></td>
					<td><?php echo $pengiriman["paket_pengiriman"]; ?></td>
					<td><?php echo $pengiriman["estimasi_pengiriman"]; ?></td>
					<td><?php echo $pengiriman["berat_pengiriman"]; ?></td>
					<td><?php echo $pengiriman["ongkos_pengiriman"]; ?></td>
					<td>
<?php 
if (empty($pengiriman["resi_pengiriman"])) 
{
	echo "<p>Resi anda akan segera di inputkan oleh admin</p>";
}
else
{
	echo $pengiriman["resi_pengiriman"];
}
?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
<?php endif ?>
</div>
<?php 
include "footer.php";
?>