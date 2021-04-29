<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('MailerFeed.id')),array('class' => 'btn btn-primary'), null, __('Are you sure you want to delete # %s?', $this->Form->value('MailerFeed.id'))); ?>
<?php echo $this->Html->link(__('List Mailer Feeds'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<?php echo $this->Form->create('MailerFeed'); ?>
<fieldset>
<legend><?php echo __('Edit Mailer Feed'); ?></legend>
<?php
echo $this->Form->input('id',array('class' => 'form-control'));
echo $this->Form->input('builder',array('class' => 'form-control'));
echo $this->Form->input('project',array('class' => 'form-control'));
echo $this->Form->input('total_data',array('class' => 'form-control'));
echo $this->Form->input('type_of_data',array('class' => 'form-control'));
echo $this->Form->input('if_no_any_mailer',array('class' => 'form-control'));
//echo $this->Form->input('status');
echo $this->Form->input('posted');
?>
</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</div>