<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/user.php';?>
<?php

    $user=new user();
    $select =$user->show_user();
if(isset($_GET['makh']) ){    
    $id=$_GET['makh'];
    $delete=$user->delete_user($id);
}
?>

        <div class="col-10" style="background: #fff;">
            <p class="h4" style="background-color:#E6F0F3;padding: 10px 5px 10px 5px;color: #196F3D; font-weight: 600;border-bottom: 2px solid rgba(51,51,51,0.2)">Danh sách tài khoản khách hàng</p>
            <?php 
                    if(isset($delete)){
                        echo $delete;
                    }
                ?> 
                    <table id="example" class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th>Thứ tự </th>
							<th>Tên người dùng</th>
							<th>Địa chỉ</th>
							<th>SĐT</th>
							<th>Email</th>
							<th>Hành động</th>
						</tr>
					</thead>
					<tbody>
						<?php
							
							if(isset($select)){
								$i = 0;
								while ($result = $select->fetch_assoc()) {
									$i++;
								
							
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?>		</td>
							<td><?php echo $result['ten'] ?>	</td>
							<td><?php echo $result['diachi'] ?>		</td>
							<td><?php echo $result['sdt'] ?>		</td>
							<td><?php echo $result['email'] ?>	</td>
							<td>#</td>
						</tr>
						
						<?php
							}
						}
						?>
					</tbody>
				</table>
        </div>
<?php include 'inc/footer.php';?>

