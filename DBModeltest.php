<?php
include('Connection.php');
include('DBModel.php');

$connectobj  = new Connection();
$connection = $connectobj->doConnection();
$dbmodel = new DBModel($connection);

//This would be used to test the Database model class.
if(isset($_GET['checkreg'])){
	$check = $dbmodel->Isuserregistered('08131528807');
	echo $check;
}

if(isset($_GET['checklevel'])){
	
	$check = $dbmodel->Getlevelofsession("111111111");
	echo "This is here ".$check;
}

if(isset($_GET['updatelevel'])){
	
	$dbmodel->Updatesessionlevel('1234', '500');
}

if(isset($_GET['savelevel'])){
	
	$dbmodel->Savesessionlevel('2244', '6000', '08160841376');
}

if(isset($_GET['storeuser'])){
	
	$dbmodel->Storeuser('081224241234','2342342','','',1);
}

if(isset($_GET['bvn'])){
	$dbmodel->Updatebvn('081224241234', '');
}

if(isset($_GET['firstname'])){
	$dbmodel->Updatefirstname('081224241234', 'jide');
}

if(isset($_GET['lastname'])){
$dbmodel->Updatelastname('081224241234', 'akin');
}

if(isset($_GET['sex'])){
	$dbmodel->Updatesex('081224241234', 0);
}

if(isset($_GET['text'])){
	$dbmodel->Storerequest('1*1');
}

$newarraynama=rtrim("123456,",",");

echo $newarraynama;
echo "<br/>";

if(isset($_GET['issuelist'])){
	echo json_encode($dbmodel->Displayissues());
}

if(isset($_GET['feedbacklist'])){

	echo json_encode($dbmodel->Displayfeedbacks());
}

if($_GET['logemerg']){
	echo $dbmodel->Logemergency('08131528807', 'rape');
}
?>