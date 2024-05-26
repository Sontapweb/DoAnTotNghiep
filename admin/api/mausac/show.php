<?php 
	header('Access-Control-Allow-Origin:*');
	header('Content-Type: application/json');

	include_once('../../config/db.php');
	include_once('../../model/mausacapi.php');

	$db = new db();
	$connect = $db->connect();

	$mausacapi = new mausacapi($connect);
	
	$mausacapi->id = isset($_GET['id']) ? $_GET['id'] : die();

	$mausacapi->show();

	$mausacapi_item = array(
				'id' => $mausacapi->id,
				'tenmau' => $mausacapi->tenmau,
				'hienthi' => $mausacapi->hienthi,
			);
	print_r(json_encode($mausacapi_item, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

 ?>