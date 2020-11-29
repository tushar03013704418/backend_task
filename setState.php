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
$district = array();
$counter =0;
if(isset($data->stateName))
{
	$query = "select * from state where name = '".$data->stateName."'";
	$executeQuery = $conn->query($query);
	 
	if ($executeQuery->num_rows > 0) {
		
	  echo json_encode(
				array(
					"result" => 0,
					"message" => "State already exists"
				)
			);
	}
	else {
	  
	  $insertQuery = "INSERT INTO `state`(`name`) VALUES ('$data->stateName')";
	  $executeInsert = $conn->query($insertQuery);
	  echo json_encode(
				array(
					"result"=> 1,
					"message" => "State added successfully"
					
				)
			);
  
	}

}	
}
else 
 echo json_encode(
				array(
					"result"=> 0,
					"message" => "your user not logged in"
					
				)
			);	
	
	

?>