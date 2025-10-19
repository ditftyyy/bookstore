<?php 
include "header.php";
//mengambil data produk
$produk = array();
$ambil_produk = $koneksi -> query("SELECT * FROM produk LEFT JOIN kategori ON kategori.id_kategori = produk.id_kategori");
while ($tiap_produk = $ambil_produk -> fetch_assoc()) 
{
	$produk [] = $tiap_produk;
}
//mengambil data pelanggan
$pelanggan = array();
$ambil_pelanggan = $koneksi -> query("SELECT * FROM pelanggan");
while ($tiap_pelanggan = $ambil_pelanggan -> fetch_assoc()) 
{
	$pelanggan [] = $tiap_pelanggan;
}
//mengambil data pembelian
$ambil_p = $koneksi -> query("SELECT * FROM pembelian LEFT JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan");
$pembelian = array();
while ($tiap_p = $ambil_p -> fetch_assoc()) 
{
	$pembelian[] = $tiap_p;
}
//mengambil total jumlah data dari tabel produk , pelanggan , pembelian
$jp = count($produk);
$jl = count($pelanggan);
$jj = count($pembelian);
// kategori
$kat = $koneksi -> query("SELECT * FROM kategori");
$jk = mysqli_num_rows($kat);
// penjualan bulan ini
$bulan_ini = date('m');
$tahun_ini = date('Y');
$penjualan_bulan_ini = $koneksi->query("SELECT COUNT(*) as total FROM pembelian WHERE MONTH(tanggal_pembelian)='$bulan_ini' AND YEAR(tanggal_pembelian)='$tahun_ini'")->fetch_assoc()["total"];
// produk stok habis
$stok_habis = $koneksi->query("SELECT COUNT(*) as total FROM produk WHERE stok_produk <= 0")->fetch_assoc()["total"];
// 5 transaksi terakhir
$transaksi_terbaru = $koneksi->query("SELECT * FROM pembelian LEFT JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan ORDER BY id_pembelian DESC LIMIT 5");
// kategori terlaris (pie chart)
$kategori_terlaris = $koneksi->query("SELECT kategori.nama_kategori, SUM(pembelian_produk.jumlah_beli) as total FROM pembelian_produk LEFT JOIN produk ON produk.id_produk = pembelian_produk.id_produk LEFT JOIN kategori ON kategori.id_kategori = produk.id_kategori GROUP BY kategori.id_kategori ORDER BY total DESC");
// grafik penjualan per kategori per bulan
$tahun = date("Y");
$bulan = ['01' => "Januari",'02' => "Februari",'03' => "Maret",'04' => "April",'05' => "Mei",'06' => "Juni",'07' => "Juli",'08' => "Agustus",'09' => "September",'10' => "Oktober",'11' => "November",'12' => "Desember"];
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
?>
<style>
.admin-welcome {
  background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);
  color: #fff;
  border-radius: 18px;
  padding: 2rem 2.5rem;
  margin-bottom: 2rem;
  box-shadow: 0 8px 32px rgba(44,62,80,0.12);
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.admin-welcome .admin-avatar {
  width: 70px;
  height: 70px;
  border-radius: 50%;
  background: #fff;
  color: #2C3E50;
  font-size: 2.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
  margin-right: 1.5rem;
}
.admin-welcome .welcome-text {
  flex: 1;
}
.admin-welcome .quick-actions a {
  margin: 0 0.5rem;
  padding: 0.7rem 1.3rem;
  border-radius: 25px;
  background: #C0392B;
  color: #fff;
  font-weight: 500;
  text-decoration: none;
  transition: background 0.2s;
}
.admin-welcome .quick-actions a:hover {
  background: #B8860B;
  color: #fff;
}
.stat-card {
  border-radius: 18px;
  box-shadow: 0 4px 24px rgba(44,62,80,0.08);
  padding: 2rem 1.5rem;
  background: #fff;
  margin-bottom: 1.5rem;
  transition: transform 0.2s;
}
.stat-card:hover {
  transform: translateY(-4px) scale(1.03);
  box-shadow: 0 8px 32px rgba(44,62,80,0.12);
}
.stat-card .stat-title {
  font-size: 1.1rem;
  color: #34495E;
  margin-bottom: 0.5rem;
  font-weight: 500;
}
.stat-card .stat-value {
  font-size: 2.2rem;
  font-weight: bold;
  color: #2C3E50;
}
.stat-card .stat-icon {
  font-size: 2.5rem;
  color: #C0392B;
  margin-bottom: 0.5rem;
}
.table-transaksi {
  background: #fff;
  border-radius: 15px;
  box-shadow: 0 4px 24px rgba(44,62,80,0.08);
  overflow: hidden;
}
.table-transaksi th {
  background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);
  color: #fff;
  border: none;
}
.table-transaksi td {
  vertical-align: middle;
}
.badge-status {
  padding: 0.4em 1em;
  border-radius: 20px;
  font-size: 0.9em;
  font-weight: 500;
  text-transform: capitalize;
}
.badge-pending { background: #fff3cd; color: #856404; }
.badge-lunas { background: #d4edda; color: #155724; }
.badge-kirim { background: #cce5ff; color: #004085; }
.badge-selesai { background: #d1e7dd; color: #0f5132; }
.badge-batal { background: #f8d7da; color: #721c24; }
.stat-title-nowrap {
  white-space: nowrap;
}
</style>
<div class="admin-welcome">
  <div class="admin-avatar"><?php echo strtoupper(substr($admin["nama_admin"],0,1)); ?></div>
  <div class="welcome-text">
    <h2>Selamat datang, <b><?php echo $admin["nama_admin"]; ?></b></h2>
    <div style="font-size:1.1rem;opacity:0.8;">Kelola toko buku dengan mudah. <span style="font-style:italic;">"Membaca adalah jendela dunia."</span></div>
  </div>
  <div class="quick-actions">
    <a href="tambah_produk.php">+ Tambah Produk</a>
    <a href="produk.php">Kelola Produk</a>
    <a href="pembelian.php">Data Penjualan</a>
  </div>
</div>
<div class="row mb-4">
  <div class="col-md-2 col-6">
    <div class="stat-card text-center">
      <div class="stat-icon"><i class="bi bi-book"></i></div>
      <div class="stat-title">Total Produk</div>
      <div class="stat-value"><?php echo $jp; ?></div>
    </div>
  </div>
  <div class="col-md-2 col-6">
    <div class="stat-card text-center">
      <div class="stat-icon"><i class="bi bi-people"></i></div>
      <div class="stat-title">Total Pelanggan</div>
      <div class="stat-value"><?php echo $jl; ?></div>
    </div>
  </div>
  <div class="col-md-2 col-6">
    <div class="stat-card text-center">
      <div class="stat-icon"><i class="bi bi-bag-check"></i></div>
      <div class="stat-title">Total Penjualan</div>
      <div class="stat-value"><?php echo $jj; ?></div>
    </div>
  </div>
  <div class="col-md-2 col-6">
    <div class="stat-card text-center">
      <div class="stat-icon"><i class="bi bi-tags"></i></div>
      <div class="stat-title">Total Kategori</div>
      <div class="stat-value"><?php echo $jk; ?></div>
    </div>
  </div>
  <div class="col-md-2 col-6 ">
    <div class="stat-card text-center">
      <div class="stat-icon"><i class="bi bi-calendar-event"></i></div>
      <div class="stat-title stat-title-nowrap">Penj. Bulan Ini</div>
      <div class="stat-value"><?php echo $penjualan_bulan_ini; ?></div>
    </div>
  </div>
  <!-- <div class="col-md-2 col-6">
    <div class="stat-card text-center">
      <div class="stat-icon"><i class="bi bi-exclamation-triangle"></i></div>
      <div class="stat-title">Stok Habis</div>
      <div class="stat-value"><?php echo $stok_habis; ?></div>
    </div>
  </div> -->
</div>
<div class="row mb-4">
  <div class="col-md-7 mb-4">
    <div class="table-responsive">
      <table class="table table-transaksi">
        <thead>
          <tr>
            <th>#</th>
            <th>Pelanggan</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; while($trx = $transaksi_terbaru->fetch_assoc()): ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $trx["nama_pelanggan"]; ?></td>
            <td><?php echo date("d M Y, H:i",strtotime($trx["tanggal_pembelian"])); ?></td>
            <td>Rp <?php echo number_format($trx["total_pembelian"]); ?></td>
            <td><span class="badge-status badge-<?php echo $trx["status_pembelian"]; ?>"><?php echo $trx["status_pembelian"]; ?></span></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-md-5 mb-4">
    <div id="pie-kategori" style="height:350px;"></div>
  </div>
</div>
<figure class="highcharts-figure">
	<div id="container"></div>
</figure>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
Highcharts.chart('pie-kategori', {
    chart: { type: 'pie' },
    title: { text: 'Kategori Terlaris' },
    tooltip: { pointFormat: '{series.name}: <b>{point.y} buku</b>' },
    accessibility: { point: { valueSuffix: 'buku' } },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: { enabled: true, format: '<b>{point.name}</b>: {point.y}' }
        }
    },
    series: [{
        name: 'Terjual',
        colorByPoint: true,
        data: [
            <?php $pieData = array(); while($row = $kategori_terlaris->fetch_assoc()): ?>
            <?php $pieData[] = "{ name: '" . $row["nama_kategori"] . "', y: " . ($row["total"] ? $row["total"] : 0) . " }"; ?>
            <?php endwhile; ?>
            <?php echo implode(",\n", $pieData); ?>
        ]
    }]
});
Highcharts.chart('container', {
	chart: { type: 'column' },
	title: { text: 'Grafik Penjualan' },
	xAxis: {
		categories: [ 'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec' ],
		crosshair: true
	},
	yAxis: {
		min: 0,
		title: { text: 'Jumlah Produk (buah)' }
	},
	tooltip: {
		headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
		pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
		'<td style="padding:0"><b>{point.y:.1f} buah</b></td></tr>',
		footerFormat: '</table>',
		shared: true,
		useHTML: true
	},
	plotOptions: {
		column: { pointPadding: 0.2, borderWidth: 0 }
	},
	series: [
	<?php $series = array(); foreach ($ktg as $key => $value) {
    $series[] = "{name: '" . $value["nama_kategori"] . "',data: [" . implode(',', $value['laporan']) . "]}";
  }
  echo implode(",\n", $series);
  ?>
  ]
});
</script>
<?php 
include "footer.php";
?>