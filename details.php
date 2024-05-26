<?php
	 if(!isset($_GET['url_sp']) || $_GET['url_sp']==NULL){
   		echo "<script>window.location ='404.php'</script>";
   
}else{
	$size=$_GET["size"];
    $color=$_GET['color'];
    $url=$_GET['url_sp'];
    $url1=$_GET['url'];
}
?>
<?php
	include_once 'classes/product.php';
	$product = new product();
	$get_product_details = $product->get_detailsbyUrl($url);
    			if($get_product_details){
    				while ($result_details = $get_product_details->fetch_assoc()) {
	      				$title=$result_details['title'];
	      				$description=$result_details['description'];
	      				$keywords=$result_details['keywords'];
	      				$duongdan='/'.$url1.'/'.$url.'-'.$color;
	      				$image='admin/uploads/'.$result_details['hinhanh'];
$productSchema = [
   "@context" => "http://schema.org/",
   "@type" => "Product",
   "name" => $result_details['tensp'],
   "image" => "http://localhost/hotrosv/admin/uploads/".$result_details['hinhanh'],
   "description" => $result_details['description'],
   "sku" => $result_details['masp'],
   "brand" => [
      "@type" => "Brand",
      "name" => "Hỗ Trợ Sinh Viên"
   ],
   "aggregateRating" => [
      "@type" => "AggregateRating",
      "ratingValue" => "Tốt",
      "reviewCount" => "Tốt"
   ],
   "offers" => [
      "@type" => "Offer",
      "priceCurrency" => "VNĐ",
      "price" => $result_details['gia'],
      "availability" => "Luôn luôn",
      "seller" => [
         "@type" => "Organization",
         "name" => "Hỗ Trợ Sinh Viên"
      ]
   ]
];



$productSchemaJson = json_encode($productSchema, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);      				
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
	$image='admin/uploads/'.$result['logo'];
	$productSchemaJson = '';
}}
	      			}
	include 'include/header.php';
	//include 'include/slider.php';
?>
 <?php 
 

$login_check = Session::get('customer_login');
if($login_check==true){
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['dathangluon'])){
        $quantity = $_POST['quantity'];
        $customer_id = Session::get('customer_id');
        $insert1 =$ct->add_1to_cart1($quantity,$url,$color,$size,$customer_id);
    }
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
        $quantity = $_POST['quantity'];
        $customer_id = Session::get('customer_id');
        $insert =$ct->add_to_cart1($quantity,$url,$color,$size,$customer_id);
    }
}else{
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['dathangluon'])){
        $quantity = $_POST['quantity'];
        $insert1 =$ct->add_1to_cart($quantity,$url,$color,$size);
    }
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
        $quantity = $_POST['quantity'];
        $insert =$ct->add_to_cart($quantity,$url,$color,$size);
    }
}

  ?>   
<script type="application/ld+json">
   <?php echo $productSchemaJson; ?>
</script>

<script type="text/javascript">
	function color_update(color,size){	
		var url = document.getElementById('saveurl').value;	
		var url1 = document.getElementById('saveurl1').value;
		window.location.href=url1+"/"+url+"-"+color+"-"+size;
	}
	function size_update(color,size){	
		var url = document.getElementById('saveurl').value;	
		var url1 = document.getElementById('saveurl1').value;
		window.location.href=url1+"/"+url+"-"+color+"-"+size;
	}

</script>
<div class="link-content" style="box-shadow: 0px 0px 5px 0px #bdbdbd;">
    <div class="container">
    	<div class="row">
    		<?php 
    			$get_product_details = $product->get_detailsbyUrl($url);
    			if($get_product_details){
    				while ($result_details = $get_product_details->fetch_assoc()) {
    		 ?>
    		<div class="col-lg-12 col-links">
    			<a href="/" title="Trang chủ"><i class="bi bi-house-door"></i> Trang chủ</a>
    			<span>></span>
    			<a href="<?php echo $result_details['url1'] ?>" title="<?php echo $result_details['tendm'] ?>"><?php echo $result_details['tendm'] ?></a>
    			<span>></span>
    			<span><?php echo $result_details['tensp'] ?></span>
    		</div>
    	<?php }} ?>
    	</div>
    </div>
</div>
<div class="container details-container">
	<div class="row">
		<?php
    			$get_product_details = $product->get_detailsbyUrl($url);
    			if($get_product_details){
    				$giamgia = 0;
    				while ($result_details = $get_product_details->fetch_assoc()) {
    					
    		?>
		<div class="col-lg-4 img-field" >
			<div class="slider-for" style="height: 75%;">
				<?php
    			$get_sptrung = $product->get_sptrungbyUrl($url);
    			if($get_sptrung){
    				while ($result_trung = $get_sptrung->fetch_assoc()) {
    					
    		?>
				<div class="for-item" style="position:relative;">
					<img src="admin/uploads/<?php echo $result_trung['hinhanh']?>" width="100%" alt="Ảnh sản phẩm">
					<button class="btn-zoom"  data-bs-toggle="modal" data-bs-target="#zoomimage"><i class="bi bi-fullscreen fa-2x"></i></button>
				</div>
			<?php }} ?>
			</div>
			<div class="slider-nav">
				<?php
    			$get_sptrung = $product->get_sptrungbyUrl($url);
    			if($get_sptrung){
    				while ($result_trung = $get_sptrung->fetch_assoc()) {
    					
    		?>
				<div class="nav-item">
					<img src="admin/uploads/<?php echo $result_trung['hinhanh']?>" alt="Ảnh sản phẩm" width="100%">
				</div>
			<?php }} ?>
			</div>
			
		</div>
		<div class="col-lg-5 info-field">
			<p class="h4" style="border-bottom: 1px solid rgba(51,51,51,0.2); font-weight: 600;"><?php echo $result_details['tensp']?></p>
			<p style="border-bottom: 1px solid rgba(51,51,51,0.2); font-weight: 600; font-size: 14px;">Mã sản phẩm: <?php echo $result_details['id']?></p>
			<?php

			 $get_1sptrung = $product->get_1sptrungbyUrl($url,$color,$size);
    			if($get_1sptrung){
    				while ($result_1sptrung = $get_1sptrung->fetch_assoc()) {
				if($result_1sptrung['giakm']!="0"){

				
			 ?>
			<p style="border-bottom: 1px solid rgba(51,51,51,0.2);"><span style="background-image: linear-gradient(-90deg, #ec1f1f 0%, #ff9c00 100%);border-radius: 5px;
			color: white;left: 30px;padding: 3px;">	
			<i class="bi bi-lightning-fill"></i> <span> Giảm <?php $giamgia=(($result_1sptrung['gia']-$result_1sptrung['giakm'])/$result_1sptrung['gia'])*100; echo round($giamgia)."%"; ?></span> </span>
			 <span style="font-size:19px;font-weight: 600;color: #f94c43;padding-left: 5px;"> <?php echo $fm->format_currency($result_1sptrung['giakm'])."đ"?></span>
		  	<span style="font-weight: 600;font-size: 16px;color: #939393;"><del><?php echo $fm->format_currency($result_1sptrung['gia'])."đ"?></del></span>		

			</p>
			<?php }else{ ?>
			<p style="border-bottom: 1px solid rgba(51,51,51,0.2);"><span style="font-size:19px;font-weight: 600;color: #f94c43;padding-left: 5px;"><?php echo $fm->format_currency($result_1sptrung['gia'])."đ"?></span></p>
			<?php } 
		}
	}else{
		echo "Không có sản phẩm này! Bạn hãy chọn kích cỡ khác.";
	}?>

			<p style="border-bottom: 1px solid rgba(51,51,51,0.2);">Loại: <span style="color: #428bca;font-size: 18px;font-weight: 600;"><?php echo $result_details['tendm']?></span><BR>
			Thương hiệu: <span style="color: #428bca;font-size: 18px;font-weight: 600;"><?php echo $result_details['tenth']?></span></p>
			<input type="hidden" name="saveurl1" id="saveurl1" value="<?php echo $url1; ?>">
 			<input type="hidden" name="saveurl" id="saveurl" value="<?php echo $url; ?>">
			<form action="" method="post">
				<div style="padding: 10px 8px 10px 8px;">
					<table class="table-color">					
					<tr>
						<td>Màu sắc: </td>
						<td colspan="3">
							<?php
    			$get_sptrung = $product->get_colorbyUrl($url);
    			if($get_sptrung){
    				$i = 0;
    				while ($result_trung = $get_sptrung->fetch_assoc()) {
    				$i++;
    				if($result_trung['mausac']==$color){   				
    		?>
    			<input type="radio" class="btn-check" name="options" id="option-<?php echo $i; ?>" value="<?php echo $result_trung['mausac']?>" onclick="color_update(this.value,<?php echo $size; ?>)">
				<label class="label-mau label-mau-active" for="option-<?php echo $i; ?>"><?php echo $result_trung['tenmau']?></label>
    	<?php }else{ ?>

    			<input type="radio" class="btn-check" name="options" id="option-<?php echo $i; ?>" value="<?php echo $result_trung['mausac']?>" onclick="color_update(this.value,<?php echo $size; ?>)">
				<label class="label-mau" for="option-<?php echo $i; ?>"><?php echo $result_trung['tenmau']?></label>

    		<?php }}} ?>	
						</td>
					</tr>
					<tr>
						<td>Kích thước: </td>
						<td colspan="3">
							<?php
    			$get_sptrung = $product->get_sptrungbyUrlAndColor($url,$color);
    			if($get_sptrung){
    				$i = 0;
    				while ($result_trung = $get_sptrung->fetch_assoc()) {
    				$i++;
    				if($result_trung['kichco']==$size){   				
    		?>
    			<input type="radio" class="btn-check" name="optionskt" id="optionkt-<?php echo $i; ?>" value="<?php echo $result_trung['kichco']?>" onclick="size_update(<?php echo $color; ?>,this.value)">
				<label class="label-mau label-mau-active" for="optionkt-<?php echo $i; ?>"><?php echo $result_trung['tenkichco']?></label>
    	<?php }else{ ?>

    			<input type="radio" class="btn-check" name="optionskt" id="optionkt-<?php echo $i; ?>" value="<?php echo $result_trung['kichco']?>" onclick="size_update(<?php echo $color; ?>,this.value)">
				<label class="label-mau" for="optionkt-<?php echo $i; ?>"><?php echo $result_trung['tenkichco']?></label>

    		<?php }}} ?>	
						</td>
					</tr>
				</table>
				</div>
				<div style="padding: 10px 8px 10px 8px;">
					<label>Số lượng:</label>
					<?php $get_soluong = $product->get_1sptrungbyUrl($url,$color,$size);
    			if($get_soluong){
    				while ($result_soluong = $get_soluong->fetch_assoc()) {   ?>
					<input type="number" class="buyfield" name="quantity" value="1" min="1" max="<?php echo $result_soluong[('soluong')] ?>" class="form-control" />
				<?php }} ?>
				</div>
				
				<?php
    			$get_soluong = $product->get_1sptrungbyUrl($url,$color,$size);
    			if($get_soluong){
    				while ($result_soluong = $get_soluong->fetch_assoc()) {
    					
    		
					 if($result_soluong['soluong']!="0"){
					
						$login_check = Session::get('customer_login');
				  					   
					   	echo '<div style="display:flex;"><button type="submit" class="btn btn-cart" name="submit"><i class="bi bi-cart"></i> Thêm vào giỏ  </button></br>
						<button type="submit" class="btn btn-danger" name="dathangluon"><i class="bi bi-bag"></i> Mua ngay  </button></div></br>';					  
				}else{
					echo '<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#myModal">
  				Liên hệ
		</button>';
				}}} ?>
						<?php
							if(isset($insert)){
								echo $insert;
							}
							if(isset($insert1)){
								echo $insert1;
							}
						?>

			</form>		
		</div>
		<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Gửi cho chúng tôi để được tư vấn.</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      	<?php 
    if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['lienhesanpham'])){
        $status	= 0;
		$ten	= $_POST['ten'];
		$email	= 'No Email';
		$sdt	= $_POST['sdt'];
		$chude	= 'Thắc mắc về sản phẩm hết hàng.';
		
		if($ten=="" || $sdt=="") {
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
					$ten='';
					$sdt='';
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
        if(isset($contact_product)){
        	echo $contact_product;
        }
    } ?>
        <form class="mx-1 mx-md-4" method="POST"  style="padding-top:10px">
                <div class="d-flex flex-row align-items-center mb-4">
                    <i class="bi bi-person-fill me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" name="ten" class="form-control" placeholder="Họ tên" />
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="bi bi-phone-fill fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" name="sdt" class="form-control" placeholder="Số điện thoại" />
                    </div>
                  </div>                                       
                           
                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" name="lienhesanpham" class="btn btn-danger">Gửi ngay</button>
                  </div>
                </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
      </div>

    </div>
  </div>
</div>


<!-- The Other Modal -->
<div class="modal" id="zoomimage">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Hình ảnh</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="zoom-slider">
				<?php
    			$get_sptrung = $product->get_sptrungbyUrl($url);
    			if($get_sptrung){
    				while ($result_trung = $get_sptrung->fetch_assoc()) {
    					
    		?>
				<div class="zoom-item">
					<img src="admin/uploads/<?php echo $result_trung['hinhanh']?>" alt="Ảnh slide sản phẩm" width="70%" style="display: block;
							  margin-left: auto;
							  margin-right: auto;
							  width: 70%;">
				</div>
			<?php }} ?>
			</div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
      </div>

    </div>
  </div>
</div>
		
		<div class="col-lg-3 rightsidebar">
			<p class="h3">Danh mục</p>
			<ul>

				<?php
							$getall_category = $cat->show_category_fontend();
							if($getall_category){
								while($result_allcat = $getall_category->fetch_assoc()){


						?>
				<li><a href="<?php echo $result_allcat['url']?>" title="<?php echo $result_allcat['tendm']?>"><i class="bi bi-chevron-right"></i> <?php echo $result_allcat['tendm']?></a></li>
				<?php
				      	}
				      }
				      ?>
				
			</ul>
		</div>
		<div class="col-lg-9">
			<p style="border-bottom: 2px solid #428bca;position: relative; padding-top: 20px;"><span class="chitietsp">Mô tả</span></p>
			<p style="padding-top:-25px;position: absolute;">
				<?php echo $result_details['thongtin']?> <br>			

		</div>
		<?php
		}
	}
	?>
		<div class="col-lg-3"></div>
		<div class="col-lg-12" style="padding-top:30px;"><h4><p style="border-bottom: 2px solid #428bca;position: relative; padding-top: 20px;"><span class="chitietsp">SẢN PHẨM LIÊN QUAN</span></p></h4></div>
		<div class="col-lg-12" style="padding-top:30px;">
			<div class="product-slider">
				<?php
    			$get_product_details = $product->get_detailsbyUrl($url);
    			if($get_product_details){
    				$giamgia = 0;
    				while ($result_details = $get_product_details->fetch_assoc()) {
    			$productbycart = $cat->get_product_by_cat($result_details['danhmuc']);
	      		if($productbycart){
	      			while($result = $productbycart->fetch_assoc()){
    					
    		?>
				<div class="item-slider">
					<a href="<?php echo $result['url1']?>/<?php echo $result['url']?>-<?php echo $result['mausac']?>-<?php echo $result['kichco']?>" title="<?php echo $result['tensp']  ?>"><img src="admin/uploads/<?php echo $result['hinhanh']?>" alt="<?php echo $result['tensp']  ?>"  width="100%"></a>
					<p class="text-start text-dark p-tensp"><a href="<?php echo $result['url1']?>/<?php echo $result['url']?>-<?php echo $result['mausac']?>-<?php echo $result['kichco']?>" title="<?php echo $result['tensp']  ?>" class="tensanpham"><span><?php echo $result['tensp']  ?></span></a><br>
 				<span style="font-size:14px;"><?php echo $result['id']  ?></span></p>
					<?php 
				if($result['giakm']!="0"){

				
			 ?>
					<p><span class="giamgia1">	
					<i class="bi bi-lightning-fill"></i> Giảm <?php $giamgia=(($result['gia']-$result['giakm'])/$result['gia'])*100; echo round($giamgia)."%"; ?> </span>
					 <span style="font-size:19px;font-weight: 600;color: #f94c43;padding-left: 5px;"> <?php echo $fm->format_currency($result['giakm'])."đ"?></span>
					 <span style="font-weight: 600;font-size: 16px;color: #939393;"><del><?php echo $fm->format_currency($result_details['gia'])."đ"?></del></span>			

					</p>
					<?php }else{ ?>
					<p><span style="font-size:19px;font-weight: 600;color: #f94c43;padding-left: 5px;"><?php echo $fm->format_currency($result['gia'])."đ"?></span></p>
					<?php } ?>
				</div>

				<?php
			}}
		}
	}
	?>
			</div>
		</div>
	</div>
</div> 


 <?php
	include 'include/footer.php';
	
?>