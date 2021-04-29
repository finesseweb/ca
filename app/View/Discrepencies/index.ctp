<div class="discrepencies index">
	<h2><?php echo __('Discrepencies'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('enquiry_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('comment'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('posted'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($discrepencies as $discrepency): ?>
	<tr>
		<td><?php echo h($discrepency['Discrepency']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($discrepency['Enquiry']['name'], array('controller' => 'enquiries', 'action' => 'view', $discrepency['Enquiry']['id'])); ?>
		</td>
		<td><?php echo h($discrepency['User']['name']); ?>&nbsp;</td>
		<td><?php echo h($discrepency['Discrepency']['comment']); ?>&nbsp;</td>
		<td><?php echo h($discrepency['Discrepency']['status']); ?>&nbsp;</td>
		<td><?php echo h($discrepency['Discrepency']['posted']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $discrepency['Discrepency']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $discrepency['Discrepency']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $discrepency['Discrepency']['id']), null, __('Are you sure you want to delete # %s?', $discrepency['Discrepency']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Discrepency'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Enquiries'), array('controller' => 'enquiries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Enquiry'), array('controller' => 'enquiries', 'action' => 'add')); ?> </li>
	</ul>
</div>
