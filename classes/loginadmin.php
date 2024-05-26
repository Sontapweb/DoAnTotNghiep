<?php
$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/session.php');
	Session::checkLogin();
	include ($filepath.'/../lib/database.php');
	include ($filepath.'/../helpers/format.php');
?>

<?php
/**
 * 
 */
class loginadmin
{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this->db=new database();
		$this->fm=new Format();
	}
	public function login_admin($username,$password){
		$username	= $this->fm->validation($username);
		$password	= $this->fm->validation($password);
		$username	= mysqli_real_escape_string($this->db->link,$username);
		$password	= mysqli_real_escape_string($this->db->link,$password);
		if(empty($username) || empty($password)){
			$alert="User and Pass must be not empty";
			return $alert;
		}
		else{
			$query  ="select * from nguoidung where username='$username' and password='$password' limit 1";
			$result = $this->db->select($query);
			if($result != false){
				$value = $result->fetch_assoc();
				Session::set('loginadmin',true);
				Session::set('id',$value['id']);
				Session::set('username',$value['username']);
				Session::set('tennd',$value['tennd']);
				Session::set('phanquyen',$value['phanquyen']);
				if(!headers_sent()){
					header("Location:index.php");
				}else{
					echo '<script type="text/javascript">window.location.href="index.php";</script>';
				} 
			}else{
				$alert="User or Pass not match";
				return $alert;
			}
		}
	}
	public function update_admin($old,$new,$admin_id){
		$old	= $this->fm->validation($old);
		$new	= $this->fm->validation($new);
		$old	= mysqli_real_escape_string($this->db->link,$old);
		$new	= mysqli_real_escape_string($this->db->link,$new);
		if(empty($old)||empty($new)){
		$alert = "Can't be empty";
		return $alert;
		}
		else{
			$query = "UPDATE nguoidung set password='$new' where id='$admin_id' and password='$old'";
			$result = $this->db->update($query);
			if($result){
					$alert="<span style='color:green;font-weight:600;'>Cập nhật thành công </span>";
					return $alert;
				}else{
					$alert="<span style='color:red;font-weight:600;'>Cập nhật không thành công </span>";
					return $alert;
				
			}
	}
	}
	

}
?>