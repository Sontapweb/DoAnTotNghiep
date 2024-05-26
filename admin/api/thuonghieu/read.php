<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once('../../config/db.php');
    include_once('../../model/thuonghieuapi.php');

    $db = new db();
    $connect = $db->connect();

    $thuonghieuapi = new thuonghieuapi($connect);
    $read = $thuonghieuapi->read();

    $num = $read->rowCount();

    if($num > 0){
        $thuonghieuapi_array = [];
        $thuonghieuapi_array['data'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $thuonghieuapi_item = array(
                'math' => $math,
                'tenth' => $tenth,
                'url' => $url,
            );
            array_push($thuonghieuapi_array['data'], $thuonghieuapi_item);
        }
        echo json_encode($thuonghieuapi_array);
    }
?>