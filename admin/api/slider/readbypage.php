<?php 
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/sliderapi.php');

    $db = new db();
    $connect = $db->connect();

    $sliderapi = new sliderapi($connect);
    
    $sliderapi->trang = isset($_GET['trang']) ? $_GET['trang'] : die();
    $sliderapi->sp_tungtrang = isset($_GET['sp_tungtrang']) ? $_GET['sp_tungtrang'] : die();
    $sliderapi->status = isset($_GET['status']) ? $_GET['status'] : die();
    $sliderapi->search = isset($_GET['search']) ? $_GET['search'] : die();

    $readResult = $sliderapi->readbypage();
    $total = $readResult['total'];
    $read = $readResult['data'];

    $num = count($read);

    if ($num > 0) {
        $sliderapi_array = [];
        $sliderapi_array['total'] = $total;
        $sliderapi_array['data'] = [];

        foreach ($read as $row) {
            extract($row);

            $sliderapi_item = array(
                'id' => $id,
                'ten' => $ten,
                'noidung' => $noidung,
                'xemthem' => $xemthem,
                'status' => $status,
                'uutien' => $uutien,
                'hinhanh' => $hinhanh,
            );
            array_push($sliderapi_array['data'], $sliderapi_item);
        }
        echo json_encode($sliderapi_array);
    } else {
        // Trường hợp không có dữ liệu
        echo json_encode(['total' => 0, 'data' => []]);
    }

 ?>