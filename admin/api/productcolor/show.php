<?php 
	header('Access-Control-Allow-Origin:*');
	header('Content-Type: application/json');

	include_once('../../config/db.php');
	include_once('../../model/productcolorapi.php');

	$db = new db();
	$connect = $db->connect();

	$productcolorapi = new productcolorapi($connect);
	
	$productcolorapi->id = isset($_GET['id']) ? $_GET['id'] : die();

	$productcolorapi->show();

	$productcolorapi_item = array(
                'masp' => $productcolorapi->masp,
                'tensp' => $productcolorapi->tensp,              
                'gia' => $productcolorapi->gia,
                'giakm' => $productcolorapi->giakm,
                'uutien' => $productcolorapi->uutien,
                'mausac' => $productcolorapi->mausac,
                'kichco' => $productcolorapi->kichco,
                'thoigian' => $productcolorapi->thoigian,
                'hienthi' => $productcolorapi->hienthi,                               
                'hinhanh' => $productcolorapi->hinhanh,                
                'soluong' => $productcolorapi->soluong,
                'url' => $productcolorapi->url,
                'id' => $productcolorapi->id,
			);
	print_r(json_encode($productcolorapi_item, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

 ?>