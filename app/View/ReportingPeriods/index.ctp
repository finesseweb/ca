<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('New Reporting Period'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Reporting Period'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('Grant Period'), array('controller' => 'periods','action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Grant Period'), array('controller' => 'periods','action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Subcategory'), array('controller' => 'subcategorys', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Enquiries'), array('controller' => 'enquiries', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Enquiry'), array('controller' => 'enquiries', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Projects'), array('controller' => 'projects', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<h2><?php echo __('Grant Period'); ?></h2>
<table class="table table-hover table-condensed">
<thead>
<tr>
<th><?php echo $this->Paginator->sort('id'); ?></th>
<th><?php echo $this->Paginator->sort('from_date'); ?></th>
<th><?php echo $this->Paginator->sort('to_date'); ?></th>
<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
</thead>
<tbody>
<?php 
foreach ($financials as $financial): ?>
<tr>
<td><?php echo h($financial['ReportingPeriod']['id']); ?>&nbsp;</td>
<td><?php echo h(date('d-m-Y',strtotime($financial['ReportingPeriod']['from_date']))); ?>&nbsp;</td>
<td><?php echo h(date('d-m-Y',strtotime($financial['ReportingPeriod']['to_date']))); ?>&nbsp;</td>
<td class="actions">
<?php echo $this->Html->link(__('View'), array('action' => 'view', $financial['ReportingPeriod']['id']),array('class' => 'btn btn-success')); ?>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $financial['ReportingPeriod']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $financial['ReportingPeriod']['id']),array('class' => 'btn btn-danger'), array(), __('Are you sure you want to delete # %s?', $financial['ReportingPeriod']['id'])); ?>
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