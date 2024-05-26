<?php 
	header('Access-Control-Allow-Origin:*');
	header('Content-Type: application/json');

	include_once('../../config/db.php');
	include_once('../../model/tintucapi.php');

	$db = new db();
	$connect = $db->connect();

	$tintucapi = new tintucapi($connect);
	
	$tintucapi->id = isset($_GET['id']) ? $_GET['id'] : die();

	$tintucapi->show();

	$tintucapi_item = array(
				'id' => $tintucapi->id,
                'tieude' => $tintucapi->tieude,
                'mota' => $tintucapi->mota,
                'noidung' => $tintucapi->noidung,
                'danhmuc' => $tintucapi->danhmuc,
                'thoigian' => $tintucapi->thoigian,
                'hienthi' => $tintucapi->hienthi,
                'luotxem' => $tintucapi->luotxem,
                'uutien' => $tintucapi->uutien,
                'hinhanh' => $tintucapi->hinhanh,
                'title' => $tintucapi->title,
                'description' => $tintucapi->description,
                'keywords' => $tintucapi->keywords,
                'url' => $tintucapi->url,
			);
	print_r(json_encode($tintucapi_item, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

 ?>