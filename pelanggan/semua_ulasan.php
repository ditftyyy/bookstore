<?php 
include "header.php";
$id_produk = $_GET["idp"];
$ambil_produk = $koneksi->query("SELECT * FROM pembelian_produk LEFT JOIN produk ON produk.id_produk = pembelian_produk.id_produk LEFT JOIN pembelian ON pembelian.id_pembelian = pembelian_produk.id_pembelian LEFT JOIN pelanggan ON pelanggan.id_pelanggan = pembelian.id_pelanggan WHERE pembelian_produk.id_produk = '$id_produk'");
$produk = array();
while ($tiap_produk = $ambil_produk->fetch_assoc()) 
{
	$produk[] = $tiap_produk;
}
// echo "<pre>";
// print_r($produk);
// echo "</pre>";
?>
<div class="container">
	<div class="card shadow my-5">
		<div class="card-body">
			<?php foreach ($produk as $key => $value): ?>
				<?php if (!empty($value["ulasan_produk"]) AND !empty($value["rating_produk"])): ?>
				<div class="row mb-3">
					<div class="col-md-4">
						<h5><?php echo $value["nama_pelanggan"]; ?></h5>
					</div>
					<div class="col-md-3">
						
						<source src="../assets/file/<?php echo $value["ulasan_file"]; ?>" width="200">
					</div>
					<div class="col-md-2">
						<?php foreach (range(1, $value['rating_produk']) as $k => $v): ?>
							
						<span class="bi bi-star-fill text-warning fw-bold"> </span>
						<?php endforeach ?>
					</div>
					<div class="col-md-10">
						<?php echo $value["ulasan_produk"]; ?>
					</div>
				</div>
				<hr>
			<?php endif ?>
		<?php endforeach ?>
	</div>
</div>
</div>
<?php 
include "footer.php";
?>