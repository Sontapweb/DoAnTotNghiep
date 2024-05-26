<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../classes/cart.php');
    include_once ($filepath.'/../helpers/format.php');
?>


<div class="details">
            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>Đơn đặt hàng</h2>
                </div>
            <?php
                	
                	// if(isset($delete)){
                	// 	echo $delete;
                	// }
                ?>       
                    <table id="example" class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th>Thứ tự</th>
							<th>Mã sản phẩm</th>
							<th>Tên sản phẩm</th>
							<th>Số lượng</th>
							<th>Giá</th>
							<th>Ngày đặt</th>
							<th>Màu sắc</th>						
							<th>Hành động</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$ct = new cart();
							$fm = new format();
							$get_complete_order = $ct->get_complete_order();
							if($get_complete_order){
								$i = 0;
								while ($result = $get_complete_order->fetch_assoc()) {
									$i++;
							
							
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['masp']?></td>
							<td><?php echo $result['tensp']?></td>
							<td><?php echo $result['soluong']?></td>
							<td><?php echo $result['gia']?></td>
							<td><?php echo $fm->formatDate($result['ngaydathang'])?></td>
							<td><?php echo $result['tenmau']?></td>
							<td>#</td>													
							
						</tr>
						<?php
							}}
						?>
					</tbody>
				</table>
				<form action="dsdh.php" method="post">
					<label>Từ ngày:</label>
					<input type="datetime-local" name="from" value="Từ ngày">
					<label>Đến ngày:</label>
					<input type="datetime-local" name="to" value="Đến ngày">
                	<input type="submit" name="export_excel" class="btn btn-success" value="Xuất Excel"/>
                </form> 
            </div>
        </div>         
<?php include 'inc/footer.php';?>
