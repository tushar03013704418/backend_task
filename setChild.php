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
 
if(isset($data->name) && isset($data->sex) && isset($data->birthDate) && isset($data->fatherName) && isset($data->motherName)&& isset($data->stateId) && isset($data->districtId))
{
	$query = "select * from child where name = '".$data->name."' and fatherName = '".$data->fatherName."' and  motherName = '".$data->motherName."' and stateId = '".$data->stateId."'and districtId = '".$data->districtId."' ";
	$executeQuery = $conn->query($query);
	 
	if ($executeQuery->num_rows > 0) {
		
	  echo json_encode(
				array(
					"result" => 0,
					"message" => "enter field data  already exists"
				)
			);
	} else {
	  
	  $insertQuery = "INSERT INTO `child`( `name`, `sex`, `birthDate`, `fatherName`, `motherName`, `stateId`, `districtId`) VALUES ('$data->name','$data->sex','$data->birthDate','$data->fatherName','$data->motherName','$data->stateId','$data->districtId')";
	  $executeInsert = $conn->query($insertQuery);
	  
	  echo json_encode(
				array(
					"result"=> 1,
					"message" => "Data added successfully"
					
				)
			);
  
	}
}
}	
else 
 echo json_encode(
				array(
					"result"=> 0,
					"message" => "user not logged in"
					
				)
			);	
	
	

?>