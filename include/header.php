<?php
   include 'lib/session.php';
   Session::init();
   ?>
<?php
   include_once 'lib/database.php';
   include_once 'helpers/format.php';
   include_once 'mail/sendmail.php';
   
   spl_autoload_register(function($className){
       include_once "classes/".$className.".php";
   });
   $send = new sendmail();  
   $brand = new brand();
   $post = new post();
   $blog = new blog();   
   $db = new database();
   $fm = new Format();
   $ct = new cart();
   $us = new user();
   $cat = new category();
   $cs = new customer();
   $product = new product();
   ?>
<?php
   header("Cache-Control: no-cache, must-revalidate");
   header("Pragma: no-cache"); 
   header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
   header("Cache-Control: max-age=2592000");
   ?>
<!DOCTYPE HTML>
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" class="mdl-js">
   <head>
      <title><?php echo $title; ?></title>
      <meta name="title" content="<?php echo $title; ?>">
      <meta name="description" content="<?php echo $description; ?>">
      <meta name="keywords" content="<?php echo $keywords; ?>">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
      <meta name="robots" content="index, follow">
      <link rel="canonical" href="http://localhost/doanhotrosv<?php echo $duongdan; ?>">
      <meta name="geo.region" content="VN-HN" />
      <meta name="geo.placename" content="Ha Noi" />
      <meta name="geo.position" content="21.0278,105.8342" />
      <meta name="ICBM" content="21.0278,105.8342"/>
      <!-- dublin core -->
      <link rel="schema.DC" href="http://purl.org/dc/elements/1.1/">
      <meta name="DC.title" content="<?php echo $title; ?>">
      <meta name="DC.identifier" content="http://localhost/doanhotrosv<?php echo $duongdan; ?>">
      <meta name="DC.description" content="<?php echo $description; ?>">
      <meta name="DC.subject" content="<?php echo $title; ?>">
      <meta name="DC.language" scheme="UTF-8" content="vi">
      <meta itemprop="name" content="<?php echo $title; ?>">
      <meta itemprop="description" content="<?php echo $description; ?>">
      <meta itemprop="image" content="http://localhost/doanhotrosv/<?php echo $image; ?>">
      <meta property="og:locale" content="vi_VN">
      <meta property="og:url" content="http://localhost/doanhotrosv<?php echo $duongdan; ?>">
      <meta property="og:type" content="article">
      <meta property="og:title" content="<?php echo $title; ?>">
      <meta property="og:description" content="<?php echo $description; ?>">
      <meta property="og:image" content="http://localhost/doanhotrosv/<?php echo $image; ?>">
      <meta property="og:site_name" content="http://localhost/doanhotrosv">
      <meta name="twitter:card" content="<?php echo $title; ?>">
      <meta name="twitter:site" content="<?php echo $title; ?>">
      <meta name="twitter:title" content="<?php echo $title; ?>">
      <meta name="twitter:description" content="<?php echo $description; ?>">
      <meta name="twitter:creator" content="<?php echo $title; ?>">
      <?php 
         $blog = new blog();
         $cauhinh = $blog->show_cauhinh();
         if($cauhinh){
             while($result = $cauhinh->fetch_assoc()){
         
         
         ?>
      <link rel="icon" type="image/x-icon" href="admin/uploads/<?php echo $result['logo']?>">
      <?php }} ?>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link href="http://localhost/doanhotrosv/css/style.css?v=1.1" rel="stylesheet" type="text/css"/>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
      <script src="http://localhost/doanhotrosv/js/sweetalert.min.js"></script>
      <script src="http://localhost/doanhotrosv/js/script.js?v=1.2" type="text/javascript"></script>
      <base href="http://localhost/doanhotrosv/">
      <?php 
         $blog = new blog();
         $cauhinh = $blog->show_cauhinh();
         if($cauhinh){
             while($result = $cauhinh->fetch_assoc()){
         $homepageSchema = [
         "@context" => "http://schema.org",
         "@type" => "Organization",
         "name" => $result['tieude'],
         "url" => "http://localhost/doanhotrosv/",
         "logo" => "http://localhost/doanhotrosv/admin/uploads/".$result['logo'],
         "sameAs" => [
         "https://www.facebook.com/DucTruong23"
         ]
         ];
         
         
         $homepageSchemaJson = json_encode($homepageSchema, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                       
         
         // Tạo một mảng các câu hỏi và câu trả lời
         $faqs = array(
         array(
         'question' => 'Nơi các bạn có thể tìm được các mẫu thời trang nam đa dạng, mới mẻ?',
         'answer' => 'Truy cập ngay http://localhost/doanhotrosv/'
         ),
         
         );
         
         // Chuyển đổi mảng thành chuỗi JSON
         $schema = array(
         '@context' => 'https://schema.org',
         '@type' => 'FAQPage',
         'mainEntity' => array()
         );
         
         foreach ($faqs as $faq) {
         $question = $faq['question'];
         $answer = $faq['answer'];
         
         $schema['mainEntity'][] = array(
         '@type' => 'Question',
         'name' => $question,
         'acceptedAnswer' => array(
         '@type' => 'Answer',
         'text' => $answer
         )
         );
         }
         
         $json = json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
         
         }}
         ?>
      <script type="application/ld+json">
         <?php echo $json; ?>
      </script>
      <script type="application/ld+json">
         <?php echo $homepageSchemaJson; ?>
      </script>
   </head>
   <body>
      <div class="container-fluid" id="scroll-nav">
         <div class="row">
            <div class="col-2">
               <p class="h3 text-center canphaian" style="padding-top:10px;"><a href="http://localhost/doanhotrosv/" title="Trang chủ" style="text-decoration:none;color: black;"><img src="images/logo.jpg" width="15%" alt="Logo"></a></p>
            </div>
            <div class="col-8">
               <div class="nav1">
                  <ul class="menu">
                     <li><a href="http://localhost/doanhotrosv/" title="Trang chủ"><i class="bi bi-house-door"></i> TRANG CHỦ</a></li>
                     <li>
                        <!-- First Tier Drop Down -->
                        <a href="cac-danh-muc" title="Danh mục">DANH MỤC</a>
                        <ul class="ul12">
                           <?php
                              $cate = $cat -> show_category();
                              if($cate){
                                  while ($result_new = $cate->fetch_assoc()) {
                              
                              ?>
                           <li><a href="<?php echo $result_new['url']?>" title="<?php echo $result_new['tendm']?>"><?php echo $result_new['tendm']?></a></li>
                           <?php
                              }
                               }
                              ?>
                        </ul>
                     </li>
                     <li>
                        <!-- First Tier Drop Down -->
                        <a href="cac-thuong-hieu" title="Thương hiệu">THƯƠNG HIỆU</a>
                        <ul class="ul12">
                           <?php
                              $result = $brand -> show_brand();
                              if($result){
                                  while ($result_new = $result->fetch_assoc()) {                                    
                              
                              ?>
                           <li><a href="thuong-hieu-<?php echo $result_new['url']?>" title="<?php echo $result_new['tenth']?>"><?php echo $result_new['tenth']?></a></li>
                           <?php
                              }
                                  }
                              ?>
                        </ul>
                     </li>
                     <li>
                        <!-- First Tier Drop Down -->
                        <a href="danh-muc-tin-tuc" title="Tin tức">TIN TỨC</a>
                        <ul class="ul12">
                           <?php
                              $result = $post -> show_post_cat();
                              if($result){
                                  while ($result_new = $result->fetch_assoc()) {                                    
                              
                              ?>
                           <li><a href="<?php echo $result_new['url']?>" title="<?php echo $result_new['tendm']?>"><?php echo $result_new['tendm']?></a></li>
                           <?php
                              }
                                  }
                              ?>                      
                        </ul>
                     </li>
                     <li><a href="danh-muc-club" title="CLB">CLB</a></li>
                     <?php
                        $login_check = Session::get('customer_login');
                        if($login_check==true){
                            $customer_id = Session::get('customer_id');
                            $check_order1 = $ct->check_order1($customer_id);
                            if($check_order1){
                                echo '<li><a href="chi-tiet-dat-hang" title="Hàng đã đặt"><i class="bi bi-cart"></i> HÀNG ĐÃ ĐẶT</a></li> ';
                            }else{
                                echo ' ';
                            }
                        
                        }else{
                            $check_order = $ct->check_order();
                            if($check_order){
                                echo '<li><a href="chi-tiet-dat-hang" title="Hàng đã đặt"><i class="bi bi-cart"></i> HÀNG ĐÃ ĐẶT</a></li> ';
                            }else{
                                echo ' ';
                            }
                        }
                                                
                          ?>              
                     <li><a href="lien-he" title="Liên hệ"><i class="bi bi-telephone"></i> LIÊN HỆ</a></li>
                  </ul>
               </div>
            </div>
            <div class="col-2" style="display:flex;">
               <?php
                  if(isset($_GET['customer_id'])){
                      $customer_id = $_GET['customer_id'];
                      $delCart = $ct->del_all_data_cart();
                  
                      Session::destroy();
                      
                  }
                  ?>
               <?php
                  ob_start();
                  $name = Session::get('customer_name');
                  $login_check = Session::get('customer_login');
                  $loginfb=Session::get('login_facebook');
                  $logingg=Session::get('login_google');
                  if($login_check==false){
                      echo '<a href="dang-nhap" title="Đăng nhập" class="canphaian" style="text-decoration: none;color: black;padding: 10px 0 0 10px;"><i class="bi bi-person"></i> Đăng nhập</a>';
                      
                  }else{
                      ?>
               <div class="taikhoan">
                  <div class="dropdown">
                     <?php
                        $id = Session::get('customer_id');
                            $get_customer = $cs->show_customer($id);
                            if($get_customer){
                                while($result = $get_customer->fetch_assoc()){
                        
                            
                            
                        ?>
                     <button onclick="myFunction()" class="dropbtn"><span class="thanhvien"><?php echo $result['ten'] ?> <?php if($loginfb==true){?>
                     <img src="<?php echo $_SESSION['userData']['picture']['url'] ?>" style="width: 23px;height: 23px;border-radius: 50%;">
                     <?php }elseif($logingg==true){
                        ?>
                     <img src="<?php echo $_SESSION['google_image']; ?>" style="width: 23px;height: 23px;border-radius: 50%;">
                     <?php
                        }else{
                           echo '<i class="bi bi-person"></i>';
                         } ?></button>
                     <?php }} ?>                         
                     <div id="myDropdown" class="dropdown-content">
                        <a href="thong-tin-thanh-vien" title="Thông tin"><i class="bi bi-info-circle"></i> Thông tin</a>
                        <a href="lich-su-thanh-vien" title="Lịch sử"><i class="bi bi-hourglass"></i> Lịch sử</a>
                        <a href="?customer_id=<?php echo Session::get('customer_id') ?>" title="Đăng xuất"><i class="bi bi-box-arrow-right"></i> Đăng xuất</a>
                     </div>
                  </div>
               </div>
               <?php
                  }
                  
                  ?>
               <a href="gio-hang" title="Giỏ hàng" class="canphaian" style="text-decoration: none;color: black;padding: 10px 0 0 10px;"><i class="bi bi-cart"><span class="cart-item"><?php
                  $login_check = Session::get('customer_login');
                  if($login_check==true){
                      $customer_id = Session::get('customer_id');
                      $check_cart1 = $ct->check_cart1($customer_id);
                              if($check_cart1){
                                  $count1= mysqli_num_rows($check_cart1);
                                  echo $count1;
                              }else{
                                  echo '0';
                              }
                  
                  }else{                           
                      $check_cart = $ct->check_cart();
                              if($check_cart){
                                  $count= mysqli_num_rows($check_cart);
                                  echo $count;
                              }else{
                                  echo '0';
                              }
                  
                  }                                   
                              ?></span></i> Giỏ hàng</a>
            </div>
         </div>
      </div>
      <div class="container-fluid">
         <div class="row">
            <div class="col-12 center-block bg-dark" style="z-index: 40;">
               <p class="text-white text-center" style="font-size:12px;padding: 10px 0 0 0;">Dịch vụ hỗ trợ sinh viên</p>
            </div>
         </div>
      </div>
      <div class="container-fluid ">
         <div class="row main-header">
            <div class="col-4 search-field">
               <div class="search-container">
                  <form action="tim-kiem-san-pham" method="post">   
                     <input type="text" name="tukhoa" placeholder="Tìm kiếm" name="search">
                     <button type="submit" name="search"><i class="bi bi-search"></i></button>
                  </form>
               </div>
            </div>
            <div class="col-4">
               <p class="h3 text-center"><a href="http://localhost/doanhotrosv/" title="Trang chủ" style="text-decoration:none;color: black;"><img src="images/logo.jpg" width="15%" alt="Logo"></a></p>
            </div>
            <div class="col-4 right-head">
               <?php
                  if(isset($_GET['customer_id'])){
                      $customer_id = $_GET['customer_id'];
                      $delCart = $ct->del_all_data_cart();
                  }
                  ?>
               <?php
                  ob_start();
                  $name = Session::get('customer_name');
                  $login_check = Session::get('customer_login');
                  $loginfb=Session::get('login_facebook');
                  $logingg=Session::get('login_google');
                  if($login_check==false){
                  
                      echo '<a href="dang-nhap" title="Đăng nhập"><p class="dangnhapne"><i class="bi bi-box-arrow-left"></i> Đăng nhập</p></a>';  
                  }else{
                      ?>
               <div class="taikhoan">
                  <div class="dropdown">
                     <?php
                        $id = Session::get('customer_id');
                            $get_customer = $cs->show_customer($id);
                            if($get_customer){
                                while($result = $get_customer->fetch_assoc()){
                        
                            
                            
                        ?>
                     <button onclick="myFunction1()" class="dropbtn1"><span class="thanhvien"><?php echo $result['ten'] ?> <?php if($loginfb==true){?>
                     <img src="<?php echo $_SESSION['userData']['picture']['url'] ?>" style="width: 23px;height: 23px;border-radius: 50%;">
                     <?php }elseif($logingg==true){
                        ?>
                     <img src="<?php echo $_SESSION['google_image']; ?>" style="width: 23px;height: 23px;border-radius: 50%;">
                     <?php
                        }else{
                           echo '<i class="bi bi-person"></i>';
                         } ?></button>
                     <?php }} ?>                         
                     <div id="myDropdown1" class="dropdown-content1">
                        <a href="thong-tin-thanh-vien" title="Thông tin"><i class="bi bi-info-circle"></i> Thông tin</a>
                        <a href="lich-su-thanh-vien" title="Lịch sử"><i class="bi bi-hourglass"></i> Lịch sử</a>
                        <a href="?customer_id=<?php echo Session::get('customer_id') ?>" title="Đăng xuất"><i class="bi bi-box-arrow-right"></i> Đăng xuất</a>
                     </div>
                  </div>
               </div>
               <?php    
                  }
                  
                  ?>
               <a href="gio-hang" title="Giỏ hàng">
                  <p class="giohangne"><i class="bi bi-cart"><span class="cart-item"><?php
                     $login_check = Session::get('customer_login');
                     if($login_check==true){
                         $customer_id = Session::get('customer_id');
                         $check_cart1 = $ct->check_cart1($customer_id);
                                 if($check_cart1){
                                     $count1= mysqli_num_rows($check_cart1);
                                     $qty = Session::get("qty");
                     
                                     echo $count1;
                                 }else{
                                     echo '0';
                                 }
                     
                     }else{
                         
                         $check_cart = $ct->check_cart();
                                 if($check_cart){
                                     $count= mysqli_num_rows($check_cart);
                                     $qty = Session::get("qty");
                                     echo $count;
                                 }else{
                                     echo '0';
                                 }
                     
                     }
                                 
                                 ?></span></i> Giỏ hàng</p>
               </a>
            </div>
            <div class="col-12">
               <nav  id="navbar">
                  <div style="display:flex;position: relative;">
                     <?php
                        $id = Session::get('customer_id');
                            $get_customer = $cs->show_customer($id);
                            if($get_customer){
                                while($result = $get_customer->fetch_assoc()){
                        
                            
                            
                        ?>
                     <button onclick="myFunction2()" class="dropbtn2"><span class="thanhvien"><?php if($loginfb==true){?>
                     <img src="<?php echo $_SESSION['userData']['picture']['url'] ?>" style="width: 23px;height: 23px;border-radius: 50%;">
                     <?php }elseif($logingg==true){
                        ?>
                     <img src="<?php echo $_SESSION['google_image']; ?>" style="width: 23px;height: 23px;border-radius: 50%;">
                     <?php
                        }else{
                           echo '<i class="bi bi-person"></i>';
                         } ?></button>
                     <?php }} ?> 
                     <?php
                        ob_start();
                        $name = Session::get('customer_name');
                        $login_check = Session::get('customer_login');
                        if($login_check==false){
                            echo '<a href="dang-nhap" title="Đăng nhập" class="res-login"><p class="dangnhapne"><i class="bi bi-box-arrow-left"></i> ĐĂNG NHẬP</p></a>';
                            
                        }else{?>
                     <div class="dropnew">
                        <div class="dropdown">
                           <div id="myDropdown2" class="dropdown-content2">
                              <a href="thong-tin-thanh-vien" title="Thông tin"><i class="bi bi-info-circle"></i> Thông tin</a>
                              <a href="lich-su-dat-hang" title="Lịch sử"><i class="bi bi-hourglass"></i> Lịch sử</a>
                              <a href="?customer_id=<?php echo Session::get('customer_id') ?>" title="Đăng xuất"><i class="bi bi-box-arrow-right"></i> Đăng xuất</a>
                           </div>
                        </div>
                     </div>
                     <?php
                        }
                        
                        ?>
                     <?php $login_check = Session::get('customer_login');
                        if($login_check==true){ ?>
                     <a href="gio-hang" title="Giỏ hàng" class="res-cart" style="right:55px;
                        position:absolute;
                        padding-top: 15px;">
                        <p class="giohangne"><i class="bi bi-cart"><span class="cart-item"><?php
                           $login_check = Session::get('customer_login');
                           if($login_check==true){
                               $customer_id = Session::get('customer_id');
                               $check_cart1 = $ct->check_cart1($customer_id);
                                       if($check_cart1){
                                           $count1= mysqli_num_rows($check_cart1);
                                           echo $count1;
                                       }else{
                                           echo '0';
                                       }
                           
                           }else{                           
                               $check_cart = $ct->check_cart();
                                       if($check_cart){
                                           $count= mysqli_num_rows($check_cart);
                                           echo $count;
                                       }else{
                                           echo '0';
                                       }
                           
                           }                                   
                                       ?></span></i></p>
                     </a>
                     <?php }else{
                        ?>
                     <a href="gio-hang" title="Giỏ hàng" class="res-cart" style="right:145px;
                        position:absolute;
                        padding-top: 15px;">
                        <p class="giohangne"><i class="bi bi-cart"><span class="cart-item"><?php
                           $login_check = Session::get('customer_login');
                           if($login_check==true){
                               $customer_id = Session::get('customer_id');
                               $check_cart1 = $ct->check_cart1($customer_id);
                                       if($check_cart1){
                                           $count1= mysqli_num_rows($check_cart1);
                                           echo $count1;
                                       }else{
                                           echo '0';
                                       }
                           
                           }else{                           
                               $check_cart = $ct->check_cart();
                                       if($check_cart){
                                           $count= mysqli_num_rows($check_cart);
                                           echo $count;
                                       }else{
                                           echo '0';
                                       }
                           
                           }                                   
                                       ?></span></i></p>
                     </a>
                     <?php } ?>
                     <label for="drop" class="toggle"><i id="icon" class="fa fa-bars"></i></label>
                     <div class="khuvuctimkiem">
                        <div class="opensearch" tabindex="0" >
                           <span onclick="showBar()"><i class="bi bi-search" style="color:black;"></i>                    
                           </span>
                           <div id="form-timkiem" class="form-timkiem">
                              <form style="display:flex;" action="tim-kiem" method="post">
                                 <input type="text" name="tukhoa" placeholder="Tìm kiếm...">
                                 <button type="submit" name="search"><i class="bi bi-search" style="color:black;"></i></button>
                                 <span class="dongtimkiem" onclick="hideBar()"><i class="bi bi-x-lg"></i></span>                         
                              </form>
                           </div>
                        </div>
                     </div>
                     <?php
                        if(isset($_GET['customer_id'])){
                            $customer_id = $_GET['customer_id'];
                            $delCart = $ct->del_all_data_cart();
                            Session::destroy();
                            
                        }
                        ?>
                  </div>
                  <input type="checkbox" id="drop" />
                  <ul class="menu">
                     <li><a href="http://localhost/doanhotrosv/" title="Trang chủ"> TRANG CHỦ</a></li>
                     <li>
                        <div style="display:flex;">
                           <a class="menu-mobile" href="cac-danh-muc" title="Danh mục">DANH MỤC</a>
                           <label for="drop-1" class="toggle"><i class="bi bi-chevron-down"></i></label>
                        </div>
                        <a class="menu-pc" href="cac-danh-muc" title="Danh mục">DANH MỤC </a>
                        <input type="checkbox" id="drop-1"/>
                        <ul class="ul12">
                           <?php
                              $cate = $cat -> show_category();
                              if($cate){
                                  while ($result_new = $cate->fetch_assoc()) {
                              
                              ?>
                           <li><a href="<?php echo $result_new['url']?>" title="<?php echo $result_new['tendm']?>"><?php echo $result_new['tendm']?></a></li>
                           <?php
                              }
                               }
                              ?>
                        </ul>
                     </li>
                     <li>
                        <div style="display:flex;">
                           <a class="menu-mobile" href="cac-thuong-hieu" title="Thương hiệu">THƯƠNG HIỆU</a>
                           <label for="drop-2" class="toggle"><i class="bi bi-chevron-down"></i></label>
                        </div>
                        <a class="menu-pc" href="cac-thuong-hieu" title="Thương hiệu">THƯƠNG HIỆU </a>
                        <input type="checkbox" id="drop-2"/>
                        <ul class="ul12">
                           <?php
                              $result = $brand -> show_brand();
                              if($result){
                                  while ($result_new = $result->fetch_assoc()) {                                    
                              
                              ?>
                           <li><a href="thuong-hieu-<?php echo $result_new['url']?>" title="<?php echo $result_new['tenth']?>"><?php echo $result_new['tenth']?></a></li>
                           <?php
                              }
                                  }
                              ?>                      
                        </ul>
                     </li>
                     <li>
                        <!-- First Tier Drop Down -->
                        <div style="display:flex;">
                           <a class="menu-mobile" href="danh-muc-tin-tuc" title="Tin tức">TIN TỨC</a>
                           <label for="drop-3" class="toggle"><i class="bi bi-chevron-down"></i></label>
                        </div>
                        <a class="menu-pc" href="danh-muc-tin-tuc" title="Tin tức">TIN TỨC </a>
                        <input type="checkbox" id="drop-3"/>
                        <ul class="ul12">
                           <?php
                              $result = $post -> show_post_cat();
                              if($result){
                                  while ($result_new = $result->fetch_assoc()) {                                    
                              
                              ?>
                           <li><a href="<?php echo $result_new['url']?>" title="<?php echo $result_new['tendm']?>"><?php echo $result_new['tendm']?></a></li>
                           <?php
                              }
                                  }
                              ?>                      
                        </ul>
                     </li>
                     <li><a href="danh-muc-club" title="CLB">CLB</a></li>
                     <?php
                        $login_check = Session::get('customer_login');
                        if($login_check==true){
                            $customer_id = Session::get('customer_id');
                            $check_order1 = $ct->check_order1($customer_id);
                            if($check_order1){
                                echo '<li><a href="chi-tiet-dat-hang" title="Hàng đã đặt"><i class="bi bi-cart"></i> HÀNG ĐÃ ĐẶT</a></li> ';
                            }else{
                                echo ' ';
                            }
                        
                        }else{
                            $check_order = $ct->check_order();
                            if($check_order){
                                echo '<li><a href="chi-tiet-dat-hang" title="Hàng đã đặt"><i class="bi bi-cart"></i> HÀNG ĐÃ ĐẶT</a></li> ';
                            }else{
                                echo ' ';
                            }
                        }
                                                
                          ?>               
                     <li><a href="lien-he" title="Liên hệ"> LIÊN HỆ</a></li>
                  </ul>
               </nav>
            </div>
         </div>
      </div>