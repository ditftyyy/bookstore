<?php 
include "header.php";
//mengambil id 
$id_kategori = $_GET["id"];

//mengambil data kategori yang id nya itu
$ambil_kategori = $koneksi -> query("SELECT * FROM kategori WHERE id_kategori = '$id_kategori'");
$kategori = $ambil_kategori -> fetch_assoc();
?>
<h3>Ubah Kategori</h3>
<hr>
<div class="row">
	<div class="col-md-6">
		<form method="post">
			<div class="mb-3">
				<label class="form-label">Nama Kategori</label>
				<input type="text" class="form-control" name="nama_kategori" value="<?php echo $kategori["nama_kategori"]; ?>">
			</div>
			<div class="mb-3">
				<button class="btn btn-primary" name="simpan">Simpan</button>
			</div>
		</form>
	</div>
</div>
<?php 

if (isset($_POST["simpan"])) 
{
	$nama = $_POST["nama_kategori"];

	$koneksi -> query("UPDATE kategori SET 
		nama_kategori = '$nama' WHERE id_kategori = '$id_kategori'");

	echo "<script>alert('Berhasil mengubah data')</script>";
	echo "<script>location = 'kategori.php'</script>";
}
include "footer.php";
?>