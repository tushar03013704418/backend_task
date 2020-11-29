<?php

include('config.php');


session_start();

if(isset($_SESSION['username']))
{

$district = array();
$counter =0;
 
if(isset($_POST['name']) && isset($_POST['sex']) && isset($_POST['birthDate']) && isset($_POST['fatherName']) && isset($_POST['motherName'])&& isset($_POST['stateId']) && isset($_POST['districtId']))
{
	
	$query = "select * from child where name = '".$_POST['name']."' and fatherName = '".$_POST['fatherName']."' and  motherName = '".$_POST['motherName']."' and stateId = '".$_POST['stateId']."'and districtId = '".$_POST['districtId']."' ";
	$executeQuery = $conn->query($query);
	 
	if ($executeQuery->num_rows > 0) {
		
	  echo json_encode(
				array(
					"result" => 0,
					"message" => "enter field data  already exists"
				)
			);
	} else {
	  
	 
	  if(isset($_FILES['image']['name'])){

		 	  
		   $filename = preg_replace( "/[^a-z0-9\._]+/", "-", strtolower($_FILES['image']['name']) );

		  
		   $location = "upload/".$filename;
		   $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
		   $imageFileType = strtolower($imageFileType);

		   
		   $valid_extensions = array("jpg","jpeg","png");

		   $response = 0;
		  
		   if(in_array(strtolower($imageFileType), $valid_extensions)) {
			  
			  if(move_uploaded_file($_FILES['image']['tmp_name'],$location)){
				 $response = $location;
			  }
		   }

		}

	  $insertQuery = "INSERT INTO `child`( `name`, `sex`, `birthDate`, `fatherName`, `motherName`, `stateId`, `districtId`,`image`) VALUES ('".$_POST['name']."','".$_POST['sex']."','".$_POST['birthDate']."','".$_POST['fatherName']."','".$_POST['motherName']."','".$_POST['stateId']."','".$_POST['districtId']."','$response')";
	  $executeInsert = $conn->query($insertQuery);
	  
	  echo json_encode(
				array(
					"result"=> 1,
					"message" => "Data added successfully"
				)
			);
  
	}
}
else
{
	 echo json_encode(
				array(
					"result"=> 0,
					"message" => "please provide all the fields"
				)
			);
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