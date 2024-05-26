<?php 
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/productapi.php');

    $db = new db();
    $connect = $db->connect();

    $productapi = new productapi($connect);
    
    $productapi->trang = isset($_GET['trang']) ? $_GET['trang'] : die();
    $productapi->sp_tungtrang = isset($_GET['sp_tungtrang']) ? $_GET['sp_tungtrang'] : die();
    $productapi->hienthi = isset($_GET['hienthi']) ? $_GET['hienthi'] : die();
    $productapi->search = isset($_GET['search']) ? $_GET['search'] : die();
    $productapi->filterdanhmuc = isset($_GET['filterdanhmuc']) ? $_GET['filterdanhmuc'] : die();
    $productapi->filterthuonghieu = isset($_GET['filterthuonghieu']) ? $_GET['filterthuonghieu'] : die();

    $readResult = $productapi->readbypage();
    $total = $readResult['total'];
    $read = $readResult['data'];

    $num = count($read);

    if ($num > 0) {
        $productapi_array = [];
        $productapi_array['total'] = $total;
        $productapi_array['data'] = [];

        foreach ($read as $row) {
            extract($row);

            $productapi_item = array(
                'id' => $id,
                'masp' => $masp,
                'tensp' => $tensp,                
                'danhmuc' => $danhmuc,
                'thuonghieu' => $thuonghieu,
                'thoigian' => $thoigian,
                'hienthi' => $hienthi,                               
                'hinhanh' => $hinhanh,                
                'tendanhmuc' => $tendanhmuc,
                'tenthuonghieu' => $tenthuonghieu,
            );
            array_push($productapi_array['data'], $productapi_item);
        }
        echo json_encode($productapi_array);
    } else {
        // Trường hợp không có dữ liệu
        echo json_encode(['total' => 0, 'data' => []]);
    }

 ?>