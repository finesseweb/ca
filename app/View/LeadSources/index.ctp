<div class="actions">
<h3><?php echo __('Lead Sources'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('New Lead Source'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="table-responsive">
<table class="table table-hover table-condensed">
<tr>
<th><?php echo $this->Paginator->sort('id'); ?></th>
<th><?php echo $this->Paginator->sort('name'); ?></th>
<th><?php echo $this->Paginator->sort('flag'); ?></th>
<th><?php echo $this->Paginator->sort('status'); ?></th>
<th><?php echo $this->Paginator->sort('type'); ?></th>
<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
<?php foreach ($leadSources as $leadSource): ?>
<tr>
<td><?php echo h($leadSource['LeadSource']['id']); ?>&nbsp;</td>
<td><?php echo h($leadSource['LeadSource']['name']); ?>&nbsp;</td>
<td><?php echo h($leadSource['LeadSource']['flag']); ?>&nbsp;</td>
<td><?php echo h($leadSource['LeadSource']['status']); ?>&nbsp;</td>
<td><?php echo h($leadSource['LeadSource']['type']); ?>&nbsp;</td>
<td class="actions">
<?php echo $this->Html->link(__('View'), array('action' => 'view', $leadSource['LeadSource']['id']),array('class' => 'btn btn-success')); ?>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $leadSource['LeadSource']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $leadSource['LeadSource']['id']),array('class' => 'btn btn-danger'),null, __('Are you sure you want to delete # %s?', $leadSource['LeadSource']['id'])); ?>
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

