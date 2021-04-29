<style>
    .form-control{
            margin-bottom: -15px!important;
    }
    </style>
<div class="actions">
<h3><?php echo __('User Access'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('New User Access'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
</div>

<div class="panel panel-default">
<div class="panel-body">
<div class="row">
<form id="mastersearch" mathod="get" action="<?=SITE_PATH?>userAccesses/">
<?php /*?> <div class="txt_one">SEARCH</div><?php */?>

<div class="col-sm-2"><select name="user" id="user" class="form-control">
<option value="">Select User</option>
<?php
foreach($executives as $usr){
  ?>  
   <option value="<?php echo $usr['User']['username']?>" <?php if(isset($this->params->query['user']) && $this->params->query['user']==$usr['User']['username']) { ?> selected="selected"<? } ?> ><?php echo $usr['User']['username']?> </option>
<?php }
?>
</select>
</select></div>
<div class="col-sm-1"><input type="submit" name="confirm" value="Search" class="searchbtn btn btn-info btn-block" data-id='1'/> </div> 
<div class="col-sm-1"><input type="button" name="reset" value="Reset" class="btn btn-warning btn-block" onclick="window.location.href='<?=SITE_PATH?>userAccesses/'"/></div>

</form>
</div>
</div>
</div>
</div><div class="userAccesses index">
<?php echo $this->Form->create('UserAccess'); ?>
<div class="table-responsive">
<table class="table table-hover table-condensed">
<tr>
<?php /*?><th><?php echo $this->Paginator->sort('id'); ?></th><?php */?>
<th><?php echo $this->Paginator->sort('ip/username'); ?></th>
<th><?php echo $this->Paginator->sort('type'); ?></th>
<?php /*?><th><?php echo $this->Paginator->sort('updated_date'); ?></th>
<th><?php echo $this->Paginator->sort('updated_by'); ?></th><?php */?>
<?php /*?><th class="actions"><?php echo __('Actions'); ?></th><?php */?>
</tr>
<?php foreach ($userAccesses as $userAccess): ?>
<tr>
<?php /*?><td><?php echo h($userAccess['UserAccess']['id']); ?>&nbsp;</td><?php */?>
<td><?php echo $this->Form->input('name',array('class' => 'form-control','label'=>False,'value'=>$userAccess['UserAccess']['name'],'name'=>'data[UserAccess][name][]'));?> <? echo $this->Form->input('id',array('value'=>$userAccess['UserAccess']['id'],'type'=>'hidden','name'=>'data[UserAccess][id][]'));?></td>
<td><?php echo $this->Form->input('type',array('class' => 'form-control','label'=>False,'type'=>'select','name'=>'data[UserAccess][type][]','options'=>array('user'=>'User','ip'=>'Ip'),'selected'=>$userAccess['UserAccess']['type']));?></td>
<?php /*?><td><?php echo h($userAccess['UserAccess']['updated_date']); ?>&nbsp;</td>
<td><?php echo h($userAccess['UserAccess']['updated_by']); ?>&nbsp;</td><?php */?>
<?php /*?><td class="actions">
<?php echo $this->Html->link(__('View'), array('action' => 'view', $userAccess['UserAccess']['id'])); ?>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $userAccess['UserAccess']['id'])); ?>
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $userAccess['UserAccess']['id']), null, __('Are you sure you want to delete # %s?', $userAccess['UserAccess']['id'])); ?>
</td><?php */?>
</tr>
<?php endforeach; ?>
</table>
</div>
<?php echo $this->Form->end(__('Submit')); ?>
<?php /*?><p>
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
</div><?php */?>
</div>