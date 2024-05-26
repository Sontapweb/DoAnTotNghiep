<?php	
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');
?>
<?php
/**
 * 
 */
class product
{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this->db=new database();
		$this->fm=new Format();
	}	

	public function show_producttype($id){
		$query  ="
		SELECT sanphammausac.*,mausac.tenmau,kichco.tenkichco from sanphammausac sp INNER JOIN mausac m on sp.mausac=m.id INNER JOIN kichco k on sp.kichco=k.id where sp.masp='$id'";
		$result = $this->db->select($query);
		return $result;
	}	
	
	public function find_product($tensp){
		$query  ="SELECT * FROM sanpham where tensp='$tensp' LIMIT 1 ";
		$result = $this->db->select($query);
		if($result){
					$alert="<script language='javascript'>
								alert('Tìm thành công');	
								window.open('chi-tiet-san-pham','_self', 1);							
							</script>";
					return $alert;
				}else{
					$alert="<script language='javascript'>
								alert('Tìm không thành công');	
								window.open('trang-chu','_self', 1);							
							</script>";
					return $alert;
				
			}
	}
	public function search_product($tukhoa){
		$tukhoa	= $this->fm->validation($tukhoa);
		$query  ="SELECT sanpham.*,danhmuc.url as url1 FROM sanpham INNER JOIN danhmuc on sanpham.danhmuc=danhmuc.madm where sanpham.tensp like '%$tukhoa%'";
		$result = $this->db->select($query);
		return $result;
	}	
	public function getdanhmucxe(){
		$query  ="SELECT * FROM danhmuc where hienthi='0' and kieuhienthi='1' order by uutien desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function getproduct_bydmxe($dm){
		$query  ="SELECT sanpham.*,danhmuc.url as url1 FROM sanpham INNER JOIN danhmuc on sanpham.danhmuc=danhmuc.madm where sanpham.danhmuc='$dm' and sanpham.hienthi='0' order by sanpham.uutien desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function getthuonghieuxe(){
		$query  ="SELECT * FROM thuonghieu where hienthi='0' order by uutien desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function getproduct_bythxe($th){
		$query  ="SELECT sanpham.*,danhmuc.url as url1 FROM sanpham INNER JOIN danhmuc on sanpham.danhmuc=danhmuc.madm where sanpham.thuonghieu='$th' and sanpham.hienthi='0' order by sanpham.uutien desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function getdanhmuctin(){
		$query  ="SELECT * FROM danhmuc where hienthi='0' and kieuhienthi='3' order by uutien desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function gettin_bydmtin($dm){
		$query  ="SELECT * FROM tintuc where danhmuc='$dm' and hienthi='0' order by thoigian desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function getdanhclub(){
		$query  ="SELECT * FROM club where hienthi='0' order by uutien desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function show_product(){
		$query  ="
		SELECT sanpham.*,danhmuc.tendm,thuonghieu.tenth 
		FROM sanpham INNER JOIN danhmuc ON sanpham.danhmuc = danhmuc.madm
		INNER JOIN thuonghieu ON sanpham.thuonghieu = thuonghieu.math
		order by sanpham.masp desc";
		//$query  ="SELECT * FROM sanpham order by masp desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function get_mausac(){
		$query  ="
		SELECT * from mausac";
		$result = $this->db->select($query);
		return $result;
	}

	public function show_slider(){
		$query  ="
		SELECT *
		FROM slider
		where loai='1'
		order by id desc";
		//$query  ="SELECT * FROM sanpham order by masp desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function show_slider1(){
		$query  ="
		SELECT *
		FROM slider
		
		order by id desc";
		//$query  ="SELECT * FROM sanpham order by masp desc";
		$result = $this->db->select($query);
		return $result;
	}
	public function getproductbyId($id){
		$query  ="SELECT * FROM sanpham where masp='$id' ";
		$result = $this->db->select($query);
		return $result;
	}
	public function getcolorbyId($id){
		$query  ="SELECT * FROM mausac where id='$id' ";
		$result = $this->db->select($query);
		return $result;
	}
	public function getproductcolorbyIdAndColor($id,$color){
		$query  ="SELECT * FROM sanphammausac where masp='$id' AND mausac='$color' ";
		$result = $this->db->select($query);
		return $result;
	}

	public function getproductbydh($id){
		$query  ="SELECT sanpham.*,danhmuc.url as url1 FROM sanpham INNER JOIN danhmuc on sanpham.danhmuc=danhmuc.madm where sanpham.masp='$id'";
		$result = $this->db->select($query);
		return $result;
	}
	public function getproduct_feathered(){
		$query  ="SELECT sanpham.*,danhmuc.url as url1 FROM sanpham INNER JOIN danhmuc on sanpham.danhmuc=danhmuc.madm where sanpham.loai='0' and sanpham.hienthi='0' order by sanpham.uutien desc LIMIT 8";
		$result = $this->db->select($query);
		return $result;
	}

	public function get3blog(){
		$query  ="SELECT * FROM tintuc where hienthi='0' order by thoigian desc LIMIT 3";
		$result = $this->db->select($query);
		return $result;
	}

	public function get8product(){
		$query  ="SELECT sanpham.*,danhmuc.url as url1 FROM sanpham INNER JOIN danhmuc on sanpham.danhmuc=danhmuc.madm where sanpham.hienthi='0' order by sanpham.thoigian desc LIMIT 8";
		$result = $this->db->select($query);
		return $result;
	}
	public function getproduct_all($dieukien){
		$sp_tungtrang = 40;
		if(!isset($_GET['trang'])){
			$trang = 1;

		}else{
			$trang = $_GET['trang'];
		}
		$tung_trang = ($trang-1)*40;
		$query  ="SELECT * FROM sanpham $dieukien limit $tung_trang,$sp_tungtrang";
		$result = $this->db->select($query);
		return $result;
	}
	public function get_all_product(){
		$query  ="SELECT * FROM sanpham   ";
		$result = $this->db->select($query);
		return $result;
	}
	public function get_details($id){
		$query  ="
		SELECT sanpham.*,danhmuc.tendm,thuonghieu.tenth
		FROM sanpham INNER JOIN danhmuc ON sanpham.madm = danhmuc.madm
		INNER JOIN thuonghieu ON sanpham.math = thuonghieu.math
		where sanpham.masp='$id'";
		
		$result = $this->db->select($query);
		return $result;
	}
	public function get_detailsbyUrl($url){
		$query  ="
		SELECT s.*,d.tendm,d.url as url1,t.tenth
		FROM sanpham s INNER JOIN danhmuc d ON s.danhmuc = d.madm
		INNER JOIN thuonghieu t ON s.thuonghieu = t.math
		where s.url='$url'";
		
		$result = $this->db->select($query);
		return $result;
	}

	public function get_sptrung($id){
		$query  ="
		SELECT sp.*,m.tenmau,k.tenkichco from sanphammausac sp INNER JOIN mausac m on sp.mausac=m.id INNER JOIN kichco k on sp.kichco=k.id
		where sp.masp='$id'";
		
		$result = $this->db->select($query);
		return $result;
	}
	public function get_sptrungbyUrl($url){
		$query  ="
		SELECT sanphammausac.*,mausac.tenmau,kichco.tenkichco from sanphammausac INNER JOIN mausac on sanphammausac.mausac=mausac.id INNER JOIN kichco on sanphammausac.kichco=kichco.id
		where sanphammausac.url='$url'";
		
		$result = $this->db->select($query);
		return $result;
	}
	public function get_colorbyUrl($url){
		$query  ="
		SELECT DISTINCT sanphammausac.*,mausac.tenmau,kichco.tenkichco from sanphammausac INNER JOIN mausac on sanphammausac.mausac=mausac.id INNER JOIN kichco on sanphammausac.kichco=kichco.id
		where sanphammausac.url='$url'";
		
		$result = $this->db->select($query);
		return $result;
	}
	public function get_sptrungbyUrlAndColor($url,$color){
		$query  ="
		SELECT sp.*,m.tenmau,k.tenkichco from sanphamkichco sp INNER JOIN mausac m on sp.mausac=m.id INNER JOIN kichco k on sp.kichco=k.id
		where sp.url='$url' and sp.mausac='$color' order by k.id desc";
		
		$result = $this->db->select($query);
		return $result;
	}

	public function get_1sptrungbyUrlAndColor($url,$color){
		$query  ="
		SELECT sp.*,m.tenmau,k.tenkichco from sanphamkichco sp INNER JOIN mausac m on sp.mausac=m.id INNER JOIN kichco k on sp.kichco=k.id
		where sp.url='$url' and sp.mausac='$color' order by k.id desc LIMIT 1";
		
		$result = $this->db->select($query);
		return $result;
	}

	public function get_1sptrung($id,$color){
		$query  ="
		SELECT sanphammausac.*,mausac.tenmau from sanphammausac INNER JOIN mausac on sanphammausac.mausac=mausac.id 
		where masp='$id' and mausac='$color'";
		
		$result = $this->db->select($query);
		return $result;
	}
	public function get_1sptrungbyUrl($url,$color,$size){
		$query  ="
		SELECT sp.*,m.tenmau,k.tenkichco from sanphamkichco sp INNER JOIN mausac m on sp.mausac=m.id INNER JOIN kichco k on sp.kichco=k.id
		where sp.url='$url' and sp.mausac='$color' and sp.kichco='$size'";
		
		$result = $this->db->select($query);
		return $result;
	}

}
?>