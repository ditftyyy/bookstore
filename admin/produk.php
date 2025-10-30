<?php 
include "header.php";
$produk = array();
$ambil_produk = $koneksi -> query("SELECT * FROM produk LEFT JOIN kategori ON kategori.id_kategori = produk.id_kategori");
while ($tiap_produk = $ambil_produk -> fetch_assoc()) 
{
	$produk [] = $tiap_produk;
}
// echo "<pre>";
// print_r($produk);
// echo "</pre>";
?>
<div class="card-header bg-dark text-white mb-3">Data Produk</div>
<div class="table-responsive">
	<table class="table table-bordered table-hover" id="thetable">
		<thead>
			<tr>
				<th>No</th>
				<th>Kategori</th>
				<th>Nama Produk</th>
				<th>Harga</th>
				<th>Deskripsi</th>
				<th>Stok</th>
				<th>Berat</th>
				<th>foto</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($produk as $key => $value): ?>
				<tr>
					<td><?php echo $key+1; ?></td>
					<td><?php echo $value["nama_kategori"]; ?></td>
					<td><?php echo $value["nama_produk"]; ?></td>
					<td>Rp <?php echo number_format($value["harga_produk"]); ?></td>
					<td width="300"><?php echo $value["deskripsi_produk"]; ?></td>
					<td><?php echo $value["stok_produk"]; ?></td>
					<td><?php echo number_format($value["berat_produk"]); ?> Gr</td>
					<td>
						<img src="../assets/file/<?php echo $value["foto_produk"]; ?>" width="100">
					</td>
					<td nowrap="nowrap">
						<a href="ubah_produk.php?id=<?php echo $value["id_produk"]; ?>" class="btn-sm btn btn-warning">Ubah</a>
						<a href="hapus_produk.php?id=<?php echo $value["id_produk"]; ?>" onclick="return confirm('Apakah anda yakin?')" class="btn-sm btn btn-danger">Hapus</a>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
	<a href="tambah_produk.php" class="btn btn-primary">Tambah</a>
</div>
<?php 
include "footer.php";
?>