<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../helpers/format.php');
?>

 <?php 
	$connect = mysqli_connect("localhost","root","","doan_database");
	$output ='';
	$fm = new format();
	if(isset($_POST['export_excel'])){
		$from = $_POST['from'];
		$to = $_POST['to'];
		$sql = "SELECT dondathang.*,mausac.tenmau,kichco.tenkichco from dondathang INNER JOIN mausac on dondathang.mausac=mausac.id inner join kichco on dondathang.kichco = kichco.id where dondathang.ngaydathang between '$from' and '$to' order by dondathang.ngaydathang desc";
		$result = mysqli_query($connect,$sql);
		if(mysqli_num_rows($result)>0){
			$output .='
				<html xmlns:x="urn:schemas-microsoft-com:office:excel">
				<head>
					<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
					<style>
						/* Define table style */
						table {
							border-collapse: collapse;
							width: 100%;
						}
						th, td {
							border: 1px solid rgba(51,51,51,0.2);
							padding: 8px;
						}
						th {
							background-color: #f2f2f2;
						}
					</style>
				</head>
				<body>
					<table>
						<tr>
							<th></th>
							<th></th>
							<th></th>	
							<th></th>
							<th style="font-size:25px;">Danh sách đơn đặt hàng từ ngày '.$fm->formatDate_Details($from).' đến ngày '.$fm->formatDate_Details($to).'</th>
							<th></th>
							<th></th>	
							<th></th>
							<th></th>	
							<th></th>
							
						</tr>
						<tr>
							<th>Thứ tự</th>
							<th>Mã sản phẩm</th>
							<th>Tên sản phẩm</th>
							<th>Số lượng</th>
							<th>Giá</th>
							<th>Ngày đặt hàng</th>	
							<th>Màu sắc</th>
							<th>Kích cỡ</th>
							<th>Họ tên</th>
							<th>SĐT</th>
							<th>Địa chỉ</th>
								
						</tr>
			';
			$i=0;
			while($row =$result->fetch_assoc()){
				$i++;
				$output .='
					<tr>
						<td>'.$i.'</td>
						<td>'.$row["masp"].'</td>
						<td>'.$row["tensp"].'</td>
						<td>'.$row["soluong"].'</td>
						<td>'.$row["gia"].'</td>
						<td>'.$row["ngaydathang"].'</td>
						<td>'.$row["tenmau"].'</td>
						<td>'.$row["tenkichco"].'</td>
						<td>'.$row["hoten"].'</td>
						<td>'.$row["sdt"].'</td>
						<td>'.$row["diachi"].'</td>
					</tr>
				';
			}
			$output .='
					</table>
				</body>
				</html>
			';
			header("Content-Type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=danhsachlienhe.xls");
			echo $output;
			exit;
		}
	}
	else{
		echo 'Không có dữ liệu';
	}
?>