<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once('../../config/db.php');
include_once('../../model/muclucapi.php');

$db = new db();
$connect = $db->connect();

$muclucapi = new muclucapi($connect);

// Decode JSON data
$data = json_decode(file_get_contents("php://input"));

// Check if decoding is successful
if ($data) {
    $muclucapi->id = $data->id;

    if ($muclucapi->delete()) {
        echo json_encode(array('message', 'Xoa thanh cong'));
    } else {
        echo json_encode(array('message', 'Xoa khong thanh cong'));
    }
} else {
    // Handle JSON decoding error
    echo json_encode(array('message', 'Error decoding JSON data'));
}
?>