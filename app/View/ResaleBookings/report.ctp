<div class="table-responsive"><table class="table table-hover table-condensed">
<tr>
<td colspan="6"><b>Resale Booking Detail For R<?=$resaleBooking['ResaleBooking']['id']?></b>
</td>
</tr>
<tr>
<td> <strong>Date of Booking</strong></td>
<td valign="MIDDLE" ><?=$resaleBooking['ResaleBooking']['date_of_booking']?></td>
<td><strong>Builder Name</strong></td>
<td><?=$resaleBooking['Builder']['name']?></td>
<td><strong>Project Name</strong></td>
<td  ><?=$resaleBooking['Project']['name']?></td>
</tr>
<tr>
<td> <strong>1st Seller Name</strong></td>
<td><?=$resaleBooking['ResaleBooking']['first_seller_name']?></td>
<td><strong>2nd Seller Name</strong></td>
<td><?=$resaleBooking['ResaleBooking']['second_seller_name']?>
</td>
<td> <strong>3rd Seller Name</strong></td>
<td> <?=$resaleBooking['ResaleBooking']['third_seller_name']?></td>
</tr>

<tr>
<td> <strong>1st Buyer Name</strong></td>
<td><?=$resaleBooking['ResaleBooking']['first_buyer_name']?></td>
<td><strong>2nd Buyer Name</strong></td>
<td><?=$resaleBooking['ResaleBooking']['second_buyer_name']?>
</td>
<td> <strong>3rd Buyer Name</strong></td>
<td> <?=$resaleBooking['ResaleBooking']['third_buyer_name']?></td>
</tr>
<tr>
<td><strong>Unit No</strong> </td>
<td><?=$resaleBooking['ResaleBooking']['unit_no']?></td>
<td> <strong>Plan</strong> </td>
<td colspan="3" > <?=$resaleBooking['ResaleBooking']['project_plan']?></td>
</tr>

<tr>
<td><strong>Area</strong></td>
<td><?=$resaleBooking['ResaleBooking']['area']?> <?=$resaleBooking['ResaleBooking']['areatype']?></td>
<td><strong>Rate</strong></td>
<td><?=$resaleBooking['ResaleBooking']['rate']?></td>
<td><strong>Premium</strong></td>
<td><?=$resaleBooking['ResaleBooking']['premium']?></td>
</tr>
<tr>
<td> <strong>Basic Sale Price</strong> </td>
<td><?=$resaleBooking['ResaleBooking']['bsp']?></td>
<td><strong>PLC</strong></td>
<td> <?=$resaleBooking['ResaleBooking']['plc']?>
</td>
<td><strong>Car Parking</strong></td>
<td><?=$resaleBooking['ResaleBooking']['carparking']?></td>
</tr>
<tr>
<td><strong>Other</strong></td>
<td> <?=$resaleBooking['ResaleBooking']['other']?>
</td>
<td> <strong>Project Location</strong>                                </td>
<td  colspan="3"> <?=$resaleBooking['Location']['name']?>
</td>
</tr>
<tr>
<td><strong>Resale Through Broker Name</strong></td>
<td> <?=$resaleBooking['ResaleBooking']['broker_name']?></td>
<td><strong>Resale Through Broker Company</strong></td>
<td colspan="3" > <?=$resaleBooking['ResaleBooking']['broker_company']?>
</td>
</tr>

<tr>
<td><strong>Commission Coming from</strong> </td>
<td><? if($resaleBooking['ResaleBooking']['buyer']=='Buyer') { echo $resaleBooking['ResaleBooking']['buyer']; } if($resaleBooking['ResaleBooking']['seller']=='Seller') { echo " , ".$resaleBooking['ResaleBooking']['seller']; } ?> </td>
<td  colspan="3"></td>
<td  colspan="2">  </td>
</tr>
<?php /*?><tr>
<td>&nbsp;<strong></strong></td>
<td><strong><strong>Cheque Number</strong> </strong></td>
<td><strong><strong>Cheque Dated</strong> </strong></td>
<td colspan="2" ><strong>Cheque Bank </strong></td>
<td><strong>Cheque Amount </strong></td></tr>

<tr style="height:25px;">
<td> <strong>1st&nbsp;Cheque No</strong> </td>
<td><?=$resaleBooking['ResaleBooking']['cheque_no_1']?></td>
<td><?=$resaleBooking['ResaleBooking']['cheque_date_1']?></td>
<td colspan="2" ><?=$resaleBooking['ResaleBooking']['drawn_on_1']?></td>
<td><?=$resaleBooking['ResaleBooking']['cheque_amount_1']?></td>
</tr>
<tr style="height:25px;">
<td> <strong>2st&nbsp;Cheque No</strong> </td>
<td><?=$resaleBooking['ResaleBooking']['cheque_no_2']?></td>
<td><?=$resaleBooking['ResaleBooking']['cheque_date_2']?> </td>
<td colspan="2" ><?=$resaleBooking['ResaleBooking']['drawn_on_2']?></td>
<td><?=$resaleBooking['ResaleBooking']['cheque_amount_2']?></td>
</tr>

<tr style="height:25px;">
<td> <strong>3st&nbsp;Cheque No</strong> </td>
<td><?=$resaleBooking['ResaleBooking']['cheque_no_3']?></td>
<td><?=$resaleBooking['ResaleBooking']['cheque_date_3']?></td>

<td colspan="2" ><?=$resaleBooking['ResaleBooking']['drawn_on_3']?></td>
<td><?=$resaleBooking['ResaleBooking']['cheque_amount_3']?></td>
</tr><?php */?>
<? if($resaleBooking['ResaleBooking']['message_status']=='Ok') {  ?><tr>
<td> <strong>Msg Clearance Date</strong></td><td><?=$resaleBooking['ResaleBooking']['message_status_date']?></td>
<td> <strong>Msg Clearance Comments</strong></td><td colspan="3"><?=$resaleBooking['ResaleBooking']['message_status_comment']?></td>
</tr>
<? } ?>
<?php /*?><tr>
<td><strong> Booked By</strong>  </td>
<td>
<? if($resaleBooking['ResaleBooking']['booked_by']!='') { echo $resaleBooking['User']['name']; } ?>
</td>
<td><strong>Booked By 1st Joint Executive</strong> </td>
<td><? if($resaleBooking['ResaleBooking']['booked_by_joint_one']!='') {  echo $this->requestAction(array('controller'=>'users','action'=>'getParent',$resaleBooking['ResaleBooking']['booked_by_joint_one'])); } ?>
</td>
<td><strong>Booked By 2nd Joint Executive</strong></td>
<td><? if($resaleBooking['ResaleBooking']['booked_by_joint_two']!='') { ? echo $this->requestAction(array('controller'=>'users','action'=>'getParent',$resaleBooking['ResaleBooking']['booked_by_joint_two'])); } ?></td></tr><?php */?>
<tr>
<td> <strong>Booking Source</strong> </td>
<td><?=$resaleBooking['ResaleBooking']['booking_source']?></td>
<td> <strong>Remark</strong></td>
<td colspan="3" > <?=$resaleBooking['ResaleBooking']['final_remark']?>
</td>
</tr>

<tr>
<td><strong>Cheque Clearance Status</strong> </td>
<td><textarea class="form-control"></textarea><br/><?=$resaleBooking['ResaleBooking']['message_status']?></td>
<td> <strong>Messaging Clearance Status</strong></td>
<td colspan="3"> <textarea class="form-control"></textarea><br/><?=$resaleBooking['ResaleBooking']['message_status']?>
</td>
</tr>
<tr>
<td><strong>Booked By</strong> </td><td><textarea cols="25"></textarea><br/><? if($resaleBooking['ResaleBooking']['booked_by']!='') { $resaleBooking['User']['name']; } ?></td><td><strong>Booked By 1st Joint Executive</strong></td><td><? if($resaleBooking['ResaleBooking']['booked_by_joint_one']!='') {  echo $this->requestAction(array('controller'=>'users','action'=>'getParent',$resaleBooking['ResaleBooking']['booked_by_joint_one'])); } ?></td>
<td><strong>Booked By 2nd Joint Executive</strong></td>
<td><? if($resaleBooking['ResaleBooking']['booked_by_joint_two']!='') {  echo $this->requestAction(array('controller'=>'users','action'=>'getParent',$resaleBooking['ResaleBooking']['booked_by_joint_two'])); } ?></td>
</tr>
</table><table id="confirm">
<tr>
<td><input type="button" name="savethis"  class="confirm" value="Print"  onclick="return printDiv();"/></td>
</tr>
</table></div>
<script>
$("td strong").parent().css("background-color","#e4e4e4");
$(".confirm").click(function() {$("#confirm").hide();window.print('#attendence_form')});
</script>