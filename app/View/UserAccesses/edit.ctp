<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('UserAccess.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('UserAccess.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List User Accesses'), array('action' => 'index')); ?></li>
	</ul>
</div><div class="userAccesses form">
<?php echo $this->Form->create('UserAccess'); ?>
	<fieldset>
		<legend><?php echo __('Edit User Access'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('type');
		echo $this->Form->input('updated_date');
		echo $this->Form->input('status');
		echo $this->Form->input('updated_by');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>