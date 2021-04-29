<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('PropertyType.id')),array('class' => 'btn btn-primary'), null, __('Are you sure you want to delete # %s?', $this->Form->value('PropertyType.id'))); ?>
<?php echo $this->Html->link(__('List Property Types'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Projects'), array('controller' => 'projects', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Resales'), array('controller' => 'resales', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Resale'), array('controller' => 'resales', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('PropertyType'); ?>
<fieldset>
<legend><?php echo __('Edit Property Type'); ?></legend>
<?php
echo $this->Form->input('id',array('class' => 'form-control'));
echo $this->Form->input('name',array('class' => 'form-control'));
?>
</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</div>