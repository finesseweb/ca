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
$remarks = $js['remarks'];
//$status = $js['status'];
$awc_code = $js['awc_code'];
$aww_name = $js['aww_name'];
$anm_name = $js['anm_name'];
$asha_name = $js['asha_name'];
$pw_due_list = $js['pw_due_list'];
$child_due_list = $js['child_due_list'];
$ec_due_list = $js['ec_due_list'];
$visit_date = $js['visit_date'];
$it_availability = $js['it_availability'];
$it_reason = $js['it_reason'];
$it_footfall_number  = $js['it_footfall_number'];
$height_availability = $js['height_availability'];
$height_reason = $js['height_reason'];
$height_footfall_number = $js['height_footfall_number'];
$hb_availability = $js['hb_availability'];
$hb_reason = $js['hb_reason'];
$hb_footfall_number = $js['hb_footfall_number'];
$abdomen_availability = $js['abdomen_availability'];
$abdomen_reason = $js['abdomen_reason'];
$abdomen_footfall_number = $js['abdomen_footfall_number'];
$calcium_availability = $js['calcium_availability'];
$calcium_reason = $js['calcium_reason'];
$calcium_footfall_number = $js['calcium_footfall_number'];
$weight_availability = $js['weight_availability'];
$weight_reason = $js['weight_reason'];
$weight_footfall_number = $js['weight_footfall_number'];
$bp_availability = $js['bp_availability'];
$bp_reason = $js['bp_reason'];
$bp_footfall_number = $js['bp_footfall_number'];
$urine_availability = $js['urine_availability'];
$urine_reason = $js['urine_reason'];
$urine_footfall_number = $js['urine_footfall_number'];
$ifa_availability = $js['ifa_availability'];
$ifa_reason = $js['ifa_reason'];
$ifa_footfall_number  = $js['ifa_footfall_number'];
$immunisation_availability = $js['immunisation_availability'];
$immunisation_reason = $js['immunisation_reason'];
$immunisation_footfall_number = $js['immunisation_footfall_number'];
$growth_availability = $js['growth_availability'];
$growth_reason = $js['growth_reason'];
$growth_footfall_number = $js['growth_footfall_number'];
$condom_availability = $js['condom_availability'];
$condom_reason = $js['condom_reason'];
$condom_footfall_number = $js['condom_footfall_number'];
$mala_n_availability = $js['mala_n_availability'];
$mala_n_reason = $js['mala_n_reason'];
$mala_n_footfall_number = $js['mala_n_footfall_number'];
$chaya_availability = $js['chaya_availability'];
$chaya_reason = $js['chaya_reason'];
$chaya_footfall_number = $js['chaya_footfall_number'];
$antara_availability = $js['antara_availability'];
$antara_reason = $js['antara_reason'];
$antara_footfall_number = $js['antara_footfall_number'];
$td_availability = $js['td_availability'];
$td_reason = $js['td_reason'];
$td_footfall_number  = $js['td_footfall_number'];
$ifa_blue_availability = $js['ifa_blue_availability'];
$ifa_blue_reason = $js['ifa_blue_reason'];
$ifa_blue_footfall_number = $js['ifa_blue_footfall_number'];
$anc_counselling = $js['anc_counselling'];
$child_counselling = $js['child_counselling'];
$adolescentc_ounselling = $js['adolescentc_ounselling'];
$pnc_visit = $js['pnc_visit'];
$updated = $js['updated'];
$family_counselling = $js['family_counselling'];
$time = $js['time'];
$updated = $js['updated'];


if(!empty($district) && !empty($block) && !empty($panchayat) && !empty($village) && !empty($ward) && !empty($awc_code) && !empty($aww_name) && !empty($anm_name) && !empty($asha_name) && !empty($pw_due_list) && !empty($child_due_list) && !empty($ec_due_list)){
    
   /* $qry = "select * from description where id = '".$description_id."'";
    $result1 = mysqli_query($conn, $qry);
   // print_r($result1);
   $test = mysqli_fetch_array($result1);
 
        $desc_id = $test['id'];
        @$description = trim($test['description']);
        
  */
  
   if($id){ 
       $query = "UPDATE `vhsnds` SET `district`='".$district."',`block`='".$block."',`panchayat`='".$panchayat."',`village`='".$village."',`ward`='".$ward."',`remarks`='".$remarks."',`awc_code`='".$awc_code."',`aww_name`='".$aww_name."',`anm_name`='".$anm_name."',`asha_name`='".$asha_name."',`pw_due_list`='".$pw_due_list."',`child_due_list`='".$child_due_list."',`ec_due_list`='".$ec_due_list."',`visit_date`='".$visit_date."',`it_availability`='".$it_availability."',`it_reason`='".$it_reason."',`it_footfall_number`='".$it_footfall_number."',`height_availability`='".$height_availability."',`height_reason`='".$height_reason."',`height_footfall_number`='".$height_footfall_number."',`hb_availability`='".$hb_availability."',`hb_reason`= '".$hb_reason."',`hb_footfall_number`='".$hb_footfall_number."',`abdomen_availability`='".$abdomen_availability."',`abdomen_reason`='".$abdomen_reason."',`abdomen_footfall_number`='".$abdomen_footfall_number."',`calcium_availability`='".$calcium_availability."',`calcium_reason`='".$calcium_reason."',`calcium_footfall_number`='".$calcium_footfall_number."',`weight_availability`='".$weight_availability."',`weight_reason`='".$weight_reason."',`weight_footfall_number`='".$weight_footfall_number."',`bp_availability`='".$bp_availability."',`bp_reason`='".$bp_reason."',`bp_footfall_number`= '".$bp_footfall_number."',`urine_availability`='".$urine_availability."',`urine_reason`='".$urine_reason."',`urine_footfall_number`='".$urine_footfall_number."',`ifa_availability`='".$ifa_availability."',`ifa_reason`='".$ifa_reason."',`ifa_footfall_number`= '".$ifa_footfall_number."',`immunisation_availability`='".$immunisation_availability."',`immunisation_reason`='".$immunisation_reason."',`immunisation_footfall_number`='".$immunisation_footfall_number."',`growth_availability`='".$growth_availability."',`growth_reason`='".$growth_reason."',`growth_footfall_number`='".$growth_footfall_number."',`condom_availability`='".$condom_availability."',`condom_reason`='".$condom_reason."',`condom_footfall_number`='".$condom_footfall_number."',`mala_n_availability`='".$mala_n_availability."',`mala_n_reason`='".$mala_n_reason."',`mala_n_footfall_number`='".$mala_n_footfall_number."',`chaya_availability`='".$chaya_availability."',`chaya_reason`='".$chaya_reason."',`chaya_footfall_number`='".$chaya_footfall_number."',`antara_availability`='".$antara_availability."',`antara_reason`='".$antara_reason."',`antara_footfall_number`='".$antara_footfall_number."',`td_availability`='".$td_availability."',`td_reason`='".$td_reason."',`td_footfall_number`='".$td_footfall_number."',`ifa_blue_availability`='".$ifa_blue_availability."',`ifa_blue_reason`='".$ifa_blue_reason."',`ifa_blue_footfall_number`='".$ifa_blue_footfall_number."',`anc_counselling`='".$anc_counselling."',`child_counselling`='".$child_counselling."',`adolescentc_ounselling`='".$adolescentc_ounselling."',`pnc_visit`='".$pnc_visit."',`updated`='".$updated."',`family_counselling`='".$family_counselling."',`time`='".$time."' WHERE id='$id'";
       $result = mysqli_query($conn, $query);
	    $last_id = $id;
       
   }else{

    $query = "INSERT INTO `vhsnds`(`district`, `block`, `panchayat`, `village`, `ward`, `remarks`, `awc_code`, `aww_name`, `anm_name`, `asha_name`, `pw_due_list`, `child_due_list`, `ec_due_list`, `visit_date`, `it_availability`, `it_reason`, `it_footfall_number`, `height_availability`, `height_reason`, `height_footfall_number`, `hb_availability`, `hb_reason`, `hb_footfall_number`, `abdomen_availability`, `abdomen_reason`, `abdomen_footfall_number`, `calcium_availability`, `calcium_reason`, `calcium_footfall_number`, `weight_availability`, `weight_reason`, `weight_footfall_number`, `bp_availability`, `bp_reason`, `bp_footfall_number`, `urine_availability`, `urine_reason`, `urine_footfall_number`, `ifa_availability`, `ifa_reason`, `ifa_footfall_number`, `immunisation_availability`, `immunisation_reason`, `immunisation_footfall_number`, `growth_availability`, `growth_reason`, `growth_footfall_number`, `condom_availability`, `condom_reason`, `condom_footfall_number`, `mala_n_availability`, `mala_n_reason`, `mala_n_footfall_number`, `chaya_availability`, `chaya_reason`, `chaya_footfall_number`, `antara_availability`, `antara_reason`, `antara_footfall_number`, `td_availability`, `td_reason`, `td_footfall_number`, `ifa_blue_availability`, `ifa_blue_reason`, `ifa_blue_footfall_number`, `anc_counselling`, `child_counselling`, `adolescentc_ounselling`, `pnc_visit`, `updated`, `family_counselling`, `time`) VALUES ('".$district."', '".$block."', '".$panchayat."','".$village."', '".$ward."', '".$remarks."', '".$awc_code."', '".$aww_name."', '".$anm_name."', '".$asha_name."','".$pw_due_list."', '".$child_due_list."', '".$ec_due_list."','".$visit_date."', '".$it_availability."', '".$it_reason."', '".$it_footfall_number."', '".$height_availability."', '".$height_reason."','".$height_footfall_number."', '".$hb_availability."', '".$hb_reason."','".$hb_footfall_number."', '".$abdomen_availability."', '".$abdomen_reason."', '".$abdomen_footfall_number."', '".$calcium_availability."', '".$calcium_reason."', '".$calcium_footfall_number."', '".$weight_availability."', '".$weight_reason."', '".$weight_footfall_number."', '".$bp_availability."', '".$bp_reason."', '".$bp_footfall_number."', '".$urine_availability."', '".$urine_reason."', '".$urine_footfall_number."', '".$ifa_availability."', '".$ifa_reason."', '".$ifa_footfall_number."', '".$immunisation_availability."', '".$immunisation_reason."', '".$immunisation_footfall_number."', '".$growth_availability."', '".$growth_reason."', '".$growth_footfall_number."', '".$condom_availability."', '".$condom_reason."', '".$condom_footfall_number."', '".$mala_n_availability."', '".$mala_n_reason."', '".$mala_n_footfall_number."', '".$chaya_availability."', '".$chaya_reason."','".$chaya_footfall_number."', '".$antara_availability."', '".$antara_reason."', '".$antara_footfall_number."', '".$td_availability."', '".$td_reason."', '".$td_footfall_number."', '".$ifa_blue_availability."', '".$ifa_blue_reason."', '".$ifa_blue_footfall_number."', '".$anc_counselling."', '".$child_counselling."', '".$adolescentc_ounselling."', '".$pnc_visit."', '".$updated."', '".$family_counselling."', '".$time."')";
    $result = mysqli_query($conn, $query);
    $last_id = mysqli_insert_id($conn);
    
   }
   
    if($result){
    
    
    $json = array("error" => "false", "message" => "Successfully save.");
    
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
        
   
