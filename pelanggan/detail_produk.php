<?php 
include "header.php";
//mengambil id produk dari url
$id_produk = $_GET["id"];
if (isset($_GET["idp"])) {
	$id_pp = $_GET["idp"];
}

//mengambil data produk berdasarkan id produk
$ambil_produk = $koneksi -> query("SELECT * FROM produk LEFT JOIN kategori ON kategori.id_kategori = produk.id_kategori WHERE id_produk = '$id_produk'");
$produk = $ambil_produk -> fetch_assoc();
$ikp = $produk["id_kategori"];

// Proses tambah ke keranjang
if (isset($_POST["beli"])) {
    $jumlah = $_POST["masukan"];
    
    // Cek apakah produk sudah ada di keranjang
    $cek_keranjang = $koneksi->query("SELECT * FROM keranjang WHERE id_pelanggan='$id_pelanggan' AND id_produk='$id_produk'");
    $jumlah_keranjang = $cek_keranjang->num_rows;
    
    if ($jumlah_keranjang == 1) {
        // Update jumlah jika produk sudah ada di keranjang
        $koneksi->query("UPDATE keranjang SET jumlah = jumlah + $jumlah WHERE id_pelanggan='$id_pelanggan' AND id_produk='$id_produk'");
    } else {
        // Tambah produk baru ke keranjang
        $koneksi->query("INSERT INTO keranjang (id_pelanggan, id_produk, jumlah) VALUES ('$id_pelanggan', '$id_produk', '$jumlah')");
    }
    
    echo "<script>alert('Produk berhasil ditambahkan ke keranjang!')</script>";
    echo "<script>location='keranjang.php'</script>";
}

//mengambil 4 data produk terbaru
$produk1 = array();
$ambil_produk1 = $koneksi -> query("SELECT * FROM produk LEFT JOIN kategori ON kategori.id_kategori = produk.id_kategori ORDER BY id_produk DESC limit 4");
while ($tiap_produk1 = $ambil_produk1 -> fetch_assoc()) 
{
	$produk1 [] = $tiap_produk1;
}

//mengambil data keranjang dari user yang login
$ambil_k = $koneksi -> query("SELECT * FROM keranjang WHERE id_produk = '$id_produk' AND id_pelanggan = '$id_pelanggan'");
$kk = $ambil_k -> fetch_assoc();

//mengambil data pembelian produk berdasarkan id pembelian produk 
if (isset($id_pp)) {
	$ambil_pp = $koneksi -> query("SELECT * FROM pembelian_produk WHERE id_pembelian_produk = '$id_pp'");
	$app = $ambil_pp->fetch_assoc();
}

//mengambil data produk terkait
$ambil_rp = $koneksi -> query("SELECT * FROM produk WHERE id_kategori = '$ikp'");
$rp = array();
while ($tiap_rp = $ambil_rp -> fetch_assoc()) 
{
	$rp[] = $tiap_rp;
}

$ambil_keranjang = $koneksi -> query("SELECT * FROM keranjang WHERE id_pelanggan = '$id_pelanggan' AND id_produk = '$id_produk'");
$keranjang = $ambil_keranjang ->fetch_assoc();
// echo "<pre>";
// print_r($keranjang);
// echo "</pre>";


// Mengambil rating produk ini
$jumlah_r = 0;
$banyak_r = 0;
$ambil_rate = $koneksi -> query("SELECT * FROM `pembelian_produk` WHERE id_produk = '$id_produk'");
while ($tiap_r = $ambil_rate -> fetch_assoc()) 
{
	if ($tiap_r['rating_produk'] > 0) 
	{
		$jumlah_r += $tiap_r['rating_produk'];
		$banyak_r+=1;

	}
}
if (!empty($jumlah_r) AND !empty($banyak_r)) {
	$total = $jumlah_r/$banyak_r;
}
else
{
	$total = "";
}

// echo "<pre>";
// print_r($jumlah_r/$banyak_r);
// echo "</pre>";
?>
<style>
.product-detail {
    padding: 4rem 0;
}

.product-image-container {
    position: relative;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.product-image {
    width: 100%;
    height: 500px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-image:hover {
    transform: scale(1.05);
}

.product-info {
    padding: 2rem;
}

.product-title {
    font-family: 'Playfair Display', serif;
    font-size: 2.5rem;
    color: var(--text-color);
    margin-bottom: 1rem;
}

.product-category {
    color: var(--primary-color);
    font-size: 1.1rem;
    margin-bottom: 1rem;
}

.product-price {
    font-size: 2rem;
    color: var(--primary-color);
    font-weight: 600;
    margin-bottom: 1.5rem;
}

.product-meta {
    margin-bottom: 2rem;
}

.meta-item {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
}

.meta-label {
    font-weight: 500;
    width: 100px;
    color: var(--text-color);
}

.meta-value {
    color: #666;
}

.rating {
    display: flex;
    align-items: center;
    margin-bottom: 1.5rem;
}

.stars {
    color: #FFD700;
    margin-right: 0.5rem;
}

.rating-value {
    color: var(--text-color);
    font-weight: 500;
}

.product-description {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 10px;
    margin-bottom: 2rem;
}

.description-title {
    font-family: 'Playfair Display', serif;
    color: var(--text-color);
    margin-bottom: 1rem;
}

.description-text {
    color: #666;
    line-height: 1.8;
}

.quantity-input {
    width: 100px;
    padding: 0.5rem;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-bottom: 1rem;
}

.btn-add-cart {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 30px;
    font-weight: 500;
    transition: all 0.3s ease;
    width: 100%;
    margin-bottom: 1rem;
}

.btn-add-cart:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 105, 180, 0.3);
    color: white;
}

.btn-add-cart:disabled {
    background: #ccc;
    cursor: not-allowed;
}

.btn-review {
    background-color: transparent;
    color: var(--primary-color);
    border: 1px solid var(--primary-color);
    padding: 1rem 2rem;
    border-radius: 30px;
    font-weight: 500;
    transition: all 0.3s ease;
    width: 100%;
    margin-bottom: 1rem;
}

.btn-review:hover {
    background-color: var(--primary-color);
    color: white;
}

.btn-all-reviews {
    background-color: var(--gold-color);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 30px;
    font-weight: 500;
    transition: all 0.3s ease;
    width: 100%;
}

.btn-all-reviews:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
    color: white;
}

.related-products {
    padding: 4rem 0;
    background: #f8f9fa;
}

.section-title {
    font-family: 'Playfair Display', serif;
    color: var(--text-color);
    text-align: center;
    margin-bottom: 3rem;
    position: relative;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 50px;
    height: 2px;
    background: var(--primary-color);
}

.related-product-card {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    height: 100%;
}

.related-product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.related-product-image {
    height: 250px;
    object-fit: cover;
    width: 100%;
}

.related-product-info {
    padding: 1.5rem;
}

.related-product-title {
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
    color: var(--text-color);
}

.related-product-price {
    color: var(--primary-color);
    font-weight: 600;
    font-size: 1.2rem;
    margin-bottom: 1rem;
}

.btn-view-details {
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

.btn-view-details:hover {
    background-color: var(--primary-color);
    color: white;
}

/* Review Modal Styles */
.modal-content {
    border: none;
    border-radius: 15px;
}

.modal-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    color: white;
    border-radius: 15px 15px 0 0;
    border: none;
}

.modal-title {
    font-family: 'Playfair Display', serif;
}

.review-form textarea {
    border-radius: 10px;
    border: 1px solid #ddd;
    padding: 1rem;
    resize: none;
}

.review-form input[type="number"] {
    border-radius: 10px;
    border: 1px solid #ddd;
    padding: 0.5rem;
}

.btn-submit-review {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    color: white;
    border: none;
    padding: 0.8rem 2rem;
    border-radius: 25px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-submit-review:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 105, 180, 0.3);
    color: white;
}
</style>

<div class="product-detail">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="product-image-container">
                    <img src="../assets/file/<?php echo $produk["foto_produk"]; ?>" class="product-image" alt="<?php echo $produk["nama_produk"]; ?>">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="product-info">
                    <h1 class="product-title"><?php echo $produk["nama_produk"]; ?></h1>
                    <div class="product-category"><?php echo $produk["nama_kategori"]; ?></div>
                    <div class="product-price">Rp <?php echo number_format($produk["harga_produk"]); ?></div>
                    
                    <div class="product-meta">
                        <div class="meta-item">
                            <span class="meta-label">Stock:</span>
                            <span class="meta-value"><?php echo number_format($produk["stok_produk"]); ?> units</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Weight:</span>
                            <span class="meta-value"><?php echo number_format($produk["berat_produk"]); ?> Gr</span>
                        </div>
                    </div>

                    <div class="rating">
                        <div class="stars">
                            <?php foreach (range(1, $total) as $k => $v): ?>
                                <i class="bi bi-star-fill"></i>
                            <?php endforeach ?>
                        </div>
                        <span class="rating-value"><?php echo $total; ?> / 5</span>
                    </div>

                    <div class="product-description">
                        <h3 class="description-title">Deskripsi</h3>
                        <p class="description-text"><?php echo $produk["deskripsi_produk"]; ?></p>
                    </div>

                    <form action="" method="post">
                        <div class="mb-3">
                            <label class="form-label">Kuantitas</label>
                            <input type="number" class="form-control quantity-input" name="masukan" value="1" min="1" max="<?php echo $produk["stok_produk"]; ?>">
                        </div>

                        <div class="d-grid gap-2">
                            <?php if ($produk["stok_produk"]==0): ?>
                                <button class="btn btn-add-cart" disabled>Habis Terjual</button>
                            <?php else: ?>
                                <button class="btn btn-add-cart" name="beli">
                                    <i class="bi bi-cart-plus"></i> Tambah Keranjang
                                </button>
                            <?php endif ?>

                            <?php if (isset($id_pp)): ?>
                                <?php if (empty($app["ulasan_produk"]) AND $app["rating_produk"]==0): ?>
                                    <button type="button" class="btn btn-review" data-bs-toggle="modal" data-bs-target="#ulasan">
                                        <i class="bi bi-star"></i> Tulis Ulasan
                                    </button>
                                <?php endif ?>
                            <?php endif ?>

                            <a href="semua_ulasan.php?idp=<?php echo $id_produk; ?>" class="btn btn-all-reviews">
                                <i class="bi bi-star"></i> Lihat Semua Ulasan
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Related Products Section -->
<section class="related-products">
    <div class="container">
        <h2 class="section-title">Produk Terkait</h2>
        <div class="row g-4">
            <?php foreach ($rp as $rk => $vr): ?>
                <div class="col-lg-3 col-md-6">
                    <div class="related-product-card">
                        <img src="../assets/file/<?php echo $vr["foto_produk"]; ?>" class="related-product-image" alt="<?php echo $vr["nama_produk"]; ?>">
                        <div class="related-product-info">
                            <h3 class="related-product-title"><?php echo $vr["nama_produk"]; ?></h3>
                            <div class="related-product-price">Rp <?php echo number_format($vr["harga_produk"]); ?></div>
                            <a href="detail_produk.php?id=<?php echo $vr["id_produk"]; ?>" class="btn-view-details">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>

<!-- Latest Products Section -->
<section class="related-products" style="background: white;">
    <div class="container">
        <h2 class="section-title">Produk Terbaru</h2>
        <div class="row g-4">
            <?php foreach ($produk1 as $key => $value): ?>
                <div class="col-lg-3 col-md-6">
                    <div class="related-product-card">
                        <img src="../assets/file/<?php echo $value["foto_produk"]; ?>" class="related-product-image" alt="<?php echo $value["nama_produk"]; ?>">
                        <div class="related-product-info">
                            <h3 class="related-product-title"><?php echo $value["nama_produk"]; ?></h3>
                            <div class="related-product-price">Rp <?php echo number_format($value["harga_produk"]); ?></div>
                            <a href="detail_produk.php?id=<?php echo $value["id_produk"]; ?>" class="btn-view-details">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>

<!-- Review Modal -->
<?php if (isset($id_pp)): ?>
    <?php if (empty($app["ulasan_produk"]) AND $app["rating_produk"]==0): ?>
        <div class="modal fade" id="ulasan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tulis Ulasan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" class="review-form">
                            <div class="mb-3">
                                <label class="form-label">Ulasan Anda</label>
                                <textarea class="form-control" name="ulasan_produk" rows="4" placeholder="Share your experience with this product..."></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Rating</label>
                                <input type="number" class="form-control" name="rating_produk" min="1" max="5" placeholder="Rate from 1 to 5">
                                <small class="text-muted">Silakan beri penilaian dari 1 hingga 5 bintang</small>
                            </div>
                            <button class="btn btn-submit-review" name="ulas">Kirim Ulasan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>
<?php endif ?>

<?php 
include "footer.php";
?>