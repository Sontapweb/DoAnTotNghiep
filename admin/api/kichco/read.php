<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once('../../config/db.php');
    include_once('../../model/kichcoapi.php');

    $db = new db();
    $connect = $db->connect();

    $kichcoapi = new kichcoapi($connect);
    $read = $kichcoapi->read();

    $num = $read->rowCount();

    if($num > 0){
        $kichcoapi_array = [];
        $kichcoapi_array['data'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $kichcoapi_item = array(
                'id' => $id,
                'tenkichco' => $tenkichco,
                'hienthi' => $hienthi,
            );
            array_push($kichcoapi_array['data'], $kichcoapi_item);
        }
        echo json_encode($kichcoapi_array);
    }
?>