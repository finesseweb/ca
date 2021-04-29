<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('Edit Ngo name'), array('action' => 'edit', $designation['Ngoname']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete Ngo name'), array('action' => 'delete', $designation['Ngoname']['id']),array('class' => 'btn btn-primary'), null, __('Are you sure you want to delete # %s?', $designation['Ngoname']['id'])); ?>
<?php echo $this->Html->link(__('List Ngo names'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>

</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<h2><?php echo __('Ngoname'); ?></h2>
<!--<dl>
<dt><?php echo __('Id'); ?></dt>
<dd>
<?php echo h($designation['Ngoname']['id']); ?>
&nbsp;
</dd>-->
<dt><?php echo __('Name'); ?></dt>
<dd>
<?php echo h(ucfirst($designation['Ngoname']['name'])); ?>
&nbsp;
</dd>
</dl>
</div>
</div>

