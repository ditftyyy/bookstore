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
	<style type="text/css">
		.hv:hover{
			background-color: #FFBD00;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg bg-success navbar-dark p-3">
		<div class="container">
			<img src="assets/file/logo.jpg" width="100"> &nbsp;
			<a href="index.php" class="navbar-brand fw-bold text-white">Aditya Nusa Syahputra</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#lorem" aria-controls="lorem" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="navbar-collapse collapse" id="lorem">
				<ul class="navbar-nav me-auto">
					<li class="nav-item hv">
						<a href="index.php" class="nav-link text-white fw-bold">Beranda</a>
					</li>
					<li class="nav-item hv">
						<a href="produk.php" class="nav-link text-white fw-bold">Produk</a>
					</li>
					<li class="nav-item dropdown hv">
						<a class="nav-link dropdown-toggle text-white fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Kategori
						</a>
						<ul class="dropdown-menu">
							<?php foreach ($kategori as $kt => $vt): ?>
								<li><a class="dropdown-item" href="produk.php?idk=<?php echo $vt["id_kategori"]; ?>"><?php echo $vt["nama_kategori"]; ?></a></li>
							<?php endforeach ?>
						</ul>
					</li>
					<form class="d-flex text-center ms-2" role="search">
						<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="cari">
						<button name="tombol" class="btn btn-transparent" style="background: white; border: #7B68EE;" type="submit">
							<span class="bi bi-search fw-bold" style="color: green;"></span>
						</button>
					</form>
					<?php 
					if(isset($_GET['tombol'])){
						$cari = $_GET['cari'];
					}
					?>
				</ul>
				<ul class="navbar-nav">
					<li class="nav-item hv">
						<a type="button" class="nav-link fw-bold text-white" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
							Login
						</a>
						<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<h3 class="text-center">Aditya Nusa Syahputra</h3>
										<form method="post">
											<div class="mb-3">
												<label class="form-label fw-bold">USERNAME</label>
												<input type="text" class="form-control" name="username_login" placeholder="Masukkan username anda disini...">
											</div>
											<div class="mb-3">
												<label class="form-label fw-bold">PASSWORD</label>
												<input type="password" class="form-control" name="password_login" placeholder="Masukkan password anda disini...">
											</div>
											<div class="mb-3 text-center">
												<button class="btn btn-primary" name="masuk">MASUK</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li class="nav-item hv">
						<a type="button" class="nav-link fw-bold text-white" data-bs-toggle="modal" data-bs-target="#daftar">
							Daftar
						</a>
						<div class="modal fade" id="daftar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<h3 class="text-center">Buat Akun</h3>
										<form method="post" enctype="multipart/form-data">
											<div class="mb-3">
												<label class="form-label fw-bold">USERNAME</label>
												<input type="text" class="form-control" name="username_pelanggan" placeholder="Masukkan username anda disini..." required>
											</div>
											<div class="mb-3">
												<label class="form-label fw-bold">PASSWORD</label>
												<input type="password" class="form-control" name="password_pelanggan" placeholder="Masukkan password anda disini..." required>
											</div>
											<div class="mb-3">
												<label class="form-label fw-bold">NAMA</label>
												<input type="text" class="form-control" name="nama_pelanggan" placeholder="Masukkan nama anda disini..." required>
											</div>
											<div class="mb-3">
												<label class="form-label fw-bold">JENIS KELAMIN</label>
												<select class="form-control" name="jk_pelanggan" required>
													<option value="">--Pilih Gender--</option>
													<option value="laki laki">Laki laki</option>
													<option value="perempuan">Perempuan</option>
												</select>
											</div>
											<div class="mb-3">
												<label class="form-label fw-bold">Alamat</label>
												<textarea type="text" class="form-control" name="alamat_pelanggan" placeholder="Masukkan alamat anda disini..." required></textarea>
											</div>
											<div class="mb-3">
												<label class="form-label fw-bold">NO HP</label>
												<input type="text" class="form-control" name="hp_pelanggan" placeholder="Masukkan no hp anda disini..." required>
											</div>
											<div class="mb-3">
												<label class="form-label fw-bold">EMAIL</label>
												<input type="email" class="form-control" name="email_pelanggan" placeholder="Masukkan email anda disini..." required>
											</div>
											<div class="mb-3 text-center">
												<button class="btn btn-primary" name="daftar">DAFTAR</button>
											</div>
										</form>
										<?php 
										if (isset($_POST["daftar"])) 
										{
											//jika ada username yang sudah terdaftar (memiliki jumlah data lebih dari 1) maka tidak boleh di input
											$username = $_POST["username_pelanggan"];
											$ap = $koneksi -> query("SELECT * FROM pelanggan WHERE username_pelanggan = '$username'");
											$cek_ap = $ap->num_rows;
											if ($cek_ap==1) 
											{
												echo "<script>alert('Username sudah terdaftar silahkan coba yang lain')</script>";
											}

											else
											{
												$password = sha1($_POST["password_pelanggan"]);
												$nama = $_POST["nama_pelanggan"];
												$jk = $_POST["jk_pelanggan"];
												$alamat = $_POST["alamat_pelanggan"];
												$nik = $_POST["nik_pelanggan"];
												$hp = $_POST["hp_pelanggan"];
												$email = $_POST["email_pelanggan"];
											
												$koneksi -> query("INSERT INTO pelanggan(username_pelanggan,password_pelanggan,nama_pelanggan,jk_pelanggan,alamat_pelanggan,nik_pelanggan,hp_pelanggan,email_pelanggan) VALUES('$username','$password','$nama','$jk','$alamat','$nik','$hp','$email')");
												echo "<script>alert('Akun berhasil dibuat,silahkan login')</script>";
											}		
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="min-vh-100">