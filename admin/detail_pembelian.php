<?php 
include "header.php";
//mengambil id 
$id_detailp = $_GET["id"];

//mengamabil data pembelian produk
$detailp = array();
$ambil_detailp = $koneksi -> query("SELECT * FROM pembelian_produk LEFT JOIN produk ON produk.id_produk = pembelian_produk.id_produk WHERE id_pembelian = '$id_detailp'");
while ($tiap_detailp = $ambil_detailp -> fetch_assoc()) 
{
	$detailp[] = $tiap_detailp;
}

//mengambil data pembelian
$ambil_pembelian = $koneksi -> query("SELECT * FROM pembelian LEFT JOIN pelanggan ON pelanggan.id_pelanggan = pembelian.id_pelanggan WHERE id_pembelian = '$id_detailp'");
$pembelian = $ambil_pembelian -> fetch_assoc();

//ambil data pembayaran jika status lunas
$bukti_bayar = null;
if ($pembelian["status_pembelian"] == "lunas") {
    $ambil_pembayaran = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian = '$id_detailp'");
    $pembayaran = $ambil_pembayaran->fetch_assoc();
    if ($pembayaran && !empty($pembayaran["bukti_bayar"])) {
        $bukti_bayar = $pembayaran["bukti_bayar"];
    }
}
?>
<h3>Detail Pembelian</h3>
<hr>
<div class="row">
	<div class="col-md-4">
		<div class="table-responsive">
			<table class="table">
				<tr>
					<th>Nama</th>
					<td>: <?php echo $pembelian["nama_pelanggan"]; ?></td>
				</tr>
				<tr>
					<th>Tanggal Transaksi</th>
					<td>: <?php echo date("d M Y, H:i:s",strtotime($pembelian["tanggal_pembelian"])); ?></td>
				</tr>
				<tr>
					<th>Batas Pembayaran</th>
					<td>: <?php echo date("d M Y, H:i:s",strtotime($pembelian["batas_pembayaran"])); ?></td>
				</tr>
				<tr>
					<th>Status Pembelian</th>
					<td>: <?php echo $pembelian["status_pembelian"]; ?></td>
				</tr>
                <?php if ($bukti_bayar): ?>
                <tr>
                    <th>Bukti Pembayaran</th>
                    <td>:
                        <img src="../assets/file/<?php echo $bukti_bayar; ?>" width="150" style="border:1px solid #ccc;">
                    </td>
                </tr>
                <?php endif; ?>
			</table>
		</div>
	</div>
	<!-- Form ubah status di-nonaktifkan, tidak ada lagi -->
</div>
<div class="table-responsive">
	<table class="table table-bordered table-hover" id="thetable">
		<thead>
			<tr>
				<th>Produk</th>
				<th>Jumlah</th>
				<th>Harga</th>
				<th>Berat</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($detailp as $key => $value): ?>
				<tr>
					<td><?php echo $value["nama_produk"]; ?></td>
					<td><?php echo $value["jumlah_beli"]; ?></td>
					<td>Rp <?php echo number_format($value["harga_produk"]); ?></td>
					<td><?php echo number_format($value["berat_produk"]); ?> Gr</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>
<?php 
include "footer.php";
?>