<?php 
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/thuonghieuapi.php');

    $db = new db();
    $connect = $db->connect();

    $thuonghieuapi = new thuonghieuapi($connect);
    
    $thuonghieuapi->trang = isset($_GET['trang']) ? $_GET['trang'] : die();
    $thuonghieuapi->sp_tungtrang = isset($_GET['sp_tungtrang']) ? $_GET['sp_tungtrang'] : die();
    $thuonghieuapi->hienthi = isset($_GET['hienthi']) ? $_GET['hienthi'] : die();
    $thuonghieuapi->search = isset($_GET['search']) ? $_GET['search'] : die();

    $readResult = $thuonghieuapi->readbypage();
    $total = $readResult['total'];
    $read = $readResult['data'];

    $num = count($read);

    if ($num > 0) {
        $thuonghieuapi_array = [];
        $thuonghieuapi_array['total'] = $total;
        $thuonghieuapi_array['data'] = [];

        foreach ($read as $row) {
            extract($row);

            $thuonghieuapi_item = array(
                'math' => $math,
                'tenth' => $tenth,
                'hienthi' => $hienthi,
                'url' => $url,
            );
            array_push($thuonghieuapi_array['data'], $thuonghieuapi_item);
        }
        echo json_encode($thuonghieuapi_array);
    } else {
        // Trường hợp không có dữ liệu
        echo json_encode(['total' => 0, 'data' => []]);
    }

 ?>