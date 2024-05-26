<?php 
    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json');

    include_once('../../config/db.php');
    include_once('../../model/muclucapi.php');

    $db = new db();
    $connect = $db->connect();

    $muclucapi = new muclucapi($connect);
    
    $muclucapi->trang = isset($_GET['trang']) ? $_GET['trang'] : die();
    $muclucapi->sp_tungtrang = isset($_GET['sp_tungtrang']) ? $_GET['sp_tungtrang'] : die();
    $muclucapi->search = isset($_GET['search']) ? $_GET['search'] : die();
    $muclucapi->dmfilter = isset($_GET['dmfilter']) ? $_GET['dmfilter'] : die();
    $muclucapi->spfilter = isset($_GET['spfilter']) ? $_GET['spfilter'] : die();

    $readResult = $muclucapi->readbypage();
    $thuoctieude = $readResult['thuoctieude'];
    $total = $readResult['total'];
    $read = $readResult['data'];

    $num = count($read);

    if ($num > 0) {
        $muclucapi_array = [];
        $muclucapi_array['thuoctieude'] = $thuoctieude;
        $muclucapi_array['total'] = $total;
        $muclucapi_array['data'] = [];

        foreach ($read as $row) {
            extract($row);

            $muclucapi_item = array(
                'id' => $id,
                'tieude' => $tieude,
                'thutu' => $thutu,
                'spid' => $spid,
                'dmid' => $dmid,
                'url' => $url,
            );
            array_push($muclucapi_array['data'], $muclucapi_item);
        }
        echo json_encode($muclucapi_array);
    } else {
        // Trường hợp không có dữ liệu
        echo json_encode(['total' => 0, 'data' => []]);
    }
?>