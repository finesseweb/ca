<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('New Manage Otp'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div><div class="manageOtps index">
<h2><?php echo __('Manage Otp'); ?></h2>
<div class="table-responsive">
<table class="table table-hover table-condensed">
<tr>
<th><?php echo $this->Paginator->sort('id'); ?></th>
<th><?php echo $this->Paginator->sort('name'); ?></th>
<th><?php echo $this->Paginator->sort('otp'); ?></th>
<th><?php echo $this->Paginator->sort('otptime'); ?></th>
<th><?php echo $this->Paginator->sort('ip'); ?></th>
<?php /*?><th class="actions"><?php echo __('Actions'); ?></th><?php */?>
</tr>
<?php foreach ($manageOtps as $manageOtp): ?>
<tr>
<td><?php echo h($manageOtp['ManageOtp']['id']); ?>&nbsp;</td>
<td><?php echo h($manageOtp['ManageOtp']['name']); ?>&nbsp;</td>
<td><?php echo h($manageOtp['ManageOtp']['otp']); ?>&nbsp;</td>
<td><?php echo h($manageOtp['ManageOtp']['otptime']); ?>&nbsp;</td>
<td><?php echo h($manageOtp['ManageOtp']['ip']); ?>&nbsp;</td>
<?php /*?><td class="actions">
<?php echo $this->Html->link(__('View'), array('action' => 'view', $manageOtp['ManageOtp']['id'])); ?>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $manageOtp['ManageOtp']['id'])); ?>
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $manageOtp['ManageOtp']['id']), null, __('Are you sure you want to delete # %s?', $manageOtp['ManageOtp']['id'])); ?>
</td><?php */?>
</tr>
<?php endforeach; ?>
</table>
</div>
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