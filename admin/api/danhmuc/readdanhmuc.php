<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once('../../config/db.php');
    include_once('../../model/danhmucapi.php');

    $db = new db();
    $connect = $db->connect();

    $danhmucapi = new danhmucapi($connect);
    $readResult = $danhmucapi->readdanhmuc(); // Đổi tên hàm từ readdanhmuc() thành read()
    $read = $readResult['data'];

    $num = count($read);

    if($num > 0){
        $danhmucapi_array = [];

        foreach ($read as $row) {
            $danhmucapi_item = array(
                'madm' => $row['madm'],
                'tendm' => $row['tendm'],
                'danhmuc' => $row['danhmuc'],
                'hienthi' => $row['hienthi'],
                'uutien' => $row['uutien'],
                'menuchinh' => $row['menuchinh'],
                'subcategories' => isset($row['subcategories']) ? $row['subcategories'] : [],
            );
            array_push($danhmucapi_array, $danhmucapi_item);
        }
        echo json_encode($danhmucapi_array);
    }

?>