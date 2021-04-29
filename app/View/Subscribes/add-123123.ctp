<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Remotes'), array('action' => 'index')); ?></li>
	</ul>
</div><div class="remotes form">
<?php echo $this->Form->create('Remote'); ?>
	<fieldset>
		<legend><?php echo __('Add Remote'); ?></legend>
	<?php
		echo $this->Form->input('website');
		echo $this->Form->input('project_name');
		echo $this->Form->input('client');
		echo $this->Form->input('phone');
		echo $this->Form->input('email');
		echo $this->Form->input('country');
		echo $this->Form->input('posted_on');
		echo $this->Form->input('message');
		echo $this->Form->input('enquiry_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

