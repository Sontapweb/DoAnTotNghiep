<?php 
require_once('configfb.php');

$redirectURL = "http://localhost/hotrosv/callbackfb.php"; // Thay đổi tên file thành callbackfb.php
$permissions = ['email']; // Các quyền mà ứng dụng yêu cầu để sử dụng từ tài khoản Facebook của người dùng
$loginURL = $handler->getLoginUrl($redirectURL, $permissions); // Sử dụng phương thức getLoginUrl để lấy URL đăng nhập
 ?>


<?php
  
  $title='Đăng nhập';
  $description = 'Đăng nhập - Hỗ Trợ Sinh Viên';
  $keywords = 'Đăng nhập';
  $duongdan='/dang-nhap';
  include_once 'classes/blog.php';
                    $blog = new blog();
                    $cauhinh = $blog->show_cauhinh();
                    if($cauhinh){
                        $i = 0;
                        while($result = $cauhinh->fetch_assoc()){                   
        $image='admin/uploads/'.$result['logo'];
}}
  include 'include/header.php';
  // include 'include/slider.php';
  
?>
<?php
require_once('configgg.php');

require 'google-api/vendor/autoload.php';


if(isset($_SESSION['login_id'])){
    header('Location: xin-chao');
    exit;
}


// Creating new google client instance
$client = new Google_Client();

// Enter your Client ID
$client->setClientId('1009804692638-6bqnbr1lntegu7i93106og7225br9kd4.apps.googleusercontent.com');
// Enter your Client Secrect
$client->setClientSecret('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');
// Enter the Redirect URL
$client->setRedirectUri('http://localhost/hotrosv/dang-nhap');

// Adding those scopes which we want to get (email & profile Information)
$client->addScope("email");
$client->addScope("profile");


if(isset($_GET['code'])){

    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if(!isset($token["error"])){

        $client->setAccessToken($token['access_token']);

        // getting profile information
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
    
        // Storing data into database
        $id = mysqli_real_escape_string($db_connection, $google_account_info->id);
        $full_name = mysqli_real_escape_string($db_connection, trim($google_account_info->name));
        $email = mysqli_real_escape_string($db_connection, $google_account_info->email);
        $profile_pic = mysqli_real_escape_string($db_connection, $google_account_info->picture);
        $_SESSION['google_image']=$profile_pic;
        // checking user already exists or not
        $login_google = $cs->login_google($id,$full_name,$email);

    }
    else{
        if(!headers_sent()){
                        header("Location:dang-nhap");
                    }else{
                        echo '<script type="text/javascript">window.location.href="dang-nhap";</script>';
                    }
        exit;
    }
    
}
?>


<?php 
$login_check = Session::get('customer_login');
if($login_check==true){
    if(!headers_sent()){
                        header("Location:xin-chao");
                    }else{
                        echo '<script type="text/javascript">window.location.href="xin-chao";</script>';
                    }
} ?>
<?php
    if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['submit'])){
        
        $login_customer=$cs->login_customer($_POST);
    }
?>

<style type="text/css">
    .container-tk{
  max-width: 440px;
  padding: 0 20px;
  margin: 60px auto;
  border-bottom: 1px solid rgba(51,51,51,0.2);
}
.wrapper-tk{
  width: 100%;
  background: #fff;
  border-radius: 5px;
  box-shadow: 0px 4px 10px 1px rgba(0,0,0,0.1);
}
.wrapper-tk .title{
  height: 90px;
  background: #255783;
  border-radius: 5px 5px 0 0;
  color: #fff;
  font-size: 30px;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
}
.wrapper-tk form{
  padding: 30px 25px 25px 25px;
}
.wrapper-tk form .row{
  height: 45px;
  margin-bottom: 15px;
  position: relative;
}
.wrapper-tk form .row input{
  height: 100%;
  width: 100%;
  outline: none;
  padding-left: 60px;
  border-radius: 5px;
  border: 1px solid lightgrey;
  font-size: 16px;
  transition: all 0.3s ease;
}
form .row input:focus{
  border-color: #255783;
  box-shadow: inset 0px 0px 2px 2px rgba(26,188,156,0.25);
}
form .row input::placeholder{
  color: #999;
}
.wrapper-tk form .row .fa-user,.fa-lock{
  position: absolute;
  width: 47px;
  height: 100%;
  color: #fff;
  font-size: 18px;
  background: #255783;
  border: 1px solid #255783;
  border-radius: 5px 0 0 5px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.wrapper-tk form .pass{
  margin: -8px 0 20px 0;
}
.wrapper-tk form .pass a{
  color: #255783;
  font-size: 17px;
  text-decoration: none;
}
.wrapper-tk form .pass a:hover{
  text-decoration: underline;
}
.wrapper-tk form .button input{
  color: #fff;
  font-size: 20px;
  font-weight: 500;
  padding-left: 0px;
  background: #255783;
  border: 1px solid #255783;
  cursor: pointer;
}
.dangnhaprieng{
  color: #000;
  font-size: 17px;
  font-weight: 500;
  padding: 10px 0;
  background: #fff;
  border: 1px solid rgba(51,51,51,0.2);
  border-radius: 5px;
  cursor: pointer;  
  text-align: center;
}
form .button input:hover{
  background: #255783;
}
.wrapper-tk form .signup-link{
  text-align: center;
  margin-top: 20px;
  font-size: 17px;
}
.wrapper-tk form .signup-link a{
  color: #255783;
  text-decoration: none;
}
form .signup-link a:hover{
  text-decoration: underline;
}
</style>


 <div class="container-tk">
      <div class="wrapper-tk">
        <div class="title"><span>Đăng nhập</span></div>
        <form action="" method="POST">
          <?php 
                        if(isset($login_customer)){
                            echo $login_customer;
                        }
                    ?>
          <div class="row">
            <i class="fas fa-user"></i>
            <input type="text" name="email" placeholder="Email hoặc số điện thoại" required>
          </div>
          <div class="row">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Mật khẩu" required>
          </div>
          
          <div class="row button">
            <input type="submit" name="submit" value="Đăng nhập">
          </div>
          <div class="signup-link">Chưa trở thành thành viên? <a href="dang-ky-thanh-vien">Đăng ký ngay</a></div>
          <div class="row">
            <p style="margin: 0;text-align: center; padding-top: 15px;"><span>Hoặc</span></p>
          </div>
          <div class="row">
            <button type="button" onclick="window.location='<?php echo $loginURL; ?>'" class="dangnhaprieng"><i class="bi bi-facebook" style="color:#4267b2;"></i> Đăng nhập với Facebook</button>         
          </div>
          <div class="row">
            <a href="<?php echo $client->createAuthUrl(); ?>" name="dangnhapgg" class="dangnhaprieng"><img src="images/googleicon.webp" width="17px" height="17px"> Đăng nhập với Google</a>           
          </div>
        </form>
      </div>
    </div>


 <?php
  //alert('Tài khoản không tồn tại');
  //window.open('index.php','_self', 1);
  include 'include/footer.php';
  
?>