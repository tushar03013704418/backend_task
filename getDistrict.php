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
if(isset($data->stateId))
{
	$query = "select * from district where stateId = '".$data->stateId."'";
	$executeQuery = $conn->query($query);
	 
	if ($executeQuery->num_rows > 0) {
		
		while($row = mysqli_fetch_assoc($executeQuery)) {
			
			$district[$counter]['id'] = $row['id'];
			$district[$counter]['name'] = $row['name'];
			$district[$counter]['stateId'] = $row['stateid'];
			$counter++;
		}

	  echo json_encode(
				array(
					"result" => 1,
					"message" => "Fetch Successful",
					"district" => $district
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
}	
else 
 echo json_encode(
				array(
					"result"=> 0,
					"message" => "state id not define"
					
				)
			);	
	
	

?>