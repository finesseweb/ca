<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('Edit Property Type'), array('action' => 'edit', $propertyType['PropertyType']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete Property Type'), array('action' => 'delete', $propertyType['PropertyType']['id']),array('class' => 'btn btn-primary'), null, __('Are you sure you want to delete # %s?', $propertyType['PropertyType']['id'])); ?>
<?php echo $this->Html->link(__('List Property Types'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Property Type'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Projects'), array('controller' => 'projects', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Resales'), array('controller' => 'resales', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Resale'), array('controller' => 'resales', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<h2><?php echo __('Property Type'); ?></h2>
<dl>
<dt><?php echo __('Id'); ?></dt>
<dd>
<?php echo h($propertyType['PropertyType']['id']); ?>
&nbsp;
</dd>
<dt><?php echo __('Name'); ?></dt>
<dd>
<?php echo h($propertyType['PropertyType']['name']); ?>
&nbsp;
</dd>
</dl>
</div>
</div>
<?php /*?><div class="related">
<h3><?php echo __('Related Projects'); ?></h3>
<?php if (!empty($propertyType['Project'])): ?>
<table cellpadding = "0" cellspacing = "0">
<tr>
<th><?php echo __('Id'); ?></th>
<th><?php echo __('Builder Id'); ?></th>
<th><?php echo __('State Id'); ?></th>
<th><?php echo __('City Id'); ?></th>
<th><?php echo __('Name'); ?></th>
<th><?php echo __('Title'); ?></th>
<th><?php echo __('Property Type Id'); ?></th>
<th><?php echo __('Status'); ?></th>
<th><?php echo __('Posted Date'); ?></th>
<th><?php echo __('Updated Date'); ?></th>
<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
<?php foreach ($propertyType['Project'] as $project): ?>
<tr>
<td><?php echo $project['id']; ?></td>
<td><?php echo $project['builder_id']; ?></td>
<td><?php echo $project['state_id']; ?></td>
<td><?php echo $project['city_id']; ?></td>
<td><?php echo $project['name']; ?></td>
<td><?php echo $project['title']; ?></td>
<td><?php echo $project['property_type_id']; ?></td>
<td><?php echo $project['status']; ?></td>
<td><?php echo $project['posted_date']; ?></td>
<td><?php echo $project['updated_date']; ?></td>
<td class="actions">
<?php echo $this->Html->link(__('View'), array('controller' => 'projects', 'action' => 'view', $project['id'])); ?>
<?php echo $this->Html->link(__('Edit'), array('controller' => 'projects', 'action' => 'edit', $project['id'])); ?>
<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'projects', 'action' => 'delete', $project['id']), null, __('Are you sure you want to delete # %s?', $project['id'])); ?>
</td>
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>

<div class="actions">
<ul>
<li><?php echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add')); ?> </li>
</ul>
</div>
</div>
<div class="related">
<h3><?php echo __('Related Resales'); ?></h3>
<?php if (!empty($propertyType['Resale'])): ?>
<table cellpadding = "0" cellspacing = "0">
<tr>
<th><?php echo __('Id'); ?></th>
<th><?php echo __('Name'); ?></th>
<th><?php echo __('Email'); ?></th>
<th><?php echo __('Email2'); ?></th>
<th><?php echo __('Contact'); ?></th>
<th><?php echo __('Type'); ?></th>
<th><?php echo __('Data Type'); ?></th>
<th><?php echo __('Builder Id'); ?></th>
<th><?php echo __('Project Id'); ?></th>
<th><?php echo __('User Id'); ?></th>
<th><?php echo __('Refer To'); ?></th>
<th><?php echo __('Second Name'); ?></th>
<th><?php echo __('Unit Type'); ?></th>
<th><?php echo __('Unit No'); ?></th>
<th><?php echo __('Tower'); ?></th>
<th><?php echo __('Area'); ?></th>
<th><?php echo __('Floor'); ?></th>
<th><?php echo __('Booking'); ?></th>
<th><?php echo __('Demand'); ?></th>
<th><?php echo __('Plc'); ?></th>
<th><?php echo __('Paid'); ?></th>
<th><?php echo __('Budget'); ?></th>
<th><?php echo __('Property Type Id'); ?></th>
<th><?php echo __('Sub Type'); ?></th>
<th><?php echo __('Country Id'); ?></th>
<th><?php echo __('Close Reason Id'); ?></th>
<th><?php echo __('Status'); ?></th>
<th><?php echo __('Lead Source Id'); ?></th>
<th><?php echo __('Sector Id'); ?></th>
<th><?php echo __('Sector Other'); ?></th>
<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
<?php foreach ($propertyType['Resale'] as $resale): ?>
<tr>
<td><?php echo $resale['id']; ?></td>
<td><?php echo $resale['name']; ?></td>
<td><?php echo $resale['email']; ?></td>
<td><?php echo $resale['email2']; ?></td>
<td><?php echo $resale['contact']; ?></td>
<td><?php echo $resale['type']; ?></td>
<td><?php echo $resale['data_type']; ?></td>
<td><?php echo $resale['builder_id']; ?></td>
<td><?php echo $resale['project_id']; ?></td>
<td><?php echo $resale['user_id']; ?></td>
<td><?php echo $resale['refer_to']; ?></td>
<td><?php echo $resale['second_name']; ?></td>
<td><?php echo $resale['unit_type']; ?></td>
<td><?php echo $resale['unit_no']; ?></td>
<td><?php echo $resale['tower']; ?></td>
<td><?php echo $resale['area']; ?></td>
<td><?php echo $resale['floor']; ?></td>
<td><?php echo $resale['booking']; ?></td>
<td><?php echo $resale['demand']; ?></td>
<td><?php echo $resale['plc']; ?></td>
<td><?php echo $resale['paid']; ?></td>
<td><?php echo $resale['budget']; ?></td>
<td><?php echo $resale['property_type_id']; ?></td>
<td><?php echo $resale['sub_type']; ?></td>
<td><?php echo $resale['country_id']; ?></td>
<td><?php echo $resale['close_reason_id']; ?></td>
<td><?php echo $resale['status']; ?></td>
<td><?php echo $resale['lead_source_id']; ?></td>
<td><?php echo $resale['sector_id']; ?></td>
<td><?php echo $resale['sector_other']; ?></td>
<td class="actions">
<?php echo $this->Html->link(__('View'), array('controller' => 'resales', 'action' => 'view', $resale['id'])); ?>
<?php echo $this->Html->link(__('Edit'), array('controller' => 'resales', 'action' => 'edit', $resale['id'])); ?>
<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'resales', 'action' => 'delete', $resale['id']), null, __('Are you sure you want to delete # %s?', $resale['id'])); ?>
</td>
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>

<div class="actions">
<ul>
<li><?php echo $this->Html->link(__('New Resale'), array('controller' => 'resales', 'action' => 'add')); ?> </li>
</ul>
</div>
</div><?php */?>
