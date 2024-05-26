<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once('../../config/db.php');
    include_once('../../model/danhmuctintuc.php');

    $db = new db();
    $connect = $db->connect();

    $danhmuctintuc = new Danhmuctintuc($connect);
    $read = $danhmuctintuc->read();

    $num = $read->rowCount();

    if($num > 0){
        $danhmuctintuc_array = [];
        $danhmuctintuc_array['data'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $danhmuctintuc_item = array(
                'madm' => $madm,
                'tendm' => $tendm,
                'hienthi' => $hienthi,
                'uutien' => $uutien,
                'title' => $title,
                'description' => $description,
                'keywords' => $keywords,
                'url' => $url,
            );
            array_push($danhmuctintuc_array['data'], $danhmuctintuc_item);
        }
        echo json_encode($danhmuctintuc_array);
    }
?>