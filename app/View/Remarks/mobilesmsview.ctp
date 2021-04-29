<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('New Remark'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Enquiries'), array('controller' => 'enquiries', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Enquiry'), array('controller' => 'enquiries', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('Mobile Sms'), array('action' => 'mobilesms'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="table-responsive">
<h2><?php echo __('Mobilesms'); ?></h2>
<table class="table table-hover table-condensed">
<thead>
<tr>
<th>id</th>
<th>enquiry_id</th>
<th>name</th>
<th>posted_date</th>
<th>feedBy</th>
</tr>
</thead>
<tbody>
<?php foreach ($mobilesmss as $mobilesmsing): ?>
<?php 
//$ppp=$mobilesmsing['Mobilesms'];
//foreach ($ppp as $mobilesms): 
//print_r($mobilesmsing);
?>
<tr>
<td>


<?php echo ($mobilesmsing['Mobilesms']['id']);?>

<?php //echo h($remark['Enquiry']['id']); ?>&nbsp;</td>
<td><?php echo $this->Html->link($mobilesmsing['Mobilesms']['enquiry_id'], array('controller' => 'enquiries', 'action' => 'view', $mobilesmsing['Mobilesms']['enquiry_id'])); ?></td>
<td><?php echo h($mobilesmsing['Mobilesms']['remark']); ?>&nbsp;</td>
<td><?php echo h(date('d M , y',strtotime($mobilesmsing['Mobilesms']['posted_date']))); ?>&nbsp;</td>
<td><?php echo h($mobilesmsing['Mobilesms']['feedby']); ?>&nbsp;</td>
</tr>
<?php endforeach; ?>
<?php //endforeach; ?>

</tbody>
</table>
<p>
<?php
/*echo $this->Paginator->counter(array(
'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
));*/
?>	</p>
<div class="paging">
<?php
/*echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
echo $this->Paginator->numbers(array('separator' => ''));
echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));*/
?>
</div>
</div>