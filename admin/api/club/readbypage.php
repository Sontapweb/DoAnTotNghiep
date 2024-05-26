<?php 
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/clubapi.php');

    $db = new db();
    $connect = $db->connect();

    $clubapi = new clubapi($connect);
    
    $clubapi->trang = isset($_GET['trang']) ? $_GET['trang'] : die();
    $clubapi->sp_tungtrang = isset($_GET['sp_tungtrang']) ? $_GET['sp_tungtrang'] : die();
    $clubapi->hienthi = isset($_GET['hienthi']) ? $_GET['hienthi'] : die();
    $clubapi->search = isset($_GET['search']) ? $_GET['search'] : die();

    $readResult = $clubapi->readbypage();
    $total = $readResult['total'];
    $read = $readResult['data'];

    $num = count($read);

    if ($num > 0) {
        $clubapi_array = [];
        $clubapi_array['total'] = $total;
        $clubapi_array['data'] = [];

        foreach ($read as $row) {
            extract($row);

            $clubapi_item = array(
                'id' => $id,
                'ten' => $ten,
                'thoigian' => $thoigian,
                'hienthi' => $hienthi,
                'hinhanh' => $hinhanh,
            );
            array_push($clubapi_array['data'], $clubapi_item);
        }
        echo json_encode($clubapi_array);
    } else {
        // Trường hợp không có dữ liệu
        echo json_encode(['total' => 0, 'data' => []]);
    }

 ?>