<?php
include('Connection.php');
include('DBModel.php');

class Apiservice{

	//Declaring the variables of the webservice
	public $dbmodel = null;
	
	function __construct(){
			
		$connectobj  = new Connection();
		$connection = $connectobj->doConnection();
		$this->dbmodel = new DBModel($connection);
	}

	public function issuelist(){
		
		$list = $this->dbmodel->Displayissues();
		echo json_encode($list);
	}
	
	public function countissues(){
	
		$count = $this->dbmodel->countIssues();
		
		echo json_encode($count);
	}
	
	public function feedbacklist(){
		
		$list = $this->dbmodel->displayfeedbacks();
		echo json_encode($list);
	}
		
	public function countfeedbacks(){
	
		$count = $this->dbmodel->countFeedbacks();
		
		echo json_encode($count);
	}
		
	public function emergencylist(){
		
		$list = $this->dbmodel->Displayemergencys();
		
		echo json_encode($list);
	}
	
	public function countemergencys(){
	
		$count = $this->dbmodel->countEmergencys();
		
		echo json_encode($count);
	}
}

$object = new Apiservice();

if(isset($_GET['issuelist'])){
	$object->issuelist();
}

if(isset($_GET['countissues'])){
	$object->countIssues();
}

if(isset($_GET['feedbacklist'])){

	$object->feedbacklist();
}

if(isset($_GET['countfeedbacks'])){
	$object->countFeedbacks();
}

if(isset($_GET['emergencylist'])){
	$object->emergencylist();
}

if(isset($_GET['countemergencys'])){
	$object->countemergencys();
}

?>