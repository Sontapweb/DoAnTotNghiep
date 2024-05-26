<?php 
	header('Access-Control-Allow-Origin:*');
	header('Content-Type: application/json');

	include_once('../../config/db.php');
	include_once('../../model/cauhinhapi.php');

	$db = new db();
	$connect = $db->connect();

	$cauhinhapi = new cauhinhapi($connect);
	
	$cauhinhapi->id = isset($_GET['id']) ? $_GET['id'] : die();

	$cauhinhapi->show();

	$cauhinhapi_item = array(
				'id' => $cauhinhapi->id,
                'tieude' => $cauhinhapi->tieude,
                'keywords' => $cauhinhapi->keywords,
                'mota' => $cauhinhapi->mota,
                'hotline' => $cauhinhapi->hotline,
                'email' => $cauhinhapi->email,
                'zalo' => $cauhinhapi->zalo,
                'youtube' => $cauhinhapi->youtube,
                'twitter' => $cauhinhapi->twitter,
                'google' => $cauhinhapi->google,
                'instagram' => $cauhinhapi->instagram,
                'facebook' => $cauhinhapi->facebook,
                'messenger' => $cauhinhapi->messenger,
                'googleanalytics' => $cauhinhapi->googleanalytics,
                'webmastertool' => $cauhinhapi->webmastertool,
                'logo' => $cauhinhapi->logo,
			);
	print_r(json_encode($cauhinhapi_item, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

 ?>