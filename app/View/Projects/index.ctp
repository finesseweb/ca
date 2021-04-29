<div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('New Project'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Builders'), array('controller' => 'builders', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Builder'), array('controller' => 'builders', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List States'), array('controller' => 'states', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New State'), array('controller' => 'states', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Cities'), array('controller' => 'cities', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New City'), array('controller' => 'cities', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Enquiries'), array('controller' => 'enquiries', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New Enquiry'), array('controller' => 'enquiries', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="table-responsive">
<h2><?php echo __('Projects'); ?></h2>
<table cellpadding="0" cellspacing="0">
<thead>
<tr><td colspan="8"><div class="col-sm-4"><form action="<?=SITE_PATH?>projects/index/"  method="get"><select name="builder_id" id="builder_id" class="form-control"><option value="">Select Builder</option><?  foreach ($builders as $key=>$value) { ?><option value="<?=$key?>" <? if(isset($this->request->query['builder_id']) and $this->request->query['builder_id']!='' and $this->request->query['builder_id']==$key) { ?> selected <? } ?>><?=$value?></option><? } ?></select></form></div></td></tr>
<tr>
<th><?php echo $this->Paginator->sort('id'); ?></th>
<th><?php echo $this->Paginator->sort('builder_id'); ?></th>
<th><?php echo $this->Paginator->sort('state_id'); ?></th>
<th><?php echo $this->Paginator->sort('city_id'); ?></th>
<th><?php echo $this->Paginator->sort('name'); ?></th>
<?php /*?><th><?php echo $this->Paginator->sort('title'); ?></th><?php */?>
<th><?php echo $this->Paginator->sort('type'); ?></th>
<?php /*?><th><?php echo $this->Paginator->sort('status'); ?></th><?php */?>
<?php /*?><th><?php echo $this->Paginator->sort('posted_date'); ?></th><?php */?>
<th><?php echo $this->Paginator->sort('updated_date'); ?></th>
<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
</thead>
<tbody>
<?php foreach ($projects as $project): ?>
<tr>
<td><?php echo h($project['Project']['id']); ?>&nbsp;</td>
<td>
<?php echo $this->Html->link($project['Builder']['name'], array('controller' => 'builders', 'action' => 'view', $project['Builder']['id'])); ?>
</td>
<td>
<?php echo $this->Html->link($project['State']['name'], array('controller' => 'states', 'action' => 'view', $project['State']['id'])); ?>
</td>
<td>
<?php echo $this->Html->link($project['City']['name'], array('controller' => 'cities', 'action' => 'view', $project['City']['id'])); ?>
</td>
<td><?php echo h($project['Project']['name']); ?>&nbsp;</td>
<?php /*?><td><?php echo h($project['Project']['title']); ?>&nbsp;</td><?php */?>
<td><?php echo h($project['PropertyType']['name']); ?>&nbsp;</td>
<?php /*?><td><?php echo h($project['Project']['status']); ?>&nbsp;</td><?php */?>
<?php /*?><td><?php echo h($project['Project']['posted_date']); ?>&nbsp;</td><?php */?>
<td><?php echo h($project['Project']['updated_date']); ?>&nbsp;</td>
<td class="actions">
<?php echo $this->Html->link(__('View'), array('action' => 'view', $project['Project']['id']),array('class' => 'btn btn-success')); ?>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $project['Project']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $project['Project']['id']),array('class' => 'btn btn-danger'), array(), __('Are you sure you want to delete # %s?', $project['Project']['id'])); ?>
</td>
</tr>
<?php endforeach; ?>
</tbody>
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
</div><script>

$(document).ready(function(){
$("#builder_id").change(function(){
this.form.submit();  
});
});
</script>