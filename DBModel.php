<?php
include('IDBModel.php');
include('Messageobj.php');

class DBModel implements IDBModel{
	
	//Declaring the variables of he model class
	private $connection = null;

	function __construct($connection){
		$this->connection = $connection;
	}
	
	public function countEmergencys(){
			
			try{
			$sql="SELECT count(*) as 'num' FROM emergency";
			$result = $this->connection->prepare($sql);
			
			$result->execute();
			$record = $result->fetch(PDO::FETCH_ASSOC);
			}
			catch(PDOException $e){
				echo 'Connection failed: ' . $e->getMessage();
			}
			
			return $record['num'];
	}
	
	public function countIssues(){
		
			try{
			$sql="SELECT count(*) as 'num' FROM issue";
			$result = $this->connection->prepare($sql);
			
			$result->execute();
			$record = $result->fetch(PDO::FETCH_ASSOC);
			}
			catch(PDOException $e){
				echo 'Connection failed: ' . $e->getMessage();
			}
			
			return $record['num'];
		}
	
	public function Storeissue($phone,$subject, $message){
	
		$stmt = $this->connection->prepare("INSERT INTO issue (phone,subject, message)
			VALUES (?,?,?)");
			$stmt->bindParam(1, $phone);
			$stmt->bindParam(2, $subject);
			$stmt->bindParam(3, $message);
			
			$stmt->execute();
			
			$last_insert_id = $this->connection->lastInsertId();
			return $last_insert_id;
	}
	
	public function Displayissues(){
		
			$jsonfeed= array();
			try{
			$sql="SELECT * FROM issue";
			$result = $this->connection->prepare($sql);
			
			$result->execute();
			$id = 0;
			

				while($record = $result->fetch(PDO::FETCH_ASSOC)){
				
					$object = new Messageobj();
					$object->phone = $record['phone'];
					$object->subject = $record['subject'];
					$object->message = $record['message'];
					
					$jsonfeed[$id] = $object;
					
					$id++;
				}
			}
			catch(PDOException $e){
				echo 'Connection failed: ' . $e->getMessage();
			}
			
			return $jsonfeed;
	}
	
	public function countFeedbacks(){
	
		try{
			$sql="SELECT count(*) as 'num' FROM feedback";
			$result = $this->connection->prepare($sql);
			
			$result->execute();
			$record = $result->fetch(PDO::FETCH_ASSOC);
			}
			catch(PDOException $e){
				echo 'Connection failed: ' . $e->getMessage();
			}
			
			return $record['num'];
	}
	
	public function Storefeedback($phone,$subject, $message){
	
		$stmt = $this->connection->prepare("INSERT INTO feedback (phone,subject, message)
			VALUES (?,?,?)");
			$stmt->bindParam(1, $phone);
			$stmt->bindParam(2, $subject);
			$stmt->bindParam(3, $message);
			
			$stmt->execute();
			
			$last_insert_id = $this->connection->lastInsertId();
			return $last_insert_id;
	}
	
	public function Displayfeedbacks(){
	
		$jsonfeed = array();
			try{
			$sql="SELECT * FROM feedback";
			$result = $this->connection->prepare($sql);
			
			$result->execute();
			$id = 0;
				while($record = $result->fetch(PDO::FETCH_ASSOC)){
				
					$object = new Messageobj();
					$object->phone = $record['phone'];
					$object->subject = $record['subject'];
					$object->message = $record['message'];
					
					$jsonfeed[$id] = $object;
					$id++;
				}
			}
			catch(PDOException $e){
				echo 'Connection failed: ' . $e->getMessage();
			}
			
			return $jsonfeed;
	}
	
	public function Displayemergencys(){
	
		$jsonfeed = array();
			try{
			$sql="SELECT * FROM emergency";
			$result = $this->connection->prepare($sql);
			
			$result->execute();
			$id = 0;
				while($record = $result->fetch(PDO::FETCH_ASSOC)){
				
					$object = new Messageobj();
					$object->phone = $record['phone'];
					$object->subject = "Emergency";
					$object->message = $record['type'];
					
					$jsonfeed[$id] = $object;
					
					$id++;
				}
			}
			catch(PDOException $e){
				echo 'Connection failed: ' . $e->getMessage();
			}
			
			return $jsonfeed;
	}
	
	/************************Theses are the modules of the requesttest table *********************/
	
	public function Storerequest($text){
		
		$stmt = $this->connection->prepare("INSERT INTO requests (usertext)
			VALUES (?)");
			$stmt->bindParam(1, $text);
			
			$stmt->execute();
			
			$last_insert_id = $this->connection->lastInsertId();
			return $last_insert_id;
	}

	/***********************Emergency modules below *******************************/
	public function Logemergency($phone, $type){
	
		$stmt = $this->connection->prepare("INSERT INTO emergency (phone, type)
			VALUES (?,?)");
			$stmt->bindParam(1, $phone);
			$stmt->bindParam(2, $type);
			
			$stmt->execute();
			
			$last_insert_id = $this->connection->lastInsertId();
			return $last_insert_id;
	}
	
	public function Isuserregistered($phone){
			
		$data = [
					'phone'=>$phone			
				];
		
			$sql="SELECT count(*) as 'check' FROM users WHERE phone=:phone ";
			$result = $this->connection->prepare($sql);
			
			$result->execute($data);
			
			$record = $result->fetch(PDO::FETCH_ASSOC);
			
			return $record['check'];
	}
	
	public function Getuser($phone){
			$data = [
					'phone'=>$phone			
				];
		
			$sql="SELECT * FROM users WHERE phone=:phone ";
			$result = $this->connection->prepare($sql);
			
			$result->execute($data);
			
			$record = $result->fetch(PDO::FETCH_ASSOC);
			
			return $record;
	}
	
	
	public function Storeuser($phone){
		
		$cardnum = '';
		$stmt = $this->connection->prepare("INSERT INTO users (phone)
			VALUES (?)");
			$stmt->bindParam(1, $phone);
						
			$stmt->execute();
			
			$last_insert_id = $this->connection->lastInsertId();
			return $last_insert_id;
	}
	
	/************************These modules are for the session table *************************/
	
	public function Getlevelofsession($sessionId){
	
		$data = [
					'session_id'=>$sessionId
				];
				
		$sql = "select level from session_levels where session_id =:session_id ";
		
		$result = $this->connection->prepare($sql);
		
		$result->execute($data);
		
		$record = $result->fetch(PDO::FETCH_ASSOC);
		
		return $record['level'];
	}
	
	public function Countsessionbyid($sessionId){
		
		$data = [
					'session_id'=>$sessionId
				];
		
			$sql="SELECT count(*) as 'count' FROM session_levels WHERE session_id=:session_id";
			$result = $this->connection->prepare($sql);
			
			$result->execute($data);
			
			$record = $result->fetch(PDO::FETCH_ASSOC);
			
			return $record['count'];
	}
	
	public function Updatesessionlevel($sessionId, $level){
		
			$data = [
					'session_id'=>$sessionId,
					'level' => $level
			];
	
			$sql = "UPDATE session_levels SET
			level = :level
			WHERE session_id=:session_id";	
			
			$stmt = $this->connection->prepare($sql);
			
			$stmt->execute($data);
	}
	
	public function Savesessionlevel($sessionId, $level, $phone){
		
		$stmt = $this->connection->prepare("INSERT INTO session_levels (session_id, phone, level)
			VALUES (?, ?, ?)");
			$stmt->bindParam(1, $sessionId);
			$stmt->bindParam(2, $phone);
			$stmt->bindParam(3, $level);
			
			$stmt->execute();
			
			$last_insert_id = $this->connection->lastInsertId();
			return $last_insert_id;
	}
	
}
?>