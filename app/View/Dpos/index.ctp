<? $allparentids=@implode('##',$users);?>
<div class="actions">
<h2><?php echo __('Distrcit Project Officer Details'); ?></h2>
</div>
<div class="btn-group">
<?php echo $this->Html->link(__('New DPO'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('Report'), array('action' => 'report'),array('class' => 'btn btn-primary')); ?>
</div>

<div class="panel panel-default">
<div class="panel-body">
<div class="row">
<form id="mastersearch" mathod="get" action="<?=SITE_PATH?>dpos/">
<?php /*?> <div class="txt_one">SEARCH</div><?php */?>
<div class="col-sm-3"><input type="text" name="search_key" placeholder="By Name,Mobile,Email" class="form-control" value="<? if(isset($this->params->query['search_key'])){ echo trim($this->params->query['search_key']); }?>"/></div>

<?php /*?><div class="col-sm-3"><div class="input-group"><input type="text" name="from_date" id="from_date" class="form-control" placeholder="DATE FROM" value="<? if(isset($this->params->query['from_date'])){ echo trim($this->params->query['from_date']); }?>"/><span class="input-group-addon">To</span><input type="text" name="to_date" id="to_date" class="form-control" placeholder="DATE TO" value="<? if(isset($this->params->query['to_date'])){ echo trim($this->params->query['to_date']); }?>"/></div></div>

<div class="col-sm-2"><select name="search_user" id="search_user" class="form-control">
<option value="">SELECT USER</option>
<?php $select=0;$userid=0;
if(isset($this->params->query['search_user'])) { $userid=$this->params->query['search_user']; }
if(CakeSession::read('User.type')==='regular'){
if(CakeSession::read('User.id')==$userid) {$select='selected="selected"';}
echo '<option value="'.CakeSession::read('User.id').'" '.$select.'">---- '.CakeSession::read('User.name').'</option>';
echo $this->requestAction(array("controller"=>"users","action"=>"buildTree",CakeSession::read('User.id'),$userid,$allparentids));
} else { echo $this->requestAction(array("controller"=>"users","action"=>"buildTree",0,$userid,$allparentids)); } ?>
</select></div>

<div class="col-sm-2"><select name="search_builder" id="search_builder" class="form-control">
<option value="">SELECT BUILDER</option>
<? foreach ($builders as $key=>$builders){?>
<option value="<? echo $key; ?>" <? if(isset($this->params->query['search_builder']) && $this->params->query['search_builder']==$key) { ?> selected="selected"<? } ?>><? echo $builders; ?></option>
<? } ?>
</select></div>

<div class="col-sm-2"><select name="search_project" id="search_project" class="form-control">
<option value="">SELECT PROJECT</option>
<?php if(!empty($projects)) { foreach ($projects as $key2=>$project){?>
<option value="<? echo $key2; ?>" <? if(isset($this->params->query['search_project']) && $this->params->query['search_project']==$key2) { ?> selected="selected"<? } ?>><? echo $project; ?></option>
<? } } ?>
</select></div><?php */?>

<div class="col-sm-1"><input type="submit" name="confirm" value="Search" class="searchbtn btn btn-info btn-block" data-id='1'/> </div> 

<div class="col-sm-1"><input type="button" name="reset" value="Reset" class="btn btn-warning btn-block" onclick="window.location.href='<?=SITE_PATH?>dpos/'"/></div>
<div class="col-sm-1" style="float:right; margin-top:15px;"><input type="button" name="reset" value="Export" class="btn btn-block export" onclick="window.open('<?=SITE_PATH?>dpos/export/?<?=$_SERVER['QUERY_STRING']?>','abhay','scrollbars=1,width=1400,height=650,left=100,top=50')"/></div>

</form>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-12"><div class="left_resale">
<div class="table-responsive">
<table class="table table-hover table-condensed" id="resultTable">
<tr>
<th><?php echo $this->Paginator->sort('id'); ?></th>
<th><?php echo $this->Paginator->sort('first_name'); ?></th>
<th><?php echo $this->Paginator->sort('last_name'); ?></th>
<th><?php echo $this->Paginator->sort('designation'); ?></th>
<th><?php echo $this->Paginator->sort('gender'); ?></th>
<th><?php echo $this->Paginator->sort('mobile'); ?></th>
<th><?php echo $this->Paginator->sort('email_id'); ?></th>


<?php /*?> <th><?php echo $this->Paginator->sort('B.form'); ?></th><?php */?>
<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
<?php foreach ($administrations as $administration): ?>
<tr>
<td><?php echo h($administration['Dpo']['id']); ?></td>
<td><?php echo h(ucfirst($administration['User']['name'])); ?></td>
<td><?php echo h(ucfirst($administration['User']['last_name'])); ?></td>
<td><?php echo h(ucfirst($administration['Dpo']['designation'])); ?></td>
<td><?php echo h(ucfirst($administration['Dpo']['gender'])); ?></td>
<td><?php echo h($administration['Dpo']['mobile']); ?></td>
<td><?php echo h($administration['Dpo']['email_id']); ?></td>
<td class="actions">
<a href="javascript:void(0)" class="more btn btn-success" data-toggle="modal" data-target="#myModal" data-id="<?=$administration['Dpo']['id']?>">More</a>
<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $administration['Dpo']['id']),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $administration['Dpo']['id']),array('class' => 'btn btn-danger'), null, __('Are you sure you want to delete # %s?', $administration['Dpo']['id'])); ?>
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
</div></div></div></div>
<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">More Details</h4>
</div>
<div class="modal-body">
<div class="right_resale" id="resalemore"><table cellpadding="0" cellspacing="0">
<tr><td>!! MORE DATA SHOULD BE DISPLAY HERE !!</td></tr>
</table></div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>


<!--</div>-->
<?php /*?><div class="actions">
<h3><?php echo __('Actions'); ?></h3>
<ul>
<?php echo $this->Html->link(__('New Booking'), array('action' => 'add')); ?>
</ul>
</div><?php */?>
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>cal/epoch_styles.css" />
<script type="text/javascript" src="<?=SITE_PATH?>cal/epoch_classes.js"></script>
<script type="text/javascript" language="javascript">

var dp_cal1;var dp_cal2;      
dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('to_date'));	
dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('from_date'));	
</script>

<script type="text/javascript">
$(".more").click(function(){
$('#resultTable tr').removeClass("done");
$(this).parent().parent().addClass("done");
var dataid=$(this).attr('data-id');
$('.right_resale').html("<div class='loading'><img src='<?=SITE_PATH?>images/loader.gif'> Please wait .Loading........</div>");
$.ajax({url:"<?=SITE_PATH?>dpos/view/"+dataid,dataType:"html",success:function(result){
if(result!=''){$("#resalemore").html(result);} else {$("#resalemore").html("<div class='loading'>Data not found</div>");}
}});
});



$(document).ready(function(){
$("#search_builder").change(function(){
var c=$(this).val();
$('#search_project').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>projects/getproject/"+c,success:function(result){$("#search_project").html(result);}});

});
});

</script>
