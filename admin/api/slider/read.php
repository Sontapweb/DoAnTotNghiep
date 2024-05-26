<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once('../../config/db.php');
    include_once('../../model/sliderapi.php');

    $db = new db();
    $connect = $db->connect();

    $sliderapi = new sliderapi($connect);
    $read = $sliderapi->read();

    $num = $read->rowCount();

    if($num > 0){
        $sliderapi_array = [];
        $sliderapi_array['data'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $sliderapi_item = array(
                'id' => $id,
                'ten' => $ten,
                'noidung' => $noidung,
                'xemthem' => $xemthem,
                'uutien' => $uutien,
                'status' => $status,
                'hinhanh' => $hinhanh,
            );
            array_push($sliderapi_array['data'], $sliderapi_item);
        }
        echo json_encode($sliderapi_array);
    }
?>