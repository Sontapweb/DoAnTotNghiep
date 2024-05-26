<?php
    $title='Hỗ Trợ Sinh Viên - Đăng ký';
    $description = 'Đăng ký tài khoản tại đây';
    $keywords = 'Đăng ký';
    $duongdan='/dang-ky';
    include_once 'classes/blog.php';
                    $blog = new blog();
                    $cauhinh = $blog->show_cauhinh();
                    if($cauhinh){
                        $i = 0;
                        while($result = $cauhinh->fetch_assoc()){                   
    $image='admin/uploads/'.$result['logo'];
}} 
	include 'include/header.php';
	
?>

<?php
    
    if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['dangkytaikhoan'])){

        $insertcustomer=$cs->insert_customer($_POST);
    }
?>

<style type="text/css">
	.container-tk{
  max-width: 700px;
  width: 100%;
  background-color: #fff;
  padding: 25px 30px;
  border-radius: 5px;
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 100%;
}
.container-tk .title{
  font-size: 25px;
  font-weight: 500;
  position: relative;
}
.container-tk .title::before{
  content: "";
  position: absolute;
  left: 0;
  bottom: 0;
  height: 3px;
  width: 30px;  
  border-radius: 5px;
  background: #255783;
}
.content form .user-details{
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin: 20px 0 12px 0;
}
form .user-details .input-box{
  margin-bottom: 15px;
  width: calc(100% / 2 - 20px);
}
form .input-box span.details{
  display: block;
  font-weight: 500;
  margin-bottom: 5px;
}
.user-details .input-box input{
  height: 45px;
  width: 100%;
  outline: none;
  font-size: 16px;
  border-radius: 5px;
  padding-left: 15px;
  border: 1px solid #ccc;
  border-bottom-width: 2px;
  transition: all 0.3s ease;
}
.user-details .input-box input:focus,
.user-details .input-box input:valid{
  border-color: #255783;
}
 form .gender-details .gender-title{
  font-size: 20px;
  font-weight: 500;
 }
 form .category{
   display: flex;
   width: 80%;
   margin: 14px 0 ;
   justify-content: space-between;
 }
 form .category label{
   display: flex;
   align-items: center;
   cursor: pointer;
 }
 form .category label .dot{
  height: 18px;
  width: 18px;
  border-radius: 50%;
  margin-right: 10px;
  background: #d9d9d9;
  border: 5px solid transparent;
  transition: all 0.3s ease;
}
 #dot-1:checked ~ .category label .one,
 #dot-2:checked ~ .category label .two,
 #dot-3:checked ~ .category label .three{
   background: #9b59b6;
   border-color: #d9d9d9;
 }
 form input[type="radio"]{
   display: none;
 }
 form .button{
   height: 45px;
   margin: 35px 0
 }
 form .button input{
   height: 100%;
   width: 100%;
   border-radius: 5px;
   border: none;
   color: #fff;
   font-size: 18px;
   font-weight: 500;
   letter-spacing: 1px;
   cursor: pointer;
   transition: all 0.3s ease;
   background: #255783;
 }
 form .button input:hover{
  /* transform: scale(0.99); */
  background: #255783;
  }
 @media(max-width: 584px){
 .container-tk{
  max-width: 100%;
}
form .user-details .input-box{
    margin-bottom: 15px;
    width: 100%;
  }
  form .category{
    width: 100%;
  }
  .content form .user-details{
    max-height: 300px;
    overflow-y: scroll;
  }
  .user-details::-webkit-scrollbar{
    width: 5px;
  }
  }
  @media(max-width: 459px){
  .container-tk .content .category{
    flex-direction: column;
  }
}
</style>


 <div class="container-tk">
    <div class="title">Đăng ký</div>
    <div class="content">
      <form action="" method="POST">
         <?php 
                      if(isset($insertcustomer)){
                        echo $insertcustomer;

                      }
                    ?>
        <div class="user-details">
          <div class="input-box">
            <span class="details">Họ tên</span>
            <input type="text" name="ten" placeholder="Nhập tên của bạn" value="<?php if(isset($_POST['ten'])){
                        echo $_POST['ten'];
                      } ?>" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" name="email" placeholder="Nhập email của bạn" value="<?php if(isset($_POST['email'])){
                        echo $_POST['email'];
                      } ?>" required>
          </div>
          <div class="input-box">
            <span class="details">Địa chỉ</span>
            <input type="text" name="diachi" placeholder="Nhập địa chỉ của bạn" value="<?php if(isset($_POST['diachi'])){
                        echo $_POST['diachi'];
                      } ?>" required>
          </div>
          <div class="input-box">
            <span class="details">SĐT</span>
            <input type="text" name="sdt" placeholder="Nhập số điện thoại của bạn" value="<?php if(isset($_POST['sdt'])){
                        echo $_POST['sdt'];
                      } ?>" required>
          </div>
          <div class="input-box">
            <span class="details">Mật khẩu</span>
            <input type="text" name="pass" placeholder="Nhập mật khẩu" required>
          </div>
          <div class="input-box">
            <span class="details">Nhập lại mật khẩu</span>
            <input type="text" name="pass1" placeholder="Nhập lại mật khẩu" required>
          </div>
        </div>

        <div class="button">
          <input type="submit" name="dangkytaikhoan" value="Đăng ký">
        </div>
      </form>
    </div>
  </div>


 <?php
 	//alert('Tài khoản không tồn tại');
 	//window.open('index.php','_self', 1);
	include 'include/footer.php';
	
?>