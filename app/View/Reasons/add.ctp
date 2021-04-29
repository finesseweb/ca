<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Reason'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Category'), array('controller' => 'financials', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Category'), array('controller' => 'financials', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Enquiries'), array('controller' => 'enquiries', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Enquiry'), array('controller' => 'enquiries', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Projects'), array('controller' => 'projects', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('Reason'); ?>
<fieldset>
<legend><?php echo __('Reason'); ?></legend>
<?php
//print_r($cat_id);
echo $this->Form->input('name',array('class' => 'form-control'));
echo $this->Form->input('cat_id',array('class' => 'form-control','label'=>'Category','options'=>array(''=>'Select Category',$financials)));
echo $this->Form->input('status',array('class' => 'form-control','options'=>array('active'=>'Active','deactive'=>'Deactive')));
?>
</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</div>