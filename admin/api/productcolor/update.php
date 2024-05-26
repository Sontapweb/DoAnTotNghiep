<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once('../../config/db.php');
include_once('../../model/productcolorapi.php');

$db = new db();
$connect = $db->connect();

$productcolorapi = new productcolorapi($connect);

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Kiểm tra xem đã có tệp tin ảnh được tải lên hay chưa
    if (!empty($_FILES['hinhanh']['name'])) {
        $permited = array('jpg', 'jpeg', 'png', 'gif', 'webp');
        $file_name = $_FILES['hinhanh']['name'];
        $file_temp = $_FILES['hinhanh']['tmp_name'];
        
        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));

        $unique_image = substr(md5($file_name . time()), 0, 10) . '_' . $_POST['url']. '.' . $file_ext;

        $uploaded_image =  __DIR__ . "/../../uploads/" . $unique_image;
        
        move_uploaded_file($file_temp, $uploaded_image);

        $_POST['hinhanh'] = $unique_image;
    }

    $productcolorapi->hinhanh = $_POST['hinhanh'];
    $productcolorapi->gia = $_POST['gia'];
    $productcolorapi->giakm = $_POST['giakm'];
    $productcolorapi->mausac = $_POST['mausac'];
    $productcolorapi->kichco = $_POST['kichco'];
    $productcolorapi->soluong = $_POST['soluong'];
    $productcolorapi->uutien = $_POST['uutien'];    
    $productcolorapi->thoigian = $_POST['thoigian'];
    $productcolorapi->hienthi = $_POST['hienthi'];
    $productcolorapi->id = $_POST['id'];

    if ($productcolorapi->update()) {
        echo json_encode(array('message' => 'Cập nhật thành công'));
    } else {
        echo json_encode(array('message' => 'Cập nhật không thành công'));
    }
} else {
    echo json_encode(array('message' => 'Invalid request method'));
}
?>
