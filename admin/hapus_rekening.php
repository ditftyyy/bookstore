<?php 
include "../koneksi.php";

$id_rekening = $_GET["id"];

$koneksi -> query("DELETE FROM rekening WHERE id_rekening = '$id_rekening'");

echo "<script>alert('Berhasil menghapus data')</script>";
echo "<script>location = 'rekening.php'</script>";

?>