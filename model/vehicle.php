<?php
require_once("data.php");

class vehicle extends Data{
	private $vehicle_id;
	private $vehicle_type;
	private $vehicle_no;
	private $customer_id;
	private $first_name;
	private $last_name;	
	
	public function getID(){ return $this->vehicle_id;}
	public function getVehicleType(){ return $this->vehicle_type;}
	public function getVehicleNo(){ return $this->vehicle_no;}
	public function getCustomerId(){ return $this->customer_id;}
	public function getCustomerFname(){ return $this->first_name;}
	public function getCustomerLname(){ return $this->last_name;}
	
	function getAllData()
	{
		try {
				$con = new DatabaseConnection();
				$query = "SELECT vehicle.*, customer.first_name, customer.last_name FROM vehicle
								INNER JOIN customer ON vehicle.customer_id = customer.customer_id";
				$result = $con->fetchall($query,"vehicle");
				$vehicles = array();
				foreach($result as $key=>$vehicle){
					$vehicles[$key]["vehicle_id"] = $vehicle->getID();
					$vehicles[$key]["vehicle_type"] = $vehicle->getVehicleType();
					$vehicles[$key]["vehicle_no"] = $vehicle->getVehicleNo();
					$vehicles[$key]["customer_id"] = $vehicle->getCustomerId();
					$vehicles[$key]["first_name"] = $vehicle->getCustomerFname();
					$vehicles[$key]["last_name"] = $vehicle->getCustomerLname();
				}
				return json_encode($vehicles);
		} catch(PDOException $ex) {
				echo "An Error occured!"; 
				echo $ex->getMessage();
		}
	}
	function getSearchData($param)
	{
		try {
				$con = new DatabaseConnection();
				
				$query = "SELECT vehicle.*, customer.first_name, customer.last_name FROM vehicle
								INNER JOIN customer ON vehicle.customer_id = customer.customer_id 
								WHERE vehicle_type = :param";
						
				$result = $con->fetchSearch($query,"vehicle",$param);
				$vehicles = array();
				foreach($result as $key=>$vehicle){
					$vehicles[$key]["vehicle_id"] = $vehicle->getID();
					$vehicles[$key]["vehicle_type"] = $vehicle->getVehicleType();
					$vehicles[$key]["vehicle_no"] = $vehicle->getVehicleNo();
					$vehicles[$key]["customer_id"] = $vehicle->getCustomerId();
					$vehicles[$key]["first_name"] = $vehicle->getCustomerFname();
					$vehicles[$key]["last_name"] = $vehicle->getCustomerLname();
				}
				return json_encode($vehicles);
		} catch(PDOException $ex) {
				echo "An Error occured!"; 
				echo $ex->getMessage();
		}
	}	
}	
?>