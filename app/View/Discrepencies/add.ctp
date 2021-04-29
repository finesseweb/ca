<div class="discrepencies form">
<?php echo $this->Form->create('Discrepency'); ?>
	<fieldset>
		<legend><?php echo __('Add Discrepency'); ?></legend>
	<?php
		echo $this->Form->input('enquiry_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('comment');
		echo $this->Form->input('status');
		echo $this->Form->input('posted');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Discrepencies'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Enquiries'), array('controller' => 'enquiries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Enquiry'), array('controller' => 'enquiries', 'action' => 'add')); ?> </li>
	</ul>
</div>
