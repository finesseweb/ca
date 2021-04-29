<?php
error_reporting(E_ALL ^ E_WARNING);
require_once("connect.php");

// read JSon input
$jsondata=file_get_contents('php://input');
$js = json_decode($jsondata, true);


$decisions_taken = $js['decisions_taken'];
$issue_resolved = $js['issue_resolved'];
$issue_details = $js['issue_details'];
$vhsnc_quorum_ompleted = $js['vhsnc_quorum_ompleted'];
$from_date = $js['from_date'];
$to_date = $js['to_date'];
$block = $js['block'];
$panchayat = $js['panchayat'];
$village = $js['village'];


if(!empty($decisions_taken) && !empty($block) && !empty($panchayat) && !empty($village) && !empty($issue_resolved) && !empty($vhsnc_quorum_ompleted) && !empty($from_date) && !empty($to_date) && !empty($issue_details)){
 // All Fields
$query = "SELECT * FROM vhsnc_meetings where `decisions_taken` = '".$decisions_taken."' && `block` = '".$block."' && `panchayat` = '".$panchayat."' && `village` = '".$village."' && `issue_resolved` = '".$issue_resolved."' && `vhsnc_quorum_ompleted` = '".$vhsnc_quorum_ompleted."' && `visit_date` = '".$from_date."' || `visit_date` = '".$to_date."' && `issue_details` = '".$issue_details."' order by id desc"; 
 
 }else{
 if(!empty($decisions_taken) && empty($block) && empty($panchayat) && empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && empty($to_date) && empty($issue_details)){
 // only name
$query = "SELECT * FROM vhsnc_meetings where `decisions_taken` = '".$decisions_taken."' order by id desc"; 
 
 }else{
 if(empty($decisions_taken) && !empty($block) && empty($panchayat) && empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && empty($to_date) && empty($issue_details)){
 // only block
$query = "SELECT * FROM vhsnc_meetings where `block` = '".$block."' order by id desc"; 
 
 }else{
 if(empty($decisions_taken) && empty($block) && !empty($panchayat) && empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && empty($to_date) && empty($issue_details)){
 // only panchayat
$query = "SELECT * FROM vhsnc_meetings where `panchayat` = '".$panchayat."' order by id desc"; 
 
 }else{
 if(empty($decisions_taken) && empty($block) && empty($panchayat) && !empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && empty($to_date) && empty($issue_details)){
 // only village
$query = "SELECT * FROM vhsnc_meetings where `village` = '".$village."' order by id desc"; 
 
 }else{
 if(empty($decisions_taken) && empty($block) && empty($panchayat) && empty($village) && !empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && empty($to_date) && empty($issue_details)){
 // only issue_resolved
 $query = "SELECT * FROM vhsnc_meetings where `issue_resolved` = '".$issue_resolved."' order by id desc"; 
 
 }else{
 if(empty($decisions_taken) && empty($block) && empty($panchayat) && empty($village) && empty($issue_resolved) && !empty($vhsnc_quorum_ompleted) && empty($from_date) && empty($to_date) && empty($issue_details)){
 // only vhsnc_quorum_ompleted
$query = "SELECT * FROM vhsnc_meetings where `vhsnc_quorum_ompleted` = '".$vhsnc_quorum_ompleted."' order by id desc"; 
 
 }else{
 if(empty($decisions_taken) && empty($block) && empty($panchayat) && empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && !empty($from_date) && empty($to_date) && empty($issue_details)){
 // only from date
$query = "SELECT * FROM vhsnc_meetings where `visit_date` = '".$from_date."' order by id desc"; 
 
 }else{
 if(empty($decisions_taken) && empty($block) && empty($panchayat) && empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && !empty($to_date) && empty($issue_details)){
 // only to date
$query = "SELECT * FROM vhsnc_meetings where `visit_date` = '".$to_date."' order by id desc"; 
 
 }else{
 if(empty($decisions_taken) && empty($block) && empty($panchayat) && empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && empty($to_date) && !empty($issue_details)){
 // only issue_details
$query = "SELECT * FROM vhsnc_meetings where `issue_details` = '".$issue_details."' order by id desc"; 
 
 }else{
 if(!empty($decisions_taken) && !empty($block) && empty($panchayat) && empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && empty($to_date) && empty($issue_details)){
 // name & block
$query = "SELECT * FROM vhsnc_meetings where `decisions_taken` = '".$decisions_taken."' && `block` = '".$block."' order by id desc"; 
 
 }else{
 if(!empty($decisions_taken) && empty($block) && !empty($panchayat) && empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && empty($to_date) && empty($issue_details)){
 // name & panchayat
$query = "SELECT * FROM vhsnc_meetings where `decisions_taken` = '".$decisions_taken."' && `panchayat` = '".$panchayat."' order by id desc"; 
 
 }else{
 if(!empty($decisions_taken) && empty($block) && empty($panchayat) && !empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && empty($to_date) && empty($issue_details)){
 // name & village
 $query = "SELECT * FROM vhsnc_meetings where `decisions_taken` = '".$decisions_taken."' && `village` = '".$village."' order by id desc"; 
 
 }else{
 if(!empty($decisions_taken) && empty($block) && empty($panchayat) && empty($village) && !empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && empty($to_date) && empty($issue_details)){
 // name & issue_resolved
 $query = "SELECT * FROM vhsnc_meetings where `decisions_taken` = '".$decisions_taken."' && `issue_resolved` = '".$issue_resolved."' order by id desc"; 

 }else{
 if(!empty($decisions_taken) && empty($block) && empty($panchayat) && empty($village) && empty($issue_resolved) && !empty($vhsnc_quorum_ompleted) && empty($from_date) && empty($to_date) && empty($issue_details)){
 // name & vhsnc_quorum_ompleted
 $query = "SELECT * FROM vhsnc_meetings where `decisions_taken` = '".$decisions_taken."' && `vhsnc_quorum_ompleted` = '".$vhsnc_quorum_ompleted."' order by id desc"; 

 }else{
 if(!empty($decisions_taken) && empty($block) && empty($panchayat) && empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && !empty($from_date) && empty($to_date) && empty($issue_details)){
// name & from_date
 $query = "SELECT * FROM vhsnc_meetings where `decisions_taken` = '".$decisions_taken."' && `visit_date` = '".$from_date."' order by id desc"; 

 }else{
 if(!empty($decisions_taken) && empty($block) && empty($panchayat) && empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && !empty($to_date) && empty($issue_details)){
 // name & to_date
 $query = "SELECT * FROM vhsnc_meetings where `decisions_taken` = '".$decisions_taken."' && `visit_date` = '".$to_date."' order by id desc"; 

 }else{
 if(!empty($decisions_taken) && empty($block) && empty($panchayat) && empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && empty($to_date) && !empty($issue_details)){
 // name & issue_details
 $query = "SELECT * FROM vhsnc_meetings where `decisions_taken` = '".$decisions_taken."' && `issue_details` = '".$issue_details."' order by id desc"; 

 }else{
 if(!empty($decisions_taken) && !empty($block) && empty($panchayat) && empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && empty($to_date) && empty($issue_details)){
 // block & decisions_taken
 $query = "SELECT * FROM vhsnc_meetings where `block` = '".$block."' && `decisions_taken` = '".$decisions_taken."' order by id desc"; 

 }else{
 if(empty($decisions_taken) && !empty($block) && !empty($panchayat) && empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && empty($to_date) && empty($issue_details)){
 // block & panchayat
 $query = "SELECT * FROM vhsnc_meetings where `block` = '".$block."' && `panchayat` = '".$panchayat."' order by id desc"; 

 }else{
 if(empty($decisions_taken) && !empty($block) && empty($panchayat) && !empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && empty($to_date) && empty($issue_details)){
 // block & village
 $query = "SELECT * FROM vhsnc_meetings where `block` = '".$block."' && `village` = '".$village."' order by id desc"; 

 }else{
 if(empty($decisions_taken) && !empty($block) && empty($panchayat) && empty($village) && !empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && empty($to_date) && empty($issue_details)){
 // block & issue_resolved
 $query = "SELECT * FROM vhsnc_meetings where `block` = '".$block."' && `issue_resolved` = '".$issue_resolved."' order by id desc"; 

 }else{
 if(empty($decisions_taken) && !empty($block) && empty($panchayat) && empty($village) && empty($issue_resolved) && !empty($vhsnc_quorum_ompleted) && empty($from_date) && empty($to_date) && empty($issue_details)){
 // block & vhsnc_quorum_ompleted
 $query = "SELECT * FROM vhsnc_meetings where `block` = '".$block."' && `vhsnc_quorum_ompleted` = '".$vhsnc_quorum_ompleted."' order by id desc"; 

 }else{
 if(empty($decisions_taken) && !empty($block) && empty($panchayat) && empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && !empty($from_date) && empty($to_date) && empty($issue_details)){
 // block & from_date
 $query = "SELECT * FROM vhsnc_meetings where `block` = '".$block."' && `visit_date` = '".$from_date."' order by id desc"; 

 }else{
 if(empty($decisions_taken) && !empty($block) && empty($panchayat) && empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && !empty($to_date) && empty($issue_details)){
 // block & to_date
 $query = "SELECT * FROM vhsnc_meetings where `block` = '".$block."' && `visit_date` = '".$to_date."' order by id desc"; 

 }else{
 if(empty($decisions_taken) && !empty($block) && empty($panchayat) && empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && empty($to_date) && !empty($issue_details)){
 // block & issue_details
 $query = "SELECT * FROM vhsnc_meetings where `block` = '".$block."' && `issue_details` = '".$issue_details."' order by id desc"; 

 }else{
 if(!empty($decisions_taken) && empty($block) && !empty($panchayat) && empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && empty($to_date) && empty($issue_details)){
 // panchayat & decisions_taken
 $query = "SELECT * FROM vhsnc_meetings where `panchayat` = '".$panchayat."' && `decisions_taken` = '".$decisions_taken."' order by id desc"; 

 }else{
 if(empty($decisions_taken) && !empty($block) && !empty($panchayat) && empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && empty($to_date) && empty($issue_details)){
 // panchayat & block
 $query = "SELECT * FROM vhsnc_meetings where `panchayat` = '".$panchayat."' && `block` = '".$block."' order by id desc"; 

 }else{
 if(empty($decisions_taken) && empty($block) && !empty($panchayat) && !empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && empty($to_date) && empty($issue_details)){
 // panchayat & village
 $query = "SELECT * FROM vhsnc_meetings where `panchayat` = '".$panchayat."' && `village` = '".$village."' order by id desc"; 

 }else{
 if(empty($decisions_taken) && empty($block) && !empty($panchayat) && empty($village) && !empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && empty($to_date) && empty($issue_details)){
 // panchayat & issue_resolved
 $query = "SELECT * FROM vhsnc_meetings where `panchayat` = '".$panchayat."' && `issue_resolved` = '".$issue_resolved."' order by id desc"; 

 }else{
 if(empty($decisions_taken) && empty($block) && !empty($panchayat) && empty($village) && empty($issue_resolved) && !empty($vhsnc_quorum_ompleted) && empty($from_date) && empty($to_date) && empty($issue_details)){
 // panchayat & vhsnc_quorum_ompleted
 $query = "SELECT * FROM vhsnc_meetings where `panchayat` = '".$panchayat."' && `vhsnc_quorum_ompleted` = '".$vhsnc_quorum_ompleted."' order by id desc"; 

 }else{
 if(empty($decisions_taken) && empty($block) && !empty($panchayat) && empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && !empty($from_date) && empty($to_date) && empty($issue_details)){
 // panchayat & from_date
 $query = "SELECT * FROM vhsnc_meetings where `panchayat` = '".$panchayat."' && `visit_date` = '".$from_date."' order by id desc"; 

 }else{
 if(empty($decisions_taken) && empty($block) && !empty($panchayat) && empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && !empty($to_date) && empty($issue_details)){
 // panchayat & to_date
 $query = "SELECT * FROM vhsnc_meetings where `panchayat` = '".$panchayat."' && `visit_date` = '".$to_date."' order by id desc"; 

 }else{
 if(empty($decisions_taken) && empty($block) && !empty($panchayat) && empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && empty($to_date) && !empty($issue_details)){
 // panchayat & issue_details
 $query = "SELECT * FROM vhsnc_meetings where `panchayat` = '".$panchayat."' && `issue_details` = '".$issue_details."' order by id desc"; 

 }else{
 if(!empty($decisions_taken) && empty($block) && empty($panchayat) && !empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && empty($to_date) && empty($issue_details)){
 // village & decisions_taken
 $query = "SELECT * FROM vhsnc_meetings where `village` = '".$village."' && `decisions_taken` = '".$decisions_taken."' order by id desc"; 

 }else{
 if(empty($decisions_taken) && !empty($block) && empty($panchayat) && !empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && empty($to_date) && empty($issue_details)){
 // village & block
 $query = "SELECT * FROM vhsnc_meetings where `village` = '".$village."' && `block` = '".$block."' order by id desc"; 

 }else{
 if(empty($decisions_taken) && empty($block) && !empty($panchayat) && !empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && empty($to_date) && empty($issue_details)){
 // village & panchayat
 $query = "SELECT * FROM vhsnc_meetings where `village` = '".$village."' && `panchayat` = '".$panchayat."' order by id desc"; 

 }else{
 if(empty($decisions_taken) && empty($block) && empty($panchayat) && !empty($village) && !empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && empty($to_date) && empty($issue_details)){
 // village & issue_resolved
 $query = "SELECT * FROM vhsnc_meetings where `village` = '".$village."' && `issue_resolved` = '".$issue_resolved."' order by id desc"; 

 }else{
 if(empty($decisions_taken) && empty($block) && empty($panchayat) && !empty($village) && empty($issue_resolved) && !empty($vhsnc_quorum_ompleted) && empty($from_date) && empty($to_date) && empty($issue_details)){
 // village & vhsnc_quorum_ompleted
 $query = "SELECT * FROM vhsnc_meetings where `village` = '".$village."' && `vhsnc_quorum_ompleted` = '".$vhsnc_quorum_ompleted."' order by id desc"; 

 }else{
 if(empty($decisions_taken) && empty($block) && empty($panchayat) && !empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && !empty($from_date) && empty($to_date) && empty($issue_details)){
 // village & from_date
 $query = "SELECT * FROM vhsnc_meetings where `village` = '".$village."' && `visit_date` = '".$from_date."' order by id desc"; 

 }else{
 if(empty($decisions_taken) && empty($block) && empty($panchayat) && !empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && !empty($to_date) && empty($issue_details)){
 // village & to_date
 $query = "SELECT * FROM vhsnc_meetings where `village` = '".$village."' && `visit_date` = '".$to_date."' order by id desc"; 

 }else{
 if(empty($decisions_taken) && empty($block) && empty($panchayat) && !empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && empty($to_date) && !empty($issue_details)){
 // village & issue_details
 $query = "SELECT * FROM vhsnc_meetings where `village` = '".$village."' && `issue_details` = '".$issue_details."' order by id desc"; 

 }else{
 
 /////////************************///////////////////*******************//////////////////
 
 
 if(empty($decisions_taken) && empty($block) && empty($panchayat) && empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && !empty($to_date) && !empty($issue_details)){
 // from_date & to_date
 $query = "SELECT * FROM vhsnc_meetings where `visit_date` BETWEEN '".$from_date."' && '".$to_date."' order by id desc"; 

 }else{
 if(empty($decisions_taken) && !empty($block) && !empty($panchayat) && !empty($village) && empty($issue_resolved) && empty($vhsnc_quorum_ompleted) && empty($from_date) && empty($to_date) && empty($issue_details)){
 // village & block
 $query = "SELECT * FROM vhsnc_meetings where `panchayat` = '".$panchayat."' && `village` = '".$village."' && `block` = '".$block."' order by id desc"; 

 }
 
 
   else{ 
   $query = "SELECT * FROM vhsnc_meetings order by id desc"; 
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
   
   


  //  $query = "SELECT * FROM vhsnc_meetings order by id desc"; 
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
			$issue_category = $result2['issue_category'];
			$issue_level = $result2['issue_level'];
			
			$register_member = $result2['register_member'];
			
			$exarrs = explode(",",$register_member);
			$counts = count($exarrs);
                      $cat_name_arrays = "";
                      for($is=0; $is<$counts; $is++ ){
                         if(!empty($exarrs[$is])){
                             $cates= $exarrs[$is];
                            
                             
                             
            $query91 = "SELECT * FROM register_members where `id` = '".$cates."' order by id desc"; 
            $result91 = mysqli_query($conn, $query91);
            $row91 = $result91->fetch_assoc();
			$convinced1 = $row91['name'];
			$cat_name1 = $convinced1.",";  
                         $cat_name_arrays = $cat_name_arrays.$cat_name1;
                         //  print_r($cat_name_arrays);
                             
                         }
                     }
		
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
			
			$query6 = "SELECT * FROM vhsnc_constitutions where `panchayat` = '".$panchayat."' && `block` = '".$block."' && `district` = '".$district."' order by id desc"; 
			$result6 =$conn->query($query6);
			$row6 = $result6->fetch_assoc();
			$v_name = $row6['vhsnc_name'];
			
			$query7 = "SELECT * FROM issue_category where `id` = '".$issue_category."' order by id desc"; 
			$result7 =$conn->query($query7);
			$row7 = $result7->fetch_assoc();
			$issue_category = $row7['name'];
			
			$query8 = "SELECT * FROM issue_subcategory where `id` = '".$issue_level."' order by id desc"; 
			$result8 =$conn->query($query8);
			$row8 = $result8->fetch_assoc();
			$issue_subcategory = $row8['name'];
			
			$resultset[$i]['ward_name']= $wards;
			$resultset[$i]['district_name']= $disc;
			$resultset[$i]['block_name']= $blocks;
			$resultset[$i]['panchayat_name']= $panch;
			$resultset[$i]['village_name']= $villages;
			$resultset[$i]['ward_name']= $wards;
			$resultset[$i]['vhsnc_name']= $v_name;
			$resultset[$i]['issue_category_name']= $issue_category;
			$resultset[$i]['issue_subcategory_name']= $issue_subcategory;
			$resultset[$i]['register_member_name']= $cat_name_arrays;
			
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