<?php 
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/productsizeapi.php');

    $db = new db();
    $connect = $db->connect();

    $productsizeapi = new productsizeapi($connect);
    
    $productsizeapi->trang = isset($_GET['trang']) ? $_GET['trang'] : die();
    $productsizeapi->sp_tungtrang = isset($_GET['sp_tungtrang']) ? $_GET['sp_tungtrang'] : die();
    $productsizeapi->hienthi = isset($_GET['hienthi']) ? $_GET['hienthi'] : die();
    $productsizeapi->search = isset($_GET['search']) ? $_GET['search'] : die();
    $productsizeapi->filtersanpham = isset($_GET['filtersanpham']) ? $_GET['filtersanpham'] : die();
    $productsizeapi->filtercolor = isset($_GET['filtercolor']) ? $_GET['filtercolor'] : die();

    $readResult = $productsizeapi->readbypage();
    $total = $readResult['total'];
    $read = $readResult['data'];

    $num = count($read);

    if ($num > 0) {
        $productsizeapi_array = [];
        $productsizeapi_array['total'] = $total;
        $productsizeapi_array['data'] = [];

        foreach ($read as $row) {
            extract($row);

            $productsizeapi_item = array(
                'id' => $id,
                'masp' => $masp,
                'tensp' => $tensp,              
                'thoigian' => $thoigian,
                'hienthi' => $hienthi,                               
                'hinhanh' => $hinhanh,   
                'tenmau' => $tenmau,                               
                'tenkichco' => $tenkichco, 
                'soluong' => $soluong,          
            );
            array_push($productsizeapi_array['data'], $productsizeapi_item);
        }
        echo json_encode($productsizeapi_array);
    } else {
        // Trường hợp không có dữ liệu
        echo json_encode(['total' => 0, 'data' => []]);
    }

 ?>