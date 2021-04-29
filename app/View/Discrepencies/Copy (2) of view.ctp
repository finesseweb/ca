<div class="discrepencies view">
<h2><?php echo __('Discrepency'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($discrepency['Discrepency']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Enquiry'); ?></dt>
		<dd>
			<?php echo $this->Html->link($discrepency['Enquiry']['name'], array('controller' => 'enquiries', 'action' => 'view', $discrepency['Enquiry']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php echo h($discrepency['Discrepency']['user_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo h($discrepency['Discrepency']['comment']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($discrepency['Discrepency']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Posted'); ?></dt>
		<dd>
			<?php echo h($discrepency['Discrepency']['posted']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Discrepency'), array('action' => 'edit', $discrepency['Discrepency']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Discrepency'), array('action' => 'delete', $discrepency['Discrepency']['id']), null, __('Are you sure you want to delete # %s?', $discrepency['Discrepency']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Discrepencies'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Discrepency'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Enquiries'), array('controller' => 'enquiries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Enquiry'), array('controller' => 'enquiries', 'action' => 'add')); ?> </li>
	</ul>
</div>
