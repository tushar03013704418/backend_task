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
$child = array();
$counter =0; 

if(isset($data->childId))
{
	$query = "select * from child where id = '".$data->childId."'";
	$executeQuery = $conn->query($query);
	 
	if ($executeQuery->num_rows > 0) {
		
		while($row = mysqli_fetch_assoc($executeQuery)) {
			
			$child[$counter]['childId'] = $row['id'];
			$child[$counter]['name'] = $row['name'];
			$child[$counter]['sex'] = $row['sex'];
			$child[$counter]['birthDate'] = $row['birthDate'];
			$child[$counter]['fatherName'] = $row['fatherName'];
			$child[$counter]['motherName'] = $row['motherName'];
			$child[$counter]['stateId'] = $row['stateId'];
			$child[$counter]['districtId'] = $row['districtId'];
			$counter++;
		}

	  echo json_encode(
				array(
					"result" => 1,
					"message" => "Fetch Successful",
					"child" => $child
				)
			);
	} else {
	  
	  echo json_encode(
				array(
					"result"=> 0,
					"message" => "No child found"
					
				)
			);
  
	}
}
}	
else 
 echo json_encode(
				array(
					"result"=> 0,
					"message" => "user not logged in "
					
				)
			);	
	
	

?>