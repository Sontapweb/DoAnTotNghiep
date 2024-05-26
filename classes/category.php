<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');

?>

<?php
/**
 * 
 */
class category
{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this->db=new database();
		$this->fm=new Format();
	}
	public function show_category(){
		$query  ="SELECT * FROM danhmuc where kieuhienthi='1' and hienthi='0' order by uutien desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function getcatbyId($id){
		$query  ="SELECT * FROM danhmuc where madm='$id' ";
		$result = $this->db->select($query);
		return $result;
	}
	public function show_category_fontend(){
		$query  ="SELECT * FROM danhmuc where kieuhienthi='1' and hienthi='0' order by uutien desc";
		$result = $this->db->select($query);
		return $result;	
	}
	public function get_product_by_cart($id,$dieukien){
		$query  ="SELECT sanpham.*,danhmuc.url as url1 FROM sanpham INNER JOIN danhmuc on sanpham.danhmuc=danhmuc.madm where sanpham.danhmuc='$id' $dieukien";
		$result = $this->db->select($query);
		return $result;
	}
	public function get_product_by_cat($id){
		$query  ="SELECT sanpham.*,danhmuc.url as url1 FROM sanpham INNER JOIN danhmuc on sanpham.danhmuc=danhmuc.madm where sanpham.danhmuc='$id' order by sanpham.uutien asc";
		$result = $this->db->select($query);
		return $result;
	}
	public function get_by_cart($id){
		$query  ="SELECT sanpham.*,danhmuc.tendm,danhmuc.madm,danhmuc.title as title1,danhmuc.description as mota1,danhmuc.keywords as keywords1 from sanpham inner join danhmuc on sanpham.madm=danhmuc.madm where sanpham.madm='$id' limit 1";
		$result = $this->db->select($query);
		return $result;
	}
	public function getproductcat_byUrl($url){
		$query  ="SELECT * FROM danhmuc where url='$url' ";
		$result = $this->db->select($query);
		return $result;
	}
	public function filter_product_cat($whereand){
		$query  ="SELECT * from sanpham where '$whereand' limit 8";
		$result = $this->db->select($query);
		return $result;
	}

	public function show_color(){
		$query  ="SELECT * FROM mausac order by id desc";
		$result = $this->db->select($query);
		return $result;
	}
	
}
?>