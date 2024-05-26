<?php 
	include_once 'helpers/format.php';
	$fm = new format();

	$connect = mysqli_connect("localhost","root","","doan_database");
	$sotin1trang = 8;
	$trangnew =$_GET['trangnew'];
	settype($trangnew, "int");
	$from = ($trangnew-1) * $sotin1trang;
	$qr="SELECT sanpham.*,danhmuc.url as url1 FROM sanpham INNER JOIN danhmuc on sanpham.danhmuc=danhmuc.madm order by sanpham.thoigian desc LIMIT $from, $sotin1trang ";

	$result = mysqli_query($connect,$qr);
	$giamgia = 0;
	while($row = $result->fetch_assoc()){
		$giamgia=(($row['gia']-$row['giakm'])/$row['gia'])*100;
		$roundgg = round($giamgia);
	  echo ' <div class="col-lg-3 show-4-1">
	  <a href="'.$row['url1'].'/'.$row['url'].'-'.$row['mausac'].'-'.$row['kichco'].'" title="'.$row['tensp'].'"><img src="admin/uploads/'.$row['hinhanh'].'" alt="'.$row['tensp'].'" width="100%"></a>
 				<p class="text-start text-dark"><a href="'.$row['url1'].'/'.$row['url'].'-'.$row['mausac'].'-'.$row['kichco'].'" class="tensanpham" title="'.$row['tensp'].'"><span>'. $row['tensp']  .'</span></a><br>
 				<span style="font-size:14px;">'. $row['id']  .'</span></p>'; 
		if($row['giakm']!="0"){
			echo '<span style="color: #f94c43;font-weight: 600;font-size: 19px;">
    				'.$fm->format_currency($row['giakm']).'đ'.'</span>
 					<span style="font-weight: 600;font-size: 16px;color: #939393;"><del>'.$fm->format_currency($row['gia']).'đ'.'</del></span>
 					<span class="giamgia"><i class="bi bi-lightning-fill"></i> Giảm '. $roundgg.'%' .'</span></div>';
		}else{
			echo '<span style="font-weight: 600;font-size: 19px;color: #428bca;">'. $fm->format_currency($row['gia']).'đ'.'</span></div>';
		}

	}
	
 ?>
 



