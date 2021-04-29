<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('Edit Menuheader'), array('action' => 'edit', $menuheader['Menuheader']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete Menuheader'), array('action' => 'delete', $menuheader['Menuheader']['id']),array('class' => 'btn btn-primary'), null, __('Are you sure you want to delete # %s?', $menuheader['Menuheader']['id'])); ?>
<?php echo $this->Html->link(__('List Menuheaders'), array('action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Menuheader'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Menus'), array('controller' => 'menus', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Menu'), array('controller' => 'menus', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<h2><?php echo __('Menuheader'); ?></h2>
<dl>
<dt><?php echo __('Id'); ?></dt>
<dd>
<?php echo h($menuheader['Menuheader']['id']); ?>
&nbsp;
</dd>
<dt><?php echo __('Name'); ?></dt>
<dd>
<?php echo h(ucfirst($menuheader['Menuheader']['name'])); ?>
&nbsp;
</dd>

<!--<dt><?php echo __('Controller'); ?></dt>
<dd>
<?php echo h($menuheader['Menuheader']['controller']); ?>
&nbsp;
</dd>-->

<!--<dt><?php echo __('Action'); ?></dt>
<dd>
<?php echo h($menuheader['Menuheader']['action']); ?>
&nbsp;
</dd>-->
<dt><?php echo __('Status'); ?></dt>
<dd>
<?php echo h($menuheader['Menuheader']['status']); ?>
&nbsp;
</dd>
<!--<dt><?php echo __('Navid'); ?></dt>
<dd>
<?php echo h($menuheader['Menuheader']['navid']); ?>
&nbsp;
</dd>-->
</dl>
</div>
</div>
<?php /*?><div class="related">
<h3><?php echo __('Related Menus'); ?></h3>
<?php if (!empty($menuheader['Menu'])): ?>
<table cellpadding = "0" cellspacing = "0">
<tr>
<th><?php echo __('Id'); ?></th>
<th><?php echo __('Menuheader Id'); ?></th>
<th><?php echo __('Name'); ?></th>
<th><?php echo __('Action'); ?></th>
<th><?php echo __('Navid'); ?></th>
<th><?php echo __('Status'); ?></th>
<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
<?php foreach ($menuheader['Menu'] as $menu): ?>
<tr>
<td><?php echo $menu['id']; ?></td>
<td><?php echo $menu['menuheader_id']; ?></td>
<td><?php echo $menu['name']; ?></td>
<td><?php echo $menu['action']; ?></td>
<td><?php echo $menu['navid']; ?></td>
<td><?php echo $menu['status']; ?></td>
<td class="actions">
<?php echo $this->Html->link(__('View'), array('controller' => 'menus', 'action' => 'view', $menu['id'])); ?>
<?php echo $this->Html->link(__('Edit'), array('controller' => 'menus', 'action' => 'edit', $menu['id'])); ?>
<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'menus', 'action' => 'delete', $menu['id']), null, __('Are you sure you want to delete # %s?', $menu['id'])); ?>
</td>
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>

<div class="actions">
<ul>
<li><?php echo $this->Html->link(__('New Menu'), array('controller' => 'menus', 'action' => 'add')); ?> </li>
</ul>
</div>
</div><?php */?>