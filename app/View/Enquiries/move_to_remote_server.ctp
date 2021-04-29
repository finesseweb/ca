<h2><?php echo __('MOVE TO HCOHONEY.COM');  ?></h2> 
<div class="panel panel-default">
<div class="panel-body">
<div class="row">
<form id="mastersearch" mathod="get" action="<?=SITE_PATH?>enquiries/moveToRemoteServer">
<?php /*?> <div class="txt_one">SEARCH</div><?php */?>
<div class="col-sm-3"><input type="text" name="search_key" class="form-control" placeholder="By Name, Email, Lead, Contact" value="<? if(isset($this->params->query['search_key'])){ echo trim($this->params->query['search_key']); }?>"/></div>

<div class="col-sm-3"><div class="input-group"><input type="text" name="from_date" id="from_date" class="form-control" placeholder="DATE FROM" value="<? if(isset($this->params->query['from_date'])){ echo trim($this->params->query['from_date']); }?>"/><span class="input-group-addon">To</span><input type="text" name="to_date" class="form-control" id="to_date" placeholder="DATE TO" value="<? if(isset($this->params->query['to_date'])){ echo trim($this->params->query['to_date']); }?>"/></div></div>
<div class="col-sm-2"><select name="search_user" id="search_user" class="form-control">
<option value="">SELECT USER</option>
<? $select='';$userid='';
if(isset($this->params->query['search_user'])) { $userid=$this->params->query['search_user']; }
if(CakeSession::read('User.type')==='regular'){
if(CakeSession::read('User.id')==$userid) {$select='selected="selected"';}
echo '<option value="'.CakeSession::read('User.id').'" '.$select.'">---- '.CakeSession::read('User.name').'</option>';
echo $this->requestAction(array("controller"=>"users","action"=>"buildTree",CakeSession::read('User.id'),$userid));
} else { echo $this->requestAction(array("controller"=>"users","action"=>"buildTree",0,$userid)); } ?>
</select></div>
<div class="col-sm-2"><select name="search_country" id="search_country" class="form-control">
<option value="">SELECT COUNTRY</option>
<? foreach ($countries as $key=>$country){?>
<option value="<? echo $key; ?>" <? if(isset($this->params->query['search_country']) && $this->params->query['search_country']==$key) { ?> selected="selected"<? } ?>><? echo $country; ?></option>
<? } ?>
</select></div>
<div class="col-sm-2"><select name="search_builder" id="search_builder" class="form-control">
<option value="">SELECT BUILDER</option>
<? foreach ($builders as $key=>$builders){?>
<option value="<? echo $key; ?>" <? if(isset($this->params->query['search_builder']) && $this->params->query['search_builder']==$key) { ?> selected="selected"<? } ?>><? echo $builders; ?></option>
<? } ?>
</select></div>
<div class="col-sm-2"><select name="search_project" id="search_project" class="form-control">
<option value="">SELECT PROJECT</option>
<? if(!empty($projects)) { foreach ($projects as $key2=>$project){?>
<option value="<? echo $key2; ?>" <? if(isset($this->params->query['search_project']) && $this->params->query['search_project']==$key2) { ?> selected="selected"<? } ?>><? echo $project; ?></option>
<? } } ?>
</select></div>
<div class="col-sm-2"><select name="close_reasons" id="close_reasons" class="form-control">
<option value="">SELECT REASONS</option>
<? foreach ($closeReasons as $key=>$closeReasons){?>
<option value="<? echo $key; ?>" <? if(isset($this->params->query['close_reasons']) && $this->params->query['close_reasons']==$key) { ?> selected="selected"<? } ?>><? echo $closeReasons; ?></option>
<? } ?>
</select></div>
<div class="col-sm-3"><select name="lead_source_id" id="lead_source_id" class="form-control">
<option value="">SELECT LEAD SOURSE</option>
<? foreach ($leadSources as $key4=>$leadSource){?>
<option value="<? echo $key4; ?>" <? if(isset($this->params->query['lead_source_id']) && $this->params->query['lead_source_id']==$key4) { ?> selected="selected"<? } ?>><? echo $leadSource; ?></option>
<? } ?>
</select></div>
<div class="col-sm-2"><select name="search_status" id="search_status" class="form-control">
<option value="">SELECT STATUS</option>
<option value="open" <? if(isset($this->params->query['search_status']) && $this->params->query['search_status']=="open") { ?> selected="selected"<? } ?>>Open</option>
<option value="close" <? if(isset($this->params->query['search_status']) && $this->params->query['search_status']=="close") { ?> selected="selected"<? } ?>>Close</option>
<option value="done" <? if(isset($this->params->query['search_status']) && $this->params->query['search_status']=="done") { ?> selected="selected"<? } ?>>Done</option>
<?php /*?><option value="trash" <? if(isset($this->params->query['search_status']) && $this->params->query['search_status']=="trash") { ?> selected="selected"<? } ?>>Trash</option><?php */?>
<option value="sold out" <? if(isset($this->params->query['search_status']) && $this->params->query['search_status']=="sold out") { ?> selected="selected"<? } ?>>Sold Out</option>
<option value="waiting" <? if(isset($this->params->query['search_status']) && $this->params->query['search_status']=="waiting") { ?> selected="selected"<? } ?>>Waiting</option>
</select></div>
<div class="col-sm-2"><input type="submit" name="confirm" value="search" class="searchbtn btn btn-warning btn-block" data-id='1'/> </div> <div class="col-sm-1"><input type="button" name="reset" value="reset" class="btn btn-info btn-block" onclick="window.location.href='<?=SITE_PATH?>enquiries/moveToRemoteServer'"/></div>
</form>
</div>
</div>
</div>
<?
$hcogroups='';$hcousers='';
if(!empty($hcohoneyGroups)) {$hcogroups='<div class="form-inline"><div class="input-group"><span class="input-group-addon"><input type="checkbox" name="withremark[]" class="dealer"  value="1" /></span><select name="dealer_group" class="dealergroup dealer form-control"><option value="0">Select Group</option>'; foreach($hcohoneyGroups as $grp) { $hcogroups.='<option value="'.$grp['hcohoney_group']['groupid'].'">'.$grp['hcohoney_group']['name'].'</option>';}    $hcogroups.='</select>';}
if(!empty($hcohoneyUsers)) {$hcousers='<select name="dealer_id" class="dealer form-control"><option value="0">Select Executive</option>';  foreach($hcohoneyUsers as $usr) { $hcousers.='<option value="'.$usr['hcohoney_users']['userid'].'">'.$usr['hcohoney_users']['name'].'</option>';} $hcousers.='</select> </div></div>'; }
?>
<?php /*?><div class="bg_disabled"></div><?php */?>
<div class="table-responsive"><table class="table table-hover table-condensed" id="fadeinout">
<thead>
<tr><td colspan="13"><?php
echo $this->Paginator->counter(array(
'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
));
?></td></tr>
<tr>
<th width="5.5%"><?php echo $this->Paginator->sort('id'); ?></th>
<th><?php echo $this->Paginator->sort('user_id'); ?></th>
<th><?php echo $this->Paginator->sort('posted_date'); ?></th>
<th><?php echo $this->Paginator->sort('name'); ?></th>
<th><?php echo $this->Paginator->sort('email'); ?></th>
<th><?php echo $this->Paginator->sort('contact'); ?></th>
<th><?php echo $this->Paginator->sort('project_id'); ?></th>
<th><?php echo $this->Paginator->sort('country_id'); ?></th>
<th><?php echo "Dealer ID"; ?></th>
<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
</thead>
<tbody id="response">
<?php if(!empty($enquiries)) { foreach ($enquiries as $enquiry): ?>
<tr class="<?=$enquiry['Enquiry']['status']." ".$enquiry['Enquiry']['id']?>" title="<?=$enquiry['Enquiry']['status']?> (<?=$enquiry['CloseReason']['name']?>)">
<td title="<?=$enquiry['LeadSource']['name']?>"><?php echo h($enquiry['Enquiry']['id']); ?> <i class="fa fa-circle <?=$enquiry['LeadSource']['flag']?>"></i></td>
<td><?php echo h($enquiry['User']['username']);?></td>
<td><?php echo h(date('d M , Y',strtotime($enquiry['Enquiry']['posted_date']))); ?>&nbsp;</td>
<td><?php echo h($enquiry['Enquiry']['name']); ?>&nbsp;</td>
<td><?php echo h($enquiry['Enquiry']['email']); ?></td>
<td><?php echo h($enquiry['Enquiry']['contact']); ?>&nbsp;</td>
<td title="<? echo $enquiry['Builder']['name'];?> ( <? echo $enquiry['Project']['name'];?> )"><?php echo h(substr($enquiry['Project']['name'],0,20)); ?>..</td>
<td><?php echo h($enquiry['Country']['name']); ?></td>
<td><?php echo $hcogroups.''.$hcousers; ?></td>
<td class="actions">
<?php echo '<input type="button" name="move_to_dealer" class="move_to_dealer dealer" value="Move" data-id='.$enquiry['Enquiry']['id'].'>'; ?>
<a href="javascript:void(0)" title="<?php if($enquiry['Enquiry']['reminder_date']!='0000-00-00 00:00:00') { echo h(date('d M ,Y',strtotime($enquiry['Enquiry']['reminder_date'])));} ?>" <? if($enquiry['Enquiry']['is_reminder']=='no'){?>class="reminderno"<? } ?> onclick="window.open('<?=SITE_PATH."enquiries/view/".$enquiry['Enquiry']['id']."/".$enquiry['Enquiry']['user_id']?>','abhay','scrollbars=1,width=1400,height=650,left=100,top=50')" title="Remark">R</a>
</td>
</tr>
<?php endforeach; ?>

<tr><td colspan="13"><?php
echo $this->Paginator->counter(array(
'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
));
?></td></tr>
<tr><td colspan="13">
<div class="paging">
<?php
echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
echo $this->Paginator->numbers(array('separator' => ''));
echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
?></div>
</td></tr>


<? } else { ?>
<tr><td colspan="13">
NO MORE RECORDS.
</td></tr>
<? } ?>
<?php /*?><tr><td colspan="13"><?=$this->requestAction(array("controller"=>"enquiries","action"=>"ajaxpaging",1,3));?></td></tr><?php */?>
</tbody>
</table></div>

<div class="bg_disabled" style="display:none"><img src='http://server/current/cake-crm2/images/loader.gif'> Please wait moving your data..</div>
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>cal/epoch_styles.css" />
<script type="text/javascript" src="<?=SITE_PATH?>cal/epoch_classes.js"></script>
<script type="text/javascript" language="javascript">

var dp_cal1;var dp_cal2;      
dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('to_date'));	
dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('from_date'));	
</script>

<script type="text/javascript">

$(document).ready(function(){
$(".move_to_dealer").click(function(){
var c=$(this).attr('data-id');
var conf=confirm('Are you sure to move data');
if(conf) {
if(c!='') {
var dealerid=$(this).parent().parent().find("select[name='dealer_id']").val();
var dealergroup=$(this).parent().parent().find("select[name='dealer_group']").val();
var withtemark;
//alert($(this).parent().parent().find("input[name='withremark[]']").attr('checked'));
if($(this).parent().parent().find("input[name='withremark[]']").is(":checked")) { withtemark=1;} else { withtemark=0;}

if(dealerid==0 && dealergroup==0){ alert("both group and executive are manadatory"); return false;}
if($.isNumeric(dealerid) && $.isNumeric(dealergroup)) { 
$(".bg_disabled").css("display", "block");
$.ajax({url:"<?=SITE_PATH?>enquiries/transferToHcohoney/"+c+"/"+dealerid+"/"+dealergroup+"/"+withtemark,success:function(result){
if(result==1){
alert("Moved Successfully"); 
$(".bg_disabled").css("display", "none");
location.reload();
//$(".bg_disabled").css("display", "none");
//$("."+dealerid).css("bg-color", "#e4e4e4");


} 
else { 
alert("Error occure.Try again"); 
$(".bg_disabled").css("display", "none");
}
}});
}
else { alert('not a number');}
}
}
});
});

$(document).ready(function(){
$("#search_builder").change(function(){
var c=$(this).val();
$('#search_project').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>projects/getproject/"+c,success:function(result){$("#search_project").html(result);}});

});
});

$(document).ready(function(){
$(".dealergroup").change(function(){
var c2=$(this).val();
var dealerid2=$(this).parent().parent().find("select[name='dealer_id']");
$(dealerid2).html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>hcohoneyUsers/getUser/"+c2,success:function(result){$(dealerid2).html(result)}});

});
});

</script>
