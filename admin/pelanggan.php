<?php 
include "header.php";
$pelanggan = array();
$ambil_pelanggan = $koneksi -> query("SELECT * FROM pelanggan");
while ($tiap_pelanggan = $ambil_pelanggan -> fetch_assoc()) 
{
	$pelanggan [] = $tiap_pelanggan;
}
//echo "<pre>";
//print_r($produk);
//echo "</pre>";
 ?>
<div class="card-header bg-dark text-white mb-3">Data Pelanggan</div>
<div class="table-responsive">
	<table class="table table-bordered table-hover" id="thetable">
		<thead>
			<tr>
				<th>No</th>
				<th>Username</th>
				<th>Nama</th>
				<th>Jenis Kelamin</th>
				<th>Alamat</th>
				<th>No. HP</th>
				<th>Email</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($pelanggan as $key => $value): ?>
				<tr>
				<td><?php echo $key+1; ?></td>
				<td><?php echo $value["username_pelanggan"]; ?></td>
				<td><?php echo $value["nama_pelanggan"]; ?></td>
				<td><?php echo $value["jk_pelanggan"]; ?></td>
				<td><?php echo $value["alamat_pelanggan"]; ?></td>
				<td><?php echo $value["hp_pelanggan"]; ?></td>
				<td><?php echo $value["email_pelanggan"]; ?></td>
			</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>
 <?php 
include "footer.php";
 ?>