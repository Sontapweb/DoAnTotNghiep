<?php 
	header('Access-Control-Allow-Origin:*');
	header('Content-Type: application/json');

	include_once('../../config/db.php');
	include_once('../../model/productapi.php');

	$db = new db();
	$connect = $db->connect();

	$productapi = new productapi($connect);
	
	$productapi->masp = isset($_GET['masp']) ? $_GET['masp'] : die();

	$productapi->show();

	$productapi_item = array(
                'id' => $productapi->id,
                'masp' => $productapi->masp,
                'tensp' => $productapi->tensp,                
                'danhmuc' => $productapi->danhmuc,
                'thuonghieu' => $productapi->thuonghieu,
                'gia' => $productapi->gia,
                'giakm' => $productapi->giakm,
                'uutien' => $productapi->uutien,
                'loai' => $productapi->loai,
                'mausac' => $productapi->mausac,
                'kichco' => $productapi->kichco,
                'thoigian' => $productapi->thoigian,
                'hienthi' => $productapi->hienthi,                               
                'hinhanh' => $productapi->hinhanh,                
                'thongtin' => $productapi->thongtin,
                'title' => $productapi->title,
                'description' => $productapi->description,
                'keywords' => $productapi->keywords,
                'url' => $productapi->url                
			);
	print_r(json_encode($productapi_item, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

 ?>