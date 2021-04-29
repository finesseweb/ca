<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('IssueCategory.id')),array('class' => 'btn btn-primary'), array(), __('Are you sure you want to delete # %s?', $this->Form->value('IssueCategory.id'))); ?>
<?php echo $this->Html->link(__('List Feedback'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Subcategory'), array('controller' => 'subcategorys', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Subcategory'), array('controller' => 'subcategorys', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Enquiries'), array('controller' => 'enquiries', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Enquiry'), array('controller' => 'enquiries', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Projects'), array('controller' => 'projects', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('Level'); ?>
<fieldset>
<legend><?php echo __('Edit Feedback'); ?></legend>
<?php
echo $this->Form->input('id',array('class' => 'form-control'));
echo $this->Form->input('name',array('class' => 'form-control','label'=>'Titile'));
//echo $this->Form->input('category',array('class' => 'form-control','options'=>array(''=>'--Select--','feedback'=>'Feedback','facility'=>'Facility','checklist'=>'Checklist','checklist-vhsnc'=>'Checklist VHSNC','common-report'=>'Common Report')));

echo $this->Form->input('status',array('class' => 'form-control','options'=>array('active'=>'Active','deactive'=>'Deactive')));
?>
</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</div>