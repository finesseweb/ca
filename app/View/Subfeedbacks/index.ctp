<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('New Question'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Feedback'), array('controller' => 'feedbacks', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Category'), array('controller' => 'financials', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Enquiries'), array('controller' => 'enquiries', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Enquiry'), array('controller' => 'enquiries', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Projects'), array('controller' => 'projects', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<h2><?php echo __(' List of Questions'); ?></h2>
<table class="table table-hover table-condensed">
<thead>
<tr>
<th><?php echo $this->Paginator->sort('id'); ?></th>
<th><?php echo $this->Paginator->sort('name'); ?></th>
<th><?php echo $this->Paginator->sort('Feedback'); ?></th>

<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
</thead>
<tbody>
<?php 
foreach ($subfeedbacks as $subfeedback): ?>
<tr>
<td><?php echo h($subfeedback['Subfeedback']['id']); ?>&nbsp;</td>
<td class="question"><?php echo h($subfeedback['Subfeedback']['name']); ?>&nbsp;</td>
<td><?php echo h(ucfirst($subfeedback['Feedback']['name'])); ?>&nbsp;</td>
<td class="actions">
<?php echo $this->Html->link(__('View'), array('action' => 'view', $subfeedback['Subfeedback']['id']),array('class' => 'btn btn-success')); ?>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $subfeedback['Subfeedback']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $subfeedback['Subfeedback']['id']),array('class' => 'btn btn-danger'), array(), __('Are you sure you want to delete # %s?', $subfeedback['Subfeedback']['id'])); ?>
</td>
</tr>
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
</div>