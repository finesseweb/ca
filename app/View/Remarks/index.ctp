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
<h2><?php echo __('Remarks'); ?></h2>
<table class="table table-hover table-condensed">
<thead>
<tr>
<th><?php echo $this->Paginator->sort('id'); ?></th>
<th><?php echo $this->Paginator->sort('enquiry_id'); ?></th>
<th><?php echo $this->Paginator->sort('name'); ?></th>
<th><?php echo $this->Paginator->sort('posted_date'); ?></th>
<th><?php echo $this->Paginator->sort('feedBy'); ?></th>
<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
</thead>
<tbody>
<?php foreach ($remarks as $remarking): ?>
<?php 
$ppp=$remarking['Remark'];
foreach ($ppp as $remark): ?>

<tr>
<td>


<?php echo ($remark['id']);?>

<?php //echo h($remark['Enquiry']['id']); ?>&nbsp;</td>
<td><?php echo $this->Html->link($remarking['Enquiry']['id'], array('controller' => 'enquiries', 'action' => 'view', $remarking['Enquiry']['id'])); ?></td>
<td><?php echo h($remark['name']); ?>&nbsp;</td>
<td><?php echo h(date('d M , y',strtotime($remark['posted_date']))); ?>&nbsp;</td>
<td><?php echo h($remark['feedBy']); ?>&nbsp;</td>
<td class="actions">
<?php echo $this->Html->link(__('View'), array('action' => 'view', $remark['id']),array('class' => 'btn btn-success')); ?>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $remark['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $remark['id']),array('class' => 'btn btn-danger'), array(), __('Are you sure you want to delete # %s?', $remark['id'])); ?>
</td>
</tr>
<?php endforeach; ?>
<?php endforeach; ?>

</tbody>
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
</div>
</div>