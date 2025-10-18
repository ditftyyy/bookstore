<?php 
include "header.php";
if (isset($_GET["metode"])) 
{
	$metode = $_GET["metode"];
}
//mendapatakan data pembayaran dari pembelian ini
$id_pembelian = $_GET["id"];
$ambil_pembayaran = $koneksi -> query("SELECT * FROM pembayaran WHERE id_pembelian = '$id_pembelian'");
$pembayaran = $ambil_pembayaran -> fetch_assoc();

$ambil_pembelian = $koneksi -> query("SELECT * FROM pembelian WHERE id_pembelian = '$id_pembelian'");
$pembelian = $ambil_pembelian->fetch_assoc();

$ambil_rek = $koneksi -> query("SELECT * FROM rekening");
$rekening = array();
while ($tiap_rekening = $ambil_rek -> fetch_assoc()) 
{
	$rekening[] = $tiap_rekening;
}

$ambil_pb = $koneksi -> query("SELECT * FROM pembelian_produk WHERE id_pembelian = '$id_pembelian'");
$pembelian_produk = array();
while ($tiap_pb = $ambil_pb->fetch_assoc()) 
{
	$pembelian_produk[] = $tiap_pb;
}
// echo "<pre>";
// print_r($pembelian_produk);
// echo "</pre>";

?>
<div class="min-vh-100">
	<!-- jika kosong pembayaran  -->
	<?php if (empty($pembayaran)): ?>
		<div class="container">
			<table class="table mt-5">
				<tr>
					<th>Tanggal Pembelian</th>
					<td><?php echo $pembelian["tanggal_pembelian"]; ?></td>
				</tr>
				<tr>
					<th>Batas Pembayaran</th>
					<td><?php echo $pembelian["batas_pembayaran"]; ?></td>
				</tr>
				<tr>
					<th>Total Pembelian</th>
					<td><?php echo number_format($pembelian["total_pembelian"]); ?></td>
				</tr>
				<?php if ($pembelian['metode_pembayaran']=="transfer"): ?>
					<tr>
						<th>Rekening Pembayaran</th>
						<?php foreach ($rekening as $kr => $vr): ?>
							<td><?php echo $vr["nomor_rekening"] ?> (<?php echo $vr["bank_rekening"] ?>)</td>
						<?php endforeach ?>
					</tr>
				<?php else: ?>
					<tr>
						<th>Rekening Pembayaran</th>
						<td>Pembayaran COD</td>
					</tr>
				<?php endif ?>
				<tr>
					<th>Status</th>
					<td><?php echo $pembelian["status_pembelian"]; ?></td>
				</tr>
				<tr>
					<th></th>
					<td>
						<form method="post">
							<div class="mb-3">
								<select class="form-control" name="status">
									<option value="batal">Batalkan Pesanan</option>
								</select>
							</div>
							<div class="mb-3">
								<button onclick="return confirm('Apakah anda yakin ingin membatalkan pesanan ?')" class="btn-sm btn btn-danger" name="batalkan">Batalkan Pesanan</button>
							</div>
						</form>
						<?php 
						if (isset($_POST["batalkan"])) {
							$batal = $_POST["status"];
							$koneksi -> query("UPDATE pembelian SET 
								status_pembelian = '$batal' WHERE id_pembelian = '$id_pembelian'");
							foreach ($pembelian_produk as $kb => $vb) {
								$id_prd = $vb["id_produk"];
								$retur = $vb["jumlah_beli"];
								$ipb = $vb['id_pembelian_produk'];
								$koneksi -> query("UPDATE produk SET stok_produk = (stok_produk + '$retur') WHERE id_produk = '$id_prd'");
								$koneksi -> query("UPDATE pembelian_produk SET 
									jumlah_beli = '',
									harga_beli = '',
									subharga_beli = '' WHERE id_pembelian_produk = '$ipb'");
							}
							echo "<script>alert('Pesanan dibatalkan')</script>";
							echo "<script>location='riwayat.php'</script>";
						}
						?>
					</td>
				</tr>
			</table>
			<?php if ( date("Y-m-d h:i:s") > $pembelian["batas_pembayaran"]): ?>
				<p>Transaksi Batal</p>
				<?php 
				$koneksi -> query("UPDATE pembelian SET status_pembelian = 'batal' WHERE id_pembelian = '$id_pembelian'");
				?>
			<?php else: ?>
				<p class="mt-5">Silahkan isi formulir pembayaran dan upload bukti pembayaran</p>
				<form method="post" enctype="multipart/form-data">
					<div class="mb-3">
						<label class="form-label">Nama</label>
						<input type="text" class="form-control" name="nama_bayar" value="<?php echo $pelanggan["nama_pelanggan"]; ?>" required>
					</div>
					<div class="mb-3">
						<label class="form-label">Bank</label>
						<input required type="text" class="form-control" name="bank_bayar" value="<?php echo $pembelian["metode_pembayaran"] ?>">
					</div>
					<div class="mb-3">
						<label class="form-label">Tanggal</label>
						<input type="date" class="form-control" name="tanggal_bayar" value="<?php echo date('Y-m-d'); ?>" required>
					</div>
					<div class="mb-3">
						<label class="form-label">Jumlah Pembayaran</label>
						<input type="number" class="form-control" name="jumlah_bayar" value="<?php echo $pembelian["total_pembelian"]; ?>" required>
					</div>
					<div class="mb-3">
						<label class="form-label">Bukti Pembayaran</label>
						<input type="file" class="form-control" name="bukti_bayar" <?php if (isset($metode)): ?>
						<?php if ($metode=="transfer"): ?>
							required
						<?php endif ?>
						<?php endif ?>>
						<i class="text-muted">*Kosongkan jika menggunakan metode pembayaran COD</i>
					</div>
					<div class="mb-3">
						<button class="btn btn-primary" name="simpan">Simpan</button>
					</div>
				</form>
			<?php endif ?>
		</div>
	<?php endif ?>

	<?php if (!empty($pembayaran)): ?>
		<div class="container">
			<h4 class="mt-5">Pembayaran</h4>
			<hr>
			<table class="table table-bordered table-hover" id="testing">
				<tr>
					<th>Nama</th>
					<td><?php echo $pembayaran["nama_bayar"]; ?></td>
				</tr>
				<tr>
					<th>Bank</th>
					<td><?php echo $pembayaran["bank_bayar"]; ?></td>
				</tr>
				<tr>
					<th>Tanggal</th>
					<td><?php echo $pembayaran["tanggal_bayar"]; ?></td>
				</tr>
				<tr>
					<th>Jumlah Bayar</th>
					<td><?php echo $pembayaran["jumlah_bayar"]; ?></td>
				</tr>
				<tr>
					<th>Bukti</th>
					<td><img src="../assets/file/<?php echo $pembayaran["bukti_bayar"] ?>" width="100"></td>
				</tr>
			</table>
		</div>
	<?php endif ?>
</div>
<?php 
if (isset($_POST["simpan"])) 
{
	$nama = $_POST["nama_bayar"];
	$bank = $_POST["bank_bayar"];
	$tanggal = $_POST["tanggal_bayar"];
	$jumlah_bayar = $_POST["jumlah_bayar"];
	$bukti = $_FILES["bukti_bayar"] ["name"];
	$file = $_FILES["bukti_bayar"] ["tmp_name"];
	$waktu = date("YmdHis");
	$bb = $bukti.$waktu;

	move_uploaded_file($file, "../assets/file/$bb");

	$koneksi -> query("INSERT INTO pembayaran(id_pembelian,nama_bayar,bank_bayar,tanggal_bayar,jumlah_bayar,bukti_bayar) VALUES('$id_pembelian','$nama','$bank','$tanggal','$jumlah_bayar','$bb')");

	$koneksi -> query("UPDATE pembelian SET status_pembelian = 'lunas' WHERE id_pembelian = '$id_pembelian'");

	echo "<script>alert('Pembayaran anda berhasil,pesanan akan segera di proses')</script>";
	echo "<script>location='pembayaran.php?id=$id_pembelian&metode=$metode'</script>";
}

?>
<?php 
include "footer.php";
?>