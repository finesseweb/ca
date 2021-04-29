<?php
error_reporting(E_ALL ^ E_WARNING);
require_once("connect.php");
//require_once 'api_config.php';

// read JSon input
$jsondata=file_get_contents('php://input');
$js = json_decode($jsondata, true);
$id = $js['id'];
$district = $js['district'];
$block = $js['block'];
$panchayat = $js['panchayat'];
$village = $js['village'];
$ward = $js['ward'];
$meeting_date = $js['meeting_date'];
$vhsnc_quorum_ompleted = $js['vhsnc_quorum_ompleted'];
$register_member1 = $js['register_member'];
$register_member = implode(',', $register_member1);
$meeting_facilitated = $js['meeting_facilitated'];
$new_issue = $js['new_issue'];
$decision_taken = $js['decision_taken'];
$solved_issue = $js['solved_issue'];
$issue_category1 = $js['issue_category'];
$issue_level1 = $js['issue_level'];
$issue_details1 = $js['issue_details'];
$decisions_taken1 = $js['decisions_taken'];
$decision_details1 = $js['decision_details'];
$issue_resolved1  = $js['issue_resolved'];
$issue_resolved_date1 = $js['issue_resolved_date'];
$issue_remarks1 = $js['issue_remarks'];
$letter_issued_bpmc1 = $js['letter_issued_bpmc'];
$updated = $js['updated'];

if(!empty($district) && !empty($block) && !empty($panchayat) && !empty($village)){
    
    if($issue_category1){
$letter_issued_bpmc = implode(', ', $letter_issued_bpmc1);
$issue_remarks = implode(', ', $issue_remarks1);
$issue_resolved_date = implode(', ', $issue_resolved_date1);
$issue_resolved = implode(', ', $issue_resolved1);
$decision_details = implode(', ', $decision_details1);
$decisions_taken = implode(', ', $decisions_taken1);
$issue_details = implode(', ', $issue_details1);
$issue_level = implode(', ', $issue_level1);
$issue_category = implode(', ', $issue_category1);
//if($issue_category1){
					  $exarr = explode(",",$issue_category);
                      $count = count($exarr);
                      $cat_name_array = "";
                      
                     // print_r($count); 
                      
                      $exarr1 = explode(",",$issue_remarks);
                      $count1 = count($exarr1);
                      $cat_name_array1 = "";
					  
					  $exarr2 = explode(",",$issue_resolved_date);
                      $count2 = count($exarr2);
                      $cat_name_array2 = "";
					  
					  $exarr3 = explode(",",$issue_resolved);
                      $count3 = count($exarr3);
                      $cat_name_array3 = "";
					  
					  $exarr4 = explode(",",$decision_details);
                      $count4 = count($exarr4);
                      $cat_name_array4 = "";
					  
					  $exarr5 = explode(",",$decisions_taken);
                      $count5 = count($exarr5);
                      $cat_name_array5 = "";
					  
					  $exarr6 = explode(",",$issue_details);
                      $count6 = count($exarr6);
                      $cat_name_array6 = "";
					  
					  $exarr7 = explode(",",$issue_level);
                      $count7 = count($exarr7);
                      $cat_name_array7 = "";
					  
					  $exarr8 = explode(",",$letter_issued_bpmc);
                      $count8 = count($exarr8);
                      $cat_name_array8 = "";
					  
					  for($i=0; $i<=$count; $i++ ){
                         if(!empty($exarr[$i])){
                             $cate= $exarr[$i];
                            $cat_name_array = $cate;
                            
                      // echo $i;
                       
                            $cate1= $exarr1[$i];
                            $cat_name_array1 = $cate1;
							
							$cate2= $exarr2[$i];
                            $cat_name_array2 = $cate2;
							
							$cate3= $exarr3[$i];
                            $cat_name_array3 = $cate3;
							
							$cate4= $exarr4[$i];
                            $cat_name_array4 = $cate4;
							
							$cate5= $exarr5[$i];
                            $cat_name_array5 = $cate5;
							
							$cate6= $exarr6[$i];
                            $cat_name_array6 = $cate6;
							
							$cate7= $exarr7[$i];
                            $cat_name_array7 = $cate7;
							
							$cate8= $exarr8[$i];
                            $cat_name_array8 = $cate8;
                            
       
                            
           if($id){ 
               
      /*  $query = "SELECT * FROM vhsnc_meetings where id ='$id' "; 
        $result =$conn->query($query);
        if($result->num_rows >0 ){
            */                
	 $query = "UPDATE `vhsnc_meetings` SET `district`='".$district."',`block`='".$block."',`panchayat`='".$panchayat."',`village`='".$village."',`ward`='".$ward."',`meeting_date`='".$meeting_date."',`vhsnc_quorum_ompleted`='".$vhsnc_quorum_ompleted."',`register_member`='".$register_member."',`meeting_facilitated`='".$meeting_facilitated."',`new_issue`='".$new_issue."',`decision_taken`='".$decision_taken."',`solved_issue`= '".$solved_issue."',`issue_category`='".$cat_name_array."',`issue_level`='".$cat_name_array7."',`issue_details`='".$cat_name_array6."',`decisions_taken`='".$cat_name_array5."',`decision_details`='".$cat_name_array4."',`issue_resolved`='".$cat_name_array3."',`issue_resolved_date`='".$cat_name_array2."',`issue_remarks`='".$cat_name_array1."',`letter_issued_bpmc`='".$cat_name_array8."',`updated`='".$updated."' WHERE id = '$id'";				  
		$result = mysqli_query($conn, $query);
	$last_id = $id;
	
      /*  }else{
     $json = array("error" => "true", "message" => "Invalid User");
         }*/
	
    }else{

    $query = "INSERT INTO `vhsnc_meetings`(`district`, `block`,`panchayat`,`village`, `ward`, `meeting_date`, `vhsnc_quorum_ompleted`, `register_member`,`meeting_facilitated`, `new_issue`,`decision_taken`, `solved_issue`,`issue_category`, `issue_level`, `issue_details`, `decisions_taken`, `decision_details`,`issue_resolved`, `issue_resolved_date`,`issue_remarks`, `letter_issued_bpmc`, `updated`) VALUES ('".$district. "', '".$block."', '".$panchayat."','".$village."', '".$ward."', '".$meeting_date."', '".$vhsnc_quorum_ompleted."', '".$register_member."', '".$meeting_facilitated."', '".$new_issue."','".$decision_taken."', '".$solved_issue."', '".$cat_name_array."','".$cat_name_array7."', '".$cat_name_array6."', '".$cat_name_array5."', '".$cat_name_array4."', '".$cat_name_array3."', '".$cat_name_array2."','".$cat_name_array1."', '".$cat_name_array8."', '".$updated."')";
    $result = mysqli_query($conn, $query);
    $last_id = mysqli_insert_id($conn);
	}
	}
}

}else{
    $query = "INSERT INTO `vhsnc_meetings`(`district`, `block`,`panchayat`,`village`, `ward`, `meeting_date`, `vhsnc_quorum_ompleted`, `register_member`,`meeting_facilitated`, `new_issue`,`decision_taken`, `solved_issue`,`issue_category`, `issue_level`, `issue_details`, `decisions_taken`, `decision_details`,`issue_resolved`, `issue_resolved_date`,`issue_remarks`, `letter_issued_bpmc`, `updated`) VALUES
    ('".$district. "', '".$block."', '".$panchayat."','".$village."', '".$ward."', '".$meeting_date."', '".$vhsnc_quorum_ompleted."', '".$register_member."', '".$meeting_facilitated."', '".$new_issue."','".$decision_taken."', '".$solved_issue."', '".$issue_category."','".$issue_level."', '".$issue_details."', '".$decisions_taken."', '".$decision_details."', '".$issue_resolved."', '".$issue_resolved_date."','".$issue_remarks."', '".$letter_issued_bpmc."', '".$updated."')";
    $result = mysqli_query($conn, $query);
    $last_id = mysqli_insert_id($conn);	
}
    $query = "SELECT * FROM vhsnc_meetings where id = '$last_id'"; 
    $result1 =$conn->query($query);
       
       
       while($row = $result1->fetch_assoc()) {
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
			
			$query6 = "SELECT * FROM vhsnc_constitutions where `panchayat` = '".$panchayat."' && `block` = '".$block."' && `district` = '".$district."' order by id desc"; 
			$result6 =$conn->query($query6);
			$row6 = $result6->fetch_assoc();
			$v_name = $row6['vhsnc_name'];
			
			$resultset[$i]['ward_name']= $wards;
			$resultset[$i]['district_name']= $disc;
			$resultset[$i]['block_name']= $blocks;
			$resultset[$i]['panchayat_name']= $panch;
			$resultset[$i]['village_name']= $villages;
			$resultset[$i]['ward_name']= $wards;
			$resultset[$i]['vhsnc_name']= $v_name;
			
       $i++;  
      }
	  }
    if($result){
    
    
    $json = array("error" => "false", "message" => "Successfully save.", "total_record" => $resultset);
    
    } else{
        $json = array("error" => "false", "message" => "Record not save.");
    }
    
  
}else{
    $json = array("error" => "true", "message" => "All are required fields.");
}


 
@mysqli_close($conn);
 
/* Output header */
 
 header('Content-type: application/json, charset=UTF-8');
 echo json_encode($json);

?>