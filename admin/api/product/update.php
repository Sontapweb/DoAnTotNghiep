<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once('../../config/db.php');
include_once('../../model/productapi.php');

$db = new db();
$connect = $db->connect();

$productapi = new productapi($connect);

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

    $productapi->hinhanh = $_POST['hinhanh'];
    $productapi->masp = $_POST['masp'];
    $productapi->tensp = $_POST['tensp'];
    $productapi->danhmuc = $_POST['danhmuc'];
    $productapi->thuonghieu = $_POST['thuonghieu'];
    $productapi->gia = $_POST['gia'];
    $productapi->giakm = $_POST['giakm'];
    $productapi->mausac = $_POST['mausac'];
    $productapi->kichco = $_POST['kichco'];
    $productapi->loai = $_POST['loai'];
    $productapi->uutien = $_POST['uutien'];    
    $productapi->thoigian = $_POST['thoigian'];
    $productapi->thongtin = $_POST['thongtin'];
    $productapi->hienthi = $_POST['hienthi'];
    $productapi->title = $_POST['title'];
    $productapi->description = $_POST['description'];
    $productapi->url = $_POST['url'];
    $productapi->keywords = $_POST['keywords'];
    $productapi->id = $_POST['id'];

    if ($productapi->update()) {
        echo json_encode(array('message' => 'Cập nhật thành công'));
    } else {
        echo json_encode(array('message' => 'Cập nhật không thành công'));
    }   
} else {
    echo json_encode(array('message' => 'Invalid request method'));
}
?>
