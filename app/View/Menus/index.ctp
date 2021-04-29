<div class="actions">
<h3><?php echo __('Menus'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('New Menu'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Menuheaders'), array('controller' => 'menuheaders', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Menuheader'), array('controller' => 'menuheaders', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="table-responsive">
<?php /*?><h2><?php echo __('Menus'); ?></h2><?php */?>
<table class="table table-hover table-condensed">
<tr>
<th><?php echo $this->Paginator->sort('id'); ?></th>
<th><?php echo $this->Paginator->sort('menuheader_id'); ?></th>
<th><?php echo $this->Paginator->sort('name'); ?></th>
<!--<th><?php //echo $this->Paginator->sort('controller'); ?></th>
<th><?php //echo $this->Paginator->sort('action'); ?></th>
<th><?php //echo $this->Paginator->sort('navid'); ?></th>-->
<th><?php echo $this->Paginator->sort('status'); ?></th>
<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
<?php foreach ($menus as $menu): ?>
<tr>
<td><?php echo h($menu['Menu']['id']); ?>&nbsp;</td>
<td>
<?php echo $this->Html->link($menu['Menuheader']['name'], array('controller' => 'menuheaders', 'action' => 'view', $menu['Menuheader']['id'])); ?>
</td>
<td><?php echo h($menu['Menu']['name']); ?>&nbsp;</td>
<!--<td><?php //echo h($menu['Menu']['controller']); ?>&nbsp;</td>
<td><?php //echo h($menu['Menu']['action']); ?>&nbsp;</td>
<td><?php //echo h($menu['Menu']['navid']); ?>&nbsp;</td>-->
<td><?php echo h(ucfirst($menu['Menu']['status'])); ?>&nbsp;</td>
<td class="actions">
<?php echo $this->Html->link(__('View'), array('action' => 'view', $menu['Menu']['id']),array('class' => 'btn btn-success')); ?>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $menu['Menu']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $menu['Menu']['id']),array('class' => 'btn btn-danger'), null, __('Are you sure you want to delete # %s?', $menu['Menu']['id'])); ?>
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

