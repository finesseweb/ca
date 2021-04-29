<div class="actions">
<h3><?php echo __('Menuheaders'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('New Menuheader'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Menus'), array('controller' => 'menus', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Menu'), array('controller' => 'menus', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="menuheaders index">
<?php /*?><h2><?php echo __('Menuheaders'); ?></h2><?php */?>
<div class="table-responsive"><table class="table table-hover table-condensed">
<tr>
<th><?php echo $this->Paginator->sort('id'); ?></th>
<th><?php echo $this->Paginator->sort('name'); ?></th>
<!--<th><?php ///echo $this->Paginator->sort('controller'); ?></th>
<th><?php //echo $this->Paginator->sort('action'); ?></th>-->
<th><?php echo $this->Paginator->sort('status'); ?></th>
<!--<th><?php //echo $this->Paginator->sort('navid'); ?></th>-->
<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
<?php foreach ($menuheaders as $menuheader): ?>
<tr>
<td><?php echo h($menuheader['Menuheader']['id']); ?>&nbsp;</td>
<td><?php echo h($menuheader['Menuheader']['name']); ?>&nbsp;</td>
<!--<td><?php //echo h($menuheader['Menuheader']['controller']); ?>&nbsp;</td>
<td><?php //echo h($menuheader['Menuheader']['action']); ?>&nbsp;</td>-->
<td><?php echo h(ucfirst($menuheader['Menuheader']['status'])); ?>&nbsp;</td>
<!--<td><?php //echo h($menuheader['Menuheader']['navid']); ?>&nbsp;</td>-->
<td class="actions">
<?php echo $this->Html->link(__('View'), array('action' => 'view', $menuheader['Menuheader']['id']),array('class' => 'btn btn-success')); ?>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $menuheader['Menuheader']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $menuheader['Menuheader']['id']),array('class' => 'btn btn-danger'), null, __('Are you sure you want to delete # %s?', $menuheader['Menuheader']['id'])); ?>
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
</div>