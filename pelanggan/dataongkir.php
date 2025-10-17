<?php
include 'class.php';

$id_kota_asal = isset($_POST['id_kota_asal']) ? $_POST['id_kota_asal'] : 419; // Default kota asal
$id_kota_tujuan = $_POST['id_kota'];
$total_berat = $_POST['total_berat'];
$ekspedisi = $_POST['ekspedisi'];

// Mapping city_id ke provinsi dan pulau (hanya untuk manual)
$city_to_prov = array(
    // Contoh: '151' => array('prov' => 1, 'pulau' => 'Jawa'), dst
    // DKI Jakarta
    '151' => array('prov' => 1, 'pulau' => 'Jawa'), '152' => array('prov' => 1, 'pulau' => 'Jawa'), '153' => array('prov' => 1, 'pulau' => 'Jawa'), '154' => array('prov' => 1, 'pulau' => 'Jawa'), '155' => array('prov' => 1, 'pulau' => 'Jawa'),
    // Jawa Barat
    '22' => array('prov' => 2, 'pulau' => 'Jawa'), '23' => array('prov' => 2, 'pulau' => 'Jawa'), '24' => array('prov' => 2, 'pulau' => 'Jawa'), '25' => array('prov' => 2, 'pulau' => 'Jawa'), '26' => array('prov' => 2, 'pulau' => 'Jawa'), '27' => array('prov' => 2, 'pulau' => 'Jawa'), '28' => array('prov' => 2, 'pulau' => 'Jawa'), '29' => array('prov' => 2, 'pulau' => 'Jawa'),
    // Jawa Tengah
    '327' => array('prov' => 3, 'pulau' => 'Jawa'), '328' => array('prov' => 3, 'pulau' => 'Jawa'), '329' => array('prov' => 3, 'pulau' => 'Jawa'), '330' => array('prov' => 3, 'pulau' => 'Jawa'), '331' => array('prov' => 3, 'pulau' => 'Jawa'), '332' => array('prov' => 3, 'pulau' => 'Jawa'),
    // Jawa Timur
    '444' => array('prov' => 4, 'pulau' => 'Jawa'), '445' => array('prov' => 4, 'pulau' => 'Jawa'), '446' => array('prov' => 4, 'pulau' => 'Jawa'), '447' => array('prov' => 4, 'pulau' => 'Jawa'), '448' => array('prov' => 4, 'pulau' => 'Jawa'), '449' => array('prov' => 4, 'pulau' => 'Jawa'), '450' => array('prov' => 4, 'pulau' => 'Jawa'), '451' => array('prov' => 4, 'pulau' => 'Jawa'),
    // Bali
    '2701' => array('prov' => 32, 'pulau' => 'Bali'), '2702' => array('prov' => 32, 'pulau' => 'Bali'), '2703' => array('prov' => 32, 'pulau' => 'Bali'), '2704' => array('prov' => 32, 'pulau' => 'Bali'), '2705' => array('prov' => 32, 'pulau' => 'Bali'), '2706' => array('prov' => 32, 'pulau' => 'Bali'), '2707' => array('prov' => 32, 'pulau' => 'Bali'), '2708' => array('prov' => 32, 'pulau' => 'Bali'),
    // Sumatera Utara
    '201' => array('prov' => 7, 'pulau' => 'Sumatera'), '202' => array('prov' => 7, 'pulau' => 'Sumatera'), '203' => array('prov' => 7, 'pulau' => 'Sumatera'), '204' => array('prov' => 7, 'pulau' => 'Sumatera'), '205' => array('prov' => 7, 'pulau' => 'Sumatera'), '206' => array('prov' => 7, 'pulau' => 'Sumatera'), '207' => array('prov' => 7, 'pulau' => 'Sumatera'),
    // ... (tambahkan mapping untuk semua city_id manual, cukup copy dari datakota.php)
);

// Helper untuk dapatkan provinsi & pulau dari city_id
function get_prov_pulau($city_id, $city_to_prov) {
    return isset($city_to_prov[$city_id]) ? $city_to_prov[$city_id] : array('prov' => 0, 'pulau' => 'Lainnya');
}

// Coba ambil data dari API terlebih dahulu
try {
    $dt_ongkir = $apiongkir->update_ongkir($id_kota_asal, $id_kota_tujuan, $total_berat, $ekspedisi);
    if (empty($dt_ongkir)) {
        throw new Exception("API data empty");
    }
} catch (Exception $e) {
    // Hitung manual
    $asal = get_prov_pulau($id_kota_asal, $city_to_prov);
    $tujuan = get_prov_pulau($id_kota_tujuan, $city_to_prov);
    $berat_kg = max(1, ceil($total_berat / 1000));

    // Tarif dasar
    $tarif = 15000; // default dalam provinsi
    if ($asal['prov'] != $tujuan['prov']) {
        $tarif = 25000; // beda provinsi, satu pulau
        if ($asal['pulau'] != $tujuan['pulau']) {
            $tarif = 35000; // beda pulau
        }
    }

    // Ongkir per ekspedisi
    $ongkir_manual = array(
        'jne' => array(
            array('service' => 'REG', 'cost' => array(array('value' => $tarif + ($berat_kg-1)*5000, 'etd' => '2-4'))),
            array('service' => 'YES', 'cost' => array(array('value' => $tarif + 10000 + ($berat_kg-1)*7000, 'etd' => '1-2'))),
            array('service' => 'OKE', 'cost' => array(array('value' => $tarif - 3000 + ($berat_kg-1)*4000, 'etd' => '4-6')))
        ),
        'tiki' => array(
            array('service' => 'REG', 'cost' => array(array('value' => $tarif + 2000 + ($berat_kg-1)*6000, 'etd' => '2-4'))),
            array('service' => 'ECO', 'cost' => array(array('value' => $tarif - 2000 + ($berat_kg-1)*4000, 'etd' => '4-7'))),
            array('service' => 'ONS', 'cost' => array(array('value' => $tarif + 15000 + ($berat_kg-1)*10000, 'etd' => '1')))
        ),
        'pos' => array(
            array('service' => 'Paket Kilat Khusus', 'cost' => array(array('value' => $tarif + 5000 + ($berat_kg-1)*7000, 'etd' => '1-3'))),
            array('service' => 'Paket Kilat', 'cost' => array(array('value' => $tarif + ($berat_kg-1)*5000, 'etd' => '2-5'))),
            array('service' => 'Paket Reguler', 'cost' => array(array('value' => $tarif - 2000 + ($berat_kg-1)*4000, 'etd' => '4-8')))
        )
    );
    $dt_ongkir = isset($ongkir_manual[$ekspedisi]) ? $ongkir_manual[$ekspedisi] : $ongkir_manual['jne'];
}
?>
<pre><?php print_r($_POST) ?></pre>
<option value="">Pilih Ongkir</option>
<?php foreach ($dt_ongkir as $key => $value): ?>
	<option value="" nama="<?php echo $value['service'] ?>" biaya="<?php echo $value['cost'][0]['value'] ?>" lama="<?php echo $value['cost'][0]['etd'] ?>"><?php echo $value['service'] ?> Rp. <?php echo number_format($value['cost'][0]['value']) ?> (<?php echo $value['cost'][0]['etd'] ?> hari)</option>
<?php endforeach ?>