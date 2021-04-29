<? $allparentids=@implode('##',$users);?>
<h3><?php echo __('Meetings'); ?></h3>
<div class="btn-group">
<?php echo $this->Html->link(__('New Enquiry'), array('controller'=>'enquiries','action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add'),array('class' => 'btn btn-primary')); ?> 
<?php echo $this->Html->link(__('Today Reminders'), array('controller' => 'enquiries', 'action' => 'currentReminders'),array('class' => 'btn btn-primary')); ?> 
<?php echo $this->Html->link(__('Meetings'), array('controller' => 'meetings', 'action' => 'index'),array('class' => 'btn btn-primary')); ?> 
</div>

<div class="panel panel-default">
<div class="panel-body">
<form id="mastersearch" mathod="get" action="<?=SITE_PATH?>meetings/">
<?php /*?> <div class="txt_one">SEARCH</div><?php */?>
<div class="col-sm-3"><input type="text" name="search_key" class="form-control" placeholder="By Name, Contact" value="<? if(isset($this->params->query['search_key'])){ echo trim($this->params->query['search_key']); }?>"/></div>

<div class="col-sm-3"><div class="input-group"><input type="text" name="from_date" class="form-control" id="from_date" placeholder="Meeting Date" value="<? if(isset($this->params->query['from_date'])){ echo trim($this->params->query['from_date']); }?>"/><span class="input-group-addon">To</span><input type="text" name="to_date" id="to_date" class="form-control" placeholder="Meeting Date" value="<? if(isset($this->params->query['to_date'])){ echo trim($this->params->query['to_date']); }?>"/></div></div>

<div class="col-sm-2">
<select name="search_user" id="search_user" class="form-control">
<option value="">Select Executive</option>
<? $select=0;$userid=0;
if(isset($this->params->query['search_user']) and $this->params->query['search_user']!='') { $userid=$this->params->query['search_user']; }
if(CakeSession::read('User.type')==='regular'){
if(CakeSession::read('User.id')==$userid) {$select='selected="selected"';}
echo '<option value="'.CakeSession::read('User.id').'" '.$select.'">---- '.CakeSession::read('User.name').'</option>';
echo $this->requestAction(array("controller"=>"users","action"=>"buildTree",CakeSession::read('User.id'),$userid,$allparentids));
} else { echo $this->requestAction(array("controller"=>"users","action"=>"buildTree",0,$userid,$allparentids)); } ?>
</select></div>

<div class="col-sm-2"><input type="submit" name="confirm" class="btn btn-default btn-block" value="search" class="searchbtn" data-id='1'/> </div> <div class="col-sm-2"><input type="button" name="reset" class="btn btn-default btn-block" value="reset" onclick="window.location.href='<?=SITE_PATH?>meetings/'"/></div>

</form>
</div>
</div>

<div class="table-responsive">
<table class="table table-hover table-condensed">
<thead>
<tr>
<th><?php echo $this->Paginator->sort('id'); ?></th>
<th><?php echo $this->Paginator->sort('enquiry_id'); ?></th>
<th><?php echo $this->Paginator->sort('user_id'); ?></th>
<th><?php echo $this->Paginator->sort('project_name'); ?></th>
<th><?php echo $this->Paginator->sort('timing'); ?></th>
<th><?php echo $this->Paginator->sort('client_name'); ?></th>
<th><?php echo $this->Paginator->sort('client_contact'); ?></th>
<th><?php echo $this->Paginator->sort('meeting_place'); ?></th>
<th title="Representative"><?php echo $this->Paginator->sort('rep'); ?></th>
<th title="Second Representative"><?php echo $this->Paginator->sort('sec. rep.'); ?></th>
<th><?php echo $this->Paginator->sort('status'); ?></th>
<th title="Response"><?php echo $this->Paginator->sort('res'); ?></th>
<th title="Form Received"><?php echo $this->Paginator->sort('form Rec.'); ?></th>
<?php /*?><th><?php echo $this->Paginator->sort('form_repeat'); ?></th>
<?php /*?><th><?php echo $this->Paginator->sort('posted'); ?></th><?php */?>
<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
</thead>
<tbody>
<?php

$representative='';$second_representative='';
$getAllParents=$this->requestAction(array("controller"=>"users","action"=>"getAll"));
foreach ($meetings as $meeting): 
if(array_key_exists($meeting['Meeting']['representative'],$getAllParents)){  $representative="( ".ucwords($getAllParents[$meeting['Meeting']['representative']]." )");}
if(array_key_exists($meeting['Meeting']['second_representative'],$getAllParents)){  $second_representative="( ".ucwords($getAllParents[$meeting['Meeting']['second_representative']]." )");}

?>
<tr title="<?=$meeting['Meeting']['status']?>">
<td><?php echo h($meeting['Meeting']['id']); ?></td>
<td><?php echo h($meeting['Enquiry']['name']); ?></td>
<td><?php echo h($meeting['User']['username']); ?></td>
<td title="<?=$meeting['Project']['name']?>"><?php echo h(substr($meeting['Project']['name'],0,15)); ?>..</td>
<td><?php echo h(date('d M ,Y H:i:s',strtotime($meeting['Meeting']['timing']))); ?></td>
<td><?php echo h($meeting['Meeting']['client_name']); ?></td>
<td><?php echo h(substr($meeting['Meeting']['client_contact'],0,12)); ?>..</td>
<td><?php echo h(substr($meeting['Meeting']['meeting_place'],0,25)); ?>..</td>
<td><?php echo h($representative); ?></td>
<td><?php echo h($second_representative); ?></td>
<td class="<?=$meeting['Meeting']['status']?>"><?php echo h($meeting['Meeting']['status']); ?></td>
<td><?php echo h($meeting['Meeting']['response']); ?> %</td>
<td><?php echo h($meeting['Meeting']['form_received']); ?></td>
<?php /*?><td><?php echo h($meeting['Meeting']['form_repeat']); ?>&nbsp;</td>
<td><?php echo h(date('d M ,Y',strtotime($meeting['Meeting']['posted']))); ?>&nbsp;</td><?php */?>
<td class="actions">
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $meeting['Meeting']['id']),array('class' => 'btn btn-primary')); ?>
</td>
</tr>
<?php  $representative='';$second_representative=''; endforeach; ?>
</tbody>
</table>
</div>
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

<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>cal/epoch_styles.css" />
<script type="text/javascript" src="<?=SITE_PATH?>cal/epoch_classes.js"></script>
<script type="text/javascript" language="javascript">

var dp_cal1;var dp_cal2;      
dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('from_date'));
dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('to_date'));	
</script>
