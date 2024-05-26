<?php 
class duyetclubapi{
	private $conn;

	public $id;
	public $iduser;
	public $idclub;
	public $duyet;
	public $status;
	public $tenclub;
	public $tennguoidung;
	public $trang;
	public $tung_trang;
	public $sp_tungtrang;
	public $filterstatus;

	public function __construct($db){
		$this->conn = $db;
	}

	public function read(){
		$query = "SELECT * FROM dangkyclub";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	public function readbypage() {
	    $this->tung_trang = ($this->trang - 1) * $this->sp_tungtrang;

	    // Truy vấn để lấy tổng số bản ghi
	    $countQuery = "SELECT COUNT(*) as total FROM dangkyclub WHERE 1=1 and status = :filterstatus";


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
	    $query = "SELECT clb.*, kh.ten as tennguoidung, c.ten as tenclub FROM dangkyclub clb inner join khachhang kh on clb.iduser=kh.id inner join club c on clb.idclub=c.id WHERE 1=1 and status = :filterstatus";


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
		$query = "UPDATE dangkyclub SET status=:status WHERE id=:id";
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
		$query = "DELETE FROM dangkyclub 
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
