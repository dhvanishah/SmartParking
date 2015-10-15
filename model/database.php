<?php
require_once("customer.php");
class DatabaseConnection{
	public $db;
	
	function connect()
	{
		$db = new PDO('mysql:host=localhost;dbname=SmartParking;charset=utf8', 'root', 'root');
		if ($db->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		else
			return $db;
	}
	
	function fetchall($query,$class){
		
		$clsdb = $this->connect();
		$clsdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$clsdb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
					
		$stmt = $clsdb->prepare($query);
		
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS,$class);
		
		$result=$stmt->fetchALL();
			
		$clsdb = null;
		return ($result);
	}
	function fetchSearch($query,$class,$param){
		$clsdb = $this->connect();
		$clsdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$clsdb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
					
		$stmt = $clsdb->prepare($query);
		$stmt->bindParam(":param", $param);
		
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS,$class);
		
		$result=$stmt->fetchALL();
		$clsdb = null;
		return ($result);
	}
}
?>