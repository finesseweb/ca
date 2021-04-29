<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('Edit Project'), array('action' => 'edit', $project['Project']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete Project'), array('action' => 'delete', $project['Project']['id']),array('class' => 'btn btn-primary'), array(), __('Are you sure you want to delete # %s?', $project['Project']['id'])); ?>
<?php echo $this->Html->link(__('List Projects'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Project'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Builders'), array('controller' => 'builders', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Builder'), array('controller' => 'builders', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List States'), array('controller' => 'states', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New State'), array('controller' => 'states', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Enquiries'), array('controller' => 'enquiries', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Enquiry'), array('controller' => 'enquiries', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<h2><?php echo __('Project'); ?></h2>
<dl>
<dt><?php echo __('Id'); ?></dt>
<dd>
<?php echo h($project['Project']['id']); ?>
&nbsp;
</dd>
<dt><?php echo __('Builder'); ?></dt>
<dd>
<?php echo $this->Html->link($project['Builder']['name'], array('controller' => 'builders', 'action' => 'view', $project['Builder']['id'])); ?>
&nbsp;
</dd>
<dt><?php echo __('State'); ?></dt>
<dd>
<?php echo $this->Html->link($project['State']['name'], array('controller' => 'states', 'action' => 'view', $project['State']['id'])); ?>
&nbsp;
</dd>
<dt><?php echo __('City'); ?></dt>
<dd>
<?php echo $this->Html->link($project['City']['name'], array('controller' => 'cities', 'action' => 'view', $project['City']['id'])); ?>
&nbsp;
</dd>
<dt><?php echo __('Name'); ?></dt>
<dd>
<?php echo h($project['Project']['name']); ?>
&nbsp;
</dd>
<dt><?php echo __('Title'); ?></dt>
<dd>
<?php echo h($project['Project']['title']); ?>
&nbsp;
</dd>
<dt><?php echo __('Type'); ?></dt>
<dd>
<?php echo h($project['Project']['property_type_id']); ?>
&nbsp;
</dd>
<dt><?php echo __('Status'); ?></dt>
<dd>
<?php echo h($project['Project']['status']); ?>
&nbsp;
</dd>
<dt><?php echo __('Posted Date'); ?></dt>
<dd>
<?php echo h($project['Project']['posted_date']); ?>
&nbsp;
</dd>
<dt><?php echo __('Updated Date'); ?></dt>
<dd>
<?php echo h($project['Project']['updated_date']); ?>
&nbsp;
</dd>
</dl>
</div>
</div>
<?php /*?><div class="related">
<h3><?php echo __('Related Enquiries'); ?></h3>
<?php if (!empty($project['Enquiry'])): ?>
<table cellpadding = "0" cellspacing = "0">
<tr>
<th><?php echo __('Id'); ?></th>
<th><?php echo __('User Id'); ?></th>
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
<th><?php echo __('Is Reminder'); ?></th>
<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
<?php foreach ($project['Enquiry'] as $enquiry): ?>
<tr>
<td><?php echo $enquiry['id']; ?></td>
<td><?php echo $enquiry['user_id']; ?></td>
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
<td><?php echo $enquiry['is_reminder']; ?></td>

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
</div><?php */?>
