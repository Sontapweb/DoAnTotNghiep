<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once('../../config/db.php');
    include_once('../../model/lienheapi.php');

    $db = new db();
    $connect = $db->connect();

    $lienheapi = new lienheapi($connect);
    $read = $lienheapi->read();

    $num = $read->rowCount();

    if($num > 0){
        $lienheapi_array = [];
        $lienheapi_array['data'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $lienheapi_item = array(
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
            array_push($lienheapi_array['data'], $lienheapi_item);
        }
        echo json_encode($lienheapi_array);
    }
?>