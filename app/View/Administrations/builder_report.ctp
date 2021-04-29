<style>
body{font-size:12px;}
.table>thead>tr>th{vertical-align:middle;}
.heading{font-size:18px; text-align:center;}
@media print {
#printingdiv{overflow:visible; font-size:8px; margin-top:50px;}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{padding:1px; text-align:center}
}
.btm_footer{background-color:#f1f1f1;}
</style>
<script type="text/javascript">
function printing()
{
var content = document.getElementById("printingdiv");
var pri = document.getElementById("ifmcontentstoprint").contentWindow;
pri.document.open();
pri.document.write(content.innerHTML);
pri.document.close();
pri.focus();
pri.print();
}
</script>
<div id="box">
<div id="printingdiv">
<div class="table-responsive"><table class="table table-bordered">
<thead>
<tr><td colspan="20"><h3 align="center">ESTIMATE / PROJECTION</h3></td></tr>
<tr><td colspan="20" class="heading">Builder Report From <?=date("d- M-y",strtotime($startdate));?> to <?=date("d- M-y",strtotime($enddate));?></td></tr>
<tr>
<th width="2%">Sl</th>
<th width="5%">D. O. Booking</th>
<th width="5%">Document Id.</th>
<th width="6%">Project</th>
<th width="9%">Appl. Name</th>
<th width="3%">Booked By</th>
<th width="7%">Source of Booking</th>
<th width="5%">Rate</th>
<th width="7%">Area</th>
<th width="5%">Bsp</th>
<th width="3%">Plc</th>
<th width="5%">CP</th>
<th width="5%">Other</th>
<th width="5%">Total Cost of Unit </th>
<th width="5%">Commission Turn Over</th>
<th width="5%">Total Commision</th>
<th width="5%">Commision coming</th>
<th width="3%">Commision Payble to Customer</th>
<th width="3%">Commision Payble to Sub Broker</th>
<th width="7%">HCO Projection</th>
</tr>
</thead>
<?
$total_commission_coming_without_rate_adjust=0;
$total_commission_coming=0;
$total_total_turn_over=0;
$total_commission_turn_over=0;
$total_hco_profit=0;
$total_commission_payble_to_customer=0;
$total_commission_payble_to_broker=0;
$i=1;
foreach ($myquery as $data){
$thevalue=0;
?>
<tr>
<td><?=$i?></td>
<td><?=date("Y-m-d",strtotime($data['bookings']['date_of_booking']))?></td>
<td>#000<?=$data['bookings']['id']?></td>
<td><? 
$project=$this->requestAction(array('controller'=>'projects','action'=>'getprojectNameOnID',$data['bookings']['project_name']));
if(!empty($project['Project']['name'])) {echo $project['Project']['name'];} else { echo "N/A";}
?></td>

<td>
<?=$data['bookings']['applicant_name1']?><br/><?=$data['bookings']['join_applicant']?></td>
<td><?=$this->requestAction(array('controller'=>'users','action'=>'getParent',$data['bookings']['booked_by']));?><? if($data['bookings']['booked_by_2']!="-1"){ echo "<br/>".$this->requestAction(array('controller'=>'users','action'=>'getParent',$data['bookings']['booked_by_2']));}?><? if($data['bookings']['booked_by_3']!="-1"){ echo "<br/>".$this->requestAction(array('controller'=>'users','action'=>'getParent',$data['bookings']['booked_by_3']));}?>
</td>
<td><?=$data['bookings']['booking_source']?></td>
<td><? if ($data['bookings']['rate']!=""){ echo $data['bookings']['rate']."/-"; }else{  if($data['bookings']['bsp']!=""){ echo $data['bookings']['bsp']."/-";}else {echo "N/A";}} ?></td>
<td><?=$data['bookings']['area']?> <?=$data['bookings']['area_type']?></td>
<td><? if ($data['bookings']['bsp']!=""){ echo $data['bookings']['bsp']."/-"; }else{ echo "N/A";} ?></td>
<td><? if ($data['bookings']['plc']!=""){ echo $data['bookings']['plc']."/-"; }else{ echo "N/A";} ?></td>
<td><? if ($data['bookings']['carparking']!=""){ echo $data['bookings']['carparking']."/-"; }else{ echo "N/A";} ?></td>
<td><? if ($data['bookings']['other_bsp']!=""){ echo $data['bookings']['other_bsp']."/-"; }else{ echo "N/A";} ?></td>
<td>
<?=$individual_total_turn_over=($data['bookings']['plc']*$data['bookings']['area'])+$data['bookings']['carparking']+$data['bookings']['bsp']+$data['bookings']['other_bsp']?></td>
<td><?
if($data['bookings']['include_plc_percentage']=="1"){
$thevalue=$data['bookings']['plc']*$data['bookings']['area'];
}
if($data['bookings']['include_carparking_percentage']=="1"){
$thevalue=$thevalue+$data['bookings']['carparking'];
}
$individual_commission_turn_over=$data['bookings']['bsp']+$thevalue; 
//echo str_replace($individual_commission_turn_over,".","");
echo round($individual_commission_turn_over,2);
?></td>

<td><?=round($individual_commission_coming_without_rate_adjust=$data['bookings']['commission_from_company']+$data['bookings']['insentive_from_comp'],2)?>			</td>
<td><?
$individual_commission_coming=$data['bookings']['commission_from_company']+$data['bookings']['insentive_from_comp']-$data['bookings']['brokerage_adjust_amount']-$data['bookings']['brokerage_adjust_amount_in_plc']-$data['bookings']['brokerage_adjust_amount_in_carparking'];
echo round($individual_commission_coming,2);
?></td>
<td><?=trim(round($individual_commission_payble_to_customer=$data['bookings']['commission_to_customer']-$data['bookings']['brokerage_adjust_amount']+$data['bookings']['customer_commission_plc_amount']+$data['bookings']['customer_commission_carparking_amount']+$data['bookings']['insentive_to_customer_amt']+$data['bookings']['insentive_to_customer_on_plc_amt']+$data['bookings']['insentive_to_customer_on_car_amt'],2));?></td>
<td><?=trim(round($individual_commission_payble_to_broker=$data['bookings']['commission_to_subbroker']+$data['bookings']['broker_commission_plc_amount']+$data['bookings']['broker_commission_carparking_amount']+$data['bookings']['insentive_to_subbroker_amt']+$data['bookings']['insentive_to_broker_on_plc_amt']+$data['bookings']['insentive_to_broker_on_car_amt'],2));?></td>

<td><?=round($individual_hco_profit=($data['bookings']['commission_from_company']+$data['bookings']['insentive_from_comp'])-((($data['bookings']['commission_to_customer']+$data['bookings']['brokerage_adjust_amount_in_plc']+$data['bookings']['brokerage_adjust_amount_in_carparking'])+($data['bookings']['customer_commission_plc_amount']+$data['bookings']['customer_commission_carparking_amount']))+($data['bookings']['commission_to_subbroker']+$data['bookings']['broker_commission_plc_amount']+$data['bookings']['broker_commission_carparking_amount']+$data['bookings']['insentive_to_subbroker_amt'])),2);?></td>
</tr>
<? 
$total_total_turn_over=$total_total_turn_over+$individual_total_turn_over."/-";
$total_commission_turn_over=$total_commission_turn_over+$individual_commission_turn_over."/-";
$total_commission_coming_without_rate_adjust=$total_commission_coming_without_rate_adjust+$individual_commission_coming_without_rate_adjust."/-";
$total_commission_coming=$total_commission_coming+$individual_commission_coming."/-";
$total_commission_payble_to_customer=$total_commission_payble_to_customer+$individual_commission_payble_to_customer."/-";
$total_commission_payble_to_broker=$total_commission_payble_to_broker+$individual_commission_payble_to_broker."/-";
$total_hco_profit=$total_hco_profit+$individual_hco_profit."/-";

?>
<? $i++; }?>

<tr class="btm_footer">
<td colspan="13">Total</td>
<td><?=trim(round($total_total_turn_over,2));?></td>
<td><?=trim(round($total_commission_turn_over,2));?></td>
<td><?=trim(round($total_commission_coming_without_rate_adjust,2));?></td>
<td><?=trim(round($total_commission_coming,2));?></td>
<td><?=trim(round($total_commission_payble_to_customer,2));?></td>
<td><?=trim(round($total_commission_payble_to_broker,2));?>	   </td>
<td><?=trim(round($total_hco_profit,2));?></td>
</tr>
</table></div>
</div>
<p> THIS REPORT IS JUST ESTIMATE & PROJECTION THE FINAL AND ACTUAL BOOKING WILL BE AS PER BILL RAISE TO CONCERN BUILDERS/COMPANIES.</p>
<?php /*?><table>
<thead>
<tr>
<td> <span><a href="javascript:printing()">Print this Page</a></span></td>
<td colspan="20" class="dvInnerHeader"><a href="Javascript:history.go(-1);">Close window</a></td>
</tr>
</thead>
</table>
<iframe id="ifmcontentstoprint" style="height: 0px; width: 0px; position: absolute"></iframe>
<?php */?></div>