<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once('../../config/db.php');
    include_once('../../model/mausacapi.php');

    $db = new db();
    $connect = $db->connect();

    $mausacapi = new mausacapi($connect);
    $read = $mausacapi->read();

    $num = $read->rowCount();

    if($num > 0){
        $mausacapi_array = [];
        $mausacapi_array['data'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $mausacapi_item = array(
                'id' => $id,
                'tenmau' => $tenmau,
                'hienthi' => $hienthi,
            );
            array_push($mausacapi_array['data'], $mausacapi_item);
        }
        echo json_encode($mausacapi_array);
    }
?>