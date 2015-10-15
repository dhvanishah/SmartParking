<?php
require_once("data.php");

class customer extends Data{
	private $id;
	private $first_name;
	private $last_name;
	private $date_of_birth;
	private $gender;
	private $license;
	private $phone;
	
	public function getID(){ return $this->customer_id;}
	public function getFirstName(){ return $this->first_name;}
	public function getLastName(){ return $this->last_name;}
	public function getGender(){ return $this->gender;}
	public function getDateOfBirth(){ return $this->date_of_birth;}
	public function getLicense(){ return $this->license;}
	public function getPhone(){ return $this->phone;}
	
	function getAllData()
	{
		try {
				$con = new DatabaseConnection();
				$query = "SELECT * FROM customer";
				$result = $con->fetchall($query,"customer");
				$customers = "";
				
				foreach($result as $key=>$customer){
					$customers[$key]["customer_id"] = $customer->getID();
					$customers[$key]["first_name"] = $customer->getFirstName();
					$customers[$key]["last_name"] = $customer->getLastName();
					$customers[$key]["date_of_birth"] = $customer->getDateOfBirth();
					$customers[$key]["gender"] = $customer->getGender();
					$customers[$key]["license"] = $customer->getLicense();
					$customers[$key]["phone"] = $customer->getPhone();
				}
				return json_encode($customers);
		} catch(PDOException $ex) {
				echo "An Error occured!"; 
				echo $ex->getMessage();
		}
	}
	function getSearchData($param)
	{
		try {
				$con = new DatabaseConnection();
				
				$query = "SELECT * FROM customer WHERE first_name = :param";
						
				$result = $con->fetchSearch($query,"customer",$param);
				$customers = array();
								
				foreach($result as $key=>$customer){
					$customers[$key]["customer_id"] = $customer->getID();
					$customers[$key]["first_name"] = $customer->getFirstName();
					$customers[$key]["last_name"] = $customer->getLastName();
					$customers[$key]["date_of_birth"] = $customer->getDateOfBirth();
					$customers[$key]["gender"] = $customer->getGender();
					$customers[$key]["license"] = $customer->getLicense();
					$customers[$key]["phone"] = $customer->getPhone();
				}

				$customers = array();
				return json_encode($customers);
		} catch(PDOException $ex) {
				echo "An Error occured!"; 
				echo $ex->getMessage();
		}
	}	
}	
?>