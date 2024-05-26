<?php
	$title='Hỗ Trợ Sinh Viên';
	$description = 'Giỏ hàng của bạn';
	$keywords = 'Giỏ hàng';
	$duongdan='/gio-hang';
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
if(isset($_GET['magio']) ){    
    $magio=$_GET['magio'];
    $delete=$ct->delete_cart($magio);
}
	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
		$Magio = $_POST['magio'];
        $quantity = $_POST['quantity'];
        $update_quantity_cart =$ct->update_quantity_cart($quantity,$Magio);
        if($quantity==0){
        	$delete=$ct->delete_cart($Magio);
        }
    }
?>	
<style type="text/css">
	.btn.btn-danger{
        color:white; background:#ec2424; border: none;
    }
    .btn.btn-danger:hover{
        color: black;
        background: burlywood;
    }
    .productname{
    	color: #428bca;
    	text-decoration: none;
    	font-size: 19px;
    }
    .productname:hover{
    	color: #ea1c00;
    }
</style>

<div class="link-content" style="box-shadow: 0px 0px 5px 0px #bdbdbd;">
    <div class="container">
    	<div class="row">
    		<div class="col-lg-12 col-links">
    			<a href="/" title="Trang chủ"><i class="bi bi-house-door"></i> Trang chủ</a>    			
    			<span>></span>
    			<span>Giỏ hàng</span>
    		</div>
    	</div>
    </div>
</div> 
<div class="container" style="padding:30px 10px 30px 10px;">
	<div class="row">
		<div class="col-lg-12" style="border-bottom: 1px solid rgba(51,51,51,0.2)"><h2><i class="bi bi-cart"></i> Giỏ hàng của bạn</h2></div>
		<div class="col-lg-12" style="overflow-x:auto; padding-top:30px ;">
			<?php
			    		if(isset($update_quantity_cart)){
			    			echo $update_quantity_cart;
			    		}
			    	?>
			    	<?php
			    		if(isset($delete)){
			    			echo $delete;
			    		}
			    	?>
						<table class="table table-bordered" style="margin-left: auto;margin-right: auto;"> 									
							<tr>
								<th width="35%">Tên sản phẩm</th>
								<th width="10%">Hình ảnh</th>								
								<th width="10%">Màu sắc</th>
								<th width="10%">Kích cỡ</th>
								<th width="10%">Giá</th>
								<th width="10%">Số lượng</th>
								<th width="15%">Tổng giá</th>
								<th width="10%">Xóa</th>
							</tr>
							<?php
							$login_check = Session::get('customer_login');
	  		if($login_check==false){
								$get_product_cart = $ct->get_product_cart();
								if($get_product_cart){
									$subtotal = 0;
									$qty = 0;
									while ($result = $get_product_cart->fetch_assoc()) {
							$get_product_by_id = $product->getproductbydh($result['masp']);
		                    if($get_product_by_id){
		                        while($result_product = $get_product_by_id->fetch_assoc() ){																		
							?>

							<tr>
								<td><a href="<?php echo $result_product['url1'] ?>/<?php echo $result_product['url'] ?>" title="<?php echo $result['tensp']?>" class="productname"><?php echo $result['tensp']?></a></td>
								<td><img src="admin/uploads/<?php echo $result['hinhanh']?>" alt="<?php echo $result['tensp']?>" width="100%"/></td>
								<td><span><?php echo $result['tenmau'] ?></span></td>
								<td><span><?php echo $result['tenkichco'] ?></span></td>
								<?php
									if($result['giakm']!="0"){
										?>

										<td><?php echo $fm->format_currency($result['giakm'])."đ" ?> <del><?php echo $fm->format_currency($result['gia'])."đ" ?></del></td>
										<?php  }else{?>
									
										<td><?php echo $fm->format_currency($result['gia'])."đ" ?></td>
									<?php } ?>
								 
								<td>
									<form action="" method="post">
										<input type="hidden" name="magio" value="<?php echo $result['magio'] ?>"/>

										<input type="number" name="quantity" min="0" value="<?php echo $result['soluong'] ?>" style="padding: 5px 0 5px 5px;outline: none;"/>
										<input type="submit" name="submit" class="btn btn-secondary" value="Update"/>

									</form>
								</td>
								<td>
									<?php
										if($result['giakm']!="0"){
											$total = $result['giakm'] * $result['soluong'];
											echo $fm->format_currency($total)."đ";
										}else{
											$total = $result['gia'] * $result['soluong'];
											echo $fm->format_currency($total)."đ";
										}
									?>
								</td>
								<td class="text-center"><a href="gio-hang?magio=<?php echo $result['magio']?>" title="Xóa" style="text-decoration: none; color:black;"><i class="bi bi-trash"></i></a></td>
							</tr>
							
							<?php
							$subtotal +=$total;
							$qty = $qty + $result['soluong'];
								}
							}
						}
					}
							?>
							<?php
								$check_cart = $ct->check_cart();
								if($check_cart){
										
									?>
							<tr>
								<td colspan="4" class="text-center"><h4>Tổng tiền</h4></td>
								<td colspan="2" class="text-center"><?php
										
										echo $fm->format_currency($subtotal)."đ";
										Session::set('sum',$subtotal);
										Session::set('qty',$qty);
									?></td>
							</tr>
							<?php
					   	}else{
					   		echo '<div class="text-center" style="padding-top:15px;">Giỏ hàng của bạn trống ! Mua ngay</div>';
					   	}}else{
					   		$customer_id = Session::get('customer_id');
					   		$get_product_cart = $ct->get_product_cart1($customer_id);
								if($get_product_cart){
									$subtotal = 0;
									$qty = 0;
									while ($result = $get_product_cart->fetch_assoc()) {
							$get_product_by_id = $product->getproductbydh($result['masp']);
		                    if($get_product_by_id){
		                        while($result_product = $get_product_by_id->fetch_assoc() ){			
					   ?>
							<tr>
								<td><a href="<?php echo $result_product['url1'] ?>/<?php echo $result_product['url'] ?>" title="<?php echo $result['tensp']?>" class="productname"><?php echo $result['tensp']?></a></td>
								<td><img src="admin/uploads/<?php echo $result['hinhanh']?>" alt="<?php echo $result['tensp']?>" width="100%"/></td>
								<td><span><?php echo $result['tenmau'] ?></span></td>
								<?php
									if($result['giakm']!="0"){
										?>

										<td><?php echo $fm->format_currency($result['giakm'])."đ" ?> <del><?php echo $fm->format_currency($result['gia'])."đ" ?></del></td>
										<?php  }else{?>
									
										<td><?php echo $fm->format_currency($result['gia'])."đ" ?></td>
									<?php } ?>
								 
								<td>
									<form action="" method="post">
										<input type="hidden" name="magio" value="<?php echo $result['magio'] ?>"/>

										<input type="number" name="quantity" min="0" value="<?php echo $result['soluong'] ?>" style="padding: 5px 0 5px 5px;outline: none;"/>
										<input type="submit" name="submit" class="btn btn-secondary" value="Update"/>

									</form>
								</td>
								<td>
									<?php
										if($result['giakm']!="0"){
											$total = $result['giakm'] * $result['soluong'];
											echo $fm->format_currency($total)."đ";
										}else{
											$total = $result['gia'] * $result['soluong'];
											echo $fm->format_currency($total)."đ";
										}
									?>
								</td>
								<td class="text-center"><a href="gio-hang?magio=<?php echo $result['magio']?>" title="Xóa" style="text-decoration: none; color:black;"><i class="bi bi-trash"></i></a></td>
							</tr>
							
							<?php
							$subtotal +=$total;
							$qty = $qty + $result['soluong'];
								}
							}
						}
					}
							?>
							<?php
								$check_cart = $ct->check_cart();
								if($check_cart){
										
									?>
							<tr>
								<td colspan="4" class="text-center"><h4>Tổng tiền</h4></td>
								<td colspan="2" class="text-center"><?php
										
										echo $fm->format_currency($subtotal)."đ";
										Session::set('sum',$subtotal);
										Session::set('qty',$qty);
									?></td>
							</tr>

						<?php }else{
					   		echo '<div class="text-center" style="padding-top:15px;">Giỏ hàng của bạn trống ! Mua ngay</div>';
					   	}} ?>	
						</table>						
					   
		</div>
		<div class="col-lg-12" style="position: relative;justify-content: center;align-items: center; display: flex;">
			<p style="padding:30px 40px 10px 40px;"><a href="http://localhost/HoTroSV/" title="Trang chủ" class="btn btn-danger" style="text-decoration:none;"><i class="bi bi-cart"></i> Mua tiếp</a></p>			
	   
		   		<p style="padding:30px 40px 10px 40px;"><a href="dat-hang" title="Đặt hàng" class="btn btn-danger"><i class="bi bi-wallet"></i> Thanh toán</a></p>
		   
			
		</div>
	</div>
</div>
 <?php
	include 'include/footer.php';
	
?>
