<?php

	interface IWebservice
	{
	
	public function Callemergency();
	
	public function Pingemergency($phone, $subject, $message,$location,$emergency_id, $device_token);	
	
	}
	
?>