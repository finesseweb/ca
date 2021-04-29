<? $allparentids=@implode('##',$userss);?><div class="actions">
<h3><?php echo __('Users'); ?></h3>
<div class="btn-group">
<?php 
$menu= $this->Session->read('User.mainmenu');
 $sessionval=$this->Session->read('User.type');
 
 echo $this->Html->link(__('New User'), array('action' => 'add'),array('class' => 'btn btn-primary'));  ?>
</div>
</div>
<div class="users index">
<?php /*?><h2><?php echo __('Users'); ?></h2><?php */?>
<form id="mastersearch" mathod="get" action="<?=SITE_PATH?>users/">
<div class="panel panel-default">
<div class="panel-body">
<div class="col-sm-3">
<select name="user_id" id="search_user" class="form-control">
<option value="">SELECT USER</option>
<?php $select=0;$userid=0;$selected='selected';
if(isset($this->params->query['user_id'])  and $this->params->query['user_id']!='') { $userid=$this->params->query['user_id']; }
if(CakeSession::read('User.type')==='regular'){
echo '<option value="'.CakeSession::read('User.id').'">---- '.CakeSession::read('User.name').'</option>';
echo $this->requestAction(array("controller"=>"users","action"=>"buildTree",CakeSession::read('User.id'),$userid,$allparentids));
} else {
    echo $this->requestAction(array("controller"=>"users","action"=>"test",$userid));
    } ?>
</select></div>
<div class="col-sm-2"><input type="submit" name="confirm" value="Search" class="searchbtn btn btn-success btn-block" data-id='1'/></div>
<div class="col-sm-1"><input type="button" name="reset" value="Reset" class="btn btn-info btn-block" onclick="window.location.href='<?=SITE_PATH?>users/'"/></div>
</div>
</div>
</form>
<div class="table-responsive">
<table class="table table-hover table-condensed">
<thead>
<tr>
<th><?php echo $this->Paginator->sort('id'); ?></th>
<th><?php echo $this->Paginator->sort('User Name'); ?></th>
<th><?php echo $this->Paginator->sort('name');?></th>
<th><?php echo $this->Paginator->sort('type'); ?></th>
<th><?php echo $this->Paginator->sort('role'); ?></th>
<th><?php //echo $this->Paginator->sort('Sub Role'); ?>Sub Role</th>
<th><?php echo $this->Paginator->sort('status'); ?></th>
<th><?php echo $this->Paginator->sort('created');?></th>
<th><?php echo $this->Paginator->sort('modified');?></th>

<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
</thead>
<tbody id="response">
<?php 
$parent='';
$getAllParents=$this->requestAction(array("controller"=>"users","action"=>"getAllParent"));


foreach ($users as $user): 

if(array_key_exists($user['User']['parent'],$getAllParents)){  $parent="( ".ucwords($getAllParents[$user['User']['parent']]." )");  }
?>
<tr>
<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
<td><i class="fa fa-square" style="color:<?=$user['User']['colorcode']?>"></i> <?php echo h($user['User']['username']); ?>&nbsp;</td>
<td><?php echo h($user['User']['name'].' '.$user['User']['last_name']); ?>&nbsp;</td>
<td><?php echo h($user['User']['type'])?>&nbsp;</td>
<td><?php if ($user['User']['role']=='regular') {echo h('Field User');} else if($user['User']['role']=='admin') { echo h('Master Admin'); } else { echo h('Back Office User'); } ?>&nbsp;</td>
<td><?php echo h($user['User']['subrole'])?>&nbsp;</td>
<td><?php echo h(ucfirst($user['User']['status'])); ?>&nbsp;</td>
<td><?php echo h(date('d-m-Y',strtotime($user['User']['created']))); ?>&nbsp;</td>
<td><?php echo h(date('d-m-Y',strtotime($user['User']['modified']))); ?>&nbsp;</td>

<td class="actions">
<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id']),array('class' => 'btn btn-success')); ?>
<?php 
if($sessionval=='regular') {
?>
    <?php
if(in_array($this->request->params['controller'].":edit",$menu)){
  
?>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id']),array('class' => 'btn btn-primary')); ?>
<?php } ?>
     <?php
if(in_array($this->request->params['controller'].":delete",$menu)){
  
?>
    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']),array('class' => 'btn btn-danger'), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
<?php } ?>
<?php } else {?>
 <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id']),array('class' => 'btn btn-primary')); ?>
 <?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $user['User']['id']));?>

<?php } ?>
</td>
</tr>
<?php $parent=''; endforeach; ?>
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
</div>
<script type="text/javascript">
<?php /*?>$(".searchbtn").click(function(){
var startpage=$(this).attr('data-id');
var searchval = "?"+$( "form#mastersearch" ).serialize()+"&startpage="+startpage;
if($("#search_user").val()!=0 && $("#search_user").val()!=''){
$('#response').html("<div class='loading'><img src='<?=SITE_PATH?>images/loader.gif'> Please wait .Loading........</div>");
$.ajax({url:"<?=SITE_PATH?>users/getUserOnParent/"+searchval,dataType:"html",success:function(result){
if(result!=''){$("#response").html(result);} else {$("#response").html("<div class='loading'>data not found</div>");}
}});
}
});<?php */?>

<?php /*?>$("div.paging span").click(function(){
var c=$(this).attr('p'); 
var searchval = "?"+$( "form#mastersearch" ).serialize()+"&startpage="+c;
$('#response').html("<div class='loading'><img src='<?=SITE_PATH?>images/loader.gif'> Please wait .Loading........</div>");
$.ajax({url:"<?=SITE_PATH?>users/getUserOnParent/"+searchval,dataType:"html",success:function(result){
if(result!=''){$("#response").html(result);} else {$("#response").html("<div class='loading'>data not found</div>");}
}});
});<?php */?>

</script>