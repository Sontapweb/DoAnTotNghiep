<?php
    $title='Thông tin tài khoản';
    $description = 'Thông tin tài khoản của bạn';
    $keywords = 'Thông tin tài khoản';
    $duongdan='/thong-tin';
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
	  	$login_check = Session::get('customer_login');
	  	if($login_check==false){
		   			if(!headers_sent()){
            header("Location:dang-nhap");
          }else{
            echo '<script type="text/javascript">window.location.href="dang-nhap";</script>';
          } 
		   }			
	  ?>
<?php
	$id = Session::get('customer_id');
  	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
       
        $updatecustomer =$cs->update_customer($_POST,$id);
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




<div class="link-content" style="box-shadow: 0px 0px 5px 0px #bdbdbd;">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-links">
          <a href="/" title="Trang chủ"><i class="bi bi-house-door"></i> Trang chủ</a>          
          <span>></span>
          <span>Thông tin</span>
        </div>
      </div>
    </div>
</div>

<div class="container-tk">
    <div class="title">Thông tin tài khoản</div>

<?php
                            if(isset($updatecustomer)){
                                echo $updatecustomer;
                            }
                        ?>
    <div class="content">
       <?php
          $id = Session::get('customer_id');
            $get_customer = $cs->show_customer($id);
            if($get_customer){
              while($result = $get_customer->fetch_assoc()){

            
            
          ?>
      <form action="" method="POST">
         
        <div class="user-details">
          <div class="input-box">
            <span class="details">Họ tên</span>
            <input type="text" name="ten" placeholder="Nhập tên của bạn" value="<?php echo $result[('ten')] ?>" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" name="email" placeholder="Nhập email của bạn" value="<?php echo $result[('email')] ?>" required>
          </div>
          <div class="input-box">
            <span class="details">Địa chỉ</span>
            <input type="text" name="diachi" placeholder="Nhập địa chỉ của bạn" value="<?php echo $result[('diachi')] ?>" required>
          </div>
          <div class="input-box">
            <span class="details">SĐT</span>
            <input type="text" name="sdt" placeholder="Nhập số điện thoại của bạn" value="<?php echo $result[('sdt')] ?>" required>
          </div>

        </div>

        <div class="button">
          <input type="submit" name="submit" value="Cập nhật thông tin">
        </div>
      </form>
    <?php }} ?>
    </div>
  </div>
	
 <?php
	include 'include/footer.php';
	
?>