<?php 
//memanggil file koneksi
include "../koneksi.php";
//Jika tidak ada data login / proses login maka tidak boleh masuk ke halaman ini
if (!isset($_SESSION["admin"])) 
{
	echo "<script>alert('Anda harus login !')</script>";
	echo "<script>location = '../index.php'</script>";
}

//mendapatkan data admin yang sedang login
$id_admin = $_SESSION["admin"] ["id_admin"];
$ambil_admin = $koneksi -> query("SELECT * FROM admin WHERE id_admin = '$id_admin'");
$admin = $ambil_admin -> fetch_assoc();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Administrator</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/dashboard.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/dataTables.bootstrap5.min.css">
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/modules/export-data.js"></script>
	<script src="https://code.highcharts.com/modules/accessibility.js"></script>
	<style type="text/css">
		.highcharts-figure,

		#container {
			height: 400px;
		}

		.highcharts-data-table table {
			font-family: Verdana, sans-serif;
			border-collapse: collapse;
			border: 1px solid #ebebeb;
			margin: 10px auto;
			text-align: center;
			width: 100%;
			max-width: 500px;
		}

		.highcharts-data-table caption {
			padding: 1em 0;
			font-size: 1.2em;
			color: #555;
		}

		.highcharts-data-table th {
			font-weight: 600;
			padding: 0.5em;
		}

		.highcharts-data-table td,
		.highcharts-data-table th,
		.highcharts-data-table caption {
			padding: 0.5em;
		}

		.highcharts-data-table thead tr,
		.highcharts-data-table tr:nth-child(even) {
			background: #f8f8f8;
		}

		.highcharts-data-table tr:hover {
			background: #f1f7ff;
		}
	</style>
</head>
<body>
	<header class="navbar navbar-dark bg-dark sticky-top">
		<button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar">
			<span class="navbar-toggler-icon"></span>
		</button>
		<a class="navbar-brand px-3" href="index.php">ADMINISTRATOR</a>
		<div class="navbar-nav">
			<div class="nav-item">
				<a class="nav-link px-3" href="logout.php" onclick="return confirm('Apakah anda yakin ingin keluar?')">
					<i class="bi bi-box-arrow-right"></i>
					Sign Out
				</a>
			</div>
		</div>
	</header>
	<div class="container-fluid">
		<div class="row">
			<nav id="sidebar" class="col-md-3 col-lg-2 bg-white position-fixed start-0 top-0 bottom-0 py-5 collapse d-md-block sidebar">
				<a href="profil_admin.php" class="text-decoration-none">
					<div class="container text-center pt-4">
						<span class="bi bi-person-circle display-5 text-dark"></span>
						<h6 class="pt-2 text-dark"><?php echo $admin["nama_admin"]; ?></h6>
					</div>
				</a>
				<div class="pt-3">
					<ul class="nav flex-column">
						<li class="nav-item">
							<a href="index.php" class="nav-link text-dark fw-bold"><span class="bi bi-speedometer"></span> Dashboard</a>
						</li>
						<!-- <li class="nav-item">
							<a href="profil_admin.php" class="nav-link text-dark fw-bold"><span class="bi bi-person-circle"></span> Profile</a>
						</li> -->

						<li class="nav-item">
							<a href="produk.php" class="nav-link text-dark fw-bold"><span class="bi bi-app-indicator"></span> Produk</a>
						</li>
						<li class="nav-item">
							<a href="kategori.php" class="nav-link text-dark fw-bold"><span class="bi bi-clipboard-check"></span> Kategori</a>
						</li>
						<li class="nav-item">
							<a href="pelanggan.php" class="nav-link text-dark fw-bold"><span class="bi bi-people"></span> Pelanggan</a>
						</li>
						<li class="nav-item">
							<a href="pembelian.php" class="nav-link text-dark fw-bold"><span class="bi bi-bag-check"></span> Pembelian</a>
						</li>
						<li class="nav-item">
							<a href="laporan_penjualan.php" class="nav-link text-dark fw-bold"><span class="bi bi-archive"></span> Laporan Penjualan</a>
						</li>
						<li class="nav-item">
							<a href="rekening.php" class="nav-link text-dark fw-bold"><span class="bi bi-currency-dollar"></span> Rekening</a>
						</li>
						<!-- <li class="nav-item">
							<a href="Chat.php" class="nav-link text-dark fw-bold"><span class="bi bi-chat"></span> chat</a>
						</li> -->
					</ul>
				</div>
			</nav>
		</div>
	</div>
	<main class="col-lg-10 col-md-9 ms-sm-auto px-sm-4 py-3 vh-100 bg-light">
		<div class="card">
			<div class="card-body">
