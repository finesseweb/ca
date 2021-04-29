<?php
$conn=mysql_connect('localhost','crmtech_crmtech','Hcodng@123');
mysql_select_db('crmtech_crmtech',$conn);
$time_offset=date_default_timezone_set ("Asia/Calcutta");
$time_a = ($time_offset * 120);
$time = date("Y-m-d H:i:s",time() + $time_a);