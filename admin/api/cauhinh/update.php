<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once('../../config/db.php');
include_once('../../model/cauhinhapi.php');

$db = new db();
$connect = $db->connect();

$cauhinhapi = new cauhinhapi($connect);

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Kiểm tra xem đã có tệp tin ảnh được tải lên hay chưa
    if (!empty($_FILES['logo']['name'])) {
        $permited = array('jpg', 'jpeg', 'png', 'gif', 'webp');
        $file_name = $_FILES['logo']['name'];
        $file_temp = $_FILES['logo']['tmp_name'];
        
        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));

        $unique_image = substr(md5($file_name . time()), 0, 10) . '.' . $file_ext;

        $uploaded_image =  __DIR__ . "/../../uploads/" . $unique_image;
        
        move_uploaded_file($file_temp, $uploaded_image);

        $_POST['logo'] = $unique_image;
    }

    $cauhinhapi->logo = $_POST['logo'];
    $cauhinhapi->tieude = $_POST['tieude'];
    $cauhinhapi->keywords = $_POST['keywords'];
    $cauhinhapi->mota = $_POST['mota'];
    $cauhinhapi->hotline = $_POST['hotline'];
    $cauhinhapi->email = $_POST['email'];
    $cauhinhapi->zalo = $_POST['zalo'];
    $cauhinhapi->youtube = $_POST['youtube'];
    $cauhinhapi->twitter = $_POST['twitter'];
    $cauhinhapi->google = $_POST['google'];
    $cauhinhapi->instagram = $_POST['instagram'];
    $cauhinhapi->facebook = $_POST['facebook'];
    $cauhinhapi->messenger = $_POST['messenger'];
    $cauhinhapi->googleanalytics = $_POST['googleanalytics'];
    $cauhinhapi->webmastertool = $_POST['webmastertool'];
    $cauhinhapi->id = $_POST['id'];

    if ($cauhinhapi->update()) {
        echo json_encode(array('message' => 'Cập nhật thành công'));
    } else {
        echo json_encode(array('message' => 'Cập nhật không thành công'));
    }
} else {
    echo json_encode(array('message' => 'Invalid request method'));
}
?>
