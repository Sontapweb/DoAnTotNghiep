<?php 
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/productcolorapi.php');

    $db = new db();
    $connect = $db->connect();

    $productcolorapi = new productcolorapi($connect);
    
    $productcolorapi->trang = isset($_GET['trang']) ? $_GET['trang'] : die();
    $productcolorapi->sp_tungtrang = isset($_GET['sp_tungtrang']) ? $_GET['sp_tungtrang'] : die();
    $productcolorapi->hienthi = isset($_GET['hienthi']) ? $_GET['hienthi'] : die();
    $productcolorapi->search = isset($_GET['search']) ? $_GET['search'] : die();
    $productcolorapi->filtersanpham = isset($_GET['filtersanpham']) ? $_GET['filtersanpham'] : die();

    $readResult = $productcolorapi->readbypage();
    $total = $readResult['total'];
    $read = $readResult['data'];

    $num = count($read);

    if ($num > 0) {
        $productcolorapi_array = [];
        $productcolorapi_array['total'] = $total;
        $productcolorapi_array['data'] = [];

        foreach ($read as $row) {
            extract($row);

            $productcolorapi_item = array(
                'id' => $id,
                'masp' => $masp,
                'tensp' => $tensp,               
                'thoigian' => $thoigian,
                'hienthi' => $hienthi,                               
                'hinhanh' => $hinhanh,   
                'tenmau' => $tenmau,                               
                'tenkichco' => $tenkichco, 
                'soluong' => $soluong,   
                'mausac' => $mausac,        
            );
            array_push($productcolorapi_array['data'], $productcolorapi_item);
        }
        echo json_encode($productcolorapi_array);
    } else {
        // Trường hợp không có dữ liệu
        echo json_encode(['total' => 0, 'data' => []]);
    }

 ?>