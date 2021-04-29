<div class="actions">
<h3><?php echo __('Mailer Feeds'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('New Mailer Feed'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="table-responsive">
<?php /*?><h2><?php echo __('Mailer Feeds'); ?></h2><?php */?>
<table class="table table-hover table-condensed">
<tr>
<th><?php echo $this->Paginator->sort('id'); ?></th>
<th><?php echo $this->Paginator->sort('builder'); ?></th>
<th><?php echo $this->Paginator->sort('project'); ?></th>
<th><?php echo $this->Paginator->sort('total_data'); ?></th>
<th><?php echo $this->Paginator->sort('type_of_data'); ?></th>
<th><?php echo $this->Paginator->sort('if_no_any_mailer'); ?></th>
<th><?php echo $this->Paginator->sort('status'); ?></th>
<th><?php echo $this->Paginator->sort('posted'); ?></th>
<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
<?php foreach ($mailerFeeds as $mailerFeed): ?>
<tr>
<td><?php echo h($mailerFeed['MailerFeed']['id']); ?>&nbsp;</td>
<td><?php echo h($mailerFeed['MailerFeed']['builder']); ?>&nbsp;</td>
<td><?php echo h($mailerFeed['MailerFeed']['project']); ?>&nbsp;</td>
<td><?php echo h($mailerFeed['MailerFeed']['total_data']); ?>&nbsp;</td>
<td><?php echo h($mailerFeed['MailerFeed']['type_of_data']); ?>&nbsp;</td>
<td><?php echo h($mailerFeed['MailerFeed']['if_no_any_mailer']); ?>&nbsp;</td>
<td><?php echo h($mailerFeed['MailerFeed']['status']); ?>&nbsp;</td>
<td><?php echo h($mailerFeed['MailerFeed']['posted']); ?>&nbsp;</td>
<td class="actions">
<?php echo $this->Html->link(__('View'), array('action' => 'view', $mailerFeed['MailerFeed']['id']),array('class' => 'btn btn-success')); ?>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $mailerFeed['MailerFeed']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $mailerFeed['MailerFeed']['id']),array('class' => 'btn btn-danger'), null, __('Are you sure you want to delete # %s?', $mailerFeed['MailerFeed']['id'])); ?>
</td>
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

