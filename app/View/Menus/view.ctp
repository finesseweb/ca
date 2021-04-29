<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('Edit Menu'), array('action' => 'edit', $menu['Menu']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete Menu'), array('action' => 'delete', $menu['Menu']['id']),array('class' => 'btn btn-primary'), null, __('Are you sure you want to delete # %s?', $menu['Menu']['id'])); ?>
<?php echo $this->Html->link(__('List Menus'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Menu'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Menuheaders'), array('controller' => 'menuheaders', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Menuheader'), array('controller' => 'menuheaders', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<h2><?php echo __('Menu'); ?></h2>
<!--<dl>
<dt><?php echo __('Id'); ?></dt>
<dd>
<?php echo h($menu['Menu']['id']); ?>
&nbsp;
</dd>-->
<dt><?php echo __('Menuheader'); ?></dt>
<dd>
<?php echo $this->Html->link($menu['Menuheader']['name'], array('controller' => 'menuheaders', 'action' => 'view', $menu['Menuheader']['id'])); ?>
&nbsp;
</dd>
<dt><?php echo __('Name'); ?></dt>
<dd>
<?php echo h($menu['Menu']['name']); ?>
&nbsp;
</dd>
<!--<dt><?php echo __('Controller'); ?></dt>
<dd>
<?php echo h($menu['Menu']['controller']); ?>
&nbsp;
</dd>
<dt><?php echo __('Action'); ?></dt>
<dd>
<?php echo h($menu['Menu']['action']); ?>
&nbsp;
</dd>
<dt><?php echo __('Navid'); ?></dt>
<dd>
<?php echo h($menu['Menu']['navid']); ?>
&nbsp;
</dd>-->
<dt><?php echo __('Status'); ?></dt>
<dd>
<?php echo h(ucfirst($menu['Menu']['status'])); ?>
&nbsp;
</dd>
</dl>
</div>
</div>