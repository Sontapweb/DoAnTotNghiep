<?php
	$title='Hỗ Trợ Sinh Viên';
    $description = 'Tất cả danh mục tin tức bạn tìm';
    $keywords = 'Danh mục tin tức';
    $duongdan='/danh-muc-tin-tuc';
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
<div class="link-content" style="box-shadow: 0px 0px 5px 0px #bdbdbd;">
    <div class="container">
    	<div class="row">
    		<div class="col-lg-12 col-links">
    			<a href="/" title="Trang chủ"><i class="bi bi-house-door"></i> Trang chủ</a>    			
    			<span>></span>
    			<span>Tin tức</span>
    		</div>
    	</div>
    </div>
</div>
 <div class="container-fluid search-container">
 	
 	<div class="row show-mid">
 		<?php 
	      		$getdanhmuctin = $product->getdanhmuctin();
	      		if($getdanhmuctin){
	      			while ($result_dmxe = $getdanhmuctin->fetch_assoc()) {	      			
	      		
	      	?>
 			<div class="col-12">

 				<p style="border-bottom: 2px solid #428bca;position: relative; padding-top: 65px;"><span class="tendanhmuc"><?php echo $result_dmxe['tendm']?></span></p>
 			</div>
 			<?php
	      		$gettin_bydmtin = $product->gettin_bydmtin($result_dmxe['madm']);
	      		if($gettin_bydmtin){
	      			$giamgia = 0;
	      			while ($result = $gettin_bydmtin->fetch_assoc()) {
	      			
	      		
	      	?>
 			<div class="col-lg-4 show-3-1">
 				<div style="position:relative;">
 					<a href="tin-tuc/<?php echo $result['url']?>" title="<?php echo $result['tieude']?>"><img src="admin/uploads/<?php echo $result['hinhanh']?>" style="border-radius: 5px;" alt="<?php echo $result['tieude']?>" width="100%"></a>
 					<p style="position:absolute;left: 5%;background-color: #fff;bottom: 0;padding: 8px 13px;border-radius: 50px;"><span class="thoigian"><?php echo $fm->formatDate($result['thoigian'])?></span></p>
 				</div>
 				<h3 class="h3-tieude">
 					<p class="h5 text-start text-dark tieude"><?php echo $result['tieude']?></p>
 				</h3>
 				<div class="div-mota">
 					<span class="mota"><?php echo $fm->textShorten($result['mota']) ?></span>
 				</div>
 				<p class="text-end"><a href="tin-tuc/<?php echo $result['url']?>" title="<?php echo $result['tieude']?>" class="xembaiviet">Xem bài viết</a></p>
 				
 				
 				
 				
 			</div>
 			<?php
					}
				}
			}
		}
				?>
 		</div>
 </div>

 <?php
	include 'include/footer.php';
	
?>