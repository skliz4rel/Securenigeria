<?php
include("Webservice.php");
	
$object= new Webservice();

echo $object->Pingemergency('09824234', 'Test Subject', 'Test message','Lagos',null, 'nokia token');
?>