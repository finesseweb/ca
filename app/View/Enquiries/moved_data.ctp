<? $allparentids=@implode('##',$users);?>
<h2><?php echo __('Recycle Data'); 
 ?></h2> 
<div class="btn-group">
Daily Recycle data Based On the <?=date('d-m-Y, l',strtotime("-1 days"))?>
<?php //echo $this->Html->link(__('New Enquiry'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('Today Reminders'), array('controller' => 'enquiries', 'action' => 'currentReminders'),array('class' => 'btn btn-primary')); ?>
<?php //echo $this->Html->link(__('Meetings'), array('controller' => 'meetings', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>


<div class="panel panel-default">
<div class="panel-body">
<form id="mastersearch" mathod="get" action="<?=SITE_PATH?>enquiries/movedData/">
<?php /*?> <div class="txt_one">SEARCH</div><?php */?>
<div class="row">
<!--<div class="col-sm-3"><input type="text" name="search_key" placeholder="By Name, Email, Lead, Contact" class="form-control" value="<? if(isset($this->params->query['search_key'])){ echo trim($this->params->query['search_key']); }?>"/></div>-->
<div class="col-sm-3"><div class="input-group"><span class="input-group-addon">From</span><input type="text" name="from_date" class="form-control" id="from_date" placeholder="DATE FROM" value="<? if(isset($this->params->query['from_date'])){ echo trim($this->params->query['from_date']); }?>"/><span class="input-group-addon">To</span><input type="text" name="to_date" class="form-control" id="to_date" placeholder="DATE TO" value="<? if(isset($this->params->query['to_date'])){ echo trim($this->params->query['to_date']); }?>"/></div></div>
<div class="col-sm-2"><select name="search_user" id="search_user" class="form-control">
<option value="">SELECT USER</option>
<? $select=0;$userid=0;

if(isset($this->params->query['search_user']) and $this->params->query['search_user']!='') { $userid=$this->params->query['search_user']; }
if(CakeSession::read('User.type')==='regular'){
if(CakeSession::read('User.id')==$userid) {$select='selected="selected"';}
echo '<option value="'.CakeSession::read('User.id').'" '.$select.'">---- '.CakeSession::read('User.name').'</option>';
echo $this->requestAction(array("controller"=>"users","action"=>"buildTree",CakeSession::read('User.id'),$userid,$allparentids));
} else { echo $this->requestAction(array("controller"=>"users","action"=>"test",$userid)); } ?>
</select></div>
<!--<div class="col-sm-2"><select name="search_country" id="search_country" class="form-control">
<option value="">SELECT COUNTRY</option>
<? foreach ($countries as $key=>$country){?>
<option value="<? echo $key; ?>" <? if(isset($this->params->query['search_country']) && $this->params->query['search_country']==$key) { ?> selected="selected"<? } ?>><? echo $country; ?></option>
<? } ?>
</select></div>-->
<!--<div class="col-sm-2"><select name="search_builder" id="search_builder" class="form-control">
<option value="">SELECT BUILDER</option>
<? foreach ($builders as $key=>$builders){?>
<option value="<? echo $key; ?>" <? if(isset($this->params->query['search_builder']) && $this->params->query['search_builder']==$key) { ?> selected="selected"<? } ?>><? echo $builders; ?></option>
<? } ?>
</select></div>-->
<!--<div class="col-sm-2"><select name="search_project" id="search_project" class="form-control">
<option value="">SELECT PROJECT</option>
<? if(!empty($projects)) { foreach ($projects as $key2=>$project){?>
<option value="<? echo $key2; ?>" <? if(isset($this->params->query['search_project']) && $this->params->query['search_project']==$key2) { ?> selected="selected"<? } ?>><? echo $project; ?></option>
<? } } ?>
</select></div>-->
<!--<div class="col-sm-3"><select name="close_reasons" id="close_reasons" class="form-control">
<option value="">SELECT REASONS</option>
<? foreach ($closeReasons as $key=>$closeReasons){?>
<option value="<? echo $key; ?>" <? if(isset($this->params->query['close_reasons']) && $this->params->query['close_reasons']==$key) { ?> selected="selected"<? } ?>><? echo $closeReasons; ?></option>
<? } ?>
</select></div>-->
<div class="col-sm-2"><select name="lead_source_id" id="lead_source_id" class="form-control">
<option value="">SELECT LEAD SOURSE</option>
<? foreach ($leadSources as $key4=>$leadSource){?>
<option value="<? echo $key4; ?>" <? if(isset($this->params->query['lead_source_id']) && $this->params->query['lead_source_id']==$key4) { ?> selected="selected"<? } ?>><? echo $leadSource; ?></option>
<? } ?>
</select></div>
<!--<div class="col-sm-2"><select name="search_status" id="search_status" class="form-control">
<option value="">SELECT STATUS</option>
<option value="open" <? if(isset($this->params->query['search_status']) && $this->params->query['search_status']=="open") { ?> selected="selected"<? } ?>>Open</option>
<option value="close" <? if(isset($this->params->query['search_status']) && $this->params->query['search_status']=="close") { ?> selected="selected"<? } ?>>Close</option>
<option value="done" <? if(isset($this->params->query['search_status']) && $this->params->query['search_status']=="done") { ?> selected="selected"<? } ?>>Done</option>
<?php /*?><option value="trash" <? if(isset($this->params->query['search_status']) && $this->params->query['search_status']=="trash") { ?> selected="selected"<? } ?>>Trash</option><?php */?>
<option value="sold out" <? if(isset($this->params->query['search_status']) && $this->params->query['search_status']=="sold out") { ?> selected="selected"<? } ?>>Sold Out</option>
<option value="waiting" <? if(isset($this->params->query['search_status']) && $this->params->query['search_status']=="waiting") { ?> selected="selected"<? } ?>>Waiting</option>
</select></div>-->
<div class="col-sm-2"><input type="submit" name="confirm" value="search" class="searchbtn btn btn-warning btn-block" data-id='1'/> </div>
<div class="col-sm-1"><input type="button" name="reset" value="reset" class="btn btn-info btn-block" onclick="window.location.href='<?=SITE_PATH?>enquiries/movedData/'"/></div>
<div class="col-sm-2"><button class="btn btn-default btn-block">Print Preview</button></div>
</div>
</form>
</div>
</div>

<div class="table-responsive">
<?php

echo $this->Paginator->counter(array(
'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
));
?>
<table border="1" class="table table-hover table-condensed" id="printTable">
<thead>
<tr>
<th width="5.5%"><?php echo $this->Paginator->sort('id'); ?></th>
<th><?php echo $this->Paginator->sort('MovedFrom_id'); ?></th>
<th><?php echo $this->Paginator->sort('MovedTo_id'); ?></th>
<th><?php echo $this->Paginator->sort('posted_date'); ?></th>
<th><?php echo $this->Paginator->sort('name'); ?></th>
<th><?php echo $this->Paginator->sort('email'); ?></th>
<th><?php echo $this->Paginator->sort('contact'); ?></th>
<th><?php echo $this->Paginator->sort('project_id'); ?></th>
<th><?php echo $this->Paginator->sort('country_id'); ?></th>
<!--<th class="actions"><?php echo __('Actions'); ?></th>-->
</tr>
</thead>
<tbody id="response">
<?php
$parent='';
$getAllParents=$this->requestAction(array("controller"=>"users","action"=>"getAllParent"));

if(!empty($enquiries)) { foreach ($enquiries as $enquiry):
if(array_key_exists($enquiry['User']['parent'],$getAllParents)){  $parent="( ".ucwords($getAllParents[$enquiry['User']['parent']]." )");  }
?>
<tr class="<?=$enquiry['Enquiry']['status']?>" title="<?=$enquiry['Enquiry']['status']?> (<?=$enquiry['CloseReason']['name']?>)">
<td title="<?=$enquiry['LeadSource']['name']?>"><?php echo h($enquiry['Enquiry']['id']); ?> <i class="fa fa-circle <?=$enquiry['LeadSource']['flag']?>"></i></td>
<td><i title=""></i><? if((int)$enquiry['Enquiry']['user_id']!=(int)trim($enquiry['Enquiry']['lead_of']) and (int)trim($enquiry['Enquiry']['lead_of'])!="") { $colorcode=$this->requestAction(array("controller"=>"users","action"=>"getColorCode",$enquiry['Enquiry']['lead_of'])); if(!empty($colorcode)) {?> <i title="<?=$colorcode[0]['users']['username']?>" class="fa fa-square" style="color:<?=$colorcode[0]['users']['colorcode']?>"></i><?=$colorcode[0]['users']['username']?> <? } } ?></td>

<td><i title="<?=$enquiry['User']['username']?>" class="fa fa-square" style="color:<?=$enquiry['User']['colorcode']?>"></i><? if((int)$enquiry['Enquiry']['user_id']!=(int)trim($enquiry['Enquiry']['lead_of']) and (int)trim($enquiry['Enquiry']['lead_of'])!="") { $colorcode=$this->requestAction(array("controller"=>"users","action"=>"getColorCode",$enquiry['Enquiry']['lead_of'])); if(!empty($colorcode)) {?> <i title=""></i><? } } ?><?php echo h($enquiry['User']['username'] .' '. $parent); ?></td>
<td><?php echo h(date('d M , Y',strtotime($enquiry['Enquiry']['posted_date']))); ?>&nbsp;</td>
<td><?php echo h($enquiry['Enquiry']['name']); ?>&nbsp;</td>
<td><?php echo h($enquiry['Enquiry']['email']); ?></td>
<td><?php echo h($enquiry['Enquiry']['contact']); ?>&nbsp;</td>
<td title="<? echo $enquiry['Builder']['name'];?> ( <? echo $enquiry['Project']['name'];?> )"><?php echo h(substr($enquiry['Project']['name'],0,20)); ?>..</td>
<td><?php echo h($enquiry['Country']['name']); ?></td>
<?php /*?><td><?php echo h($enquiry['Enquiry']['is_reminder']); ?>&nbsp;</td><?php */?>

<!--<td class="actions">


<a href="javascript:void(0)" title="<?php if($enquiry['Enquiry']['reminder_date']!='0000-00-00 00:00:00') { echo h(date('d M ,Y',strtotime($enquiry['Enquiry']['reminder_date'])));} ?>" <? if($enquiry['Enquiry']['is_reminder']=='no'){?>class="reminderno"<? } ?> onclick="window.open('<?=SITE_PATH."enquiries/movedView/".$enquiry['Enquiry']['id']."/".$enquiry['Enquiry']['user_id']?>','abhay','scrollbars=1,width=1400,height=650,left=100,top=50')" title="Remark">R</a>

<? if(CakeSession::read('User.type')==='admin'){?> <input value="&laquo; Remove From ABJ" class="moveto searchbtn btn btn-primary <?=$enquiry['Enquiry']['moved']?>" id="moveto-<?=$enquiry['Enquiry']['id']?>" type="button"  move-id="<?=$enquiry['Enquiry']['id']?>" move-val="<?=$enquiry['Enquiry']['moved']?>"> <? } ?>
</td>-->
</tr>
<?php  $parent=''; endforeach; ?>

</td></tr>

<? } else { ?>
<tr><td colspan="13">
NO MORE RECORDS.
</td></tr>
<? } ?>
<?php /*?><tr><td colspan="13"><?=$this->requestAction(array("controller"=>"enquiries","action"=>"ajaxpaging",1,3));?></td></tr><?php */?>
</tbody>
</table>
<div class="paging">
<?php
echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
echo $this->Paginator->numbers(array('separator' => ''));
echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
?></div>
</div>

<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>cal/epoch_styles.css" />
<script type="text/javascript" src="<?=SITE_PATH?>cal/epoch_classes.js"></script>
<script type="text/javascript" language="javascript">

var dp_cal1;var dp_cal2;      
dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('to_date'));	
dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('from_date'));	
</script>

<script type="text/javascript">

$(document).ready(function(){
$("#search_builder").change(function(){
var c=$(this).val();
$('#search_project').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>projects/getproject/"+c,success:function(result){$("#search_project").html(result);}});

});
});


$(document).ready(function() {
$(".moveto").click(function(){
alert("Are you Sure to remove  this");
var id=$(this).attr("move-id");
var val=$(this).attr("move-val");
$.ajax({url:"<?=SITE_PATH?>enquiries/moveThis/"+id+"/"+val,success:function(result){ res=result.split("#"); if(res[0]==1) { $("#moveto-"+id).val("Removed"); $("#moveto-"+id).prop('disabled', true); alert("Data saved successfully");  } else { alert('Please try again');}}});
})})

</script>
<script lang='javascript'>
function printData()
{
   var divToPrint=document.getElementById("printTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}
$('button').on('click',function(){
printData();
})
 </script>