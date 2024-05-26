<?php 
class cauhinhapi{
	private $conn;

	public $id;
	public $tieude;
	public $mota;
	public $keywords;
	public $hotline;
	public $email;
	public $zalo;
	public $youtube;
	public $twitter;
	public $google;
	public $instagram;
	public $facebook;
	public $messenger;
	public $googleanalytics;
	public $webmastertool;
	public $logo;
	public $trang;
	

	public function __construct($db){
		$this->conn = $db;
	}

	public function read(){
		$query = "SELECT * FROM cauhinh";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	public function show(){
		$query = "SELECT * FROM cauhinh where id=? limit 1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row['id'];	
		$this->tieude = $row['tieude'];
		$this->mota = $row['mota'];
		$this->keywords = $row['keywords'];	
		$this->hotline = $row['hotline'];
		$this->email = $row['email'];
		$this->zalo = $row['zalo'];
		$this->youtube = $row['youtube'];
		$this->twitter = $row['twitter'];
		$this->google = $row['google'];
		$this->instagram = $row['instagram'];
		$this->facebook = $row['facebook'];
		$this->messenger = $row['messenger'];
		$this->googleanalytics = $row['googleanalytics'];
		$this->webmastertool = $row['webmastertool'];
		$this->logo = $row['logo'];
	}

	public function update(){  
	    $query = "UPDATE cauhinh SET 
	        tieude=:tieude, 
	        mota=:mota, 
	        keywords=:keywords, 
	        hotline=:hotline, 
	        email=:email, 
	        zalo=:zalo, 
	        youtube=:youtube, 
	        twitter=:twitter, 
	        google=:google, 
	        instagram=:instagram, 
	        facebook=:facebook, 
	        messenger=:messenger,  
	        googleanalytics=:googleanalytics, 
	        webmastertool=:webmastertool";

	    if (isset($this->logo) && $this->logo != "undefined") {
	        $query .= ", logo=:logo";
	    }

	    $query .= " WHERE id=:id";

	    $stmt = $this->conn->prepare($query);

	    $this->tieude = $this->tieude;
		$this->mota = $this->mota;
		$this->keywords = $this->keywords;
		$this->hotline = $this->hotline;
		$this->email = $this->email;
		$this->zalo = $this->zalo;
		$this->youtube = $this->youtube;		
		$this->twitter = $this->twitter;				
		$this->google = $this->google;
		$this->instagram = $this->instagram;
		$this->facebook = $this->facebook;
		$this->messenger = $this->messenger;
		$this->googleanalytics = $this->googleanalytics;
		$this->webmastertool = $this->webmastertool;
		$this->id = $this->id;

		$stmt->bindParam(':tieude',$this->tieude);
		$stmt->bindParam(':mota',$this->mota);
		$stmt->bindParam(':keywords',$this->keywords);
		$stmt->bindParam(':hotline',$this->hotline);
		$stmt->bindParam(':email',$this->email);	
		$stmt->bindParam(':zalo',$this->zalo);
		$stmt->bindParam(':youtube',$this->youtube);	
		$stmt->bindParam(':twitter',$this->twitter);
		$stmt->bindParam(':google',$this->google);
		$stmt->bindParam(':instagram',$this->instagram);
		$stmt->bindParam(':facebook',$this->facebook);
		$stmt->bindParam(':messenger',$this->messenger);
		$stmt->bindParam(':googleanalytics',$this->googleanalytics);
		$stmt->bindParam(':webmastertool',$this->webmastertool);
		$stmt->bindParam(':id',$this->id);	
	    if (isset($this->logo) && $this->logo != "undefined") {
	    	$this->logo = $this->logo;
	        $stmt->bindParam(':logo', $this->logo);
	    }

	    if ($stmt->execute()) {
	        return true;
	    }

	    printf("Error %s.\n", $stmt->error);
	    return false;
	}

}	
 ?>
