<h3><?php echo __('Resale Bookings'); ?></h3>
<div class="btn-group"><?php echo $this->Html->link(__('New Resale Booking'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?></div>
<div class="row">
<div class="col-sm-12"><div class="left_resale">
<div class="table-responsive">
<table cellpadding="0" cellspacing="0" id="resultTable">
<tr>
<th><?php echo $this->Paginator->sort('id'); ?></th>
<th><?php echo $this->Paginator->sort('date_of_booking'); ?></th>
<th><?php echo $this->Paginator->sort('builder_id'); ?></th>
<th><?php echo $this->Paginator->sort('project_id'); ?></th>
<?php /*?><th><?php echo $this->Paginator->sort('first_seller_name'); ?></th>
<th><?php echo $this->Paginator->sort('second_seller_name'); ?></th>
<th><?php echo $this->Paginator->sort('third_seller_name'); ?></th>
<th><?php echo $this->Paginator->sort('first_buyer_name'); ?></th>
<th><?php echo $this->Paginator->sort('second_buyer_name'); ?></th>
<th><?php echo $this->Paginator->sort('third_buyer_name'); ?></th>
<th><?php echo $this->Paginator->sort('unit_no'); ?></th>
<th><?php echo $this->Paginator->sort('project_plan'); ?></th>
<th><?php echo $this->Paginator->sort('area'); ?></th>
<th><?php echo $this->Paginator->sort('areatype'); ?></th>
<th><?php echo $this->Paginator->sort('rate'); ?></th>
<?php /*?><th><?php echo $this->Paginator->sort('premium'); ?></th>
<th><?php echo $this->Paginator->sort('bsp'); ?></th>
<th><?php echo $this->Paginator->sort('plc'); ?></th>
<th><?php echo $this->Paginator->sort('carparking'); ?></th>
<th><?php echo $this->Paginator->sort('other'); ?></th>
<th><?php echo $this->Paginator->sort('location_id'); ?></th>
<th><?php echo $this->Paginator->sort('broker_name'); ?></th>
<th><?php echo $this->Paginator->sort('broker_company'); ?></th>
<th><?php echo $this->Paginator->sort('buyer'); ?></th>
<th><?php echo $this->Paginator->sort('seller'); ?></th>
<th><?php echo $this->Paginator->sort('cheque_no_1'); ?></th>
<th><?php echo $this->Paginator->sort('cheque_date_1'); ?></th>
<th><?php echo $this->Paginator->sort('drawn_on_1'); ?></th>
<th><?php echo $this->Paginator->sort('cheque_amount_1'); ?></th>
<th><?php echo $this->Paginator->sort('cheque_no_2'); ?></th>
<th><?php echo $this->Paginator->sort('cheque_date_2'); ?></th>
<th><?php echo $this->Paginator->sort('drawn_on_2'); ?></th>
<th><?php echo $this->Paginator->sort('cheque_amount_2'); ?></th>
<th><?php echo $this->Paginator->sort('cheque_no_3'); ?></th>
<th><?php echo $this->Paginator->sort('cheque_date_3'); ?></th>
<th><?php echo $this->Paginator->sort('drawn_on_3'); ?></th>
<th><?php echo $this->Paginator->sort('cheque_amount_3'); ?></th>
<th><?php echo $this->Paginator->sort('message_status'); ?></th>
<th><?php echo $this->Paginator->sort('message_status_date'); ?></th>
<th><?php echo $this->Paginator->sort('message_status_comment'); ?></th>
<th><?php echo $this->Paginator->sort('booked_by_joint_one'); ?></th>
<th><?php echo $this->Paginator->sort('booked_by_joint_two'); ?></th>
<th><?php echo $this->Paginator->sort('booking_source'); ?></th>
<th><?php echo $this->Paginator->sort('final_remark'); ?></th><?php */?>
<th><?php echo $this->Paginator->sort('booked_by'); ?></th>
<th><?php echo $this->Paginator->sort('posted'); ?></th>
<th><?php echo $this->Paginator->sort('status'); ?></th>
<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
<?php foreach ($resaleBookings as $resaleBooking): ?>
<tr>
<td><?php echo h($resaleBooking['ResaleBooking']['id']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['date_of_booking']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['Builder']['name']); ?></td>
<td><?php echo h($resaleBooking['Project']['name']); ?></td>
<?php /*?><td><?php echo h($resaleBooking['ResaleBooking']['first_seller_name']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['second_seller_name']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['third_seller_name']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['first_buyer_name']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['second_buyer_name']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['third_buyer_name']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['unit_no']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['project_plan']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['area']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['areatype']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['rate']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['premium']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['bsp']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['plc']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['carparking']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['other']); ?>&nbsp;</td>
<td>
<?php echo $this->Html->link($resaleBooking['Location']['name'], array('controller' => 'locations', 'action' => 'view', $resaleBooking['Location']['id'])); ?>
</td>
<td><?php echo h($resaleBooking['ResaleBooking']['broker_name']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['broker_company']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['buyer']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['seller']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['cheque_no_1']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['cheque_date_1']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['drawn_on_1']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['cheque_amount_1']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['cheque_no_2']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['cheque_date_2']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['drawn_on_2']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['cheque_amount_2']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['cheque_no_3']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['cheque_date_3']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['drawn_on_3']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['cheque_amount_3']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['message_status']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['message_status_date']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['message_status_comment']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['booked_by_joint_one']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['booked_by_joint_two']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['booking_source']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['final_remark']); ?>&nbsp;</td><?php */?>
<td><?php echo h($resaleBooking['User']['username']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['posted']); ?>&nbsp;</td>
<td><?php echo h($resaleBooking['ResaleBooking']['status']); ?>&nbsp;</td>
<td class="actions">
<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" class="more btn btn-info" data-id="<?=$resaleBooking['ResaleBooking']['id']?>">More</a>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $resaleBooking['ResaleBooking']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $resaleBooking['ResaleBooking']['id']),array('class' => 'btn btn-danger'), null, __('Are you sure you want to delete # %s?', $resaleBooking['ResaleBooking']['id'])); ?>
</td>
</tr>
<?php endforeach; ?>
</table>
<p>
<?php
echo $this->Paginator->counter(array(
'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
));
?>	</p>
<div class="paging">
<?php
echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
echo $this->Paginator->numbers(array('separator' => ''));
echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
?>
</div></div>
</div></div></div>

<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">More Details</h4>
</div>
<div class="modal-body">
<div class="right_resale" id="resalemore"><table cellpadding="0" cellspacing="0">
<tr><td>!! MORE DATA SHOULD BE DISPLAY HERE !!</td></tr>
</table></div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>

<?php /*?></div><?php */?>
<?php /*?><div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<ul>
<li><?php echo $this->Html->link(__('New Resale Booking'), array('action' => 'add')); ?></li>
<li><?php echo $this->Html->link(__('List Builders'), array('controller' => 'builders', 'action' => 'index')); ?> </li>
<li><?php echo $this->Html->link(__('New Builder'), array('controller' => 'builders', 'action' => 'add')); ?> </li>
<li><?php echo $this->Html->link(__('List Projects'), array('controller' => 'projects', 'action' => 'index')); ?> </li>
<li><?php echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add')); ?> </li>
<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
<li><?php echo $this->Html->link(__('New Location'), array('controller' => 'locations', 'action' => 'add')); ?> </li>
</ul>
</div><?php */?>
<script>
$(".more").click(function(){
$('#resultTable tr').removeClass("done");
$(this).parent().parent().addClass("done");
var dataid=$(this).attr('data-id');
$('.right_resale').html("<div class='loading'><img src='<?=SITE_PATH?>images/loader.gif'> Please wait .Loading........</div>");
$.ajax({url:"<?=SITE_PATH?>resaleBookings/view/"+dataid,dataType:"html",success:function(result){
if(result!=''){$("#resalemore").html(result);} else {$("#resalemore").html("<div class='loading'>Data not found</div>");}
}});
});
</script>
