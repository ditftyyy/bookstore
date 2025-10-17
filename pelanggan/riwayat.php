<?php 
include "header.php";
//menampilkan riwayat pembelian dari pelanggan yang login
$ambil_pembelian = $koneksi -> query("SELECT * FROM pembelian WHERE id_pelanggan = '$id_pelanggan'  ORDER BY id_pembelian DESC");
$pembelian = array();
while ($tiap_pembelian = $ambil_pembelian -> fetch_assoc()) 
{
	$pembelian[] = $tiap_pembelian;
}
?>
<style>
.order-history {
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
    padding: 3rem 0;
}
.order-history-header {
    text-align: center;
    margin-bottom: 3rem;
}
.order-history-title {
    font-family: 'Playfair Display', serif;
    color: var(--primary-color);
    font-size: 2.5rem;
    margin-bottom: 1rem;
}
.order-history-subtitle {
    color: #666;
    font-size: 1.1rem;
}
.order-table {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    overflow: hidden;
}
.order-table thead {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    color: white;
}
.order-table th {
    font-weight: 500;
    padding: 1.2rem;
    border: none;
}
.order-table td {
    padding: 1.2rem;
    vertical-align: middle;
    border-color: #f0f0f0;
}
.status-badge {
    padding: 0.5rem 1rem;
    border-radius: 25px;
    font-size: 0.85rem;
    font-weight: 500;
    text-transform: capitalize;
}
.status-pending {
    background: #fff3cd;
    color: #856404;
}
.status-lunas {
    background: #d4edda;
    color: #155724;
}
.status-kirim {
    background: #cce5ff;
    color: #004085;
}
.status-selesai {
    background: #d1e7dd;
    color: #0f5132;
}
.status-batal {
    background: #f8d7da;
    color: #721c24;
}
.action-btn {
    padding: 0.5rem 1rem;
    border-radius: 25px;
    font-size: 0.85rem;
    font-weight: 500;
    transition: all 0.3s ease;
    border: none;
    margin: 0.2rem;
}
.btn-detail {
    background: var(--primary-color);
    color: white;
}
.btn-detail:hover {
    background: var(--secondary-color);
    color: white;
    transform: translateY(-2px);
}
.btn-payment {
    background: #28a745;
    color: white;
}
.btn-payment:hover {
    background: #218838;
    color: white;
    transform: translateY(-2px);
}
.btn-shipping {
    background: #6c757d;
    color: white;
}
.btn-shipping:hover {
    background: #5a6268;
    color: white;
    transform: translateY(-2px);
}
.btn-review {
    background: #ffc107;
    color: #000;
}
.btn-review:hover {
    background: #e0a800;
    color: #000;
    transform: translateY(-2px);
}
.payment-info {
    background: #f8f9fa;
    padding: 0.5rem 1rem;
    border-radius: 5px;
    font-size: 0.9rem;
    color: #666;
}
@media (max-width: 768px) {
    .order-table {
        font-size: 0.9rem;
    }
    .action-btn {
        padding: 0.4rem 0.8rem;
        font-size: 0.8rem;
    }
}
</style>

<div class="order-history">
    <div class="container">
        <div class="order-history-header">
            <h1 class="order-history-title">Riwayat Pesanan</h1>
            <p class="order-history-subtitle">Lacak Pesanan Anda Dan Status Nya Saat Ini</p>
        </div>
        <div class="table-responsive">
            <table class="table order-table" id="testing">
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Tanggal</th>
                        <th>Pembayaran Jatuh Tempo</th>
                        <th>Total</th>
                        <th>Metode Pembayaran</th>
                        <th>Status</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pembelian as $key => $value): ?>
                        <tr>
                            <td>#<?php echo $value["id_pembelian"]; ?></td>
                            <td><?php echo date("d M Y, H:i",strtotime($value["tanggal_pembelian"])); ?></td>
                            <?php if ($value['metode_pembayaran']=="transfer"): ?>
                            <td><?php echo date("d M Y, H:i",strtotime($value["batas_pembayaran"])); ?></td>
                            <?php else: ?>
                            <td class="payment-info">Pay on delivery</td>
                            <?php endif ?>
                            <td>Rp <?php echo number_format($value["total_pembelian"]); ?></td>
                            <td><?php echo ucfirst($value["metode_pembayaran"]); ?></td>
                            <td>
                                <?php 
                                $status_class = '';
                                $status_label = '';
                                switch($value["status_pembelian"]) {
                                    case 'pending':
                                        $status_class = 'status-pending';
                                        $status_label = 'pending';
                                        break;
                                    case 'lunas':
                                        $status_class = 'status-lunas';
                                        $status_label = 'lunas';
                                        break;
                                    case 'kirim':
                                        $status_class = 'status-kirim';
                                        $status_label = 'dikirim';
                                        break;
                                    case 'selesai':
                                        $status_class = 'status-selesai';
                                        $status_label = 'selesai';
                                        break;
                                    case 'batal':
                                        $status_class = 'status-batal';
                                        $status_label = 'batal';
                                        break;
                                    default:
                                        $status_class = 'status-pending';
                                        $status_label = ucfirst($value["status_pembelian"]);
                                }
                                ?>
                                <span class="status-badge <?php echo $status_class; ?>">
                                    <?php echo $status_label; ?>
                                </span>
                            </td>
                            <td>
                                <a href="detail_pembelian.php?id=<?php echo $value["id_pembelian"]; ?>" class="action-btn btn-detail">
                                    <i class="bi bi-eye"></i> Detail
                                </a>

                                <?php 
                                $id_pembelian = $value["id_pembelian"];
                                $ambil_pembayaran = $koneksi -> query("SELECT * FROM pembayaran WHERE id_pembelian = '$id_pembelian'");
                                $pembayaran = $ambil_pembayaran -> fetch_assoc();

                                $ambil_pengiriman = $koneksi -> query("SELECT * FROM pengiriman WHERE id_pembelian= '$id_pembelian'");
                                $pengiriman = $ambil_pengiriman->fetch_assoc();

                                $ambil_detail = $koneksi -> query("SELECT * FROM pembelian_produk LEFT JOIN produk ON produk.id_produk = pembelian_produk.id_produk WHERE id_pembelian = '$id_pembelian'");
                                $produk = $ambil_detail->fetch_assoc();
                                ?>

                                <?php if ($value["status_pembelian"]=="batal" OR $value["status_pembelian"]=="selesai"): ?>
                                    <?php if ($value["status_pembelian"]=="selesai"): ?>
                                        <a href="testimoni.php?id=<?php echo $value['id_pembelian']; ?>" class="action-btn btn-review">
                                            <i class="bi bi-star"></i> Tinjauan
                                        </a>
                                    <?php endif ?>
                                <?php else: ?>
                                    <?php if (!isset($pembayaran)): ?>
                                        <a href="pembayaran.php?id=<?php echo $value["id_pembelian"]; ?>" class="action-btn btn-payment">
                                            <i class="bi bi-credit-card"></i> Bayar Sekarang
                                        </a>
                                    <?php else: ?>
                                        <a href="pembayaran.php?id=<?php echo $value["id_pembelian"]; ?>" class="action-btn btn-payment">
                                            <i class="bi bi-credit-card"></i> Pembayaran
                                        </a>
                                        <a href="pengiriman.php?id=<?php echo $value["id_pembelian"]; ?>" class="action-btn btn-shipping">
                                            <i class="bi bi-truck"></i> Pengiriman
                                        </a>
                                    <?php endif ?>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php 
include "footer.php";
?>