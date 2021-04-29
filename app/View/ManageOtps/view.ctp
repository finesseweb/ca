<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Manage Otp'), array('action' => 'edit', $manageOtp['ManageOtp']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Manage Otp'), array('action' => 'delete', $manageOtp['ManageOtp']['id']), null, __('Are you sure you want to delete # %s?', $manageOtp['ManageOtp']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Manage Otps'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Manage Otp'), array('action' => 'add')); ?> </li>
	</ul>
</div><div class="manageOtps view">
<h2><?php echo __('Manage Otp'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($manageOtp['ManageOtp']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($manageOtp['ManageOtp']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Otp'); ?></dt>
		<dd>
			<?php echo h($manageOtp['ManageOtp']['otp']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Otptime'); ?></dt>
		<dd>
			<?php echo h($manageOtp['ManageOtp']['otptime']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ip'); ?></dt>
		<dd>
			<?php echo h($manageOtp['ManageOtp']['ip']); ?>
			&nbsp;
		</dd>
	</dl>
</div>