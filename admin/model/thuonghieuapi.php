<?php 
class thuonghieuapi{
	private $conn;

	public $math;
	public $tenth;
	public $hienthi;
	public $uutien;
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
		$query = "SELECT * FROM thuonghieu";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	public function readbypage() {
	    $this->tung_trang = ($this->trang - 1) * $this->sp_tungtrang;

	    // Truy vấn để lấy tổng số bản ghi
	    $countQuery = "SELECT COUNT(*) as total FROM thuonghieu WHERE hienthi=:hienthi";

	    if (!empty($this->search)) {
	        $countQuery .= " AND tenth LIKE :search";
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
	    $query = "SELECT * FROM thuonghieu WHERE hienthi=:hienthi";

	    if (!empty($this->search)) {
	        $query .= " AND tenth LIKE :search";
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

	public function show(){
		$query = "SELECT * FROM thuonghieu where math=? limit 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->math);
		$stmt->execute();
		

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->math = $row['math'];	
		$this->tenth = $row['tenth'];
		$this->hienthi = $row['hienthi'];
		$this->uutien = $row['uutien'];
		$this->title = $row['title'];
		$this->description = $row['description'];
		$this->url = $row['url'];
		$this->keywords = $row['keywords'];
	}

	public function create(){
		$query = "INSERT INTO thuonghieu SET tenth=:tenth, hienthi=:hienthi, uutien=:uutien, title=:title, description=:description, url=:url, keywords=:keywords";
		$stmt = $this->conn->prepare($query);

		$this->tenth = $this->tenth;
		$this->hienthi = $this->hienthi;
		$this->uutien = $this->uutien;
		$this->title = $this->title;
		$this->description = $this->description;
		$this->url = $this->url;
		$this->keywords = $this->keywords;

		$this->hienthi = isset($this->hienthi) ? $this->hienthi : '0';

		$stmt->bindParam(':tenth',$this->tenth);
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
		$query = "UPDATE thuonghieu SET tenth=:tenth, hienthi=:hienthi, uutien=:uutien, title=:title, description=:description, url=:url, keywords=:keywords WHERE math=:math";
		$stmt = $this->conn->prepare($query);

		$this->tenth = $this->tenth;
		$this->hienthi = $this->hienthi;
		$this->uutien = $this->uutien;
		$this->title = $this->title;
		$this->description = $this->description;
		$this->url = $this->url;
		$this->keywords = $this->keywords;
		$this->math = $this->math;


		$stmt->bindParam(':tenth',$this->tenth);
		$stmt->bindParam(':hienthi',$this->hienthi);
		$stmt->bindParam(':uutien',$this->uutien);
		$stmt->bindParam(':title',$this->title);
		$stmt->bindParam(':description',$this->description);
		$stmt->bindParam(':url',$this->url);
		$stmt->bindParam(':keywords',$this->keywords);
		$stmt->bindParam(':math',$this->math);
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}

	public function delete(){
		$query = "DELETE FROM thuonghieu 
		WHERE math=:math";
		$stmt = $this->conn->prepare($query);

		$this->math = htmlspecialchars(strip_tags($this->math));

		$stmt->bindParam(':math',$this->math);
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}
	public function updatestatus(){
		$query = "UPDATE thuonghieu SET hienthi=:hienthi WHERE math=:math";
		$stmt = $this->conn->prepare($query);

		$this->hienthi = $this->hienthi;
		$this->math = $this->math;


		$stmt->bindParam(':hienthi',$this->hienthi);
		$stmt->bindParam(':math',$this->math);
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}


}	
 ?>
