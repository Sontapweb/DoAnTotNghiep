<?php 
	header('Access-Control-Allow-Origin:*');
	header('Content-Type: application/json');

	include_once('../../config/db.php');
	include_once('../../model/productsizeapi.php');

	$db = new db();
	$connect = $db->connect();

	$productsizeapi = new productsizeapi($connect);
	
	$productsizeapi->id = isset($_GET['id']) ? $_GET['id'] : die();

	$productsizeapi->show();

	$productsizeapi_item = array(
                'masp' => $productsizeapi->masp,
                'tensp' => $productsizeapi->tensp,               
                'gia' => $productsizeapi->gia,
                'giakm' => $productsizeapi->giakm,
                'uutien' => $productsizeapi->uutien,
                'mausac' => $productsizeapi->mausac,
                'kichco' => $productsizeapi->kichco,
                'thoigian' => $productsizeapi->thoigian,
                'hienthi' => $productsizeapi->hienthi,                               
                'hinhanh' => $productsizeapi->hinhanh,                
                'soluong' => $productsizeapi->soluong,
                'url' => $productsizeapi->url,
                'id' => $productsizeapi->id,
			);
	print_r(json_encode($productsizeapi_item, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

 ?>