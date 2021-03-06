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
	$state = array();
	$counter =0;
	$query = "select * from state ";
	$executeQuery = $conn->query($query);
	 

	if ($executeQuery->num_rows > 0) {
		
		while($row = mysqli_fetch_assoc($executeQuery)) {
			
			$state[$counter]['id'] = $row['id'];
			$state[$counter]['name'] = $row['name'];
			$counter++;
		}

	  echo json_encode(
				array(
					"result" => 1,
					"message" => "Fetch Successful",
					"state" => $state
				)
			);
	} else {
	  
	  echo json_encode(
				array(
					"result"=> 0,
					"message" => "No state found"
					
				)
			);
	  
	}
}
else{

	echo json_encode(
				array(
					"result"=> 0,
					"message" => "User not logged in"
					
				)
			);
	
	
}
?>