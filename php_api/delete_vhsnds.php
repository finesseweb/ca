<?php
error_reporting(E_ALL ^ E_WARNING);
require_once("connect.php");

// read JSon input
$jsondata=file_get_contents('php://input');
$js = json_decode($jsondata, true);

     
$id = $js['id'];


if(!empty($id) ){
    
     $query = "select * FROM vhsnds WHERE id = '$id'"; 
    $result = mysqli_query($conn, $query);
$row = mysqli_num_rows($result);

if($row > 0 ){
      
     $query = "DELETE FROM vhsnds WHERE id = '$id' "; 
   
    $result = mysqli_query($conn, $query);
    
       
$json = array("error" => "false", "message" => "Record Deleted");

}else{
  $json = array("error" => "true", "message" => "ID not valid");
 }

}else{
  $json = array("error" => "true", "message" => "Required fields.");
 }
 
  

@mysqli_close($conn);
 
/* Output header */
 
 header('Content-type: application/json, charset=UTF-8');
 echo json_encode($json);

?>