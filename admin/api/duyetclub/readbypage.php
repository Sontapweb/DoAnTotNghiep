<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/duyetclubapi.php');

    $db = new db();
    $connect = $db->connect();

    $duyetclubapi = new duyetclubapi($connect);

    $duyetclubapi->trang = isset($_GET['trang']) ? $_GET['trang'] : die();
    $duyetclubapi->sp_tungtrang = isset($_GET['sp_tungtrang']) ? $_GET['sp_tungtrang'] : die();
    $duyetclubapi->search = isset($_GET['search']) ? $_GET['search'] : die();
    $duyetclubapi->filterstatus = isset($_GET['filterstatus']) ? $_GET['filterstatus'] : die();

    $readResult = $duyetclubapi->readbypage();
    $total = $readResult['total'];
    $read = $readResult['data'];

    $num = count($read);

    if ($num > 0) {
        $duyetclubapi_array = [];
        $duyetclubapi_array['total'] = $total;
        $duyetclubapi_array['data'] = [];

        foreach ($read as $row) {
            extract($row);

            $duyetclubapi_item = array(
                'id' => $id,
                'iduser' => $iduser,
                'idclub' => $idclub,
                'status' => $status,
                'tennguoidung' => $tennguoidung,
                'tenclub' => $tenclub,
            );
            array_push($duyetclubapi_array['data'], $duyetclubapi_item);
        }
        echo json_encode($duyetclubapi_array);
    } else {
        // Trường hợp không có dữ liệu
        echo json_encode(['total' => 0, 'data' => []]);
    }
?>
