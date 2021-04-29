<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Remote'), array('action' => 'edit', $remote['Remote']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Remote'), array('action' => 'delete', $remote['Remote']['id']), null, __('Are you sure you want to delete # %s?', $remote['Remote']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Remotes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Remote'), array('action' => 'add')); ?> </li>
	</ul>
</div><div class="remotes view">
<h2><?php echo __('Remote'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($remote['Remote']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Website'); ?></dt>
		<dd>
			<?php echo h($remote['Remote']['website']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Project Name'); ?></dt>
		<dd>
			<?php echo h($remote['Remote']['project_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Client'); ?></dt>
		<dd>
			<?php echo h($remote['Remote']['client']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
			<?php echo h($remote['Remote']['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($remote['Remote']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country'); ?></dt>
		<dd>
			<?php echo h($remote['Remote']['country']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Posted On'); ?></dt>
		<dd>
			<?php echo h($remote['Remote']['posted_on']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Message'); ?></dt>
		<dd>
			<?php echo h($remote['Remote']['message']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Enquiry Id'); ?></dt>
		<dd>
			<?php echo h($remote['Remote']['enquiry_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>