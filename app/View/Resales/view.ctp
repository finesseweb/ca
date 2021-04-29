<?php /*?><div class="resales view">
<h2><?php echo __('Resale'); ?></h2><?php */?>
<table> <tr>
		<td><?php echo __('Id'); ?></td>
		<td>
			<?php echo h($resale['Resale']['id']); ?>
			&nbsp;
		</td></tr>
        <tr>
        <?php if(CakeSession::read('User.type')==='regular' and CakeSession::read('User.id')===$resale['Resale']['user_id']) { ?>
		<td><?php echo __('Email'); ?></td><td>
			<?php echo h($resale['Resale']['email']); ?>
			&nbsp;
		</td></tr>
	<tr>
		<td><?php echo __('Email2'); ?></td><td>
			<?php echo h($resale['Resale']['email2']); ?>
			&nbsp;
		</td></tr>
        
        <tr>
		<td><?php echo __('contact'); ?></td><td>
			<?php echo h($resale['Resale']['email2']); ?>
			&nbsp;
		</td></tr>
        <? } ?>

		<tr><td><?php echo __('Builder'); ?></td><td>
			<?php echo h($resale['Builder']['name']); ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Project'); ?></td><td>
			<?php echo h($resale['Project']['name']); ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Executive'); ?></td><td>
			<?php echo h($resale['User']['name']); ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Refer Executive Name'); ?></td><td>
			<?php echo h($resale['Resale']['refer_to']); ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Second Name'); ?></td><td>
			<?php echo h($resale['Resale']['second_name']); ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Unit Type'); ?></td><td>
			<?php echo h($resale['Resale']['unit_type']); ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Unit No'); ?></td><td>
			<?php echo h($resale['Resale']['unit_no']); ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Tower'); ?></td><td>
			<?php echo h($resale['Resale']['tower']); ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Area'); ?></td><td>
			<?php echo h($resale['Resale']['area']); ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Floor'); ?></td><td>
			<?php echo h($resale['Resale']['floor']); ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Booking'); ?></td><td>
			<?php echo h($resale['Resale']['booking']); ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Demand'); ?></td><td>
			<?php echo h($resale['Resale']['demand']); ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Plc'); ?></td><td>
			<?php echo h($resale['Resale']['plc']); ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Paid'); ?></td><td>
			<?php echo h($resale['Resale']['paid']); ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Budget'); ?></td><td>
			<?php echo h($resale['Resale']['budget']); ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Property Type'); ?></td><td>
			<?php echo h($resale['PropertyType']['name']); ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Sub Type'); ?></td><td>
			<?php echo h($resale['Resale']['sub_type']); ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Country'); ?></td><td>
			<?php echo h($resale['Country']['name']); ?>
			&nbsp;
		</td></tr>
		<? if($resale['Resale']['status']=='close') { ?><tr><td><?php echo __('Close Reason'); ?></td><td>
			<?php echo h($resale['CloseReason']['name']); ?>
			&nbsp;
		</td></tr><? } ?>
		<tr><td><?php echo __('Status'); ?></td>		<td>
			<?php echo h($resale['Resale']['status']); ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Lead Source'); ?></td><td>
			<?php echo h($resale['LeadSource']['name']); ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Sector'); ?></td><td>
			<?php echo h($resale['Sector']['name']); ?>
			&nbsp;
		</td></tr>
		<tr><td><?php echo __('Sector Other'); ?></td><td>
			<?php echo h($resale['Resale']['sector_other']); ?>
			&nbsp;
		</td></tr>
	</table>

<?php /*?></div><div class="actions">
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
</div><?php */?>
<script> //$("table tr:odd").css("background-color","#fefbfd");</script>