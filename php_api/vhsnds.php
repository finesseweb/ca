<?php
error_reporting(E_ALL ^ E_WARNING);
require_once("connect.php");

// read JSon input
$jsondata=file_get_contents('php://input');
$js = json_decode($jsondata, true);


$it_availability = $js['it_availability'];
$height_availability = $js['height_availability'];
$hb_availability = $js['hb_availability'];
$weight_availability = $js['weight_availability'];

$from_date = $js['from_date'];
$to_date = $js['to_date'];
$block = $js['block'];
$panchayat = $js['panchayat'];
$village = $js['village'];


if(!empty($it_availability) && !empty($block) && !empty($panchayat) && !empty($village) && !empty($height_availability) && !empty($weight_availability) && !empty($from_date) && !empty($to_date) && !empty($hb_availability)){
 // All Fields
$query = "SELECT * FROM vhsnds where `it_availability` = '".$it_availability."' && `block` = '".$block."' && `panchayat` = '".$panchayat."' && `village` = '".$village."' && `height_availability` = '".$height_availability."' && `weight_availability` = '".$weight_availability."' && `visit_date` = '".$from_date."' || `visit_date` = '".$to_date."' && `hb_availability` = '".$hb_availability."' order by id desc"; 
 
 }else{
 if(!empty($it_availability) && empty($block) && empty($panchayat) && empty($village) && empty($height_availability) && empty($weight_availability) && empty($from_date) && empty($to_date) && empty($hb_availability)){
 // only name
$query = "SELECT * FROM vhsnds where `it_availability` = '".$it_availability."' order by id desc"; 
 
 }else{
 if(empty($it_availability) && !empty($block) && empty($panchayat) && empty($village) && empty($height_availability) && empty($weight_availability) && empty($from_date) && empty($to_date) && empty($hb_availability)){
 // only block
$query = "SELECT * FROM vhsnds where `block` = '".$block."' order by id desc"; 
 
 }else{
 if(empty($it_availability) && empty($block) && !empty($panchayat) && empty($village) && empty($height_availability) && empty($weight_availability) && empty($from_date) && empty($to_date) && empty($hb_availability)){
 // only panchayat
$query = "SELECT * FROM vhsnds where `panchayat` = '".$panchayat."' order by id desc"; 
 
 }else{
 if(empty($it_availability) && empty($block) && empty($panchayat) && !empty($village) && empty($height_availability) && empty($weight_availability) && empty($from_date) && empty($to_date) && empty($hb_availability)){
 // only village
$query = "SELECT * FROM vhsnds where `village` = '".$village."' order by id desc"; 
 
 }else{
 if(empty($it_availability) && empty($block) && empty($panchayat) && empty($village) && !empty($height_availability) && empty($weight_availability) && empty($from_date) && empty($to_date) && empty($hb_availability)){
 // only height_availability
 $query = "SELECT * FROM vhsnds where `height_availability` = '".$height_availability."' order by id desc"; 
 
 }else{
 if(empty($it_availability) && empty($block) && empty($panchayat) && empty($village) && empty($height_availability) && !empty($weight_availability) && empty($from_date) && empty($to_date) && empty($hb_availability)){
 // only weight_availability
$query = "SELECT * FROM vhsnds where `weight_availability` = '".$weight_availability."' order by id desc"; 
 
 }else{
 if(empty($it_availability) && empty($block) && empty($panchayat) && empty($village) && empty($height_availability) && empty($weight_availability) && !empty($from_date) && empty($to_date) && empty($hb_availability)){
 // only from date
$query = "SELECT * FROM vhsnds where `visit_date` = '".$from_date."' order by id desc"; 
 
 }else{
 if(empty($it_availability) && empty($block) && empty($panchayat) && empty($village) && empty($height_availability) && empty($weight_availability) && empty($from_date) && !empty($to_date) && empty($hb_availability)){
 // only to date
$query = "SELECT * FROM vhsnds where `visit_date` = '".$to_date."' order by id desc"; 
 
 }else{
 if(empty($it_availability) && empty($block) && empty($panchayat) && empty($village) && empty($height_availability) && empty($weight_availability) && empty($from_date) && empty($to_date) && !empty($hb_availability)){
 // only hb_availability
$query = "SELECT * FROM vhsnds where `hb_availability` = '".$hb_availability."' order by id desc"; 
 
 }else{
 if(!empty($it_availability) && !empty($block) && empty($panchayat) && empty($village) && empty($height_availability) && empty($weight_availability) && empty($from_date) && empty($to_date) && empty($hb_availability)){
 // name & block
$query = "SELECT * FROM vhsnds where `it_availability` = '".$it_availability."' && `block` = '".$block."' order by id desc"; 
 
 }else{
 if(!empty($it_availability) && empty($block) && !empty($panchayat) && empty($village) && empty($height_availability) && empty($weight_availability) && empty($from_date) && empty($to_date) && empty($hb_availability)){
 // name & panchayat
$query = "SELECT * FROM vhsnds where `it_availability` = '".$it_availability."' && `panchayat` = '".$panchayat."' order by id desc"; 
 
 }else{
 if(!empty($it_availability) && empty($block) && empty($panchayat) && !empty($village) && empty($height_availability) && empty($weight_availability) && empty($from_date) && empty($to_date) && empty($hb_availability)){
 // name & village
 $query = "SELECT * FROM vhsnds where `it_availability` = '".$it_availability."' && `village` = '".$village."' order by id desc"; 
 
 }else{
 if(!empty($it_availability) && empty($block) && empty($panchayat) && empty($village) && !empty($height_availability) && empty($weight_availability) && empty($from_date) && empty($to_date) && empty($hb_availability)){
 // name & height_availability
 $query = "SELECT * FROM vhsnds where `it_availability` = '".$it_availability."' && `height_availability` = '".$height_availability."' order by id desc"; 

 }else{
 if(!empty($it_availability) && empty($block) && empty($panchayat) && empty($village) && empty($height_availability) && !empty($weight_availability) && empty($from_date) && empty($to_date) && empty($hb_availability)){
 // name & weight_availability
 $query = "SELECT * FROM vhsnds where `it_availability` = '".$it_availability."' && `weight_availability` = '".$weight_availability."' order by id desc"; 

 }else{
 if(!empty($it_availability) && empty($block) && empty($panchayat) && empty($village) && empty($height_availability) && empty($weight_availability) && !empty($from_date) && empty($to_date) && empty($hb_availability)){
// name & from_date
 $query = "SELECT * FROM vhsnds where `it_availability` = '".$it_availability."' && `visit_date` = '".$from_date."' order by id desc"; 

 }else{
 if(!empty($it_availability) && empty($block) && empty($panchayat) && empty($village) && empty($height_availability) && empty($weight_availability) && empty($from_date) && !empty($to_date) && empty($hb_availability)){
 // name & to_date
 $query = "SELECT * FROM vhsnds where `it_availability` = '".$it_availability."' && `visit_date` = '".$to_date."' order by id desc"; 

 }else{
 if(!empty($it_availability) && empty($block) && empty($panchayat) && empty($village) && empty($height_availability) && empty($weight_availability) && empty($from_date) && empty($to_date) && !empty($hb_availability)){
 // name & hb_availability
 $query = "SELECT * FROM vhsnds where `it_availability` = '".$it_availability."' && `hb_availability` = '".$hb_availability."' order by id desc"; 

 }else{
 if(!empty($it_availability) && !empty($block) && empty($panchayat) && empty($village) && empty($height_availability) && empty($weight_availability) && empty($from_date) && empty($to_date) && empty($hb_availability)){
 // block & it_availability
 $query = "SELECT * FROM vhsnds where `block` = '".$block."' && `it_availability` = '".$it_availability."' order by id desc"; 

 }else{
 if(empty($it_availability) && !empty($block) && !empty($panchayat) && empty($village) && empty($height_availability) && empty($weight_availability) && empty($from_date) && empty($to_date) && empty($hb_availability)){
 // block & panchayat
 $query = "SELECT * FROM vhsnds where `block` = '".$block."' && `panchayat` = '".$panchayat."' order by id desc"; 

 }else{
 if(empty($it_availability) && !empty($block) && empty($panchayat) && !empty($village) && empty($height_availability) && empty($weight_availability) && empty($from_date) && empty($to_date) && empty($hb_availability)){
 // block & village
 $query = "SELECT * FROM vhsnds where `block` = '".$block."' && `village` = '".$village."' order by id desc"; 

 }else{
 if(empty($it_availability) && !empty($block) && empty($panchayat) && empty($village) && !empty($height_availability) && empty($weight_availability) && empty($from_date) && empty($to_date) && empty($hb_availability)){
 // block & height_availability
 $query = "SELECT * FROM vhsnds where `block` = '".$block."' && `height_availability` = '".$height_availability."' order by id desc"; 

 }else{
 if(empty($it_availability) && !empty($block) && empty($panchayat) && empty($village) && empty($height_availability) && !empty($weight_availability) && empty($from_date) && empty($to_date) && empty($hb_availability)){
 // block & weight_availability
 $query = "SELECT * FROM vhsnds where `block` = '".$block."' && `weight_availability` = '".$weight_availability."' order by id desc"; 

 }else{
 if(empty($it_availability) && !empty($block) && empty($panchayat) && empty($village) && empty($height_availability) && empty($weight_availability) && !empty($from_date) && empty($to_date) && empty($hb_availability)){
 // block & from_date
 $query = "SELECT * FROM vhsnds where `block` = '".$block."' && `visit_date` = '".$from_date."' order by id desc"; 

 }else{
 if(empty($it_availability) && !empty($block) && empty($panchayat) && empty($village) && empty($height_availability) && empty($weight_availability) && empty($from_date) && !empty($to_date) && empty($hb_availability)){
 // block & to_date
 $query = "SELECT * FROM vhsnds where `block` = '".$block."' && `visit_date` = '".$to_date."' order by id desc"; 

 }else{
 if(empty($it_availability) && !empty($block) && empty($panchayat) && empty($village) && empty($height_availability) && empty($weight_availability) && empty($from_date) && empty($to_date) && !empty($hb_availability)){
 // block & hb_availability
 $query = "SELECT * FROM vhsnds where `block` = '".$block."' && `hb_availability` = '".$hb_availability."' order by id desc"; 

 }else{
 if(!empty($it_availability) && empty($block) && !empty($panchayat) && empty($village) && empty($height_availability) && empty($weight_availability) && empty($from_date) && empty($to_date) && empty($hb_availability)){
 // panchayat & it_availability
 $query = "SELECT * FROM vhsnds where `panchayat` = '".$panchayat."' && `it_availability` = '".$it_availability."' order by id desc"; 

 }else{
 if(empty($it_availability) && !empty($block) && !empty($panchayat) && empty($village) && empty($height_availability) && empty($weight_availability) && empty($from_date) && empty($to_date) && empty($hb_availability)){
 // panchayat & block
 $query = "SELECT * FROM vhsnds where `panchayat` = '".$panchayat."' && `block` = '".$block."' order by id desc"; 

 }else{
 if(empty($it_availability) && empty($block) && !empty($panchayat) && !empty($village) && empty($height_availability) && empty($weight_availability) && empty($from_date) && empty($to_date) && empty($hb_availability)){
 // panchayat & village
 $query = "SELECT * FROM vhsnds where `panchayat` = '".$panchayat."' && `village` = '".$village."' order by id desc"; 

 }else{
 if(empty($it_availability) && empty($block) && !empty($panchayat) && empty($village) && !empty($height_availability) && empty($weight_availability) && empty($from_date) && empty($to_date) && empty($hb_availability)){
 // panchayat & height_availability
 $query = "SELECT * FROM vhsnds where `panchayat` = '".$panchayat."' && `height_availability` = '".$height_availability."' order by id desc"; 

 }else{
 if(empty($it_availability) && empty($block) && !empty($panchayat) && empty($village) && empty($height_availability) && !empty($weight_availability) && empty($from_date) && empty($to_date) && empty($hb_availability)){
 // panchayat & weight_availability
 $query = "SELECT * FROM vhsnds where `panchayat` = '".$panchayat."' && `weight_availability` = '".$weight_availability."' order by id desc"; 

 }else{
 if(empty($it_availability) && empty($block) && !empty($panchayat) && empty($village) && empty($height_availability) && empty($weight_availability) && !empty($from_date) && empty($to_date) && empty($hb_availability)){
 // panchayat & from_date
 $query = "SELECT * FROM vhsnds where `panchayat` = '".$panchayat."' && `visit_date` = '".$from_date."' order by id desc"; 

 }else{
 if(empty($it_availability) && empty($block) && !empty($panchayat) && empty($village) && empty($height_availability) && empty($weight_availability) && empty($from_date) && !empty($to_date) && empty($hb_availability)){
 // panchayat & to_date
 $query = "SELECT * FROM vhsnds where `panchayat` = '".$panchayat."' && `visit_date` = '".$to_date."' order by id desc"; 

 }else{
 if(empty($it_availability) && empty($block) && !empty($panchayat) && empty($village) && empty($height_availability) && empty($weight_availability) && empty($from_date) && empty($to_date) && !empty($hb_availability)){
 // panchayat & hb_availability
 $query = "SELECT * FROM vhsnds where `panchayat` = '".$panchayat."' && `hb_availability` = '".$hb_availability."' order by id desc"; 

 }else{
 if(!empty($it_availability) && empty($block) && empty($panchayat) && !empty($village) && empty($height_availability) && empty($weight_availability) && empty($from_date) && empty($to_date) && empty($hb_availability)){
 // village & it_availability
 $query = "SELECT * FROM vhsnds where `village` = '".$village."' && `it_availability` = '".$it_availability."' order by id desc"; 

 }else{
 if(empty($it_availability) && !empty($block) && empty($panchayat) && !empty($village) && empty($height_availability) && empty($weight_availability) && empty($from_date) && empty($to_date) && empty($hb_availability)){
 // village & block
 $query = "SELECT * FROM vhsnds where `village` = '".$village."' && `block` = '".$block."' order by id desc"; 

 }else{
 if(empty($it_availability) && empty($block) && !empty($panchayat) && !empty($village) && empty($height_availability) && empty($weight_availability) && empty($from_date) && empty($to_date) && empty($hb_availability)){
 // village & panchayat
 $query = "SELECT * FROM vhsnds where `village` = '".$village."' && `panchayat` = '".$panchayat."' order by id desc"; 

 }else{
 if(empty($it_availability) && empty($block) && empty($panchayat) && !empty($village) && !empty($height_availability) && empty($weight_availability) && empty($from_date) && empty($to_date) && empty($hb_availability)){
 // village & height_availability
 $query = "SELECT * FROM vhsnds where `village` = '".$village."' && `height_availability` = '".$height_availability."' order by id desc"; 

 }else{
 if(empty($it_availability) && empty($block) && empty($panchayat) && !empty($village) && empty($height_availability) && !empty($weight_availability) && empty($from_date) && empty($to_date) && empty($hb_availability)){
 // village & weight_availability
 $query = "SELECT * FROM vhsnds where `village` = '".$village."' && `weight_availability` = '".$weight_availability."' order by id desc"; 

 }else{
 if(empty($it_availability) && empty($block) && empty($panchayat) && !empty($village) && empty($height_availability) && empty($weight_availability) && !empty($from_date) && empty($to_date) && empty($hb_availability)){
 // village & from_date
 $query = "SELECT * FROM vhsnds where `village` = '".$village."' && `visit_date` = '".$from_date."' order by id desc"; 

 }else{
 if(empty($it_availability) && empty($block) && empty($panchayat) && !empty($village) && empty($height_availability) && empty($weight_availability) && empty($from_date) && !empty($to_date) && empty($hb_availability)){
 // village & to_date
 $query = "SELECT * FROM vhsnds where `village` = '".$village."' && `visit_date` = '".$to_date."' order by id desc"; 

 }else{
 if(empty($it_availability) && empty($block) && empty($panchayat) && !empty($village) && empty($height_availability) && empty($weight_availability) && empty($from_date) && empty($to_date) && !empty($hb_availability)){
 // village & hb_availability
 $query = "SELECT * FROM vhsnds where `village` = '".$village."' && `hb_availability` = '".$hb_availability."' order by id desc"; 

 }else{
 
 /////////************************///////////////////*******************//////////////////
 
 
 if(empty($it_availability) && empty($block) && empty($panchayat) && empty($village) && empty($height_availability) && empty($weight_availability) && empty($from_date) && !empty($to_date) && !empty($hb_availability)){
 // from_date & to_date
 $query = "SELECT * FROM vhsnds where `visit_date` BETWEEN '".$from_date."' && '".$to_date."' order by id desc"; 

 }else{
 if(empty($it_availability) && !empty($block) && !empty($panchayat) && !empty($village) && empty($height_availability) && empty($weight_availability) && empty($from_date) && empty($to_date) && empty($hb_availability)){
 // village & block
 $query = "SELECT * FROM vhsnds where `panchayat` = '".$panchayat."' && `village` = '".$village."' && `block` = '".$block."' order by id desc"; 

 }
 
 
   else{ 
   $query = "SELECT * FROM vhsnds order by id desc"; 
   }
   
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   }
   
   


   // $query = "SELECT * FROM vhsnds order by id desc"; 
    $result =$conn->query($query);
       
       
       while($row = $result->fetch_assoc()) {
   $resultset[] = $row;
     }
	  if(!empty($resultset)){
 $i=0; 	
      foreach($resultset as $result2){
        		   
			$district = $result2['district'];
			$block = $result2['block'];
			$panchayat = $result2['panchayat'];
			$village = $result2['village'];
			$ward = $result2['ward'];
			
			$query1 = "SELECT * FROM cities where `id` = '".$district."' order by id desc"; 
			$result1 =$conn->query($query1);
			$row1 = $result1->fetch_assoc();
			$disc = $row1['name'];
			
			$query2 = "SELECT * FROM blocks where `id` = '".$block."' order by id desc"; 
			$result2 =$conn->query($query2);
			$row2 = $result2->fetch_assoc();
			$blocks = $row2['name'];
			
			$query3 = "SELECT * FROM panchayats where `id` = '".$panchayat."' order by id desc"; 
			$result3 =$conn->query($query3);
			$row3 = $result3->fetch_assoc();
			$panch = $row3['name'];
			
			$query4 = "SELECT * FROM villages where `id` = '".$village."' order by id desc"; 
			$result4 =$conn->query($query4);
			$row4 = $result4->fetch_assoc();
			$villages = $row4['name'];
			
			//$query5 = "SELECT * FROM wards where `id` = '".$ward."' && `village_id` = '".$village."' && `panchayat_id` = '".$panchayat."' && `block_id` = '".$block."' && `city_id` = '".$district."' order by id desc"; 
			
			$query5 = "SELECT * FROM wards where `id` = '".$ward."' order by id desc"; 
			$result5 =$conn->query($query5);
			$row5 = $result5->fetch_assoc();
			$wards = $row5['name'];
			
		/*	$query6 = "SELECT * FROM vhsnc_constitutions where `panchayat` = '".$panchayat."' && `block` = '".$block."' && `district` = '".$district."' order by id desc"; 
			$result6 =$conn->query($query6);
			$row6 = $result6->fetch_assoc();
			$v_name = $row6['vhsnc_name'];*/
			
			$resultset[$i]['ward_name']= $wards;
			$resultset[$i]['district_name']= $disc;
			$resultset[$i]['block_name']= $blocks;
			$resultset[$i]['panchayat_name']= $panch;
			$resultset[$i]['village_name']= $villages;
			$resultset[$i]['ward_name']= $wards;
			//$resultset[$i]['vhsnc_name']= $v_name;
			
       $i++;  
      }
     $json = array("error" => "false", "message" => $resultset);
        }else{
        $json = array("error" => "true", "message" => "No record found");
     }  
   

@mysqli_close($conn);
 
/* Output header */
 
 header('Content-type: application/json, charset=UTF-8');
 echo json_encode($json);

?>