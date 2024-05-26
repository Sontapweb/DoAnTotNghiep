<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/lienheapi.php');

    $db = new db();
    $connect = $db->connect();

    $lienheapi = new lienheapi($connect);

    $lienheapi->trang = isset($_GET['trang']) ? $_GET['trang'] : die();
    $lienheapi->sp_tungtrang = isset($_GET['sp_tungtrang']) ? $_GET['sp_tungtrang'] : die();
    $lienheapi->search = isset($_GET['search']) ? $_GET['search'] : die();
    $lienheapi->filterstatus = isset($_GET['filterstatus']) ? $_GET['filterstatus'] : die();

    $readResult = $lienheapi->readbypage();
    $total = $readResult['total'];
    $read = $readResult['data'];

    $num = count($read);

    if ($num > 0) {
        $lienheapi_array = [];
        $lienheapi_array['total'] = $total;
        $lienheapi_array['data'] = [];

        foreach ($read as $row) {
            extract($row);

            $lienheapi_item = array(
                'id' => $id,
                'ten' => $ten,
                'sdt' => $sdt,
                'email' => $email,
                'chude' => $chude,
                'thoigian' => $thoigian,
                'status' => $status,
            );
            array_push($lienheapi_array['data'], $lienheapi_item);
        }
        echo json_encode($lienheapi_array);
    } else {
        // Trường hợp không có dữ liệu
        echo json_encode(['total' => 0, 'data' => []]);
    }
?>
