<?php 
include "header.php";
//mengambil id produk dari url
$id_produk = $_GET["id"];

//mengambil data produk berdasarkan id produk
$ambil_produk = $koneksi -> query("SELECT * FROM produk LEFT JOIN kategori ON kategori.id_kategori = produk.id_kategori WHERE id_produk = '$id_produk'");
$produk = $ambil_produk -> fetch_assoc();


//mengambil 4 data produk terbaru
$produk1 = array();
$ambil_produk1 = $koneksi -> query("SELECT * FROM produk LEFT JOIN kategori ON kategori.id_kategori = produk.id_kategori ORDER BY id_produk DESC limit 4");
while ($tiap_produk1 = $ambil_produk1 -> fetch_assoc()) 
{
	$produk1 [] = $tiap_produk1;
}
// echo "<pre>";
// print_r($produk1);
// echo "</pre>";
?>
<div class="container">
	<div class="card shadow my-5">
		<div class="card-body">
			<div class="row">
				<div class="col-md-4 text-center">
					<img src="assets/file/<?php echo $produk["foto_produk"]; ?>" class="img-fluid">
				</div>
				<div class="col-md-8">
					<h3 class="fw-bold"><?php echo $produk["nama_produk"]; ?></h3>
					<hr>
					<p><b>KATEGORI</b> : <?php echo $produk["nama_kategori"]; ?></p>
					<p><b>Harga</b> : Rp <?php echo number_format($produk["harga_produk"]); ?></p>
					<p><b>Stok</b> : <?php echo number_format($produk["stok_produk"]); ?></p>
					<p><b>Berat</b> : <?php echo number_format($produk["berat_produk"]); ?> Gr</p>
					<p class="text-center"><b>Deskripsi</b></p>
					<p style="text-align: justify;">
						<?php echo $produk["deskripsi_produk"]; ?>
					</p>
					<br>
					<hr>
					<form action="" method="post" class="text-center pt-2">
						<label class="form-label" for="">Masukan Jumlah</label>
						<input class="form-control" type="number" min="1" value="1" max="" name="masukan">
						<div class="d grid gap-2 pt-2">
							<button class="btn btn-warning" name="beli"><i class="bi bi-cart"></i> Masukan Keranjang</button>
						</div>
						<?php 
						if (isset($_POST["beli"])) 
						{
							echo "<script>alert('Untuk melakukan transaksi,anda harus login!')</script>";
						}
						?>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="card mb-5">
		<div class="card-body">
			<h3 class="fw-bold text-center">Produk Terbaru</h3>
			<hr>
			<div class="row">
				<?php foreach ($produk1 as $key => $value): ?>
					<div class="col-md-3">
						<div class="card">
							<img src="assets/file/<?php echo $value["foto_produk"]; ?>" class="card-img-top img-fluid">
							<div class="card-body">
								<h5 class="card-title"><?php echo $value["nama_produk"]; ?></h5>
								<p class="card-text">Rp <?php echo number_format($value["harga_produk"]); ?></p>
								<div class="d-grid gap-2">
									<a href="detail_produk.php?id=<?php echo $value["id_produk"]; ?>" class="btn btn-success text-white"><span class="bi bi-box-arrow-right"></span> Selengkapnya</a>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>
</div>
<?php 
include "footer.php";
?>