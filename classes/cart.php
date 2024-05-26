<?php	
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
include_once ($filepath.'/../mail/sendmail.php');
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
/**
 * 
 */
class cart
{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this->db=new database();
		$this->fm=new Format();
	}
	public function add_to_cart($quantity,$url,$mausac,$kichco){
		$makh='0';
		$quantity	= $this->fm->validation($quantity);
		$mausac	= $this->fm->validation($mausac);
		$mausac	= mysqli_real_escape_string($this->db->link,$mausac);
		$kichco	= $this->fm->validation($kichco);
		$kichco	= mysqli_real_escape_string($this->db->link,$kichco);
		$quantity	= mysqli_real_escape_string($this->db->link,$quantity);
		$url	= mysqli_real_escape_string($this->db->link,$url);
		$sId = session_id();
		$query = "SELECT * FROM sanphamkichco where url='$url' and mausac='$mausac' and kichco='$kichco'";
		$result = $this->db->select($query)->fetch_assoc();
		$id = $result['masp'];
		$tensp = $result['tensp'];
		$gia = $result['gia'];
		$giakm = $result['giakm'];
		$hinhanh = $result['hinhanh'];
		$check_cart =  "SELECT * FROM cart where masp='$id' and sid='$sId' and mausac='$mausac' and kichco='$kichco'";
		$get_product =$this->db->select($check_cart);
		if($get_product){	
		while($result2 = $get_product->fetch_assoc()){		
			$soluongmoi = $result2['soluong'] + $quantity;
			$query3 ="update cart 
			set soluong='$soluongmoi' 
			
			where masp='$id' and sid='$sId' and mausac='$mausac' and kichco='$kichco'";

			$result3 = $this->db->update($query3);
			if($result3){
					if(!headers_sent()){
						header("Location:gio-hang");
					}else{
						echo '<script type="text/javascript">window.location.href="gio-hang";</script>';
					} 
				}else{
					header("Location:404.php");
				
			}
		}
		}else{

		
		$query_cart ="insert into cart(masp,sid,tensp,gia,giakm,soluong,hinhanh,mausac,kichco,makh) values('$id','$sId','$tensp','$gia',$giakm,'$quantity','$hinhanh','$mausac','$kichco','$makh')";
				$result_cart =$this->db->insert($query_cart);
				if($result_cart){
					if(!headers_sent()){
						header("Location:gio-hang");
					}else{
						echo '<script type="text/javascript">window.location.href="gio-hang";</script>';
					} 
				}else{
					header("Location:404.php");
				
			}
			}
	}
	public function add_1to_cart($quantity,$url,$mausac,$kichco){
		$makh='0';
		$quantity	= $this->fm->validation($quantity);
		$mausac	= $this->fm->validation($mausac);
		$mausac	= mysqli_real_escape_string($this->db->link,$mausac);
		$kichco	= $this->fm->validation($kichco);
		$kichco	= mysqli_real_escape_string($this->db->link,$kichco);
		$quantity	= mysqli_real_escape_string($this->db->link,$quantity);
		$url	= mysqli_real_escape_string($this->db->link,$url);
		$sId = session_id();
		$query = "SELECT * FROM sanphamkichco where url='$url' and mausac='$mausac' and kichco='$kichco'";
		$result = $this->db->select($query)->fetch_assoc();
		$id = $result['masp'];
		$tensp = $result['tensp'];
		$gia = $result['gia'];
		$giakm = $result['giakm'];
		$hinhanh = $result['hinhanh'];
		$check_cart =  "SELECT * FROM cart where masp='$id' and sid='$sId' and mausac='$mausac' and kichco='$kichco'";
		$get_product =$this->db->select($check_cart);
		if($get_product){	
		while($result2 = $get_product->fetch_assoc()){		
			$soluongmoi = $result2['soluong'] + $quantity;
			$query3 ="update cart 
			set soluong='$soluongmoi' 
			
			where masp='$id' and sid='$sId' and mausac='$mausac' and kichco='$kichco'";

			$result3 = $this->db->update($query3);
			if($result3){
					if(!headers_sent()){
						header("Location:dat-hang");
					}else{
						echo '<script type="text/javascript">window.location.href="dat-hang";</script>';
					} 
				}else{
					header("Location:404.php");
				
			}
		}
		}else{

		
		$query_cart ="insert into cart(masp,sid,tensp,gia,giakm,soluong,hinhanh,mausac,kichco,makh) values('$id','$sId','$tensp','$gia',$giakm,'$quantity','$hinhanh','$mausac','$kichco','$makh')";
				$result_cart =$this->db->insert($query_cart);
				if($result_cart){
					if(!headers_sent()){
						header("Location:dat-hang");
					}else{
						echo '<script type="text/javascript">window.location.href="dat-hang";</script>';
					} 
				}else{
					header("Location:404.php");
				
			}
			}
	}
	public function add_to_cart1($quantity,$url,$mausac,$kichco,$customer_id){
		$makh	= $this->fm->validation($customer_id);
		$makh	= mysqli_real_escape_string($this->db->link,$customer_id);
		$quantity	= $this->fm->validation($quantity);
		$mausac	= $this->fm->validation($mausac);
		$mausac	= mysqli_real_escape_string($this->db->link,$mausac);
		$kichco	= $this->fm->validation($kichco);
		$kichco	= mysqli_real_escape_string($this->db->link,$kichco);
		$quantity	= mysqli_real_escape_string($this->db->link,$quantity);
		$url	= mysqli_real_escape_string($this->db->link,$url);
		$sId = session_id();
		$query = "SELECT * FROM sanphamkichco where url='$url' and mausac='$mausac' and kichco='$kichco'";
		$result = $this->db->select($query)->fetch_assoc();
		$id = $result['masp'];
		$tensp = $result['tensp'];
		$gia = $result['gia'];
		$giakm = $result['giakm'];
		$hinhanh = $result['hinhanh'];
		$check_cart =  "SELECT * FROM cart where masp='$id' and makh='$makh' and mausac='$mausac' and kichco='$kichco'";
		$get_product =$this->db->select($check_cart);
		if($get_product){	
		while($result2 = $get_product->fetch_assoc()){		
			$soluongmoi = $result2['soluong'] + $quantity;
			$query3 ="update cart 
			set soluong='$soluongmoi' 
			
			where masp='$id' and makh='$makh' and mausac='$mausac' and kichco='$kichco'";

			$result3 = $this->db->update($query3);
			if($result3){
					if(!headers_sent()){
						header("Location:gio-hang");
					}else{
						echo '<script type="text/javascript">window.location.href="gio-hang";</script>';
					} 
				}else{
					header("Location:404.php");
				
			}
		}
		}else{

		
		$query_cart ="insert into cart(masp,sid,tensp,gia,giakm,soluong,hinhanh,mausac,kichco,makh) values('$id','$sId','$tensp','$gia',$giakm,'$quantity','$hinhanh','$mausac','$kichco','$makh')";
				$result_cart =$this->db->insert($query_cart);
				if($result_cart){
					if(!headers_sent()){
						header("Location:gio-hang");
					}else{
						echo '<script type="text/javascript">window.location.href="gio-hang";</script>';
					} 
				}else{
					header("Location:404.php");
				
			}
			}
	}
	public function add_1to_cart1($quantity,$url,$mausac,$kichco,$customer_id){
		$makh	= $this->fm->validation($customer_id);
		$makh	= mysqli_real_escape_string($this->db->link,$customer_id);
		$quantity	= $this->fm->validation($quantity);
		$mausac	= $this->fm->validation($mausac);
		$mausac	= mysqli_real_escape_string($this->db->link,$mausac);
		$kichco	= $this->fm->validation($kichco);
		$kichco	= mysqli_real_escape_string($this->db->link,$kichco);
		$quantity	= mysqli_real_escape_string($this->db->link,$quantity);
		$url	= mysqli_real_escape_string($this->db->link,$url);
		$sId = session_id();
		$query = "SELECT * FROM sanphamkichco where url='$url' and mausac='$mausac' and kichco='$kichco'";
		$result = $this->db->select($query)->fetch_assoc();
		$id = $result['masp'];
		$tensp = $result['tensp'];
		$gia = $result['gia'];
		$giakm = $result['giakm'];
		$hinhanh = $result['hinhanh'];
		$check_cart =  "SELECT * FROM cart where masp='$id' and makh='$makh' and mausac='$mausac' and kichco='$kichco'";
		$get_product =$this->db->select($check_cart);
		if($get_product){	
		while($result2 = $get_product->fetch_assoc()){		
			$soluongmoi = $result2['soluong'] + $quantity;
			$query3 ="update cart 
			set soluong='$soluongmoi' 
			
			where masp='$id' and makh='$makh' and mausac='$mausac' and kichco='$kichco'";

			$result3 = $this->db->update($query3);
			if($result3){
					if(!headers_sent()){
						header("Location:dat-hang");
					}else{
						echo '<script type="text/javascript">window.location.href="dat-hang";</script>';
					} 
				}else{
					header("Location:404.php");
				
			}
		}
		}else{

		
		$query_cart ="insert into cart(masp,sid,tensp,gia,giakm,soluong,hinhanh,mausac,kichco,makh) values('$id','$sId','$tensp','$gia',$giakm,'$quantity','$hinhanh','$mausac','$kichco','$makh')";
				$result_cart =$this->db->insert($query_cart);
				if($result_cart){
					if(!headers_sent()){
						header("Location:dat-hang");
					}else{
						echo '<script type="text/javascript">window.location.href="dat-hang";</script>';
					} 
				}else{
					header("Location:404.php");
				
			}
			}
	}
	public function get_history($makh){
		$query = "SELECT h.*,m.tenmau,k.tenkichco FROM hoanthanh h INNER JOIN mausac m on h.mausac=m.id INNER JOIN kichco k on h.kichco=k.id where h.makh='$makh' order by h.ngaydathang desc";
		$result =$this->db->select($query);
		return $result;
	}
	public function get_product_cart(){
		$sId = session_id();
		$query = "SELECT c.*,m.tenmau,k.tenkichco FROM cart c INNER JOIN mausac m on c.mausac=m.id INNER JOIN kichco k on c.kichco=k.id where c.sid='$sId'";
		$result =$this->db->select($query);
		return $result;
	}
	public function get_product_cart1($makh){
		$sId = session_id();
		$query = "SELECT c.*,m.tenmau,k.tenkichco FROM cart c INNER JOIN mausac m on c.mausac=m.id INNER JOIN kichco k on c.kichco=k.id where c.makh='$makh'";
		$result =$this->db->select($query);
		return $result;
	}
	public function get_product_product($id){
		$query = "SELECT * FROM sanpham where masp='$id'";
		$result =$this->db->select($query);
		return $result;
	}
	public function update_quantity_cart($quantity,$magio){
		$quantity	= mysqli_real_escape_string($this->db->link,$quantity);
		$magio	= mysqli_real_escape_string($this->db->link,$magio);
		$query ="update cart 
			set soluong='$quantity' 
			
			where magio='$magio'";

		$result = $this->db->update($query);
		if($result){
			if(!headers_sent()){
						header("Location:gio-hang");
					}else{
						echo '<script type="text/javascript">window.location.href="gio-hang";</script>';
					}
		}	
		else{
			$msg = "<script language='javascript'>									
							swal({
  							title: 'Error!',
  							text: 'Cập nhật thất bại!',
  							icon: 'error'});						
							</script>";
			return $msg;
		}
	}
	public function delete_cart($magio){
		$magio	= mysqli_real_escape_string($this->db->link,$magio);
		$query = "DELETE FROM cart where magio='$magio'";
		$result = $this->db->delete($query);
		if($result){
			if(!headers_sent()){
						header("Location:gio-hang");
					}else{
						echo '<script type="text/javascript">window.location.href="gio-hang";</script>';
					}
			
		}	
		else{
			$msg = "<script language='javascript'>									
							swal({
  							title: 'Error!',
  							text: 'Xóa thất bại!',
  							icon: 'error'});						
							</script>";
			return $msg;
		}
	}

	public function getordercount($dieukien){
		$query  ="SELECT * FROM dathang $dieukien order by orderid asc";
		$result = $this->db->select($query);
		return $result;
	}
	public function getcontactcount($dieukien){
		$query  ="SELECT * FROM lienhe $dieukien order by id asc";
		$result = $this->db->select($query);
		return $result;
	}

	public function check_cart(){
		$sId = session_id();
		$query = "SELECT * FROM cart where sid='$sId'";
		$result =$this->db->select($query);
		return $result;
	}
	public function check_cart1($customer_id){
		$makh	= $this->fm->validation($customer_id);
		$makh	= mysqli_real_escape_string($this->db->link,$customer_id);
		$query = "SELECT * FROM cart where makh='$makh'";
		$result =$this->db->select($query);
		return $result;
	}
	public function check_order1($customer_id){		
		$query = "SELECT * FROM dathang where makh='$customer_id'";
		$result =$this->db->select($query);
		return $result;
	}
	public function check_order(){
		$sId = session_id();
		$query = "SELECT * FROM dathang where sId='$sId'";
		$result =$this->db->select($query);
		return $result;
	}
	public function del_all_data_cart(){
		$sId = session_id();
		$query = "DELETE  FROM cart where sid='$sId'";
		$result =$this->db->delete($query);
		return $result;
	}
	public function insertOrder($data){
		$sId = session_id();
		$hoten	= mysqli_real_escape_string($this->db->link,$data['hoten']);
		$sdt	= mysqli_real_escape_string($this->db->link,$data['sdt']);
		$diachi	= mysqli_real_escape_string($this->db->link,$data['diachi']);
		$makh = '0';
		if($hoten=="" || $sdt=="" || $diachi==""){
			$alert="<script language='javascript'>									
							swal({
  							title: 'Error!',
  							text: 'Hãy nhập đủ thông tin!',
  							icon: 'error'});						
							</script>";
			return $alert;
		}
		else{
			if(preg_match('/^[0-9]{10}+$/', $sdt)){
				$query = "SELECT * FROM cart where sid='$sId'";
				$get_product =$this->db->select($query);
				if($get_product){
					while($result = $get_product->fetch_assoc()){
						$masp = $result['masp'];
						$tensp = $result['tensp'];
						$soluong = $result['soluong'];
						if($result['giakm']!="0"){
							$gia = $result['giakm'] * $soluong;
						}
						else{
							$gia = $result['gia'] * $soluong;
						}				
						$hinhanh = $result['hinhanh'];
						$mausac = $result['mausac'];
						$kichco = $result['kichco'];
						$giatop = $result['gia'];
						$giakmtop = $result['giakm'];
						$query1 = "SELECT * FROM sanphamkichco where masp='$masp' and mausac='$mausac' and kichco='$kichco'";
						$get_tonkho =$this->db->select($query1);
						if ($get_tonkho) {
							while($result1 = $get_tonkho->fetch_assoc()){
								$soluongmoi = $result1['soluong'] - $result['soluong'];
								$query2 ="update sanphamkichco 
								set soluong='$soluongmoi' 
								
								where masp='$masp' and mausac='$mausac' and kichco='$kichco'";

								$result2 = $this->db->update($query2);
							}
						}	
						$query_order ="insert into dathang(masp,tensp,soluong,gia,hinhanh,sId,hoten,sdt,diachi,makh,mausac,kichco) values('$masp','$tensp','$soluong','$gia','$hinhanh','$sId','$hoten','$sdt','$diachi','$makh','$mausac','$kichco')";
						$result_order =$this->db->insert($query_order);
						$query_complete ="insert into dondathang(masp,tensp,soluong,gia,makh,mausac,kichco,hoten,sdt,diachi) values('$masp','$tensp','$soluong','$gia','$makh','$mausac','$kichco','$hoten','$sdt','$diachi')";
						$result_complete =$this->db->insert($query_complete);
						$select_top = "SELECT * FROM topsanpham where masp='$masp' and mausac='$mausac' and kichco='$kichco'";
						$get_top =$this->db->select($select_top);
						if($get_top){
							while($result_gettop = $get_top->fetch_assoc()){
								$soluongmoi = $result_gettop['soluong'] + $result['soluong'];
								$query_top ="update topsanpham 
								set soluong='$soluongmoi' 
								
								where masp='$masp' and mausac='$mausac' and kichco='$kichco'";

								$result_top = $this->db->update($query_top);
							}
						}
						else{
							$query_inserttop ="insert into topsanpham(masp,tensp,hinhanh,gia,giakm,mausac,kichco,soluong) values('$masp','$tensp','$hinhanh','$giatop','$giakmtop','$mausac','$kichco','$soluong')";
						$result_inserttop =$this->db->insert($query_inserttop);
						}


						$send = new sendmail();
						$sendmail = $send->nhanthongbao();
						$query_delete = "DELETE FROM cart where sid='$sId'";
						$result_delete =$this->db->delete($query_delete);

						if(!headers_sent()){
                    header("Location:cam-on-quy-khach");
                }else{
                    echo '<script type="text/javascript">window.location.href="cam-on-quy-khach";</script>';
                }
						
					}
				}
			}else{
				$alert="<script language='javascript'>									
							swal({
  							title: 'Error!',
  							text: 'Số điện thoại không hợp lệ!',
  							icon: 'error'});						
							</script>";
				return $alert;
			}
		}
		
	}
	public function insertOrder1($data,$makh){
		$sId = session_id();
		$hoten	= mysqli_real_escape_string($this->db->link,$data['hoten']);
		$sdt	= mysqli_real_escape_string($this->db->link,$data['sdt']);
		$diachi	= mysqli_real_escape_string($this->db->link,$data['diachi']);
		$makh	= $this->fm->validation($makh);
		$makh	= mysqli_real_escape_string($this->db->link,$makh);
		if($hoten=="" || $sdt=="" || $diachi==""){
			$alert="<script language='javascript'>									
							swal({
  							title: 'Error!',
  							text: 'Hãy nhập đủ thông tin!',
  							icon: 'error'});						
							</script>";
			return $alert;
		}
		else{
			if(preg_match('/^[0-9]{10}+$/', $sdt)){
				$query = "SELECT * FROM cart where sid='$sId'";
				$get_product =$this->db->select($query);
				if($get_product){
					while($result = $get_product->fetch_assoc()){
						$masp = $result['masp'];
						$tensp = $result['tensp'];
						$soluong = $result['soluong'];
						if($result['giakm']!="0"){
							$gia = $result['giakm'] * $soluong;
						}
						else{
							$gia = $result['gia'] * $soluong;
						}				
						$hinhanh = $result['hinhanh'];
						$mausac = $result['mausac'];
						$kichco = $result['kichco'];
						$giatop = $result['gia'];
						$giakmtop = $result['giakm'];
						$query1 = "SELECT * FROM sanphamkichco where masp='$masp' and mausac='$mausac' and kichco='$kichco'";
						$get_tonkho =$this->db->select($query1);
						if ($get_tonkho) {
							while($result1 = $get_tonkho->fetch_assoc()){
								$soluongmoi = $result1['soluong'] - $result['soluong'];
								$query2 ="update sanphamkichco 
								set soluong='$soluongmoi' 
								
								where masp='$masp' and mausac='$mausac' and kichco='$kichco'";

								$result2 = $this->db->update($query2);
							}
						}	
						$query_order ="insert into dathang(masp,tensp,soluong,gia,hinhanh,sId,hoten,sdt,diachi,makh,mausac,kichco) values('$masp','$tensp','$soluong','$gia','$hinhanh','$sId','$hoten','$sdt','$diachi','$makh','$mausac','$kichco')";
						$result_order =$this->db->insert($query_order);
						$query_complete ="insert into dondathang(masp,tensp,soluong,gia,makh,mausac,hoten,sdt,diachi,kichco) values('$masp','$tensp','$soluong','$gia','$makh','$mausac','$hoten','$sdt','$diachi','$kichco')";
						$result_complete =$this->db->insert($query_complete);
						$select_top = "SELECT * FROM topsanpham where masp='$masp' and mausac='$mausac' and kichco='$kichco'";
						$get_top =$this->db->select($select_top);
						if($get_top){
							while($result_gettop = $get_top->fetch_assoc()){
								$soluongmoi = $result_gettop['soluong'] + $result['soluong'];
								$query_top ="update topsanpham 
								set soluong='$soluongmoi' 
								
								where masp='$masp' and mausac='$mausac' and kichco='$kichco'";

								$result_top = $this->db->update($query_top);
							}
						}
						else{
							$query_inserttop ="insert into topsanpham(masp,tensp,hinhanh,gia,giakm,mausac,soluong,kichco) values('$masp','$tensp','$hinhanh','$giatop','$giakmtop','$mausac','$soluong','$kichco')";
						$result_inserttop =$this->db->insert($query_inserttop);
						}


						$send = new sendmail();
						$sendmail = $send->nhanthongbao();
						$query_delete = "DELETE  FROM cart where makh='$makh'";
						$result_delete =$this->db->delete($query_delete);

						if(!headers_sent()){
                    header("Location:cam-on-quy-khach");
                }else{
                    echo '<script type="text/javascript">window.location.href="cam-on-quy-khach";</script>';
                }
						
					}
				}
			}else{
				$alert="<script language='javascript'>									
							swal({
  							title: 'Error!',
  							text: 'Số điện thoại không hợp lệ!',
  							icon: 'error'});						
							</script>";
				return $alert;
			}
		}
		
	}
		
	public function getAmountPrice($customer_id){
		$sId = session_id();	
		$query = "SELECT * FROM dathang where makh='$customer_id'";
		$result =$this->db->select($query);
		return $result;
	}
	public function getAmountPrice1(){
		$sId = session_id();	
		$query = "SELECT * FROM dathang where sId='$sId'";
		$result =$this->db->select($query);
		return $result;
	}
	public function get_details_cart($customer_id){
		$sId = session_id();
		$query = "SELECT d.*,m.tenmau,k.tenkichco FROM dathang d INNER JOIN mausac m on d.mausac=m.id INNER JOIN kichco k on d.kichco=k.id where d.makh='$customer_id'";
		$result =$this->db->select($query);
		return $result;
	}
	public function get_details_cart1(){
		$sId = session_id();
		$query = "SELECT d.*,m.tenmau,k.tenkichco FROM dathang d INNER JOIN mausac m on d.mausac=m.id INNER JOIN kichco k on d.kichco=k.id where d.sId='$sId'";
		$result =$this->db->select($query);
		return $result;
	}
	public function get_inbox_cart(){
		$query = "SELECT d.*,m.tenmau,k.tenkichco FROM dathang d INNER JOIN mausac m on d.mausac=m.id INNER JOIN kichco k on d.kichco=k.id order by d.ngaydathang desc";
		$result =$this->db->select($query);
		return $result;
	}
	public function get_complete_order(){
		$query = "SELECT h.*,m.tenmau,k.tenkichco FROM hoanthanh h INNER JOIN mausac m on h.mausac=m.id INNER JOIN kichco k on h.kichco=k.id order by h.ngaydathang desc";
		$result =$this->db->select($query);
		return $result;
	}
	public function shifted($id,$time,$price){
		$id	= mysqli_real_escape_string($this->db->link,$id);
		$time	= mysqli_real_escape_string($this->db->link,$time);
		$price	= mysqli_real_escape_string($this->db->link,$price);
		$query ="update dathang 
			set trangthai='1' 
			
			where orderid='$id' and ngaydathang='$time' and gia='$price'";

		$result = $this->db->update($query);
		if($result){
			$msg = "<script language='javascript'>									
							swal({
  							title: 'Success!',
  							text: 'Đã xử lý!',
  							icon: 'success'});						
							</script>";
			return $msg;
		}	
		else{
			$msg = "<script language='javascript'>									
							swal({
  							title: 'Error!',
  							text: 'Xử lý không thành công!',
  							icon: 'error'});						
							</script>";
			return $msg;
		}
		
	}
	public function del_shifted($id,$time,$price){
		$id	= mysqli_real_escape_string($this->db->link,$id);
		$time	= mysqli_real_escape_string($this->db->link,$time);
		$price	= mysqli_real_escape_string($this->db->link,$price);
		$query ="delete from dathang 					
			where orderid='$id' and ngaydathang='$time' and gia='$price'";

		$result = $this->db->delete($query);
		if($result){
			$msg = "<script language='javascript'>									
							swal({
  							title: 'Success!',
  							text: 'Xóa thành công!',
  							icon: 'success'});						
							</script>";
			return $msg;
		}	
		else{
			$msg = "<script language='javascript'>									
							swal({
  							title: 'Error!',
  							text: 'Có lỗi! Bạn hãy thử lại sau.',
  							icon: 'error'});						
							</script>";
			return $msg;
		}
	}

	public function confirm_admin($id,$time,$price){
		$id	= mysqli_real_escape_string($this->db->link,$id);
		$time	= mysqli_real_escape_string($this->db->link,$time);
		$price	= mysqli_real_escape_string($this->db->link,$price);
		$query ="update dathang 
			set trangthai='2' 
			
			where orderid='$id' and ngaydathang='$time' and gia='$price'";

		$result = $this->db->update($query);
		return $result;
	}
	public function confirm($id,$time,$price){
		$id	= mysqli_real_escape_string($this->db->link,$id);
		$time	= mysqli_real_escape_string($this->db->link,$time);
		$price	= mysqli_real_escape_string($this->db->link,$price);
		$query ="update dathang 
			set trangthai='2' 
			
			where orderid='$id' and ngaydathang='$time' and gia='$price'";

		$result = $this->db->update($query);
		return $result;
	}

	public function delete_dathang($id,$time,$price){
		$id	= mysqli_real_escape_string($this->db->link,$id);
		$time	= mysqli_real_escape_string($this->db->link,$time);
		$price	= mysqli_real_escape_string($this->db->link,$price);
		$query_p = "SELECT * FROM dathang where orderid='$id'";
				$get_product =$this->db->select($query_p);
				if($get_product){
					while($result = $get_product->fetch_assoc()){
						$masp = $result['masp'];
						$mausac = $result['mausac'];
						$kichco = $result['kichco'];
						$soluong = $result['soluong'];	
						$query1 = "SELECT * FROM sanphamkichco where masp='$masp' and mausac='$mausac' and kichco='$kichco'";
						$get_tonkho =$this->db->select($query1);
						if ($get_tonkho) {
							while($result1 = $get_tonkho->fetch_assoc()){
								$soluongmoi = $result1['soluong'] + $result['soluong'];
								$query2 ="update sanphamkichco 
								set soluong='$soluongmoi' 
								
								where masp='$masp' and mausac='$mausac' and kichco='$kichco'";

								$result2 = $this->db->update($query2);
							}
						}
					}
				}
		$query ="delete from dathang 					
			where orderid='$id' and ngaydathang='$time' and gia='$price'";

		$result = $this->db->delete($query);
		if($result){
			$msg = "<script language='javascript'>									
							swal({
  							title: 'Success!',
  							text: 'Xóa thành công!',
  							icon: 'success'});						
							</script>";
			return $msg;
		}	
		else{
			$msg = "<script language='javascript'>									
							swal({
  							title: 'Error!',
  							text: 'Có lỗi! Bạn hãy thử lại sau.',
  							icon: 'error'});						
							</script>";
			return $msg;
		}
	}
	public function complete_dathang($id,$time,$price){
		$id	= mysqli_real_escape_string($this->db->link,$id);
		$time	= mysqli_real_escape_string($this->db->link,$time);
		$price	= mysqli_real_escape_string($this->db->link,$price);
		$query_p = "SELECT * FROM dathang where orderid='$id'";
				$get_product =$this->db->select($query_p);
				if($get_product){
					while($result = $get_product->fetch_assoc()){
						$masp = $result['masp'];
						$soluong = $result['soluong'];
						$tensp = $result['tensp'];
						$gia = $result['gia'];
						$ngaydathang = $result['ngaydathang'];
						$hoten = $result['hoten'];
						$sdt = $result['sdt'];	
						$diachi = $result['diachi'];
						$mausac = $result['mausac'];
						$kichco = $result['kichco'];
						$makh = $result['makh'];
						// $query1 = "SELECT * FROM sanphamkichco where masp='$masp' and mausac='$mausac' and kichco='$kichco'";
						// $get_tonkho =$this->db->select($query1);
						// if ($get_tonkho) {
						// 	while($result1 = $get_tonkho->fetch_assoc()){
						// 		$soluongmoi = $result1['soluong'] + $result['soluong'];
						// 		$query2 ="update sanphamkichco 
						// 		set soluong='$soluongmoi' 
								
						// 		where masp='$masp' and mausac='$mausac' and kichco='$kichco'";

						// 		$result2 = $this->db->update($query2);
						// 	}
						// }
						$query_complete ="insert into hoanthanh(masp,tensp,soluong,gia,ngaydathang,mausac,hoten,sdt,diachi,makh,kichco) values('$masp','$tensp','$soluong','$gia','$ngaydathang','$mausac','$hoten','$sdt','$diachi','$makh','$kichco')";
						$result_complete =$this->db->insert($query_complete);
					}
				}

		$query ="delete from dathang 					
			where orderid='$id' and ngaydathang='$time' and gia='$price'";

		$result = $this->db->delete($query);
		if($result){
			$msg = "<script language='javascript'>									
							swal({
  							title: 'Success!',
  							text: 'Xác nhận thành công!',
  							icon: 'success'});						
							</script>";
			return $msg;
		}	
		else{
			$msg = "<script language='javascript'>									
							swal({
  							title: 'Error!',
  							text: 'Có lỗi! Bạn hãy thử lại sau.',
  							icon: 'error'});						
							</script>";
			return $msg;
		}
	}
}
?>