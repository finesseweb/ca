<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Lead Sources'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('LeadSource'); ?>
<fieldset>
<legend><?php echo __('Add Lead Source'); ?></legend>
<?php
echo $this->Form->input('name',array('class' => 'form-control'));
echo $this->Form->input('flag',array('class' => 'form-control'));
echo $this->Form->input('status',array('class' => 'form-control'));
echo $this->Form->input('type',array('class' => 'form-control'));
?>
</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</div>
