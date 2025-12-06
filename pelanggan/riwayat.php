<?php 
include "header.php";

// Menampilkan riwayat pembelian dari pelanggan yang login
$ambil_pembelian = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan = '$id_pelanggan' ORDER BY id_pembelian DESC");
$pembelian = array();
while ($tiap_pembelian = $ambil_pembelian->fetch_assoc()) 
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
    padding: 1.2rem 0.8rem;
    border: none;
    white-space: nowrap;
}
.order-table td {
    padding: 1.2rem 0.8rem;
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
.action-buttons {
    display: flex;
    flex-direction: column;
    gap: 8px;
    min-width: 200px;
}
.action-btn {
    padding: 0.5rem 0.8rem;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 500;
    transition: all 0.3s ease;
    border: none;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    width: 100%;
}
.action-btn i {
    margin-right: 5px;
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
.order-id {
    font-weight: 600;
    color: var(--primary-color);
}
.total-amount {
    font-weight: 600;
    color: #28a745;
}
.date-cell {
    min-width: 160px;
}
.method-cell {
    text-transform: uppercase;
    font-weight: 500;
}
@media (max-width: 768px) {
    .order-table {
        font-size: 0.9rem;
    }
    .action-buttons {
        min-width: 150px;
    }
    .action-btn {
        padding: 0.4rem 0.6rem;
        font-size: 0.8rem;
    }
    .date-cell {
        min-width: 140px;
    }
}
@media (max-width: 576px) {
    .table-responsive {
        overflow-x: auto;
    }
    .order-table th,
    .order-table td {
        padding: 0.8rem 0.5rem;
    }
    .action-buttons {
        min-width: 120px;
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
            <table class="table order-table">
                <thead>
                    <tr>
                        <th>Pesanan</th>
                        <th class="date-cell">Tanggal</th>
                        <th class="date-cell">Jatuh Tempo</th>
                        <th>Total</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pembelian)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <div class="alert alert-info mb-0">
                                    <i class="bi bi-info-circle me-2"></i>
                                    Belum ada riwayat pesanan.
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($pembelian as $key => $value): ?>
                            <tr>
                                <td>
                                    <span class="order-id">#<?php echo $value["id_pembelian"]; ?></span>
                                </td>
                                <td class="date-cell">
                                    <?php echo date("d M Y, H:i", strtotime($value["tanggal_pembelian"])); ?>
                                </td>
                                <td class="date-cell">
                                    <?php if ($value['metode_pembayaran'] == "transfer"): ?>
                                        <?php echo date("d M Y, H:i", strtotime($value["batas_pembayaran"])); ?>
                                    <?php else: ?>
                                        <span class="payment-info">Pay on delivery</span>
                                    <?php endif ?>
                                </td>
                                <td>
                                    <span class="total-amount">Rp <?php echo number_format($value["total_pembelian"]); ?></span>
                                </td>
                                <td class="method-cell">
                                    <?php echo strtoupper($value["metode_pembayaran"]); ?>
                                </td>
                                <td>
                                    <?php 
                                    $status_class = '';
                                    $status_label = '';
                                    switch($value["status_pembelian"]) {
                                        case 'pending':
                                            $status_class = 'status-pending';
                                            $status_label = 'Pending';
                                            break;
                                        case 'lunas':
                                            $status_class = 'status-lunas';
                                            $status_label = 'Lunas';
                                            break;
                                        case 'kirim':
                                            $status_class = 'status-kirim';
                                            $status_label = 'Dikirim';
                                            break;
                                        case 'selesai':
                                            $status_class = 'status-selesai';
                                            $status_label = 'Selesai';
                                            break;
                                        case 'batal':
                                            $status_class = 'status-batal';
                                            $status_label = 'Batal';
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
                                    <div class="action-buttons">
                                        <!-- Tombol Detail (Selalu Tampil) -->
                                        <a href="detail_pembelian.php?id=<?php echo $value["id_pembelian"]; ?>" 
                                           class="action-btn btn-detail"
                                           title="Lihat detail pesanan">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>

                                        <?php 
                                        $id_pembelian = $value["id_pembelian"];
                                        
                                        // Cek pembayaran
                                        $ambil_pembayaran = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian = '$id_pembelian'");
                                        $pembayaran = $ambil_pembayaran->fetch_assoc();
                                        
                                        // Cek pengiriman
                                        $ambil_pengiriman = $koneksi->query("SELECT * FROM pengiriman WHERE id_pembelian = '$id_pembelian'");
                                        $pengiriman = $ambil_pengiriman->fetch_assoc();
                                        ?>
                                        
                                        <?php if ($value["status_pembelian"] == "batal" || $value["status_pembelian"] == "selesai"): ?>
                                            <?php if ($value["status_pembelian"] == "selesai"): ?>
                                                <!-- Tombol Review untuk pesanan selesai -->
                                                <a href="testimoni.php?id=<?php echo $value['id_pembelian']; ?>" 
                                                   class="action-btn btn-review"
                                                   title="Beri ulasan produk">
                                                    <i class="bi bi-star"></i> Beri Ulasan
                                                </a>
                                            <?php endif ?>
                                        <?php else: ?>
                                            <?php if (!isset($pembayaran) && $value["status_pembelian"] == "pending"): ?>
                                                <!-- Tombol Bayar untuk pending tanpa pembayaran -->
                                                <a href="pembayaran.php?id=<?php echo $value["id_pembelian"]; ?>" 
                                                   class="action-btn btn-payment"
                                                   title="Lakukan pembayaran">
                                                    <i class="bi bi-credit-card"></i> Bayar
                                                </a>
                                            <?php elseif (isset($pembayaran)): ?>
                                                <!-- Tombol Pembayaran (sudah bayar) -->
                                                <a href="pembayaran.php?id=<?php echo $value["id_pembelian"]; ?>" 
                                                   class="action-btn btn-payment"
                                                   title="Lihat bukti pembayaran">
                                                    <i class="bi bi-credit-card"></i> Pembayaran
                                                </a>
                                                
                                                <!-- Tombol Pengiriman (jika ada) -->
                                                <?php if (isset($pengiriman)): ?>
                                                    <a href="pengiriman.php?id=<?php echo $value["id_pembelian"]; ?>" 
                                                       class="action-btn btn-shipping"
                                                       title="Lacak pengiriman">
                                                        <i class="bi bi-truck"></i> Pengiriman
                                                    </a>
                                                <?php endif ?>
                                            <?php endif ?>
                                        <?php endif ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php 
include "footer.php";
?>