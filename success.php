<?php
    $title='Hỗ Trợ Sinh Viên - Cảm ơn';
    $description = 'Cảm ơn';
    $keywords = 'Cảm ơn';
    $duongdan='/cam-on-quy-khach';
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
<style>
	
</style>
<div class="container" style="padding:30px;">
    <div class="row">
        <div class="col-lg-12">
            <?php

            $login_check = Session::get('customer_login');
            if($login_check==true){ ?>

            <p class="h4 text-center" style="color:green;">Đặt hàng thành công</p>
            <?php
                $id = Session::get('customer_id');
                $get_amount = $ct->getAmountPrice($id);
                if($get_amount){
                    $amount = 0;
                    while($result = $get_amount->fetch_assoc()){
                        $price = $result['gia'];
                        $amount += $price;

                }}
            ?>
           <p class="total">Tổng tiền : <?php 
                                $total = $amount;
                                echo $fm->format_currency($total).'đ';
           ?></p>
           <p class="total">Cảm ơn đã đặt hàng tại Ứng Dụng ! Xem chi tiết đặt hàng tại đây <a href="chi-tiet-dat-hang" title="Click here">Click here</a></p>   

           <?php }else{?>

            <p class="h4 text-center" style="color:green;">Đặt hàng thành công</p>
            <?php
                $get_amount = $ct->getAmountPrice1();
                if($get_amount){
                    $amount = 0;
                    while($result = $get_amount->fetch_assoc()){
                        $price = $result['gia'];
                        $amount += $price;

                }}
            ?>
           <p class="total">Tổng tiền : <?php 
                                $total = $amount;
                                echo $fm->format_currency($total).'đ';
           ?></p>
           <p class="total">Cảm ơn đã đặt hàng tại Ứng Dụng ! Xem chi tiết đặt hàng tại đây <a href="chi-tiet-dat-hang" title="Click here">Click here</a></p>

            <?php
                }
            ?>

        

        </div>
    </div>
</div>
 <?php
	include 'include/footer.php';
	
?>