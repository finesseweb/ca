<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Manage Otps'), array('action' => 'index')); ?></li>
	</ul>
</div><div class="manageOtps form">
<?php // echo $this->Form->create('ManageOtp'); ?>
	<fieldset>
		<legend><?php // echo __('Add New Otp'); ?></legend>
	<?php
		//echo $this->Form->input('name');
		//echo $this->Form->input('otp');
		//echo $this->Form->input('otptime');
		//echo $this->Form->input('ip');
	?>
	</fieldset>
<?php // echo $this->Form->end(__('Submit')); ?>
</div>

