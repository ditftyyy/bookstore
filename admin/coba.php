<?php 
include "header.php";
$tahun = date("Y");
$bulan['01'] = "Januari";
$bulan['02'] = "Februari";
$bulan['03'] = "Maret";
$bulan['04'] = "April";
$bulan['05'] = "Mei";
$bulan['06'] = "Juni";
$bulan['07'] = "Juli";
$bulan['08'] = "Agustus";
$bulan['09'] = "September";
$bulan['10'] = "Oktober";
$bulan['11'] = "November";
$bulan['12'] = "Desember";

$kat = $koneksi -> query("SELECT * FROM kategori");
$ktg = array();
while ($tiap_ktg = $kat->fetch_assoc())
{
	$id_ktg = $tiap_ktg['id_kategori'];
	foreach ($bulan as $nobul => $nabul) {
		$ambil = $koneksi -> query("SELECT SUM(jumlah_beli) FROM `pembelian_produk` LEFT JOIN pembelian ON pembelian.id_pembelian = pembelian_produk.id_pembelian LEFT JOIN produk ON produk.id_produk = pembelian_produk.id_produk LEFT JOIN kategori ON kategori.id_kategori = produk.id_kategori WHERE kategori.id_kategori = $id_ktg AND MONTH(tanggal_pembelian) = '$nobul' AND YEAR(tanggal_pembelian) = '$tahun'");
		$pecah = $ambil->fetch_assoc();
		$jumlah = $pecah['SUM(jumlah_beli)'];

		if (empty($jumlah)) 
		{
			$jumlah = 0;
		}
		$tiap_ktg['laporan'] [$nabul] = $jumlah;

	}
	$ktg[] = $tiap_ktg;

}
echo "<pre>";
print_r($ktg);
echo "</pre>";
?>

<?php 
include "footer.php";
?>