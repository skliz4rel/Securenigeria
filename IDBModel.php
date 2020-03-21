<?php

	interface IDBModel
	{
	public function countEmergencys();

	public function countIssues();
	
	public function Storeissue($phone,$subject, $message);
	
	public function Displayissues();
	
	public function Storefeedback($phone,$subject, $message);
	
	public function countFeedbacks();
	
	public function Displayfeedbacks();
	
	public function Displayemergencys();
	
	/************************Theses are the modules of the requesttest table *********************/
	
	public function Storerequest($text);
	
	/***********************Emergency modules below *******************************/
	public function Logemergency($phone, $type);
		
	/*********************These modules are for the users table *********************************/
	public function Isuserregistered($phone);
		
		public function Getuser($phone);		
		
		public function Storeuser($phone);			
		
		/************************These modules are for the session table *************************/
		public function Getlevelofsession($sessionId);
		
		public function Countsessionbyid($sessionId);
		
		public function Updatesessionlevel($sessionId, $level);
		
		public function Savesessionlevel($sessionId, $level, $phone);
	}

?>