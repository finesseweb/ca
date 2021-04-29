<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User Access'), array('action' => 'edit', $userAccess['UserAccess']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User Access'), array('action' => 'delete', $userAccess['UserAccess']['id']), null, __('Are you sure you want to delete # %s?', $userAccess['UserAccess']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Accesses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Access'), array('action' => 'add')); ?> </li>
	</ul>
</div><div class="userAccesses view">
<h2><?php echo __('User Access'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userAccess['UserAccess']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($userAccess['UserAccess']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($userAccess['UserAccess']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated Date'); ?></dt>
		<dd>
			<?php echo h($userAccess['UserAccess']['updated_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($userAccess['UserAccess']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated By'); ?></dt>
		<dd>
			<?php echo h($userAccess['UserAccess']['updated_by']); ?>
			&nbsp;
		</dd>
	</dl>
</div>