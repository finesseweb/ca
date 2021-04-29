<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Countries'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Enquiries'), array('controller' => 'enquiries', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php ////echo $this->Html->link(__('New Enquiry'), array('controller' => 'enquiries', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List States'), array('controller' => 'states', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New State'), array('controller' => 'states', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('Country'); ?>
<fieldset>
<legend><?php echo __('Add Country'); ?></legend>
<?php
echo $this->Form->input('name',array('class' => 'form-control'));
echo $this->Form->input('priority',array('class' => 'form-control'));
echo $this->Form->input('country_code',array('class' => 'form-control'));
?>
</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</div>
