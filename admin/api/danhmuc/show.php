<?php 
	header('Access-Control-Allow-Origin:*');
	header('Content-Type: application/json');

	include_once('../../config/db.php');
	include_once('../../model/danhmucapi.php');

	$db = new db();
	$connect = $db->connect();

	$danhmucapi = new danhmucapi($connect);
	
	$danhmucapi->madm = isset($_GET['id']) ? $_GET['id'] : die();

	$danhmucapi->show();

	$danhmucapi_item = array(
				'madm' => $danhmucapi->madm,
				'tendm' => $danhmucapi->tendm,
				'hienthi' => $danhmucapi->hienthi,
				'uutien' => $danhmucapi->uutien,
				'title' => $danhmucapi->title,
				'description' => $danhmucapi->description,
				'url' => $danhmucapi->url,
				'keywords' => $danhmucapi->keywords,
			);
	print_r(json_encode($danhmucapi_item, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

 ?>