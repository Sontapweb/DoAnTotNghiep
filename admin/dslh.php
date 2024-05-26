<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<?php 
	$connect = mysqli_connect("localhost","root","","doan_database");
	$output ='';
	if(isset($_POST['export_excel'])){
		$from = $_POST['from'];
		$to = $_POST['to'];
		$sql = "SELECT * from lienhe where thoigian between '$from' and '$to' order by thoigian desc";
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
							border: 1px solid #000;
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
							<th style="font-size:25px;">Danh sách liên hệ từ ngày '.$fm->formatDate_Details($from).' đến ngày '.$fm->formatDate_Details($to).'</th>
							<th></th>
							<th></th>	
							<th></th>

							</tr>
						<tr>
							<th>Thứ tự</th>
							<th>Họ tên</th>
							<th>Email</th>
							<th>SĐT</th>
							<th>Chủ đề</th>
							<th>Thời gian</th>
						</tr>
			';
			$i=0;
			while($row =$result->fetch_assoc()){
				$i++;
				$output .='
					<tr>
						<td>'.$i.'</td>
						<td>'.$row["ten"].'</td>
						<td>'.$row["email"].'</td>
						<td>'.$row["sdt"].'</td>
						<td>'.$row["chude"].'</td>
						<td>'.$row["thoigian"].'</td>
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




