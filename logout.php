<?php

include('config.php');


session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if(isset($_SESSION['username']))
{
	$data = json_decode(file_get_contents("php://input"));
	if($data->username == $_SESSION['username'])
	{
		echo json_encode(
				array(
					"result"=> 1,
					"message" => "logout successfull"
					
				)
			);
		session_destroy();
		session_commit();
	}
	else
	{
		echo json_encode(
				array(
					"result"=> 0,
					"message" => "invalid user"
					
				)
			);
	}	
	
}
else
{
		echo json_encode(
				array(
					"result"=> 0,
					"message" => "user already logged out"
					
				)
			);
	
}
	
?>