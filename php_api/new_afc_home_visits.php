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
$visit_date = $js['visit_date'];
$asha_accompanied = $js['asha_accompanied'];
$asha_reason = $js['asha_reason'];
$aww_accompanied = $js['aww_accompanied'];
$aww_reason = $js['aww_reason'];
$pri_accompanied = $js['pri_accompanied'];
$pri_reason = $js['pri_reason'];
$couple_name = $js['couple_name'];
$age = $js['age'];
$gender = $js['gender'];
$mobile = $js['mobile'];
$no_of_child = $js['no_of_child'];
$yonger_child_age  = $js['yonger_child_age'];
$current_contraceptives = $js['current_contraceptives'];
$commodities_regular_supply = $js['commodities_regular_supply'];
$commodities_reason = $js['commodities_reason'];
$beneficiary_couselled1 = $js['beneficiary_couselled'];
$beneficiary_couselled = implode(',', $beneficiary_couselled1);
$convinced = $js['convinced'];
$contraceptives_delivery_date = $js['contraceptives_delivery_date'];
$sterilisation_of_month = $js['sterilisation_of_month'];
$follow_visit_date = $js['follow_visit_date'];
$remarks = $js['remarks'];
$shg_accompanied = $js['shg_accompanied'];
$shg_reason = $js['shg_reason'];
$updated = $js['updated'];

@$status = "";


if(!empty($district) && !empty($block) && !empty($panchayat) && !empty($village) && !empty($ward) && !empty($age) && !empty($gender) && !empty($mobile) && !empty($no_of_child) && !empty($village) && !empty($ward) && !empty($age) && !empty($gender)){
    
   /* $qry = "select * from description where id = '".$description_id."'";
    $result1 = mysqli_query($conn, $qry);
   // print_r($result1);
   $test = mysqli_fetch_array($result1);
 
        $desc_id = $test['id'];
        @$description = trim($test['description']);
        
  */
  
  if($id){
  
  
    $query = "UPDATE `afc_home_visits` SET `district`='".$district."',`block`='".$block."',`panchayat`='".$panchayat."',`village`='".$village."',`ward`='".$ward."',`visit_date`='".$visit_date."',`asha_accompanied`='".$asha_accompanied."',`asha_reason`='".$asha_reason."',`aww_accompanied`='".$aww_accompanied."',`aww_reason`= '".$aww_reason."',`pri_accompanied`='".$pri_accompanied."',`pri_reason`='".$pri_reason."',`couple_name`='".$couple_name."',`age`='".$age."',`gender`='".$gender."',`mobile`='".$mobile."',`no_of_child`='".$no_of_child."',`yonger_child_age`='".$yonger_child_age."',`current_contraceptives`='".$current_contraceptives."',`commodities_regular_supply`='".$commodities_regular_supply."',`commodities_reason`='".$commodities_reason."',`beneficiary_couselled`='".$beneficiary_couselled."',`convinced`='".$convinced."',`contraceptives_delivery_date`='".$contraceptives_delivery_date."',`sterilisation_of_month`='".$sterilisation_of_month."',`follow_visit_date`='".$follow_visit_date."',`remarks`='".$remarks."',`updated`='".$updated."',`shg_accompanied`='".$shg_accompanied."',`shg_reason`='".$shg_reason."' WHERE id = '$id'";
	$result = mysqli_query($conn, $query);
	$last_id = $id;
	}else{


    $query = "INSERT INTO `afc_home_visits`(`district`, `block`,`panchayat`,`village`, `ward`, `visit_date`, `asha_accompanied`, `asha_reason`,`aww_accompanied`, `aww_reason`,`pri_accompanied`, `pri_reason`,`couple_name`, `age`, `gender`, `mobile`, `no_of_child`,`yonger_child_age`, `current_contraceptives`,`commodities_regular_supply`, `commodities_reason`,`beneficiary_couselled`,`convinced`, `contraceptives_delivery_date`, `sterilisation_of_month`, `follow_visit_date`, `remarks`, `updated`, `shg_accompanied`, `shg_reason`) VALUES('".$district."', '".$block."', '".$panchayat."','".$village."', '".$ward."', '".$visit_date."', '".$asha_accompanied."', '".$asha_reason."', '".$aww_accompanied."', '".$aww_reason."','".$pri_accompanied."', '".$pri_reason."', '".$couple_name."','".$age."', '".$gender."', '".$mobile."', '".$no_of_child."', '".$yonger_child_age."', '".$current_contraceptives."','".$commodities_regular_supply."', '".$commodities_reason."', '".$beneficiary_couselled."','".$convinced."', '".$contraceptives_delivery_date."', '".$sterilisation_of_month."', '".$follow_visit_date."', '".$remarks."', '".$updated."', '".$shg_accompanied."', '".$shg_reason."')";
    $result = mysqli_query($conn, $query);
    
     $last_id = mysqli_insert_id($conn);
	}
	$query = "SELECT * FROM afc_home_visits where id = '$last_id'"; 
	
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
			
		//	$query3 = "SELECT * FROM panchayats where `id` = '".$panchayat."' && `block_id` = '".$block."' && `city_id` = '".$district."' order by id desc"; 
			
			$query3 = "SELECT * FROM panchayats where `id` = '".$panchayat."' order by id desc"; 
			$result3 =$conn->query($query3);
			$row3 = $result3->fetch_assoc();
			$panch = $row3['name'];
			
			//$query4 = "SELECT * FROM villages where `id` = '".$village."' && `panchayat_id` = '".$panchayat."' && `block_id` = '".$block."' && `city_id` = '".$district."' order by id desc"; 
			
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