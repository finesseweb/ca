<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('Edit Mailer Feed'), array('action' => 'edit', $mailerFeed['MailerFeed']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete Mailer Feed'), array('action' => 'delete', $mailerFeed['MailerFeed']['id']),array('class' => 'btn btn-primary'), null, __('Are you sure you want to delete # %s?', $mailerFeed['MailerFeed']['id'])); ?>
<?php echo $this->Html->link(__('List Mailer Feeds'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Mailer Feed'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<h2><?php echo __('Mailer Feed'); ?></h2>
<dl>
<dt><?php echo __('Id'); ?></dt>
<dd>
<?php echo h($mailerFeed['MailerFeed']['id']); ?>
&nbsp;
</dd>
<dt><?php echo __('Builder'); ?></dt>
<dd>
<?php echo h($mailerFeed['MailerFeed']['builder']); ?>
&nbsp;
</dd>
<dt><?php echo __('Project'); ?></dt>
<dd>
<?php echo h($mailerFeed['MailerFeed']['project']); ?>
&nbsp;
</dd>
<dt><?php echo __('Total Data'); ?></dt>
<dd>
<?php echo h($mailerFeed['MailerFeed']['total_data']); ?>
&nbsp;
</dd>
<dt><?php echo __('Type Of Data'); ?></dt>
<dd>
<?php echo h($mailerFeed['MailerFeed']['type_of_data']); ?>
&nbsp;
</dd>
<dt><?php echo __('If No Any Mailer'); ?></dt>
<dd>
<?php echo h($mailerFeed['MailerFeed']['if_no_any_mailer']); ?>
&nbsp;
</dd>
<dt><?php echo __('Status'); ?></dt>
<dd>
<?php echo h($mailerFeed['MailerFeed']['status']); ?>
&nbsp;
</dd>
<dt><?php echo __('Posted'); ?></dt>
<dd>
<?php echo h($mailerFeed['MailerFeed']['posted']); ?>
&nbsp;
</dd>
</dl>
</div>
</div>