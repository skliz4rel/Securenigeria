<?php
/*
include('Newuser.php');
include('Registereduser.php');
*/
include('Connection.php');
include('DBModel.php');

class USSDMenu{

	//declaring the variables of the code
	public $sessionId;
	public $phoneNumber;
	public $serviceCode;
	public $text;
	public $usersReponse;
	private $dbmodel;
	private $level;
	private $textArray;
	
	function __construct(){
	
		$response=  "";
		$this->gotUserfeedback = false;
		
		//initializing the variables of the code
		if(isset($_POST["sessionId"]))
				$this->sessionId = $_POST["sessionId"];
			
		if(isset($_POST["phoneNumber"]))
			$this->phoneNumber = $_POST["phoneNumber"];
			
		if(isset($_POST["serviceCode"]))
			$this->serviceCode =  $_POST["serviceCode"];
		
		if(isset($_POST["text"])){
			$connectobj  = new Connection();
			$connection = $connectobj->doConnection();
			$this->dbmodel = new DBModel($connection);
		
			$this->text = $_POST["text"];
			
			//collect the current level
			$id = $this->dbmodel->Storerequest($this->text);
		//echo 'not Formatted result   '.$this->text.'<br/>';
		
			
		//This is suppose to get the response from the user when we are expecting a feedback
			if (strpos($this->text, '*') !== false){
				$this->textArray=explode('*', $this->text);
				$this->userResponse=trim(end($this->textArray));
				
				//Now we would need to format the string again
				if(strlen($this->userResponse) > 1){
					$needle = "*".$this->userResponse;
					$this->text = str_replace($needle,'',$this->text);
					
					$this->gotUserfeedback = true;
				}
				
				$newresponse = '';
				if($this->textArray !=null){
				foreach($this->textArray as $value){
						if(strlen($value) == 1)
							$newresponse .= $value.'*';
					}
					
					$this->text = $newresponse;
				}
				
				if($this->text != null){
					$this->text=rtrim($this->text,"*");
				}
				
			}

			//echo $this->text .' this is here my friend';
		
			
			$this->level = $this->dbmodel->Getlevelofsession($this->sessionId);
			
			if($this->level == null ){
				$this->level = 0;
				
				//echo "888888888888888888888888888888888888888888";
			}
			
			//echo "The level is here ".$this->level;
			
			$objcall = null;//This object would be used to call the class depending on the process flow we need
		
			/*******************************Menu for Ones ************************************/
			
			$response = $this->GetResponse($this->textArray);
			
			/******************************Second level Menu below ****************************************************/
			
			
			// Print the response onto the page so that our gateway can read it
			header('Content-type: text/plain');
			echo $response;
			
			}
	}
	
	
	private function GetResponse($textArray){
	
	//print_r($textArray);
	
		$response = '';
		switch($this->text){
			case "":
				 $response  = "CON Welcome to SecureX \n";
				 $response .= "1. Report an Issue \n";
				 $response .= "2. Give Feedback \n";
				 $response .= "3. Emergency \n";
				 $response .= "4. Add Family & friends\n";
				 $response .= "5. Security Hint to Family & Pals";
			break;
		
			case "1":
					if($this->gotUserfeedback == false){
						$response = "CON Start reporting an Issue Now.\n";
						$response .= "Give a summary of Issue\n";	
						
						//Store the level here
						$this->logSession("issue");
					}
					else{
						//echo "I am in here my friend";
					
						if($this->level == 'issue'){
							$this->logSession("issuemsg");
							
							$response = "CON Enter Location or Address.\n";
						}
						
						if($this->level =="issuemsg"){
						
							$subject = $textArray[count($textArray)-2];
							$message = $this->userResponse;
							//print_r ();
						
							$this->dbmodel->Storeissue($this->phoneNumber,$subject, $message);
							
							$response = "END You successfully reported the crime case, Thank you.\n";
							
							$this->logSession("done");
						}
					}
					
			break;
					
			case "2":
				if($this->gotUserfeedback == false){
					$response  = "CON We welcome your feedbacks to serve you better \n";
					$response .= "Enter Feedback Subject \n";	

					//Store the level here
					$this->logSession("feedback");
				}
				else{
				
					//echo "Feedback to friends now    ";
					
						if($this->level == 'feedback'){
							$this->logSession("feedbackmsg");
							
							$response = "CON Give Feedback Message\n";
						}
						
						if($this->level =="feedbackmsg"){
						
							$subject = $textArray[count($textArray)-2];
							$message = $this->userResponse;
							//print_r ();
							
							$this->dbmodel->Storefeedback($this->phoneNumber, $subject, $message);
							
							$response = "END You have successfully logged Feedback\n";
							
							$this->logSession("done");
						}
				}
			break;
		
			case "3":			
				$response = "CON Choose an Emergency\n";				
				$response .= "1. Armed Robbery\n";
				$response .= "2. Kidnapping\n";
				$response .= "3. Rape\n";
				$response .= "4. Others";
				
				//Store the level here
				$this->logSession("emergency");
			break;
			
			case "3*1":
				//This would call the armed robbery web service
				$this->dbmodel->Logemergency($this->phoneNumber, 'robbery');
				
				$response = "END Alert Recieved\n";
			break;
			
			case "3*2":
				//This would call the kidnapping 
				$this->dbmodel->Logemergency($this->phoneNumber, 'kidnapping');
				
				$response = "END Alert Recieved, Thank you\n";
			break;
			
			case "3*3":
				//This would call the rape service
				$this->dbmodel->Logemergency($this->phoneNumber, 'rape');
				
				$response = "END Alert Recieved, Thank you\n";
			break;
			
			case "3*4":
				//This would call the other emergency webservice
				$this->dbmodel->Logemergency($this->phoneNumber, 'other crime');
				
				$response = "END Alert Recieved\n";
			break;
			
			case "4":
				$response = "END Would be available in next version. Coming soon !!";
			break;
			
			case "5":
				$response = "END You would be able to notify your family and friends of security hints asap via sms and real time update. Coming soon !!";
			break;
		}
		
		return $response;
	}
	
	//This is the private function
	private function logSession($level){
			//echo "<br/>This is the ".$level.' go for it now    '.$this->level;
			
			if(empty($this->level) ){
				//echo "++++++++++++++++++++++++++ ";
				$this->dbmodel->Savesessionlevel($this->sessionId, $level, $this->phoneNumber);
			}
			else {
				//echo "================================";
				
				$this->dbmodel->Updatesessionlevel($this->sessionId, $level);
			}
		}
}

if(!empty($_POST))
	$initiateobj = new USSDMenu();
?>