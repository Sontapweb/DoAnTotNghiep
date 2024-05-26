<?php 
class sliderapi{
	private $conn;

	public $id;
	public $ten;
	public $noidung;
	public $xemthem;
	public $status;
	public $uutien;
	public $hinhanh;
	public $trang;
	public $tung_trang;
	public $sp_tungtrang;
	public $search;

	public function __construct($db){
		$this->conn = $db;
	}

	public function read(){
		$query = "SELECT * FROM slider order by uutien desc";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	public function readbypage() {
	    $this->tung_trang = ($this->trang - 1) * $this->sp_tungtrang;

	    // Truy vấn để lấy tổng số bản ghi
	    $countQuery = "SELECT COUNT(*) as total FROM slider WHERE 1 = 1 AND status=:hienthi";

	    if (!empty($this->search)) {
	        $countQuery .= " AND tendm LIKE :search";
	    }

	    $stmtCount = $this->conn->prepare($countQuery);
	    $stmtCount->bindParam(':hienthi', $this->status, PDO::PARAM_INT);

	    if (!empty($this->search)) {
	        $searchParam = "%" . $this->search . "%";
	        $stmtCount->bindParam(':search', $searchParam, PDO::PARAM_STR);
	    }

	    $stmtCount->execute();
	    $totalResult = $stmtCount->fetch(PDO::FETCH_ASSOC);
	    $total = $totalResult['total'];

	    // Truy vấn chính với giới hạn LIMIT
	    $query = "SELECT * FROM slider WHERE 1 = 1 AND status=:hienthi";

	    if (!empty($this->search)) {
	        $query .= " AND tendm LIKE :search";
	    }

	    $query .= " LIMIT :tungtrang, :sp_tungtrang";

	    $stmt = $this->conn->prepare($query);

	    $stmt->bindParam(':tungtrang', $this->tung_trang, PDO::PARAM_INT);
	    $stmt->bindParam(':sp_tungtrang', $this->sp_tungtrang, PDO::PARAM_INT);
	    $stmt->bindParam(':hienthi', $this->status, PDO::PARAM_INT);

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
		$query = "SELECT * FROM slider where id=? limit 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row['id'];	
		$this->ten = $row['ten'];
		$this->noidung = $row['noidung'];
		$this->xemthem = $row['xemthem'];
		$this->uutien = $row['uutien'];	
		$this->hinhanh = $row['hinhanh'];
		$this->status = $row['status'];
	}

	public function create(){
		$query = "INSERT INTO slider SET ten=:ten, noidung=:noidung, xemthem=:xemthem, uutien=:uutien, status=:status, hinhanh=:hinhanh";
		$stmt = $this->conn->prepare($query);

		$this->ten = $this->ten;
		$this->noidung = $this->noidung;
		$this->xemthem = $this->xemthem;
		$this->status = $this->status;
		$this->uutien = $this->uutien;
		$this->hinhanh = $this->hinhanh;

		$this->status = isset($this->status) ? $this->status : '0';

		$stmt->bindParam(':ten',$this->ten);
		$stmt->bindParam(':noidung',$this->noidung);
		$stmt->bindParam(':xemthem',$this->xemthem);	
		$stmt->bindParam(':status',$this->status);
		$stmt->bindParam(':uutien',$this->uutien);
		$stmt->bindParam(':hinhanh',$this->hinhanh);
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}

	public function update(){  
	    $query = "UPDATE slider SET 
	        ten=:ten, 
	        noidung=:noidung, 
	        xemthem=:xemthem, 
	        uutien=:uutien,  
	        status=:status ";

	    if (isset($this->hinhanh) && $this->hinhanh != "undefined") {
	        $query .= ", hinhanh=:hinhanh";
	    }

	    $query .= " WHERE id=:id";

	    $stmt = $this->conn->prepare($query);

	    $this->ten = $this->ten;
		$this->noidung = $this->noidung;
		$this->xemthem = $this->xemthem;
		$this->uutien = $this->uutien;				
		$this->status = $this->status;		
		$this->id = $this->id;

		$stmt->bindParam(':ten',$this->ten);
		$stmt->bindParam(':noidung',$this->noidung);
		$stmt->bindParam(':xemthem',$this->xemthem);	
		$stmt->bindParam(':status',$this->status);
		$stmt->bindParam(':uutien',$this->uutien);
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
		$query = "DELETE FROM slider 
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

}	
 ?>
