<?php
	$title='Hỗ Trợ Sinh Viên - Chi tiết đặt hàng';
	$description = 'Chi tiết các đơn hàng';
	$keywords = 'Chi tiết đặt hàng';	
	$duongdan='/chi-tiet-dat-hang';
	include_once 'classes/blog.php';
                    $blog = new blog();
                    $cauhinh = $blog->show_cauhinh();
                    if($cauhinh){
                        $i = 0;
                        while($result = $cauhinh->fetch_assoc()){                   
		$image='viettel/uploads/'.$result['logo'];
}} 
	include 'include/header.php';
?>
<?php
 
		   $ct = new cart();

if(isset($_GET['comfirmid']) ){
   $id = $_GET['comfirmid'];
   $time = $_GET['time'];
   $price = $_GET['price'];
   $delete = $ct->complete_dathang($id,$time,$price);
   
}

?>
<div class="link-content" style="box-shadow: 0px 0px 5px 0px #bdbdbd;">
    <div class="container">
    	<div class="row">
    		<div class="col-lg-12 col-links">
    			<a href="/" title="Trang chủ"><i class="bi bi-house-door"></i> Trang chủ</a>    			
    			<span>></span>
    			<span>Chi tiết đặt hàng</span>
    		</div>
    	</div>
    </div>
</div>
<form action="" method="post">
 <div class="container" style="padding:30px 10px 30px 10px;">
 	<div class="row">
 		<div class="col-lg-12" style="border-bottom: 1px solid rgba(51,51,51,0.2)"><h2 style="color:#ec2424"><i class="bi bi-bicycle"></i> Chi tiết đặt hàng</h2></div>
		<div class="col-lg-12" style="overflow-x:auto; padding-top:30px ;">
				<?php 
				if(isset($delete)){
					echo $delete;
				}
					 ?>
				<?php 
				$login_check = Session::get('customer_login');
				if($login_check==true)
					{
						$customer_id = Session::get('customer_id');
						?>
				    
				<table class="table table-bordered" style="margin-left: auto;margin-right: auto;"> 									
							<tr>
								<th width="5%">STT</th>
								<th width="10%">Mã SP</th>
								<th width="15%">Tên sản phẩm</th>
								<th width="10%">Màu sắc</th>
								<th width="10%">Kích cỡ</th>
								<th width="10%">Giá</th>
								<th width="15%">Số lượng</th>
								<th width="20%">Ngày đặt hàng</th>
								<th width="15%">Trạng thái</th>
							</tr>			
								<?php
							
								$get_details_cart = $ct->get_details_cart($customer_id);
								if($get_details_cart){
									$subtotal = 0;
									$qty = 0;
									$i = 0;
									while ($result = $get_details_cart->fetch_assoc()) {
										$i++;?>
									<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['masp']?></td>
								<td><?php echo $result['tensp']?></td>
								<td><?php echo $result['tenmau']?></td>
								<td><?php echo $result['tenkichco']?></td>
								<td><?php echo $fm->format_currency($result['gia']).'đ'?></td>
								<td><?php echo $result['soluong']?>					
								</td>
								<td>
									<?php
										
										echo $fm->formatDate($result['ngaydathang']);
									?>
								</td>
							<?php
								if($result['trangthai']=='0'){
										
										?>
										<td><span class="chuaxuly">Đang xử lý</span></td>
										<?php

									}elseif($result['trangthai']=='1'){
										?>
										<td><span class="dangxuly">Đang vận chuyển</span></td>
										<?php
											}else{
										?>
										 <td><a onClick = "return confirm('Bạn đã nhận được hàng rồi chứ ?') " href="?comfirmid=<?php echo $result['orderid']?>&price=<?php echo $result['gia']?>&time=<?php echo $result['ngaydathang']?>" title="Xác nhận" class="daxuly">Đã vận chuyển</a><Br><span style="font-size:13px;">(Click nếu đã nhận)</span></td>;
								<?php	}?>
							</tr>


							<?php	}}	 ?>					
							
							
						</table>	

				<?php
					}else{

					?>
				   
				<table class="table table-bordered" style="margin-left: auto;margin-right: auto;"> 									
							<tr>
								<th width="5%">STT</th>
								<th width="10%">Mã SP</th>
								<th width="15%">Tên sản phẩm</th>
								<th width="10%">Màu sắc</th>
								<th width="10%">Kích cỡ</th>
								<th width="10%">Giá</th>
								<th width="15%">Số lượng</th>
								<th width="20%">Ngày đặt hàng</th>
								<th width="15%">Trạng thái</th>
							</tr>			
								<?php
							
								$get_details_cart = $ct->get_details_cart1();
								if($get_details_cart){
									$subtotal = 0;
									$qty = 0;
									$i = 0;
									while ($result = $get_details_cart->fetch_assoc()) {
										$i++;?>
									<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['masp']?></td>
								<td><?php echo $result['tensp']?></td>
								<td><?php echo $result['tenmau']?></td>
								<td><?php echo $result['tenkichco']?></td>
								<td><?php echo $fm->format_currency($result['gia']).'đ'?></td>
								<td><?php echo $result['soluong']?>					
								</td>
								<td>
									<?php
										
										echo $fm->formatDate($result['ngaydathang']);
									?>
								</td>
							<?php
								if($result['trangthai']=='0'){
										
										?>
										<td><span class="chuaxuly">Đang xử lý</span></td>
										<?php

									}elseif($result['trangthai']=='1'){
										?>
										<td><span class="dangxuly">Đang vận chuyển</span></td>
										<?php
											}else{
										?>
										 <td><a onClick = "return confirm('Bạn đã nhận được hàng rồi chứ ?') " href="chi-tiet-dat-hang?comfirmid=<?php echo $result['orderid']?>&price=<?php echo $result['gia']?>&time=<?php echo $result['ngaydathang']?>" title="Xác nhận" class="daxuly">Đã vận chuyển</a><br><span style="font-size:13px;">(Click nếu đã nhận)</span></td>;
								<?php	}?>
							</tr>


							<?php	}}	 ?>					
							
							
						</table>	


				<?php
				}
				 ?>


						


					

							




											
					   
		</div>
 	</div>
 </div>
	</form>
 <?php
	include 'include/footer.php';
	
?>