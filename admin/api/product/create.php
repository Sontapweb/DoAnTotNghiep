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
        
        // Lấy phần mở rộng của file
        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));

        // Tạo tên file mới dựa trên nội dung của ảnh và thời gian
        $unique_image = substr(md5($file_name . time()), 0, 10) . '_' . $_POST['url']. '.' . $file_ext;

        // Đường dẫn của file upload
        $uploaded_image =  __DIR__ . "/../../uploads/" . $unique_image;
        
        // Di chuyển tệp tin vào thư mục uploads
        move_uploaded_file($file_temp, $uploaded_image);

        // Lưu tên tệp vào cơ sở dữ liệu
        $_POST['hinhanh'] = $unique_image;
    }
    
    $productapi->hinhanh = $_POST['hinhanh'];
    $productapi->id = $_POST['id'];
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
    $productapi->title = $_POST['title'];
    $productapi->description = $_POST['description'];
    $productapi->url = $_POST['url'];
    $productapi->keywords = $_POST['keywords'];

    if ($productapi->create()) {
        echo json_encode(array('message' => 'Tạo thành công'));
    } else {
        echo json_encode(array('message' => 'Tạo không thành công'));
    }
} else {
    // Handle other types of requests or errors
    echo json_encode(array('message' => 'Invalid request method'));
}
?>
