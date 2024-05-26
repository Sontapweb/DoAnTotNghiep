<?php 
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/kichcoapi.php');

    $db = new db();
    $connect = $db->connect();

    $kichcoapi = new kichcoapi($connect);
    
    $kichcoapi->trang = isset($_GET['trang']) ? $_GET['trang'] : die();
    $kichcoapi->sp_tungtrang = isset($_GET['sp_tungtrang']) ? $_GET['sp_tungtrang'] : die();
    $kichcoapi->hienthi = isset($_GET['hienthi']) ? $_GET['hienthi'] : die();
    $kichcoapi->search = isset($_GET['search']) ? $_GET['search'] : die();

    $readResult = $kichcoapi->readbypage();
    $total = $readResult['total'];
    $read = $readResult['data'];

    $num = count($read);

    if ($num > 0) {
        $kichcoapi_array = [];
        $kichcoapi_array['total'] = $total;
        $kichcoapi_array['data'] = [];

        foreach ($read as $row) {
            extract($row);

            $kichcoapi_item = array(
                'id' => $id,
                'tenkichco' => $tenkichco,
                'hienthi' => $hienthi,
            );
            array_push($kichcoapi_array['data'], $kichcoapi_item);
        }
        echo json_encode($kichcoapi_array);
    } else {
        // Trường hợp không có dữ liệu
        echo json_encode(['total' => 0, 'data' => []]);
    }

 ?>