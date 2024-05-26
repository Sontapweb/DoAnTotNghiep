<?php
	 if(!isset($_GET['url']) || $_GET['url']==NULL){
   		echo "<script>window.location ='404.php'</script>";
   
}else{
    $url=$_GET['url'];
}
?>
<?php
	include_once 'classes/blog.php';
	$blog = new blog();
	$get_details = $blog->get_detailsbyUrl($url);
    			if($get_details){
    				while ($result_details = $get_details->fetch_assoc()) {
	      				$title=$result_details['title'];
	      				$description=$result_details['description'];
	      				$keywords=$result_details['keywords'];
	      				$duongdan='/tin-tuc/'.$url;
	      				$image='admin/uploads/'.$result_details['hinhanh'];
$articleSchema = [
   "@context" => "http://schema.org",
   "@type" => "NewsArticle",
   "mainEntityOfPage" => [
      "@type" => "WebPage",
      "@id" => "http://localhost/hotrosv/tin-tuc/".$result_details['url']
   ],
   "headline" => $result_details['tieude'],
   "image" => [
      "url" => "http://localhost/hotrosv/admin/uploads/".$result_details['hinhanh'],
      "width" => "100%",
      "height" => "auto"
   ],
   "datePublished" => $result_details['thoigian'],
   "dateModified" => $result_details['thoigian'],
   "author" => [
      "@type" => "Person",
      "name" => "Admin"
   ],
   "publisher" => [
      "@type" => "Organization",
      "name" => "Hỗ Trợ Sinh Viên",
      "logo" => [
         "@type" => "ImageObject",
         "url" => "http://localhost/hotrosv/admin/uploads/".$result_details['hinhanh'],
         "width" => "50px",
         "height" => "50px"
      ]
   ],
   "description" => $result_details['description'],
   "articleBody" => $result_details['mota'],
   "keywords" => $result_details['keywords']
];



$articleSchemaJson = json_encode($articleSchema, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);	      				
	      			}
	      		}
	      			else{
	      				include_once 'classes/blog.php';
                    $blog = new blog();
                    $cauhinh = $blog->show_cauhinh();
                    if($cauhinh){
                        $i = 0;
                        while($result = $cauhinh->fetch_assoc()){

                    
	$title = $result['tieude'];
	$description = $result['mota'];
	$keywords = $result['keywords'];	
	$duongdan='';
	$image='admin/uploads/'.$result['logo'];
	$articleSchemaJson = '';
}}
	      			}
	include 'include/header.php';
	//include 'include/slider.php';
?>
 <script type="application/ld+json">
   <?php echo $articleSchemaJson; ?>
</script> 
<style type="text/css">
	.tintuc-details ul li{
		list-style-type: none;
		border-bottom: 1px solid rgba(51,51,51,0.2);
		padding-top: 20px;
	}
	.h4{
		font-weight: 600;
	}
	.tieude{
		font-size: 16px;
	}
	.thoigian{
		font-size: 13px; color: #ff8c00;
	}
	@media screen and (max-width: 500px) {
	  	.tieude{
			font-size: 13px;
		}
		.thoigian{
			font-size: 10px;
		}
	}
	@media screen and (max-width: 420px) {
	  	.tieude{
			font-size: 10px;
		}
		.thoigian{
			font-size: 7px;
		}
	}	
</style>
<div class="link-content" style="box-shadow: 0px 0px 5px 0px #bdbdbd;">
    <div class="container">
    	<div class="row">
    		<?php 
    			$get_product_details = $blog->get_detailsbyUrl($url);
    			if($get_product_details){
    				while ($result_details = $get_product_details->fetch_assoc()) {
    		 ?>
    		<div class="col-lg-12 col-links">
    			<a href="/" title="Trang chủ"><i class="bi bi-house-door"></i> Trang chủ</a>
    			<span>></span>
    			<a href="danh-muc-tin-tuc" title="Danh mục tin tức">Tin tức</a>
    			<span>></span>
    			<span><?php echo $result_details['tieude'] ?></span>
    		</div>
    	<?php }} ?>
    	</div>
    </div>
</div>

<div class="container tintuc-details">
	<div class="row">
		<?php 
				$get_details = $blog->get_detailsbyUrl($url);
    			if($get_details){
    				while ($result_details = $get_details->fetch_assoc()) {
		 ?>
		<div class="col-lg-8">
			<p class="h4"><?php echo $result_details['tieude']?> </p>
			<p style="padding-top:5px;border-bottom: 1px solid rgba(51,51,51,0.2);"><span style="font-size: 14px;color: #ff8c00;font-weight: 600;"><i class="bi bi-clock"></i> <?php echo $fm->formatDate_Details($result_details['thoigian'])?></span></p>
			<p><?php echo $result_details['noidung']?></p>
		</div>
	<?php }} ?>
		<div class="col-lg-4" style="padding-top:20px;">
			<p style="border-bottom: 2px solid #428bca;position: relative; padding-top: 20px;"><span class="chitietsp">TIN KHÁC</span></p>
			<ul>
				<?php
    			$get_all_blogs = $blog->get_all_blogs();
    			if($get_all_blogs){
    				while ($result = $get_all_blogs->fetch_assoc()) {
    					
    		?>
				<li>
					<div style="display:flex;">
						<a href="tin-tuc/<?php echo $result['url']?>" title="<?php echo $result['tieude']?>" style="width:40% "><img src="admin/uploads/<?php echo $result['hinhanh']?>" alt="<?php echo $result['tieude']?>" width="100%;" style="border-radius:5px;"></a>
					<p style="padding-left:5px;font-weight: 600;padding-left: 15px;"><a href="tin-tuc/<?php echo $result['url']?>" title="<?php echo $result['tieude']?>"><span class="tieude"><?php echo $fm->textShorten($result['tieude'],30)?></span></a><br>
						<span class="thoigian"><i class="bi bi-clock"></i> <?php echo $fm->formatDate_Details($result['thoigian'])?></span><br>
						 
						
					</p>
						
					</p>
					</div>
					
				</li>
				<?php
			
		}
	}
	?>
			</ul>
		</div>
	</div>
</div> 


 <?php
	include 'include/footer.php';
	
?>