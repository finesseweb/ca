<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('New Country'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Enquiries'), array('controller' => 'enquiries', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Enquiry'), array('controller' => 'enquiries', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List States'), array('controller' => 'states', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New State'), array('controller' => 'states', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="table-responsive">
<h2><?php echo __('Countries'); ?></h2>
<table class="table table-hover table-condensed">
<thead>
<tr>    
<th><?php echo $this->Paginator->sort('id'); ?></th>
<th><?php echo $this->Paginator->sort('Country Name'); ?></th>
<th><?php echo $this->Paginator->sort('priority'); ?></th>
<!--<th><?php ///echo $this->Paginator->sort('country_code'); ?></th>-->
<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
</thead>
<tbody>
<?php foreach ($countries as $country): ?>
    
<tr>
<td><?php echo h($country['Country']['id']); ?>&nbsp;</td>
<td><?php echo h(ucfirst($country['Country']['name'])); ?>&nbsp;</td>
<td><?php echo h($country['Country']['priority']); ?>&nbsp;</td>
<!--<td><?php //echo h($country['Country']['country_code']); ?>&nbsp;</td>-->
<td class="actions">
<?php echo $this->Html->link(__('View'), array('action' => 'view', $country['Country']['id']),array('class' => 'btn btn-success')); ?>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $country['Country']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $country['Country']['id']),array('class' => 'btn btn-danger'), array(), __('Are you sure you want to delete # %s?', $country['Country']['id'])); ?>
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