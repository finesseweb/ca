<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Blocks'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Enquiries'), array('controller' => 'enquiries', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php ////echo $this->Html->link(__('New Enquiry'), array('controller' => 'enquiries', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Projects'), array('controller' => 'projects', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('Block'); ?>
<fieldset>
<legend><?php echo __('Add Block'); ?></legend>
<?php
echo $this->Form->input('name',array('class' => 'form-control','label'=>'Block'));
echo $this->Form->input('city_id',array('class' => 'form-control','label'=>'District'));
?>
</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</div>