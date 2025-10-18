<?php 
include "header.php";
$id_pembelian = $_GET["id"];

//mengambil data pembelian berdassarkan id pembelian
$ambil_pembelian = $koneksi -> query("SELECT * FROM pembelian LEFT JOIN pelanggan ON pelanggan.id_pelanggan = pembelian.id_pelanggan WHERE id_pembelian = '$id_pembelian'");
$pembelian = $ambil_pembelian -> fetch_assoc();

//mengambil pembelian_produk berdasarkan id pembelian
$ambil_detail = $koneksi -> query("SELECT * FROM pembelian_produk LEFT JOIN produk ON produk.id_produk = pembelian_produk.id_produk WHERE id_pembelian = '$id_pembelian'");
$detail = array();
while ($tiap_detail = $ambil_detail -> fetch_assoc()) 
{
	$detail [] = $tiap_detail;
}

// echo "<pre>";
// print_r($detail);
// echo "</pre>";
?>
<div class="container mt-3">
	<h3>Detail Pembelian</h3>
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
			</table>
		</div>
	</div>
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>Produk</th>
					<th>Jumlah</th>
					<th>Harga</th>
					<th>Berat</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($detail as $key => $value): ?>
					<tr>
						<td><?php echo $value["nama_produk"]; ?></td>
						<td><?php echo $value["jumlah_beli"]; ?></td>
						<td>Rp <?php echo number_format($value["harga_beli"]); ?></td>
						<td><?php echo number_format($value["berat_beli"]); ?> Gr</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
<?php 
include "footer.php";
?>