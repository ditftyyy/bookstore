<?php 
include "header.php";
//mengambil data pembelian dan digabung ke tabel pelanggan
$ambil_p = $koneksi -> query("SELECT * FROM pembelian LEFT JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan ORDER BY id_pembelian DESC");
$pembelian = array();
while ($tiap_p = $ambil_p -> fetch_assoc()) 
{
	$pembelian[] = $tiap_p;
}
// echo "<pre>";
// print_r($pembelian);
// echo "</pre>";
?>
<div class="card-header bg-dark text-white mb-3">Data Pembelian</div>
<div class="table-responsive">
	<table class="table table-bordered table-hover" id="thetable">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Pelanggan</th>
				<th>No HP</th>
				<th>Tanggal Pembelian</th>
				<th>Batas Pembayaran</th>
				<th>Total Pembelian</th>
				<th>Metode Pembayaran</th>
				<th>Status</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($pembelian as $key => $value): ?>
				<tr>
					<td><?php echo $key+1; ?></td>
					<td><?php echo $value["nama_pelanggan"]; ?></td>
					<td><?php echo $value["hp_pelanggan"]; ?></td>
					<td><?php echo date("d M Y , H:i:s",strtotime($value["tanggal_pembelian"])); ?></td>
					<?php if ($value['metode_pembayaran']=="transfer"): ?>
						<td><?php echo date("d M Y , H:i:s",strtotime($value["batas_pembayaran"])); ?></td>
						<?php else: ?>
						<td align="center">-</td>
						<?php endif ?>
					<td>Rp <?php echo number_format($value["total_pembelian"]); ?></td>
					<td><?php echo $value["metode_pembayaran"]; ?></td>
					<td><?php echo $value["status_pembelian"]; ?></td>
					<td nowrap="nowrap">
						<a href="detail_pembelian.php?id=<?php echo $value["id_pembelian"]; ?>" class="btn-sm btn btn-info">Detail Pembelian</a>

						<?php 
						//mengambil data pembayaran berdasarkan transaksi
						$id_pembelian = $value["id_pembelian"];
						$ambil_pembayaran = $koneksi -> query("SELECT * FROM pembayaran WHERE id_pembelian = '$id_pembelian'");
						$pembayaran = $ambil_pembayaran -> fetch_assoc();
						?>

						<!-- Jika sudah dibayar maka tampilkan tombol ini -->
						<?php if (isset($pembayaran)): ?>
							<a href="pembayaran.php?id=<?php echo $value["id_pembelian"]; ?>" class="btn-sm btn btn-success">Pembayaran</a>

						<!-- Jika belum maka tampilkan tombol ini -->
						<?php else: ?>
							<?php if ($value['metode_pembayaran']=="transfer"): ?>
						<button class="btn-sm btn btn-danger disabled">Belum dibayar</button>
						<?php else: ?>
						<button class="btn-sm btn btn-danger disabled">Belum klik simpan</button>					<?php endif ?>
						<?php endif ?>

						<?php if (isset($pembayaran)): ?>
							<a href="pengiriman.php?id=<?php echo $value["id_pembelian"]; ?>" class="btn-sm btn btn-primary">Pengiriman</a>
						<?php endif ?>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>
<?php 
include "footer.php";
?>