<?php
class apiongkir
{
	function update_provinsi()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://api.rajaongkir.com/starter/province?id=",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"key: 4f09e388e68d3baedd96e97162177173"
				),
			));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			// echo $response;
			// echo disini menampilkan data $response
			// tetapi datanya masih dlm bentuk json
			// karena itu $response harus di convert ke array menggunakan json_decode, lalu diberi attribut TRUE
			// kalau tidak diberi attribut true, bentuknya bkn array, hasilnya adl obyek.
			// caranya
			$dataprovinsi = json_decode($response, TRUE);

			$dataprovinsi = $dataprovinsi['rajaongkir']['results'];
			// echo "<pre>";
			// print_r($dataprovinsi);
			// echo "</pre>";			

			return $dataprovinsi;
		}
	}

	function update_kota($id_provinsi)
	{

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://api.rajaongkir.com/starter/city?id=&province=$id_provinsi",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"key: 4f09e388e68d3baedd96e97162177173"
				),
			));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$datakota = json_decode($response, TRUE);

			$datakota = $datakota['rajaongkir']['results'];

			// echo "<pre>";
			// print_r($datakota);
			// echo "</pre>";

			return $datakota;
		}
	}

	function update_ongkir($id_kota_asal, $id_kota_tujuan, $berat, $ekspedisi)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "origin=$id_kota_asal&destination=$id_kota_tujuan&weight=$berat&courier=$ekspedisi",
			CURLOPT_HTTPHEADER => array(
				"content-type: application/x-www-form-urlencoded",
				"key: 4f09e388e68d3baedd96e97162177173"
				),
			));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$dataongkir = json_decode($response, TRUE);
			$dataongkir = $dataongkir['rajaongkir']['results']['0']['costs'];
			// echo "<pre>";
			// print_r($dataongkir);
			// echo "</pre>";

			return $dataongkir;
		}
	}	
}
$apiongkir = new apiongkir();
?>