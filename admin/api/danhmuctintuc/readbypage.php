<?php 
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/danhmuctintuc.php');

    $db = new db();
    $connect = $db->connect();

    $danhmuctintuc = new Danhmuctintuc($connect);
    
    $danhmuctintuc->trang = isset($_GET['trang']) ? $_GET['trang'] : die();
    $danhmuctintuc->sp_tungtrang = isset($_GET['sp_tungtrang']) ? $_GET['sp_tungtrang'] : die();
    $danhmuctintuc->hienthi = isset($_GET['hienthi']) ? $_GET['hienthi'] : die();
    $danhmuctintuc->search = isset($_GET['search']) ? $_GET['search'] : die();

    $readResult = $danhmuctintuc->readbypage();
    $total = $readResult['total'];
    $read = $readResult['data'];

    $num = count($read);

    if ($num > 0) {
        $danhmuctintuc_array = [];
        $danhmuctintuc_array['total'] = $total;
        $danhmuctintuc_array['data'] = [];

        foreach ($read as $row) {
            extract($row);

            $danhmuctintuc_item = array(
                'madm' => $madm,
                'tendm' => $tendm,
                'hienthi' => $hienthi,
                'url' => $url,
            );
            array_push($danhmuctintuc_array['data'], $danhmuctintuc_item);
        }
        echo json_encode($danhmuctintuc_array);
    } else {
        // Trường hợp không có dữ liệu
        echo json_encode(['total' => 0, 'data' => []]);
    }

 ?>