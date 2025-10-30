<?php 
include "header.php";
//mengambil id 
$id_rekening = $_GET["id"];

//mengambil data rekening yang id nya itu
$ambil_rekening = $koneksi -> query("SELECT * FROM rekening WHERE id_rekening = '$id_rekening'");
$rekening = $ambil_rekening -> fetch_assoc();
?>
<h3>Ubah Rekening</h3>
<hr>
<div class="row">
	<div class="col-md-6">
		<form method="post">
			<div class="mb-3">
				<label class="form-label">Bank</label>
				<input type="text" class="form-control" name="bank_rekening" value="<?php echo $rekening["bank_rekening"] ?>">
			</div>
			<div class="mb-3">
				<label class="form-label">No Rekening</label>
				<input type="text" class="form-control" name="nomor_rekening" value="<?php echo $rekening["nomor_rekening"]; ?>">
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
	$nomor_rekening = $_POST["nomor_rekening"];
	$bank_rekening = $_POST["bank_rekening"];

	$koneksi -> query("UPDATE rekening SET 
		bank_rekening = '$bank_rekening',
		nomor_rekening = '$nomor_rekening' WHERE id_rekening = '$id_rekening'");

	echo "<script>alert('Berhasil mengubah data')</script>";
	echo "<script>location = 'rekening.php'</script>";
}
include "footer.php";
?>