<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/donhangapi.php');

    $db = new db();
    $connect = $db->connect();

    $donhangapi = new donhangapi($connect);

    $donhangapi->trang = isset($_GET['trang']) ? $_GET['trang'] : die();
    $donhangapi->sp_tungtrang = isset($_GET['sp_tungtrang']) ? $_GET['sp_tungtrang'] : die();
    $donhangapi->search = isset($_GET['search']) ? $_GET['search'] : die();
    $donhangapi->filterstatus = isset($_GET['filterstatus']) ? $_GET['filterstatus'] : die();

    $readResult = $donhangapi->readbypage();
    $total = $readResult['total'];
    $read = $readResult['data'];

    $num = count($read);

    if ($num > 0) {
        $donhangapi_array = [];
        $donhangapi_array['total'] = $total;
        $donhangapi_array['data'] = [];

        foreach ($read as $row) {
            extract($row);

            $donhangapi_item = array(
                'orderid' => $orderid,
                'masp' => $masp,
                'tensp' => $tensp,
                'makh' => $makh,
                'soluong' => $soluong,
                'gia' => $gia,
                'hinhanh' => $hinhanh,
                'ngaydathang' => $ngaydathang,
                'trangthai' => $trangthai,
                'sId' => $sId,
                'hoten' => $hoten,
                'sdt' => $sdt,
                'diachi' => $diachi,
                'mausac' => $mausac,
                'kichco' => $kichco,
                'tenmau' => $tenmau,
                'tenkichco' => $tenkichco,
            );
            array_push($donhangapi_array['data'], $donhangapi_item);
        }
        echo json_encode($donhangapi_array);
    } else {
        // Trường hợp không có dữ liệu
        echo json_encode(['total' => 0, 'data' => []]);
    }
?>
