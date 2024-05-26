<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once('../../config/db.php');
include_once('../../model/productsizeapi.php');

$db = new db();
$connect = $db->connect();

$productsizeapi = new productsizeapi($connect);

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productsizeapi->gia = $_POST['gia'];
    $productsizeapi->giakm = $_POST['giakm'];
    $productsizeapi->mausac = $_POST['mausac'];
    $productsizeapi->kichco = $_POST['kichco'];
    $productsizeapi->soluong = $_POST['soluong'];
    $productsizeapi->uutien = $_POST['uutien'];    
    $productsizeapi->thoigian = $_POST['thoigian'];
    $productsizeapi->hienthi = $_POST['hienthi'];
    $productsizeapi->id = $_POST['id'];

    if ($productsizeapi->update()) {
        echo json_encode(array('message' => 'Cập nhật thành công'));
    } else {
        echo json_encode(array('message' => 'Cập nhật không thành công'));
    }
} else {
    echo json_encode(array('message' => 'Invalid request method'));
}
?>
