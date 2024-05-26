<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once('../../config/db.php');
include_once('../../model/productsizeapi.php');

$db = new db();
$connect = $db->connect();

$productsizeapi = new productsizeapi($connect);

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
    $productsizeapi->hinhanh = $_POST['hinhanh'];
    $productsizeapi->gia = $_POST['gia'];
    $productsizeapi->giakm = $_POST['giakm'];
    $productsizeapi->mausac = $_POST['mausac'];
    $productsizeapi->kichco = $_POST['kichco'];
    $productsizeapi->uutien = $_POST['uutien'];    
    $productsizeapi->thoigian = $_POST['thoigian'];
    $productsizeapi->soluong = $_POST['soluong'];
    $productsizeapi->masp = $_POST['masp'];
    $productsizeapi->tensp = $_POST['tensp'];    
    $productsizeapi->url = $_POST['url'];

    if ($productsizeapi->create()) {
        echo json_encode(array('message' => 'Tạo thành công'));
    } else {
        echo json_encode(array('message' => 'Tạo không thành công'));
    }
} else {
    // Handle other types of requests or errors
    echo json_encode(array('message' => 'Invalid request method'));
}
?>
