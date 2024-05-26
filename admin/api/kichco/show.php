<?php 
	header('Access-Control-Allow-Origin:*');
	header('Content-Type: application/json');

	include_once('../../config/db.php');
	include_once('../../model/kichcoapi.php');

	$db = new db();
	$connect = $db->connect();

	$kichcoapi = new kichcoapi($connect);
	
	$kichcoapi->id = isset($_GET['id']) ? $_GET['id'] : die();

	$kichcoapi->show();

	$kichcoapi_item = array(
				'id' => $kichcoapi->id,
				'tenkichco' => $kichcoapi->tenkichco,
				'hienthi' => $kichcoapi->hienthi,
			);
	print_r(json_encode($kichcoapi_item, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

 ?>