<?php 
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/danhmucapi.php');

    $db = new db();
    $connect = $db->connect();

    $danhmucapi = new danhmucapi($connect);
    
    $danhmucapi->trang = isset($_GET['trang']) ? $_GET['trang'] : die();
    $danhmucapi->sp_tungtrang = isset($_GET['sp_tungtrang']) ? $_GET['sp_tungtrang'] : die();
    $danhmucapi->hienthi = isset($_GET['hienthi']) ? $_GET['hienthi'] : die();
    $danhmucapi->search = isset($_GET['search']) ? $_GET['search'] : die();

    $readResult = $danhmucapi->readbypage();
    $total = $readResult['total'];
    $read = $readResult['data'];

    $num = count($read);

    if ($num > 0) {
        $danhmucapi_array = [];
        $danhmucapi_array['total'] = $total;
        $danhmucapi_array['data'] = [];

        foreach ($read as $row) {
            extract($row);

            $danhmucapi_item = array(
                    'madm' => $madm,
                    'tendm' => $tendm,
                    'hienthi' => $hienthi,
                    'uutien' => $uutien,
                    'url' => $url,
            );
            array_push($danhmucapi_array['data'], $danhmucapi_item);
        }
        echo json_encode($danhmucapi_array);
    } else {
        // Trường hợp không có dữ liệu
        echo json_encode(['total' => 0, 'data' => []]);
    }
?>