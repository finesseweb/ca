<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Subcategory.id')),array('class' => 'btn btn-primary'), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Subcategory.id'))); ?>
<?php echo $this->Html->link(__('List of Questions'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
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
<?php echo $this->Form->create('Subfeedback'); ?>
<fieldset>
<legend><?php echo __(' Question'); ?></legend>
<?php
echo $this->Form->input('id',array('class' => 'form-control'));
echo $this->Form->input('name',array('class' => 'form-control question'));
echo $this->Form->input('responce_one',array('class' => 'form-control question'));
echo $this->Form->input('responce_two',array('class' => 'form-control question'));
echo $this->Form->input('responce_three',array('class' => 'form-control question'));
echo $this->Form->input('responce_four',array('class' => 'form-control question'));
echo $this->Form->input('category',array('class' => 'form-control','options'=>array(''=>'--Select--','feedback'=>'Feedback','facility'=>'Facility','checklist'=>'Checklist','checklist-vhsnc'=>'Checklist VHSNC','common-report'=>'Common Report')));

echo $this->Form->input('cat_id',array('class' => 'form-control','label'=>'Feedback','options'=>array($financials)));
echo $this->Form->input('facility_level',array('class' => 'form-control','options'=>array(''=>'--Select--','hsc'=>'HSC','aphc'=>'APHC','hwc'=>'H & WC','chc'=>'CHC','phc'=>'PHC')));
//echo $this->Form->input('level',array('class' => 'form-control','options'=>array(''=>'--Select--','level1'=>'Level 1','level2'=>'Level 2','level3'=>'Level 3','level4'=>'Level 4','level5'=>'Level 5')));
echo $this->Form->input('level',array('class' => 'form-control','options'=>array(''=>'--Select--',$level)));

echo $this->Form->input('status',array('class' => 'form-control','options'=>array('active'=>'Active','deactive'=>'Deactive')));
?>
</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</div>