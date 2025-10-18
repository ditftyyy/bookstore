<?php 
//memanggil file koneksi.php agar bisa mengakses semua skrip yang ada di dalam file koneksi.php
include "../koneksi.php";

//Jika tidak ada data login / proses login maka tidak boleh masuk ke halaman ini
if (!isset($_SESSION["pelanggan"])) 
{
	echo "<script>alert('Anda harus login !')</script>";
	echo "<script>location = '../index.php'</script>";
}

//mendapatkan data pelanggan yang sedang login
$id_pelanggan = $_SESSION["pelanggan"] ["id_pelanggan"];
$ambil_pelanggan = $koneksi -> query("SELECT * FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'");
$pelanggan = $ambil_pelanggan -> fetch_assoc();

//mengambil data kategori
$ambil_kategori = $koneksi -> query("SELECT * FROM kategori");
$kategori = array();
while ($tiap_kategori = $ambil_kategori -> fetch_assoc()) 
{
	$kategori[] = $tiap_kategori;
}

//mengambil data keranjang dari user yang login
$ambil_keranjang = $koneksi -> query("SELECT * FROM keranjang LEFT JOIN produk ON produk.id_produk = keranjang.id_produk WHERE id_pelanggan = '$id_pelanggan'");
$keranjang = array();
while ($tiap_keranjang = $ambil_keranjang -> fetch_assoc()) 
{
	$keranjang[] = $tiap_keranjang;
}
//menghitung jumlah data keranjang dari user yang login
$jk = count($keranjang);

//mengambil data chat dari user yang login
$ambil_chat = $koneksi -> query("SELECT * FROM chat WHERE id_pelanggan = '$id_pelanggan'");
$chat = array();
while ($tiap_chat = $ambil_chat->fetch_assoc()) 
{
	$chat[] = $tiap_chat;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
	<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&display=swap" rel="stylesheet">
	<style type="text/css">
		:root {
			--primary-color: #2C3E50;
			--secondary-color: #34495E;
			--text-color: #2C3E50;
			--accent-color: #C0392B;
			--gold-color: #B8860B;
			--light-bg: #F5F6FA;
		}

		body {
			font-family: 'Montserrat', sans-serif;
			background-color: var(--light-bg);
		}

		.navbar {
			background: white !important;
			padding: 1rem 0;
			box-shadow: 0 2px 15px rgba(0,0,0,0.08);
		}

		.navbar-brand {
			font-family: 'Cormorant Garamond', serif !important;
			font-size: 2rem !important;
			color: var(--primary-color) !important;
			letter-spacing: 1px;
			font-weight: 600;
			position: relative;
			padding-bottom: 5px;
			text-transform: none;
			line-height: 1.2;
			margin-right: 2rem;
		}

		.navbar-brand span {
			display: block;
			font-size: 1.5rem;
			color: var(--accent-color);
			letter-spacing: 2px;
			margin-top: -3px;
		}

		.navbar-brand::after {
			content: '';
			position: absolute;
			bottom: 0;
			left: 0;
			width: 100%;
			height: 2px;
			background: linear-gradient(to right, var(--accent-color), var(--gold-color));
			transform: scaleX(0);
			transition: transform 0.3s ease;
		}

		.navbar-brand:hover::after {
			transform: scaleX(1);
		}

		.navbar-nav .nav-link {
			font-weight: 500 !important;
			color: var(--text-color) !important;
			font-size: 0.85rem;
			padding: 0.4rem 0.8rem !important;
			transition: all 0.3s ease;
			text-transform: uppercase;
			letter-spacing: 0.5px;
			white-space: nowrap;
		}

		.navbar-nav .nav-link:hover {
			color: var(--accent-color) !important;
			transform: translateY(-2px);
		}

		.dropdown-menu {
			border: none;
			box-shadow: 0 4px 20px rgba(0,0,0,0.1);
			border-radius: 8px;
			padding: 0.8rem;
			min-width: 200px;
		}

		.dropdown-item {
			font-size: 0.85rem;
			padding: 0.5rem 1rem;
			border-radius: 6px;
			transition: all 0.3s ease;
			color: var(--text-color);
			white-space: nowrap;
		}

		.dropdown-item:hover {
			background-color: var(--light-bg) !important;
			color: var(--accent-color) !important;
			transform: translateX(5px);
		}

		.search-form {
			position: relative;
			width: 250px;
			margin: 0 1rem;
		}

		.search-form .form-control {
			border: 1px solid rgba(44, 62, 80, 0.1);
			border-radius: 25px;
			padding: 0.5rem 1rem;
			font-size: 0.85rem;
			transition: all 0.3s ease;
			background-color: var(--light-bg);
		}

		.search-form .form-control:focus {
			border-color: var(--accent-color);
			box-shadow: 0 0 0 3px rgba(192, 57, 43, 0.1);
		}

		.search-form .btn {
			position: absolute;
			right: 5px;
			top: 50%;
			transform: translateY(-50%);
			background: none !important;
			border: none !important;
			color: var(--accent-color) !important;
			padding: 0;
			transition: all 0.3s ease;
		}

		.cart-badge {
			background-color: var(--accent-color) !important;
			color: white !important;
			font-size: 0.65rem !important;
			padding: 0.15rem 0.4rem !important;
		}

		.chat-btn {
			background-color: var(--accent-color) !important;
			color: white !important;
			border: none !important;
			border-radius: 20px;
			padding: 0.4rem 1rem !important;
			font-weight: 500 !important;
			font-size: 0.85rem;
			transition: all 0.3s ease;
			text-transform: uppercase;
			letter-spacing: 0.5px;
			margin: 0 0.5rem;
		}

		.chat-btn:hover {
			background-color: var(--primary-color) !important;
			transform: translateY(-2px);
		}

		/* Responsive adjustments */
		@media (max-width: 1200px) {
			.navbar-brand {
				font-size: 1.8rem !important;
			}
			.navbar-brand span {
				font-size: 1.3rem;
			}
			.search-form {
				width: 200px;
			}
		}

		@media (max-width: 991px) {
			.navbar-nav {
				margin-top: 1rem;
			}
			.navbar-nav .nav-link {
				padding: 0.5rem 0 !important;
			}
			.search-form {
				width: 100%;
				margin: 1rem 0;
			}
			.chat-btn {
				margin: 0.5rem 0;
			}
		}

		/* Modal Styling */
		.modal-content {
			border: none;
			border-radius: 15px;
			box-shadow: 0 10px 30px rgba(0,0,0,0.1);
		}

		.modal-header {
			border-bottom: none;
			padding: 1.5rem;
			background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
			border-radius: 15px 15px 0 0;
		}

		.modal-header .btn-close {
			background-color: white;
			opacity: 0.8;
			transition: all 0.3s ease;
		}

		.modal-header .btn-close:hover {
			opacity: 1;
			transform: rotate(90deg);
		}

		.modal-body {
			padding: 2rem;
		}

		.chat-message {
			margin-bottom: 1rem;
			padding: 1rem;
			border-radius: 10px;
			max-width: 80%;
		}

		.chat-message.customer {
			background-color: var(--accent-color);
			color: white;
			margin-right: auto;
		}

		.chat-message.admin {
			background-color: var(--light-bg);
			color: var(--text-color);
			margin-left: auto;
		}

		.chat-input {
			border: 1px solid rgba(44, 62, 80, 0.1);
			border-radius: 25px;
			padding: 0.8rem 1.2rem;
			transition: all 0.3s ease;
			background-color: var(--light-bg);
		}

		.chat-input:focus {
			border-color: var(--accent-color);
			box-shadow: 0 0 0 3px rgba(192, 57, 43, 0.1);
		}

		.send-btn {
			background-color: var(--accent-color) !important;
			color: white !important;
			border: none !important;
			border-radius: 25px;
			padding: 0.8rem 1.5rem !important;
			font-weight: 500 !important;
			transition: all 0.3s ease;
			text-transform: uppercase;
			letter-spacing: 0.5px;
		}

		.send-btn:hover {
			background-color: var(--primary-color) !important;
			transform: translateY(-2px);
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg">
		<div class="container">
			<a href="index.php" class="navbar-brand">JEJAK<span>LITERASI</span></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#lorem">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="navbar-collapse collapse" id="lorem">
				<ul class="navbar-nav me-auto">
					<li class="nav-item">
						<a href="index.php" class="nav-link">Beranda</a>
					</li>
					<li class="nav-item">
						<a href="produk.php" class="nav-link">Buku</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
							Kategori
						</a>
						<ul class="dropdown-menu">
							<?php foreach ($kategori as $kt => $vt): ?>
								<li><a class="dropdown-item" href="produk.php?idk=<?php echo $vt["id_kategori"]; ?>"><?php echo $vt["nama_kategori"]; ?></a></li>
							<?php endforeach ?>
						</ul>
					</li>
					<li class="nav-item">
						<a href="riwayat.php" class="nav-link">Riwayat</a>
					</li>
				</ul>
				<form class="d-flex search-form" role="search">
					<input class="form-control" type="search" placeholder="Cari buku..." name="cari">
					<button name="tombol" class="btn" type="submit">
						<span class="bi bi-search"></span>
					</button>
				</form>
				<ul class="navbar-nav ms-auto">
					<li class="nav-item">
						<a href="keranjang.php" class="nav-link position-relative">
							Keranjang
							<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill cart-badge"><?php echo $jk ?></span>
						</a>
					</li>
					<li class="nav-item">
						<button type="button" class="btn chat-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
							Chat
						</button>
					</li>
					<li class="nav-item">
						<a href="profile.php" class="nav-link">Profil</a>
					</li>
					<li class="nav-item">
						<a href="logout.php" class="nav-link" onclick="return confirm('Apakah Anda yakin ingin keluar?')">Keluar</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Chat Modal -->
	<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title text-white">Chat dengan Admin</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<?php foreach ($chat as $key => $value): ?>
						<div class="chat-message <?php echo $value["pengirim_chat"] == "pelanggan" ? "customer" : "admin"; ?>">
							<?php echo $value["isi_chat"]; ?>
						</div>
					<?php endforeach ?>
				</div>
				<div class="modal-footer">
					<form method="post" class="w-100">
						<div class="d-flex gap-2">
							<input type="text" class="form-control chat-input" name="isi_chat" placeholder="Ketik pesan Anda...">
							<button class="btn send-btn" name="kirim">Kirim</button>
						</div>
					</form>
					<?php 
					if (isset($_POST["kirim"])) 
					{
						$pelanggan = $id_pelanggan;
						$id_admin = 0;
						$isi_chat = $_POST["isi_chat"];
						$pengirim = "pelanggan";

						$koneksi -> query("INSERT INTO chat(id_pelanggan,id_admin,isi_chat,pengirim_chat) VALUES('$pelanggan','$id_admin','$isi_chat','$pengirim')");
						echo "<script>location = 'index.php'</script>";
					}
					?>
				</div>
			</div>
		</div>
	</div>

	<div class="min-vh-100">