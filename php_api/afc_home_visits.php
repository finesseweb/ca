<?php
error_reporting(E_ALL ^ E_WARNING);
require_once("connect.php");

// read JSon input
$jsondata=file_get_contents('php://input');
$js = json_decode($jsondata, true);


$couple_name = $js['name'];
$age = $js['age'];
$month = $js['month'];
$mobile = $js['mobile'];
$from_date = $js['from_date'];
$to_date = $js['to_date'];
$block = $js['block'];
$panchayat = $js['panchayat'];
$village = $js['village'];


if(!empty($couple_name) && !empty($block) && !empty($panchayat) && !empty($village) && !empty($age) && !empty($mobile) && !empty($from_date) && !empty($to_date) && !empty($month)){
 // All Fields
$query = "SELECT * FROM afc_home_visits where `couple_name` = '".$couple_name."' && `block` = '".$block."' && `panchayat` = '".$panchayat."' && `village` = '".$village."' && `age` = '".$age."' && `mobile` = '".$mobile."' && `visit_date` = '".$from_date."' || `visit_date` = '".$to_date."' && `month` = '".$month."' order by id desc"; 
 
 }else{
 if(!empty($couple_name) && empty($block) && empty($panchayat) && empty($village) && empty($age) && empty($mobile) && empty($from_date) && empty($to_date) && empty($month)){
 // only name
$query = "SELECT * FROM afc_home_visits where `couple_name` LIKE '%$couple_name%' order by id desc"; 
 
 }else{
 if(empty($couple_name) && !empty($block) && empty($panchayat) && empty($village) && empty($age) && empty($mobile) && empty($from_date) && empty($to_date) && empty($month)){
 // only block
$query = "SELECT * FROM afc_home_visits where `block` = '".$block."' order by id desc"; 
 
 }else{
 if(empty($couple_name) && empty($block) && !empty($panchayat) && empty($village) && empty($age) && empty($mobile) && empty($from_date) && empty($to_date) && empty($month)){
 // only panchayat
$query = "SELECT * FROM afc_home_visits where `panchayat` = '".$panchayat."' order by id desc"; 
 
 }else{
 if(empty($couple_name) && empty($block) && empty($panchayat) && !empty($village) && empty($age) && empty($mobile) && empty($from_date) && empty($to_date) && empty($month)){
 // only village
$query = "SELECT * FROM afc_home_visits where `village` = '".$village."' order by id desc"; 
 
 }else{
 if(empty($couple_name) && empty($block) && empty($panchayat) && empty($village) && !empty($age) && empty($mobile) && empty($from_date) && empty($to_date) && empty($month)){
 // only age
 $query = "SELECT * FROM afc_home_visits where `age` = '".$age."' order by id desc"; 
 
 }else{
 if(empty($couple_name) && empty($block) && empty($panchayat) && empty($village) && empty($age) && !empty($mobile) && empty($from_date) && empty($to_date) && empty($month)){
 // only mobile
$query = "SELECT * FROM afc_home_visits where `mobile` = '".$mobile."' order by id desc"; 
 
 }else{
 if(empty($couple_name) && empty($block) && empty($panchayat) && empty($village) && empty($age) && empty($mobile) && !empty($from_date) && empty($to_date) && empty($month)){
 // only from date
$query = "SELECT * FROM afc_home_visits where `visit_date` = '".$from_date."' order by id desc"; 
 
 }else{
 if(empty($couple_name) && empty($block) && empty($panchayat) && empty($village) && empty($age) && empty($mobile) && empty($from_date) && !empty($to_date) && empty($month)){
 // only to date
$query = "SELECT * FROM afc_home_visits where `visit_date` = '".$to_date."' order by id desc"; 
 
 }else{
 if(empty($couple_name) && empty($block) && empty($panchayat) && empty($village) && empty($age) && empty($mobile) && empty($from_date) && empty($to_date) && !empty($month)){
 // only month
$query = "SELECT * FROM afc_home_visits where `month` = '".$month."' order by id desc"; 
 
 }else{
 if(!empty($couple_name) && !empty($block) && empty($panchayat) && empty($village) && empty($age) && empty($mobile) && empty($from_date) && empty($to_date) && empty($month)){
 // name & block
$query = "SELECT * FROM afc_home_visits where `couple_name` = '".$couple_name."' && `block` = '".$block."' order by id desc"; 
 
 }else{
 if(!empty($couple_name) && empty($block) && !empty($panchayat) && empty($village) && empty($age) && empty($mobile) && empty($from_date) && empty($to_date) && empty($month)){
 // name & panchayat
$query = "SELECT * FROM afc_home_visits where `couple_name` = '".$couple_name."' && `panchayat` = '".$panchayat."' order by id desc"; 
 
 }else{
 if(!empty($couple_name) && empty($block) && empty($panchayat) && !empty($village) && empty($age) && empty($mobile) && empty($from_date) && empty($to_date) && empty($month)){
 // name & village
 $query = "SELECT * FROM afc_home_visits where `couple_name` = '".$couple_name."' && `village` = '".$village."' order by id desc"; 
 
 }else{
 if(!empty($couple_name) && empty($block) && empty($panchayat) && empty($village) && !empty($age) && empty($mobile) && empty($from_date) && empty($to_date) && empty($month)){
 // name & age
 $query = "SELECT * FROM afc_home_visits where `couple_name` = '".$couple_name."' && `age` = '".$age."' order by id desc"; 

 }else{
 if(!empty($couple_name) && empty($block) && empty($panchayat) && empty($village) && empty($age) && !empty($mobile) && empty($from_date) && empty($to_date) && empty($month)){
 // name & mobile
 $query = "SELECT * FROM afc_home_visits where `couple_name` = '".$couple_name."' && `mobile` = '".$mobile."' order by id desc"; 

 }else{
 if(!empty($couple_name) && empty($block) && empty($panchayat) && empty($village) && empty($age) && empty($mobile) && !empty($from_date) && empty($to_date) && empty($month)){
// name & from_date
 $query = "SELECT * FROM afc_home_visits where `couple_name` = '".$couple_name."' && `visit_date` = '".$from_date."' order by id desc"; 

 }else{
 if(!empty($couple_name) && empty($block) && empty($panchayat) && empty($village) && empty($age) && empty($mobile) && empty($from_date) && !empty($to_date) && empty($month)){
 // name & to_date
 $query = "SELECT * FROM afc_home_visits where `couple_name` = '".$couple_name."' && `visit_date` = '".$to_date."' order by id desc"; 

 }else{
 if(!empty($couple_name) && empty($block) && empty($panchayat) && empty($village) && empty($age) && empty($mobile) && empty($from_date) && empty($to_date) && !empty($month)){
 // name & month
 $query = "SELECT * FROM afc_home_visits where `couple_name` = '".$couple_name."' && `month` = '".$month."' order by id desc"; 

 }else{
 if(!empty($couple_name) && !empty($block) && empty($panchayat) && empty($village) && empty($age) && empty($mobile) && empty($from_date) && empty($to_date) && empty($month)){
 // block & couple_name
 $query = "SELECT * FROM afc_home_visits where `block` = '".$block."' && `couple_name` = '".$couple_name."' order by id desc"; 

 }else{
 if(empty($couple_name) && !empty($block) && !empty($panchayat) && empty($village) && empty($age) && empty($mobile) && empty($from_date) && empty($to_date) && empty($month)){
 // block & panchayat
 $query = "SELECT * FROM afc_home_visits where `block` = '".$block."' && `panchayat` = '".$panchayat."' order by id desc"; 

 }else{
 if(empty($couple_name) && !empty($block) && empty($panchayat) && !empty($village) && empty($age) && empty($mobile) && empty($from_date) && empty($to_date) && empty($month)){
 // block & village
 $query = "SELECT * FROM afc_home_visits where `block` = '".$block."' && `village` = '".$village."' order by id desc"; 

 }else{
 if(empty($couple_name) && !empty($block) && empty($panchayat) && empty($village) && !empty($age) && empty($mobile) && empty($from_date) && empty($to_date) && empty($month)){
 // block & age
 $query = "SELECT * FROM afc_home_visits where `block` = '".$block."' && `age` = '".$age."' order by id desc"; 

 }else{
 if(empty($couple_name) && !empty($block) && empty($panchayat) && empty($village) && empty($age) && !empty($mobile) && empty($from_date) && empty($to_date) && empty($month)){
 // block & mobile
 $query = "SELECT * FROM afc_home_visits where `block` = '".$block."' && `mobile` = '".$mobile."' order by id desc"; 

 }else{
 if(empty($couple_name) && !empty($block) && empty($panchayat) && empty($village) && empty($age) && empty($mobile) && !empty($from_date) && empty($to_date) && empty($month)){
 // block & from_date
 $query = "SELECT * FROM afc_home_visits where `block` = '".$block."' && `visit_date` = '".$from_date."' order by id desc"; 

 }else{
 if(empty($couple_name) && !empty($block) && empty($panchayat) && empty($village) && empty($age) && empty($mobile) && empty($from_date) && !empty($to_date) && empty($month)){
 // block & to_date
 $query = "SELECT * FROM afc_home_visits where `block` = '".$block."' && `visit_date` = '".$to_date."' order by id desc"; 

 }else{
 if(empty($couple_name) && !empty($block) && empty($panchayat) && empty($village) && empty($age) && empty($mobile) && empty($from_date) && empty($to_date) && !empty($month)){
 // block & month
 $query = "SELECT * FROM afc_home_visits where `block` = '".$block."' && `month` = '".$month."' order by id desc"; 

 }else{
 if(!empty($couple_name) && empty($block) && !empty($panchayat) && empty($village) && empty($age) && empty($mobile) && empty($from_date) && empty($to_date) && empty($month)){
 // panchayat & couple_name
 $query = "SELECT * FROM afc_home_visits where `panchayat` = '".$panchayat."' && `couple_name` = '".$couple_name."' order by id desc"; 

 }else{
 if(empty($couple_name) && !empty($block) && !empty($panchayat) && empty($village) && empty($age) && empty($mobile) && empty($from_date) && empty($to_date) && empty($month)){
 // panchayat & block
 $query = "SELECT * FROM afc_home_visits where `panchayat` = '".$panchayat."' && `block` = '".$block."' order by id desc"; 

 }else{
 if(empty($couple_name) && empty($block) && !empty($panchayat) && !empty($village) && empty($age) && empty($mobile) && empty($from_date) && empty($to_date) && empty($month)){
 // panchayat & village
 $query = "SELECT * FROM afc_home_visits where `panchayat` = '".$panchayat."' && `village` = '".$village."' order by id desc"; 

 }else{
 if(empty($couple_name) && empty($block) && !empty($panchayat) && empty($village) && !empty($age) && empty($mobile) && empty($from_date) && empty($to_date) && empty($month)){
 // panchayat & age
 $query = "SELECT * FROM afc_home_visits where `panchayat` = '".$panchayat."' && `age` = '".$age."' order by id desc"; 

 }else{
 if(empty($couple_name) && empty($block) && !empty($panchayat) && empty($village) && empty($age) && !empty($mobile) && empty($from_date) && empty($to_date) && empty($month)){
 // panchayat & mobile
 $query = "SELECT * FROM afc_home_visits where `panchayat` = '".$panchayat."' && `mobile` = '".$mobile."' order by id desc"; 

 }else{
 if(empty($couple_name) && empty($block) && !empty($panchayat) && empty($village) && empty($age) && empty($mobile) && !empty($from_date) && empty($to_date) && empty($month)){
 // panchayat & from_date
 $query = "SELECT * FROM afc_home_visits where `panchayat` = '".$panchayat."' && `visit_date` = '".$from_date."' order by id desc"; 

 }else{
 if(empty($couple_name) && empty($block) && !empty($panchayat) && empty($village) && empty($age) && empty($mobile) && empty($from_date) && !empty($to_date) && empty($month)){
 // panchayat & to_date
 $query = "SELECT * FROM afc_home_visits where `panchayat` = '".$panchayat."' && `visit_date` = '".$to_date."' order by id desc"; 

 }else{
 if(empty($couple_name) && empty($block) && !empty($panchayat) && empty($village) && empty($age) && empty($mobile) && empty($from_date) && empty($to_date) && !empty($month)){
 // panchayat & month
 $query = "SELECT * FROM afc_home_visits where `panchayat` = '".$panchayat."' && `month` = '".$month."' order by id desc"; 

 }else{
 if(!empty($couple_name) && empty($block) && empty($panchayat) && !empty($village) && empty($age) && empty($mobile) && empty($from_date) && empty($to_date) && empty($month)){
 // village & couple_name
 $query = "SELECT * FROM afc_home_visits where `village` = '".$village."' && `couple_name` = '".$couple_name."' order by id desc"; 

 }else{
 if(empty($couple_name) && !empty($block) && empty($panchayat) && !empty($village) && empty($age) && empty($mobile) && empty($from_date) && empty($to_date) && empty($month)){
 // village & block
 $query = "SELECT * FROM afc_home_visits where `village` = '".$village."' && `block` = '".$block."' order by id desc"; 

 }else{
 if(empty($couple_name) && empty($block) && !empty($panchayat) && !empty($village) && empty($age) && empty($mobile) && empty($from_date) && empty($to_date) && empty($month)){
 // village & panchayat
 $query = "SELECT * FROM afc_home_visits where `village` = '".$village."' && `panchayat` = '".$panchayat."' order by id desc"; 

 }else{
 if(empty($couple_name) && empty($block) && empty($panchayat) && !empty($village) && !empty($age) && empty($mobile) && empty($from_date) && empty($to_date) && empty($month)){
 // village & age
 $query = "SELECT * FROM afc_home_visits where `village` = '".$village."' && `age` = '".$age."' order by id desc"; 

 }else{
 if(empty($couple_name) && empty($block) && empty($panchayat) && !empty($village) && empty($age) && !empty($mobile) && empty($from_date) && empty($to_date) && empty($month)){
 // village & mobile
 $query = "SELECT * FROM afc_home_visits where `village` = '".$village."' && `mobile` = '".$mobile."' order by id desc"; 

 }else{
 if(empty($couple_name) && empty($block) && empty($panchayat) && !empty($village) && empty($age) && empty($mobile) && !empty($from_date) && empty($to_date) && empty($month)){
 // village & from_date
 $query = "SELECT * FROM afc_home_visits where `village` = '".$village."' && `visit_date` = '".$from_date."' order by id desc"; 

 }else{
 if(empty($couple_name) && empty($block) && empty($panchayat) && !empty($village) && empty($age) && empty($mobile) && empty($from_date) && !empty($to_date) && empty($month)){
 // village & to_date
 $query = "SELECT * FROM afc_home_visits where `village` = '".$village."' && `visit_date` = '".$to_date."' order by id desc"; 

 }else{
 if(empty($couple_name) && empty($block) && empty($panchayat) && !empty($village) && empty($age) && empty($mobile) && empty($from_date) && empty($to_date) && !empty($month)){
 // village & month
 $query = "SELECT * FROM afc_home_visits where `village` = '".$village."' && `month` = '".$month."' order by id desc"; 

 }else{
 
 /////////************************///////////////////*******************//////////////////
 
 
 if(empty($couple_name) && empty($block) && empty($panchayat) && empty($village) && empty($age) && empty($mobile) && empty($from_date) && !empty($to_date) && !empty($month)){
 // from_date & to_date
 $query = "SELECT * FROM afc_home_visits where `visit_date` BETWEEN '".$from_date."' && '".$to_date."' order by id desc"; 

 }else{
 if(empty($couple_name) && !empty($block) && !empty($panchayat) && !empty($village) && empty($age) && empty($mobile) && empty($from_date) && empty($to_date) && empty($month)){
 // village & block
 $query = "SELECT * FROM afc_home_visits where `panchayat` = '".$panchayat."' && `village` = '".$village."' && `block` = '".$block."' order by id desc"; 

 }
 
 
   else{ 
   $query = "SELECT * FROM afc_home_visits order by id desc"; 
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
   
   

 //   $query = "SELECT * FROM afc_home_visits order by id desc"; 
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
			$convinced = $result2['convinced'];
			$beneficiary_couselled = $result2['beneficiary_couselled'];
			
			$exarrs = explode(",",$beneficiary_couselled);
			$counts = count($exarrs);
                      $cat_name_arrays = "";
                      for($is=0; $is<$counts; $is++ ){
                         if(!empty($exarrs[$is])){
                             $cates= $exarrs[$is];
                            
                             
                             
            $query91 = "SELECT * FROM contraceptives where `id` = '".$cates."' order by id desc"; 
            $result91 = mysqli_query($conn, $query91);
            $row91 = $result91->fetch_assoc();
			$convinced1 = $row91['name'];
			$cat_name1 = $convinced1.",";  
                         $cat_name_arrays = $cat_name_arrays.$cat_name1;
                           //print_r($cat_name_arrays);
                             
                         }
                     }
    
				//	$convinced1 = $row91['name'];"<br>";
			
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
			
			$query9 = "SELECT * FROM contraceptives where `id` = '".$convinced."' order by id desc"; 
            $result9 = mysqli_query($conn, $query9);
            $row9 = $result9->fetch_assoc();
			$convinced = $row9['name'];
			
			
			
			$resultset[$i]['ward_name']= $wards;
			$resultset[$i]['district_name']= $disc;
			$resultset[$i]['block_name']= $blocks;
			$resultset[$i]['panchayat_name']= $panch;
			$resultset[$i]['village_name']= $villages;
			$resultset[$i]['ward_name']= $wards;
			$resultset[$i]['vhsnc_name']= $v_name;
			$resultset[$i]['convinced_name']= $convinced;
			$resultset[$i]['beneficiary_couselled_name']= $cat_name_arrays;
			
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