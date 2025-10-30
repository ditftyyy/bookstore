<?php 
include "header.php";
?>
<h3>Tambah Rekening</h3>
<hr>
<div class="row">
	<div class="col-md-6">
		<form method="post">
			<div class="mb-3">
				<label class="form-label">Bank</label>
				<input type="text" class="form-control" name="bank_rekening">
			</div>
			<div class="mb-3">
				<label class="form-label">No Rekening</label>
				<input type="text" class="form-control" name="nomor_rekening">
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

	$koneksi -> query("INSERT INTO rekening(nomor_rekening,bank_rekening) VALUES('$nomor_rekening','$bank_rekening')");

	echo "<script>alert('Berhasil menambah data')</script>";
	echo "<script>location = 'rekening.php'</script>";
}
include "footer.php";
?>