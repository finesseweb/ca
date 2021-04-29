<?php
	error_reporting(E_ALL ^ E_WARNING);
	require_once("connect.php");
	
	$jsondata = file_get_contents('php://input');
	$js = json_decode($jsondata, true);
	
	$email = $js['email'];
	$password = $js['password'];
	
	if(!empty($email) && !empty($password))
	{
		$query = "select * from `users` where `username` = '".$email."' ";
		$result =$conn->query($query);
		
		 if($result->num_rows >0 ){
		     
		
		
				foreach($result as $result1){
				   
				$id = $result1['id'];
				$name = $result1['username'];
				$email = $result1['email'];
			    $pass = $result1['password'];
				if($pass==$password)
				{
				    foreach($result as $result1){
					    $db_user_id = $result1['id'];
		                $db_user_name = $result1['name'];
                        $db_email = $result1['email'];
                        
					$json = array("error" => "false", "message" => "Login successfully", "user_id" => $db_user_id, "user_name" => $db_user_name, "user_email" =>$db_email );
					      }
						
			
				}
				else{
					$json = array("error" => "true", "message" => "Invalid Password");
				}
			
				}
		
	
		 }else{
     $json = array("error" => "true", "message" => "Invalid User");
         }
	}else{
		$json = array("error" => "true", "message" => "User name and Password not blank!");
	}
    
   
	


@mysqli_close($conn);
 
/* Output header */
 
 header('Content-type: application/json, charset=UTF-8');
 echo json_encode($json);


?>