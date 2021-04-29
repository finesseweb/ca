<div class="actions">
<h3><?php echo __('Designations'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('New Designation'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Designations'), array('controller' => 'projects', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>

</div>
</div>
<div class="table-responsive">
<?php /*?><h2><?php echo __('Property Types'); ?></h2><?php */?>

<table class="table table-hover table-condensed">
<tr>
<th><?php echo $this->Paginator->sort('id'); ?></th>
<th><?php echo $this->Paginator->sort('name'); ?></th>
<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
<?php foreach ($designations as $designation): ?>
<tr>
<td><?php echo h($designation['Designation']['id']); ?>&nbsp;</td>
<td><?php echo h(ucfirst($designation['Designation']['name'])); ?>&nbsp;</td>
<td class="actions">
<?php echo $this->Html->link(__('View'), array('action' => 'view', $designation['Designation']['id']),array('class' => 'btn btn-success')); ?>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $designation['Designation']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $designation['Designation']['id']),array('class' => 'btn btn-danger'), null, __('Are you sure you want to delete # %s?', $designation['Designation']['id'])); ?>
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
</div>
</div>

