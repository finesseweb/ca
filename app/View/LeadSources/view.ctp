<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('Edit Lead Source'), array('action' => 'edit', $leadSource['LeadSource']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete Lead Source'), array('action' => 'delete', $leadSource['LeadSource']['id']),array('class' => 'btn btn-primary'), null, __('Are you sure you want to delete # %s?', $leadSource['LeadSource']['id'])); ?>
<?php echo $this->Html->link(__('List Lead Sources'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<h2><?php echo __('Lead Source'); ?></h2>
<dl>
<dt><?php echo __('Id'); ?></dt>
<dd>
<?php echo h($leadSource['LeadSource']['id']); ?>
&nbsp;
</dd>
<dt><?php echo __('Name'); ?></dt>
<dd>
<?php echo h($leadSource['LeadSource']['name']); ?>
&nbsp;
</dd>
<dt><?php echo __('Flag'); ?></dt>
<dd>
<?php echo h($leadSource['LeadSource']['flag']); ?>
&nbsp;
</dd>
<dt><?php echo __('Status'); ?></dt>
<dd>
<?php echo h($leadSource['LeadSource']['status']); ?>
&nbsp;
</dd>
<dt><?php echo __('Type'); ?></dt>
<dd>
<?php echo h($leadSource['LeadSource']['type']); ?>
&nbsp;
</dd>
</dl>
</div>
</div>