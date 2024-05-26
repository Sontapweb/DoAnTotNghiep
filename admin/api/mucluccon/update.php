<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once('../../config/db.php');
include_once('../../model/muclucconapi.php');

$db = new db();
$connect = $db->connect();

$muclucconapi = new muclucconapi($connect);

// Decode JSON data
$data = json_decode(file_get_contents("php://input"));

// Check if decoding is successful
if ($data) {
    $muclucconapi->tieude = $data->tieude;
    $muclucconapi->noidung = $data->noidung;
    $muclucconapi->thutu = $data->thutu;
    $muclucconapi->url = $data->url;
    $muclucconapi->id = $data->id;

    if ($muclucconapi->update()) {
        echo json_encode(array('message', 'Cập nhật thành công'));
    } else {
        echo json_encode(array('message', 'Cập nhật không thành công'));
    }
} else {
    // Handle JSON decoding error
    echo json_encode(array('message', 'Error decoding JSON data'));
}
?>