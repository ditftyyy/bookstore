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
<?php if (empty($pengiriman["resi_pengiriman"])): ?>
	<!-- Button trigger modal -->
	<a type="button" class="btn btn-warning btn-sm text-white" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
		Masukkan Resi
	</a>

	<!-- Modal -->
	<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="staticBackdropLabel">Input Resi</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="post">
						<div class="mb-3">
							<label class="form-label">Resi</label>
							<input type="text" class="form-control" name="resi">
						</div>
						<div class="mb-3">
							<button class="btn btn-primary" name="simpan">Simpan</button>
						</div>
					</form>
<?php 
if (isset($_POST["simpan"])) 
{
	$resi = $_POST["resi"];
	$koneksi -> query("UPDATE pengiriman SET resi_pengiriman = '$resi' WHERE id_pembelian = '$id_pembelian'");
	//ubah status pembelian
	$koneksi -> query("UPDATE pembelian SET status_pembelian = 'kirim' WHERE id_pembelian = '$id_pembelian'");
	echo "<script>location = 'pengiriman.php?id=$id_pembelian'</script>";
}
?>
				</div>
			</div>
		</div>
	</div>
<?php else: ?>
	<!-- Button trigger modal -->
	<a type="button" class="btn btn-warning btn-sm text-white" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
		Ubah Resi
	</a>

	<!-- Modal -->
	<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="staticBackdropLabel">Input Resi</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="post">
						<div class="mb-3">
							<label class="form-label">Resi</label>
							<input type="text" class="form-control" name="resi" value="<?php echo $pengiriman["resi_pengiriman"]; ?>" >
						</div>
						<div class="mb-3">
							<button class="btn btn-primary" name="simpan">Simpan</button>
						</div>
					</form>
<?php 
if (isset($_POST["simpan"])) 
{
	$resi = $_POST["resi"];
	$koneksi -> query("UPDATE pengiriman SET resi_pengiriman = '$resi' WHERE id_pembelian = '$id_pembelian'");
	//ubah status pembelian
	$koneksi -> query("UPDATE pembelian SET status_pembelian = 'kirim' WHERE id_pembelian = '$id_pembelian'");
	echo "<script>location = 'pengiriman.php?id=$id_pembelian'</script>";
}
?>
				</div>
			</div>
		</div>
	</div>
<?php endif ?>
				</td>
			</tr>
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
					<td><?php echo $pengiriman["resi_pengiriman"]; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
<?php endif ?>
<?php 
include "footer.php";
?>