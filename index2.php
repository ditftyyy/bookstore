<?php 
include "header.php";

//jika ada yang ngetik lewat formulir cari maka akan menampilkan produk berdasarkan keyword yang diketik
if(isset($_GET['cari']))
{
	$cari = $_GET['cari'];
	$ambil_produk = $koneksi -> query("SELECT * FROM produk LEFT JOIN kategori ON kategori.id_kategori = produk.id_kategori WHERE nama_produk LIKE '%".$cari."%' ORDER BY id_produk DESC");
	$produk = array();
	while ($tiap_produk = $ambil_produk -> fetch_assoc()) 
	{
		$produk[] = $tiap_produk;
	}    
}

//apabila tidak ada yang ngetik di formulir maka menampilkan semua data produk
else
{
	$produk = array();
	$ambil_produk = $koneksi -> query("SELECT * FROM produk LEFT JOIN kategori ON kategori.id_kategori = produk.id_kategori ORDER BY id_produk DESC limit 8");
	while ($tiap_produk = $ambil_produk -> fetch_assoc()) 
	{
		$produk [] = $tiap_produk;
	}
} 

//Produk Terlaris
$ambil_pt = $koneksi -> query("SELECT produk.id_produk, produk.nama_produk, produk.harga_produk, produk.foto_produk, COUNT(pembelian_produk.id_produk) AS total_sold
        FROM produk
        LEFT JOIN pembelian_produk ON produk.id_produk = pembelian_produk.id_produk
        GROUP BY produk.id_produk, produk.nama_produk, produk.harga_produk, produk.foto_produk
        ORDER BY total_sold DESC");

$pt = array();
while ($row =  $ambil_pt->fetch_assoc()) {
	$pt[] = $row;
}
?>
<section class="hedaer py-5" style="background: url('assets/file/bandeng.jpg'); background-size:cover; background-position: center center;">
	<div class="container py-5">
		<div class="row">
			<div class="col-md-6">
				<h4 class="mb-4 text-white text-uppercase"><strong>SELAMAT DATANG</strong></h4>
				<h1 style="color: white;" class="mb-4"><strong>Menjual Berbagai Macam Produk</strong></h1>
				<h4 class="text-white mb-4" style="text-align: justify;">
					<strong>Diolah dengan berbagai macam cara dan bumbu yang meresap hingga ke dalam sehingga dapat dinikmati dengan sangat nikmat dan proses penyajian yang sederhana</strong>
				</h4>
				<div class="d-inline">
					<a href="produk.php" class="btn btn-warning text-white"><strong> <span class=" bi bi-chevron-double-right"></span>MULAI BELANJA</strong></a>

				</div>
				
			</div>
		</div>
	</div>
</section>
<div class="container">
	<div class="row my-3">
		<h3>Produk Kami</h3>
		<hr>
		<?php 
		if (isset($_GET["cari"])) 
		{
			echo "<b class='my-3 text-uppercase'>Hasil pencarian : ".$cari."</b>"; 
		}
		?>
		<?php foreach ($produk as $key => $value): ?>
			<div class="col-md-3 col-6 mb-3">
				<div class="card">
					<img src="assets/file/<?php echo $value["foto_produk"]; ?>" class="img-fluid">
					<div class="card-body">
						<h4><?php echo $value["nama_produk"]; ?></h4>
						<h6>Rp <?php echo number_format($value["harga_produk"]); ?></h6>
						<a href="detail_produk.php?id=<?php echo $value["id_produk"]; ?>" class="btn btn-success text-white"><span class="bi bi-box-arrow-right"></span> Selengkapnya</a>
					</div>
				</div>
			</div>
		<?php endforeach ?>
	</div>  
	<div class="text-center">
		<a href="produk.php" class="btn btn-success text-decoration-none text-white">SEMUA PRODUK</a>
	</div>

	<div class="row my-3">
		<h3>Produk Terlaris</h3>
		<hr>
		<?php foreach ($pt as $kt => $vv): ?>
			<div class="col-md-3 col-6 mb-3">
				<div class="card">
					<img src="assets/file/<?php echo $vv["foto_produk"]; ?>" class="img-fluid">
					<div class="card-body">
						<h4><?php echo $vv["nama_produk"]; ?></h4>
						<h6>Rp <?php echo number_format($vv["harga_produk"]); ?></h6>
						<a href="detail_produk.php?id=<?php echo $vv["id_produk"]; ?>" class="btn btn-success text-white"><span class="bi bi-box-arrow-right"></span> Selengkapnya</a>
					</div>
				</div>
			</div>
		<?php endforeach ?>
	</div>
</div>
<?php 
include "footer.php";
?>