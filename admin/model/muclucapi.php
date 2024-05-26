<?php 
class muclucapi{
	private $conn;

	public $id;
	public $tieude;
	public $url;
	public $noidung;
	public $thutu;
	public $dmid;
	public $spid;
	public $dmfilter;
	public $spfilter;
	public $trang;
	public $tung_trang;
	public $sp_tungtrang;

	public function __construct($db){
		$this->conn = $db;
	}

	public function readbypage() {
	    $this->tung_trang = ($this->trang - 1) * $this->sp_tungtrang;

	    // Truy vấn để lấy tổng số bản ghi
	    $countQuery = "SELECT COUNT(*) as total FROM mucluc WHERE 1=1";

	    if (!empty($this->search)) {
	        $countQuery .= " AND tieude LIKE :search";
	    }

	    if (!empty($this->dmfilter)) {
	        $countQuery .= " AND dmid = :dmfilter";
	    }

	    if (!empty($this->spfilter)) {
	        $countQuery .= " AND spid = :spfilter";
	    }

	    $stmtCount = $this->conn->prepare($countQuery);

	    if (!empty($this->search)) {
	        $searchParam = "%" . $this->search . "%";
	        $stmtCount->bindParam(':search', $searchParam, PDO::PARAM_STR);
	    }

	    if (!empty($this->dmfilter)) {
	        $stmtCount->bindParam(':dmfilter', $this->dmfilter, PDO::PARAM_INT);
	    }

	    if (!empty($this->spfilter)) {
	        $stmtCount->bindParam(':spfilter', $this->spfilter, PDO::PARAM_INT);
	    }

	    $stmtCount->execute();
	    $totalResult = $stmtCount->fetch(PDO::FETCH_ASSOC);
	    $total = $totalResult['total'];

	    // Truy vấn chính với giới hạn LIMIT
	    $query = "SELECT * FROM mucluc WHERE 1=1";

	    if (!empty($this->search)) {
	        $query .= " AND tieude LIKE :search";
	    }

	    if (!empty($this->dmfilter)) {
	        $query .= " AND dmid = :dmfilter";
	    }

	    if (!empty($this->spfilter)) {
	        $query .= " AND spid = :spfilter";
	    }

	    $query .= " ORDER BY thutu ASC";

	    $query .= " LIMIT :tungtrang, :sp_tungtrang";


	    $stmt = $this->conn->prepare($query);

	    $stmt->bindParam(':tungtrang', $this->tung_trang, PDO::PARAM_INT);
	    $stmt->bindParam(':sp_tungtrang', $this->sp_tungtrang, PDO::PARAM_INT);

	    if (!empty($this->search)) {
	        $searchParam = "%" . $this->search . "%";
	        $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
	    }

	    if (!empty($this->dmfilter)) {
	        $stmt->bindParam(':dmfilter', $this->dmfilter, PDO::PARAM_INT);
	    }

	    if (!empty($this->spfilter)) {
	        $stmt->bindParam(':spfilter', $this->spfilter, PDO::PARAM_INT);
	    }

	    if (!empty($this->dmfilter)) {
	        $querydm = "SELECT tendm FROM danhmuc where madm = :dmfilter";
			$stmtdm = $this->conn->prepare($querydm);
			$stmtdm->bindParam(':dmfilter', $this->dmfilter, PDO::PARAM_INT);
			$stmtdm->execute();
			$rowdm = $stmtdm->fetch(PDO::FETCH_ASSOC);
			$thuoctieude = $rowdm['tendm'];
	    }

	    if (!empty($this->spfilter)) {
	        $querysp = "SELECT tieude FROM sanpham where id = :spfilter";
			$stmtsp = $this->conn->prepare($querysp);
			$stmtsp->bindParam(':spfilter', $this->spfilter, PDO::PARAM_INT);
			$stmtsp->execute();
			$rowsp = $stmtsp->fetch(PDO::FETCH_ASSOC);
			$thuoctieude = $rowsp['tieude'];
	    }

	    $stmt->execute();

	    return array(
	    	'thuoctieude' => $thuoctieude,
	        'total' => $total,
	        'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
	    );
	}

	public function show(){
		$query = "SELECT * FROM mucluc where id=? limit 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row['id'];	
		$this->tieude = $row['tieude'];
		$this->noidung = $row['noidung'];
		$this->thutu = $row['thutu'];
		$this->spid = $row['spid'];
		$this->dmid = $row['dmid'];
		$this->url = $row['url'];
	}

	public function create(){
		$query = "INSERT INTO mucluc SET tieude=:tieude, noidung=:noidung, thutu=:thutu, spid=:spid, dmid=:dmid, url=:url";
		$stmt = $this->conn->prepare($query);

		$this->tieude = $this->tieude;
		$this->noidung = $this->noidung;
		$this->thutu = $this->thutu;
		$this->spid = $this->spid;
		$this->dmid = $this->dmid;
		$this->url = $this->url;

		$stmt->bindParam(':tieude',$this->tieude);
		$stmt->bindParam(':noidung',$this->noidung);
		$stmt->bindParam(':thutu',$this->thutu);
		$stmt->bindParam(':spid',$this->spid);
		$stmt->bindParam(':dmid',$this->dmid);
		$stmt->bindParam(':url',$this->url);
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}

	public function update(){
		$query = "UPDATE mucluc SET tieude=:tieude, noidung=:noidung, thutu=:thutu, url=:url where id=:id";
		$stmt = $this->conn->prepare($query);

		$this->tieude = $this->tieude;
		$this->noidung = $this->noidung;
		$this->thutu = $this->thutu;
		$this->url = $this->url;
		$this->id = $this->id;

		$stmt->bindParam(':tieude',$this->tieude);
		$stmt->bindParam(':noidung',$this->noidung);
		$stmt->bindParam(':thutu',$this->thutu);
		$stmt->bindParam(':url',$this->url);
		$stmt->bindParam(':id',$this->id);
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}

	public function delete(){
		$query = "DELETE FROM mucluc 
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
