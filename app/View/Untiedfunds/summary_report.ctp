
<style>
body{font-size:12px;}
@media print {
#printingdiv{overflow:visible; font-size:8px; margin-top:50px;}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{padding:1px;}
}
</style>
<script type="text/javascript">
function printing()
{
var content = document.getElementById("home");
var pri = document.getElementById("ifmcontentstoprint").contentWindow;
pri.document.open();
pri.document.write(content.innerHTML);
pri.document.close();
pri.focus();
pri.print();
}
</script>	
<div id="printingdiv">
<div class="table-responsive"><table id="home" class="table table-bordered">
<thead>
<tr>
<td colspan="4" class="heading">Summary Report From <?=date("d-m-y",strtotime($startdate));?> to <?=date("d-m-y",strtotime($enddate));?></td>
</tr>

<tr>
<th>Booking Done By</th>
<th>Company Name</th>
<th>Location </th>
<!--<th>Booking Not Done </th>-->
</tr>
</thead>
<tr>
<td>
<table>
<? $bookinfuser=$this->requestAction(array('controller'=>'bookings','action'=>'totalUserbook'));
  //echo $bookinfuser[0]['users']['name'];
  foreach($bookinfuser as $totexe){ ?>
  
<tr><td><? echo $totexe['users']['name']; ?>   <? echo $totexe['users']['last_name']; ?>
</td><td>
<?php

/*if(!empty($executivenames)) {
foreach($executivenames as $exe){*/

if($totexe['users']['id']!="-1"){



$totalnum1=$this->requestAction(array('controller'=>'bookings','action'=>'totalnum1',$totexe['users']['id'],$startdate,$enddate));
/*$totalnum1=mysql_num_rows(mysql_query("select crm_id from crmdetails where booked_by='".$exe['bookings']['user']."'  and booked_by_2='-1' and date_of_booking between '".$startdate."' and '".$enddate."'"));*/

$totalnum2=$this->requestAction(array('controller'=>'bookings','action'=>'totalnum2',$totexe['users']['id'],$startdate,$enddate));

/*$totalnum2=mysql_num_rows(mysql_query("select crm_id from crmdetails where ((booked_by='".$exe['bookings']['user']."' and booked_by_2!='-1') or (booked_by!='-1' and booked_by_2='".$exe['bookings']['user']."')) and date_of_booking between '".$startdate."' and '".$enddate."'"));*/

?>

<?=$totalnum1=$totalnum1+($totalnum2/2)?> 

<? }//}}?></td></tr>
<?  }
?>
</table></td>
<td><table>
<?php

$executivenam=$this->requestAction(array('controller'=>'bookings','action'=>'executivenam'));

$i='';
/*$executivenam=mysql_query("select distinct bulider_name from crmdetails where date_of_booking between '".$startdate."' and '".$enddate."' order by bulider_name asc");	*/

foreach($executivenam as $exet){


/*$tp=mysql_num_rows(mysql_query("select crm_id from crmdetails where bulider_name='".$exet['bulider_name']."' and date_of_booking between '".$startdate."' and '".$enddate."'"));*/

?>
<tr>
<td><? //$builder=$this->requestAction(array('controller'=>'builders','action'=>'getBuilder',$exet['bookings']['bulider_name'])); 
echo $exet['build']['name'];?>
</td>
<td><? 
$tp=$this->requestAction(array('controller'=>'bookings','action'=>'tp',$exet['build']['id'],$startdate,$enddate));
echo $tp;

?></td>
</tr>
<? $i++; }?>
</table></td>
<td><table>
<? 
$executivenamm=$this->requestAction(array('controller'=>'bookings','action'=>'executivenamm',$startdate,$enddate));

/*$executivenamm=mysql_query("select distinct project_location from crmdetails where status='active' and date_of_booking between '".$startdate."' and '".$enddate."'");*/
foreach($executivenamm as $exett){



/*$tpp=mysql_num_rows(mysql_query("select crm_id from crmdetails where status='active' and project_location='".$exett['bookings']['project_location']."' and date_of_booking between '".$startdate."' and '".$enddate."'"));*/
?>
<tr>
<td><?
//$locations=$this->requestAction(array('controller'=>'locations','action'=>'getLocationNameOnID',$exett['bookings']['project_location']));
if(!empty($exett['loc']['name'])) { echo ucfirst($exett['loc']['name']);}
?></td>
<td><?
$tpp=$this->requestAction(array('controller'=>'bookings','action'=>'tpp',$exett['loc']['id'],$startdate,$enddate));
echo $tpp;

?></td>
</tr>
<? }?>
</table></td>
<!--<td style="vertical-align:top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<?	
$allexename=$this->requestAction(array('controller'=>'bookings','action'=>'allexename'));
$pqr='';
$tabp='';
$countexecutive='';
/*$allexename=mysql_query("select * from hco_users where group_id!='4' and group_id!='14' and group_id!='6' and booking_not_done='Y' and username!=''  and status='active'  order by priority,first_name asc");*/

foreach($allexename as $allthenames){
//while ($allthenames=mysql_fetch_array($allexename))


$abc=$this->requestAction(array('controller'=>'bookings','action'=>'abc',$startdate,$enddate));

/*$abc=mysql_query("(select distinct booked_by as user from crmdetails where status='active' and crmdetails.date_of_booking between '".$startdate."' and '".$enddate."') union (select distinct booked_by_2 as user from crmdetails where crmdetails.date_of_booking between '".$startdate."' and '".$enddate."')order by user");*/
foreach($abc as $all){

$pqr.=$all[0]['user']."#";

}
$tabp=explode("#",$pqr);


if(!in_array($allthenames['users']['id'],$tabp))
{    ?>
<?php /*?><tr>
<td><?=$this->requestAction(array('controller'=>'users','action'=>'getParent',$allthenames['users']['id']));?></td>
</tr><?php */?>
<?  $countexecutive+=count($allthenames['users']['id']);?>
<?	}}?>
</table></td>-->
</tr>
<tr>
<th>
<table><tr>
<?
$countno_exe=$this->requestAction(array('controller'=>'bookings','action'=>'countno_exe',$startdate,$enddate));
/*$countno_exe=mysql_num_rows(mysql_query("(select distinct booked_by as user from crmdetails where crmdetails.date_of_booking between '".$startdate."' and '".$enddate."' and booked_by!='-1') union (select distinct booked_by_2 as user from crmdetails where crmdetails.date_of_booking between '".$startdate."' and '".$enddate."' and booked_by_2!='-1')"));*/	?>

<td>Total No of Executive :- <?=$this->requestAction(array('controller'=>'enquiries','action'=>'totalUser'))?></td>
<td>
<?=$this->requestAction(array('controller'=>'bookings','action'=>'executivenames',$startdate,$enddate));?></td>
</tr></table>



</th>
<th><table>
<tr>
<? $countbuilder=$this->requestAction(array('controller'=>'bookings','action'=>'countbuilder',$startdate,$enddate));

$countbuilderactive=$this->requestAction(array('controller'=>'bookings','action'=>'countbuilderactive'));
/*$countbuilder=mysql_num_rows(mysql_query("select distinct bulider_name from crmdetails where status='active' and date_of_booking between '".$startdate."' and '".$enddate."'"));*/

?>


<td>Total Company  :- <?=$countbuilderactive;?>/<?=$countbuilder;?></td>
<td><?=$this->requestAction(array('controller'=>'bookings','action'=>'executivenamesss',$startdate,$enddate));/*$executivenamesss=mysql_num_rows(mysql_query("select project_name from crmdetails where status='active' and date_of_booking between '".$startdate."' and '".$enddate."'"))*/?></td>
</tr></table></th>
<th><table>
<tr>
<?php
$countloc=$this->requestAction(array('controller'=>'bookings','action'=>'countloc',$startdate,$enddate));
/*$countloc=mysql_num_rows(mysql_query("select distinct project_location from crmdetails where status='active' and date_of_booking between '".$startdate."' and '".$enddate."'"));*/
?>
<td>Total Location :- <?=$countloc;?></td>
<td><?=$this->requestAction(array('controller'=>'bookings','action'=>'executivenamesss',$startdate,$enddate));?></td>
</tr></table></th>
<!--<th><table>
<tr>
<td>Total  :-	<?=$count_not_done_by=$countexecutive;?></td>
<td>&nbsp;</td>
</tr></table></th>-->
</tr>
<tr>
<th colspan="4">Total - 
<?=$this->requestAction(array('controller'=>'bookings','action'=>'executivenamesss',$startdate,$enddate));?> </th>
</tr>
</table></div>
</div>

<?php /*?><iframe id="ifmcontentstoprint" style="height: 0px; width: 0px; position: absolute"></iframe>	
<div align="left" class="txt-11brn"><a href="#" onClick="javascript: printing()">Print this Page</a></div>		
<div align="center" class="txt-11brn"><a href="Javascript:history.go(-1);">Close window</a></div>
<?php */?>