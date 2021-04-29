<?php /*?><div class="moreCustomerFeeds view"><?php */?>
<?php /*?><h2><?php echo __('More Details'); ?></h2><?php */?>
	<table class="table table-hover table-condensed"><tr>
		<td><?php echo __('Id'); ?></td>
		<td>
			<?php echo h($moreCustomerFeed['MoreCustomerFeed']['id']); ?>
			&nbsp;
		</td>
        </tr><tr>
		<td><?php echo __('Project'); ?></td>
		<td>
			<?php echo h($moreCustomerFeed['MoreCustomerFeed']['project']); ?>
			&nbsp;
		</td> </tr><tr>
		<td><?php echo __('Sector'); ?></td>
		<td>
			<?php echo h($moreCustomerFeed['MoreCustomerFeed']['sector']); ?>
			&nbsp;
		</td> </tr><tr>
		<td><?php echo __('Location'); ?></td>
		<td>
			<?php echo h($moreCustomerFeed['MoreCustomerFeed']['location']); ?>
			&nbsp;
		</td> </tr><tr>
		<td><?php echo __('Projecttype'); ?></td>
		<td>
			<?php echo h($moreCustomerFeed['MoreCustomerFeed']['projecttype']); ?>
			&nbsp;
		</td> </tr><tr>
		<td><?php echo __('Area'); ?></td>
		<td>
			<?php echo h($moreCustomerFeed['MoreCustomerFeed']['area']); ?>
			&nbsp;
		</td> </tr><tr>
		<td><?php echo __('Bhk'); ?></td>
		<td>
			<?php echo h($moreCustomerFeed['MoreCustomerFeed']['bhk']); ?>
			&nbsp;
		</td> </tr><tr>
		<td><?php echo __('Tower'); ?></td>
		<td>
			<?php echo h($moreCustomerFeed['MoreCustomerFeed']['tower']); ?>
			&nbsp;
		</td> </tr><tr>
		<td><?php echo __('Floor'); ?></td>
		<td>
			<?php echo h($moreCustomerFeed['MoreCustomerFeed']['floor']); ?>
			&nbsp;
		</td> </tr><tr>
		<td><?php echo __('Plc'); ?></td>
		<td>
			<?php echo h($moreCustomerFeed['MoreCustomerFeed']['plc']); ?>
			&nbsp;
		</td> </tr><tr>
		<td><?php echo __('Rate'); ?></td>
		<td>
			<?php echo h($moreCustomerFeed['MoreCustomerFeed']['rate']); ?>
			&nbsp;
		</td> </tr><tr>
		<td><?php echo __('Demand'); ?></td>
		<td>
			<?php echo h($moreCustomerFeed['MoreCustomerFeed']['demand']); ?>
			&nbsp;
		</td> </tr><tr>
		<td><?php echo __('Paid'); ?></td>
		<td>
			<?php echo h($moreCustomerFeed['MoreCustomerFeed']['paid']); ?>
			&nbsp;
		</td> </tr><tr>
		<td><?php echo __('Customer'); ?></td>
		<td>
			<?php echo h($moreCustomerFeed['CustomerFeedback']['name']); ?>
			&nbsp;
		</td> </tr>
	</table>
<?php /*?></div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit More Customer Feed'), array('action' => 'edit', $moreCustomerFeed['MoreCustomerFeed']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete More Customer Feed'), array('action' => 'delete', $moreCustomerFeed['MoreCustomerFeed']['id']), null, __('Are you sure you want to delete # %s?', $moreCustomerFeed['MoreCustomerFeed']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List More Customer Feeds'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New More Customer Feed'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Broker Feeds'), array('controller' => 'broker_feeds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Broker Feed'), array('controller' => 'broker_feeds', 'action' => 'add')); ?> </li>
	</ul>
</div><?php */?>
