<?php 
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/muclucconapi.php');

    $db = new db();
    $connect = $db->connect();

    $muclucconapi = new muclucconapi($connect);
    
    $muclucconapi->trang = isset($_GET['trang']) ? $_GET['trang'] : die();
    $muclucconapi->sp_tungtrang = isset($_GET['sp_tungtrang']) ? $_GET['sp_tungtrang'] : die();
    $muclucconapi->search = isset($_GET['search']) ? $_GET['search'] : die();
    $muclucconapi->mlfilter = isset($_GET['mlfilter']) ? $_GET['mlfilter'] : die();

    $readResult = $muclucconapi->readbypage();
    $thuoctieude = $readResult['thuoctieude'];
    $total = $readResult['total'];
    $read = $readResult['data'];

    $num = count($read);

    if ($num > 0) {
        $muclucconapi_array = [];
        $muclucconapi_array['thuoctieude'] = $thuoctieude;
        $muclucconapi_array['total'] = $total;
        $muclucconapi_array['data'] = [];

        foreach ($read as $row) {
            extract($row);

            $muclucconapi_item = array(
                'id' => $id,
                'tieude' => $tieude,
                'thutu' => $thutu,
                'mucluc_id' => $mucluc_id,
                'url' => $url,
            );
            array_push($muclucconapi_array['data'], $muclucconapi_item);
        }
        echo json_encode($muclucconapi_array);
    } else {
        // Trường hợp không có dữ liệu
        echo json_encode(['total' => 0, 'data' => []]);
    }
?>