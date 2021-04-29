<div class="moreCustomerFeeds view">
<h2><?php echo __('More Customer Feed'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($moreCustomerFeed['MoreCustomerFeed']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Project'); ?></dt>
		<dd>
			<?php echo h($moreCustomerFeed['MoreCustomerFeed']['project']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sector'); ?></dt>
		<dd>
			<?php echo h($moreCustomerFeed['MoreCustomerFeed']['sector']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Location'); ?></dt>
		<dd>
			<?php echo h($moreCustomerFeed['MoreCustomerFeed']['location']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Projecttype'); ?></dt>
		<dd>
			<?php echo h($moreCustomerFeed['MoreCustomerFeed']['projecttype']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Area'); ?></dt>
		<dd>
			<?php echo h($moreCustomerFeed['MoreCustomerFeed']['area']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bhk'); ?></dt>
		<dd>
			<?php echo h($moreCustomerFeed['MoreCustomerFeed']['bhk']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tower'); ?></dt>
		<dd>
			<?php echo h($moreCustomerFeed['MoreCustomerFeed']['tower']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Floor'); ?></dt>
		<dd>
			<?php echo h($moreCustomerFeed['MoreCustomerFeed']['floor']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Plc'); ?></dt>
		<dd>
			<?php echo h($moreCustomerFeed['MoreCustomerFeed']['plc']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rate'); ?></dt>
		<dd>
			<?php echo h($moreCustomerFeed['MoreCustomerFeed']['rate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Demand'); ?></dt>
		<dd>
			<?php echo h($moreCustomerFeed['MoreCustomerFeed']['demand']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Paid'); ?></dt>
		<dd>
			<?php echo h($moreCustomerFeed['MoreCustomerFeed']['paid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Customer Feedback'); ?></dt>
		<dd>
			<?php echo $this->Html->link($moreCustomerFeed['CustomerFeedback']['name'], array('controller' => 'customer_feedbacks', 'action' => 'view', $moreCustomerFeed['CustomerFeedback']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit More Customer Feed'), array('action' => 'edit', $moreCustomerFeed['MoreCustomerFeed']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete More Customer Feed'), array('action' => 'delete', $moreCustomerFeed['MoreCustomerFeed']['id']), null, __('Are you sure you want to delete # %s?', $moreCustomerFeed['MoreCustomerFeed']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List More Customer Feeds'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New More Customer Feed'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Customer Feedbacks'), array('controller' => 'customer_feedbacks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Customer Feedback'), array('controller' => 'customer_feedbacks', 'action' => 'add')); ?> </li>
	</ul>
</div>
