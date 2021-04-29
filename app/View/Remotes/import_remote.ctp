	<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Remotes'), array('action' => 'index')); ?></li>
	</ul>
</div><div class="remotes form">
<?php echo $this->Form->create('Remote',array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Import Remote Data'); ?></legend>
	<table>
    <tr><td><input type="file" name="file" /></td></tr>

<tr><td><?php echo $this->Form->end(__('Submit')); ?></td></tr>
	</fieldset>
</table>
</div>

