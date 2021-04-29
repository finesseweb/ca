<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Menus'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Menuheaders'), array('controller' => 'menuheaders', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Menuheader'), array('controller' => 'menuheaders', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('Menu'); ?>
<fieldset>
<legend><?php echo __('Admin Add Menu'); ?></legend>
<?php
echo $this->Form->input('menuheader_id');
echo $this->Form->input('name');
echo $this->Form->input('controller');
echo $this->Form->input('action');
echo $this->Form->input('status',array("type"=>"radio",'options' => array('active'=>'active', 'deactive'=>'deactive')));
?>
</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</div>
