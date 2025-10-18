<?php 
include "../koneksi.php";
session_destroy();

echo "<script>alert('Logout berhasil,terimakasih')</script>";
echo "<script>location = '../index.php'</script>";
?>