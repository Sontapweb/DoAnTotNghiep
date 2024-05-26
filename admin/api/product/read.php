<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once('../../config/db.php');
    include_once('../../model/productapi.php');

    $db = new db();
    $connect = $db->connect();

    $productapi = new productapi($connect);
    $read = $productapi->read();

    $num = $read->rowCount();

    if($num > 0){
        $productapi_array = [];
        $productapi_array['data'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $productapi_item = array(
                'id' => $id, 
                'masp' => $masp, 
                'tensp' => $tensp,               
                'danhmuc' => $danhmuc,
                'gia' => $gia,
                'uutien' => $uutien,
                'thoigian' => $thoigian,
                'hienthi' => $hienthi,                               
                'hinhanh' => $hinhanh,                
                'url' => $url,
            );
            array_push($productapi_array['data'], $productapi_item);
        }
        echo json_encode($productapi_array);
    }
?>