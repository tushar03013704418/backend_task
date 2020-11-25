<?php

include('config.php');



header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


session_start();
$data = json_decode(file_get_contents("php://input"));

if(isset($data->username)  && isset($data->password))
{
	
	$username = $data->username;
	$password = $data->password;
	$_SESSION['username'] = $username; 

	$query = "select * from users where username = '".$username."' and password = '".md5($password)."'";
	$executeQuery = $conn->query($query);
	 
	if ($executeQuery->num_rows > 0) {
	 
	  echo json_encode(
				array(
					"result" => 1,
					"message" => "Successful login."
					
				)
			);
	} else {
	  
	  echo json_encode(
				array(
					"result"=> 0,
					"message" => "incorrect username/password"
					
				)
			);
	  
	}
}    
?>