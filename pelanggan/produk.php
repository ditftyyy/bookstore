<?php 
include "header.php";
//jika ada parameter id kategori di url maka tampilkan
if (isset($_GET["idk"])) 
{
	$id_kategori = $_GET["idk"];
}
//jika ada yang ngetik lewat formulir cari maka akan menampilkan produk berdasarkan keyword yang diketik
if(isset($_GET['cari']))
{
	$cari = $_GET['cari'];
	$ambil_produk = $koneksi -> query("SELECT * FROM produk LEFT JOIN kategori ON kategori.id_kategori = produk.id_kategori WHERE nama_produk LIKE '%".$cari."%' ORDER BY id_produk DESC LIMIT 12");
	$produk = array();
	while ($tiap_produk = $ambil_produk -> fetch_assoc()) 
	{
		$produk[] = $tiap_produk;
	}    
}

elseif (isset($_GET["idk"])) 
{
	$produk = array();
	$ambil_produk = $koneksi -> query("SELECT * FROM produk LEFT JOIN kategori ON kategori.id_kategori = produk.id_kategori WHERE kategori.id_kategori = '$id_kategori' ORDER BY id_produk DESC LIMIT 12");
	while ($tiap_produk = $ambil_produk -> fetch_assoc()) 
	{
		$produk [] = $tiap_produk;
	}

	//mengambil data kategori berdasarkan id kategori
	$ak = $koneksi -> query("SELECT * FROM kategori WHERE id_kategori = '$id_kategori'");
	$kt = $ak -> fetch_assoc();
}

//apabila tidak ada yang ngetik di formulir maka menampilkan semua data produk
else
{
	$produk = array();
	$ambil_produk = $koneksi -> query("SELECT * FROM produk LEFT JOIN kategori ON kategori.id_kategori = produk.id_kategori ORDER BY id_produk DESC LIMIT 12");
	while ($tiap_produk = $ambil_produk -> fetch_assoc()) 
	{
		$produk [] = $tiap_produk;
	}
} 
?>

<style>
.page-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    padding: 3rem 0;
    margin-bottom: 3rem;
    color: white;
}

.page-title {
    font-family: 'Playfair Display', serif;
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

.page-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
}

.product-card {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    height: 100%;
    border: none;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.product-image {
    height: 300px;
    object-fit: cover;
    width: 100%;
}

.product-info {
    padding: 1.5rem;
}

.product-title {
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
    color: var(--text-color);
    font-weight: 500;
}

.product-price {
    color: var(--primary-color);
    font-weight: 600;
    font-size: 1.2rem;
    margin-bottom: 1rem;
}

.btn-view {
    background-color: transparent;
    color: var(--primary-color);
    border: 1px solid var(--primary-color);
    padding: 0.5rem 1.5rem;
    border-radius: 25px;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-block;
    width: 100%;
    text-align: center;
}

.btn-view:hover {
    background-color: var(--primary-color);
    color: white;
}

.btn-all-products {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    color: white;
    padding: 1rem 2.5rem;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-block;
    margin-top: 2rem;
}

.btn-all-products:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 105, 180, 0.3);
    color: white;
}

.search-result {
    background: #f8f9fa;
    padding: 1rem 2rem;
    border-radius: 10px;
    margin-bottom: 2rem;
    font-weight: 500;
    color: var(--text-color);
}

.category-title {
    font-family: 'Playfair Display', serif;
    color: var(--text-color);
    margin-bottom: 2rem;
    position: relative;
    display: inline-block;
}

.category-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 0;
    width: 50px;
    height: 2px;
    background: var(--primary-color);
}
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1 class="page-title">Koleksi Kami</h1>
        <p class="page-subtitle">Temukan Pilihan Kami</p>
    </div>
</div>

<div class="container">
    <?php if (isset($_GET["cari"])): ?>
        <div class="search-result">
            <i class="bi bi-search me-2"></i> Hasil pencarian untuk : "<?php echo $cari; ?>"
        </div>
    <?php endif; ?>

    <?php if (isset($_GET["idk"])): ?>
        <h2 class="category-title">
            <?php echo $kt['nama_kategori']; ?>
        </h2>
    <?php endif; ?>

    <div class="row g-4">
        <?php foreach ($produk as $key => $value): ?>
            <div class="col-lg-3 col-md-6">
                <div class="product-card">
                    <img src="../assets/file/<?php echo $value["foto_produk"]; ?>" class="product-image" alt="<?php echo $value["nama_produk"]; ?>">
                    <div class="product-info">
                        <h3 class="product-title"><?php echo $value["nama_produk"]; ?></h3>
                        <div class="product-price">Rp <?php echo number_format($value["harga_produk"]); ?></div>
                        <a href="detail_produk.php?id=<?php echo $value["id_produk"]; ?>" class="btn-view">Lihat Detail</a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>

    <div class="text-center">
        <a href="produk.php" class="btn-all-products">Lihat Semua Produk</a>
    </div>
</div>

<?php 
include "footer.php";
?>