<?php 
//memanggil file koneksi
include "../koneksi.php";

//dapatkan id dari url
$id_produk = $_GET["id"];

//skrip hapus data
$koneksi -> query("DELETE FROM produk WHERE id_produk = '$id_produk'");

echo "<script>alert('Berhasil menghapus data')</script>";
echo "<script>location = 'produk.php'</script>";

?>