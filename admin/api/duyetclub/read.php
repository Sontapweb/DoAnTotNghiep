<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once('../../config/db.php');
    include_once('../../model/duyetclubapi.php');

    $db = new db();
    $connect = $db->connect();

    $duyetclubapi = new duyetclubapi($connect);
    $read = $duyetclubapi->read();

    $num = $read->rowCount();

    if($num > 0){
        $duyetclubapi_array = [];
        $duyetclubapi_array['data'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $duyetclubapi_item = array(
                'id' => $id,
                'iduser' => $iduser,
                'idclub' => $idclub,
                'duyet' => $duyet,
                'status' => $status,
            );
            array_push($duyetclubapi_array['data'], $duyetclubapi_item);
        }
        echo json_encode($duyetclubapi_array);
    }
?>