<?php 
session_start();
require_once('Facebook/autoload.php');


$FBObject = new \Facebook\Facebook([
	'app_id'=>'1374647803317312',
	'app_secret'=>'edcbbca310f4b9b6ca2c042e8b80a49b',
	'default_graph_version'=>'v12.0'
]);	

$handler = $FBObject -> getRedirectLoginHelper();
 ?>

