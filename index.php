<?php 
include "header.php";

// Mengambil 3 kategori dengan produk terbanyak
$ambil_top_kategori = $koneksi->query("SELECT k.*, COUNT(p.id_produk) as total_produk 
    FROM kategori k 
    LEFT JOIN produk p ON k.id_kategori = p.id_kategori 
    GROUP BY k.id_kategori 
    ORDER BY total_produk DESC 
    LIMIT 3");
$top_kategori = array();
while ($tiap_kategori = $ambil_top_kategori->fetch_assoc()) {
    $top_kategori[] = $tiap_kategori;
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

//Produk Terlaris
$ambil_pt = $koneksi -> query("SELECT produk.id_produk, produk.nama_produk, produk.harga_produk, produk.foto_produk, COUNT(pembelian_produk.id_produk) AS total_sold
        FROM produk
        LEFT JOIN pembelian_produk ON produk.id_produk = pembelian_produk.id_produk
        GROUP BY produk.id_produk, produk.nama_produk, produk.harga_produk, produk.foto_produk
        ORDER BY total_sold DESC LIMIT 12");

$pt = array();
while ($row =  $ambil_pt->fetch_assoc()) {
	$pt[] = $row;
}
?>

<head>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
</head>
<style>
.hero-section {
    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('assets/file/bg.jpg');
    background-size: cover;
    background-position: center;
    height: 85vh;
    display: flex;
    align-items: center;
    position: relative;
}

.hero-content {
    color: white;
    max-width: 700px;
}

.hero-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 4rem;
    margin-bottom: 1.5rem;
    line-height: 1.2;
    font-weight: 600;
}

.hero-subtitle {
    font-size: 1.3rem;
    margin-bottom: 2rem;
    opacity: 0.9;
    font-weight: 300;
    letter-spacing: 0.5px;
}

.btn-shop {
    background-color: var(--accent-color);
    color: white;
    padding: 1rem 2.5rem;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-block;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-size: 0.9rem;
}

.btn-shop:hover {
    background-color: var(--primary-color);
    color: white;
    transform: translateY(-2px);
}

.feature-section {
    padding: 5rem 0;
    background: var(--primary-color);
    color: white;
}

.feature-card {
    text-align: center;
    padding: 2.5rem;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 15px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.1);
}

.feature-icon {
    font-size: 2.5rem;
    color: var(--gold-color);
    margin-bottom: 1.5rem;
}

.feature-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.8rem;
    margin-bottom: 1rem;
    color: white;
}

.feature-text {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
    line-height: 1.8;
}

.collection-section {
    padding: 6rem 0;
    position: relative;
    background: var(--light-bg);
}

.section-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 2.8rem;
    color: var(--primary-color);
    text-align: center;
    margin-bottom: 3rem;
    position: relative;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 2px;
    background: var(--accent-color);
}

.product-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    height: 100%;
    position: relative;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.product-image {
    height: 350px;
    object-fit: cover;
    width: 100%;
    transition: all 0.3s ease;
}

.product-card:hover .product-image {
    transform: scale(1.05);
}

.product-info {
    padding: 1.8rem;
    background: white;
    position: relative;
}

.product-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.4rem;
    margin-bottom: 0.8rem;
    color: var(--text-color);
    font-weight: 600;
}

.product-category {
    color: var(--accent-color);
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.product-price {
    color: var(--primary-color);
    font-weight: 600;
    font-size: 1.3rem;
    margin-bottom: 1.2rem;
}

.btn-view {
    background-color: transparent;
    color: var(--accent-color);
    border: 2px solid var(--accent-color);
    padding: 0.6rem 1.8rem;
    border-radius: 25px;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-block;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-size: 0.9rem;
}

.btn-view:hover {
    background-color: var(--accent-color);
    color: white;
}

.newsletter-section {
    background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('assets/file/library-bg.jpg');
    background-size: cover;
    background-position: center;
    padding: 6rem 0;
    color: white;
}

.newsletter-content {
    text-align: center;
    max-width: 700px;
    margin: 0 auto;
}

.newsletter-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 3rem;
    margin-bottom: 1.5rem;
}

.newsletter-text {
    margin-bottom: 2.5rem;
    opacity: 0.9;
    font-size: 1.1rem;
    line-height: 1.8;
}

.newsletter-form {
    display: flex;
    gap: 1rem;
    max-width: 600px;
    margin: 0 auto;
}

.newsletter-input {
    flex: 1;
    padding: 1.2rem;
    border: none;
    border-radius: 30px;
    font-size: 1rem;
    background: rgba(255, 255, 255, 0.1);
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.newsletter-input::placeholder {
    color: rgba(255, 255, 255, 0.7);
}

.newsletter-btn {
    background-color: var(--accent-color);
    color: white;
    border: none;
    padding: 1.2rem 2.5rem;
    border-radius: 30px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 500;
}

.newsletter-btn:hover {
    background-color: var(--primary-color);
}

.banner-section {
    padding: 6rem 0;
    background: white;
}

.banner-content {
    text-align: center;
    max-width: 900px;
    margin: 0 auto;
}

.banner-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 3rem;
    color: var(--primary-color);
    margin-bottom: 2rem;
}

.banner-text {
    color: var(--text-color);
    font-size: 1.2rem;
    line-height: 1.8;
    margin-bottom: 2rem;
}

.stats-section {
    padding: 5rem 0;
    background: var(--light-bg);
}

.stats-container {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    gap: 3rem;
}

.stat-item {
    text-align: center;
    padding: 2rem;
}

.stat-number {
    font-family: 'Cormorant Garamond', serif;
    font-size: 3.5rem;
    color: var(--accent-color);
    margin-bottom: 0.8rem;
    font-weight: 600;
}

.stat-label {
    color: var(--text-color);
    font-size: 1.2rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.testimonial-section {
    padding: 6rem 0;
    background: white;
}

.testimonial-card {
    background: var(--light-bg);
    padding: 2.5rem;
    border-radius: 15px;
    text-align: center;
    margin: 1rem;
    position: relative;
}

.testimonial-card::before {
    content: '"';
    position: absolute;
    top: 20px;
    left: 20px;
    font-family: 'Cormorant Garamond', serif;
    font-size: 4rem;
    color: var(--accent-color);
    opacity: 0.2;
}

.testimonial-text {
    font-style: italic;
    color: var(--text-color);
    margin-bottom: 1.5rem;
    line-height: 1.8;
    font-size: 1.1rem;
}

.testimonial-author {
    font-weight: 600;
    color: var(--primary-color);
    font-size: 1.1rem;
}

.testimonial-role {
    color: var(--accent-color);
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* New Interactive Sections */
.welcome-section {
    padding: 8rem 0;
    background: var(--light-bg);
    position: relative;
    overflow: hidden;
}

.welcome-content {
    position: relative;
    z-index: 2;
}

.welcome-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 3.5rem;
    color: var(--primary-color);
    margin-bottom: 2rem;
    line-height: 1.2;
}

.welcome-text {
    font-size: 1.2rem;
    color: var(--text-color);
    line-height: 1.8;
    margin-bottom: 3rem;
    max-width: 600px;
}

.floating-books {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    pointer-events: none;
}

.book-item {
    position: absolute;
    width: 100px;
    height: 150px;
    background: var(--primary-color);
    border-radius: 5px;
    opacity: 0.1;
    animation: float 6s infinite ease-in-out;
}

.book-item:nth-child(1) {
    top: 20%;
    left: 10%;
    animation-delay: 0s;
    background: var(--accent-color);
}

.book-item:nth-child(2) {
    top: 40%;
    right: 15%;
    animation-delay: 1s;
    background: var(--gold-color);
}

.book-item:nth-child(3) {
    bottom: 30%;
    left: 20%;
    animation-delay: 2s;
    background: var(--primary-color);
}

@keyframes float {
    0% {
        transform: translateY(0) rotate(0deg);
    }
    50% {
        transform: translateY(-20px) rotate(5deg);
    }
    100% {
        transform: translateY(0) rotate(0deg);
    }
}

.categories-showcase {
    padding: 6rem 0;
    background: white;
}

.category-card {
    position: relative;
    height: 400px;
    border-radius: 20px;
    overflow: hidden;
    margin-bottom: 30px;
    cursor: pointer;
}

.category-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.category-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.7), rgba(0,0,0,0.2));
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 2rem;
    color: white;
    transition: all 0.3s ease;
}

.category-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 2rem;
    margin-bottom: 0.5rem;
    transform: translateY(20px);
    transition: transform 0.3s ease;
}

.category-description {
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.3s ease;
}

.category-card:hover .category-image {
    transform: scale(1.1);
}

.category-card:hover .category-overlay {
    background: linear-gradient(to top, rgba(0,0,0,0.8), rgba(0,0,0,0.3));
}

.category-card:hover .category-title {
    transform: translateY(0);
}

.category-card:hover .category-description {
    opacity: 1;
    transform: translateY(0);
}

.quote-section {
    padding: 6rem 0;
    background: var(--primary-color);
    color: white;
    position: relative;
    overflow: hidden;
}

.quote-content {
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
}

.quote-text {
    font-family: 'Cormorant Garamond', serif;
    font-size: 2.5rem;
    line-height: 1.4;
    margin-bottom: 2rem;
    font-style: italic;
}

.quote-author {
    font-size: 1.2rem;
    opacity: 0.9;
}

.quote-decoration {
    position: absolute;
    font-family: 'Cormorant Garamond', serif;
    font-size: 15rem;
    color: rgba(255,255,255,0.03);
    z-index: 1;
}

.quote-decoration.left {
    top: -50px;
    left: -50px;
}

.quote-decoration.right {
    bottom: -50px;
    right: -50px;
}
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">Temukan Dunia Melalui Buku</h1>
            <p class="hero-subtitle">Jelajahi Koleksi Buku Premium Pilihan Kami Yang Akan Membawa Anda Dalam Perjalanan Luar Biasa Melalui Waktu Dan Imajinasi.</p>
            <a href="produk.php" class="btn-shop">Explore Collection</a>
        </div>
    </div>
</section>

<!-- Welcome Section -->
<section class="welcome-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="welcome-content" data-aos="fade-right">
                    <h2 class="welcome-title">Selamat Datang Di Jejak Literasi</h2>
                    <p class="welcome-text">Masuki Dunia Di Mana Cerita Menjadi Hidup Dan Pengetahuan Tidak Mengenal Batas. Koleksi Buku Kami Mencakup Berbagai Genre, Budaya, Dan Abad, Menawarkan Pengalaman Membaca Yang Tak Tertandingi.</p>
                    <a href="produk.php" class="btn-shop">Start Your Journey</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="floating-books">
                    <div class="book-item"></div>
                    <div class="book-item"></div>
                    <div class="book-item"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Categories Showcase -->
<section class="categories-showcase">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Jelajahi Kategori Kami</h2>
        <div class="row">
            <?php foreach ($top_kategori as $key => $value): ?>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="<?php echo ($key + 1) * 100; ?>">
                <div class="category-card">
                    <img src="assets/file/category/latar.jpg" alt="<?php echo $value['nama_kategori']; ?>" class="category-image">
                    <div class="category-overlay">
                        <h3 class="category-title"><?php echo $value['nama_kategori']; ?></h3>
                        <p class="category-description"><?php echo $value['total_produk']; ?> buku yang tersedia</p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Quote Section -->
<section class="quote-section">
    <div class="container">
        <div class="quote-content" data-aos="fade-up">
            <div class="quote-decoration left">"</div>
            <div class="quote-decoration right">"</div>
            <p class="quote-text">Sebuah Buku Adalah Mimpi Yang Kamu Genggam Di Tanganmu</p>
            <div class="quote-author">- Neil Gaiman</div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="feature-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-book"></i>
                    </div>
                    <h3 class="feature-title">Koleksi Pilihan</h3>
                    <p class="feature-text">Buku-Buku Yang Dipilih Dengan Cermat Dari Penulis Dan Penerbit Terkenal Di Seluruh Dunia, Memastikan Pengalaman Membaca Dengan Kualitas Tertinggi.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-truck"></i>
                    </div>
                    <h3 class="feature-title">Pengiriman</h3>
                    <p class="feature-text">Pengiriman Cepat Dan Aman Sampai Ke Pintu Rumah Anda Dengan Kemasan Buku Khusus.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h3 class="feature-title">Buku Otentik</h3>
                    <p class="feature-text">Setiap Buku Dijamin Asli Dan Dilengkapi Dengan Penanda Buku Premium Serta Sampul Pelindung Dari Kami.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Banner Section -->
<section class="banner-section">
    <div class="container">
        <div class="banner-content">
            <h2 class="banner-title">Where Stories Come Alive</h2>
            <p class="banner-text">Di Jejak Literasi, kami percaya bahwa buku lebih dari sekadar halaman yang dijilid bersama. Mereka adalah gerbang ke dunia baru, sumber kebijaksanaan, dan teman sepanjang hayat. Koleksi kami dipilih dengan cermat untuk menghadirkan karya sastra terbaik yang menginspirasi, mendidik, dan menghibur.</p>
        </div>
    </div>
</section>

<!-- Featured Collection -->
<section class="collection-section">
    <div class="container">
        <h2 class="section-title">Buku Pilihan</h2>
        <div class="row g-4">
            <?php foreach ($produk as $key => $value): ?>
                <div class="col-lg-3 col-md-6">
                    <div class="product-card">
                        <img src="assets/file/<?php echo $value["foto_produk"]; ?>" class="product-image" alt="<?php echo $value["nama_produk"]; ?>">
                        <div class="product-info">
                            <div class="product-category"><?php echo $value["nama_kategori"]; ?></div>
                            <h3 class="product-title"><?php echo $value["nama_produk"]; ?></h3>
                            <div class="product-price">Rp <?php echo number_format($value["harga_produk"]); ?></div>
                            <a href="detail_produk.php?id=<?php echo $value["id_produk"]; ?>" class="btn-view">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <div class="text-center mt-5">
            <a href="produk.php" class="btn-shop">Lihat Semua Buku</a>
        </div>
    </div>
</section>

<!-- Best Sellers -->
<section class="collection-section" style="background-color: white;">
    <div class="container">
        <h2 class="section-title">Best Sellers</h2>
        <div class="row g-4">
            <?php foreach ($pt as $kt => $vv): ?>
                <div class="col-lg-3 col-md-6">
                    <div class="product-card">
                        <img src="assets/file/<?php echo $vv["foto_produk"]; ?>" class="product-image" alt="<?php echo $vv["nama_produk"]; ?>">
                        <div class="product-info">
                            <div class="product-category">Bestseller</div>
                            <h3 class="product-title"><?php echo $vv["nama_produk"]; ?></h3>
                            <div class="product-price">Rp <?php echo number_format($vv["harga_produk"]); ?></div>
                            <a href="detail_produk.php?id=<?php echo $vv["id_produk"]; ?>" class="btn-view">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="stats-container">
            <div class="stat-item">
                <div class="stat-number">50K+</div>
                <div class="stat-label">Happy Readers</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">10K+</div>
                <div class="stat-label">Book Titles</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">100+</div>
                <div class="stat-label">Publishers</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Book Support</div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonial-section">
    <div class="container">
        <h2 class="section-title">Pendapat Pembaca Kami</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="testimonial-card">
                    <p class="testimonial-text">"Kualitas buku mereka luar biasa. Setiap pembelian telah menjadi tambahan yang menyenangkan untuk perpustakaan saya."</p>
                    <div class="testimonial-author">Sarah Johnson</div>
                    <div class="testimonial-role">Book Collector</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial-card">
                    <p class="testimonial-text">"Layanan pelanggan mereka luar biasa. Mereka membantu saya menemukan edisi langka yang telah saya cari selama bertahun-tahun."</p>
                    <div class="testimonial-author">Michael Chen</div>
                    <div class="testimonial-role">Literature Enthusiast</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial-card">
                    <p class="testimonial-text">"Perhatian terhadap detail dalam kemasan dan pengiriman buku mereka luar biasa. Benar-benar pengalaman premium."</p>
                    <div class="testimonial-author">Emma Davis</div>
                    <div class="testimonial-role">Book Blogger</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="newsletter-section">
    <div class="container">
        <div class="newsletter-content">
            <h2 class="newsletter-title">Bergabung Dengan Komunitas Kami</h2>
            <p class="newsletter-text"Langganan untuk menerima pembaruan tentang rilis baru, acara penulis, dan rekomendasi buku eksklusif.</p>
            <form class="newsletter-form">
                <input type="email" class="newsletter-input" placeholder="Enter your email address">
                <button type="submit" class="newsletter-btn">Subscribe</button>
            </form>
        </div>
    </div>
</section>

<?php 
include "footer.php";
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });
});
</script>