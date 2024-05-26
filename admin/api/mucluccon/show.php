<?php 
	header('Access-Control-Allow-Origin:*');
	header('Content-Type: application/json');

	include_once('../../config/db.php');
	include_once('../../model/muclucconapi.php');

	$db = new db();
	$connect = $db->connect();

	$muclucconapi = new muclucconapi($connect);
	
	$muclucconapi->id = isset($_GET['id']) ? $_GET['id'] : die();

	$muclucconapi->show();

	$muclucconapi_item = array(
				'id' => $muclucconapi->id,
                'tieude' => $muclucconapi->tieude,
                'noidung' => $muclucconapi->noidung,
                'thutu' => $muclucconapi->thutu,
                'mucluc_id' => $muclucconapi->mucluc_id,
                'url' => $muclucconapi->url,
			);
	print_r(json_encode($muclucconapi_item, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

 ?>