<?php 
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/mausacapi.php');

    $db = new db();
    $connect = $db->connect();

    $mausacapi = new mausacapi($connect);
    
    $mausacapi->trang = isset($_GET['trang']) ? $_GET['trang'] : die();
    $mausacapi->sp_tungtrang = isset($_GET['sp_tungtrang']) ? $_GET['sp_tungtrang'] : die();
    $mausacapi->hienthi = isset($_GET['hienthi']) ? $_GET['hienthi'] : die();
    $mausacapi->search = isset($_GET['search']) ? $_GET['search'] : die();

    $readResult = $mausacapi->readbypage();
    $total = $readResult['total'];
    $read = $readResult['data'];

    $num = count($read);

    if ($num > 0) {
        $mausacapi_array = [];
        $mausacapi_array['total'] = $total;
        $mausacapi_array['data'] = [];

        foreach ($read as $row) {
            extract($row);

            $mausacapi_item = array(
                'id' => $id,
                'tenmau' => $tenmau,
                'hienthi' => $hienthi,
            );
            array_push($mausacapi_array['data'], $mausacapi_item);
        }
        echo json_encode($mausacapi_array);
    } else {
        // Trường hợp không có dữ liệu
        echo json_encode(['total' => 0, 'data' => []]);
    }

 ?>