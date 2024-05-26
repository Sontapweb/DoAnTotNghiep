<?php 
class donhangapi{
	private $conn;

	public $orderid;
	public $masp;
	public $tensp;
	public $makh;
	public $soluong;
	public $gia;
	public $hinhanh;
	public $ngaydathang;
	public $trangthai;
	public $sId;
	public $hoten;
	public $sdt;
	public $diachi;
	public $mausac;
	public $kichco;
	public $tenmau;
	public $tenkichco;
	public $trang;
	public $tung_trang;
	public $sp_tungtrang;
	public $filterstatus;

	public function __construct($db){
		$this->conn = $db;
	}

	public function read(){
		$query = "SELECT * FROM donhang";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	public function readbypage() {
	    $this->tung_trang = ($this->trang - 1) * $this->sp_tungtrang;

	    // Truy vấn để lấy tổng số bản ghi
	    $countQuery = "SELECT COUNT(*) as total FROM dathang WHERE 1=1 and trangthai = :filterstatus";

	    if (!empty($this->search)) {
	        $countQuery .= " AND hoten LIKE :search";
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
	    $query = "SELECT d.*,m.tenmau,k.tenkichco FROM dathang d INNER JOIN mausac m on d.mausac=m.id INNER JOIN kichco k on d.kichco=k.id WHERE 1=1 and d.trangthai = :filterstatus";

	    if (!empty($this->search)) {
	        $query .= " AND d.hoten LIKE :search";
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
		$query = "UPDATE dathang SET trangthai=:trangthai WHERE orderid=:orderid";
		$stmt = $this->conn->prepare($query);

		$this->trangthai = $this->trangthai;
		$this->orderid = $this->orderid;


		$stmt->bindParam(':trangthai',$this->trangthai);
		$stmt->bindParam(':orderid',$this->orderid);
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}
	public function delete(){
		$query = "DELETE FROM dathang 
		WHERE orderid=:orderid";
		$stmt = $this->conn->prepare($query);

		$this->orderid = htmlspecialchars(strip_tags($this->orderid));

		$stmt->bindParam(':orderid',$this->orderid);
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}

}	
 ?>
