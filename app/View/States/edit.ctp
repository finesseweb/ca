<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('State.id')),array('class' => 'btn btn-primary'), array(), __('Are you sure you want to delete # %s?', $this->Form->value('State.id'))); ?>
<?php echo $this->Html->link(__('List States'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New State'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?>
<?php //echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index')); ?>
<?php //echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?>
<?php //echo $this->Html->link(__('List Enquiries'), array('controller' => 'enquiries', 'action' => 'index')); ?>
<?php //echo $this->Html->link(__('New Enquiry'), array('controller' => 'enquiries', 'action' => 'add')); ?>
<?php //echo $this->Html->link(__('List Projects'), array('controller' => 'projects', 'action' => 'index')); ?>
<?php //echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('State'); ?>
<fieldset>
<legend><?php echo __('Edit State'); ?></legend>
<?php
echo $this->Form->input('id',array('class' => 'form-control'));
echo $this->Form->input('name',array('class' => 'form-control','label'=>'State'));
echo $this->Form->input('country_id',array('class' => 'form-control'));
?>
</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</div>
