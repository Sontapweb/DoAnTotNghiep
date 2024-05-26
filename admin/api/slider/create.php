<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once('../../config/db.php');
include_once('../../model/sliderapi.php');

$db = new db();
$connect = $db->connect();

$sliderapi = new sliderapi($connect);

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
        $unique_image = substr(md5($file_name . time()), 0, 10) . '.' . $file_ext;

        // Đường dẫn của file upload
        $uploaded_image =  __DIR__ . "/../../uploads/" . $unique_image;
        
        // Di chuyển tệp tin vào thư mục uploads
        move_uploaded_file($file_temp, $uploaded_image);

        // Lưu tên tệp vào cơ sở dữ liệu
        $_POST['hinhanh'] = $unique_image;
    }

    // Assign data from POST to the object properties
    $sliderapi->hinhanh = $_POST['hinhanh'];
    $sliderapi->ten = $_POST['ten'];
    $sliderapi->noidung = $_POST['noidung'];
    $sliderapi->xemthem = $_POST['xemthem'];
    $sliderapi->uutien = $_POST['uutien'];
    $sliderapi->status = $_POST['status'];

    if ($sliderapi->create()) {
        echo json_encode(array('message' => 'Tạo thành công'));
    } else {
        echo json_encode(array('message' => 'Tạo không thành công'));
    }
} else {
    // Handle other types of requests or errors
    echo json_encode(array('message' => 'Invalid request method'));
}
?>
