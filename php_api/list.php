<?php
error_reporting(E_ALL ^ E_WARNING);
require_once("connect.php");

// read JSon input
$jsondata=file_get_contents('php://input');
$js = json_decode($jsondata, true);

       
         $query = "SELECT * FROM cities order by id desc"; 
      $result = mysqli_query($conn, $query);
         if(mysqli_num_rows($result)>0){
      while($row=mysqli_fetch_assoc($result)) {
   $resultset[] = $row;
     }
         }else{
             $resultset= array();
         }
       
         $query2 = "SELECT * FROM blocks order by id desc"; 
      $result2 = mysqli_query($conn, $query2);
        if(mysqli_num_rows($result2)>0){
      while($row2=mysqli_fetch_assoc($result2)) {
   $resultset2[] = $row2;
     }
      }else{
             $resultset2= array();
         }  
         
          $query21 = "SELECT * FROM panchayats order by id desc"; 
      $result21 = mysqli_query($conn, $query21);
        if(mysqli_num_rows($result21)>0){
      while($row21=mysqli_fetch_assoc($result21)) {
   $resultset21[] = $row21;
     }
      }else{
             $resultset21= array();
         }  
         
             $query3 = "SELECT * FROM villages order by id desc"; 
      $result3 = mysqli_query($conn, $query3);
        if(mysqli_num_rows($result3)>0){
      while($row3=mysqli_fetch_assoc($result3)) {
   $resultset3[] = $row3;
     }
      }else{
             $resultset3= array();
         }
         
         
             $query4 = "SELECT * FROM wards order by id desc"; 
      $result4 = mysqli_query($conn, $query4);
        if(mysqli_num_rows($result4)>0){
      while($row4=mysqli_fetch_assoc($result4)) {
   $resultset4[] = $row4;
     }
      }else{
             $resultset4= array();
         }
         
          $query5 = "SELECT * FROM register_members order by id desc"; 
      $result5 = mysqli_query($conn, $query5);
         if(mysqli_num_rows($result5)>0){
      while($row5=mysqli_fetch_assoc($result5)) {
   $resultset5[] = $row5;
     }
         }else{
             $resultset5= array();
         }
         
          $query6 = "SELECT * FROM meeting_facilitateds order by id desc"; 
      $result6 = mysqli_query($conn, $query6);
         if(mysqli_num_rows($result6)>0){
      while($row6=mysqli_fetch_assoc($result6)) {
   $resultset6[] = $row6;
     }
         }else{
             $resultset6= array();
         }
         
          $query7 = "SELECT * FROM issue_category order by id desc"; 
      $result7 = mysqli_query($conn, $query7);
         if(mysqli_num_rows($result7)>0){
      while($row7=mysqli_fetch_assoc($result7)) {
   $resultset7[] = $row7;
     }
         }else{
             $resultset7= array();
         }
         
          $query8 = "SELECT * FROM issue_subcategory order by id desc"; 
      $result8 = mysqli_query($conn, $query8);
         if(mysqli_num_rows($result8)>0){
      while($row8=mysqli_fetch_assoc($result8)) {
   $resultset8[] = $row8;
     }
         }else{
             $resultset8= array();
         }
         
         $query9 = "SELECT * FROM contraceptives order by id desc"; 
      $result9 = mysqli_query($conn, $query9);
         if(mysqli_num_rows($result8)>0){
      while($row9=mysqli_fetch_assoc($result9)) {
   $resultset9[] = $row9;
     }
         }else{
             $resultset9= array();
         }
         
         $query11 = "SELECT * FROM reasons order by id desc"; 
      $result11 = mysqli_query($conn, $query11);
         if(mysqli_num_rows($result11)>0){
      while($row11=mysqli_fetch_assoc($result11)) {
   $resultset11[] = $row11;
     }
         }else{
             $resultset11= array();
         }
         
          $query12 = "SELECT id,ward,village,awc_code,aww_name,asha_name FROM geographicals order by id asc"; 
      $result12 = mysqli_query($conn, $query12);
         if(mysqli_num_rows($result12)>0){
      while($row12=mysqli_fetch_assoc($result12)) {
   $resultset12[] = $row12;
     }
         }else{
             $resultset12= array();
         }
         

$msg = array("district" => $resultset, "blocks" => $resultset2, "panchayats" => $resultset21, "villages" => $resultset3, "wards" => $resultset4, "register_members" => $resultset5, "meeting_facilitateds" => $resultset6, "issue_category" => $resultset7, "issue_subcategory" => $resultset8, "convinced_to_opt" => $resultset9, "reasons" => $resultset11, "awc_code" => $resultset12);

     $json = array("error" => "false", "message" =>$msg );
     



@mysqli_close($conn);
 
/* Output header */
 
 header('Content-type: application/json, charset=UTF-8');
 echo json_encode($json);

?>