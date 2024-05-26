<?php
    $title='Hỗ Trợ Sinh Viên - Đặt hàng';
    $description = 'Tiến hành đặt hàng tại đây';
    $keywords = 'Đặt hàng';
    $duongdan='/dat-hang';
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

$login_check = Session::get('customer_login');
if($login_check==true){
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['dathang'])){
        $customer_id = Session::get('customer_id');
        $insertOrder = $ct->insertOrder1($_POST,$customer_id);
    }
}else{
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['dathang'])){
        $insertOrder = $ct->insertOrder($_POST);
    }
}

?>

<style>
td{
    padding: 15px 0 15px 0;
}
tr{
    border-bottom:1px solid rgba(51,51,51,0.2); 
}
</style>
<div class="link-content" style="box-shadow: 0px 0px 5px 0px #bdbdbd;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-links">
                <a href="/" title="Trang chủ"><i class="bi bi-house-door"></i> Trang chủ</a>                
                <span>></span>
                <span>Đặt hàng</span>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid payment-container">
    <div class="row">
        <?php 
            $login_check = Session::get('customer_login');
            if($login_check==true){?>
                
            <div class="col-lg-6" style="border-right: 1px solid rgba(51,51,51,0.2);">
            <h4>THÔNG TIN ĐƠN HÀNG</h4>

            <table>
                <?php
                                $id = Session::get('customer_id');
                                $get_product_cart = $ct->get_product_cart1($id);
                                if($get_product_cart){
                                    $subtotal = 0;
                                    $qty = 0;
                                    while ($result = $get_product_cart->fetch_assoc()) {                                   
                                
                            ?>
                <tr>
                    <td width="20%" style="position:relative;">
                    <img src="admin/uploads/<?php echo $result['hinhanh']?>" alt="<?php echo $result['tensp']?>" width="100%" style="border:1px solid rgba(51,51,51,0.2);border-radius: 20px;">
                        <span style="position:absolute;top:0;right: 0;border:1px solid rgba(51,51,51,0.2);border-radius: 50%;padding: 3px 7px 3px 7px;background: rgba(153,153,153,0.9);"><?php echo $result['soluong'] ?></span>
                    </td>
                    <td width="60%" style="padding-left:10px;"><span><?php echo $result['tensp']?></span><br>
                          <span style="font-size:13px;"><?php echo $result['tenmau']?></span> <br>
                          <span style="font-size:13px;"><?php echo $result['tenkichco']?></span>             
                    </td>
                    <td width="20%" style="color:red;font-size: 18px;font-weight: 600;"><?php
                                        if($result['giakm']!="0"){
                                            $total = $result['giakm'] * $result['soluong'];
                                            echo $fm->format_currency($total)."đ";
                                        }else{
                                            $total = $result['gia'] * $result['soluong'];
                                            echo $fm->format_currency($total)."đ";
                                        }
                                    ?></td>
                </tr>
                <?php
                            $subtotal +=$total;
                            $qty = $qty + $result['soluong'];
                                }
                            }
                            ?>
                            <?php
                                $check_cart = $ct->check_cart();
                                if($check_cart){
                                        
                                    ?>
<!--                 <tr>
                    <td colspan="2">Tạm tính</td>
                    <td><?php
                                        
                                        echo $fm->format_currency($subtotal)."đ";
                                        Session::set('sum',$subtotal);
                                        Session::set('qty',$qty);
                                    ?></td>
                </tr> -->
                <tr>
                    <td colspan="2">Tổng cộng</td>
                    <td style="color:red;font-size: 18px;font-weight: 600;"><?php                                        
                                        $grandtotal = $subtotal;
                                        echo $fm->format_currency($grandtotal)."đ";
                                    ?></td>
                </tr>
                <?php
                        }else{
                            echo '<div class="text-center" style="padding-top:15px;">Giỏ hàng của bạn trống ! Mua ngay</div>';
                        }
                       ?>
                  <tr><td colspan="2">
                    <input type="radio" class="form-check-input"  checked> Giá trên chưa bao gồm VAT và phí vận chuyển.
                      <label class="form-check-label" for="radio1"></label>
                </td></tr>     
            </table>
        </div>
        <div class="col-lg-6">
            <h4>THÔNG TIN GIAO HÀNG</h4>
            <?php
                $id = Session::get('customer_id');
                    $get_customer = $cs->show_customer($id);
                    if($get_customer){
                        while($result = $get_customer->fetch_assoc()){

                    
                    
                ?>
            <form class="mx-1 mx-md-4" method="POST"  style="padding-top:10px" >
                <div class="d-flex flex-row align-items-center mb-4">
                    <i class="bi bi-person-fill me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" name="hoten" class="form-control" placeholder="Họ tên" value="<?php echo $result['ten']?>" />
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="bi bi-phone-fill fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" name="sdt" class="form-control" placeholder="Số điện thoại" value="<?php echo $result['sdt']?>" />
                    </div>
                  </div>                  

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="bi bi-geo-alt-fill fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" name="diachi" class="form-control" placeholder="Địa chỉ" value="<?php echo $result['diachi']?>" />
                    </div>
                  </div>

                      
                   <div class="d-flex flex-row align-items-center mb-4">
                    <div class="form-check">
                      <input type="radio" class="form-check-input"  checked>Phí trên chưa bao gồm phí vận chuyển.
                      <label class="form-check-label" for="radio1"></label>
                    </div>
                  </div>
                  <?php if(isset($insertOrder)){
                    echo $insertOrder;
                  } ?>
                  <!-- <div class="d-flex mx-4 mb-3 mb-lg-4">
                    <button style="background-color: orange;" type="submit" name="redirect" class="btn btn-danger">Thanh toán qua Vnpay</button>
                  </div>  -->
                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" name="dathang" class="btn btn-danger">Đặt hàng</button>
                  </div>          

                </form>
                <?php
                    }}
                ?>
        </div>

            <?php  }else{?>
                
                <div class="col-lg-6" style="border-right: 1px solid rgba(51,51,51,0.2);">
            <h4>THÔNG TIN ĐƠN HÀNG</h4>

            <table>
                <?php
                                $get_product_cart = $ct->get_product_cart();
                                if($get_product_cart){
                                    $subtotal = 0;
                                    $qty = 0;
                                    while ($result = $get_product_cart->fetch_assoc()) {                                   
                                
                            ?>
                <tr>
                    <td width="20%" style="position:relative;">
                    <img src="admin/uploads/<?php echo $result['hinhanh']?>" alt="<?php echo $result['tensp']?>" width="100%" style="border:1px solid rgba(51,51,51,0.2);border-radius: 20px;">
                        <span style="position:absolute;top:0;right: 0;border:1px solid rgba(51,51,51,0.2);border-radius: 50%;padding: 3px 7px 3px 7px;background: rgba(153,153,153,0.9);"><?php echo $result['soluong'] ?></span>
                    </td>
                    <td width="60%" style="padding-left:10px;"><span><?php echo $result['tensp']?></span> <br>
                          <span style="font-size:13px;"><?php echo $result['tenmau']?></span>  <br>
                          <span style="font-size:13px;"><?php echo $result['tenkichco']?></span>            
                    </td>
                    <td width="20%" style="color:red;font-size: 18px;font-weight: 600;"><?php
                                        if($result['giakm']!="0"){
                                            $total = $result['giakm'] * $result['soluong'];
                                            echo $fm->format_currency($total)."đ";
                                        }else{
                                            $total = $result['gia'] * $result['soluong'];
                                            echo $fm->format_currency($total)."đ";
                                        }
                                    ?></td>
                </tr>
                <?php
                            $subtotal +=$total;
                            $qty = $qty + $result['soluong'];
                                }
                            }
                            ?>
                            <?php
                                $check_cart = $ct->check_cart();
                                if($check_cart){
                                        
                                    ?>
<!--                 <tr>
                    <td colspan="2">Tạm tính</td>
                    <td  style="color:red;font-size: 18px;font-weight: 600;"><?php
                                        
                                        echo $fm->format_currency($subtotal)."đ";
                                        Session::set('sum',$subtotal);
                                        Session::set('qty',$qty);
                                    ?></td>
                </tr> -->
                <tr>
                    <td colspan="2">Tổng cộng</td>
                    <td  style="color:red;font-size: 18px;font-weight: 600;"><?php                                        
                                        $grandtotal = $subtotal;
                                        echo $fm->format_currency($grandtotal)."đ";
                                    ?></td>
                </tr>
                <?php
                        }else{
                            echo '<div class="text-center" style="padding-top:15px;">Giỏ hàng của bạn trống ! Mua ngay</div>';
                        }
                       ?>
                <tr><td colspan="2">
                    <input type="radio" class="form-check-input"  checked> Giá trên chưa bao gồm VAT và phí vận chuyển.
                      <label class="form-check-label" for="radio1"></label>
                </td></tr>
            </table>
        </div>
        <div class="col-lg-6">
            <h4>THÔNG TIN GIAO HÀNG</h4>
            <form class="mx-1 mx-md-4" method="POST"  style="padding-top:10px">
                <div class="d-flex flex-row align-items-center mb-4">
                    <i class="bi bi-person-fill me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" name="hoten" class="form-control" placeholder="Họ tên" value="<?php if(isset($_POST['hoten'])){
                        echo $_POST['ten'];
                      } ?>"/>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="bi bi-phone-fill fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" name="sdt" class="form-control" placeholder="Số điện thoại" value="<?php if(isset($_POST['sdt'])){
                        echo $_POST['sdt'];
                      } ?>"/>
                    </div>
                  </div>                  

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="bi bi-geo-alt-fill fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" name="diachi" class="form-control" placeholder="Địa chỉ" value="<?php if(isset($_POST['diachi'])){
                        echo $_POST['diachi'];
                      } ?>"/>
                    </div>
                  </div>
                      
                           
                  <?php if(isset($insertOrder)){
                    echo $insertOrder;
                  } ?>

                  <!-- <div class="d-flex mx-4 mb-3 mb-lg-4">
                    <button style="background-color: orange;" type="submit" name="redirect"  class="btn btn-danger">Thanh toán qua Vnpay</button>
                  </div>  -->
                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" name="dathang" class="btn btn-danger">Đặt hàng</button>
                  </div>
                </form>
                
        </div>

            <?php  }

         ?>
        
    </div>
</div>
 <?php
	include 'include/footer.php';
	
?>