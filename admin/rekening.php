<?php 
include "header.php";
$rekening = array();
$ambil_rekening = $koneksi -> query("SELECT * FROM rekening");
while ($tiap_rekening = $ambil_rekening -> fetch_assoc()) 
{
	$rekening [] = $tiap_rekening;
}
//echo "<pre>";
//print_r($rekening);
//echo "</pre>";
 ?>
<div class="card-header bg-dark text-white mb-3">Data Rekening</div>
<div class="table-responsive">
	<table class="table table-bordered table-hover" id="thetable">
		<thead>
			<tr>
				<th>No</th>
				<th>Bank</th>
				<th>No Rekening</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($rekening as $key => $value): ?>
				<tr>
				<td><?php echo $key+1; ?></td>
				<td><?php echo $value["bank_rekening"]; ?></td>
				<td><?php echo $value["nomor_rekening"]; ?></td>
				<td nowrap="nowrap">
					<a href="ubah_rekening.php?id=<?php echo $value["id_rekening"]; ?>" class="btn-sm btn btn-warning">Ubah</a>
					<a href="hapus_rekening.php?id=<?php echo $value["id_rekening"]; ?>" onclick="return confirm('Apakah anda yakin?')" class="btn-sm btn btn-danger">Hapus</a>
				</td>
			</tr>
			<?php endforeach ?>
		</tbody>
	</table>
	<a href="tambah_rekening.php" class="btn btn-primary">Tambah</a>
</div>
 <?php 
include "footer.php";
 ?>