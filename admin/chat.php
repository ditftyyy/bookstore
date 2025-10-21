<?php 
include "header.php";
$ambil_chat = $koneksi -> query("SELECT pelanggan.id_pelanggan,nama_pelanggan,email_pelanggan FROM `chat` LEFT JOIN pelanggan ON pelanggan.id_pelanggan = chat.id_pelanggan GROUP BY pelanggan.id_pelanggan ORDER BY id_chat DESC;");
$pelanggan = array();
while ($tiap_chat = $ambil_chat->fetch_assoc()) 
{
	$pelanggan[] = $tiap_chat;
}
?>
<div class="row">
	<div class="col-md-4">
		<ul class="navbar-nav">
			<?php foreach ($pelanggan as $key => $value): ?>
				<li class="nav-item">
					<a href="chat.php?id=<?php echo $value["id_pelanggan"]; ?>" class="nav-link p-3 border-bottom"><?php echo $value["nama_pelanggan"]; ?></a> 
				</li>
			<?php endforeach ?>
		</ul>
	</div>
	<?php if (isset($_GET["id"])): ?>
		<?php 
		$id_pelanggan = $_GET["id"];
		$chat_ambil = $koneksi -> query("SELECT * FROM chat WHERE id_pelanggan = '$id_pelanggan'");
		$chat = array();
		while ($tiap_chat = $chat_ambil->fetch_assoc()) 
		{
			$chat[] = $tiap_chat;
		}
		?>
		<div class="col-md-8">
			<?php foreach ($chat as $key => $value): ?>
				<div class="row mb-3">
					<?php if ($value["pengirim_chat"]=="admin"): ?>	
						<div class="col-6 bg-secondary text-white shadow p-2" style="border-radius: 5px;">
							<?php echo $value["isi_chat"]; ?>
						</div>
					<?php endif ?>
					<?php if ($value["pengirim_chat"]=="pelanggan"): ?>	
						<div class="col-6 offset-6 bg-light text-dark shadow p-2" style="border-radius: 5px;">
							<?php echo $value["isi_chat"]; ?>
						</div>
					<?php endif ?>
				</div>
			<?php endforeach ?>
			<form method="post">
				<div class="row">
					<div class="col-10">		
						<div class="form-group">
							<textarea class="form-control" rows="1" cols="100" name="isi_chat"></textarea>
						</div>
					</div>
					<div class="col-2 text-center">
						<button class="btn btn-primary" name="kirim">Kirim</button>	
					</div>
				</div>
			</form>
			<?php 
			if (isset($_POST["kirim"])) 
			{
				$pelanggan = $id_pelanggan;
				$id_admin = $admin["id_admin"];
				$isi_chat = $_POST["isi_chat"];
				$waktu_chat = date("Y-m-d H:i:s");
				$pengirim = "admin";

				$koneksi -> query("INSERT INTO chat(id_pelanggan,id_admin,isi_chat,waktu_chat,pengirim_chat) VALUES('$pelanggan','$id_admin','$isi_chat','$waktu_chat','$pengirim')");
				echo "<script>location = 'chat.php?id=$id_pelanggan'</script>";
			}
			?>
		</div>
	<?php endif ?>
</div>
<?php 
include "footer.php";
?>