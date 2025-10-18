<?php 
include "header.php";
//mengambil data keranjang berdarsakan id user
$ambil_keranjang = $koneksi ->query("SELECT * FROM keranjang LEFT JOIN produk ON produk.id_produk = keranjang.id_produk WHERE id_pelanggan = '$id_pelanggan'");
$keranjang = array();
while ($tiap_keranjang = $ambil_keranjang->fetch_assoc()) 
{
	$keranjang[] = $tiap_keranjang;
}

function rp($harga)
{
	return 'Rp '.str_replace(',', '.', number_format($harga));
}
?>

<div class="container">
	<div class="card mt-4">
		<div class="card-body"> 		
			<div class="row">
				<div class="row">
					<div class="col-md-12">
						<h5>Keranjang Belanja</h5>
						<hr>
						<table class="table table-hover text-nowrap">
							<thead>
								<tr>
									<th>No</th>
									<th>Produk</th>
									<th>Harga</th>
									<th width="15%">Jumlah</th>
									<th>Subharga</th>
									<th>Hapus</th>
								</tr>
							</thead>
							<tbody>
								<?php $total = 0 ?>
								<?php foreach ($keranjang as $key => $value): ?>
									<tr>
										<td><?php echo $key+1 ?></td>
										<td><?php echo $value['nama_produk'] ?></td>
										<td><?php echo rp($value['harga_produk']) ?></td>
										<td>
											<div class="input-group input-group-sm mb-3">
												<?php if ($value['jumlah'] > 1): ?>
													<a href="keranjang.php?kurang=<?php echo $value['id_produk'] ?>" class="btn btn-outline-secondary">-</a>
												<?php else: ?>
													<a href="keranjang.php?hapus=<?php echo $value['id_produk'] ?>" class="btn btn-outline-secondary">-</a>
												<?php endif ?>

												<input type="number" class="form-control text-center" value="<?php echo $value['jumlah'] ?>">

												<?php if ($value["jumlah"] == $value['stok_produk']): ?>
													<a href="" class="btn btn-outline-secondary disabled" disabled="">+</a>
												<?php else: ?>
													<?php if ($value['stok_produk']>0): ?>
														<a href="keranjang.php?tambah=<?php echo $value['id_produk'] ?>" class="btn btn-outline-secondary">+</a>
													<?php endif ?>
												<?php endif ?>
											</div>
										</td>
										<td><?php echo rp($value['jumlah']*$value['harga_produk']) ?></td>
										<td>
											<a href="keranjang.php?hapus=<?php echo $value['id_produk'] ?>" class="btn btn-danger btn-xs">Hapus</a>
										</td>
									</tr>       
									<?php $total += ($value['jumlah']*$value['harga_produk']) ?>
								<?php endforeach ?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="4">Total</td>
									<td colspan="2"><?php echo rp($total) ?></td>
								</tr>
							</tfoot>
						</table>
						<a href="index.php" class="btn btn-warning text-white">Lanjut Belanja</a>
						<!-- Button trigger modal -->
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#metode">
							Pilih Metode Pembayaran
						</button>

						<!-- Modal -->
						<div class="modal fade" id="metode" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<form method="post">
											<div class="mb-3">
												<label class="form-label">Metode Pembayaran</label>
												<select class="form-control" name="metode" required>
													<option value="">--Pilih Metode Pembayaran--</option>
													<option value="transfer">Transfer</option>
													<option value="cod">COD</option>
												</select>
											</div>
											<div class="mb-3">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
												<button class="btn btn-primary" name="checkout">Checkout</button>
												<?php 
												if (isset($_POST["checkout"])) {
													$metode = $_POST["metode"];
													echo "<script>location = 'checkout.php?metode=$metode'</script>";
												}
												?>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
if (isset($_GET['tambah'])) {
	$id_produk = $_GET['tambah'];
	$koneksi -> query("UPDATE keranjang SET jumlah = (jumlah+1) WHERE id_pelanggan = '$id_pelanggan' AND id_produk = '$id_produk'");
	echo "<script>location = 'keranjang.php'</script>";
}
elseif (isset($_GET['kurang'])) {
	$id_produk = $_GET['kurang'];
	$koneksi -> query("UPDATE keranjang SET jumlah = (jumlah-1) WHERE id_pelanggan = '$id_pelanggan' AND id_produk = '$id_produk'");
	echo "<script>location = 'keranjang.php'</script>";
}
elseif (isset($_GET['hapus'])) {
	$id_produk = $_GET['hapus'];
	$koneksi -> query("DELETE FROM keranjang WHERE id_pelanggan = '$id_pelanggan' AND id_produk = '$id_produk'");
	echo "<script>location = 'keranjang.php'</script>";
}

?>

<?php 
include "footer.php";
?>