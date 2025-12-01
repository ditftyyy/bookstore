</div>
<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h3 class="footer-title">Twingkle</h3>
                <p class="footer-text">Temukan keanggunan abadi di setiap produknya. Destinasi utama untuk aksesoris premium.</p>
                <div class="social-links">
                    <a href="https://www.instagram.com/gramediajember?igsh=ZHcwMnI4OTUwM3Q0" class="social-link"><i class="bi bi-instagram"></i></a>
                    <a href="https://wa.me/6285174330118" class="social-link"><i class="bi bi-whatsapp"></i></a>
                    <a href="https://goo.gl/maps/qHyqvnaYDRbosq8x5" class="social-link"><i class="bi bi-geo-alt-fill"></i></a>
                </div>
            </div>
            <div class="footer-section">
                <h4 class="footer-heading">Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="produk.php">Products</a></li>
                    <li><a href="riwayat.php">Order History</a></li>
                    <li><a href="profile.php">Profile</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4 class="footer-heading">Contact Info</h4>
                <ul class="contact-info">
                    <li><i class="bi bi-geo-alt"></i> Jember, Jawa Timur</li>
                    <li><i class="bi bi-telephone"></i> +62 851-7433-0118</li>
                    <li><i class="bi bi-envelope"></i> gramedia118@gmail.com</li>
                </ul>
            </div>
            <div class="footer-section">
                <h4 class="footer-heading">Newsletter</h4>
                <p class="footer-text">Berlangganan untuk menerima pembaruan tentang koleksi baru dan penawaran spesial.</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Enter your email" required>
                    <button type="submit"><i class="bi bi-arrow-right"></i></button>
                </form>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Jejak Literasi. All rights reserved.</p>
        </div>
    </div>
</footer>

<style>
.footer {
    background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
    color: #fff;
    padding: 4rem 0 2rem;
    margin-top: 5rem;
}

.footer-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 3rem;
    margin-bottom: 3rem;
}

.footer-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.8rem;
    color: var(--gold-color);
    margin-bottom: 1rem;
}

.footer-text {
    color: #999;
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.social-links {
    display: flex;
    gap: 1rem;
}

.social-link {
    color: #fff;
    font-size: 1.2rem;
    transition: all 0.3s ease;
}

.social-link:hover {
    color: var(--primary-color);
    transform: translateY(-3px);
}

.footer-heading {
    color: #fff;
    font-size: 1.2rem;
    margin-bottom: 1.5rem;
    font-weight: 500;
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 0.8rem;
}

.footer-links a {
    color: #999;
    text-decoration: none;
    transition: all 0.3s ease;
}

.footer-links a:hover {
    color: var(--primary-color);
    padding-left: 5px;
}

.contact-info {
    list-style: none;
    padding: 0;
    margin: 0;
}

.contact-info li {
    color: #999;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.contact-info i {
    color: var(--primary-color);
}

.newsletter-form {
    display: flex;
    gap: 0.5rem;
    margin-top: 1rem;
}

.newsletter-form input {
    flex: 1;
    padding: 0.8rem;
    border: none;
    border-radius: 25px;
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
}

.newsletter-form input::placeholder {
    color: #999;
}

.newsletter-form button {
    background: var(--primary-color);
    color: #fff;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.newsletter-form button:hover {
    background: var(--secondary-color);
    transform: translateX(3px);
}

.footer-bottom {
    text-align: center;
    padding-top: 2rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    color: #999;
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
}
</style>

<script type="text/javascript" src="../assets/js/bootstrap.bundle.js"></script>
<script src="../assets/js/jquery-3.5.1.js"></script>
<script>
    $(document).ready(function(){
      $.ajax({
        url : 'dataprovinsi.php',
        success:function(hasil){
          $("select[name=provinsi]").html(hasil);
        }
      })
    });

    $(document).ready(function(){
      $("select[name=provinsi]").on("change", function(){
        var id_provinsi = $(this).val();
        var nama_provinsi = $("option:selected", this).attr("nama");
        $("input[name=nama_provinsi]").val(nama_provinsi);
        $.ajax({
          url : 'datakota.php',
          type : 'POST',
          data : "provinsi="+id_provinsi,
          success:function(hasil){
            $("select[name=kota]").html(hasil);
          }
        });

        $("select[name=ekspedisi]").val(null);
        $("select[name=ongkir]").val(null);

        $("input[name=nama_kota]").val(null);
        $("input[name=tipe]").val(null);
        $("input[name=kodepos]").val(null);
        $("input[name=nama_ekspedisi]").val(null);
        $("input[name=nama_paket]").val(null);
        $("input[name=biaya_paket]").val(null);
        $("input[name=lama_paket]").val(null);
        $("input[name=total_bayar]").val(null);
      })
    });

    $(document).ready(function(){
      $("select[name=kota]").on("change", function(){
        var id_kota = $(this).val();
        var nama = $("option:selected", this).attr("nama");
        var kodepos = $("option:selected", this).attr("kodepos");
        var tipe = $("option:selected", this).attr("tipe");
        $("input[name=nama_kota]").val(nama);
        $("input[name=kodepos]").val(kodepos);
        $("input[name=tipe]").val(tipe);
      })
    });

    $(document).ready(function(){
      $.ajax({
        url : 'dataekspedisi.php',
        success:function(hasil){
          $("select[name=ekspedisi]").html(hasil);
        }
      })
    });

    $(document).ready(function(){
      $("select[name=ekspedisi]").on("change", function(){
        var nama = $("option:selected", this).attr("nama");
        $("input[name=nama_ekspedisi]").val(nama);
      })
    });

    $(document).ready(function(){
      $("select[name=ekspedisi]").on("change", function(){
        var id_kota = $("select[name=kota]").val();
        var total_berat = $("input[name=total_berat]").val();
        var ekspedisi = $("select[name=ekspedisi]").val();
        $.ajax({
          url : 'dataongkir.php',
          type : 'POST',
          data : 'id_kota='+id_kota+'&total_berat='+total_berat+'&ekspedisi='+ekspedisi,
          success:function(hasil){            
            $("select[name=ongkir]").html(hasil);
          }
        })
      })
    });

    $(document).ready(function(){
      $("select[name=ongkir]").on("change", function(){
        var nama = $("option:selected", this).attr("nama");
        var biaya = $("option:selected", this).attr("biaya");
        var lama = $("option:selected", this).attr("lama");

        $("input[name=nama_paket]").val(nama);
        $("input[name=biaya_paket]").val(biaya);
        $("input[name=lama_paket]").val(lama);

        $("#total_ongkir").html("Rp. "+biaya);

        var total_belanja = $("input[name=total_belanja]").val();
        var biaya_paket = $("input[name=biaya_paket]").val();

        var total_bayar = parseInt(total_belanja) + parseInt(biaya_paket);

        $("#total_bayar").html("Rp. "+total_bayar);

        $("input[name=total_bayar]").val(total_bayar);
      })
    })
</script>
</body>
</html>
<?php 
if (isset($_POST["masuk"])) 
{
	$username = $_POST["username_login"];
	$password = sha1($_POST["password_login"]);

	$ambil_admin = $koneksi -> query("SELECT * FROM admin WHERE username_admin = '$username' AND password_admin = '$password'");

	$hitung_admin = $ambil_admin->num_rows;

	if ($hitung_admin==1) 
	{
		$login = $ambil_admin -> fetch_assoc();

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