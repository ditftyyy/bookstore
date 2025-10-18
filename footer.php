</div>
<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h3 class="footer-title">Jejak<span>Literasi</span></h3>
                <p class="footer-text">Temukan dunia literasi yang tak terbatas. Destinasi utama Anda untuk buku-buku berkualitas dan pengetahuan yang menginspirasi.</p>
                <div class="social-links">
                    <a href="#" class="social-link"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
            <div class="footer-section">
                <h4 class="footer-heading">Menu Utama</h4>
                <ul class="footer-links">
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="produk.php">Koleksi Buku</a></li>
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Kontak</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4 class="footer-heading">Informasi Kontak</h4>
                <ul class="contact-info">
                    <li><i class="bi bi-geo-alt"></i> Jl. Trunojoyo No.85, Kauman, Kepatihan, Kec. Kaliwates, Kabupaten Jember, Jawa Timur 68131, Indonesia(Jl. Trunojoyo No.85, Kauman, Kepatihan, Kec. Kaliwates, Kabupaten Jember, Jawa Timur 68131, Indonesia)</li>
                    <li><i class="bi bi-telephone"></i> +62 838 3750 1316</li>
                    <li><i class="bi bi-envelope"></i> gramedia118@gmail.com</li>
                    <li><i class="bi bi-clock"></i> Senin - Minggu: 09:00 - 21:00</li>
                </ul>
            </div>
            <div class="footer-section">
                <h4 class="footer-heading">Newsletter</h4>
                <p class="footer-text">Berlangganan untuk mendapatkan informasi terbaru tentang buku-buku baru, diskon spesial, dan acara literasi.</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Masukkan email Anda" required>
                    <button type="submit"><i class="bi bi-arrow-right"></i></button>
                </form>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Jejak Literasi</p>
        </div>
    </div>
</footer>

<style>
.footer {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    color: #fff;
    padding: 4rem 0 2rem;
    margin-top: 5rem;
    position: relative;
    overflow: hidden;
}

.footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(to right, transparent, var(--gold-color), transparent);
}

.footer-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 3rem;
    margin-bottom: 3rem;
    position: relative;
    z-index: 1;
}

.footer-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 2.2rem;
    color: #fff;
    margin-bottom: 1rem;
    letter-spacing: 1px;
}

.footer-title span {
    color: var(--gold-color);
    display: block;
    font-size: 1.8rem;
    margin-top: -5px;
}

.footer-text {
    color: rgba(255, 255, 255, 0.8);
    line-height: 1.8;
    margin-bottom: 1.5rem;
    font-size: 0.95rem;
}

.social-links {
    display: flex;
    gap: 1.2rem;
}

.social-link {
    color: #fff;
    font-size: 1.3rem;
    transition: all 0.3s ease;
    opacity: 0.8;
}

.social-link:hover {
    color: var(--gold-color);
    transform: translateY(-3px);
    opacity: 1;
}

.footer-heading {
    color: #fff;
    font-size: 1.3rem;
    margin-bottom: 1.5rem;
    font-weight: 500;
    font-family: 'Cormorant Garamond', serif;
    position: relative;
    padding-bottom: 10px;
}

.footer-heading::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 40px;
    height: 2px;
    background: var(--gold-color);
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 1rem;
}

.footer-links a {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 0.95rem;
    display: inline-block;
}

.footer-links a:hover {
    color: var(--gold-color);
    transform: translateX(5px);
}

.contact-info {
    list-style: none;
    padding: 0;
    margin: 0;
}

.contact-info li {
    color: rgba(255, 255, 255, 0.8);
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.8rem;
    font-size: 0.95rem;
}

.contact-info i {
    color: var(--gold-color);
    font-size: 1.1rem;
}

.newsletter-form {
    display: flex;
    gap: 0.5rem;
    margin-top: 1rem;
}

.newsletter-form input {
    flex: 1;
    padding: 0.8rem 1.2rem;
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 25px;
    background: rgba(255, 255, 255, 0.05);
    color: #fff;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.newsletter-form input:focus {
    outline: none;
    border-color: var(--gold-color);
    background: rgba(255, 255, 255, 0.1);
}

.newsletter-form input::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

.newsletter-form button {
    background: var(--gold-color);
    color: var(--primary-color);
    border: none;
    width: 42px;
    height: 42px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 1.1rem;
}

.newsletter-form button:hover {
    background: #fff;
    transform: translateX(3px);
}

.footer-bottom {
    text-align: center;
    padding-top: 2rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.9rem;
}

@media (max-width: 768px) {
    .footer-content {
        grid-template-columns: 1fr;
        text-align: center;
    }

    .social-links {
        justify-content: center;
    }

    .contact-info li {
        justify-content: center;
    }

    .footer-heading::after {
        left: 50%;
        transform: translateX(-50%);
    }
}
</style>

<script type="text/javascript" src="assets/js/bootstrap.bundle.js"></script>
</body>
</html>
<?php 
if (isset($_POST["masuk"])) 
{
	//mendapatkan data inputan dari formulir
	$username = $_POST["username_login"];
	$password = sha1($_POST["password_login"]);

	//mendapatkan data username dan password admin dari database
	$ambil_admin = $koneksi -> query("SELECT * FROM admin WHERE username_admin = '$username' AND password_admin = '$password'");

	//memeriksa jumlah data yang di input di formulir dengan data yang ada di database
	$hitung_admin = $ambil_admin->num_rows;

	//jika $hitung_admin nilainya sama dengan 1 maka lanjut login
	if ($hitung_admin==1) 
	{
		//Data login
		$login = $ambil_admin -> fetch_assoc();

		//menyimpan data login ke dalam sebuah session
		$_SESSION["admin"] = $login;

		echo "<script>alert('Login berhasil,selamat datang!')</script>";
		echo "<script>location = 'admin/index.php'</script>";
	}

	else
	{
		$ambil_pelanggan = $koneksi ->query("SELECT * FROM pelanggan WHERE username_pelanggan = '$username' AND password_pelanggan = '$password'");

		$hitung_pelanggan = $ambil_pelanggan->num_rows;

		if ($hitung_pelanggan==1) 
		{
			$login_p = $ambil_pelanggan -> fetch_assoc();

			$_SESSION["pelanggan"] = $login_p;

			echo "<script>alert('Login berhasil,selamat datang!')</script>";
			echo "<script>location = 'pelanggan/index.php'</script>";
		}

		else
		{
			echo "<script>alert('Username atau password salah!')</script>";
			echo "<script>location = 'index.php'</script>";
		}
	}
}
?>