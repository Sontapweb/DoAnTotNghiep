<?php 
	header('Access-Control-Allow-Origin:*');
	header('Content-Type: application/json');

	include_once('../../config/db.php');
	include_once('../../model/sliderapi.php');

	$db = new db();
	$connect = $db->connect();

	$sliderapi = new sliderapi($connect);
	
	$sliderapi->id = isset($_GET['id']) ? $_GET['id'] : die();

	$sliderapi->show();

	$sliderapi_item = array(
				'id' => $sliderapi->id,
                'ten' => $sliderapi->ten,
                'noidung' => $sliderapi->noidung,
                'xemthem' => $sliderapi->xemthem,
                'status' => $sliderapi->status,
                'uutien' => $sliderapi->uutien,
                'hinhanh' => $sliderapi->hinhanh,
			);
	print_r(json_encode($sliderapi_item, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

 ?>