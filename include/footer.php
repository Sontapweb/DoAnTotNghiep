<?php 
    if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['lienhedaily'])){
        $status = 0;
        $ten    = $_POST['ten'];
        $email  = 'No Email';
        $sdt    = $_POST['sdt'];
        $chude  = 'Muốn trở thành đại lý.';
        
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
    } ?>

<style type="text/css">
      h1,
        h2,
        h3,
        h4,
        h5,
        h6 {}
        a,
        a:hover,
        a:focus,
        a:active {
            text-decoration: none;
            outline: none;
        }
        
        a,
        a:active,
        a:focus {
            color: #333;
            text-decoration: none;
            transition-timing-function: ease-in-out;
            -ms-transition-timing-function: ease-in-out;
            -moz-transition-timing-function: ease-in-out;
            -webkit-transition-timing-function: ease-in-out;
            -o-transition-timing-function: ease-in-out;
            transition-duration: .2s;
            -ms-transition-duration: .2s;
            -moz-transition-duration: .2s;
            -webkit-transition-duration: .2s;
            -o-transition-duration: .2s;
        }
        
        ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        img {
    max-width: 100%;
    height: auto;
}
        section {
            padding: 60px 0;
           /* min-height: 100vh;*/
        }
.footer {
    background: linear-gradient(105deg,#6e99e6 ,#093c94);
    padding-top: 80px;
    padding-bottom: 40px;
}
/*END FOOTER SOCIAL DESIGN*/
.single_footer{}
@media only screen and (max-width:768px) { 
.single_footer{margin-bottom:30px;}
}
.single_footer h4 {
    color: #fff;
    margin-top: 0;
    margin-bottom: 25px;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 20px;
}
.single_footer h4::after {
    content: "";
    display: block;
    height: 2px;
    width: 40px;
    background: #fff;
    margin-top: 20px;
}
.single_footer p{color:#fff;}
.single_footer ul {
    margin: 0;
    padding: 0;
    list-style: none;
}
.single_footer ul li{}
.single_footer ul li a {
    color: #fff;
    -webkit-transition: all 0.3s ease 0s;
    transition: all 0.3s ease 0s;
    line-height: 36px;
    font-size: 15px;
    text-transform: capitalize;
}
.single_footer ul li a:hover { color: #ff3666; }

.single_footer_address{}
.single_footer_address ul{}
.single_footer_address ul li{color:#fff;}
.single_footer_address ul li span {
    font-weight: 400;
    color: #fff;
    line-height: 28px;
}
.contact_social ul {
    list-style: outside none none;
    margin: 0;
    padding: 0;
}

/*START NEWSLETTER CSS*/
.subscribe {
    display: block;
    position: relative;
    margin-top: 15px;
    width: 100%;
}
.subscribe__input {
background-color: #fff;
border: medium none;
border-radius: 5px;
color: #333;
display: block;
font-size: 15px;
font-weight: 500;
margin-bottom: 5px;
height: 60px;
letter-spacing: 0.4px;
padding: 0 150px 0 20px;

text-transform: capitalize;
width: 100%;
}
@media only screen and (max-width:768px) { 
.subscribe__input{padding: 0 50px 0 20px;}
}

.subscribe__btn {
background-color: transparent;
border-radius: 5px;
color: #fff;
cursor: pointer;
display: block;
font-size: 20px;
height: 45px;
border: 1px solid #fff;
width: 150px;
margin-top: 10px;
}
.sendnow{
    color: #fff;
}
.sendnow:hover{
    color: #ff3666;
}
.subscribe__btn i{transition: all 0.3s ease 0s;}
@media only screen and (max-width:768px) { 
.subscribe__btn{right:0px;}
}

.subscribe__btn:hover i{
    color:#ff3666;
}
button {
    padding: 0;
    border: none;
    background-color: transparent;
    -webkit-border-radius: 0;
    border-radius: 0;
}
/*END NEWSLETTER CSS*/

/*START SOCIAL PROFILE CSS*/
.social_profile {margin-top:40px;position: relative;}
.social_profile ul{
list-style: outside none none;
margin: 0;
padding: 0;
}
.social_profile ul li{float:left;}
.social_profile ul li a {
    text-align: center;
    border: 0px;
    text-transform: uppercase;
    transition: all 0.3s ease 0s;
    margin: 0px 5px;
    font-size: 18px;
    color: #fff;
    border-radius: 30px;
    width: 50px;
    height: 50px;
    line-height: 50px;
    display: block;
    border: 1px solid rgba(255,255,255,0.2);
}

@media only screen and (max-width:1068px) { 
.col-lg-4{
    width: 50%;
    padding-top: 30px;
}
}
@media only screen and (max-width:576px) { 
.col-lg-4{
    width: 100%;
    padding-top: 20px;
}
}
@media only screen and (max-width:768px) { 
.social_profile ul li a{margin-right:10px;margin-bottom:10px;}
}
@media only screen and (max-width:480px) { 
.social_profile ul li a{
    width:40px;
    height:40px;
    line-height:40px;
}
}
.social_profile ul li a:hover{
background:#ff3666;
border: 1px solid #ff3666;
color:#fff;
border:0px;
}
/*END SOCIAL PROFILE CSS*/
.copyright {
    margin-top: 70px;
    padding-top: 40px;
    color:#fff;
    font-size: 15px;
    border-top: 1px solid rgba(255,255,255,0.4);
    text-align: center;
}
.coccoc-alo-ph-circle {
    width: 120px;
    height: 120px;
    top: 25px;
    left: 25px;
    position: absolute;
    background-color: transparent;
    -webkit-border-radius: 100%;
    -moz-border-radius: 100%;
    border-radius: 100%;
    border: 2px solid rgba(30, 30, 30, 0.4);
    opacity: .1;
    -webkit-animation: coccoc-alo-circle-anim 1.2s infinite ease-in-out;
    -moz-animation: coccoc-alo-circle-anim 1.2s infinite ease-in-out;
    -ms-animation: coccoc-alo-circle-anim 1.2s infinite ease-in-out;
    -o-animation: coccoc-alo-circle-anim 1.2s infinite ease-in-out;
    animation: coccoc-alo-circle-anim 1.2s infinite ease-in-out;
    -webkit-transition: all .5s;
    -moz-transition: all .5s;
    -o-transition: all .5s;
    transition: all .5s;
}

.coccoc-alo-phone {
    background-color: transparent;
    width: 120px;
    height: 120px;
    cursor: pointer;
    z-index: 200000 !important;
    -webkit-backface-visibility: hidden;
    -webkit-transform: translateZ(0);
    -webkit-transition: visibility .5s;
    -moz-transition: visibility .5s;
    -o-transition: visibility .5s;
    transition: visibility .5s;
    right: 100px;
    top: 30px;
}

.coccoc-alo-phone.coccoc-alo-green .coccoc-alo-ph-circle-fill {
    background-color: rgba(0, 175, 242, 0.5);
    opacity: .75 !important;
}

.coccoc-alo-ph-circle-fill {
    width: 70px;
    height: 70px;
    top: 50px;
    left: 50px;
    position: absolute;
    background-color: #000;
    -webkit-border-radius: 100%;
    -moz-border-radius: 100%;
    border-radius: 100%;
    border: 2px solid transparent;
    opacity: .1;
    -webkit-animation: coccoc-alo-circle-fill-anim 2.3s infinite ease-in-out;
    -moz-animation: coccoc-alo-circle-fill-anim 2.3s infinite ease-in-out;
    -ms-animation: coccoc-alo-circle-fill-anim 2.3s infinite ease-in-out;
    -o-animation: coccoc-alo-circle-fill-anim 2.3s infinite ease-in-out;
    animation: coccoc-alo-circle-fill-anim 2.3s infinite ease-in-out;
    -webkit-transition: all .5s;
    -moz-transition: all .5s;
    -o-transition: all .5s;
    transition: all .5s;
}

.coccoc-alo-ph-img-circle {
    width: 42px;
    height: 42px;
    top: 64px;
    left: 64px;
    position: absolute;
    background: rgba(30, 30, 30, 0.1) url('images/zaloicon.webp') no-repeat center center;
    -webkit-border-radius: 100%;
    -moz-border-radius: 100%;
    border-radius: 100%;
    border: 2px solid transparent;
    opacity: .7;
    -webkit-animation: coccoc-alo-circle-img-anim 1s infinite ease-in-out;
    -moz-animation: coccoc-alo-circle-img-anim 1s infinite ease-in-out;
    -ms-animation: coccoc-alo-circle-img-anim 1s infinite ease-in-out;
    -o-animation: coccoc-alo-circle-img-anim 1s infinite ease-in-out;
    animation: coccoc-alo-circle-img-anim 1s infinite ease-in-out;
}

.coccoc-alo-phone.coccoc-alo-green .coccoc-alo-ph-img-circle {
    background-color: #00aff2;
}

.coccoc-alo-phone.coccoc-alo-green .coccoc-alo-ph-circle {
    border-color: #00aff2;
    opacity: .5;
}

.coccoc-alo-phone.coccoc-alo-green.coccoc-alo-hover .coccoc-alo-ph-circle,
.coccoc-alo-phone.coccoc-alo-green:hover .coccoc-alo-ph-circle {
    border-color: #75eb50;
    opacity: .5;
}

.coccoc-alo-phone.coccoc-alo-green.coccoc-alo-hover .coccoc-alo-ph-circle-fill,
.coccoc-alo-phone.coccoc-alo-green:hover .coccoc-alo-ph-circle-fill {
    background-color: rgba(117, 235, 80, 0.5);
    opacity: .75 !important;
}

.coccoc-alo-phone.coccoc-alo-green.coccoc-alo-hover .coccoc-alo-ph-img-circle,
.coccoc-alo-phone.coccoc-alo-green:hover .coccoc-alo-ph-img-circle {
    background-color: #75eb50;
}

@-moz-keyframes coccoc-alo-circle-anim {
    0% {
        transform: rotate(0) scale(.5) skew(1deg);
        opacity: .1
    }
    30% {
        transform: rotate(0) scale(.7) skew(1deg);
        opacity: .5
    }
    100% {
        transform: rotate(0) scale(1) skew(1deg);
        opacity: .1
    }
}

@-webkit-keyframes coccoc-alo-circle-anim {
    0% {
        transform: rotate(0) scale(.5) skew(1deg);
        opacity: .1
    }
    30% {
        transform: rotate(0) scale(.7) skew(1deg);
        opacity: .5
    }
    100% {
        transform: rotate(0) scale(1) skew(1deg);
        opacity: .1
    }
}

@-o-keyframes coccoc-alo-circle-anim {
    0% {
        transform: rotate(0) scale(.5) skew(1deg);
        opacity: .1
    }
    30% {
        transform: rotate(0) scale(.7) skew(1deg);
        opacity: .5
    }
    100% {
        transform: rotate(0) scale(1) skew(1deg);
        opacity: .1
    }
}

@keyframes coccoc-alo-circle-anim {
    0% {
        transform: rotate(0) scale(.5) skew(1deg);
        opacity: .1
    }
    30% {
        transform: rotate(0) scale(.7) skew(1deg);
        opacity: .5
    }
    100% {
        transform: rotate(0) scale(1) skew(1deg);
        opacity: .1
    }
}

@-moz-keyframes coccoc-alo-circle-fill-anim {
    0% {
        transform: rotate(0) scale(.7) skew(1deg);
        opacity: .2
    }
    50% {
        transform: rotate(0) scale(1) skew(1deg);
        opacity: .2
    }
    100% {
        transform: rotate(0) scale(.7) skew(1deg);
        opacity: .2
    }
}

@-webkit-keyframes coccoc-alo-circle-fill-anim {
    0% {
        transform: rotate(0) scale(.7) skew(1deg);
        opacity: .2
    }
    50% {
        transform: rotate(0) scale(1) skew(1deg);
        opacity: .2
    }
    100% {
        transform: rotate(0) scale(.7) skew(1deg);
        opacity: .2
    }
}

@-o-keyframes coccoc-alo-circle-fill-anim {
    0% {
        transform: rotate(0) scale(.7) skew(1deg);
        opacity: .2
    }
    50% {
        transform: rotate(0) scale(1) skew(1deg);
        opacity: .2
    }
    100% {
        transform: rotate(0) scale(.7) skew(1deg);
        opacity: .2
    }
}

@keyframes coccoc-alo-circle-fill-anim {
    0% {
        transform: rotate(0) scale(.7) skew(1deg);
        opacity: .2
    }
    50% {
        transform: rotate(0) scale(1) skew(1deg);
        opacity: .2
    }
    100% {
        transform: rotate(0) scale(.7) skew(1deg);
        opacity: .2
    }
}

@-moz-keyframes coccoc-alo-circle-img-anim {
    0% {
        transform: rotate(0) scale(1) skew(1deg)
    }
    10% {
        transform: rotate(-25deg) scale(1) skew(1deg)
    }
    20% {
        transform: rotate(25deg) scale(1) skew(1deg)
    }
    30% {
        transform: rotate(-25deg) scale(1) skew(1deg)
    }
    40% {
        transform: rotate(25deg) scale(1) skew(1deg)
    }
    50% {
        transform: rotate(0) scale(1) skew(1deg)
    }
    100% {
        transform: rotate(0) scale(1) skew(1deg)
    }
}

@-webkit-keyframes coccoc-alo-circle-img-anim {
    0% {
        transform: rotate(0) scale(1) skew(1deg)
    }
    10% {
        transform: rotate(-25deg) scale(1) skew(1deg)
    }
    20% {
        transform: rotate(25deg) scale(1) skew(1deg)
    }
    30% {
        transform: rotate(-25deg) scale(1) skew(1deg)
    }
    40% {
        transform: rotate(25deg) scale(1) skew(1deg)
    }
    50% {
        transform: rotate(0) scale(1) skew(1deg)
    }
    100% {
        transform: rotate(0) scale(1) skew(1deg)
    }
}

@-o-keyframes coccoc-alo-circle-img-anim {
    0% {
        transform: rotate(0) scale(1) skew(1deg)
    }
    10% {
        transform: rotate(-25deg) scale(1) skew(1deg)
    }
    20% {
        transform: rotate(25deg) scale(1) skew(1deg)
    }
    30% {
        transform: rotate(-25deg) scale(1) skew(1deg)
    }
    40% {
        transform: rotate(25deg) scale(1) skew(1deg)
    }
    50% {
        transform: rotate(0) scale(1) skew(1deg)
    }
    100% {
        transform: rotate(0) scale(1) skew(1deg)
    }
}

@keyframes coccoc-alo-circle-img-anim {
    0% {
        transform: rotate(0) scale(1) skew(1deg)
    }
    10% {
        transform: rotate(-25deg) scale(1) skew(1deg)
    }
    20% {
        transform: rotate(25deg) scale(1) skew(1deg)
    }
    30% {
        transform: rotate(-25deg) scale(1) skew(1deg)
    }
    40% {
        transform: rotate(25deg) scale(1) skew(1deg)
    }
    50% {
        transform: rotate(0) scale(1) skew(1deg)
    }
    100% {
        transform: rotate(0) scale(1) skew(1deg)
    }
}
.copyright a{color:#01c7e9;transition: all 0.2s ease 0s;}
.copyright a:hover{color:#ff3666;}
.mangxahoi {
  display: inline-block;
  width: 100%;
  position:absolute;
  top:50%;
  left:50%;
  transform: translateX(-50%);

}

/* Icons */

.mangxahoi a {
  color:#000;
  background: #fff;
  border-radius:50%;
  text-align:center;
  text-decoration:none;
  font-family:fontawesome;
  position: relative;
  display: inline-block;
  width:40px;
  height:40px;
  padding:10px;
  margin:2px;
  -o-transition:all .5s;
  -webkit-transition: all .5s;
  -moz-transition: all .5s;
  transition: all .5s;
   -webkit-font-smoothing: antialiased;
}
.mangxahoi a:hover{
    color: #fff;
}

.fb:hover{
    background-color: #1877F2;
}
.tw:hover{
    background-color: #1DA1F2;
}
.gg:hover{
    background-color: #4285F4;
}
.yt:hover{
    background-color: #FF0000;
}
.ins:hover{
    background-color: #E4405F;
}


/* pop-up text */

.mangxahoi a span {
  color:#666;
  position:absolute;
  font-family:sans-serif;
  bottom:0;
  left:-25px;
  right:-25px;
  padding:2px 7px;
  z-index:-1;
  font-size:14px;
  border-radius:5px;
  background:#fff;
  visibility:hidden;
  opacity:0;
  -o-transition:all .5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
  -webkit-transition: all .5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
  -moz-transition: all .5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
  transition: all .5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

/* pop-up text arrow */

.mangxahoi a span:before {
  content:'';
  width: 0; 
  height: 0; 
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-top: 5px solid #fff;
  position:absolute;
  bottom:-5px;
  left:40px;
}

/* text pops up when icon is in hover state */

.mangxahoi a:hover span {
  bottom:50px;
  visibility:visible;
  opacity:1;
  color: #fff;
}
.fb:hover span{
    background-color: #1877F2;   
}
.tw:hover span{
    background-color: #1DA1F2;
}
.gg:hover span{
    background-color: #4285F4;
}
.yt:hover span{
    background-color: #FF0000;
}
.ins:hover span{
    background-color: #E4405F;
}

/* font awesome icons */

.mangxahoi a:nth-of-type(1):before {
content:'\f09a';
}
.mangxahoi a:nth-of-type(2):before {
content:'\f099';
}
.mangxahoi a:nth-of-type(3):before {
content: '\f1a0';
}
.mangxahoi a:nth-of-type(4):before {
content:'\f167';
}
.mangxahoi a:nth-of-type(5):before {
content:'\f16d';
}
.glow-on-hover {
    width: 150px;
    height: 40px;
    border: none;
    outline: none;
    color: #fff;
    background: #111;
    cursor: pointer;
    position: relative;
    z-index: 0;
    border-radius: 10px;
}

.glow-on-hover:before {
    content: '';
    background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #7a00ff, #ff00c8, #ff0000);
    position: absolute;
    top: -2px;
    left:-2px;
    background-size: 400%;
    z-index: -1;
    filter: blur(5px);
    width: calc(100% + 4px);
    height: calc(100% + 4px);
    animation: glowing 20s linear infinite;
    opacity: 0;
    transition: opacity .3s ease-in-out;
    border-radius: 10px;
}

.glow-on-hover:active {
    color: #000
}

.glow-on-hover:active:after {
    background: transparent;
}

.glow-on-hover:hover:before {
    opacity: 1;
}

.glow-on-hover:after {
    z-index: -1;
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    background: #111;
    left: 0;
    top: 0;
    border-radius: 10px;
}

@keyframes glowing {
    0% { background-position: 0 0; }
    50% { background-position: 400% 0; }
    100% { background-position: 0 0; }
}

</style>

<div class="footer">
            <div class="container">     
                <div class="row">   
                <?php 
                    $blog = new blog();
                    $cauhinh = $blog->show_cauhinh();
                    if($cauhinh){
                        $i = 0;
                        while($result = $cauhinh->fetch_assoc()){

                    
                ?>                     
                    <div class="col-lg-4">
                        <div class="single_footer">
                            <h4>Liên kết</h4>
                            <ul>
                                <li><a href="#" title="Tìm kiếm">Tìm kiếm</a></li>
                                <li><a href="#" title="Giới thiệu">Giới thiệu</a></li>
                                <li><a href="#" title="Chính sách đổi trả">Chính sách đổi trả </a></li>
                                <li><a href="#" title="Chính sách vận chuyển">Chính sách vận chuyển</a></li>
                                <li><a href="#" title="Điều khoản dịch vụ">Điều khoản dịch vụ</a></li>
                            </ul>
                        </div>
                    </div><!--- END COL --> 
                    <div class="col-lg-4">
                        <div class="single_footer single_footer_address">
                            <h4>Thông tin liên hệ</h4>
                            <ul>
                                <li><a href="/"></i> Hà Nội </a></li>
                                <li><a href="/" title="Số điện thoại"><i class="bi bi-telephone"></i> <?php echo $result['hotline'] ?></a></li>
                                <li><a href="/" title="Email"><i class="bi bi-envelope"></i> <?php echo $result['email'] ?></a></li>
                                <li><a href="lien-he" title="Liên hệ">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div><!--- END COL -->
                    <div class="col-lg-4">
                        <div class="single_footer single_footer_address">
                            <h4>Tuyển đại lý toàn quốc</h4>
                            <div class="signup_form">  

    
    
    <?php if(isset($insert)){
        echo $insert;
    } ?>
                       
                                <form action="" method="post" class="subscribe">
                                    <input type="text" class="subscribe__input" name="ten" placeholder="Họ tên" value="<?php if(isset($ten)){
                                echo $ten;
                            } ?>" >
                                    <input type="text" class="subscribe__input" name="sdt" placeholder="Số điện thoại" value="<?php if(isset($sdt)){
                                echo $sdt;
                            } ?>">
                                    <button class="glow-on-hover" name="lienhedaily" type="submit">Gửi ngay <i class="bi bi-send"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="social_profile">
                            
                                 
                            <div class="mangxahoi">
                              <a href="<?php echo $result['facebook'] ?>" title="Facebook" class="fb"><span>Facebook</span></a>
                              <a href="<?php echo $result['twitter'] ?>" title="Twitter" class="tw"><span>Twitter</span></a>
                              <a href="<?php echo $result['google'] ?>" title="Google" class="gg"><span>Google+</span></a>
                              <a href="<?php echo $result['youtube'] ?>" title="Youtube" class="yt"><span>Youtube</span></a>
                              <a href="<?php echo $result['instagram'] ?>" title="Instagram" class="ins"><span>Instagram</span></a>
                            </div>
                             
                        </div>                          
                    </div><!--- END COL -->      
                    <?php
                    }
                }

                ?>   
                </div><!--- END ROW --> 
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <p class="copyright">Copyright © 2024 <a href="/" title="Trang chủ">Thời trang nam Đại Dương</a>.</p>
                    </div><!--- END COL -->                 
                </div><!--- END ROW -->                 
            </div><!--- END CONTAINER -->
        </div>
        <div style="position:fixed;right: 10px; bottom: 50px;border-radius: 5px; padding:5px;">
    <ul>
        <?php 
                    $blog = new blog();
                    $cauhinh = $blog->show_cauhinh();
                    if($cauhinh){
                        $i = 0;
                        while($result = $cauhinh->fetch_assoc()){

                    
                ?>
        <li><a href="tel:<?php echo $result['hotline']?>" rel="nofollow" aria-label="Liên hệ số điện thoại" role="button"><div class="wrapper">
    <div class="ring">
        <div class="coccoc-alo-phone coccoc-alo-green coccoc-alo-show">
            <div class="coccoc-alo-ph-circle"></div>
            <div class="coccoc-alo-ph-circle-fill"></div>
            <div class="coccoc-alo-ph-img-circle"></div>
        </div>
    </div>
</div></a></li>    
       <?php
                    }
                }

                ?>
    </ul>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js" integrity="sha512-eP8DK17a+MOcKHXC5Yrqzd8WI5WKh6F1TIk5QZ/8Lbv+8ssblcz7oGC8ZmQ/ZSAPa7ZmsCU4e/hcovqR8jfJqA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>  

<script type="text/javascript">
    // Lấy tham chiếu đến phần tử icon
  var icon = document.getElementById("icon");

  // Lắng nghe sự kiện thay đổi trạng thái của input
  document.getElementById("drop").addEventListener("change", function() {
    if (this.checked) {
      // Khi input được chọn (checked), thay đổi lớp (class) của icon
      icon.className = "fas fa-times";
    } else {
      // Khi input không được chọn, thay đổi lớp (class) của icon trở lại
      icon.className = "fas fa-bars";
    }
  });
jQuery(document).ready(function ($) {
      $('.hero').slick({
        dots: false,
        infinite: true,
        speed: 500,
        fade: !0,
        cssEase: 'linear',
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000,
        draggable: true,
        arrows: false,
        responsive: [
        {
        breakpoint: 1024,
        settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true
                  }
        },
        {
        breakpoint: 768,
        settings: {
        draggable: true,
                  }
        },
        {
        breakpoint: 600,
        settings: {
        slidesToShow: 1,
        draggable: true,
        slidesToScroll: 1
                  }
        },
        {
        breakpoint: 480,
        settings: {
        slidesToShow: 1,
        draggable: true,
        slidesToScroll: 1
                  }
        }
    
                  ]
                  });
        });


$('.product-slider').slick({
  infinite: true,
  slidesToShow: 4,
  slidesToScroll: 2,
  autoplay:true,
  autoplaySpeed:5000,

  arrows:false,
    responsive: [
    {
      breakpoint: 1068,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
        infinite: true
      }
    },
    {
      breakpoint: 576,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    ]
});
$('.slider-for').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: '.slider-nav'
});
$('.slider-nav').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  asNavFor: '.slider-for',
  dots: false,
  focusOnSelect: true
});
$('.zoom-slider').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  dots: true,
  focusOnSelect: true,
  prevArrow:"<button type='button' class='slick-prev pull-left'><i class='fa fa-angle-left' style='color:black;' aria-hidden='true'></i></button>",
  nextArrow:"<button type='button' class='slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>"
});
$('.header-slider').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  dots: false,
  autoplay:true,
  autoplaySpeed:5000,
  infinite:true,
  arrows:false,
  focusOnSelect: true,
  prevArrow:"<button type='button' class='slick-prev pull-left'><i class='fa fa-angle-left' style='color:black;' aria-hidden='true'></i></button>",
  nextArrow:"<button type='button' class='slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>"
});
</script>

</body>
</html>
