<?php 
include "../koneksi.php";

$id_kategori = $_GET["id"];

$koneksi -> query("DELETE FROM kategori WHERE id_kategori = '$id_kategori'");

echo "<script>alert('Berhasil menghapus data')</script>";
echo "<script>location = 'kategori.php'</script>";

?>