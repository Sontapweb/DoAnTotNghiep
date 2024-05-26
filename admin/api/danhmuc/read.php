<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once('../../config/db.php');
    include_once('../../model/danhmucapi.php');

    $db = new db();
    $connect = $db->connect();

    $danhmucapi = new danhmucapi($connect);
    $read = $danhmucapi->read();

    $num = $read->rowCount();

    if($num > 0){
        $danhmucapi_array = [];
        $danhmucapi_array['data'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $danhmucapi_item = array(
                'madm' => $madm,
                'tendm' => $tendm,
                'url' => $url,
            );
            array_push($danhmucapi_array['data'], $danhmucapi_item);
        }
        echo json_encode($danhmucapi_array);
    }
?>