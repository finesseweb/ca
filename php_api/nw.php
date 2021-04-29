<?php
	error_reporting(E_ALL ^ E_WARNING);
	require_once("connect.php");
	
// read JSon input
$jsondata=file_get_contents('php://input');
$js = json_decode($jsondata, true);
	
	$email = $js['email'];
	$password = $js['password'];
	
	if(!empty($email) && !empty($password))
	{
	    $query = $conn->prepare("SELECT * FROM `users` where(  `username`= 'raushan' && password = '123456')");
                $query->bind_param("ss", $email,$password);
                $query->execute();
                $result1 = $query->get_result();
                echo 'qewqew';
                if($result1->num_rows  == 1){
                    echo 'llll';
                    $result2 = $result1->fetch_assoc();
                   $json = array("error" => "true", "message" => $result2); 
	    
                }else{
                   	$json = array("error" => "true", "message" => "Invalid Password"); 
                }
	    
	
	}else{
		$json = array("error" => "true", "message" => "User name and Password not blank!");
	}

@mysqli_close($conn);
/* Output header */
 
 header('Content-type: application/json, charset=UTF-8');
 echo json_encode($json);


?>