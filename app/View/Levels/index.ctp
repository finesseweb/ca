<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('New Level Title'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Question'), array('controller' => 'subfeedbacks', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Question'), array('controller' => 'subfeedbacks', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Level'), array('controller' => 'levels', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Enquiry'), array('controller' => 'enquiries', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Projects'), array('controller' => 'projects', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<h2><?php echo __('Level'); ?></h2>
<table class="table table-hover table-condensed">
<thead>
<tr>
<th><?php echo $this->Paginator->sort('id'); ?></th>
<th><?php echo $this->Paginator->sort('Titile'); ?></th>
<!--<th><?php //echo $this->Paginator->sort('category'); ?></th>-->

<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
</thead>
<tbody>
<?php 
foreach ($issuecategorys as $issuecategory): ?>
<tr>
<td><?php echo h($issuecategory['Level']['id']); ?>&nbsp;</td>
<td><?php echo h(ucfirst($issuecategory['Level']['name'])); ?>&nbsp;</td>
<!--<td><?php //echo h(ucfirst($issuecategory['Level']['category'])); ?>&nbsp;</td>-->

<td class="actions">
<?php echo $this->Html->link(__('View'), array('action' => 'view', $issuecategory['Level']['id']),array('class' => 'btn btn-success')); ?>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $issuecategory['Level']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $issuecategory['Level']['id']),array('class' => 'btn btn-danger'), array(), __('Are you sure you want to delete # %s?', $issuecategory['Level']['id'])); ?>
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