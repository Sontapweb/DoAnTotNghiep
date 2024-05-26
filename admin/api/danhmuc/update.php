<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once('../../config/db.php');
include_once('../../model/danhmucapi.php');

$db = new db();
$connect = $db->connect();

$danhmucapi = new danhmucapi($connect);

// Decode JSON data
$data = json_decode(file_get_contents("php://input"));

// Check if decoding is successful
if ($data) {
    $danhmucapi->tendm = $data->tendm;
    $danhmucapi->hienthi = $data->hienthi;
    $danhmucapi->uutien = $data->uutien;
    $danhmucapi->title = $data->title;
    $danhmucapi->description = $data->description;
    $danhmucapi->url = $data->url;
    $danhmucapi->keywords = $data->keywords;
    $danhmucapi->madm = $data->madm;

    if ($danhmucapi->update()) {
        echo json_encode(array('message', 'Cập nhật thành công'));
    } else {
        echo json_encode(array('message', 'Cập nhật không thành công'));
    }
} else {
    // Handle JSON decoding error
    echo json_encode(array('message', 'Error decoding JSON data'));
}
?>