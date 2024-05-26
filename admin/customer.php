<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../classes/customer.php');
    include_once ($filepath.'/../helpers/format.php');
?>
<?php
if(!isset($_GET['customerid']) || $_GET['customerid']==NULL){
    echo "<script>window.location ='inbox.php'</script>";
   
}else{
    $id=$_GET['customerid'];
}

     $cs=new customer();
    
?>
<?php 
                    $cauhinh = $blog->show_cauhinh();
                    if($cauhinh){
                        while($result = $cauhinh->fetch_assoc()){

                    
                ?>
<style type="text/css">
    .navigation ul li:nth-child(8){
         background-color: #fff;
}

    .navigation ul li:nth-child(8) a{
         color: <?php echo $result['background']?>;
}

    .navigation ul li:nth-child(8) a::before{
      content: '';
      position: absolute;
      right: 0;
      top: -50px;
      width: 50px;
      height: 50px;
      background: transparent;
      border-radius: 50%;
      box-shadow: 35px 35px 0 10px var(--white);
      pointer-events: none;
    }
    .navigation ul li:nth-child(8) a::after{
      content: '';
      position: absolute;
      right: 0;
      bottom: -50px;
      width: 50px;
      height: 50px;
      background: transparent;
      border-radius: 50%;
      box-shadow: 35px -35px 0 10px var(--white);
      pointer-events: none;
    }
</style>
<?php }} ?>
<div class="details">
            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>Danh sách khách hàng</h2>
                </div>
            <?php
                    $get_customer =$cs->show_customer($id);
                    if($get_customer){
                        while ($result=$get_customer->fetch_assoc()) {
                            
                        
                    
                ?>
                 <form action="" method="post">
                    <table id="example" class="table table-hover" style="width:100%">                    
                        <tr>
                            <td>Tên</td>
                            <td>:</td>
                            <td>
                                <input type="text" value="<?php echo $result['ten']?>" name="tenkh" class="medium" />
                            </td>
                        </tr>
                         <tr>
                            <td>SĐT</td>
                            <td>:</td>
                            <td>
                                <input type="text" value="<?php echo $result['sdt']?>" name="sdt" class="medium" />
                            </td>
                        </tr>
                         <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>
                                <input type="text" value="<?php echo $result['email']?>" name="email" class="medium" />
                            </td>
                        </tr>
                         <tr>
                            <td>Địa chỉ</td>
                            <td>:</td>
                            <td>
                                <input type="text" value="<?php echo $result['diachi']?>" name="diachi" class="medium" />
                            </td>
                        </tr>
                        

                        
                    </table>
                    </form>
<?php
    }
}
?>
            </div>
        </div>                 
<?php include 'inc/footer.php';?>