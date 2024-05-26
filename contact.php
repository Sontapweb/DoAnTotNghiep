
<?php
    $title='Hỗ Trợ Sinh Viên';
    $description = 'Liên hệ với chúng tôi';
    $keywords = 'Liên hệ';
    $duongdan='/lien-he';
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
	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['lienhereal'])){
        $status = 0;
        $ten    = $_POST['ten'];
        $email  = $_POST['email'];
        $sdt    = $_POST['sdt'];
        $chude  = $_POST['chude'];
        
        if($ten=="" || $sdt=="" || $chude=="" ) {
            echo "<script language='javascript'>                                  
                            swal({
                            title: 'Error!',
                            text: 'Hãy nhập đủ thông tin!',
                            icon: 'error'});                        
                            </script>";
        }else{
            
                if(preg_match('/^[0-9]{10}+$/', $sdt)){
                    $query ="insert into lienhe(ten,email,sdt,chude,status) values('$ten','$email','$sdt','$chude','$status')";
                $result =$db->insert($query);
                if($result){
                    $ten    = '';
                    $email  = '';
                    $sdt    = '';
                    $chude  = '';
                    echo "<script language='javascript'>                                  
                            swal({
                            title: 'Success!',
                            text: 'Gửi thành công! Chúng tôi sẽ liên hệ lại sau.',
                            icon: 'success'});                      
                            </script>";
                }else{
                    echo "<script language='javascript'>                                  
                            swal({
                            title: 'Error!',
                            text: 'Không thể gửi! Bạn hãy thử lại sau.',
                            icon: 'error'});                        
                            </script>";
                
                }
            }else{
                echo "<script language='javascript'>                                  
                            swal({
                            title: 'Error!',
                            text: 'Số điện thoại không hợp lệ!',
                            icon: 'error'});                        
                            </script>";
                
            }
        }
    }
?>
<style type="text/css">
    .btn.btn-secondary{
        color:white; background:#e20c26; border: none;  
        margin-top: 30px;
    }
    .btn.btn-secondary:hover{
        color: #e20c26;
        background: white;
        border: 1px solid #e20c26;
    }
</style>
<div class="link-content" style="box-shadow: 0px 0px 5px 0px #bdbdbd;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-links">
                <a href="/" title="Trang chủ"><i class="bi bi-house-door"></i> Trang chủ</a>                
                <span>></span>
                <span>Liên hệ</span>
            </div>
        </div>
    </div>
</div>
 <div class="container">
 	<div class="row">
 		<div class="col-lg-6">
 			<section class="mb-4">

    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-4">Liên hệ cho chúng tôi.</h2>
    <!--Section description-->
    <p class="text-center w-responsive mx-auto mb-5" style="color:red;">Nếu bạn có bất kỳ câu hỏi này. Đừng ngần ngại, hãy gửi cho chúng tôi trực tuyến ngay bên dưới đây. Hoặc đến địa chỉ của chúng tôi</p>
    <p class="text-center w-responsive mx-auto mb-5" style="color:#428bca;"> Hãy gửi yêu cầu cho chúng tôi ngay dưới đây.</p>

    <form action="" method="post">
        <div class="row input-container">
            <div class="col-xs-12">
                <div class="styled-input wide">
                    <input type="text" name="ten" id="ten" value="<?php if(isset($ten)){
                                echo $ten;
                            } ?>" required />
                    <label for="ten">Họ và tên</label> 
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="styled-input">
                    <input type="text" name="email" id="email" value="<?php if(isset($email)){
                                echo $email;
                            } ?>" required />
                    <label for="email">Email</label> 
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="styled-input" style="float:right;">
                    <input type="text" name="sdt" id="sdt" value="<?php if(isset($sdt)){
                                echo $sdt;
                            } ?>" required />
                    <label for="sdt">Số điện thoại</label> 
                </div>
            </div>
            <div class="col-xs-12">
                <div class="styled-input wide">
                    <textarea name="chude" id="chude" required><?php if(isset($chude)){
                                echo $chude;
                            } ?></textarea>
                    <label for="chude">Nội dung yêu cầu</label>
                </div>
            </div>
            <div class="col-xs-12">
                <button class="glow-on-hover" name="lienhereal" type="submit">Gửi ngay <i class="bi bi-send"></i></button>
            </div>
    </div>
    </form>

</section>
 		</div>
 		<div class="col-lg-6" style="padding-top:80px">
             <iframe src="https://www.google.com/maps/place/Tr%C6%B0%E1%BB%9Dng+%C4%90%E1%BA%A1i+h%E1%BB%8Dc+C%C3%B4ng+nghi%E1%BB%87p+H%C3%A0+N%E1%BB%99i/@21.053731,105.7325319,17z/data=!3m1!4b1!4m6!3m5!1s0x31345457e292d5bf:0x20ac91c94d74439a!8m2!3d21.053731!4d105.7351068!16s%2Fm%2F0vb3l31?entry=ttu" width="100%" height="90%" title="Địa chỉ trên google map" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
 	</div>
 </div>

 <?php
	include 'include/footer.php';
	
?>