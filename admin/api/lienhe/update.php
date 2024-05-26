<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once('../../config/db.php');
include_once('../../model/lienheapi.php');

$db = new db();
$connect = $db->connect();

$lienheapi = new lienheapi($connect);

// Decode JSON data
$data = json_decode(file_get_contents("php://input"));

// Check if decoding is successful
if ($data) {
    $lienheapi->status = $data->status;
    $lienheapi->id = $data->id;

    if ($lienheapi->update()) {
        echo json_encode(array('message', 'Cập nhật thành công'));
    } else {
        echo json_encode(array('message', 'Cập nhật không thành công'));
    }
} else {
    // Handle JSON decoding error
    echo json_encode(array('message', 'Error decoding JSON data'));
}
?>