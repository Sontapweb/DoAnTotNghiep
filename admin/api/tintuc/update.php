<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once('../../config/db.php');
include_once('../../model/tintucapi.php');

$db = new db();
$connect = $db->connect();

$tintucapi = new tintucapi($connect);

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

    $tintucapi->hinhanh = $_POST['hinhanh'];
    $tintucapi->tieude = $_POST['tieude'];
    $tintucapi->mota = $_POST['mota'];
    $tintucapi->noidung = $_POST['noidung'];
    $tintucapi->danhmuc = $_POST['danhmuc'];
    $tintucapi->thoigian = $_POST['thoigian'];
    $tintucapi->luotxem = $_POST['luotxem'];
    $tintucapi->hienthi = $_POST['hienthi'];
    $tintucapi->uutien = $_POST['uutien'];
    $tintucapi->title = $_POST['title'];
    $tintucapi->description = $_POST['description'];
    $tintucapi->url = $_POST['url'];
    $tintucapi->keywords = $_POST['keywords'];
    $tintucapi->id = $_POST['id'];

    if ($tintucapi->update()) {
        echo json_encode(array('message' => 'Cập nhật thành công'));
    } else {
        echo json_encode(array('message' => 'Cập nhật không thành công'));
    }
} else {
    echo json_encode(array('message' => 'Invalid request method'));
}
?>
