<?php
$spath = explode("/",$_SERVER["REQUEST_URI"]);

	if($spath[4] == "customer"){
		if($spath[5]){
			customer($spath[5]);
		}
		else
			customer();
	}
	if($spath[4] == "parking"){
		if($spath[5]){
			parking($spath[5]);
		}
		else
			parking();
	}
	if($spath[4] == "vehicle"){
		if($spath[5]){
			vehicle($spath[5]);
		}
		else
			vehicle();
	}
	if($spath[4] == "history"){
		if($spath[5]){
			history($spath[5]);
		}
		else
			history();
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

function parking($param='')
{
	try {
			$db = connect();
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			
			$result = '';
			
			if($param){
				$stmt = $db->prepare("SELECT parking.parking_id, parking.parkingName, parking.open_spaces, parking.total_spaces, 
						parking.parking_type, address.city, address.street, address.unit, address.zipcode 
						FROM address INNER JOIN parking ON address.address_id=parking.address_id where parkingName=:param");
						
				$stmt->bindParam(":param", $param);
			}
			else
				$stmt = $db->prepare("SELECT parking.parking_id, parking.parkingName, parking.open_spaces, parking.total_spaces, 
						parking.parking_type, address.city, address.street, address.unit, address.zipcode 
						FROM address INNER JOIN parking ON address.address_id=parking.address_id");
						
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$db = null;
			
			echo json_encode($result);
	} catch(PDOException $ex) {
			echo "An Error occured!"; 
			echo $ex->getMessage();
	}
}

function vehicle($param='')
{
	try {
			$db = connect();
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			
			if($param){
				$stmt = $db->prepare("SELECT vehicle.*, customer.first_name, customer.last_name FROM vehicle
								INNER JOIN customer ON vehicle.customer_id = customer.customer_id 
								WHERE vehicle_type = :param");
								
				$stmt->bindParam(":param", $param);
			}
			else {
				
				$stmt = $db->prepare("SELECT vehicle.*, customer.first_name, customer.last_name FROM vehicle
								INNER JOIN customer ON vehicle.customer_id = customer.customer_id");
			}
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			echo json_encode($result);
	} catch(PDOException $ex) {
			echo "An Error occured!"; 
			echo $ex->getMessage();
	}
}
function history($param='')
{
	try {
			$db = connect();
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			
			if($param){
				$stmt = $db->prepare("SELECT customer.customer_id, customer.first_name, history.parking_id, parking.parkingName,
								 history.day, history.from, history.to 
								 FROM history 
								 INNER JOIN customer ON history.cutomer_id=customer.customer_id
								 LEFT JOIN parking ON parking.parking_id = history.parking_id
								 WHERE customer.first_name = :param");
				$stmt->bindParam(":param", $param);
			}
			else {
				$stmt = $db->prepare("SELECT customer.customer_id, customer.first_name, history.parking_id, parking.parkingName,
								 history.day, history.from, history.to 
								 FROM history 
								 INNER JOIN customer ON history.cutomer_id=customer.customer_id
								 LEFT JOIN parking ON parking.parking_id = history.parking_id");
			}
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			echo json_encode($result);
	} catch(PDOException $ex) {
			echo "An Error occured!"; 
			echo $ex->getMessage();
	}
}		
?>