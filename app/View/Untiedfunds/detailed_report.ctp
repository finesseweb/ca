<style>
body{font-size:12px;}
.table>thead>tr>th{vertical-align:middle;}
.heading{font-size:18px; text-align:center;}
@media print {
#printingdiv{overflow:visible; font-size:8px; margin-top:50px;}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{padding:1px; text-align:center}
.text-nowrap{white-space:nowrap !important;}
}
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
<div class="table-responsive"><table class="table table-bordered table-responsive">
<thead>
<tr><td colspan="20"><h3 align="center">ESTIMATE / PROJECTION</h3></td></tr>
<tr>
<td colspan="20" class="heading">Detailed Report From <?=date("d- M-y",strtotime($startdate));?> to <?=date("d- M-y",strtotime($enddate));?></td>
</tr>

<tr>
<th>SL</th>
<th>Doc. Id.</th>
<th>Project</th>
<th>Date of Booking</th>
<th >Applicant</th>
<th>Unit No.</th>
<th >Rate</th>
<th >Area</th>
<th >Commission Coming From</th>
<th>Commission Receivables</th>
<th >Incentive Receivables</th>
<th >Commision Payable to Customer</th>
<th >Commision Payable to Sub Broker</th>
<th >Booking Done By</th>
<th>Ch No./Date</th>
<th >Credit note given/PDC</th>
<th >Cheque clearing Status</th>
<th>Source of booking </th>
<th>Booking Status</th>
<th>Customer Profile Given</th>
</tr>
</thead>
<?
$i=1;
foreach ($myquery as $data){ ?>
<tr>
<td><?=$i?></td>
<td>#000<?=$data['bookings']['id']?></td>
<td class="text-nowrap" style="width:8%">
<? 
$project=$this->requestAction(array('controller'=>'projects','action'=>'getprojectNameOnID',$data['bookings']['project_name']));
echo $project['Project']['name'];
?>
<td class="text-nowrap" style="width:6%"><?=date("d-M-y",strtotime($data['bookings']['date_of_booking']));?></td>
<td>
<?=$data['bookings']['applicant_name1']?><br/><?=$data['bookings']['join_applicant']?></td>
<td><?=$data['bookings']['unit_no']?></td>
<td class="text-nowrap" style="width:4%">
<? if ($data['bookings']['rate']!=""){ echo $data['bookings']['rate']; }else{ echo $data['bookings']['bsp'];} ?>/-</td>
<td class="text-nowrap" style="width:4%"><?=$data['bookings']['area']?> <?=$data['bookings']['area_type']?></td>
<td><? if($data['bookings']['commission_from_type']=='company'){?>

<? $builder=$this->requestAction(array('controller'=>'builders','action'=>'getBuilder',$data['bookings']['bulider_name'])); 
echo $builder['Builder']['name']?>


<? } else{?>
<?php /*?><?=broker_company_name($data['bookings']['broker_company_id'])?><?php */?>
<? }?></td>
<td>
<? if($data['bookings']['commission_percentage']!="0"){echo $data['bookings']['commission_percentage']?>%<? }elseif($data['bookings']['commission_from_company']!=""){echo $data['bookings']['commission_from_company'];}else{ echo "N/A";}?></td>
<td><? if($data['bookings']['insentive_percentage']!="0"){ echo $data['bookings']['insentive_percentage']?>% 
<? }elseif($data['bookings']['insentive_from_comp']!=""){ echo $data['bookings']['insentive_from_comp'];}else{ echo "N/A";}?></td>

<td><? if($data['bookings']['customer_commission_percent']!="Percentage"){ echo $data['bookings']['customer_commission_percent']?>% 
<? }else{ $cusper= $data['bookings']['commission_to_customer']+$data['bookings']['brokerage_adjust_amount_in_plc']+$data['bookings']['brokerage_adjust_amount_in_carparking'];

$perlen = strlen($cusper);
if($perlen>3){ echo $cusper; ?>
<?
} else { echo $cusper; ?> %  <? }} ?>	
			  </td>

<td><? if($data['bookings']['broker_commission_percentage']!="Percentage"){ echo $data['bookings']['broker_commission_percentage']?>% <? }else{ echo $dothisnow=$data['bookings']['commission_to_subbroker']+$data['bookings']['broker_commission_plc_amount']+$data['bookings']['broker_commission_carparking_amount'];




if($dothisnow==0)
{ echo "%";}

}?>			  </td>

<td class="text-nowrap" style="width:6%">
<?=$this->requestAction(array('controller'=>'users','action'=>'getParent',$data['bookings']['booked_by']));?><? if($data['bookings']['booked_by_2']!="-1"){ echo "<br/>".$this->requestAction(array('controller'=>'users','action'=>'getParent',$data['bookings']['booked_by_2']));}?><? if($data['bookings']['booked_by_3']!="-1"){ echo "<br/>".$this->requestAction(array('controller'=>'users','action'=>'getParent',$data['bookings']['booked_by_3']));}?>			  </td>

<td class="text-nowrap" style="width:8%;"><? if($data['bookings']['check_no']) {?>Chq No. <?=$data['bookings']['check_no']?><br/>Dated On 
<?=date("d-M-y",strtotime($data['bookings']['check_date']))?>		<? } ?>		  </td>
<td>
<? if ($data['bookings']['credit_note_given']!=""){ if ($data['bookings']['credit_note_given']=="No"){ echo $data['bookings']['credit_note_given'];} else{ echo "Yes";}} else{ echo "N/A";} ?>			  </td>
<td><?=$data['bookings']['cheque_clearance_status']?></td>
<td class="text-nowrap" style="width:8%;"><?=$data['bookings']['booking_source']?></td>
<td class="text-nowrap" style="width:6%;">
<? if($data['bookings']['booking_canceled']=="uncancel") {?> Confirmed <? } else {?> Canceled <? } ?>
</td>
<td><?=$data['bookings']['customer_profile_given']?></td>
</tr>
<? $i++; }?>
</table></div>
</div>
<p> THIS REPORT IS JUST ESTIMATE & PROJECTION THE FINAL AND ACTUAL BOOKING WILL BE AS PER BILL RAISE TO CONCERN BUILDERS/COMPANIES.</p>
<br />
<br />
<?php /*?><table class="table table-bordered">
<thead>
<tr><td colspan="18" class="dvInnerHeader"><a href="javascript:printing()">Print this Page</a></td></tr>
<tr>
<th colspan="18" class="dvInnerHeader"><a href="Javascript:history.go(-1);">Close window</a></td>
</tr>
</thead>
</table><?php */?>
<?php /*?><iframe id="ifmcontentstoprint" style="height: 0px; width: 0px; position: absolute"></iframe><?php */?>
</div>