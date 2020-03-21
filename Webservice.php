<?php
include("IWebservice.php");
	
	class Webservice implements IWebservice
	{
	
		public function Callemergency(){
			
		}
	
		public function Pingemergency($phone, $subject, $message,$location,$emergency_id, $device_token){
						
				$postdata =  array('phone' => $phone, 'subject' => $subject,'Message'=>$message, 
				'location'=>$location, 'emergency_id'=>$emergency_id, 'device_token'=>$device_token);

					$curl = curl_init();

					curl_setopt_array($curl, array(
					  CURLOPT_URL => "http://secure-x.codenaija.net/api/",  //https://api.paystack.co/transaction/initialize
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_CUSTOMREQUEST => "POST",
					  CURLOPT_POSTFIELDS => json_encode($postdata),
					  CURLOPT_HTTPHEADER => [
						//"authorization: Bearer sk_test_36658e3260b1d1668b563e6d8268e46ad6da3273", //replace this with your own test key
						"content-type: application/json",
						"cache-control: no-cache"
					  ],
					));

					$response = curl_exec($curl);
					$err = curl_error($curl);

					if($err){
					  // there was an error contacting the Paystack API
					  die('Curl returned error: ' . $err);
					}
					
					$tranx = json_decode($response, true);

					echo($tranx);

					// comment out this line if you want to redirect the user to the payment page
					//print_r($tranx);
		}
		
	}
?>