<?php 
class muclucconapi{
	private $conn;

	public $id;
	public $tieude;
	public $url;
	public $noidung;
	public $thutu;
	public $mucluc_id;
	public $mlfilter;
	public $trang;
	public $tung_trang;
	public $sp_tungtrang;

	public function __construct($db){
		$this->conn = $db;
	}

	public function readbypage() {
	    $this->tung_trang = ($this->trang - 1) * $this->sp_tungtrang;

	    // Truy vấn để lấy tổng số bản ghi
	    $countQuery = "SELECT COUNT(*) as total FROM muclucon WHERE 1=1";

	    if (!empty($this->search)) {
	        $countQuery .= " AND tieude LIKE :search";
	    }

	    $countQuery .= " AND mucluc_id = :mlfilter";

	    $stmtCount = $this->conn->prepare($countQuery);

	    if (!empty($this->search)) {
	        $searchParam = "%" . $this->search . "%";
	        $stmtCount->bindParam(':search', $searchParam, PDO::PARAM_STR);
	    }

	    $stmtCount->bindParam(':mlfilter', $this->mlfilter, PDO::PARAM_INT);

	    $stmtCount->execute();
	    $totalResult = $stmtCount->fetch(PDO::FETCH_ASSOC);
	    $total = $totalResult['total'];

	    // Truy vấn chính với giới hạn LIMIT
	    $query = "SELECT * FROM muclucon WHERE 1=1";

	    if (!empty($this->search)) {
	        $query .= " AND tieude LIKE :search";
	    }

	    $query .= " AND mucluc_id = :mlfilter";

	    $query .= " ORDER BY thutu ASC";

	    $query .= " LIMIT :tungtrang, :sp_tungtrang";


	    $stmt = $this->conn->prepare($query);

	    $stmt->bindParam(':tungtrang', $this->tung_trang, PDO::PARAM_INT);
	    $stmt->bindParam(':sp_tungtrang', $this->sp_tungtrang, PDO::PARAM_INT);

	    if (!empty($this->search)) {
	        $searchParam = "%" . $this->search . "%";
	        $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
	    }

	    $stmt->bindParam(':mlfilter', $this->mlfilter, PDO::PARAM_INT);

	        $querysp = "SELECT tieude FROM mucluc where id = :mlfilter";
			$stmtsp = $this->conn->prepare($querysp);
			$stmtsp->bindParam(':mlfilter', $this->mlfilter, PDO::PARAM_INT);
			$stmtsp->execute();
			$rowsp = $stmtsp->fetch(PDO::FETCH_ASSOC);
			$thuoctieude = $rowsp['tieude'];

	    $stmt->execute();

	    return array(
	    	'thuoctieude' => $thuoctieude,
	        'total' => $total,
	        'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)
	    );
	}

	public function show(){
		$query = "SELECT * FROM muclucon where id=? limit 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row['id'];	
		$this->tieude = $row['tieude'];
		$this->noidung = $row['noidung'];
		$this->thutu = $row['thutu'];
		$this->mucluc_id = $row['mucluc_id'];
		$this->url = $row['url'];
	}

	public function create(){
		$query = "INSERT INTO muclucon SET tieude=:tieude, noidung=:noidung, thutu=:thutu, mucluc_id=:mucluc_id, url=:url";
		$stmt = $this->conn->prepare($query);

		$this->tieude = $this->tieude;
		$this->noidung = $this->noidung;
		$this->thutu = $this->thutu;
		$this->mucluc_id = $this->mucluc_id;
		$this->url = $this->url;

		$stmt->bindParam(':tieude',$this->tieude);
		$stmt->bindParam(':noidung',$this->noidung);
		$stmt->bindParam(':thutu',$this->thutu);
		$stmt->bindParam(':mucluc_id',$this->mucluc_id);
		$stmt->bindParam(':url',$this->url);
		if($stmt->execute()){
			return true;
		}
		printf("Error %s.\n" ,$stmt->error);
		return false;
	}

	public function update(){
		$query = "UPDATE muclucon SET tieude=:tieude, noidung=:noidung, thutu=:thutu, url=:url where id=:id";
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
		$query = "DELETE FROM muclucon 
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
