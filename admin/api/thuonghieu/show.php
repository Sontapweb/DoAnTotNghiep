<?php 
	header('Access-Control-Allow-Origin:*');
	header('Content-Type: application/json');

	include_once('../../config/db.php');
	include_once('../../model/thuonghieuapi.php');

	$db = new db();
	$connect = $db->connect();

	$thuonghieuapi = new thuonghieuapi($connect);
	
	$thuonghieuapi->math = isset($_GET['id']) ? $_GET['id'] : die();

	$thuonghieuapi->show();

	$thuonghieuapi_item = array(
				'math' => $thuonghieuapi->math,
				'tenth' => $thuonghieuapi->tenth,
				'hienthi' => $thuonghieuapi->hienthi,
				'uutien' => $thuonghieuapi->uutien,
				'title' => $thuonghieuapi->title,
				'description' => $thuonghieuapi->description,
				'url' => $thuonghieuapi->url,
				'keywords' => $thuonghieuapi->keywords,
			);
	print_r(json_encode($thuonghieuapi_item, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

 ?>