<?php 
include "header.php";
//mengambil data kategori
$kategori = array();
$ambil_kategori = $koneksi -> query("SELECT * FROM kategori");
while ($tiap_kategori = $ambil_kategori -> fetch_assoc()) 
{
	$kategori [] = $tiap_kategori;
}
?>
<h3>Tambah Kategori</h3>
<hr>
<div class="row">
	<div class="col-md-6">
		<form method="post">
			<div class="mb-3">
				<label class="form-label">Nama</label>
				<input type="text" class="form-control" name="nama_kategori">
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
	$nama_kategori = $_POST["nama_kategori"];

	$koneksi -> query("INSERT INTO kategori(nama_kategori) VALUES('$nama_kategori')");

	echo "<script>alert('Berhasil menambah data')</script>";
	echo "<script>location = 'kategori.php'</script>";
}
include "footer.php";
?>