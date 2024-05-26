<?php 
class Danhmuctintuc{
	private $conn;

	public $madm;
	public $tendm;
	public $hienthi;
	public $uutien;
	public $kieuhienthi;
	public $title;
	public $description;
	public $url;
	public $keywords;
	public $trang;
	public $tung_trang;
	public $sp_tungtrang;

	public function __construct($db){
		$this->conn = $db;
	}

	public function read(){
		$query = "SELECT * FROM danhmuc where kieuhienthi='3'";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	public function readbypage() {
	    $this->tung_trang = ($this->trang - 1) * $this->sp_tungtrang;

	    // Truy vấn để lấy tổng số bản ghi
	    $countQuery = "SELECT COUNT(*) as total FROM danhmuc WHERE kieuhienthi = '3' AND hienthi=:hienthi";

	    if (!empty($this->search)) {
	        $countQuery .= " AND tendm LIKE :search";
	    }

	    $stmtCount = $this->conn->prepare($countQuery);
	    $stmtCount->bindParam(':hienthi', $this->hienthi, PDO::PARAM_INT);

	    if (!empty($this->search)) {
	        $searchParam = "%" . $this->search . "%";
	        $stmtCount->bindParam(':search', $searchParam, PDO::PARAM_STR);
	    }

	    $stmtCount->execute();
	    $totalResult = $stmtCount->fetch(PDO::FETCH_ASSOC);
	    $total = $totalResult['total'];

	    // Truy vấn chính với giới hạn LIMIT
	    $query = "SELECT * FROM danhmuc WHERE kieuhienthi = '3' AND hienthi=:hienthi";

	    if (!empty($this->search)) {
	        $query .= " AND tendm LIKE :search";
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

	    $stmt->execute();

	    return array(
	        'total' => $total,
	        'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
	    );
	}

	public function create(){
		$query = "INSERT INTO danhmuc SET tendm=:tendm, hienthi=:hienthi, uutien=:uutien, kieuhienthi=:kieuhienthi, title=:title, description=:description, url=:url, keywords=:keywords";
		$stmt = $this->conn->prepare($query);

		$this->tendm = $this->tendm;
		$this->hienthi = $this->hienthi;
		$this->uutien = $this->uutien;
		$this->kieuhienthi = $this->kieuhienthi;
		$this->title = $this->title;
		$this->description = $this->description;
		$this->url = $this->url;
		$this->keywords = $this->keywords;

		$this->hienthi = isset($this->hienthi) ? $this->hienthi : '0';
		$this->kieuhienthi = '3';

		$stmt->bindParam(':tendm',$this->tendm);
		$stmt->bindParam(':hienthi',$this->hienthi);
		$stmt->bindParam(':uutien',$this->uutien);
		$stmt->bindParam(':kieuhienthi',$this->kieuhienthi);
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
		$query = "UPDATE danhmuc SET tendm=:tendm, hienthi=:hienthi, uutien=:uutien, title=:title, description=:description, url=:url, keywords=:keywords WHERE madm=:madm";
		$stmt = $this->conn->prepare($query);

		$this->tendm = $this->tendm;
		$this->hienthi = $this->hienthi;
		$this->uutien = $this->uutien;
		$this->title = $this->title;
		$this->description = $this->description;
		$this->url = $this->url;
		$this->keywords = $this->keywords;
		$this->madm = $this->madm;


		$stmt->bindParam(':tendm',$this->tendm);
		$stmt->bindParam(':hienthi',$this->hienthi);
		$stmt->bindParam(':uutien',$this->uutien);
		$stmt->bindParam(':title',$this->title);
		$stmt->bindParam(':description',$this->description);
		$stmt->bindParam(':url',$this->url);
		$stmt->bindParam(':keywords',$this->keywords);
		$stmt->bindParam(':madm',$this->madm);
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}

}	
 ?>
