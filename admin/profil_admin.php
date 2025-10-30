<?php 
include "header.php";
?>
<h3>Profile Admin</h3>
<hr>
<div class="row">
	<div class="col-md-6">
		<form method="post">
			<div class="mb-3">
				<label class="form-label">USERNAME</label>
				<input type="text" class="form-control" name="username_admin" required="required" value="<?php echo $admin["username_admin"]; ?>">
			</div>
			<div class="mb-3">
				<label class="form-label">PASSSWORD</label>
				<input type="password" class="form-control" name="password_admin">
				<i class="text-muted">*Kosongkan kolom password jika anda tidak ingin merubah password</i>
			</div>
			<div class="mb-3">
				<label class="form-label">NAMA</label>
				<input type="text" class="form-control" name="nama_admin" required="required" value="<?php echo $admin["nama_admin"]; ?>">
			</div>
			<div class="mb-3">
				<button class="btn btn-primary" name="simpan">SIMPAN</button>
			</div>
		</form>
	</div>
</div>
<?php 
if (isset($_POST["simpan"])) 
{	
	//mendapatkan data inputan dari formulir
	$username = $_POST["username_admin"];
	$password = sha1($_POST["password_admin"]);
	$nama = $_POST["nama_admin"];

	//kondisi 1 merubah data tanpa merubah password
	if (empty($password)) 
	{
		$koneksi -> query("UPDATE admin SET 
			username_admin = '$username',
			nama_admin = '$nama' WHERE id_admin = '$id_admin'");
	}

	else
	{
		$koneksi -> query("UPDATE admin SET 
			username_admin = '$username',
			password_admin = '$password',
			nama_admin = '$nama' WHERE id_admin = '$id_admin'");
	}
	echo "<script>alert('Berhasil merubah data')</script>";
	echo "<script>location = 'profil_admin.php'</script>";
}

include "footer.php";
?>