<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('Edit Remark'), array('action' => 'edit', $remark['Remark']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete Remark'), array('action' => 'delete', $remark['Remark']['id']),array('class' => 'btn btn-primary'), array(), __('Are you sure you want to delete # %s?', $remark['Remark']['id'])); ?>
<?php echo $this->Html->link(__('List Remarks'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Remark'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Enquiries'), array('controller' => 'enquiries', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Enquiry'), array('controller' => 'enquiries', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<h2><?php echo __('Remark'); ?></h2>
<dl>
<dt><?php echo __('Id'); ?></dt>
<dd>
<?php echo h($remark['Remark']['id']); ?>
&nbsp;
</dd>
<dt><?php echo __('Enquiry'); ?></dt>
<dd>
<?php echo $this->Html->link($remark['Enquiry']['name'], array('controller' => 'enquiries', 'action' => 'view', $remark['Enquiry']['id'])); ?>
&nbsp;
</dd>
<dt><?php echo __('Name'); ?></dt>
<dd>
<?php echo h($remark['Remark']['name']); ?>
&nbsp;
</dd>
<dt><?php echo __('Posted Date'); ?></dt>
<dd>
<?php echo h($remark['Remark']['posted_date']); ?>
&nbsp;
</dd>
<dt><?php echo __('FeedBy'); ?></dt>
<dd>
<?php echo h($remark['Remark']['feedBy']); ?>
&nbsp;
</dd>
</dl>
</div>
</div>