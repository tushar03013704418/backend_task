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
	if(isset($data->districtName) && isset($data->stateId))
	{
		$query = "select * from district where name = '".$data->districtName."' and DistrictId = '".$data->stateId."'";
		$executeQuery = $conn->query($query);
		 
		if (isset($executeQuery->num_rows) && $executeQuery->num_rows > 0) {
			
		  echo json_encode(
					array(
						"result" => 0,
						"message" => "District already exists"
					)
				);
		} else {
		  
		  $insertQuery = "INSERT INTO `district`(`stateId`, `name`) VALUES ($data->stateId,'$data->districtName')";
		  $executeInsert = $conn->query($insertQuery);
		  echo json_encode(
					array(
						"result"=> 1,
						"message" => "District added successfully"
						
					)
				);
	  
		}
	}
		
	else 
	 echo json_encode(
					array(
						"result"=> 0,
						"message" => "provide state id and district name"
						
					)
				);	
	
}	
else
{
	echo json_encode(
				array(
					"result"=> 0,
					"message" => "user not logged in "
					
				)
			);
	
	
}

?>