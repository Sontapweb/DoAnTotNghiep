<?php 
class productsizeapi{
	private $conn;

	public $id;
	public $masp;
	public $tensp;	
	public $gia;
	public $giakm;
	public $hinhanh;	
	public $hienthi;
	public $uutien;
	public $soluong;
	public $mausac;
	public $kichco;
	public $url;
	public $thoigian;
	public $filtersanpham;
	public $filtercolor;
	public $tenmau;
	public $tenkichco;
	public $trang;
	public $tung_trang;
	public $sp_tungtrang;

	public function __construct($db){
		$this->conn = $db;
	}

	public function read(){
		$query = "SELECT * FROM sanphamkichco";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	public function readbypage() {
	    $this->tung_trang = ($this->trang - 1) * $this->sp_tungtrang;

	    // Truy vấn để lấy tổng số bản ghi
	    $countQuery = "SELECT COUNT(*) as total FROM sanphamkichco WHERE hienthi=:hienthi AND masp = :filtersanpham and mausac=:filtercolor";

	    if (!empty($this->search)) {
	        $countQuery .= " AND tensp LIKE :search";
	    }

	    $stmtCount = $this->conn->prepare($countQuery);
	    $stmtCount->bindParam(':hienthi', $this->hienthi, PDO::PARAM_INT);
	    $stmtCount->bindParam(':filtersanpham', $this->filtersanpham, PDO::PARAM_STR);
	    $stmtCount->bindParam(':filtercolor', $this->filtercolor, PDO::PARAM_INT);

	    if (!empty($this->search)) {
	        $searchParam = "%" . $this->search . "%";
	        $stmtCount->bindParam(':search', $searchParam, PDO::PARAM_STR);
	    }	        

	    $stmtCount->execute();
	    $totalResult = $stmtCount->fetch(PDO::FETCH_ASSOC);
	    $total = $totalResult['total'];

	    // Truy vấn chính với giới hạn LIMIT
	    $query = "SELECT spt.*,ms.tenmau,kt.tenkichco FROM sanphamkichco spt inner join mausac ms on spt.mausac=ms.id inner join kichco kt on spt.kichco=kt.id WHERE spt.hienthi=:hienthi AND spt.masp = :filtersanpham AND spt.mausac=:filtercolor";

	    if (!empty($this->search)) {
	        $query .= " AND spt.tensp LIKE :search";
	    }

	    $query .= " LIMIT :tungtrang, :sp_tungtrang";

	    $stmt = $this->conn->prepare($query);

	    $stmt->bindParam(':tungtrang', $this->tung_trang, PDO::PARAM_INT);
	    $stmt->bindParam(':sp_tungtrang', $this->sp_tungtrang, PDO::PARAM_INT);
	    $stmt->bindParam(':hienthi', $this->hienthi, PDO::PARAM_INT);

	    if (!empty($this->search)) {
	        $searchParam = "%" . $this->search . "%";
	        $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
	    }

	    $stmt->bindParam(':filtersanpham', $this->filtersanpham, PDO::PARAM_STR);
	    $stmt->bindParam(':filtercolor', $this->filtercolor, PDO::PARAM_INT);

	    $stmt->execute();

	    return array(
	        'total' => $total,
	        'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
	    );
	}

	public function show(){
		$query = "SELECT * FROM sanphamkichco where id=? limit 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->masp = $row['masp'];	
		$this->tensp = $row['tensp'];
		$this->gia = $row['gia'];
		$this->giakm = $row['giakm'];
		$this->uutien = $row['uutien'];
		$this->hinhanh = $row['hinhanh'];
		$this->mausac = $row['mausac'];
		$this->kichco = $row['kichco'];
		$this->hienthi = $row['hienthi'];
		$this->thoigian = $row['thoigian'];		
		$this->soluong = $row['soluong'];	
		$this->url = $row['url'];
		$this->id = $row['id'];
	}

	public function isURLExists($url,$color,$size) {
	    $query = "SELECT COUNT(*) as count FROM sanphamkichco WHERE url = :url AND mausac = :color AND kichco = :size ";
	    $stmt = $this->conn->prepare($query);
	    $stmt->bindParam(':url', $url);
	    $stmt->bindParam(':color', $color);
	    $stmt->bindParam(':size', $size);
	    $stmt->execute();
	    $row = $stmt->fetch(PDO::FETCH_ASSOC);
	    return $row['count'] > 0;
	}

	public function create(){
		if ($this->isURLExists($this->url,$this->mausac,$this->kichco)) {
	        printf("Error: Đã tồn tại.\n");
	        return false;
	    }
		$query = "INSERT INTO sanphamkichco SET masp=:masp, tensp=:tensp, hinhanh=:hinhanh, gia=:gia, giakm=:giakm, mausac=:mausac, kichco=:kichco, uutien=:uutien, soluong=:soluong, thoigian=:thoigian, hienthi=:hienthi, url=:url";
		$stmt = $this->conn->prepare($query);

		$this->masp = $this->masp;
		$this->tensp = $this->tensp;
		$this->gia = $this->gia;		
		$this->giakm = $this->giakm;
		$this->mausac = $this->mausac;		
		$this->kichco = $this->kichco;
		$this->uutien = $this->uutien;
		$this->soluong = $this->soluong;	
		$this->hinhanh = $this->hinhanh;	
		$this->hienthi = $this->hienthi;
		$this->thoigian = $this->thoigian;
		$this->url = $this->url;

		$this->hienthi = isset($this->hienthi) ? $this->hienthi : '0';

		$stmt->bindParam(':masp',$this->masp);
		$stmt->bindParam(':tensp',$this->tensp);
		$stmt->bindParam(':gia',$this->gia);
		$stmt->bindParam(':giakm',$this->giakm);
		$stmt->bindParam(':mausac',$this->mausac);
		$stmt->bindParam(':kichco',$this->kichco);
		$stmt->bindParam(':uutien',$this->uutien);
		$stmt->bindParam(':soluong',$this->soluong);		
		$stmt->bindParam(':hinhanh',$this->hinhanh);
		$stmt->bindParam(':hienthi',$this->hienthi);	
		$stmt->bindParam(':thoigian',$this->thoigian);
		$stmt->bindParam(':url',$this->url);
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}

	public function update(){  
	    $query = "UPDATE sanphamkichco SET gia=:gia, giakm=:giakm, mausac=:mausac, kichco=:kichco, uutien=:uutien, soluong=:soluong, thoigian=:thoigian, hienthi=:hienthi WHERE id=:id";

	    $stmt = $this->conn->prepare($query);

		$this->gia = $this->gia;		
		$this->giakm = $this->giakm;
		$this->mausac = $this->mausac;		
		$this->kichco = $this->kichco;
		$this->uutien = $this->uutien;
		$this->soluong = $this->soluong;			
		$this->hienthi = $this->hienthi;
		$this->thoigian = $this->thoigian;
		$this->id = $this->id;	

		$stmt->bindParam(':gia',$this->gia);
		$stmt->bindParam(':giakm',$this->giakm);
		$stmt->bindParam(':mausac',$this->mausac);
		$stmt->bindParam(':kichco',$this->kichco);
		$stmt->bindParam(':uutien',$this->uutien);
		$stmt->bindParam(':soluong',$this->soluong);				
		$stmt->bindParam(':hienthi',$this->hienthi);	
		$stmt->bindParam(':thoigian',$this->thoigian);	
		$stmt->bindParam(':id',$this->id);

	    if ($stmt->execute()) {
	        return true;
	    }

	    printf("Error %s.\n", $stmt->error);
	    return false;
	}
	public function delete(){
		$query = "DELETE FROM sanphamkichco 
		WHERE id=:id";
		$stmt = $this->conn->prepare($query);

		$this->id = $this->id;

		$stmt->bindParam(':id',$this->id);
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}
	public function updatestatus(){
		$query = "UPDATE sanphamkichco SET hienthi=:hienthi WHERE id=:id";
		$stmt = $this->conn->prepare($query);

		$this->hienthi = $this->hienthi;
		$this->id = $this->id;


		$stmt->bindParam(':hienthi',$this->hienthi);
		$stmt->bindParam(':id',$this->id);
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}

}	
 ?>
