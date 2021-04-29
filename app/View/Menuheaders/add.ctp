<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Menuheaders'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Menus'), array('controller' => 'menus', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Menu'), array('controller' => 'menus', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('Menuheader'); ?>
<fieldset>
<legend><?php echo __('Admin Add Menuheader'); ?></legend>
<?php
echo $this->Form->input('name',array('class' => 'form-control'));
echo $this->Form->input('controller',array('class' => 'form-control'));
echo $this->Form->input('action',array('class' => 'form-control'));
echo $this->Form->input('status',array("type"=>"radio",'options' => array('active'=>'active', 'deactive'=>'deactive')));
?>
</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</div>