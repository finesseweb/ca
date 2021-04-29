<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Menu.id')),array('class' => 'btn btn-primary'), null, __('Are you sure you want to delete # %s?', $this->Form->value('Menu.id'))); ?>
<?php echo $this->Html->link(__('List Menus'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Menuheaders'), array('controller' => 'menuheaders', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Menuheader'), array('controller' => 'menuheaders', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('Menu'); ?>
<fieldset>
<legend><?php echo __('Admin Edit Menu'); ?></legend>
<?php
echo $this->Form->input('id',array('class' => 'form-control'));
echo $this->Form->input('menuheader_id',array('class' => 'form-control'));
echo $this->Form->input('name',array('class' => 'form-control'));
echo $this->Form->input('controller',array('class' => 'form-control'));
echo $this->Form->input('action',array('class' => 'form-control'));
echo $this->Form->input('status',array("type"=>"radio",'options' => array('active'=>'active', 'deactive'=>'deactive')));
?>
</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</div>