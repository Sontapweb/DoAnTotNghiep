<?php 
	header('Access-Control-Allow-Origin:*');
	header('Content-Type: application/json');

	include_once('../../config/db.php');
	include_once('../../model/clubapi.php');

	$db = new db();
	$connect = $db->connect();

	$clubapi = new clubapi($connect);
	
	$clubapi->id = isset($_GET['id']) ? $_GET['id'] : die();

	$clubapi->show();

	$clubapi_item = array(
				'id' => $clubapi->id,
                'ten' => $clubapi->ten,
                'mota' => $clubapi->mota,
                'tomtat' => $clubapi->tomtat,
                'thoigian' => $clubapi->thoigian,
                'hienthi' => $clubapi->hienthi,
                'uutien' => $clubapi->uutien,
                'hinhanh' => $clubapi->hinhanh,
				'title' => $clubapi->title,
                'description' => $clubapi->description,
                'keywords' => $clubapi->keywords,
                'url' => $clubapi->url,
			);
	print_r(json_encode($clubapi_item, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

 ?>