<?php 
include "header.php";

// Pastikan session pelanggan ada
if (!isset($_SESSION['pelanggan'])) {
	echo "<script>alert('Silahkan login terlebih dahulu!')</script>";
	echo "<script>location='../index.php'</script>";
	exit();
}

// Ambil data pelanggan dari session
$pelanggan = $_SESSION['pelanggan'];
$id_pelanggan = $pelanggan['id_pelanggan'];
?>
<div class="container">
	<h3>Profile</h3>
	<hr>
	<div class="row">
		<div class="col-md-6">
			<form method="post" enctype="multipart/form-data">
				<div class="mb-3">
					<label class="form-label">Username</label>
					<input type="text" class="form-control" name="username_pelanggan" value="<?php echo isset($pelanggan["username_pelanggan"]) ? $pelanggan["username_pelanggan"] : ''; ?>">
				</div>
				<div class="mb-3">
					<label class="form-label">Password</label>
					<input type="password" class="form-control" name="password_pelanggan">
					<i class="text-muted">*Kosongkan kolom password jika anda tidak ingin merubah password</i>
				</div>
				<div class="mb-3">
					<label class="form-label">Nama</label>
					<input type="text" class="form-control" name="nama_pelanggan" value="<?php echo isset($pelanggan["nama_pelanggan"]) ? $pelanggan["nama_pelanggan"] : ''; ?>">
				</div>
				<div class="mb-3">
					<label class="form-label">Jenis Kelamin</label>
					<select class="form-control" name="jk_pelanggan">
						<option value="">--Pilih Jenis Kelamin--</option>
						<option value="laki laki" <?php echo (isset($pelanggan["jk_pelanggan"]) && $pelanggan["jk_pelanggan"]=="laki laki") ? "selected" : ""; ?>>Laki-laki</option>
						<option value="perempuan" <?php echo (isset($pelanggan["jk_pelanggan"]) && $pelanggan["jk_pelanggan"]=="perempuan") ? "selected" : ""; ?>>Perempuan</option>
					</select>
				</div>
				<div class="mb-3">
					<label class="form-label">Alamat</label>
					<textarea class="form-control" name="alamat_pelanggan"><?php echo isset($pelanggan["alamat_pelanggan"]) ? $pelanggan["alamat_pelanggan"] : ''; ?></textarea>
				</div>
				<div class="mb-3">
					<label class="form-label">NIK</label>
					<input type="text" class="form-control" name="nik_pelanggan" value="<?php echo isset($pelanggan["nik_pelanggan"]) ? $pelanggan["nik_pelanggan"] : ''; ?>">
				</div>
				<div class="mb-3">
					<label class="form-label">HP</label>
					<input type="text" class="form-control" name="hp_pelanggan" value="<?php echo isset($pelanggan["hp_pelanggan"]) ? $pelanggan["hp_pelanggan"] : ''; ?>">
				</div>
				<div class="mb-3">
					<label class="form-label">Email</label>
					<input type="text" class="form-control" name="email_pelanggan" value="<?php echo isset($pelanggan["email_pelanggan"]) ? $pelanggan["email_pelanggan"] : ''; ?>">
				</div>
				<div class="mb-3">
					<button class="btn btn-primary" name="simpan">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php

if (isset($_POST["simpan"])) 
{
	$username = $_POST["username_pelanggan"];
	$password = sha1($_POST["password_pelanggan"]);
	$nama = $_POST["nama_pelanggan"];
	$jk = $_POST["jk_pelanggan"];
	$alamat = $_POST["alamat_pelanggan"];
	$nik = $_POST["nik_pelanggan"];
	$hp = $_POST["hp_pelanggan"];
	$email = $_POST["email_pelanggan"];

	
	//merubah data tanpa merubah password
	if (empty($password)) 
	{
		$koneksi -> query("UPDATE pelanggan SET
			username_pelanggan = '$username',
			nama_pelanggan = '$nama',
			jk_pelanggan = '$jk',
			alamat_pelanggan = '$alamat',
			nik_pelanggan = '$nik',
			hp_pelanggan = '$hp',
			email_pelanggan = '$email'  WHERE id_pelanggan = '$id_pelanggan'");
	}

	else
	{
		$koneksi -> query("UPDATE pelanggan SET
			username_pelanggan = '$username',
			password_pelanggan= '$password',
			nama_pelanggan = '$nama',
			jk_pelanggan = '$jk',
			alamat_pelanggan = '$alamat',
			nik_pelanggan = '$nik',
			hp_pelanggan = '$hp',
			email_pelanggan = '$email' WHERE id_pelanggan = '$id_pelanggan'");
	}
	

	echo "<script>alert('Berhasil mengubah data')</script>";
	echo "<script>location = 'profile.php'</script>";
} 
include "footer.php";
?>