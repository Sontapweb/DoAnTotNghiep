<?php 
class lienheapi{
	private $conn;

	public $id;
	public $ten;
	public $sdt;
	public $email;
	public $chude;
	public $thoigian;
	public $status;
	public $trang;
	public $tung_trang;
	public $sp_tungtrang;
	public $filterstatus;

	public function __construct($db){
		$this->conn = $db;
	}

	public function read(){
		$query = "SELECT * FROM lienhe";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	public function readbypage() {
	    $this->tung_trang = ($this->trang - 1) * $this->sp_tungtrang;

	    // Truy vấn để lấy tổng số bản ghi
	    $countQuery = "SELECT COUNT(*) as total FROM lienhe WHERE 1=1 and status = :filterstatus";

	    if (!empty($this->search)) {
	        $countQuery .= " AND ten LIKE :search";
	    }

	    $stmtCount = $this->conn->prepare($countQuery);

	    if (!empty($this->search)) {
	        $searchParam = "%" . $this->search . "%";
	        $stmtCount->bindParam(':search', $searchParam, PDO::PARAM_STR);
	    }

	    $stmtCount->bindParam(':filterstatus', $this->filterstatus, PDO::PARAM_INT);

	    $stmtCount->execute();
	    $totalResult = $stmtCount->fetch(PDO::FETCH_ASSOC);
	    $total = $totalResult['total'];

	    // Truy vấn chính với giới hạn LIMIT
	    $query = "SELECT * FROM lienhe WHERE 1=1 and status = :filterstatus";

	    if (!empty($this->search)) {
	        $query .= " AND ten LIKE :search";
	    }

	    $query .= " LIMIT :tungtrang, :sp_tungtrang";

	    $stmt = $this->conn->prepare($query);

	    $stmt->bindParam(':tungtrang', $this->tung_trang, PDO::PARAM_INT);
	    $stmt->bindParam(':sp_tungtrang', $this->sp_tungtrang, PDO::PARAM_INT);

	    if (!empty($this->search)) {
	        $searchParam = "%" . $this->search . "%";
	        $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
	    }

	    $stmt->bindParam(':filterstatus', $this->filterstatus, PDO::PARAM_INT);

	    $stmt->execute();

	    return array(
	        'total' => $total,
	        'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
	    );
	}

	public function update(){
		$query = "UPDATE lienhe SET status=:status WHERE id=:id";
		$stmt = $this->conn->prepare($query);

		$this->status = $this->status;
		$this->id = $this->id;


		$stmt->bindParam(':status',$this->status);
		$stmt->bindParam(':id',$this->id);
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}
	public function delete(){
		$query = "DELETE FROM lienhe 
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
