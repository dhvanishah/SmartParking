<?php
require_once("database.php");
require_once("customer.php");
require_once("vehicle.php");
require_once("parking.php");


$spath = explode("/",$_SERVER["REQUEST_URI"]);
	
	if($spath[4] == "customer"){
		$cls = new customer();
	}
	else if($spath[4] == "vehicle"){
		$cls = new vehicle();
	}
	else if($spath[4] == "parking"){
		$cls = new parking();
	}
	$response = isset($spath[5])?$cls->getSearchData($spath[5]):$cls->getAllData();	
	echo $response;	



?>