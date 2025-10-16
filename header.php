<?php 
//memanggil file koneksi.php agar bisa mengakses semua skrip yang ada di dalam file koneksi.php
include "koneksi.php";

//mengambil data kategori
$ambil_kategori = $koneksi -> query("SELECT * FROM kategori");
$kategori = array();
while ($tiap_kategori = $ambil_kategori -> fetch_assoc()) 
{
	$kategori[] = $tiap_kategori;
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
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
			padding: 1.2rem 0;
			box-shadow: 0 2px 15px rgba(0,0,0,0.08);
		}

		.navbar-brand {
			font-family: 'Cormorant Garamond', serif !important;
			font-size: 2.4rem !important;
			color: var(--primary-color) !important;
			letter-spacing: 2px;
			font-weight: 600;
			position: relative;
			padding-bottom: 8px;
			text-transform: none;
			line-height: 1.2;
		}

		.navbar-brand span {
			display: block;
			font-size: 1.8rem;
			color: var(--accent-color);
			letter-spacing: 3px;
			margin-top: -5px;
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
			font-size: 0.95rem;
			padding: 0.5rem 1.2rem !important;
			transition: all 0.3s ease;
			text-transform: uppercase;
			letter-spacing: 0.5px;
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
		}

		.dropdown-item {
			font-size: 0.9rem;
			padding: 0.6rem 1.5rem;
			border-radius: 6px;
			transition: all 0.3s ease;
			color: var(--text-color);
		}

		.dropdown-item:hover {
			background-color: var(--light-bg) !important;
			color: var(--accent-color) !important;
			transform: translateX(5px);
		}

		.search-form {
			position: relative;
			width: 300px;
		}

		.search-form .form-control {
			border: 1px solid rgba(44, 62, 80, 0.1);
			border-radius: 25px;
			padding: 0.6rem 1.2rem;
			font-size: 0.9rem;
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

		.login-btn, .daftar-btn {
			background-color: transparent !important;
			color: var(--text-color) !important;
			border: 2px solid var(--accent-color) !important;
			border-radius: 25px;
			padding: 0.5rem 1.5rem !important;
			font-weight: 600 !important;
			font-size: 0.9rem;
			transition: all 0.3s ease;
			text-transform: uppercase;
			letter-spacing: 0.5px;
		}

		.login-btn:hover, .daftar-btn:hover {
			background-color: var(--accent-color) !important;
			color: white !important;
			transform: translateY(-2px);
		}

		.daftar-btn {
			background-color: var(--accent-color) !important;
			color: white !important;
		}

		.daftar-btn:hover {
			background-color: var(--primary-color) !important;
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

		.modal-body h3 {
			font-family: 'Playfair Display', serif;
			color: var(--gold-color);
			margin-bottom: 1.5rem;
			text-align: center;
			font-size: 1.8rem;
		}

		.form-label {
			font-weight: 500;
			color: var(--text-color);
			margin-bottom: 0.5rem;
			font-size: 0.9rem;
		}

		.form-control {
			border-radius: 8px;
			padding: 0.8rem 1rem;
			border: 1px solid rgba(0,0,0,0.1);
			transition: all 0.3s ease;
		}

		.form-control:focus {
			border-color: var(--primary-color);
			box-shadow: 0 0 0 3px rgba(255, 105, 180, 0.1);
		}

		.form-control::placeholder {
			color: #999;
			font-size: 0.9rem;
		}

		.btn-primary {
			background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
			border: none;
			border-radius: 25px;
			padding: 0.8rem 2rem;
			font-weight: 500;
			transition: all 0.3s ease;
			width: 100%;
			margin-top: 1rem;
		}

		.btn-primary:hover {
			transform: translateY(-2px);
			box-shadow: 0 5px 15px rgba(255, 105, 180, 0.3);
		}

		.form-select {
			border-radius: 8px;
			padding: 0.8rem 1rem;
			border: 1px solid rgba(0,0,0,0.1);
			transition: all 0.3s ease;
		}

		.form-select:focus {
			border-color: var(--primary-color);
			box-shadow: 0 0 0 3px rgba(255, 105, 180, 0.1);
		}

		textarea.form-control {
			min-height: 100px;
			resize: none;
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
						<a href="index.php" class="nav-link">Home</a>
					</li>
					<li class="nav-item">
						<a href="produk.php" class="nav-link">Products</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
							Categories
						</a>
						<ul class="dropdown-menu">
							<?php foreach ($kategori as $kt => $vt): ?>
								<li><a class="dropdown-item" href="produk.php?idk=<?php echo $vt["id_kategori"]; ?>"><?php echo $vt["nama_kategori"]; ?></a></li>
							<?php endforeach ?>
						</ul>
					</li>
				</ul>
				<form class="d-flex search-form me-3" role="search">
					<input class="form-control" type="search" placeholder="Search..." name="cari">
					<button name="tombol" class="btn" type="submit">
						<span class="bi bi-search"></span>
					</button>
				</form>
				<div class="d-flex">
					<a type="button" class="nav-link login-btn me-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
						Sign In
					</a>
					<a type="button" class="nav-link daftar-btn" data-bs-toggle="modal" data-bs-target="#daftar">
						Sign Up
					</a>
				</div>
			</div>
		</div>
	</nav>

	<!-- Login Modal -->
	<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<h3>Welcome Back</h3>
					<form method="post">
						<div class="mb-3">
							<label class="form-label">Username</label>
							<input type="text" class="form-control" name="username_login" placeholder="Enter your username">
						</div>
						<div class="mb-3">
							<label class="form-label">Password</label>
							<input type="password" class="form-control" name="password_login" placeholder="Enter your password">
						</div>
						<button class="btn btn-primary" name="masuk">Sign In</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Register Modal -->
	<div class="modal fade" id="daftar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<h3>Create Account</h3>
					<form method="post" enctype="multipart/form-data">
						<div class="mb-3">
							<label class="form-label">Username</label>
							<input type="text" class="form-control" name="username_pelanggan" placeholder="Choose a username" required>
						</div>
						<div class="mb-3">
							<label class="form-label">Password</label>
							<input type="password" class="form-control" name="password_pelanggan" placeholder="Create a password" required>
						</div>
						<div class="mb-3">
							<label class="form-label">Full Name</label>
							<input type="text" class="form-control" name="nama_pelanggan" placeholder="Enter your full name" required>
						</div>
						<div class="mb-3">
							<label class="form-label">Gender</label>
							<select class="form-select" name="jk_pelanggan" required>
								<option value="">Select Gender</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
						</div>
						<div class="mb-3">
							<label class="form-label">Address</label>
							<textarea class="form-control" name="alamat_pelanggan" placeholder="Enter your address" required></textarea>
						</div>
						<div class="mb-3">
							<label class="form-label">Phone Number</label>
							<input type="text" class="form-control" name="hp_pelanggan" placeholder="Enter your phone number" required>
						</div>
						<div class="mb-3">
							<label class="form-label">Email</label>
							<input type="email" class="form-control" name="email_pelanggan" placeholder="Enter your email" required>
						</div>
						<button class="btn btn-primary" name="daftar">Create Account</button>
					</form>
					<?php 
					if (isset($_POST["daftar"])) 
					{
						$username = $_POST["username_pelanggan"];
						$ap = $koneksi -> query("SELECT * FROM pelanggan WHERE username_pelanggan = '$username'");
						$cek_ap = $ap->num_rows;
						if ($cek_ap==1) 
						{
							echo "<script>alert('Username already exists. Please choose another one.')</script>";
						}
						else
						{
							$password = sha1($_POST["password_pelanggan"]);
							$nama = $_POST["nama_pelanggan"];
							$jk = $_POST["jk_pelanggan"];
							$alamat = $_POST["alamat_pelanggan"];
							$hp = $_POST["hp_pelanggan"];
							$email = $_POST["email_pelanggan"];
						
							$koneksi -> query("INSERT INTO pelanggan(username_pelanggan,password_pelanggan,nama_pelanggan,jk_pelanggan,alamat_pelanggan,hp_pelanggan,email_pelanggan) VALUES('$username','$password','$nama','$jk','$alamat','$hp','$email')");
							echo "<script>alert('Account created successfully. Please sign in.')</script>";
						}		
					}
					?>
				</div>
			</div>
		</div>
	</div>

	<div class="min-vh-100">