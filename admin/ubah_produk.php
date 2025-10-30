<?php 
include "header.php";
//mengambil id 
$id_produk = $_GET["id"];

//mengambil data produk yang id nya itu
$ambil_produk = $koneksi -> query("SELECT * FROM produk WHERE id_produk = '$id_produk'");
$produk = $ambil_produk -> fetch_assoc();

//mengambil data kategori
$kategori = array();
$ambil_kategori = $koneksi -> query("SELECT * FROM kategori");
while ($tiap_kategori = $ambil_kategori -> fetch_assoc()) 
{
	$kategori [] = $tiap_kategori;
}
?>
<h3>Ubah Produk</h3>
<hr>
<div class="row">
	<div class="col-md-6">
		<form method="post" enctype="multipart/form-data">
			<div class="mb-3">
				<label class="form-label">Kategori</label>
				<select class="form-control" name="id_kategori">
					<option value="">--Pilih Kategori--</option>
					<?php foreach ($kategori as $key => $value): ?>
						<option value="<?php echo $value["id_kategori"]; ?>" <?php if($value["id_kategori"]==$produk["id_kategori"]){echo "selected";} ?>  ><?php echo $value["nama_kategori"]; ?></option>
					<?php endforeach ?>
				</select>
			</div>
			<div class="mb-3">
				<label class="form-label">Nama Produk</label>
				<input type="text" class="form-control" name="nama_produk" value="<?php echo $produk["nama_produk"]; ?>">
			</div>
			<div class="mb-3">
				<label class="form-label">Harga</label>
				<input type="number" class="form-control" name="harga_produk" value="<?php echo $produk["harga_produk"]; ?>">
			</div>
			<div class="mb-3">
				<label class="form-label">Deskripsi</label>
				<textarea class="form-control" name="deskripsi_produk"><?php echo $produk["deskripsi_produk"]; ?></textarea>
			</div>
			<div class="mb-3">
				<label class="form-label">Stok</label>
				<input type="number" class="form-control" name="stok_produk" value="<?php echo $produk["stok_produk"]; ?>">
			</div>
			<div class="mb-3">
				<label class="form-label">Berat</label>
				<input type="number" class="form-control" name="berat_produk" value="<?php echo $produk["berat_produk"]; ?>">
			</div>
			<div class="mb-3">
				<label class="form-label">Foto</label>
				<img src="../assets/file/<?php echo $produk["foto_produk"]; ?>" width="100" class="mb-1">
				<input type="file" class="form-control" name="foto_produk" value="<?php echo $produk["foto_produk"]; ?>">
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
	$id_kategori = $_POST["id_kategori"];
	$nama = $_POST["nama_produk"];
	$harga = $_POST["harga_produk"];
	$deskripsi = $_POST["deskripsi_produk"];
	$stok = $_POST["stok_produk"];
	$berat = $_POST["berat_produk"];
	$foto = $_FILES["foto_produk"] ["name"];
	$file = $_FILES["foto_produk"]["tmp_name"];
	$waktu = date("YmdHis");
	$upload = $waktu.$foto;

	
	//merubah data tanpa merubah file
	if (empty($file)) 
	{
		$koneksi -> query("UPDATE produk SET 
			id_kategori = '$id_kategori',
			nama_produk = '$nama',
			harga_produk = '$harga',
			deskripsi_produk = '$deskripsi',
			stok_produk = '$stok',
			berat_produk = '$berat' WHERE id_produk = '$id_produk'");
	}

	//merubah data sekaligus merubah file
	else
	{
		$koneksi -> query("UPDATE produk SET 
			id_kategori = '$id_kategori',
			nama_produk = '$nama',
			harga_produk = '$harga',
			deskripsi_produk = '$deskripsi',
			stok_produk = '$stok',
			berat_produk = '$berat',
			foto_produk = '$upload' WHERE id_produk = '$id_produk'");
		move_uploaded_file($file, "../assets/file/$upload");
	}

	echo "<script>alert('Berhasil mengubah data')</script>";
	echo "<script>location = 'produk.php'</script>";
}
include "footer.php";
?>