<?php
require_once("data.php");

class parking extends Data{
	private $parking_id;
	private $parkingName;
	private $open_spaces;
	private $total_spaces;
	private $parking_type;
	private $city;
	private $street;
	private $unit;
	private $zipcode;
	

	public function getID(){ return $this->parking_id;}
	public function getParkingName(){ return $this->parkingName;}
	public function getOpenParkingSpaces(){ return $this->open_spaces;}
	public function getTotalParkingSpaces(){ return $this->total_spaces;}
	public function getParkingType(){ return $this->parking_type;}
	public function getCity(){ return $this->city;}
	public function getStreet(){ return $this->street;}
	public function getUnit(){ return $this->unit;}
	public function getZip(){ return $this->zipcode;}
	function getAllData()
	{
		try {
				$con = new DatabaseConnection();
				$query = "SELECT parking.parking_id, parking.parkingName, parking.open_spaces, parking.total_spaces, 
						parking.parking_type, address.city, address.street, address.unit, address.zipcode 
						FROM address INNER JOIN parking ON address.address_id=parking.address_id";
				
				$result = $con->fetchall($query,"parking");
				
				$parkinglist = array();
				
				foreach($result as $key=>$parking){
					$parkinglist[$key]["parking_id"] = $parking->getID();
					$parkinglist[$key]["parkingName"] = $parking->getParkingName();
					$parkinglist[$key]["open_spaces"] = $parking->getOpenParkingSpaces();
					$parkinglist[$key]["total_spaces"] = $parking->getTotalParkingSpaces();
					$parkinglist[$key]["parking_type"] = $parking->getParkingType();
					$parkinglist[$key]["city"] = $parking->getCity();
					$parkinglist[$key]["street"] = $parking->getStreet();
					$parkinglist[$key]["unit"] = $parking->getUnit();
					$parkinglist[$key]["zipcode"] = $parking->getZip();
				}
				return json_encode($parkinglist);
				
		} catch(PDOException $ex) {
				echo "An Error occured!"; 
				echo $ex->getMessage();
		}
	}
	function getSearchData($param)
	{
		try {
				$con = new DatabaseConnection();
				
				$query = "SELECT parking.parking_id, parking.parkingName, parking.open_spaces, parking.total_spaces, 
						parking.parking_type, address.city, address.street, address.unit, address.zipcode 
						FROM address INNER JOIN parking ON address.address_id=parking.address_id where parkingName=:param";
						
				$result = $con->fetchSearch($query,"parking",$param);
				
				$parkinglist = array();
				
				foreach($result as $key=>$parking){
					$parkinglist[$key]["parking_id"] = $parking->getID();
					$parkinglist[$key]["parkingName"] = $parking->getParkingName();
					$parkinglist[$key]["open_spaces"] = $parking->getOpenParkingSpaces();
					$parkinglist[$key]["total_spaces"] = $parking->getTotalParkingSpaces();
					$parkinglist[$key]["parking_type"] = $parking->getParkingType();
					$parkinglist[$key]["city"] = $parking->getCity();
					$parkinglist[$key]["street"] = $parking->getStreet();
					$parkinglist[$key]["unit"] = $parking->getUnit();
					$parkinglist[$key]["zipcode"] = $parking->getZip();
				}
				return json_encode($parkinglist);
		} catch(PDOException $ex) {
				echo "An Error occured!"; 
				echo $ex->getMessage();
		}
	}	
}	
?>