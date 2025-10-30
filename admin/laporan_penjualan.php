<?php 
include "header.php";
// Logic: jika filter diisi dan tombol lihat diklik, pakai filter. Jika tidak, tampilkan semua data.
if (isset($_POST["lihat"])) {
    $mulai = $_POST["dari_tanggal"];
    $selesai = $_POST["sampai_tanggal"];
    $filter_aktif = true;
} else {
    $mulai = "";
    $selesai = "";
    $filter_aktif = false;
}
$ambil_produk = $koneksi -> query("SELECT * FROM produk");
$produk = array();
while($data_detail = $ambil_produk->fetch_assoc())
{
    $produk[] = $data_detail;
}
// Hitung total produk terjual & grand total
$total_terjual = 0;
$grandtotal = 0;
$produk_terlaris = null;
$max_jumlah = 0;
$produk_data = array();
foreach ($produk as $key => $value) {
    $id_produk = $value['id_produk'];
    if ($filter_aktif && $mulai && $selesai) {
        $detail = $koneksi->query("SELECT SUM(pembelian_produk.jumlah_beli) as jml, SUM(harga_beli) as total FROM pembelian_produk LEFT JOIN pembelian ON pembelian.id_pembelian = pembelian_produk.id_pembelian WHERE id_produk='$id_produk' AND tanggal_pembelian BETWEEN DATE('$mulai') AND DATE('$selesai')")->fetch_assoc();
    } else {
        $detail = $koneksi->query("SELECT SUM(pembelian_produk.jumlah_beli) as jml, SUM(harga_beli) as total FROM pembelian_produk LEFT JOIN pembelian ON pembelian.id_pembelian = pembelian_produk.id_pembelian WHERE id_produk='$id_produk'")->fetch_assoc();
    }
    $jumlah = $detail['jml'] ?? 0;
    $total = $detail['total'] ?? 0;
    $total_terjual += $jumlah;
    $grandtotal += $total;
    $produk_data[] = array(
        'nama_produk' => $value['nama_produk'],
        'jumlah' => $jumlah,
        'total' => $total
    );
    if ($jumlah > $max_jumlah) {
        $max_jumlah = $jumlah;
        $produk_terlaris = $value['nama_produk'];
    }
}
usort($produk_data, function($a, $b) { return $b['jumlah'] - $a['jumlah']; });
$top5 = array_slice($produk_data, 0, 5);
?>
<style>
.laporan-filter-card {
  background: #fff;
  border-radius: 15px;
  box-shadow: 0 4px 24px rgba(44,62,80,0.08);
  padding: 1.5rem 2rem;
  margin-bottom: 2rem;
  max-width: 500px;
}
.laporan-summary {
  display: flex;
  gap: 2rem;
  margin-bottom: 2rem;
  flex-wrap: wrap;
}
.laporan-summary .summary-card {
  background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);
  color: #fff;
  border-radius: 16px;
  padding: 1.5rem 2rem;
  min-width: 220px;
  box-shadow: 0 4px 24px rgba(44,62,80,0.10);
  flex: 1;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  margin-bottom: 1rem;
}
.laporan-summary .summary-title {
  font-size: 1.1rem;
  opacity: 0.8;
  margin-bottom: 0.5rem;
}
.laporan-summary .summary-value {
  font-size: 2rem;
  font-weight: bold;
}
.laporan-summary .summary-badge {
  background: #C0392B;
  color: #fff;
  border-radius: 12px;
  padding: 0.3rem 1rem;
  font-size: 1rem;
  margin-top: 0.5rem;
}
.table-modern {
  background: #fff;
  border-radius: 15px;
  box-shadow: 0 4px 24px rgba(44,62,80,0.08);
  overflow: hidden;
}
.table-modern th {
  background: linear-gradient(135deg, #2C3E50 0%, #34495E 100%);
  color: #fff;
  border: none;
  text-align: center;
}
.table-modern td {
  vertical-align: middle;
  text-align: center;
}
.progress-bar {
  height: 18px;
  background: #C0392B;
  border-radius: 10px;
  transition: width 0.5s;
}
.progress-bg {
  background: #f0f0f0;
  border-radius: 10px;
  height: 18px;
  width: 100%;
}
@media (max-width: 768px) {
  .laporan-summary { flex-direction: column; gap: 1rem; }
  .laporan-filter-card { padding: 1rem; }
}
</style>
<h4>LAPORAN PENJUALAN</h4>
<hr>
<div class="laporan-filter-card mb-4">
  <form method="post" class="row g-3 align-items-end">
    <div class="col-md-5 col-12">
      <label class="form-label">Dari</label>
      <input type="date" name="dari_tanggal" class="form-control" value="<?php echo $mulai ?>">
    </div>
    <div class="col-md-5 col-12">
      <label class="form-label">Sampai</label>
      <input type="date" name="sampai_tanggal" class="form-control" value="<?php echo $selesai ?>">
    </div>
    <div class="col-md-2 col-12">
      <button class="btn btn-primary w-200" name="lihat" style="margin-top:1.7rem;">Lihat</button>
    </div>
  </form>
</div>
<div class="laporan-summary">
  <div class="summary-card">
    <div class="summary-title">Total Produk Terjual</div>
    <div class="summary-value"><?php echo $total_terjual; ?></div>
  </div>
  <div class="summary-card">
    <div class="summary-title">Total Penjualan</div>
    <div class="summary-value">Rp <?php echo number_format($grandtotal); ?></div>
  </div>
  <div class="summary-card">
    <div class="summary-title">Produk Terlaris</div>
    <div class="summary-value"><?php echo $produk_terlaris ? $produk_terlaris : '-'; ?></div>
    <?php if ($produk_terlaris): ?><span class="summary-badge">Terlaris</span><?php endif; ?>
  </div>
</div>
<div class="row mb-4">
  <div class="col-md-7 mb-4">
    <div class="table-responsive">
      <table id="thetable" class="table table-bordered table-hover table-modern">
        <thead class="text-center">
          <tr>
            <th>No</th>
            <th>Produk</th>
            <th>Jumlah Terjual</th>
            <th>Subtotal</th>
            <th>Persentase</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($produk_data as $key => $value): ?>
          <?php $persen = $total_terjual > 0 ? round(($value['jumlah']/$total_terjual)*100,1) : 0; ?>
          <tr<?php if ($value['nama_produk'] == $produk_terlaris && $produk_terlaris): ?> style="background:#f9f6f2;font-weight:bold;"<?php endif; ?>>
            <td><?php echo $key+1; ?></td>
            <td><?php echo $value["nama_produk"]; ?></td>
            <td><?php echo $value["jumlah"]; ?></td>
            <td>Rp. <?php echo number_format($value["total"]); ?></td>
            <td>
              <div class="progress-bg">
                <div class="progress-bar" style="width:<?php echo $persen; ?>%"></div>
              </div>
              <span style="font-size:0.95em;"> <?php echo $persen; ?>%</span>
            </td>
          </tr>
          <?php endforeach ?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="3">Grand Total</th>
            <th colspan="2">Rp. <?php echo number_format($grandtotal); ?></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
  <div class="col-md-5 mb-4">
    <div id="bar-top5" style="height:350px;"></div>
  </div>
</div>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
Highcharts.chart('bar-top5', {
    chart: { type: 'bar' },
    title: { text: 'Top 5 Produk Terlaris' },
    xAxis: {
        categories: [<?php echo implode(',', array_map(function($v){return "'".$v['nama_produk']."'";}, $top5)); ?>],
        title: { text: null }
    },
    yAxis: {
        min: 0,
        title: { text: 'Jumlah Terjual', align: 'high' },
        labels: { overflow: 'justify' }
    },
    tooltip: { valueSuffix: ' buku' },
    plotOptions: { bar: { dataLabels: { enabled: true } } },
    credits: { enabled: false },
    series: [{
        name: 'Terjual',
        data: [<?php echo implode(',', array_map(function($v){return $v['jumlah'];}, $top5)); ?>]
    }]
});
</script>
