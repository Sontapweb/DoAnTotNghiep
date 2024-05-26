<?php
	if(!isset($_GET['url']) || $_GET['url']==NULL){
    echo "<script>window.location ='404.php'</script>";
   
}else{
    $url=$_GET['url'];
}    
     
?>
<?php
include_once 'classes/brand.php';
	$brand = new brand();
	$getproductbrand_byUrl = $brand->getproductbrand_byUrl($url);
	      		if($getproductbrand_byUrl){
	      			while($result_name = $getproductbrand_byUrl->fetch_assoc()){
	      				$title=$result_name['title'];
	      				$description=$result_name['description'];
	      				$keywords=$result_name['keywords'];
	      				$duongdan='/thuong-hieu-'.$url;

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
<?php 
if(isset($_GET['sanpham'])&&$_GET['sanpham']==1){
    $sanpham = 'order by sanpham.gia asc';
    $tenfilter = ' - Giá tăng dần';
    }
    else if(isset($_GET['sanpham'])&&$_GET['sanpham']==2){
    	$sanpham = 'order by sanpham.gia desc';
    	$tenfilter = ' - Giá giảm dần';
    }
    else if(isset($_GET['sanpham'])&&$_GET['sanpham']==3){
    	$sanpham = 'order by sanpham.thoigian desc';
    	$tenfilter = ' - Mới nhất';
    }
    else if(isset($_GET['sanpham'])&&$_GET['sanpham']==4){	
    	$sanpham = 'order by sanpham.thoigian asc';
    	$tenfilter = ' - Cũ nhất';
    }
    else{
    	$sanpham = '';
    	$tenfilter = '';
    }
 ?>
 <script type="text/javascript">
	function status_update(value){	
		var url = document.getElementById('saveurl').value;	
		window.location.href="thuong-hieu-"+url+"-"+value;
	}
</script>

<div class="link-content" style="box-shadow: 0px 0px 5px 0px #bdbdbd;">
    <div class="container">
    	<div class="row">
    		<?php
	      		$getproductbrand_byUrl = $brand->getproductbrand_byUrl($url);
	      		if($getproductbrand_byUrl){
	      			while($result_name = $getproductbrand_byUrl->fetch_assoc()){
	      			
	      	?>
    		<div class="col-lg-12 col-links">
    			<a href="/" title="Trang chủ"><i class="bi bi-house-door"></i> Trang chủ</a>    			
    			<span>></span>
    			<span><?php echo $result_name['tenth']?></span>
    		</div>
    	<?php }} ?>
    	</div>
    </div>
</div>
<div class="container-fluid search-container">
	      		
	      	<?php
	      		$getproductbrand_byUrl = $brand->getproductbrand_byUrl($url);
	      		if($getproductbrand_byUrl){
	      			while($result_name = $getproductbrand_byUrl->fetch_assoc()){
	      			
	      	?>
 	<div class="row">
 		<div class="col-12"><h3><p style="border-bottom: 2px solid #428bca;position: relative; padding-top: 40px;"><span class="tendanhmuc"><?php echo $result_name['tenth']?></span></p>  </h3>
 			<input type="hidden" name="saveurl" id="saveurl" value="<?php echo $url; ?>">

 		</div>
 		<div class="col-12">
 			<form action="" method="post">
				<table style="float:right;">
					<tr>
						<th><label style="color:#428bca"><i class="bi bi-funnel"></i> Bộ lọc</label></th>
						<th><select name="filtergia" class="form-control" onchange="status_update(this.options[this.selectedIndex].value)">
							
							<?php 
								if(isset($_GET['sanpham'])&&$_GET['sanpham']==1){?>
									<option>--Sắp xếp--</option>
									<option value="1" selected>Giá tăng dần</option>
									<option value="2">Giá giảm dần</option>
									<option value="3">Mới nhất</option>
									<option value="4">Cũ nhất</option>
    	
					    <?php }elseif(isset($_GET['sanpham'])&&$_GET['sanpham']==2){ ?>
					    			<option>--Sắp xếp--</option>
									<option value="1">Giá tăng dần</option>
									<option value="2" selected>Giá giảm dần</option>
									<option value="3">Mới nhất</option>
									<option value="4">Cũ nhất</option>
						<?php }elseif(isset($_GET['sanpham'])&&$_GET['sanpham']==3){ ?>
					    			<option>--Sắp xếp--</option>
									<option value="1">Giá tăng dần</option>
									<option value="2">Giá giảm dần</option>
									<option value="3" selected>Mới nhất</option>
									<option value="4">Cũ nhất</option>
						<?php }elseif(isset($_GET['sanpham'])&&$_GET['sanpham']==4){ ?>
					    			<option>--Sắp xếp--</option>
									<option value="1">Giá tăng dần</option>
									<option value="2">Giá giảm dần</option>
									<option value="3">Mới nhất</option>
									<option value="4" selected>Cũ nhất</option>	
					    <?php }else{?>
					    			<option>--Sắp xếp--</option>
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
	      		$productbybrand = $brand->get_product_by_brand($result_name['math'],$sanpham);
	      		if($productbybrand){
	      			while($result = $productbybrand->fetch_assoc()){
	      		
	      	?>
 			<div class="col-lg-3 show-4-1">
 				<a href="<?php echo $result['url1']?>/<?php echo $result['url']?>-<?php echo $result['mausac']?>-<?php echo $result['kichco']?>" title="<?php echo $result['tensp']?>"><img src="admin/uploads/<?php echo $result['hinhanh']?>" alt="<?php echo $result['tensp']?>" width="100%"></a>
 				<p class="text-start text-dark p-tensp"><a href="<?php echo $result['url1']?>/<?php echo $result['url']?>-<?php echo $result['mausac']?>-<?php echo $result['kichco']?>" class="tensanpham" title="<?php echo $result['tensp']?>"><span><?php echo $result['tensp']  ?></span></a><br>
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
					echo 'Không có sản phẩm bạn cần tìm, bạn hãy tìm thương hiệu khác xem sao. ';
				}
				?>
 		
 	</div>
 	<?php
					}
				}
				?>
 </div>

 <?php
	include 'include/footer.php';
	
?>