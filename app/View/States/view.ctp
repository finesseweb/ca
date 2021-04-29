<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('Edit State'), array('action' => 'edit', $state['State']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete State'), array('action' => 'delete', $state['State']['id']),array('class' => 'btn btn-primary'), array(), __('Are you sure you want to delete # %s?', $state['State']['id'])); ?>
<?php echo $this->Html->link(__('List States'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New State'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Enquiries'), array('controller' => 'enquiries', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Enquiry'), array('controller' => 'enquiries', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Projects'), array('controller' => 'projects', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<h2><?php echo __('State'); ?></h2>
<!--<dl>
<dt><?php echo __('Id'); ?></dt>
<dd>
<?php echo h($state['State']['id']); ?>
&nbsp;
</dd>-->
<dt><?php echo __('State Name'); ?></dt>
<dd>
<?php echo h(ucfirst($state['State']['name'])); ?>
&nbsp;
</dd>
<dt><?php echo __('Country'); ?></dt>
<dd>
<?php echo $this->Html->link(ucfirst($state['Country']['name']), array('controller' => 'countries', 'action' => 'view', $state['Country']['id'])); ?>
&nbsp;
</dd>
</dl>
</div>
</div>
<?php /*?><div class="related">
<h3><?php echo __('Related Cities'); ?></h3>
<?php if (!empty($state['City'])): ?>
<table cellpadding = "0" cellspacing = "0">
<tr>
<th><?php echo __('Id'); ?></th>
<th><?php echo __('Name'); ?></th>
<th><?php echo __('State Id'); ?></th>
<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
<?php foreach ($state['City'] as $city): ?>
<tr>
<td><?php echo $city['id']; ?></td>
<td><?php echo $city['name']; ?></td>
<td><?php echo $city['state_id']; ?></td>
<td class="actions">
<?php echo $this->Html->link(__('View'), array('controller' => 'cities', 'action' => 'view', $city['id'])); ?>
<?php echo $this->Html->link(__('Edit'), array('controller' => 'cities', 'action' => 'edit', $city['id'])); ?>
<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'cities', 'action' => 'delete', $city['id']), array(), __('Are you sure you want to delete # %s?', $city['id'])); ?>
</td>
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>

<div class="actions">
<ul>
<li><?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add')); ?> </li>
</ul>
</div>
</div>
<div class="related">
<h3><?php echo __('Related Enquiries'); ?></h3>
<?php if (!empty($state['Enquiry'])): ?>
<table cellpadding = "0" cellspacing = "0">
<tr>
<th><?php echo __('Id'); ?></th>
<th><?php echo __('User Id'); ?></th>
<th><?php echo __('Group Id'); ?></th>
<th><?php echo __('Posted Date'); ?></th>
<th><?php echo __('Name'); ?></th>
<th><?php echo __('Email'); ?></th>
<th><?php echo __('Contact'); ?></th>
<th><?php echo __('Project Id'); ?></th>
<th><?php echo __('Query'); ?></th>
<th><?php echo __('Builder Id'); ?></th>
<th><?php echo __('Country Id'); ?></th>
<th><?php echo __('State Id'); ?></th>
<th><?php echo __('City Id'); ?></th>
<th><?php echo __('Fwdby'); ?></th>
<th><?php echo __('Fwd Date'); ?></th>
<th><?php echo __('Status'); ?></th>
<th><?php echo __('Close Reason Id'); ?></th>
<th><?php echo __('Is Reminder'); ?></th>
<th><?php echo __('Reminder Date'); ?></th>
<th><?php echo __('Updated Date'); ?></th>
<th><?php echo __('UpdateBy'); ?></th>
<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
<?php foreach ($state['Enquiry'] as $enquiry): ?>
<tr>
<td><?php echo $enquiry['id']; ?></td>
<td><?php echo $enquiry['user_id']; ?></td>
<td><?php echo $enquiry['group_id']; ?></td>
<td><?php echo $enquiry['posted_date']; ?></td>
<td><?php echo $enquiry['name']; ?></td>
<td><?php echo $enquiry['email']; ?></td>
<td><?php echo $enquiry['contact']; ?></td>
<td><?php echo $enquiry['project_id']; ?></td>
<td><?php echo $enquiry['query']; ?></td>
<td><?php echo $enquiry['builder_id']; ?></td>
<td><?php echo $enquiry['country_id']; ?></td>
<td><?php echo $enquiry['state_id']; ?></td>
<td><?php echo $enquiry['city_id']; ?></td>
<td><?php echo $enquiry['fwdby']; ?></td>
<td><?php echo $enquiry['fwd_date']; ?></td>
<td><?php echo $enquiry['status']; ?></td>
<td><?php echo $enquiry['close_reason_id']; ?></td>
<td><?php echo $enquiry['is_reminder']; ?></td>
<td><?php echo $enquiry['reminder_date']; ?></td>
<td><?php echo $enquiry['updated_date']; ?></td>
<td><?php echo $enquiry['updateBy']; ?></td>
<td class="actions">
<?php echo $this->Html->link(__('View'), array('controller' => 'enquiries', 'action' => 'view', $enquiry['id'])); ?>
<?php echo $this->Html->link(__('Edit'), array('controller' => 'enquiries', 'action' => 'edit', $enquiry['id'])); ?>
<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'enquiries', 'action' => 'delete', $enquiry['id']), array(), __('Are you sure you want to delete # %s?', $enquiry['id'])); ?>
</td>
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>

<div class="actions">
<ul>
<li><?php echo $this->Html->link(__('New Enquiry'), array('controller' => 'enquiries', 'action' => 'add')); ?> </li>
</ul>
</div>
</div>
<div class="related">
<h3><?php echo __('Related Projects'); ?></h3>
<?php if (!empty($state['Project'])): ?>
<table cellpadding = "0" cellspacing = "0">
<tr>
<th><?php echo __('Id'); ?></th>
<th><?php echo __('Bulider Id'); ?></th>
<th><?php echo __('State Id'); ?></th>
<th><?php echo __('City Id'); ?></th>
<th><?php echo __('Name'); ?></th>
<th><?php echo __('Title'); ?></th>
<th><?php echo __('Type'); ?></th>
<th><?php echo __('Status'); ?></th>
<th><?php echo __('Posted Date'); ?></th>
<th><?php echo __('Updated Date'); ?></th>
<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
<?php foreach ($state['Project'] as $project): ?>
<tr>
<td><?php echo $project['id']; ?></td>
<td><?php echo $project['builder_id']; ?></td>
<td><?php echo $project['state_id']; ?></td>
<td><?php echo $project['city_id']; ?></td>
<td><?php echo $project['name']; ?></td>
<td><?php echo $project['title']; ?></td>
<td><?php echo $project['type']; ?></td>
<td><?php echo $project['status']; ?></td>
<td><?php echo $project['posted_date']; ?></td>
<td><?php echo $project['updated_date']; ?></td>
<td class="actions">
<?php echo $this->Html->link(__('View'), array('controller' => 'projects', 'action' => 'view', $project['id'])); ?>
<?php echo $this->Html->link(__('Edit'), array('controller' => 'projects', 'action' => 'edit', $project['id'])); ?>
<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'projects', 'action' => 'delete', $project['id']), array(), __('Are you sure you want to delete # %s?', $project['id'])); ?>
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
</div><?php */?>
