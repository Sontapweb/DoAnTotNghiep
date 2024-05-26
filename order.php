<?php
	$title='Hỗ Trợ Sinh Viên - Xin chào';
	$description = 'Xin chào quý khách';
	$keywords = 'Chào mừng';
	$duongdan='/xin-chao';
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


<style>
	.not_found{
		font-size: 30px;
		font-weight: bold;
		color: red;
	}
</style>
<?php
    if(isset($_SESSION['access_token']) && isset($_SESSION['userData']['id'])){
        
        $login_facebook=$cs->login_facebook($_SESSION['userData']['id'],$_SESSION['userData']['name'],$_SESSION['userData']['email']);
    }
?>
<div class="container">
	<div class="row">
		<div class="text-center col-12">Chào Mứng Bạn Đến Với Ứng Dụng<img src=""></div>
	</div>
</div>

 <?php
	include 'include/footer.php';
	
?>
