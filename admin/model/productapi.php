<?php 
class productapi{
	private $conn;

	public $masp;
	public $id;
	public $tensp;	
	public $danhmuc;
	public $tendanhmuc;
	public $thuonghieu;
	public $tenthuonghieu;
	public $gia;
	public $giakm;
	public $uutien;
	public $loai;
	public $hinhanh;	
	public $hienthi;
	public $thoigian;
	public $thongtin;
	public $mausac;
	public $sanpham;
	public $kichco;
	public $title;
	public $description;
	public $url;
	public $keywords;
	public $soluong;
	public $trang;
	public $tung_trang;
	public $sp_tungtrang;
	public $filterdanhmuc;
	public $filterthuonghieu;

	public function __construct($db){
		$this->conn = $db;
	}

	public function read(){
		$query = "SELECT * FROM sanpham";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	public function readbypage() {
	    $this->tung_trang = ($this->trang - 1) * $this->sp_tungtrang;

	    // Truy vấn để lấy tổng số bản ghi
	    $countQuery = "SELECT COUNT(*) as total FROM sanpham WHERE hienthi=:hienthi";

	    if (!empty($this->search)) {
	        $countQuery .= " AND tensp LIKE :search";
	    }

	    if (!empty($this->filterdanhmuc)) {
	        $countQuery .= " AND danhmuc = :filterdanhmuc";
	    }

	    if (!empty($this->filterthuonghieu)) {
	        $countQuery .= " AND thuonghieu = :filterthuonghieu";
	    }

	    $stmtCount = $this->conn->prepare($countQuery);
	    $stmtCount->bindParam(':hienthi', $this->hienthi, PDO::PARAM_INT);

	    if (!empty($this->search)) {
	        $searchParam = "%" . $this->search . "%";
	        $stmtCount->bindParam(':search', $searchParam, PDO::PARAM_STR);
	    }

	    if (!empty($this->filterdanhmuc)) {
	        $stmtCount->bindParam(':filterdanhmuc', $this->filterdanhmuc, PDO::PARAM_INT);
	    }

	    if (!empty($this->filterthuonghieu)) {
	        $stmtCount->bindParam(':filterthuonghieu', $this->filterthuonghieu, PDO::PARAM_INT);
	    }

	    $stmtCount->execute();
	    $totalResult = $stmtCount->fetch(PDO::FETCH_ASSOC);
	    $total = $totalResult['total'];

	    // Truy vấn chính với giới hạn LIMIT
	    $query = "SELECT sp.*,dm.tendm as tendanhmuc,th.tenth as tenthuonghieu FROM sanpham sp inner join danhmuc dm on sp.danhmuc=dm.madm inner join thuonghieu th on sp.thuonghieu=th.math WHERE sp.hienthi=:hienthi";

	    if (!empty($this->search)) {
	        $query .= " AND sp.tensp LIKE :search";
	    }

	    if (!empty($this->filterdanhmuc)) {
	        $query .= " AND sp.danhmuc = :filterdanhmuc";
	    }

	    if (!empty($this->filterthuonghieu)) {
	        $query .= " AND sp.thuonghieu = :filterthuonghieu";
	    }

	    $query .= " ORDER BY sp.thoigian desc";

	    $query .= " LIMIT :tungtrang, :sp_tungtrang";

	    $stmt = $this->conn->prepare($query);

	    $stmt->bindParam(':tungtrang', $this->tung_trang, PDO::PARAM_INT);
	    $stmt->bindParam(':sp_tungtrang', $this->sp_tungtrang, PDO::PARAM_INT);
	    $stmt->bindParam(':hienthi', $this->hienthi, PDO::PARAM_INT);

	    if (!empty($this->search)) {
	        $searchParam = "%" . $this->search . "%";
	        $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
	    }

	    if (!empty($this->filterdanhmuc)) {
	        $stmt->bindParam(':filterdanhmuc', $this->filterdanhmuc, PDO::PARAM_INT);
	    }

	    if (!empty($this->filterthuonghieu)) {
	        $stmt->bindParam(':filterthuonghieu', $this->filterthuonghieu, PDO::PARAM_INT);
	    }

	    $stmt->execute();

	    return array(
	        'total' => $total,
	        'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
	    );
	}

	public function show(){
		$query = "SELECT * FROM sanpham where masp=? limit 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->masp);
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->masp = $row['masp'];	
		$this->tensp = $row['tensp'];
		$this->danhmuc = $row['danhmuc'];		
		$this->thuonghieu = $row['thuonghieu'];
		$this->gia = $row['gia'];
		$this->giakm = $row['giakm'];
		$this->uutien = $row['uutien'];
		$this->hinhanh = $row['hinhanh'];
		$this->loai = $row['loai'];
		$this->mausac = $row['mausac'];
		$this->kichco = $row['kichco'];
		$this->hienthi = $row['hienthi'];
		$this->thoigian = $row['thoigian'];		
		$this->thongtin = $row['thongtin'];	
		$this->title = $row['title'];
		$this->description = $row['description'];
		$this->url = $row['url'];
		$this->keywords = $row['keywords'];
		$this->id = $row['id'];
	}

	public function isURLExists($url) {
	    $query = "SELECT COUNT(*) as count FROM sanpham WHERE url = :url";
	    $stmt = $this->conn->prepare($query);
	    $stmt->bindParam(':url', $url);
	    $stmt->execute();
	    $row = $stmt->fetch(PDO::FETCH_ASSOC);
	    return $row['count'] > 0;
	}

	public function create(){
		if ($this->isURLExists($this->url)) {
	        printf("Error: Đã tồn tại.\n");
	        return false;
	    }
		$query = "INSERT INTO sanpham SET id=:id,masp=:masp, tensp=:tensp, danhmuc=:danhmuc, thuonghieu=:thuonghieu, hinhanh=:hinhanh, gia=:gia, giakm=:giakm, mausac=:mausac, kichco=:kichco, uutien=:uutien, thongtin=:thongtin, loai=:loai, thoigian=:thoigian, hienthi=:hienthi, title=:title, description=:description, url=:url, keywords=:keywords";
		$stmt = $this->conn->prepare($query);

		$this->id = $this->id;
		$this->masp = $this->masp;
		$this->tensp = $this->tensp;
		$this->danhmuc = $this->danhmuc;
		$this->thuonghieu = $this->thuonghieu;
		$this->gia = $this->gia;		
		$this->giakm = $this->giakm;
		$this->mausac = $this->mausac;		
		$this->kichco = $this->kichco;
		$this->uutien = $this->uutien;
		$this->thongtin = $this->thongtin;
		$this->loai = $this->loai;		
		$this->hinhanh = $this->hinhanh;	
		$this->hienthi = $this->hienthi;
		$this->thoigian = $this->thoigian;
		$this->title = $this->title;
		$this->description = $this->description;
		$this->url = $this->url;
		$this->keywords = $this->keywords;

		$this->hienthi = isset($this->hienthi) ? $this->hienthi : '0';

		$stmt->bindParam(':id',$this->id);
		$stmt->bindParam(':masp',$this->masp);
		$stmt->bindParam(':tensp',$this->tensp);
		$stmt->bindParam(':danhmuc',$this->danhmuc);
		$stmt->bindParam(':thuonghieu',$this->thuonghieu);
		$stmt->bindParam(':gia',$this->gia);
		$stmt->bindParam(':giakm',$this->giakm);
		$stmt->bindParam(':mausac',$this->mausac);
		$stmt->bindParam(':kichco',$this->kichco);
		$stmt->bindParam(':uutien',$this->uutien);
		$stmt->bindParam(':thongtin',$this->thongtin);		
		$stmt->bindParam(':hinhanh',$this->hinhanh);
		$stmt->bindParam(':hienthi',$this->hienthi);	
		$stmt->bindParam(':loai',$this->loai);
		$stmt->bindParam(':thoigian',$this->thoigian);
		$stmt->bindParam(':title',$this->title);
		$stmt->bindParam(':description',$this->description);
		$stmt->bindParam(':url',$this->url);
		$stmt->bindParam(':keywords',$this->keywords);			

		if($stmt->execute()){
			return true;
		}


		printf("Error %s.\n" ,$stmt->error);
		return false;
	}

	public function update(){  
	    $query = "UPDATE sanpham SET id=:id, tensp=:tensp, danhmuc=:danhmuc, thuonghieu=:thuonghieu, gia=:gia, giakm=:giakm, mausac=:mausac, kichco=:kichco, uutien=:uutien, thongtin=:thongtin, loai=:loai, thoigian=:thoigian, hienthi=:hienthi, title=:title, description=:description, url=:url, keywords=:keywords";

	    if (isset($this->hinhanh) && $this->hinhanh != "undefined") {
	        $query .= ", hinhanh=:hinhanh";
	    }

	    $query .= " WHERE masp=:masp";
	    $stmt = $this->conn->prepare($query);

	    $this->masp = $this->masp;
		$this->tensp = $this->tensp;
		$this->danhmuc = $this->danhmuc;
		$this->thuonghieu = $this->thuonghieu;
		$this->gia = $this->gia;		
		$this->giakm = $this->giakm;
		$this->mausac = $this->mausac;		
		$this->kichco = $this->kichco;
		$this->uutien = $this->uutien;
		$this->thongtin = $this->thongtin;
		$this->loai = $this->loai;			
		$this->hienthi = $this->hienthi;
		$this->thoigian = $this->thoigian;
		$this->title = $this->title;
		$this->description = $this->description;
		$this->url = $this->url;
		$this->keywords = $this->keywords;
		$this->id = $this->id;

		$stmt->bindParam(':masp',$this->masp);
		$stmt->bindParam(':tensp',$this->tensp);
		$stmt->bindParam(':danhmuc',$this->danhmuc);
		$stmt->bindParam(':thuonghieu',$this->thuonghieu);
		$stmt->bindParam(':gia',$this->gia);
		$stmt->bindParam(':giakm',$this->giakm);
		$stmt->bindParam(':mausac',$this->mausac);
		$stmt->bindParam(':kichco',$this->kichco);
		$stmt->bindParam(':uutien',$this->uutien);
		$stmt->bindParam(':thongtin',$this->thongtin);		
		$stmt->bindParam(':hienthi',$this->hienthi);	
		$stmt->bindParam(':loai',$this->loai);
		$stmt->bindParam(':thoigian',$this->thoigian);
		$stmt->bindParam(':title',$this->title);
		$stmt->bindParam(':description',$this->description);
		$stmt->bindParam(':url',$this->url);
		$stmt->bindParam(':keywords',$this->keywords);	
		$stmt->bindParam(':id',$this->id);	

		if (isset($this->hinhanh) && $this->hinhanh != "undefined") {
	    	$this->hinhanh = $this->hinhanh;
	        $stmt->bindParam(':hinhanh', $this->hinhanh);
	    }

	    if ($stmt->execute()) {
	        return true;
	    }

	    printf("Error %s.\n", $stmt->error);
	    return false;
	}
	public function delete(){
		$query = "DELETE FROM sanpham WHERE masp=:masp";
		
		$stmt = $this->conn->prepare($query);

		$this->masp = $this->masp;

		$stmt->bindParam(':masp',$this->masp);
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}
	public function updatestatus(){
		$query = "UPDATE sanpham SET hienthi=:hienthi WHERE masp=:masp";
		$stmt = $this->conn->prepare($query);

		$this->hienthi = $this->hienthi;
		$this->masp = $this->masp;


		$stmt->bindParam(':hienthi',$this->hienthi);
		$stmt->bindParam(':masp',$this->masp);
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}
	public function updateproductcolor(){  
	    $query = "UPDATE sanphammausac SET tensp=:tensp, url=:url WHERE masp=:masp";
	    
	    $stmt = $this->conn->prepare($query);
		
		$this->tensp = $this->tensp;
		$this->url = $this->url;	
		$this->masp = $this->masp;	

		$stmt->bindParam(':tensp',$this->tensp);
		$stmt->bindParam(':url',$this->url);
		$stmt->bindParam(':masp',$this->masp);

	    if ($stmt->execute()) {
	        return true;
	    }

	    printf("Error %s.\n", $stmt->error);
	    return false;
	}
	public function updateproductsize(){  
	    $query = "UPDATE sanphamkichco SET tensp=:tensp, url=:url WHERE masp=:masp";
	    
	    $stmt = $this->conn->prepare($query);
		
		$this->tensp = $this->tensp;
		$this->url = $this->url;	
		$this->masp = $this->masp;	

		$stmt->bindParam(':tensp',$this->tensp);
		$stmt->bindParam(':url',$this->url);
		$stmt->bindParam(':masp',$this->masp);

	    if ($stmt->execute()) {
	        return true;
	    }

	    printf("Error %s.\n", $stmt->error);
	    return false;
	}

}	
 ?>
