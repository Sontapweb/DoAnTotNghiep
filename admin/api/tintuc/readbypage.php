<?php 
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/tintucapi.php');

    $db = new db();
    $connect = $db->connect();

    $tintucapi = new tintucapi($connect);
    
    $tintucapi->trang = isset($_GET['trang']) ? $_GET['trang'] : die();
    $tintucapi->sp_tungtrang = isset($_GET['sp_tungtrang']) ? $_GET['sp_tungtrang'] : die();
    $tintucapi->hienthi = isset($_GET['hienthi']) ? $_GET['hienthi'] : die();
    $tintucapi->search = isset($_GET['search']) ? $_GET['search'] : die();
    $tintucapi->filterdanhmuc = isset($_GET['filterdanhmuc']) ? $_GET['filterdanhmuc'] : die();

    $readResult = $tintucapi->readbypage();
    $total = $readResult['total'];
    $read = $readResult['data'];

    $num = count($read);

    if ($num > 0) {
        $tintucapi_array = [];
        $tintucapi_array['total'] = $total;
        $tintucapi_array['data'] = [];

        foreach ($read as $row) {
            extract($row);

            $tintucapi_item = array(
                'id' => $id,
                'tieude' => $tieude,
                'danhmuc' => $danhmuc,
                'thoigian' => $thoigian,
                'hienthi' => $hienthi,
                'hinhanh' => $hinhanh,
                'tendanhmuc' => $tendanhmuc,
            );
            array_push($tintucapi_array['data'], $tintucapi_item);
        }
        echo json_encode($tintucapi_array);
    } else {
        // Trường hợp không có dữ liệu
        echo json_encode(['total' => 0, 'data' => []]);
    }

 ?>