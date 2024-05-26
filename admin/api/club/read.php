<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once('../../config/db.php');
    include_once('../../model/clubapi.php');

    $db = new db();
    $connect = $db->connect();

    $clubapi = new clubapi($connect);
    $read = $clubapi->read();

    $num = $read->rowCount();

    if($num > 0){
        $clubapi_array = [];
        $clubapi_array['data'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $clubapi_item = array(
                'id' => $id,
                'tieude' => $tieude,
                'danhmuc' => $danhmuc,
                'thoigian' => $thoigian,
                'hienthi' => $hienthi,
                'hinhanh' => $hinhanh,
                'url' => $url,
            );
            array_push($clubapi_array['data'], $clubapi_item);
        }
        echo json_encode($clubapi_array);
    }
?>