<?php
include 'class.php';

$provinsi_id = $_POST['provinsi'];

// Coba ambil data dari API terlebih dahulu
try {
    $dt_kota = $apiongkir->update_kota($provinsi_id);
    if (empty($dt_kota)) {
        throw new Exception("API data empty");
    }
} catch (Exception $e) {
    // Jika API gagal, gunakan data manual berdasarkan provinsi
    $kota_manual = array(
        '1' => array( // DKI Jakarta
            array('city_id' => '151', 'city_name' => 'Jakarta Pusat', 'postal_code' => '10110', 'type' => 'Kota'),
            array('city_id' => '152', 'city_name' => 'Jakarta Utara', 'postal_code' => '14110', 'type' => 'Kota'),
            array('city_id' => '153', 'city_name' => 'Jakarta Barat', 'postal_code' => '11110', 'type' => 'Kota'),
            array('city_id' => '154', 'city_name' => 'Jakarta Selatan', 'postal_code' => '12110', 'type' => 'Kota'),
            array('city_id' => '155', 'city_name' => 'Jakarta Timur', 'postal_code' => '13110', 'type' => 'Kota')
        ),
        '2' => array( // Jawa Barat
            array('city_id' => '22', 'city_name' => 'Bandung', 'postal_code' => '40111', 'type' => 'Kota'),
            array('city_id' => '23', 'city_name' => 'Bekasi', 'postal_code' => '17121', 'type' => 'Kota'),
            array('city_id' => '24', 'city_name' => 'Bogor', 'postal_code' => '16111', 'type' => 'Kota'),
            array('city_id' => '25', 'city_name' => 'Cimahi', 'postal_code' => '40521', 'type' => 'Kota'),
            array('city_id' => '26', 'city_name' => 'Cirebon', 'postal_code' => '45111', 'type' => 'Kota'),
            array('city_id' => '27', 'city_name' => 'Depok', 'postal_code' => '16411', 'type' => 'Kota'),
            array('city_id' => '28', 'city_name' => 'Sukabumi', 'postal_code' => '43111', 'type' => 'Kota'),
            array('city_id' => '29', 'city_name' => 'Tasikmalaya', 'postal_code' => '46111', 'type' => 'Kota')
        ),
        '3' => array( // Jawa Tengah
            array('city_id' => '327', 'city_name' => 'Semarang', 'postal_code' => '50111', 'type' => 'Kota'),
            array('city_id' => '328', 'city_name' => 'Solo', 'postal_code' => '57111', 'type' => 'Kota'),
            array('city_id' => '329', 'city_name' => 'Magelang', 'postal_code' => '56111', 'type' => 'Kota'),
            array('city_id' => '330', 'city_name' => 'Pekalongan', 'postal_code' => '51111', 'type' => 'Kota'),
            array('city_id' => '331', 'city_name' => 'Salatiga', 'postal_code' => '50711', 'type' => 'Kota'),
            array('city_id' => '332', 'city_name' => 'Tegal', 'postal_code' => '52111', 'type' => 'Kota')
        ),
        '4' => array( // Jawa Timur
            array('city_id' => '444', 'city_name' => 'Jember', 'postal_code' => '60111', 'type' => 'Kota'),
            array('city_id' => '445', 'city_name' => 'Malang', 'postal_code' => '65111', 'type' => 'Kota'),
            array('city_id' => '446', 'city_name' => 'Sidoarjo', 'postal_code' => '61211', 'type' => 'Kabupaten'),
            array('city_id' => '447', 'city_name' => 'Gresik', 'postal_code' => '61111', 'type' => 'Kabupaten'),
            array('city_id' => '448', 'city_name' => 'Pasuruan', 'postal_code' => '67111', 'type' => 'Kota'),
            array('city_id' => '449', 'city_name' => 'Mojokerto', 'postal_code' => '61311', 'type' => 'Kota'),
            array('city_id' => '450', 'city_name' => 'Probolinggo', 'postal_code' => '67211', 'type' => 'Kota'),
            array('city_id' => '451', 'city_name' => 'Madiun', 'postal_code' => '63111', 'type' => 'Kota')
        ),
        '5' => array( // Banten
            array('city_id' => '106', 'city_name' => 'Serang', 'postal_code' => '42111', 'type' => 'Kota'),
            array('city_id' => '107', 'city_name' => 'Tangerang', 'postal_code' => '15111', 'type' => 'Kota'),
            array('city_id' => '108', 'city_name' => 'Cilegon', 'postal_code' => '42411', 'type' => 'Kota'),
            array('city_id' => '109', 'city_name' => 'Tangerang Selatan', 'postal_code' => '15411', 'type' => 'Kota')
        ),
        '6' => array( // DI Yogyakarta
            array('city_id' => '501', 'city_name' => 'Yogyakarta', 'postal_code' => '55111', 'type' => 'Kota'),
            array('city_id' => '502', 'city_name' => 'Sleman', 'postal_code' => '55511', 'type' => 'Kabupaten'),
            array('city_id' => '503', 'city_name' => 'Bantul', 'postal_code' => '55711', 'type' => 'Kabupaten'),
            array('city_id' => '504', 'city_name' => 'Kulon Progo', 'postal_code' => '55611', 'type' => 'Kabupaten'),
            array('city_id' => '505', 'city_name' => 'Gunung Kidul', 'postal_code' => '55811', 'type' => 'Kabupaten')
        ),
        '7' => array( // Sumatera Utara
            array('city_id' => '201', 'city_name' => 'Medan', 'postal_code' => '20111', 'type' => 'Kota'),
            array('city_id' => '202', 'city_name' => 'Binjai', 'postal_code' => '20711', 'type' => 'Kota'),
            array('city_id' => '203', 'city_name' => 'Padang Sidempuan', 'postal_code' => '22711', 'type' => 'Kota'),
            array('city_id' => '204', 'city_name' => 'Pematangsiantar', 'postal_code' => '21111', 'type' => 'Kota'),
            array('city_id' => '205', 'city_name' => 'Tanjungbalai', 'postal_code' => '21311', 'type' => 'Kota'),
            array('city_id' => '206', 'city_name' => 'Tebing Tinggi', 'postal_code' => '20611', 'type' => 'Kota'),
            array('city_id' => '207', 'city_name' => 'Tanjung Pinang', 'postal_code' => '29111', 'type' => 'Kota')
        ),
        '8' => array( // Sumatera Barat
            array('city_id' => '301', 'city_name' => 'Padang', 'postal_code' => '25111', 'type' => 'Kota'),
            array('city_id' => '302', 'city_name' => 'Bukittinggi', 'postal_code' => '26111', 'type' => 'Kota'),
            array('city_id' => '303', 'city_name' => 'Payakumbuh', 'postal_code' => '26211', 'type' => 'Kota'),
            array('city_id' => '304', 'city_name' => 'Pariaman', 'postal_code' => '25511', 'type' => 'Kota'),
            array('city_id' => '305', 'city_name' => 'Solok', 'postal_code' => '27311', 'type' => 'Kota'),
            array('city_id' => '306', 'city_name' => 'Sawahlunto', 'postal_code' => '27411', 'type' => 'Kota')
        ),
        '9' => array( // Sumatera Selatan
            array('city_id' => '401', 'city_name' => 'Palembang', 'postal_code' => '30111', 'type' => 'Kota'),
            array('city_id' => '402', 'city_name' => 'Prabumulih', 'postal_code' => '31111', 'type' => 'Kota'),
            array('city_id' => '403', 'city_name' => 'Pagar Alam', 'postal_code' => '31511', 'type' => 'Kota'),
            array('city_id' => '404', 'city_name' => 'Lubuklinggau', 'postal_code' => '31611', 'type' => 'Kota'),
            array('city_id' => '405', 'city_name' => 'Baturaja', 'postal_code' => '32111', 'type' => 'Kabupaten')
        ),
        '10' => array( // Lampung
            array('city_id' => '501', 'city_name' => 'Bandar Lampung', 'postal_code' => '35111', 'type' => 'Kota'),
            array('city_id' => '502', 'city_name' => 'Metro', 'postal_code' => '34111', 'type' => 'Kota'),
            array('city_id' => '503', 'city_name' => 'Kotabumi', 'postal_code' => '34511', 'type' => 'Kabupaten'),
            array('city_id' => '504', 'city_name' => 'Kalianda', 'postal_code' => '35511', 'type' => 'Kabupaten'),
            array('city_id' => '505', 'city_name' => 'Liwa', 'postal_code' => '34811', 'type' => 'Kabupaten')
        ),
        '11' => array( // Riau
            array('city_id' => '601', 'city_name' => 'Pekanbaru', 'postal_code' => '28111', 'type' => 'Kota'),
            array('city_id' => '602', 'city_name' => 'Dumai', 'postal_code' => '28811', 'type' => 'Kota'),
            array('city_id' => '603', 'city_name' => 'Bengkalis', 'postal_code' => '28711', 'type' => 'Kabupaten'),
            array('city_id' => '604', 'city_name' => 'Siak', 'postal_code' => '28611', 'type' => 'Kabupaten'),
            array('city_id' => '605', 'city_name' => 'Rengat', 'postal_code' => '29311', 'type' => 'Kabupaten')
        ),
        '12' => array( // Kepulauan Riau
            array('city_id' => '701', 'city_name' => 'Tanjung Pinang', 'postal_code' => '29111', 'type' => 'Kota'),
            array('city_id' => '702', 'city_name' => 'Batam', 'postal_code' => '29411', 'type' => 'Kota'),
            array('city_id' => '703', 'city_name' => 'Tanjung Balai Karimun', 'postal_code' => '29611', 'type' => 'Kabupaten'),
            array('city_id' => '704', 'city_name' => 'Ranai', 'postal_code' => '29711', 'type' => 'Kabupaten'),
            array('city_id' => '705', 'city_name' => 'Daik', 'postal_code' => '29811', 'type' => 'Kabupaten')
        ),
        '13' => array( // Jambi
            array('city_id' => '801', 'city_name' => 'Jambi', 'postal_code' => '36111', 'type' => 'Kota'),
            array('city_id' => '802', 'city_name' => 'Sungai Penuh', 'postal_code' => '37111', 'type' => 'Kota'),
            array('city_id' => '803', 'city_name' => 'Muara Bulian', 'postal_code' => '36611', 'type' => 'Kabupaten'),
            array('city_id' => '804', 'city_name' => 'Muara Tebo', 'postal_code' => '37511', 'type' => 'Kabupaten'),
            array('city_id' => '805', 'city_name' => 'Sarolangun', 'postal_code' => '37411', 'type' => 'Kabupaten')
        ),
        '14' => array( // Bengkulu
            array('city_id' => '901', 'city_name' => 'Bengkulu', 'postal_code' => '38111', 'type' => 'Kota'),
            array('city_id' => '902', 'city_name' => 'Curup', 'postal_code' => '39111', 'type' => 'Kabupaten'),
            array('city_id' => '903', 'city_name' => 'Manna', 'postal_code' => '38511', 'type' => 'Kabupaten'),
            array('city_id' => '904', 'city_name' => 'Tais', 'postal_code' => '38711', 'type' => 'Kabupaten'),
            array('city_id' => '905', 'city_name' => 'Argamakmur', 'postal_code' => '38611', 'type' => 'Kabupaten')
        ),
        '15' => array( // Bangka Belitung
            array('city_id' => '1001', 'city_name' => 'Pangkalpinang', 'postal_code' => '33111', 'type' => 'Kota'),
            array('city_id' => '1002', 'city_name' => 'Tanjung Pandan', 'postal_code' => '33411', 'type' => 'Kabupaten'),
            array('city_id' => '1003', 'city_name' => 'Manggar', 'postal_code' => '33511', 'type' => 'Kabupaten'),
            array('city_id' => '1004', 'city_name' => 'Koba', 'postal_code' => '33611', 'type' => 'Kabupaten'),
            array('city_id' => '1005', 'city_name' => 'Toboali', 'postal_code' => '33711', 'type' => 'Kabupaten')
        ),
        '16' => array( // Aceh
            array('city_id' => '1101', 'city_name' => 'Banda Aceh', 'postal_code' => '23111', 'type' => 'Kota'),
            array('city_id' => '1102', 'city_name' => 'Langsa', 'postal_code' => '24411', 'type' => 'Kota'),
            array('city_id' => '1103', 'city_name' => 'Lhokseumawe', 'postal_code' => '24311', 'type' => 'Kota'),
            array('city_id' => '1104', 'city_name' => 'Sabang', 'postal_code' => '23511', 'type' => 'Kota'),
            array('city_id' => '1105', 'city_name' => 'Subulussalam', 'postal_code' => '24711', 'type' => 'Kota'),
            array('city_id' => '1106', 'city_name' => 'Takengon', 'postal_code' => '24511', 'type' => 'Kabupaten'),
            array('city_id' => '1107', 'city_name' => 'Meulaboh', 'postal_code' => '23611', 'type' => 'Kabupaten')
        ),
        '17' => array( // Kalimantan Barat
            array('city_id' => '1201', 'city_name' => 'Pontianak', 'postal_code' => '78111', 'type' => 'Kota'),
            array('city_id' => '1202', 'city_name' => 'Singkawang', 'postal_code' => '79111', 'type' => 'Kota'),
            array('city_id' => '1203', 'city_name' => 'Ketapang', 'postal_code' => '78811', 'type' => 'Kabupaten'),
            array('city_id' => '1204', 'city_name' => 'Sanggau', 'postal_code' => '78511', 'type' => 'Kabupaten'),
            array('city_id' => '1205', 'city_name' => 'Sintang', 'postal_code' => '78611', 'type' => 'Kabupaten'),
            array('city_id' => '1206', 'city_name' => 'Kapuas Hulu', 'postal_code' => '78711', 'type' => 'Kabupaten')
        ),
        '18' => array( // Kalimantan Tengah
            array('city_id' => '1301', 'city_name' => 'Palangkaraya', 'postal_code' => '73111', 'type' => 'Kota'),
            array('city_id' => '1302', 'city_name' => 'Pangkalan Bun', 'postal_code' => '74111', 'type' => 'Kabupaten'),
            array('city_id' => '1303', 'city_name' => 'Sampit', 'postal_code' => '74311', 'type' => 'Kabupaten'),
            array('city_id' => '1304', 'city_name' => 'Kuala Kapuas', 'postal_code' => '73511', 'type' => 'Kabupaten'),
            array('city_id' => '1305', 'city_name' => 'Muara Teweh', 'postal_code' => '73811', 'type' => 'Kabupaten'),
            array('city_id' => '1306', 'city_name' => 'Buntok', 'postal_code' => '73711', 'type' => 'Kabupaten')
        ),
        '19' => array( // Kalimantan Selatan
            array('city_id' => '1401', 'city_name' => 'Banjarmasin', 'postal_code' => '70111', 'type' => 'Kota'),
            array('city_id' => '1402', 'city_name' => 'Banjarbaru', 'postal_code' => '70711', 'type' => 'Kota'),
            array('city_id' => '1403', 'city_name' => 'Martapura', 'postal_code' => '70611', 'type' => 'Kabupaten'),
            array('city_id' => '1404', 'city_name' => 'Tanjung', 'postal_code' => '70811', 'type' => 'Kabupaten'),
            array('city_id' => '1405', 'city_name' => 'Barabai', 'postal_code' => '71311', 'type' => 'Kabupaten'),
            array('city_id' => '1406', 'city_name' => 'Paringin', 'postal_code' => '71511', 'type' => 'Kabupaten')
        ),
        '20' => array( // Kalimantan Timur
            array('city_id' => '1501', 'city_name' => 'Samarinda', 'postal_code' => '75111', 'type' => 'Kota'),
            array('city_id' => '1502', 'city_name' => 'Balikpapan', 'postal_code' => '76111', 'type' => 'Kota'),
            array('city_id' => '1503', 'city_name' => 'Bontang', 'postal_code' => '75311', 'type' => 'Kota'),
            array('city_id' => '1504', 'city_name' => 'Tanjung Selor', 'postal_code' => '77111', 'type' => 'Kabupaten'),
            array('city_id' => '1505', 'city_name' => 'Tanjung Redeb', 'postal_code' => '77311', 'type' => 'Kabupaten'),
            array('city_id' => '1506', 'city_name' => 'Sendawar', 'postal_code' => '75711', 'type' => 'Kabupaten')
        ),
        '21' => array( // Kalimantan Utara
            array('city_id' => '1601', 'city_name' => 'Tanjung Selor', 'postal_code' => '77111', 'type' => 'Kota'),
            array('city_id' => '1602', 'city_name' => 'Tarakan', 'postal_code' => '77111', 'type' => 'Kota'),
            array('city_id' => '1603', 'city_name' => 'Malinau', 'postal_code' => '77511', 'type' => 'Kabupaten'),
            array('city_id' => '1604', 'city_name' => 'Nunukan', 'postal_code' => '77411', 'type' => 'Kabupaten'),
            array('city_id' => '1605', 'city_name' => 'Tana Tidung', 'postal_code' => '77611', 'type' => 'Kabupaten')
        ),
        '22' => array( // Sulawesi Utara
            array('city_id' => '1701', 'city_name' => 'Manado', 'postal_code' => '95111', 'type' => 'Kota'),
            array('city_id' => '1702', 'city_name' => 'Bitung', 'postal_code' => '95511', 'type' => 'Kota'),
            array('city_id' => '1703', 'city_name' => 'Tomohon', 'postal_code' => '95411', 'type' => 'Kota'),
            array('city_id' => '1704', 'city_name' => 'Kotamobagu', 'postal_code' => '95711', 'type' => 'Kota'),
            array('city_id' => '1705', 'city_name' => 'Tahuna', 'postal_code' => '95811', 'type' => 'Kabupaten'),
            array('city_id' => '1706', 'city_name' => 'Amurang', 'postal_code' => '95911', 'type' => 'Kabupaten')
        ),
        '23' => array( // Sulawesi Tengah
            array('city_id' => '1801', 'city_name' => 'Palu', 'postal_code' => '94111', 'type' => 'Kota'),
            array('city_id' => '1802', 'city_name' => 'Poso', 'postal_code' => '94611', 'type' => 'Kabupaten'),
            array('city_id' => '1803', 'city_name' => 'Toli-Toli', 'postal_code' => '94511', 'type' => 'Kabupaten'),
            array('city_id' => '1804', 'city_name' => 'Banggai', 'postal_code' => '94811', 'type' => 'Kabupaten'),
            array('city_id' => '1805', 'city_name' => 'Parigi', 'postal_code' => '94411', 'type' => 'Kabupaten'),
            array('city_id' => '1806', 'city_name' => 'Buol', 'postal_code' => '94511', 'type' => 'Kabupaten')
        ),
        '24' => array( // Sulawesi Selatan
            array('city_id' => '1901', 'city_name' => 'Makassar', 'postal_code' => '90111', 'type' => 'Kota'),
            array('city_id' => '1902', 'city_name' => 'Parepare', 'postal_code' => '91111', 'type' => 'Kota'),
            array('city_id' => '1903', 'city_name' => 'Palopo', 'postal_code' => '91911', 'type' => 'Kota'),
            array('city_id' => '1904', 'city_name' => 'Watampone', 'postal_code' => '92711', 'type' => 'Kabupaten'),
            array('city_id' => '1905', 'city_name' => 'Sengkang', 'postal_code' => '92911', 'type' => 'Kabupaten'),
            array('city_id' => '1906', 'city_name' => 'Bantaeng', 'postal_code' => '92411', 'type' => 'Kabupaten'),
            array('city_id' => '1907', 'city_name' => 'Jeneponto', 'postal_code' => '92311', 'type' => 'Kabupaten')
        ),
        '25' => array( // Sulawesi Tenggara
            array('city_id' => '2001', 'city_name' => 'Kendari', 'postal_code' => '93111', 'type' => 'Kota'),
            array('city_id' => '2002', 'city_name' => 'Baubau', 'postal_code' => '93711', 'type' => 'Kota'),
            array('city_id' => '2003', 'city_name' => 'Raha', 'postal_code' => '93611', 'type' => 'Kabupaten'),
            array('city_id' => '2004', 'city_name' => 'Kolaka', 'postal_code' => '93511', 'type' => 'Kabupaten'),
            array('city_id' => '2005', 'city_name' => 'Wangi-Wangi', 'postal_code' => '93811', 'type' => 'Kabupaten'),
            array('city_id' => '2006', 'city_name' => 'Lasusua', 'postal_code' => '93911', 'type' => 'Kabupaten')
        ),
        '26' => array( // Gorontalo
            array('city_id' => '2101', 'city_name' => 'Gorontalo', 'postal_code' => '96111', 'type' => 'Kota'),
            array('city_id' => '2102', 'city_name' => 'Limboto', 'postal_code' => '96211', 'type' => 'Kabupaten'),
            array('city_id' => '2103', 'city_name' => 'Tilamuta', 'postal_code' => '96311', 'type' => 'Kabupaten'),
            array('city_id' => '2104', 'city_name' => 'Suwawa', 'postal_code' => '96511', 'type' => 'Kabupaten'),
            array('city_id' => '2105', 'city_name' => 'Marisa', 'postal_code' => '96411', 'type' => 'Kabupaten')
        ),
        '27' => array( // Sulawesi Barat
            array('city_id' => '2201', 'city_name' => 'Mamuju', 'postal_code' => '91511', 'type' => 'Kota'),
            array('city_id' => '2202', 'city_name' => 'Mamasa', 'postal_code' => '91311', 'type' => 'Kabupaten'),
            array('city_id' => '2203', 'city_name' => 'Pasangkayu', 'postal_code' => '91611', 'type' => 'Kabupaten'),
            array('city_id' => '2204', 'city_name' => 'Majene', 'postal_code' => '91411', 'type' => 'Kabupaten'),
            array('city_id' => '2205', 'city_name' => 'Polewali', 'postal_code' => '91311', 'type' => 'Kabupaten')
        ),
        '28' => array( // Maluku
            array('city_id' => '2301', 'city_name' => 'Ambon', 'postal_code' => '97111', 'type' => 'Kota'),
            array('city_id' => '2302', 'city_name' => 'Tual', 'postal_code' => '97611', 'type' => 'Kota'),
            array('city_id' => '2303', 'city_name' => 'Masohi', 'postal_code' => '97511', 'type' => 'Kabupaten'),
            array('city_id' => '2304', 'city_name' => 'Namlea', 'postal_code' => '97511', 'type' => 'Kabupaten'),
            array('city_id' => '2305', 'city_name' => 'Dobo', 'postal_code' => '97611', 'type' => 'Kabupaten'),
            array('city_id' => '2306', 'city_name' => 'Saumlaki', 'postal_code' => '97611', 'type' => 'Kabupaten')
        ),
        '29' => array( // Maluku Utara
            array('city_id' => '2401', 'city_name' => 'Ternate', 'postal_code' => '97711', 'type' => 'Kota'),
            array('city_id' => '2402', 'city_name' => 'Tidore', 'postal_code' => '97811', 'type' => 'Kota'),
            array('city_id' => '2403', 'city_name' => 'Jailolo', 'postal_code' => '97811', 'type' => 'Kabupaten'),
            array('city_id' => '2404', 'city_name' => 'Weda', 'postal_code' => '97811', 'type' => 'Kabupaten'),
            array('city_id' => '2405', 'city_name' => 'Sanana', 'postal_code' => '97611', 'type' => 'Kabupaten')
        ),
        '30' => array( // Papua
            array('city_id' => '2501', 'city_name' => 'Jayapura', 'postal_code' => '99111', 'type' => 'Kota'),
            array('city_id' => '2502', 'city_name' => 'Merauke', 'postal_code' => '99611', 'type' => 'Kabupaten'),
            array('city_id' => '2503', 'city_name' => 'Wamena', 'postal_code' => '99511', 'type' => 'Kabupaten'),
            array('city_id' => '2504', 'city_name' => 'Biak', 'postal_code' => '98111', 'type' => 'Kabupaten'),
            array('city_id' => '2505', 'city_name' => 'Serui', 'postal_code' => '98211', 'type' => 'Kabupaten'),
            array('city_id' => '2506', 'city_name' => 'Timika', 'postal_code' => '99911', 'type' => 'Kabupaten')
        ),
        '31' => array( // Papua Barat
            array('city_id' => '2601', 'city_name' => 'Manokwari', 'postal_code' => '98311', 'type' => 'Kabupaten'),
            array('city_id' => '2602', 'city_name' => 'Sorong', 'postal_code' => '98411', 'type' => 'Kota'),
            array('city_id' => '2603', 'city_name' => 'Fakfak', 'postal_code' => '98611', 'type' => 'Kabupaten'),
            array('city_id' => '2604', 'city_name' => 'Kaimana', 'postal_code' => '98711', 'type' => 'Kabupaten'),
            array('city_id' => '2605', 'city_name' => 'Bintuni', 'postal_code' => '98511', 'type' => 'Kabupaten'),
            array('city_id' => '2606', 'city_name' => 'Ransiki', 'postal_code' => '98311', 'type' => 'Kabupaten')
        ),
        '32' => array( // Bali
            array('city_id' => '2701', 'city_name' => 'Denpasar', 'postal_code' => '80111', 'type' => 'Kota'),
            array('city_id' => '2702', 'city_name' => 'Singaraja', 'postal_code' => '81111', 'type' => 'Kabupaten'),
            array('city_id' => '2703', 'city_name' => 'Amlapura', 'postal_code' => '80811', 'type' => 'Kabupaten'),
            array('city_id' => '2704', 'city_name' => 'Negara', 'postal_code' => '82211', 'type' => 'Kabupaten'),
            array('city_id' => '2705', 'city_name' => 'Tabanan', 'postal_code' => '82111', 'type' => 'Kabupaten'),
            array('city_id' => '2706', 'city_name' => 'Gianyar', 'postal_code' => '80511', 'type' => 'Kabupaten'),
            array('city_id' => '2707', 'city_name' => 'Bangli', 'postal_code' => '80611', 'type' => 'Kabupaten'),
            array('city_id' => '2708', 'city_name' => 'Karangasem', 'postal_code' => '80811', 'type' => 'Kabupaten')
        ),
        '33' => array( // Nusa Tenggara Barat
            array('city_id' => '2801', 'city_name' => 'Mataram', 'postal_code' => '83111', 'type' => 'Kota'),
            array('city_id' => '2802', 'city_name' => 'Bima', 'postal_code' => '84111', 'type' => 'Kota'),
            array('city_id' => '2803', 'city_name' => 'Sumbawa Besar', 'postal_code' => '84311', 'type' => 'Kabupaten'),
            array('city_id' => '2804', 'city_name' => 'Dompu', 'postal_code' => '84211', 'type' => 'Kabupaten'),
            array('city_id' => '2805', 'city_name' => 'Selong', 'postal_code' => '83611', 'type' => 'Kabupaten'),
            array('city_id' => '2806', 'city_name' => 'Praya', 'postal_code' => '83511', 'type' => 'Kabupaten'),
            array('city_id' => '2807', 'city_name' => 'Gerung', 'postal_code' => '83311', 'type' => 'Kabupaten')
        ),
        '34' => array( // Nusa Tenggara Timur
            array('city_id' => '2901', 'city_name' => 'Kupang', 'postal_code' => '85111', 'type' => 'Kota'),
            array('city_id' => '2902', 'city_name' => 'Ende', 'postal_code' => '86311', 'type' => 'Kabupaten'),
            array('city_id' => '2903', 'city_name' => 'Manggarai', 'postal_code' => '86511', 'type' => 'Kabupaten'),
            array('city_id' => '2904', 'city_name' => 'Ruteng', 'postal_code' => '86511', 'type' => 'Kabupaten'),
            array('city_id' => '2905', 'city_name' => 'Bajawa', 'postal_code' => '86411', 'type' => 'Kabupaten'),
            array('city_id' => '2906', 'city_name' => 'Maumere', 'postal_code' => '86111', 'type' => 'Kabupaten'),
            array('city_id' => '2907', 'city_name' => 'Larantuka', 'postal_code' => '86211', 'type' => 'Kabupaten'),
            array('city_id' => '2908', 'city_name' => 'Atambua', 'postal_code' => '85711', 'type' => 'Kabupaten')
        )
    );
    
    $dt_kota = isset($kota_manual[$provinsi_id]) ? $kota_manual[$provinsi_id] : array();
}
?>
<pre><?php print_r($_POST) ?></pre>
<option value="">Pilih Kota</option>
<?php foreach ($dt_kota as $key => $value): ?>
	<option value="<?php echo $value['city_id'] ?>" nama="<?php echo $value['city_name'] ?>" kodepos="<?php echo $value['postal_code'] ?>" tipe="<?php echo $value['type'] ?>">
		<?php echo $value['type'] ?> <?php echo $value['city_name'] ?>
	</option>
<?php endforeach ?>