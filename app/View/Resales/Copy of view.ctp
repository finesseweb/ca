<div class="resales view">
<h2><?php echo __('Resale'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($resale['Resale']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($resale['Resale']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($resale['Resale']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email2'); ?></dt>
		<dd>
			<?php echo h($resale['Resale']['email2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contact'); ?></dt>
		<dd>
			<?php echo h($resale['Resale']['contact']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Client Type'); ?></dt>
		<dd>
			<?php echo h($resale['Resale']['client_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Resale Type'); ?></dt>
		<dd>
			<?php echo h($resale['Resale']['resale_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Builder'); ?></dt>
		<dd>
			<?php echo $this->Html->link($resale['Builder']['name'], array('controller' => 'builders', 'action' => 'view', $resale['Builder']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Project'); ?></dt>
		<dd>
			<?php echo $this->Html->link($resale['Project']['name'], array('controller' => 'projects', 'action' => 'view', $resale['Project']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($resale['User']['name'], array('controller' => 'users', 'action' => 'view', $resale['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Refer To'); ?></dt>
		<dd>
			<?php echo h($resale['Resale']['refer_to']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Second Name'); ?></dt>
		<dd>
			<?php echo h($resale['Resale']['second_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Unit Type'); ?></dt>
		<dd>
			<?php echo h($resale['Resale']['unit_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Unit No'); ?></dt>
		<dd>
			<?php echo h($resale['Resale']['unit_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tower'); ?></dt>
		<dd>
			<?php echo h($resale['Resale']['tower']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Area'); ?></dt>
		<dd>
			<?php echo h($resale['Resale']['area']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Floor'); ?></dt>
		<dd>
			<?php echo h($resale['Resale']['floor']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Booking'); ?></dt>
		<dd>
			<?php echo h($resale['Resale']['booking']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Demand'); ?></dt>
		<dd>
			<?php echo h($resale['Resale']['demand']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Plc'); ?></dt>
		<dd>
			<?php echo h($resale['Resale']['plc']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Paid'); ?></dt>
		<dd>
			<?php echo h($resale['Resale']['paid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Budget'); ?></dt>
		<dd>
			<?php echo h($resale['Resale']['budget']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Property Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($resale['PropertyType']['name'], array('controller' => 'property_types', 'action' => 'view', $resale['PropertyType']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sub Type'); ?></dt>
		<dd>
			<?php echo h($resale['Resale']['sub_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country'); ?></dt>
		<dd>
			<?php echo $this->Html->link($resale['Country']['name'], array('controller' => 'countries', 'action' => 'view', $resale['Country']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Close Reason'); ?></dt>
		<dd>
			<?php echo $this->Html->link($resale['CloseReason']['name'], array('controller' => 'close_reasons', 'action' => 'view', $resale['CloseReason']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($resale['Resale']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lead Source'); ?></dt>
		<dd>
			<?php echo $this->Html->link($resale['LeadSource']['name'], array('controller' => 'lead_sources', 'action' => 'view', $resale['LeadSource']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sector'); ?></dt>
		<dd>
			<?php echo $this->Html->link($resale['Sector']['name'], array('controller' => 'sectors', 'action' => 'view', $resale['Sector']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sector Other'); ?></dt>
		<dd>
			<?php echo h($resale['Resale']['sector_other']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Resale'), array('action' => 'edit', $resale['Resale']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Resale'), array('action' => 'delete', $resale['Resale']['id']), null, __('Are you sure you want to delete # %s?', $resale['Resale']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Resales'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Resale'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Builders'), array('controller' => 'builders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Builder'), array('controller' => 'builders', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Projects'), array('controller' => 'projects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Property Types'), array('controller' => 'property_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Property Type'), array('controller' => 'property_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Close Reasons'), array('controller' => 'close_reasons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Close Reason'), array('controller' => 'close_reasons', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lead Sources'), array('controller' => 'lead_sources', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lead Source'), array('controller' => 'lead_sources', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sectors'), array('controller' => 'sectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sector'), array('controller' => 'sectors', 'action' => 'add')); ?> </li>
	</ul>
</div>
