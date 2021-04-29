<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List User Accesses'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('UserAccess'); ?>
<fieldset>
<legend><?php echo __('Add User Access'); ?></legend>
<?php
echo $this->Form->input('name',array('class' => 'form-control','label'=>'Username / IP'));
echo $this->Form->input('type',array('class' => 'form-control','options'=>array('user'=>'User','ip'=>'Ip')));
//echo $this->Form->input('updated_date');
//echo $this->Form->input('status');
//echo $this->Form->input('updated_by');
?>
</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</div>