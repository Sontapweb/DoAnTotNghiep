<?php 
	header('Access-Control-Allow-Origin:*');
	header('Content-Type: application/json');

	include_once('../../config/db.php');
	include_once('../../model/muclucapi.php');

	$db = new db();
	$connect = $db->connect();

	$muclucapi = new muclucapi($connect);
	
	$muclucapi->id = isset($_GET['id']) ? $_GET['id'] : die();

	$muclucapi->show();

	$muclucapi_item = array(
				'id' => $muclucapi->id,
                'tieude' => $muclucapi->tieude,
                'noidung' => $muclucapi->noidung,
                'thutu' => $muclucapi->thutu,
                'spid' => $muclucapi->spid,
                'dmid' => $muclucapi->dmid,
                'url' => $muclucapi->url,
			);
	print_r(json_encode($muclucapi_item, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

 ?>