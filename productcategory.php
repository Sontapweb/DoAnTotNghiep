<?php
	if(!isset($_GET['url']) || $_GET['url']==NULL){
    echo "<script>window.location ='404.php'</script>";
   
}else{
    $url=$_GET['url'];
    
}    
     
?>
<?php 
if(isset($_GET['dieukien'])&&$_GET['dieukien']==1){
    $sanpham = 'order by sanpham.gia asc';
    $tenfilter = ' - Giá tăng dần';
    $tintuc = '';
    }
    else if(isset($_GET['dieukien'])&&$_GET['dieukien']==2){
    	$sanpham = 'order by sanpham.gia desc';
    	$tenfilter = ' - Giá giảm dần';
    	$tintuc = '';
    }
    else if(isset($_GET['dieukien'])&&$_GET['dieukien']==3){
    	$sanpham = 'order by sanpham.thoigian desc';
    	$tenfilter = ' - Mới nhất';
    	$tintuc = 'order by thoigian desc';
    }
    else if(isset($_GET['dieukien'])&&$_GET['dieukien']==4){	
    	$sanpham = 'order by sanpham.thoigian asc';
    	$tenfilter = ' - Cũ nhất';
    	$tintuc = 'order by thoigian asc';
    }
    else{
    	$sanpham = '';
    	$tenfilter = '';
    	$tintuc = '';
    }
 ?>
<?php
	include_once 'classes/category.php';
	$cat = new category();
	$getproductcat_byUrl = $cat->getproductcat_byUrl($url);
	      		if($getproductcat_byUrl){
	      			while($result_name = $getproductcat_byUrl->fetch_assoc()){
	      				$title=$result_name['title'];
	      				$description=$result_name['description'];
	      				$keywords=$result_name['keywords'];
	      				$duongdan='/'.$url;
	      			}
	      		}
	      			else{
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
}}
	      			}      		
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

<script type="text/javascript">
	function status_update(value){	
		var url = document.getElementById('saveurl').value;	
		if (value == 0) {
            window.location.href = url;
        }else{
        	window.location.href=url+"-"+value;
        }
		
	}
</script>
<style type="text/css">
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
</style>
<?php
	      		$getproductcat_byUrl = $cat->getproductcat_byUrl($url);
	      		if($getproductcat_byUrl){
	      			while($result_name = $getproductcat_byUrl->fetch_assoc()){
	      			if($result_name['kieuhienthi']=='1'){


	      	?>
<div class="link-content" style="box-shadow: 0px 0px 5px 0px #bdbdbd;">
    <div class="container">
    	<div class="row">
    		<div class="col-lg-12 col-links">
    			<a href="/" title="Trang chủ"><i class="bi bi-house-door"></i> Trang chủ</a>    			
    			<span>></span>
    			<span><?php echo $result_name['tendm']?></span>
    		</div>
    	</div>
    </div>
</div>	      	
<div class="container-fluid search-container">
	      		
 	<div class="row">
 		<div class="col-12">
	 		<input type="hidden" name="saveurl" id="saveurl" value="<?php echo $url; ?>">
 		</div>
 		<div class="col-12">
 			<form action="" method="post">
				<table style="float:right;">
					<tr>
						<th><label style="color:#428bca"><i class="bi bi-funnel"></i> Bộ lọc</label></th>
						<th><select name="filtergia" class="form-control" onchange="status_update(this.options[this.selectedIndex].value)">
							
							<?php 
								if(isset($_GET['dieukien'])&&$_GET['dieukien']==1){?>
									<option value="0">--Sắp xếp--</option>
									<option value="1" selected>Giá tăng dần</option>
									<option value="2">Giá giảm dần</option>
									<option value="3">Mới nhất</option>
									<option value="4">Cũ nhất</option>
    	
					    <?php }elseif(isset($_GET['dieukien'])&&$_GET['dieukien']==2){ ?>
					    			<option value="0">--Sắp xếp--</option>
									<option value="1">Giá tăng dần</option>
									<option value="2" selected>Giá giảm dần</option>
									<option value="3">Mới nhất</option>
									<option value="4">Cũ nhất</option>
						<?php }elseif(isset($_GET['dieukien'])&&$_GET['dieukien']==3){ ?>
					    			<option value="0">--Sắp xếp--</option>
									<option value="1">Giá tăng dần</option>
									<option value="2">Giá giảm dần</option>
									<option value="3" selected>Mới nhất</option>
									<option value="4">Cũ nhất</option>
						<?php }elseif(isset($_GET['dieukien'])&&$_GET['dieukien']==4){ ?>
					    			<option value="0">--Sắp xếp--</option>
									<option value="1">Giá tăng dần</option>
									<option value="2">Giá giảm dần</option>
									<option value="3">Mới nhất</option>
									<option value="4" selected>Cũ nhất</option>	
					    <?php }else{?>
					    			<option value="0">--Sắp xếp--</option>
									<option value="1">Giá tăng dần</option>
									<option value="2">Giá giảm dần</option>
									<option value="3">Mới nhất</option>
									<option value="4">Cũ nhất</option>

						<?php	} ?>
						</select></th>
						
					</tr>
				</table>
				
			</form>
 		</div>
 		
				<?php
	      		$productbycart = $cat->get_product_by_cart($result_name['madm'],$sanpham);
	      		if($productbycart){
	      			while($result = $productbycart->fetch_assoc()){
	      		
	      	?>
 			<div class="col-lg-3 show-4-1">
 				<a href="<?php echo $result['url1']?>/<?php echo $result['url']?>-<?php echo $result['mausac']?>-<?php echo $result['kichco']?>" title="<?php echo $result['tensp']?>"><img src="admin/uploads/<?php echo $result['hinhanh']?>" alt="<?php echo $result['tensp']?>" width="100%"></a>
 				<p class="text-start text-dark p-tensp"><a href="<?php echo $result['url1']?>/<?php echo $result['url']?>-<?php echo $result['mausac']?>-<?php echo $result['kichco']?>" title="<?php echo $result['tensp']?>" class="tensanpham"><span><?php echo $result['tensp']  ?></span></a><br>
 				<span style="font-size:14px;"><?php echo $result['id']  ?></span></p>
 				<?php 
 				
 				if($result['giakm']!="0"){
 					?> 					
 					<span style="color: #f94c43;font-weight: 600;font-size: 19px;">
    				<?php echo $fm->format_currency($result['giakm'])." "."đ"?></span>
 					<span style="font-weight: 600;font-size: 16px;color: #939393;"><del><?php echo $fm->format_currency($result['gia'])." "."đ"?></del></span>
 					<span class="giamgia"><i class="bi bi-lightning-fill"></i> Giảm <?php $giamgia=(($result['gia']-$result['giakm'])/$result['gia'])*100; echo round($giamgia)."%"; ?></span>
 					<?php
 				}
 				else{
 					?>
 					<span style="font-weight: 600;font-size: 19px;color: #428bca;"><?php echo $fm->format_currency($result['gia'])." "."đ"?></span>
 					<?php  
 				}
 				 ?>
 				
 				
 			</div>
 			<?php
					}
				}else{
					echo 'Không có sản phẩm bạn cần tìm, bạn hãy tìm danh mục khác xem sao. ';
				}
				?>
 		
 	</div>
 </div>


<?php }else{ ?>
<div class="link-content" style="box-shadow: 0px 0px 5px 0px #bdbdbd;">
    <div class="container">
    	<div class="row">
    		<div class="col-lg-12 col-links">
    			<a href="/" title="Trang chủ"><i class="bi bi-house-door"></i> Trang chủ</a>    			
    			<span>></span>
    			<span><?php echo $result_name['tendm']?></span>
    		</div>
    	</div>
    </div>
</div>	
<div class="container-fluid search-container">
	      		
 	<div class="row">
 		<div class="col-12">
 			
	 		<input type="hidden" name="saveurl" id="saveurl" value="<?php echo $url; ?>">
 	</div>
 		<div class="col-lg-12" style="padding-bottom: 20px;">
 			<form action="" method="post">
				<table style="float:right;border: none;">
					<tr style="border:none;">
						<th style="border:none;"><label style="color:red;"><i class="bi bi-funnel"></i> Bộ lọc</label></th>
						<th style="border:none;">
							<select name="filtergia" class="form-control" onchange="status_update(this.options[this.selectedIndex].value)">
								<option value="0">--Sắp xếp--</option>
								<?php 
									if(isset($_GET['dieukien'])&&$_GET['dieukien']==3){?>
										<option value="3" selected>Mới nhất</option>
										<option value="4">Cũ nhất</option>
	    	
						    <?php }elseif(isset($_GET['dieukien'])&&$_GET['dieukien']==4){ ?>
						    			<option value="3">Mới nhất</option>
										<option value="4" selected>Cũ nhất</option>		
						    <?php }else{?>
						    			<option value="3">Mới nhất</option>
										<option value="4">Cũ nhất</option>

							<?php	} ?>
								
							</select>
						</th>
						
					</tr>
				</table>
				
			</form>
 		</div>
 
				<?php
	      		$blogbypost = $post->get_blog_by_post($result_name['madm'],$tintuc);
	      		if($blogbypost){
	      			while($result = $blogbypost->fetch_assoc()){
	      		
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
				}else{
					echo 'Không có tin tức bạn cần tìm, bạn hãy tìm danh mục khác xem sao. ';
				}
				?>
 		
 	</div>
 </div>

<?php }}} ?>

 <?php
	include 'include/footer.php';
	
?>