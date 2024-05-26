<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once('../../config/db.php');
include_once('../../model/clubapi.php');

$db = new db();
$connect = $db->connect();

$clubapi = new clubapi($connect);

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

    $clubapi->hinhanh = $_POST['hinhanh'];
    $clubapi->ten = $_POST['ten'];
    $clubapi->mota = $_POST['mota'];
    $clubapi->tomtat = $_POST['tomtat'];
    $clubapi->thoigian = $_POST['thoigian'];
    $clubapi->hienthi = $_POST['hienthi'];
    $clubapi->uutien = $_POST['uutien'];
    $clubapi->title = $_POST['title'];
    $clubapi->description = $_POST['description'];
    $clubapi->url = $_POST['url'];
    $clubapi->keywords = $_POST['keywords'];
    $clubapi->id = $_POST['id'];

    if ($clubapi->update()) {
        echo json_encode(array('message' => 'Cập nhật thành công'));
    } else {
        echo json_encode(array('message' => 'Cập nhật không thành công'));
    }
} else {
    echo json_encode(array('message' => 'Invalid request method'));
}
?>
