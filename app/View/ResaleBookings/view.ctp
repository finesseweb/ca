<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
<table class="table table-striped">
<tr><td><?php echo __('Id'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['id']); ?>
&nbsp;<span style="float:right"><a href="javascript:void(0)" onclick="window.open('<?=SITE_PATH."resaleBookings/report/".$resaleBooking['ResaleBooking']['id']?>','abhay','scrollbars=1,width=1200,height=700,left=100')">Report</a></span>
</td>
</tr>
<tr><td><?php echo __('Date of booking'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['date_of_booking']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Builder'); ?></td>
<td>
<?php echo h($resaleBooking['Builder']['name']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Project'); ?></td>
<td>
<?php echo h($resaleBooking['Project']['name']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('First Seller Name'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['first_seller_name']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Second Seller Name'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['second_seller_name']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Third Seller Name'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['third_seller_name']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('First Buyer Name'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['first_buyer_name']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Second Buyer Name'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['second_buyer_name']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Third Buyer Name'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['third_buyer_name']); ?>
&nbsp;
</td>
</tr>


<tr>
<td><?php echo __('Unit No'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['unit_no']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Project Plan'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['project_plan']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Area'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['area']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Areatype'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['areatype']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Rate'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['rate']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Premium'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['premium']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Bsp'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['bsp']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Plc'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['plc']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Carparking'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['carparking']); ?>
&nbsp;
</td>
</tr>
<tr>
<td><?php echo __('Other'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['other']); ?>
&nbsp;
</td>
</tr>

<tr>
<td><?php echo __('Location'); ?></td>
<td>
<?php echo h($resaleBooking['Location']['name']); ?>
&nbsp;
</td></tr>
<tr>
<td><?php echo __('Broker Name'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['broker_name']); ?>
&nbsp;
</td></tr>
<tr>
<td><?php echo __('Broker Company'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['broker_company']); ?>
&nbsp;
</td></tr>
<tr>
<td><?php echo __('Buyer'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['buyer']); ?>
&nbsp;
</td></tr>
<tr>
<td><?php echo __('Seller'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['seller']); ?>
&nbsp;
</td></tr>
<tr>
<td><?php echo __('Cheque No 1'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['cheque_no_1']); ?>
&nbsp;
</td></tr>
<tr>
<td><?php echo __('Cheque Date 1'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['cheque_date_1']); ?>
&nbsp;
</td></tr>
<tr>
<td><?php echo __('Drawn On 1'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['drawn_on_1']); ?>
&nbsp;
</td></tr>
<tr>
<td><?php echo __('Cheque Amount 1'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['cheque_amount_1']); ?>
&nbsp;
</td></tr>
<tr>
<td><?php echo __('Cheque No 2'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['cheque_no_2']); ?>
&nbsp;
</td></tr>
<tr>
<td><?php echo __('Cheque Date 2'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['cheque_date_2']); ?>
&nbsp;
</td></tr>
<tr>
<td><?php echo __('Drawn On 2'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['drawn_on_2']); ?>
&nbsp;
</td></tr>
<tr>
<td><?php echo __('Cheque Amount 2'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['cheque_amount_2']); ?>
&nbsp;
</td></tr>
<tr>
<td><?php echo __('Cheque No 3'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['cheque_no_3']); ?>
&nbsp;
</td></tr>
<tr>
<td><?php echo __('Cheque Date 3'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['cheque_date_3']); ?>
&nbsp;
</td></tr>
<tr>
<td><?php echo __('Drawn On 3'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['drawn_on_3']); ?>
&nbsp;
</td></tr>
<tr>
<td><?php echo __('Cheque Amount 3'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['cheque_amount_3']); ?>
&nbsp;
</td></tr>
<tr>
<td><?php echo __('Message Status'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['message_status']); ?>
&nbsp;
</td></tr>
<tr>
<td><?php echo __('Message Status Date'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['message_status_date']); ?>
&nbsp;
</td></tr>
<tr>
<td><?php echo __('Message Status Comment'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['message_status_comment']); ?>
&nbsp;
</td></tr>
<tr>
<td><?php echo __('Booked By'); ?></td>
<td>
<?php echo h($resaleBooking['User']['username']); ?>
&nbsp;
</td></tr>
<tr>
<td><?php echo __('Booked By Joint One'); ?></td>
<td>
<? echo $this->requestAction(array('controller'=>'users','action'=>'getParent',$resaleBooking['ResaleBooking']['booked_by_joint_one']));?>
&nbsp;
</td></tr>
<tr>
<td><?php echo __('Booked By Joint Two'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['booked_by_joint_two']); ?>
&nbsp;
</td></tr>
<tr>
<td><?php echo __('Booking Source'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['booking_source']); ?>
&nbsp;
</td></tr>
<tr>
<td><?php echo __('Final Remark'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['final_remark']); ?>
&nbsp;
</td></tr>
<tr>
<td><?php echo __('Posted'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['posted']); ?>
&nbsp;
</td></tr>
<tr>
<td><?php echo __('Status'); ?></td>
<td>
<?php echo h($resaleBooking['ResaleBooking']['status']); ?>
&nbsp;
</td></tr>


<table>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>
