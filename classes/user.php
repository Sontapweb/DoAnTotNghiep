<?php	
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>
<script src="js/sweetalert.min.js"></script>
<?php
/**
 * 
 */
class user
{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this->db=new database();
		$this->fm=new Format();
	}
	public function show_user(){
		$query  ="SELECT * FROM khachhang order by id desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function show_wishlist(){
		$query  ="SELECT * FROM yeuthich order by id desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function delete_user($id){
		$query  ="delete from khachhang where id='$id'";
		$result = $this->db->delete($query);
		if($result){
					$alert="<span style='color:green;font-weight:600;'>Xoá thành công </span>";
					return $alert;
				}else{
					$alert="<span style='color:red;font-weight:600;'>Xoá không thành công </span>";
					return $alert;
		}

	}
	public function insert($ten,$email,$sdt,$chude){
		$status	= 0;
		$ten	= mysqli_real_escape_string($this->db->link,$ten);
		$email	= mysqli_real_escape_string($this->db->link,$email);
		$sdt	= mysqli_real_escape_string($this->db->link,$sdt);
		$chude	= mysqli_real_escape_string($this->db->link,$chude);
		
		if($ten=="" || $sdt=="" || $chude=="" ) {
			$alert="<script language='javascript'>									
							swal({
  							title: 'Error!',
  							text: 'Hãy nhập đủ thông tin!',
  							icon: 'error'});						
							</script>";
			return $alert;
		}else{
			
				if(preg_match('/^[0-9]{10}+$/', $sdt)){
					$query ="insert into lienhe(ten,email,sdt,chude,status) values('$ten','$email','$sdt','$chude','$status')";
				$result =$this->db->insert($query);
				if($result){
					$alert="<script language='javascript'>									
							swal({
  							title: 'Success!',
  							text: 'Gửi thành công! Chúng tôi sẽ liên hệ lại sau.',
  							icon: 'success'});						
							</script>";
					return $alert;
				}else{
					$alert="<script language='javascript'>									
							swal({
  							title: 'Error!',
  							text: 'Không thể gửi! Bạn hãy thử lại sau.',
  							icon: 'error'});						
							</script>";
					return $alert;
				
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
	public function get_lienhe(){
		$query = "SELECT * FROM lienhe order by thoigian desc";
		$result =$this->db->select($query);
		return $result;
	}
	public function confirm_done($id){
		$id	= mysqli_real_escape_string($this->db->link,$id);
		$query ="update lienhe 
			set status='1' 
			
			where id='$id'";

		$result = $this->db->update($query);
		return $result;
	}
	public function insert_daily($ten,$sdt){
		$status	= 0;
		$ten	= mysqli_real_escape_string($this->db->link,$ten);
		$email	= 'No Email';
		$sdt	= mysqli_real_escape_string($this->db->link,$sdt);
		$chude	= 'Muốn trở thành đại lý.';
		
		if($ten=="" || $sdt=="") {
			$alert="<script language='javascript'>									
							swal({
  							title: 'Error!',
  							text: 'Hãy nhập đủ thông tin!',
  							icon: 'error'});						
							</script>";
			return $alert;
		}else{
			
				if(preg_match('/^[0-9]{10}+$/', $sdt)){
					$query ="insert into lienhe(ten,email,sdt,chude,status) values('$ten','$email','$sdt','$chude','$status')";
				$result =$this->db->insert($query);
				if($result){
					$alert="<script language='javascript'>									
							swal({
  							title: 'Success!',
  							text: 'Gửi thành công! Chúng tôi sẽ liên hệ lại sau.',
  							icon: 'success'});						
							</script>";
					return $alert;
				}else{
					$alert="<script language='javascript'>									
							swal({
  							title: 'Error!',
  							text: 'Không thể gửi! Bạn hãy thử lại sau.',
  							icon: 'error'});						
							</script>";
					return $alert;
				
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
	public function insert_lienhesp($ten,$sdt){
		$status	= 0;
		$ten	= mysqli_real_escape_string($this->db->link,$ten);
		$email	= 'No Email';
		$sdt	= mysqli_real_escape_string($this->db->link,$sdt);
		$chude	= 'Thắc mắc về sản phẩm hết hàng.';
		
		if($ten=="" || $sdt=="") {
			$alert="<script language='javascript'>									
							swal({
  							title: 'Error!',
  							text: 'Hãy nhập đủ thông tin!',
  							icon: 'error'});						
							</script>";
			return $alert;
		}else{
			
				if(preg_match('/^[0-9]{10}+$/', $sdt)){
					$query ="insert into lienhe(ten,email,sdt,chude,status) values('$ten','$email','$sdt','$chude','$status')";
				$result =$this->db->insert($query);
				if($result){
					$alert="<script language='javascript'>									
							swal({
  							title: 'Success!',
  							text: 'Gửi thành công! Chúng tôi sẽ liên hệ lại sau.',
  							icon: 'success'});						
							</script>";
					return $alert;
				}else{
					$alert="<script language='javascript'>									
							swal({
  							title: 'Error!',
  							text: 'Không thể gửi! Bạn hãy thử lại sau.',
  							icon: 'error'});						
							</script>";
					return $alert;
				
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
	
}
?>