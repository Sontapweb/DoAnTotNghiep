<?php
	$title='Hỗ Trợ Sinh Viên';
    $description = 'Tất cả thương hiệu sản phẩm bạn tìm';
    $keywords = 'Thương hiệu sản phẩm';
    $duongdan='/cac-thuong-hieu';
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
    			<span>Thương hiệu</span>
    		</div>
    	</div>
    </div>
</div>

 <div class="container-fluid search-container">
 	
 	<div class="row show-mid">
 		<?php 
	      		$getthuonghieuxe = $product->getthuonghieuxe();
	      		if($getthuonghieuxe){
	      			while ($result_dmxe = $getthuonghieuxe->fetch_assoc()) {
	      			
	      		
	      	?>
 			<div class="col-12">

 				<p style="border-bottom: 2px solid #428bca;position: relative; padding-top: 65px;"><span class="tendanhmuc">Thương hiệu <?php echo $result_dmxe['tenth']?></span></p>
 			</div>
 			<?php
	      		$getproduct_bythxe = $product->getproduct_bythxe($result_dmxe['math']);
	      		if($getproduct_bythxe){
	      			$giamgia = 0;
	      			while ($result = $getproduct_bythxe->fetch_assoc()) {
	      			
	      		
	      	?>
 			<div class="col-lg-3 show-4-1">
 				<a href="<?php echo $result['url1']?>/<?php echo $result['url']?>-<?php echo $result['mausac']?>-<?php echo $result['kichco']?>" title="<?php echo $result['tensp']  ?>"><img src="admin/uploads/<?php echo $result['hinhanh']?>" alt="<?php echo $result['tensp']  ?>"  width="100%"></a>
 				<p class="text-start text-dark p-tensp"><a href="<?php echo $result['url1']?>/<?php echo $result['url']?>-<?php echo $result['mausac']?>-<?php echo $result['kichco']?>" class="tensanpham" title="<?php echo $result['tensp']?>"><span><?php echo $result['tensp']  ?></span></a><br>
 				<span style="font-size:14px;"><?php echo $result['id']  ?></span></p>
 				<?php 
 				
 				if($result['giakm']!="0"){
 					?> 					
 					<span style="color: #f94c43;font-weight: 600;font-size: 19px;">
    				<?php echo $fm->format_currency($result['giakm'])."đ"?></span>
 					<span style="font-weight: 600;font-size: 16px;color: #939393;"><del><?php echo $fm->format_currency($result['gia'])."đ"?></del></span>
 					<span class="giamgia"><i class="bi bi-lightning-fill"></i> Giảm <?php $giamgia=(($result['gia']-$result['giakm'])/$result['gia'])*100; echo round($giamgia)."%"; ?></span>
 					<?php
 				}
 				else{
 					?>
 					<span style="font-weight: 600;font-size: 19px;color: #428bca;"><?php echo $fm->format_currency($result['gia'])."đ"?></span>
 					<?php  
 				}
 				 ?>
 				
 				
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