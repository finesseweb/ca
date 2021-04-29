<div class="actions">
<h2><?php echo __('Villages'); ?></h2>
<div class="btn-group">
<?php echo $this->Html->link(__('New Village'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Panchayat'), array('controller' => 'panchayats','action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List States'), array('controller' => 'states', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New State'), array('controller' => 'states', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Enquiries'), array('controller' => 'enquiries', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Enquiry'), array('controller' => 'enquiries', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Projects'), array('controller' => 'projects', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New Project'), array('controller' => 'projects', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<div class="row">
<form id="mastersearch" mathod="get" action="<?=SITE_PATH?>villages/">
<?php /*?> <div class="txt_one">SEARCH</div><?php */?>


<div class="col-sm-2"><select name="village" id="panchayat" class="form-control">
<option value="">Select Village</option>
<?php foreach ($panch as $key=>$panchayat){?>
<option value="<? echo $key; ?>" <? if(isset($this->params->query['panchayat']) && $this->params->query['panchayat']==$key) { ?> selected="selected"<? } ?>><? echo $panchayat; ?></option>
<? } ?>
</select></div>


<div class="col-sm-1"><input type="submit" name="confirm" value="Search" class="searchbtn btn btn-info btn-block" data-id='1'/> </div> 

<div class="col-sm-1"><input type="button" name="reset" value="Reset" class="btn btn-warning btn-block" onclick="window.location.href='<?=SITE_PATH?>villages/'"/></div>

</form>
</div>
</div>
</div>
<div class="row">
     <div class="col-sm-12"><div class="left_resale">
<div class="panel-body">

<table class="table table-hover table-condensed">
<thead>
<tr>
<th><?php echo $this->Paginator->sort('id'); ?></th>
<th><?php echo $this->Paginator->sort('Villages Name'); ?></th>
<th><?php echo $this->Paginator->sort('panchayat_id'); ?></th>
<th><?php //echo $this->Paginator->sort('city_id'); ?>District</th>
<th><?php echo $this->Paginator->sort('block_id'); ?></th>
<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
</thead>
<tbody>
<?php foreach ($villages as $village): ?>
<tr>
<td><?php echo h($village['Village']['id']); ?>&nbsp;</td>
<td><?php echo h(ucfirst($village['Village']['name'])); ?>&nbsp;</td>
<td>
<?php echo $this->Html->link(ucfirst($village['Panchayat']['name']), array('controller' => 'states', 'action' => 'view', $village['Panchayat']['id'])); ?>
</td>
<td>
<?php echo $this->Html->link(ucfirst($village['City']['name']), array('controller' => 'states', 'action' => 'view', $village['City']['id'])); ?>
</td>
<td>
<?php echo $this->Html->link(ucfirst($village['Block']['name']), array('controller' => 'states', 'action' => 'view', $village['Block']['id'])); ?>
</td>
<td class="actions">
<?php echo $this->Html->link(__('View'), array('action' => 'view', $village['Village']['id']),array('class' => 'btn btn-success')); ?>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $village['Village']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $village['Panchayat']['id']),array('class' => 'btn btn-danger'), array(), __('Are you sure you want to delete # %s?', $village['Village']['id'])); ?>
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
</div>
</div>