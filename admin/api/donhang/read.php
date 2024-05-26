<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once('../../config/db.php');
    include_once('../../model/donhangapi.php');

    $db = new db();
    $connect = $db->connect();

    $donhangapi = new donhangapi($connect);
    $read = $donhangapi->read();

    $num = $read->rowCount();

    if($num > 0){
        $donhangapi_array = [];
        $donhangapi_array['data'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $donhangapi_item = array(
                'madm' => $madm,
                'tendm' => $tendm,
                'danhmuc' => $danhmuc,
                'noidung' => $noidung,
                'noidungcuoi' => $noidungcuoi,
                'hienthi' => $hienthi,
                'uutien' => $uutien,
                'menuchinh' => $menuchinh,
                'chitiet' => $chitiet,
                'linkchitiet' => $linkchitiet,
                'title' => $title,
                'description' => $description,
                'keywords' => $keywords,
                'url' => $url,
            );
            array_push($donhangapi_array['data'], $donhangapi_item);
        }
        echo json_encode($donhangapi_array);
    }
?>