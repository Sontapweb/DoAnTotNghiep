<?php	
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>
<!-- SweetAlert2 -->
<script src="js/sweetalert.min.js"></script>
<?php
/**
 * 
 */
class customer
{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this->db=new database();
		$this->fm=new Format();
	}
	public function insert_customer($data){
	    $ten        = mysqli_real_escape_string($this->db->link, $data['ten']);
	    $email      = mysqli_real_escape_string($this->db->link, $data['email']);
	    $diachi     = mysqli_real_escape_string($this->db->link, $data['diachi']);
	    $sdt        = mysqli_real_escape_string($this->db->link, $data['sdt']);
	    $password   = mysqli_real_escape_string($this->db->link, md5($data['pass']));
	    $password1  = mysqli_real_escape_string($this->db->link, md5($data['pass1']));
	    
	    if ($ten == "" || $email == "" || $diachi == "" || $sdt == "" || $password == "") {
	        $alert = "<script language='javascript'>									
	                    swal({
	                        title: 'Error!',
	                        text: 'Hãy nhập đủ thông tin!',
	                        icon: 'error'
	                    });						
	                </script>";
	        return $alert;
	    } else {
	        if ($password != $password1) {
	            $alert = "<script language='javascript'>									
	                        swal({
	                            title: 'Error!',
	                            text: 'Bạn hãy nhập lại mật khẩu!',
	                            icon: 'error'
	                        });						
	                    </script>";
	            return $alert;
	        } else {
	            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	                $alert = "<script language='javascript'>									
	                            swal({
	                                title: 'Error!',
	                                text: 'Email không hợp lệ!',
	                                icon: 'error'
	                            });						
	                        </script>";
	                return $alert;
	            }

	            $check_email = "SELECT * from khachhang where email='$email' limit 1";
	            $result_check = $this->db->select($check_email);
	            if ($result_check) {
	                $alert = "<script language='javascript'>									
	                            swal({
	                                title: 'Error!',
	                                text: 'Email này đã được tạo tài khoản! Vui lòng liên hệ!',
	                                icon: 'error'
	                            });						
	                        </script>";
	                return $alert;
	            } else {
	                if (preg_match('/^[0-9]{10}+$/', $sdt)) {
	                    $query ="insert into khachhang(ten,diachi,sdt,email,password) values('$ten','$diachi','$sdt','$email','$password')";
	                    $result =$this->db->insert($query); 
	                    if ($result) {
	                        $alert = "<script language='javascript'>											
	                                    swal({
	                                        title: 'Success!',
	                                        text: 'Tạo tài khoản thành công!',
	                                        icon: 'success'
	                                    });
	                                    setTimeout(function(){
	                                        window.open('dang-nhap', '_self', 1);
	                                    }, 1000); // Chờ 2 giây trước khi chuyển trang
	                                </script>";
	                        return $alert;
	                    } else {
	                        $alert = "<script language='javascript'>									
	                                    swal({
	                                        title: 'Error!',
	                                        text: 'Có lỗi! Bạn hãy thử lại sau.',
	                                        icon: 'error'
	                                    });						
	                                </script>";
	                        return $alert;
	                    }
	                } else {
	                    $alert = "<script language='javascript'>									
	                                swal({
	                                    title: 'Error!',
	                                    text: 'Số điện thoại không hợp lệ!',
	                                    icon: 'error'
	                                });						
	                            </script>";
	                    return $alert;
	                }
	            }
	        }
	    }
	}  

	public function login_customer($data){
		$email	= mysqli_real_escape_string($this->db->link,$data['email']);
		$password	= mysqli_real_escape_string($this->db->link,md5($data['password']));
		if(empty($email) || empty($password) ) {
			$alert="<script language='javascript'>									
							swal({
  							title: 'Error!',
  							text: 'Hãy nhập email và mật khẩu!',
  							icon: 'error'});						
							</script>";
			return $alert;
		}else{
			$check_login = "SELECT * from khachhang where email='$email' and password='$password' limit 1";
			$result_check = $this->db->select($check_login);
			if($result_check){
				$value = $result_check->fetch_assoc();
				Session::set('customer_login',true);
				Session::set('customer_id',$value['id']);
				Session::set('customer_name',$value['ten']);
				$alert = "<script language='javascript'>											
                    swal({
                        title: 'Success!',
                        text: 'Đăng nhập thành công!',
                        icon: 'success'
                    });
                    setTimeout(function(){
                        window.open('xin-chao', '_self', 1);
                    }, 1000); // Chờ 2 giây trước khi chuyển trang
                </script>";
					return $alert;
				
				
			}else{
				$alert="<script language='javascript'>									
							swal({
  							title: 'Error!',
  							text: 'Email hoặc mật khẩu không đúng!',
  							icon: 'error'});						
							</script>";
				return $alert;
				
				}
			}
	}
	public function login_facebook($idfb,$ten,$email){
		$ten	= mysqli_real_escape_string($this->db->link,$ten);
		$email	= mysqli_real_escape_string($this->db->link,$email);
		$idfb	= mysqli_real_escape_string($this->db->link,$idfb);
			$check_login = "SELECT * from khachhang where other_id='$idfb'";
			$result_check = $this->db->select($check_login);
			if($result_check){
				$value = $result_check->fetch_assoc();
				Session::set('customer_login',true);
				Session::set('login_facebook',true);
				Session::set('customer_id',$value['id']);
				Session::set('customer_name',$value['ten']);

												
				
			}else{
				
				$query ="insert into khachhang(ten,email,other_id) values('$ten','$email','$idfb')";
				$result =$this->db->insert($query);

				$getlogin = "SELECT * from khachhang where other_id='$idfb'";
				$result_login = $this->db->select($getlogin);
				$value = $result_login->fetch_assoc();
				Session::set('customer_login',true);
				Session::set('login_facebook',true);
				Session::set('customer_id',$value['id']);
				Session::set('customer_name',$value['ten']);
				}
			
	}
	public function insert_club($iduser, $idclub){
		$status = 0;
		$check_pro =  "SELECT * FROM dangkyclub where iduser='$iduser' and idclub='$idclub'";
		$get_club =$this->db->select($check_pro);
		if($get_club){
			$alert = "<script language='javascript'>									
	                                    swal({
	                                        title: 'Error!',
	                                        text: 'Bạn đã đăng ký CLB này.',
	                                        icon: 'error'
	                                    });						
	                                </script>";
	                        return $alert;
		}else{
			$query ="insert into dangkyclub(iduser,idclub,status) values('$iduser','$idclub','$status')";
			$result =$this->db->insert($query); 
			if ($result) {
				$alert = "<script language='javascript'>											
							swal({
								title: 'Success!',
								text: 'Tạo tài khoản thành công!',
								icon: 'success'
							});	                                    
						</script>";
				return $alert;
			} else {
				$alert = "<script language='javascript'>									
							swal({
								title: 'Error!',
								text: 'Có lỗi! Bạn hãy thử lại sau.',
								icon: 'error'
							});						
						</script>";
				return $alert;
			}
		}
	    
	}  

	public function login_google($idgg,$ten,$email){
		$ten	= mysqli_real_escape_string($this->db->link,$ten);
		$email	= mysqli_real_escape_string($this->db->link,$email);
		$idgg	= mysqli_real_escape_string($this->db->link,$idgg);
		
			$check_login = "SELECT * from khachhang where other_id='$idgg'";
			$result_check = $this->db->select($check_login);
			if($result_check){

				$value = $result_check->fetch_assoc();
				Session::set('customer_login',true);
				Session::set('login_google',true);
				Session::set('customer_id',$value['id']);
				Session::set('customer_name',$value['ten']);												
				
			}else{
				
				$query ="insert into khachhang(ten,email,other_id) values('$ten','$email','$idgg')";
				$result =$this->db->insert($query);

				$getlogin = "SELECT * from khachhang where other_id='$idgg'";
				$result_login = $this->db->select($getlogin);
				if($result_login){
					$value = $result_login->fetch_assoc();
					Session::set('customer_login',true);
					Session::set('login_google',true);
					Session::set('customer_id',$value['id']);
					Session::set('customer_name',$value['ten']);
				}
				}
			
	}
	public function show_customer($id){
		$query = "SELECT * from khachhang where id='$id' ";
			$result = $this->db->select($query);
			return $result;
	}
	public function update_customer($data, $id){
	    $ten = mysqli_real_escape_string($this->db->link, $data['ten']);
	    $email = mysqli_real_escape_string($this->db->link, $data['email']);
	    $sdt = mysqli_real_escape_string($this->db->link, $data['sdt']);
	    $diachi = mysqli_real_escape_string($this->db->link, $data['diachi']);
	    
	    if ($ten == "" || $email == "") {
	        $alert = "<script language='javascript'>									
	                    swal({
	                        title: 'Error!',
	                        text: 'Hãy nhập đủ thông tin!',
	                        icon: 'error'
	                    });						
	                </script>";
	        return $alert;
	    } else {
	        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	            $alert = "<script language='javascript'>									
	                        swal({
	                            title: 'Error!',
	                            text: 'Email không hợp lệ!',
	                            icon: 'error'
	                        });						
	                    </script>";
	            return $alert;
	        }

	        if (preg_match('/^[0-9]{10}+$/', $sdt)) {
	            $query = "UPDATE khachhang SET ten='$ten', email='$email', sdt='$sdt', diachi='$diachi' WHERE id='$id'";
	            $result = $this->db->update($query);
	            if ($result) {
	                $alert = "<script language='javascript'>									
	                            swal({
	                                title: 'Success!',
	                                text: 'Cập nhật thành công!',
	                                icon: 'success'
	                            });						
	                        </script>";
	                return $alert;
	            } else {
	                $alert = "<script language='javascript'>									
	                            swal({
	                                title: 'Error!',
	                                text: 'Cập nhật không thành công!',
	                                icon: 'error'
	                            });						
	                        </script>";
	                return $alert;
	            }
	        } else {
	            $alert = "<script language='javascript'>									
	                        swal({
	                            title: 'Error!',
	                            text: 'Số điện thoại không hợp lệ!',
	                            icon: 'error'
	                        });						
	                    </script>";
	            return $alert;
	        }
	    }
	}

	
}
?>