<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');

?>

<?php
/**
 * 
 */
class post
{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this->db=new database();
		$this->fm=new Format();
	}
	
	public function show_post_cat(){
		$query  ="SELECT * FROM danhmuc where kieuhienthi='3' and hienthi='0' order by uutien desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function getpostcatbyId($id){
		$query  ="SELECT * FROM danhmuc where madm='$id' ";
		$result = $this->db->select($query);
		return $result;
	}	
	public function show_category_fontend(){
		$query  ="SELECT * FROM danhmuc order by madm desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function get_blog_by_post($id,$dieukien){
		$query  ="SELECT * FROM tintuc where danhmuc='$id' $dieukien";
		$result = $this->db->select($query);
		return $result;
	}
	public function get_by_post($id){
		$query  ="SELECT tintuc.*,tbl_category_post.tendm,tbl_category_post.id_cate_post,tbl_category_post.title as title1,tbl_category_post.description as mota1,tbl_category_post.keywords as keywords1 from tintuc inner join tbl_category_post on tintuc.danhmuc=tbl_category_post.id_cate_post where tintuc.danhmuc='$id' limit 1";
		$result = $this->db->select($query);
		return $result;
	}
	public function get_blog_by_id($id){
		$query  ="SELECT * FROM tintuc where id='$id'";
		$result = $this->db->select($query);
		return $result;
	}
}
?>