<?php 
include "header.php";
$kategori = array();
$ambil_kategori = $koneksi -> query("SELECT * FROM kategori");
while ($tiap_kategori = $ambil_kategori -> fetch_assoc()) 
{
	$kategori [] = $tiap_kategori;
}
//echo "<pre>";
//print_r($kategori);
//echo "</pre>";
 ?>
<div class="card-header bg-dark text-white mb-3">Data Kategori</div>
<div class="table-responsive">
	<table class="table table-bordered table-hover" id="thetable">
		<thead>
			<tr>
				<th>No</th>
				<th>Kategori</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($kategori as $key => $value): ?>
				<tr>
				<td><?php echo $key+1; ?></td>
				<td><?php echo $value["nama_kategori"]; ?></td>
				<td nowrap="nowrap">
					<a href="ubah_kategori.php?id=<?php echo $value["id_kategori"]; ?>" class="btn-sm btn btn-warning">Ubah</a>
					<a href="hapus_kategori.php?id=<?php echo $value["id_kategori"]; ?>" onclick="return confirm('Apakah anda yakin?')" class="btn-sm btn btn-danger">Hapus</a>
				</td>
			</tr>
			<?php endforeach ?>
		</tbody>
	</table>
	<a href="tambah_kategori.php" class="btn btn-primary">Tambah</a>
</div>
 <?php 
include "footer.php";
 ?>