<?php 
include "header.php";
//mengambil id 
$id_pembelian = $_GET["id"];


$ambil_pembayaran = $koneksi -> query("SELECT * FROM pembayaran WHERE id_pembelian = '$id_pembelian'");
$pembayaran = $ambil_pembayaran -> fetch_assoc();


//mengambil data pembelian
$ambil_pembelian = $koneksi -> query ("SELECT * FROM pembelian LEFT JOIN pelanggan ON pelanggan.id_pelanggan = pembelian.id_pelanggan WHERE id_pembelian = '$id_pembelian'" );
$pembelian = $ambil_pembelian -> fetch_assoc();

//echo "<pre>";
//print_r($pembayaran);
//echo "</pre>";
?>
<h3>Pembayaran</h3>
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
			</table>
		</div>
	</div>
	</div>
</div>
<div class="table-responsive container">
	<table class="table table-bordered table-hover" id="thetable">
		<thead>
			<tr>
				<th>Bank</th>
				<th>Jumlah Pembayaran</th>
				<th>Tanggal Pembayaran</th>
				<th>Bukti Pembayaran</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($ambil_pembayaran as $key => $value): ?>
				<tr>
					<td><?php echo $value["bank_bayar"]; ?></td>
					<td><?php echo $value["jumlah_bayar"]; ?></td>
					<td><?php echo date("d M Y",strtotime($value["tanggal_bayar"])); ?></td>
					<td>
						<img src="../assets/file/<?php echo $value["bukti_bayar"]; ?>" width="100">	
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>
<?php 
include "footer.php";
 ?>