<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once('../../config/db.php');
    include_once('../../model/cauhinhapi.php');

    $db = new db();
    $connect = $db->connect();

    $cauhinhapi = new cauhinhapi($connect);
    $read = $cauhinhapi->read();

    $num = $read->rowCount();

    if($num > 0){
        $cauhinhapi_array = [];
        $cauhinhapi_array['data'] = [];

        while($row = $read->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $cauhinhapi_item = array(
                'id' => $id,
                'tieude' => $tieude,
                'keywords' => $keywords,
                'mota' => $mota,
                'hotline' => $hotline,
                'email' => $email,
                'zalo' => $zalo,
                'youtube' => $youtube,
                'twitter' => $twitter,
                'google' => $google,
                'instagram' => $instagram,
                'facebook' => $facebook,
                'messenger' => $messenger,
                'googleanalytics' => $googleanalytics,
                'webmastertool' => $webmastertool,
                'logo' => $logo,
            );
            array_push($cauhinhapi_array['data'], $cauhinhapi_item);
        }
        echo json_encode($cauhinhapi_array);
    }
?>