<?php
$spath = explode("/",$_SERVER["REQUEST_URI"]);
	//$cls = eval($spath[4]);
	//$clparam = eval($spath[5]);
	
	$cls = new eval($spath[4]);
	echo "test";
	exit();
	if($spath[4] == "customer"){
		if($spath[5]){
			customer($spath[5]);
		}
		else
			customer();
	}
	
function connect()
{
	$db = new PDO('mysql:host=localhost;dbname=SmartParking;charset=utf8', 'root', 'root');
	if ($db->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	else
		return $db;
}

class customer {
	
	private $id;
	private $first_name;
	private $last_name;
	private $gender;
	private $license;
	private $phone;
	

	public function getID(){ return $this->id;}
	public function getFirstName(){ return $this->first_name;}
	public function getLastName(){ return $this->last_name;}
	public function getGender(){ return $this->gender;}
	public function getLicense(){ return $this->license;}
	public function getPhone(){ return $this->phone;}
	
}
function customer($param='')
{
	try {
			$db = connect();
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			
			if($param){
				$stmt = $db->prepare("SELECT * FROM customer WHERE first_name = :param");
				$stmt->bindParam(":param", $param);
			}
			else
				$stmt = $db->prepare("SELECT * FROM customer");
			
			$stmt->execute();
			$result = $stmt->fetchALL(PDO::FETCH_ASSOC);
			
			$db = null;
			echo json_encode($result);
	} catch(PDOException $ex) {
			echo "An Error occured!"; 
			echo $ex->getMessage();
	}
}
	
?>