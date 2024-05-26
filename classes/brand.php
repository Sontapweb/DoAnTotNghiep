<?php
	
	$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>

<?php
/**
 * 
 */
class brand
{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this->db=new database();
		$this->fm=new Format();
	}
	public function show_brand(){
		$query  ="SELECT * FROM thuonghieu where hienthi='0' order by uutien desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function getbrandbyId($id){
		$query  ="SELECT * FROM thuonghieu where math='$id' ";
		$result = $this->db->select($query);
		return $result;
	}
	public function get_by_brand($id){
		$query  ="SELECT sanpham.*,thuonghieu.tenth,thuonghieu.math,thuonghieu.title as title1,thuonghieu.description as mota1,thuonghieu.keywords as keywords1 from sanpham inner join thuonghieu on sanpham.math=thuonghieu.math where sanpham.math='$id' limit 1";
		$result = $this->db->select($query);
		return $result;
	}
	public function getproductbrand_byUrl($url){
		$query  ="SELECT * FROM thuonghieu where url='$url' ";
		$result = $this->db->select($query);
		return $result;
	}
	public function get_product_by_brand($id,$dieukien){
		$query  ="SELECT sanpham.*,thuonghieu.url as url1 FROM sanpham INNER JOIN thuonghieu on sanpham.thuonghieu=thuonghieu.math where sanpham.thuonghieu='$id' $dieukien";
		$result = $this->db->select($query);
		return $result;
	}
}
?>