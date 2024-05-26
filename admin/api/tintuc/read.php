<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once('../../config/db.php');
    include_once('../../model/tintucapi.php');

    $db = new db();
    $connect = $db->connect();

    $tintucapi = new tintucapi($connect);
    $read = $tintucapi->read();

    $num = $read->rowCount();

    if($num > 0){
        $tintucapi_array = [];
        $tintucapi_array['data'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $tintucapi_item = array(
                'id' => $id,
                'tieude' => $tieude,
                'danhmuc' => $danhmuc,
                'thoigian' => $thoigian,
                'hienthi' => $hienthi,
                'hinhanh' => $hinhanh,
                'url' => $url,
            );
            array_push($tintucapi_array['data'], $tintucapi_item);
        }
        echo json_encode($tintucapi_array);
    }
?>