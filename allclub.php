<?php
	$title='Hỗ Trợ Sinh Viên';
    $description = 'Tất cả CLB';
    $keywords = 'CLB';
    $duongdan='/danh-muc-club';
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
	if(isset($_GET["iduser"])){
		 
		$login_check = Session::get('customer_login');
		if($login_check==true)    {
			$iduser = $_GET["iduser"];
			$idclub = $_GET["idclub"];
        	$dangkyclb =$cs->insert_club($iduser,$idclub); 
		}  else{
			echo "<script language='javascript'>                                  
                            swal({
                            title: 'Error!',
                            text: 'Bạn phải đăng nhập để đăng ký!',
                            icon: 'error'});                        
                            </script>";
		}
    }
?>
<style type="text/css">
.show-mid .show-3-1 .button a{
  color: #fff;
  font-size: 20px;
  font-weight: 500;
  padding-left: 0px;
  background: #255783;
  border: 1px solid #255783;
  cursor: pointer;
}
 .button a:hover{
  background: #255783;
}
</style>

<div class="link-content" style="box-shadow: 0px 0px 5px 0px #bdbdbd;">
    <div class="container">
    	<div class="row">
    		<div class="col-lg-12 col-links">
    			<a href="/" title="Trang chủ"><i class="bi bi-house-door"></i> Trang chủ</a>    			
    			<span>></span>
    			<span>CLB</span>
    		</div>
    	</div>
    </div>
</div>
 <div class="container-fluid search-container">
 	<?php if(isset($dangkyclb)){
		echo $dangkyclb;
	} ?>
 	<div class="row show-mid">

 			<div class="col-12">

 				<p style="border-bottom: 2px solid #428bca;position: relative; padding-top: 65px;"><span class="tendanhmuc">CLB</span></p>
 			</div>
 			<?php
	      		$getdanhclub = $product->getdanhclub();
	      		if($getdanhclub){
	      			$giamgia = 0;
	      			while ($result = $getdanhclub->fetch_assoc()) {
	      			
	      		
	      	?>
 			<div class="col-lg-4 show-3-1">
 				<div style="position:relative;">
 					<a href="club/<?php echo $result['url']?>" title="<?php echo $result['ten']?>"><img src="admin/uploads/<?php echo $result['hinhanh']?>" style="border-radius: 5px;" alt="<?php echo $result['ten']?>" width="100%"></a>
 					<p style="position:absolute;left: 5%;background-color: #fff;bottom: 0;padding: 8px 13px;border-radius: 50px;"><span class="thoigian"><?php echo $fm->formatDate($result['thoigian'])?></span></p>
 				</div>
 				<h3 class="h3-tieude">
 					<p class="h5 text-start text-dark tieude"><?php echo $result['ten']?></p>
 				</h3>
 				<div class="div-mota">
 					<span class="mota"><?php echo $fm->textShorten($result['tomtat']) ?></span>
 				</div>
				 <div class="text-start button"><a href="danh-muc-club?iduser=<?php echo Session::get('customer_id') ?>&idclub=<?php echo $result['id']?>" title="<?php echo $result['ten']?>" class="xembaiviet">Đăng ký</a></div>
 				<p class="text-end"><a href="club/<?php echo $result['url']?>" title="<?php echo $result['ten']?>" class="xembaiviet">Xem chi tiết</a></p>
 				
 				
 				
 			</div>
 			<?php
					}
				}
				?>
 		</div>
 </div>

 <?php
	include 'include/footer.php';
	
?>