<?php
         $dbhost = 'localhost:3306';
         $dbuser = 'usr-dbpfi';
         $dbpass = 'it4@gI-[afjJ';
         $dbname = 'dbpfi';
        //  $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
         
        //   $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);


$conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname);
   
         if(! $conn ) {
            die('Could not connect: ' . mysqli_error());
         }else{
           
     //echo "connected";
     date_default_timezone_set("Asia/Kolkata");


         }
        
?>

