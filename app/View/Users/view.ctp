<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
  <?php   $sessionval=$this->Session->read('User.type');
  if($sessionval=='admin' || $sessionval=='user'){
 echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id']),array('class' => 'btn btn-primary')); 
 echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']),array('class' => 'btn btn-primary'), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); 
 echo $this->Html->link(__('New User'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
 <?php }?>
    <?php echo $this->Html->link(__('List Users'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>

</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<h2><?php echo __('User'); ?></h2>
<dl>
<!--<dt><?php echo __('Id'); ?></dt>
<dd>
<?php echo h($user['User']['id']); ?>
&nbsp;
</dd>-->
<dt><?php echo __('Username'); ?></dt>
<dd>
<?php echo h($user['User']['username']); ?>
&nbsp;
</dd>
<dt><?php echo __('Password'); ?></dt>
<dd>
<?php echo h($user['User']['password']); ?>
&nbsp;
</dd>
</dd>
<dt><?php echo __('User Type'); ?></dt>
<dd>
<?php echo h($user['User']['type']); ?>
&nbsp;
</dd>
<dt><?php echo __('Role'); ?></dt>
<dd>
<?php if ($user['User']['role']=='regular') {echo h('Field User');} else if($user['User']['role']=='admin') { echo h('Master Admin'); } else { echo h('Back Office User'); } ?>
&nbsp;
</dd>
<dt><?php echo __('Created'); ?></dt>
<dd>
<?php echo h(date('d-m-Y',strtotime($user['User']['created']))); ?>
&nbsp;
</dd>
<dt><?php echo __('Modified'); ?></dt>
<dd>
<?php echo h(date('d-m-Y',strtotime($user['User']['modified']))); ?>
&nbsp;
</dd>
<dt><?php echo __('Name'); ?></dt>
<dd>
<?php echo h(ucfirst($user['User']['name'])); ?>  <?php echo h(ucfirst($user['User']['last_name'])); ?>
&nbsp;
</dd>
</dl>
</div>
</div>