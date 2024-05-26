<?php	
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>
<?php
/**
 * 
 */
class blog
{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this->db=new database();
		$this->fm=new Format();
	}
	
	public function show_blog(){
		$query  ="
		SELECT tintuc.*,danhmuc.tendm 
		FROM tintuc INNER JOIN danhmuc ON tintuc.danhmuc = danhmuc.madm
		order by tintuc.id desc";
		//$query  ="SELECT * FROM sanpham order by masp desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function show_blog1(){
		$query  ="
		SELECT * from tintuc";
		//$query  ="SELECT * FROM sanpham order by masp desc";
		$result = $this->db->select($query);
		return $result;
	}

	public function show_cauhinh(){
		$query  ="
		SELECT * from cauhinh";
		$result = $this->db->select($query);
		return $result;
	}
	public function getcontactcount(){
		$query  ="SELECT * FROM lienhe where status='0' order by thoigian desc";
		$result = $this->db->select($query);
		return $result;	
	}
	public function getduyetclub(){
		$query  ="SELECT * FROM dangkyclub where status='0' ";
		$result = $this->db->select($query);
		return $result;	
	}
	public function getinboxcount(){
		$query  ="SELECT * FROM dathang where trangthai='0'";
		$result = $this->db->select($query);
		return $result;	
	}

	public function get_blog_by_id($id){
		$query  ="SELECT * FROM tintuc where id='$id' ";
		$result = $this->db->select($query);
		return $result;
	}
	
	public function get_details($id){
		$query  ="
		SELECT tintuc.*,tbl_category_post.tendm 
		FROM tintuc INNER JOIN tbl_category_post ON tintuc.danhmuc = tbl_category_post.id_cate_post
		where tintuc.id='$id'";
		
		$result = $this->db->select($query);
		return $result;
	}
	public function get_detailsbyUrl($url){
		$query  ="
		SELECT tintuc.*,danhmuc.tendm 
		FROM tintuc INNER JOIN danhmuc ON tintuc.danhmuc = danhmuc.madm
		where tintuc.url='$url'";
		
		$result = $this->db->select($query);
		return $result;
	}
	public function get_all_blogs(){
		$query  ="SELECT * FROM tintuc where hienthi='0' order by thoigian desc limit 8   ";
		$result = $this->db->select($query);
		return $result;
	}		
	public function getclb_detailsbyUrl($url){
		$query  ="
		SELECT *
		FROM club 
		where url='$url'";
		
		$result = $this->db->select($query);
		return $result;
	}
	
}

?>