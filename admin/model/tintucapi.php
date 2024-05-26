<?php 
class tintucapi{
	private $conn;

	public $id;
	public $tieude;
	public $mota;
	public $noidung;
	public $danhmuc;
	public $hinhanh;
	public $thoigian;
	public $hienthi;
	public $uutien;
	public $luotxem;
	public $title;
	public $description;
	public $url;
	public $keywords;
	public $trang;
	public $tung_trang;
	public $sp_tungtrang;
	public $filterdanhmuc;
	public $tendanhmuc;

	public function __construct($db){
		$this->conn = $db;
	}

	public function read(){
		$query = "SELECT * FROM tintuc";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	public function readbypage() {
	    $this->tung_trang = ($this->trang - 1) * $this->sp_tungtrang;

	    // Truy vấn để lấy tổng số bản ghi
	    $countQuery = "SELECT COUNT(*) as total FROM tintuc WHERE hienthi=:hienthi";

	    if (!empty($this->search)) {
	        $countQuery .= " AND tieude LIKE :search";
	    }

	    if (!empty($this->filterdanhmuc)) {
	        $countQuery .= " AND danhmuc = :filterdanhmuc";
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

	    $stmtCount->execute();
	    $totalResult = $stmtCount->fetch(PDO::FETCH_ASSOC);
	    $total = $totalResult['total'];

	    // Truy vấn chính với giới hạn LIMIT
	    $query = "SELECT sp.*,dm.tendm as tendanhmuc FROM tintuc sp inner join danhmuc dm on sp.danhmuc=dm.madm WHERE sp.hienthi=:hienthi";

	    if (!empty($this->search)) {
	        $query .= " AND sp.tieude LIKE :search";
	    }

	    if (!empty($this->filterdanhmuc)) {
	        $query .= " AND sp.danhmuc = :filterdanhmuc";
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

	    if (!empty($this->filterdanhmuc)) {
	        $stmt->bindParam(':filterdanhmuc', $this->filterdanhmuc, PDO::PARAM_INT);
	    }

	    $stmt->execute();

	    return array(
	        'total' => $total,
	        'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
	    );
	}

	public function show(){
		$query = "SELECT * FROM tintuc where id=? limit 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row['id'];	
		$this->tieude = $row['tieude'];
		$this->mota = $row['mota'];
		$this->noidung = $row['noidung'];	
		$this->danhmuc = $row['danhmuc'];
		$this->hinhanh = $row['hinhanh'];
		$this->hienthi = $row['hienthi'];
		$this->thoigian = $row['thoigian'];
		$this->luotxem = $row['luotxem'];
		$this->uutien = $row['uutien'];
		$this->title = $row['title'];
		$this->description = $row['description'];
		$this->url = $row['url'];
		$this->keywords = $row['keywords'];
	}

	public function create(){
		$query = "INSERT INTO tintuc SET tieude=:tieude, mota=:mota, noidung=:noidung, thoigian=:thoigian,  uutien=:uutien, danhmuc=:danhmuc, luotxem=:luotxem, hienthi=:hienthi, hinhanh=:hinhanh, title=:title, description=:description, url=:url, keywords=:keywords";
		$stmt = $this->conn->prepare($query);

		$this->tieude = $this->tieude;
		$this->mota = $this->mota;
		$this->noidung = $this->noidung;
		$this->danhmuc = $this->danhmuc;
		$this->thoigian = $this->thoigian;
		$this->luotxem = $this->luotxem;
		$this->hinhanh = $this->hinhanh;
		$this->hienthi = $this->hienthi;
		$this->uutien = $this->uutien;
		$this->title = $this->title;
		$this->description = $this->description;
		$this->url = $this->url;
		$this->keywords = $this->keywords;

		$this->hienthi = isset($this->hienthi) ? $this->hienthi : '0';

		$stmt->bindParam(':tieude',$this->tieude);
		$stmt->bindParam(':mota',$this->mota);
		$stmt->bindParam(':noidung',$this->noidung);
		$stmt->bindParam(':danhmuc',$this->danhmuc);
		$stmt->bindParam(':thoigian',$this->thoigian);	
		$stmt->bindParam(':luotxem',$this->luotxem);
		$stmt->bindParam(':hinhanh',$this->hinhanh);	
		$stmt->bindParam(':hienthi',$this->hienthi);
		$stmt->bindParam(':uutien',$this->uutien);
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
	    $query = "UPDATE tintuc SET 
	        tieude=:tieude, 
	        mota=:mota, 
	        noidung=:noidung, 
	        thoigian=:thoigian,  
	        uutien=:uutien, 
	        danhmuc=:danhmuc, 
	        luotxem=:luotxem, 
	        hienthi=:hienthi,  
	        title=:title, 
	        description=:description, 
	        url=:url, 
	        keywords=:keywords";

	    if (isset($this->hinhanh) && $this->hinhanh != "undefined") {
	        $query .= ", hinhanh=:hinhanh";
	    }

	    $query .= " WHERE id=:id";

	    $stmt = $this->conn->prepare($query);

	    $this->tieude = $this->tieude;
		$this->mota = $this->mota;
		$this->noidung = $this->noidung;
		$this->thoigian = $this->thoigian;
		$this->uutien = $this->uutien;
		$this->danhmuc = $this->danhmuc;		
		$this->luotxem = $this->luotxem;				
		$this->hienthi = $this->hienthi;		
		$this->title = $this->title;
		$this->description = $this->description;
		$this->url = $this->url;
		$this->keywords = $this->keywords;
		$this->id = $this->id;

		$stmt->bindParam(':tieude',$this->tieude);
		$stmt->bindParam(':mota',$this->mota);
		$stmt->bindParam(':noidung',$this->noidung);
		$stmt->bindParam(':danhmuc',$this->danhmuc);
		$stmt->bindParam(':thoigian',$this->thoigian);	
		$stmt->bindParam(':luotxem',$this->luotxem);	
		$stmt->bindParam(':hienthi',$this->hienthi);
		$stmt->bindParam(':uutien',$this->uutien);
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
		$query = "DELETE FROM tintuc 
		WHERE id=:id";
		$stmt = $this->conn->prepare($query);

		$this->id = htmlspecialchars(strip_tags($this->id));

		$stmt->bindParam(':id',$this->id);
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}
	public function updatestatus(){
		$query = "UPDATE tintuc SET hienthi=:hienthi WHERE id=:id";
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
