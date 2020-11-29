<?php

include('config.php');



session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



$data = json_decode(file_get_contents("php://input"));
$user= array();
$counter = 0 ;

if(isset($data->username)  && isset($data->password))
{
	
	$username = $data->username;
	$password = $data->password;
	$_SESSION['username'] = $username; 

	$query = "select * from users where username = '".$username."' and password = '".md5($password)."'";
	$executeQuery = $conn->query($query);
	 
	if ($executeQuery->num_rows > 0) {
	while($row = mysqli_fetch_assoc($executeQuery)) {
		$user[$counter]['name'] = $row['name']; 
		$user[$counter]['designation'] = $row['designation']; 
		$user[$counter]['organisation'] = $row['organisation']; 
	}
	  echo json_encode(
				array(
					"result" => 1,
					"message" => "Successful login.",
					"user" => $user
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