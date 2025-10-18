<?php 
include "header.php";
$id_pembelian = $_GET["id"];
$produk = array();
$ambil_detail = $koneksi -> query("SELECT * FROM pembelian_produk LEFT JOIN produk ON produk.id_produk = pembelian_produk.id_produk WHERE id_pembelian = '$id_pembelian'");
while ($tiap = $ambil_detail -> fetch_assoc()) 
{
	$produk[] = $tiap;
}
?>
<div class="container">
	<div class="card shadow my-5">
		<div class="card-body">
			<?php foreach ($produk as $key => $value): ?>
				<div class="row mb-3">
				<div class="col-md-4 text-center">
					<img src="../assets/file/<?php echo $value["foto_produk"]; ?>" class="img-fluid">
				</div>
				<div class="col-md-8">
					<h3 class="fw-bold"><?php echo $value["nama_produk"]; ?></h3>
					<hr>
					<?php if (!empty($value["ulasan_produk"] AND $value["rating_produk"])): ?>
						<button href="detail_produk.php?id=<?php echo $value["id_produk"]; ?>&idp=<?php echo $value["id_pembelian_produk"]; ?>" class="btn btn-secondary disabled">Produk Sudah Diulas</button>
						<?php else: ?>
							<a href="detail_produk.php?id=<?php echo $value["id_produk"]; ?>&idp=<?php echo $value["id_pembelian_produk"]; ?>" class="btn btn-primary">Ulas Produk</a>
					<?php endif ?>
				</div>
			</div>
			<?php endforeach ?>
		</div>
	</div>
</div>
<?php 
include "footer.php";
?>