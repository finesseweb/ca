<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('List Remarks'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Enquiries'), array('controller' => 'enquiries', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Enquiry'), array('controller' => 'enquiries', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('Mobile Sms'), array('action' => 'mobilesms'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('Mobilesms'); ?>
<fieldset>
<legend><?php echo __('edit Mobilesms'); ?></legend>
<?php
echo $this->Form->input('id',array('class' => 'form-control'));
echo $this->Form->input('enquiry_id',array('class' => 'form-control'));
echo $this->Form->input('remark',array('class' => 'form-control'));
echo $this->Form->input('reminder_date');
echo $this->Form->input('reminder_time');
?>
<input name="data[Mobilesms][feedby]" type="hidden" required="required" value="<?=CakeSession::read('User.id');?>">
<input name="data[Mobilesms][user_id]" type="hidden" required="required" value="<?=CakeSession::read('User.id');?>">
</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</div>