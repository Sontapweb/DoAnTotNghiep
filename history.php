<?php
	$title='Lịch sử';
	$description = 'Lịch sử đặt hàng của quý khách';
	$keywords = 'Lịch sử';	
	$duongdan='/lich-su-dat-hang';
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
    			<span>Lịch sử</span>
    		</div>
    	</div>
    </div>
</div>

<form action="" method="post">
 <div class="container" style="padding:30px 10px 30px 10px;">
 	<div class="row">
 		<div class="col-lg-12" style="border-bottom: 1px solid rgba(51,51,51,0.2)"><h2 style="color:#ec2424"><i class="bi bi-clock-history"></i> Lịch sử đặt hàng</h2></div>
		<div class="col-lg-12" style="overflow-x:auto; padding-top:30px ;">
			
						<table class="table table-bordered" style="margin-left: auto;margin-right: auto;"> 									
							<tr>
								<th width="5%">ID</th>
								<th>Mã SP</th>
								<th>Tên sản phẩm</th>
								<th>Màu sắc</th>
								<th>Kích cỡ</th>
								<th>Giá</th>
								<th>Số lượng</th>
								<th>Ngày đặt</th>
								<th>Tổng tiền</th>
							</tr>
							<?php
								$customer_id = Session::get('customer_id');
								$get_history = $cart->get_history($customer_id);
								if($get_history){
									$subtotal = 0;
									$qty = 0;
									$i = 0;
									while ($result = $get_history->fetch_assoc()) {
										$i++;
									
								
							?>

							<tr>
								<td><?php echo $result['id'] ?></td>
								<td><?php echo $result['masp']?></td>
								<td><?php echo $result['tensp']?></td>
								<td><?php echo $result['tenmau']?></td>		
								<td><?php echo $result['tenkichco']?></td>						
								<td><?php echo $fm->format_currency($result['gia']).'đ'?></td>
								<td><?php echo $result['soluong']?></td>							
								<td><?php echo $fm->formatDate_Details($result['ngaydathang'])?></td>
								<td><?php echo 
								$tongtien = $result['gia'] * $result['soluong'];
								$fm->format_currency($tongtien).'đ' ?></td>
							</tr>
							
							<?php
							
								}
							}
							?>
							
						</table>						
					   
		</div>
 	</div>
 </div>
	</form>
 <?php
	include 'include/footer.php';
	
?>