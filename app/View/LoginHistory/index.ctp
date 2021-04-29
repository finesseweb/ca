<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('Users'), array('controller' => 'users','action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>
</div><div class="loginHistory index">
<h2><?php echo __('Login History'); ?></h2>

<?php echo $this->Form->create('LoginHistory'); ?>
<div class="table-responsive"><table class="table table-striped">
<tr>
<th><?php echo $this->Paginator->sort('id'); ?></th>
<th><?php echo $this->Paginator->sort('User Name'); ?></th>
<th><?php echo $this->Paginator->sort('Role'); ?></th>
<th><?php echo $this->Paginator->sort('Type'); ?></th>
<th><?php echo $this->Paginator->sort('Logged In');?></th>
<th><?php echo $this->Paginator->sort('Logged Out');?></th>
<th><?php echo $this->Paginator->sort('IP');?></th>
</tr>
<?php foreach ($loginHistory as $loginhistory): ?>
<tr>
<td><?php echo h($loginhistory['LoginHistory']['id']); ?>&nbsp;</td>
<td><?php echo h($loginhistory['User']['username']); ?>&nbsp;</td>
<td><?php echo h($loginhistory['User']['role']); ?>&nbsp;</td>
<td><?php echo h($loginhistory['User']['type']); ?>&nbsp;</td>
<td><?php echo h(date("l jS \of F Y h:i:s A",strtotime($loginhistory['LoginHistory']['in_time']))); ?>&nbsp;</td>
<td><?php echo h(date('d-m-Y h:i:s',strtotime($loginhistory['LoginHistory']['out_time']))); ?>&nbsp;</td>
<td><?php echo h($loginhistory['LoginHistory']['ip_address']); ?>&nbsp;</td>

<?php /*?><td class="actions">
<?php echo $this->Html->link(__('View'), array('action' => 'view', $loginhistory['LoginHistory']['id'])); ?>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $loginhistory['LoginHistory']['id'])); ?>
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $loginhistory['LoginHistory']['id']), null, __('Are you sure you want to delete # %s?', $loginhistory['LoginHistory']['id'])); ?>
</td><?php */?>
</tr>
<?php endforeach; ?>
</table>
<p>
<?php
echo $this->Paginator->counter(array(
'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
));
?>	</p>
<div class="paging">
<?php
echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
echo $this->Paginator->numbers(array('separator' => ''));
echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
?>
</div>
</div>
</div>