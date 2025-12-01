<?php
include 'class.php';

// Coba ambil data dari API terlebih dahulu
try {
    $dt_prov = $apiongkir->update_provinsi();
    if (empty($dt_prov)) {
        throw new Exception("API data empty");
    }
} catch (Exception $e) {
    // Jika API gagal, gunakan data manual
    $dt_prov = array(
        array('province_id' => '1', 'province' => 'DKI Jakarta'),
        array('province_id' => '2', 'province' => 'Jawa Barat'),
        array('province_id' => '3', 'province' => 'Jawa Tengah'),
        array('province_id' => '4', 'province' => 'Jawa Timur'),
        // array('province_id' => '5', 'province' => 'Banten'),
        // array('province_id' => '6', 'province' => 'DI Yogyakarta'),
        array('province_id' => '7', 'province' => 'Sumatera Utara'),
        array('province_id' => '8', 'province' => 'Sumatera Barat'),
        array('province_id' => '9', 'province' => 'Sumatera Selatan'),
        // array('province_id' => '10', 'province' => 'Lampung'),
        // array('province_id' => '11', 'province' => 'Riau'),
        // array('province_id' => '12', 'province' => 'Kepulauan Riau'),
        // array('province_id' => '13', 'province' => 'Jambi'),
        // array('province_id' => '14', 'province' => 'Bengkulu'),
        // array('province_id' => '15', 'province' => 'Bangka Belitung'),
        // array('province_id' => '16', 'province' => 'Aceh'),
        array('province_id' => '17', 'province' => 'Kalimantan Barat'),
        array('province_id' => '18', 'province' => 'Kalimantan Tengah'),
        array('province_id' => '19', 'province' => 'Kalimantan Selatan'),
        array('province_id' => '20', 'province' => 'Kalimantan Timur'),
        array('province_id' => '21', 'province' => 'Kalimantan Utara'),
        array('province_id' => '22', 'province' => 'Sulawesi Utara'),
        array('province_id' => '23', 'province' => 'Sulawesi Tengah'),
        array('province_id' => '24', 'province' => 'Sulawesi Selatan'),
        array('province_id' => '25', 'province' => 'Sulawesi Tenggara'),
        // array('province_id' => '26', 'province' => 'Gorontalo'),
        array('province_id' => '27', 'province' => 'Sulawesi Barat'),
        // array('province_id' => '28', 'province' => 'Maluku'),
        array('province_id' => '29', 'province' => 'Maluku Utara'),
        // array('province_id' => '30', 'province' => 'Papua'),
        // array('province_id' => '31', 'province' => 'Papua Barat'),
        array('province_id' => '32', 'province' => 'Bali'),
        array('province_id' => '33', 'province' => 'Nusa Tenggara Barat'),
        array('province_id' => '34', 'province' => 'Nusa Tenggara Timur')
    );
}
?>
<option value="">Pilih Provinsi</option>
<?php foreach ($dt_prov as $key => $value): ?>
	<option value="<?php echo $value['province_id'] ?>" nama="<?php echo $value['province'] ?>"><?php echo $value['province'] ?></option>
<?php endforeach ?>