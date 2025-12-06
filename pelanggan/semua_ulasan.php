<?php 
include "header.php";
$id_produk = $_GET["idp"];

$ambil_produk = $koneksi->query("SELECT * FROM pembelian_produk 
    LEFT JOIN produk ON produk.id_produk = pembelian_produk.id_produk 
    LEFT JOIN pembelian ON pembelian.id_pembelian = pembelian_produk.id_pembelian 
    LEFT JOIN pelanggan ON pelanggan.id_pelanggan = pembelian.id_pelanggan 
    WHERE pembelian_produk.id_produk = '$id_produk'");

$produk = array();
while ($tiap_produk = $ambil_produk->fetch_assoc()) 
{
    $produk[] = $tiap_produk;
}
?>
<div class="container">
    <div class="card shadow my-5">
        <div class="card-body">
            <h3 class="mb-4">Ulasan Produk</h3>
            
            <?php if (empty($produk)): ?>
                <div class="alert alert-info">
                    Belum ada ulasan untuk produk ini.
                </div>
            <?php endif; ?>
            
            <?php foreach ($produk as $key => $value): ?>
                <?php if (!empty($value["ulasan_produk"]) && $value["rating_produk"] > 0): ?>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <h5><?php echo htmlspecialchars($value["nama_pelanggan"]); ?></h5>
                        </div>
                        <div class="col-md-2">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <?php if ($i <= $value['rating_produk']): ?>
                                    <span class="bi bi-star-fill text-warning fw-bold"></span>
                                <?php else: ?>
                                    <span class="bi bi-star text-secondary"></span>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                        <div class="col-md-12 mt-2">
                            <p><?php echo nl2br(htmlspecialchars($value["ulasan_produk"])); ?></p>
                        </div>
                    </div>
                    <hr>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php 
include "footer.php";
?>