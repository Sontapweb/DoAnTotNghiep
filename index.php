<?php
	include_once 'classes/blog.php';
                    $blog = new blog();
                    $cauhinh = $blog->show_cauhinh();
                    if($cauhinh){
                        $i = 0;
                        while($result = $cauhinh->fetch_assoc()){

                    
	$title = $result['tieude'];
	$description = $result['mota'];
	$keywords = $result['keywords'];
	$duongdan='';
	$image='admin/uploads/'.$result['logo'];	
}}
	include 'include/header-index.php';

?>
<style type="text/css">
	.xemall{
		font-size: 16px;
		color: black; 
		padding:10px;
	}
	.xemall:hover{
		color: #428bca;
		cursor: pointer;
	}


	.tensanpham:hover a{
		color: #428bca;
	}
	.tieude{

	}
	.thoigian{
		color:#666;
	}
	.mota{

	}
	.xembaiviet{
		text-decoration: none; color: black; border-bottom: 2px solid black;
	}
	@media screen and (max-width: 420px) {
	  	.tieude{
	  		font-size: 14px;
		}
		.thoigian{
			font-size: 11px;
		}
		.mota{
			font-size: 9px;
		}
		.xembaiviet{
			font-size: 9px;
		}
	}
	.tintuc1{
		border: 1px solid #f5f5f5;
	}
	.tintuc1:hover{
		box-shadow: 0px 0px 15px 0px #bdbdbd;
		transition: all 0.3s ease;
	}
</style>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.3.js"></script>
<script type="text/javascript">
	var tcnoibat=1;
	var tcmoinhat=1;
	var tcfree=1;
	$(document).ready(function(){
		$("#xemthem").click(function(){
			tcnoibat = tcnoibat+1;
			$.get("moreproduct.php",{trang:tcnoibat},function(noibat){
				$("#danhsach").append(noibat);
			});
		});
		$("#xemthemmoinhat").click(function(){
			tcmoinhat = tcmoinhat+1;
			$.get("productnew.php",{trangnew:tcmoinhat},function(moinhat){
				$("#danhsachmoinhat").append(moinhat);
			});
		});
	});

</script>
 <div class="container-fluid">
 		<div class="row show-mid">
 			<div class="col-12">

 				<p style="border-bottom: 2px solid #428bca;position: relative; padding-top: 65px;"><span class="daumucsp">CÁC MẪU NỔI BẬT</span></p>
 			</div>
 			<?php
	      		$getproduct_feathered = $product->getproduct_feathered();
	      		if($getproduct_feathered){
	      			$giamgia = 0;
	      			while ($result = $getproduct_feathered->fetch_assoc()) {
	      			
	      		
	      	?>
 			<div class="col-lg-3 show-4-1">
 				<a href="<?php echo $result['url1']?>/<?php echo $result['url']?>-<?php echo $result['mausac']?>-<?php echo $result['kichco']?>" title="<?php echo $result['tensp']  ?>"><img src="admin/uploads/<?php echo $result['hinhanh']?>" alt="<?php echo $result['tensp']  ?>"  width="100%"></a>
 				<p class="text-start text-dark"><a href="<?php echo $result['url1']?>/<?php echo $result['url']?>-<?php echo $result['mausac']?>-<?php echo $result['kichco']?>" class="tensanpham" title="<?php echo $result['tensp']?>"><span><?php echo $result['tensp']  ?></span></a><br>
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
				?>
 		</div>
 		<div class="row show-mid" id="danhsach"></div>
 		<div id="xemthem"><p class="text-center xemall">Xem thêm</p></div>
 		<div class="row show-mid">
 			<div class="col-12">
 				<p style="border-bottom: 2px solid #428bca;position: relative; padding-top: 85px;"><span class="daumucsp">CÁC MẪU MỚI NHẤT</span></p>
 			</div>
 			<?php
	      		$get8product = $product->get8product();
	      		if($get8product){
	      			$giamgia = 0;
	      			while ($result = $get8product->fetch_assoc()) {
	      			
	      			
	      		
	      	?>
 			<div class="col-lg-3 show-4-1">
 				<div class="img-sp">
				 <a href="<?php echo $result['url1']?>/<?php echo $result['url']?>-<?php echo $result['mausac']?>-<?php echo $result['kichco']?>" title="<?php echo $result['tensp']  ?>"><img src="admin/uploads/<?php echo $result['hinhanh']?>" alt="<?php echo $result['tensp']  ?>" width="100%"></a>
				</div>
 				<p class="text-start text-dark"><a href="<?php echo $result['url1']?>/<?php echo $result['url']?>-<?php echo $result['mausac']?>-<?php echo $result['kichco']?>" class="tensanpham" title="<?php echo $result['tensp']?>"><span><?php echo $result['tensp']  ?></span></a><br>
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
				?>
 		</div>
 		<div class="row show-mid" id="danhsachmoinhat"></div>
 		<div id="xemthemmoinhat"><p class="text-center xemall">Xem thêm</p></div>
 		
 		<div class="row tintuc">
 			<div class="col-12">
 				<p style="border-bottom: 2px solid #428bca;position: relative; padding-top: 85px;"><span class="daumucsp" style="font-size:20px;">TIN TỨC</span></p>
 			</div>
 			
 			<?php
	      		$get3blog = $product->get3blog();
	      		if($get3blog){
	      			$giamgia = 0;
	      			while ($result = $get3blog->fetch_assoc()) {
	      			
	      			
	      		
	      	?>
 			<div class="col-lg show-3-1">
 				<div class="tintuc1">
 					<div style="position:relative;">
 					<a href="tin-tuc/<?php echo $result['url']?>" title="<?php echo $result['tieude']?>"><img src="admin/uploads/<?php echo $result['hinhanh']?>" style="border-radius: 5px;" alt="<?php echo $result['tieude']?>" width="100%"></a>
					
 					<p style="position:absolute;left: 5%;background-color: #fff;bottom: 0;padding: 8px 13px;border-radius: 50px;"><span class="thoigian"><?php echo $fm->formatDate($result['thoigian'])?></span></p>
	 				</div>
	 				<div style="padding:0 15px;">
	 					<h3 class="h3-tieude"><p class="h5 text-start text-dark tieude"><?php echo $result['tieude']?></p></h3>
		 				<div class="div-mota">
		 					<span class="mota"><?php echo $fm->textShorten($result['mota']) ?></span>
		 				</div>
		 				<p class="text-end"><a href="tin-tuc/<?php echo $result['url']?>" title="<?php echo $result['tieude']?>" class="xembaiviet">Xem bài viết</a></p>
	 				</div>
 				</div>
 				
 				
 				
 				
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