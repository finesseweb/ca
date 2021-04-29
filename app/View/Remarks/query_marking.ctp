<? $allparentids=@implode('##',$users);?>
<h2><?php echo __('Enquiries Marking Panel');  ?></h2> 
<div class="btn-group">
<?php echo $this->Html->link(__('New Enquiry'), array('action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('Today Reminders'), array('controller' => 'enquiries', 'action' => 'currentReminders'),array('class' => 'btn btn-primary')); ?>
<?php echo $this->Html->link(__('Meetings'), array('controller' => 'meetings', 'action' => 'index'),array('class' => 'btn btn-primary')); ?>
</div>

<div class="panel panel-default">
<div class="panel-body">
<form id="mastersearch" mathod="get" action="<?=SITE_PATH?>remarks/queryMarking/">
<?php /*?> <div class="txt_one">SEARCH</div><?php */?>
<div class="row">

<div class="col-sm-3"><select name="search_user" id="search_user" class="form-control">
<option value="">SELECT USER</option>
<? $select=0;$userid=0;

if(isset($this->params->query['search_user']) and $this->params->query['search_user']!='') { $userid=$this->params->query['search_user']; }
if(CakeSession::read('User.type')==='regular'){
if(CakeSession::read('User.id')==$userid) {$select='selected="selected"';}
echo '<option value="'.CakeSession::read('User.id').'" '.$select.'">---- '.CakeSession::read('User.name').'</option>';
echo $this->requestAction(array("controller"=>"users","action"=>"buildTree",CakeSession::read('User.id'),$userid,$allparentids));
} else { echo $this->requestAction(array("controller"=>"users","action"=>"test",$userid)); } ?>
</select></div>

<div class="col-sm-3"><div class="input-group"><input type="text" name="from_date" id="from_date" class="form-control" placeholder="DATE FROM" value="<? if(isset($this->params->query['from_date'])){ echo trim($this->params->query['from_date']); }?>"/><span class="input-group-addon">To</span><input type="text" name="to_date" id="to_date" class="form-control" placeholder="DATE TO" value="<? if(isset($this->params->query['to_date'])){ echo trim($this->params->query['to_date']); }?>"/></div></div>
<div class="col-sm-3"><select name="search_builder" id="search_builder" class="form-control">
<option value="">SELECT BUILDER</option>
<? foreach ($builders as $key=>$builders){?>
<option value="<? echo $key; ?>" <? if(isset($this->params->query['search_builder']) && $this->params->query['search_builder']==$key) { ?> selected="selected"<? } ?>><? echo $builders; ?></option>
<? } ?>
</select></div>

<div class="col-sm-3"><select name="search_project" id="search_project" class="form-control">
<option value="">SELECT PROJECT</option>
<? if(!empty($projects)) { foreach ($projects as $key2=>$project){?>
<option value="<? echo $key2; ?>" <? if(isset($this->params->query['search_project']) && $this->params->query['search_project']==$key2) { ?> selected="selected"<? } ?>><? echo $project; ?></option>
<? } } ?>
</select></div><br/>

<div class="col-sm-2"><input type="checkbox" name="no_reminder"  value="no_reminder" <? if(isset($this->params->query['no_reminder'])){?> checked="checked" <? } ?>/>No Reminder </div>
<div class="col-sm-2"><input type="checkbox" name="no_remark_after_Week"  value="no_remark_after_Week" <? if(isset($this->params->query['no_remark_after_Week'])){?> checked="checked" <? } ?>/>No remark afer a week</div>


<div class="col-sm-2"><input type="submit" name="confirm" value="search" class="searchbtn btn btn-warning btn-block" data-id='1'/> </div> <div class="col-sm-2"><input type="button" name="reset" class="btn btn-info btn-block" value="reset" onclick="window.location.href='<?=SITE_PATH?>remarks/queryMarking/'"/></div>
</div>
</form>
</div>
</div>

<table cellpadding="0" cellspacing="0">
<thead>
<tr><td colspan="13"><?php
echo $this->Paginator->counter(array(
'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
));
?></td></tr>
<tr>
<th width="5.5%"><input type="checkbox" name="lead_check_all" class="leadcheckall">&nbsp;<?php echo $this->Paginator->sort('id'); ?></th>
<th><?php echo $this->Paginator->sort('user_id'); ?></th>
<th><?php echo $this->Paginator->sort('posted_date'); ?></th>
<th><?php echo $this->Paginator->sort('name'); ?></th>
<th><?php echo $this->Paginator->sort('email'); ?></th>
<th><?php echo $this->Paginator->sort('contact'); ?></th>
<th><?php echo $this->Paginator->sort('project_id'); ?></th>
<th><?php echo $this->Paginator->sort('country_id'); ?></th>
<th class="actions"><?php echo __('Actions'); ?></th>
</tr>
</thead>
<tbody id="response">
<?php
$parent='';
$getAllParents=$this->requestAction(array("controller"=>"users","action"=>"getAllParent"));

if(!empty($enquiries)) { foreach ($enquiries as $enquiry):
//$markeddata='';
if(array_key_exists($enquiry['User']['parent'],$getAllParents)){  $parent="( ".ucwords($getAllParents[$enquiry['User']['parent']]." )");  }
//if(strtotime($enquiry['Enquiry']['marked_or_not'])!=''){ $markeddata='waiting'; } 
?>
<tr class="<?=$enquiry['Enquiry']['status']?>" title="<?=$enquiry['Enquiry']['status']?> (<?=$enquiry['CloseReason']['name']?>)">
<td title="<?=$enquiry['LeadSource']['name']?>"><input type="checkbox" name="lead_check[]" value="<?=$enquiry['Enquiry']['id']?>" class="leadcheck" <? if($enquiry['Enquiry']['marked_or_not']=='Y') { ?> checked="checked" <? } ?>>&nbsp;<?php echo h($enquiry['Enquiry']['id']); ?> <i class="fa fa-circle <?=$enquiry['LeadSource']['flag']?>"></i> <? if($enquiry['Enquiry']['hot_lead']=='Y'){?><i class="fa fa-star"></i><? } ?></td>
<td><i title="<?=$enquiry['User']['username']?>" class="fa fa-square" style="color:<?=$enquiry['User']['colorcode']?>"></i><? if((int)$enquiry['Enquiry']['user_id']!=(int)trim($enquiry['Enquiry']['lead_of']) and (int)trim($enquiry['Enquiry']['lead_of'])!="") { $colorcode=$this->requestAction(array("controller"=>"users","action"=>"getColorCode",$enquiry['Enquiry']['lead_of'])); if(!empty($colorcode)) {?> <i title="<?=$colorcode[0]['users']['username']?>" class="fa fa-square" style="color:<?=$colorcode[0]['users']['colorcode']?>"></i>  <? } } ?> <?php echo h($enquiry['User']['username'] .' '. $parent); ?></td>
<td><?php echo h(date('d M , Y',strtotime($enquiry['Enquiry']['posted_date']))); ?>&nbsp;</td>
<td><?php echo h($enquiry['Enquiry']['name']); ?>&nbsp;</td>
<td><?php echo h($enquiry['Enquiry']['email']); ?></td>
<td><?php echo h($enquiry['Enquiry']['contact']); ?>&nbsp;</td>
<td title="<? echo $enquiry['Builder']['name'];?> ( <? echo $enquiry['Project']['name'];?> )"><?php echo h(substr($enquiry['Project']['name'],0,20)); ?>..</td>
<td><?php echo h($enquiry['Country']['name']); ?></td>

<td class="actions">
<a href="javascript:void(0)" <? if($enquiry['Enquiry']['is_discrepency']=='Y'){?>class="pending"<? } ?> onclick="window.open('<?=SITE_PATH."discrepencies/view/".$enquiry['Enquiry']['id']?>','abhay','scrollbars=1,width=1400,height=750,left=100,top=50')" title="Discrepency">D</a>

<a href="javascript:void(0)" title="<?php if($enquiry['Enquiry']['reminder_date']!='0000-00-00 00:00:00') { echo h(date('d M ,Y',strtotime($enquiry['Enquiry']['reminder_date'])));} ?>" <? if($enquiry['Enquiry']['is_reminder']=='no' && $enquiry['Enquiry']['status']=='open'){?>class="reminderno"<? } ?> onclick="window.open('<?=SITE_PATH."enquiries/view/".$enquiry['Enquiry']['id']."/".$enquiry['Enquiry']['user_id']?>','abhay','scrollbars=1,width=1400,height=650,left=100,top=50')" title="Remark">R</a>

<a href="javascript:void(0)" <? if($enquiry['Enquiry']['is_meeting']=='pending'){?>class="pending"<? } ?> onclick="window.open('<?=SITE_PATH."meetings/view/".$enquiry['Enquiry']['id']?>','abhay','scrollbars=1,width=1400,height=750,left=100,top=50')" title="Meeting">M</a>

<?php echo $this->Html->link(__('Edit'), array('controller'=>'enquiries','action' => 'edit', $enquiry['Enquiry']['id'])); ?>
</td>
</tr>
<?php  $parent=''; endforeach; ?>

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
<tr  id="mark_data" style="display:none">
<td><div class="submit"><input type="button" class="markdate" value="Mark"></div></td>
<td><div class="submit"><input type="button" class="removemarkdate" value="Unmark"></div></td>
<td colspan="11"></td>

</tr>
<? } else { ?>
<tr><td colspan="13">
NO MORE RECORDS.
</td></tr>
<? } ?>
<?php /*?><tr><td colspan="13"><?=$this->requestAction(array("controller"=>"enquiries","action"=>"ajaxpaging",1,3));?></td></tr><?php */?>
</tbody>
</table>


<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>cal/epoch_styles.css" />
<script type="text/javascript" src="<?=SITE_PATH?>cal/epoch_classes.js"></script>
<script type="text/javascript" language="javascript">

var dp_cal1;var dp_cal2;      
dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('to_date'));	
dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('from_date'));	
</script>

<script type="text/javascript">
<?php /*?>$(".searchbtn").click(function(){
var startpage=$(this).attr('data-id');
var searchval = "?"+$( "form#mastersearch" ).serialize()+"&startpage="+startpage;
$('#response').html("<div class='loading'><img src='<?=SITE_PATH?>images/loader.gif'> Please wait .Loading........</div>");
$.ajax({url:"<?=SITE_PATH?>enquiries/getResult/"+searchval,dataType:"html",success:function(result){
if(result!=''){$("#response").html(result);} else {$("#response").html("<div class='loading'>Data not found</div>");}
}});
});

$("div.paging span").click(function(){
var c=$(this).attr('p'); 
var searchval = "?"+$( "form#mastersearch" ).serialize()+"&startpage="+c;
$('#response').html("<div class='loading'><img src='<?=SITE_PATH?>images/loader.gif'> Please wait .Loading........</div>");
$.ajax({url:"<?=SITE_PATH?>enquiries/getResult/"+searchval,dataType:"html",success:function(result){
if(result!=''){$("#response").html(result);} else {$("#response").html("<div class='loading'>Data not found</div>");}
}});
});<?php */?>
http://localhost/current/cake-crm2/enquiries/dateMarking/?params={71355,71354,71353,71352,71351,71350,71349,71348,71347,71346,}
(function blink() { 
$('.reminderno').fadeOut(500).fadeIn(500, blink); 
})();

$(document).ready(function(){
$("#search_builder").change(function(){
var c=$(this).val();
$('#search_project').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>projects/getproject/"+c,success:function(result){$("#search_project").html(result);}});

});
});

$(function(){
$(".leadcheckall").click(function() { 
if($('.leadcheckall').is(':checked')){
$("#mark_data").removeAttr( "style" );	
$(".leadcheck").each(function (key , value) { 
$(this).prop("checked", true);
});		
}
else {      $("#mark_data").attr( "style","display:none" );
$(".leadcheck").each(function () {
$(this).prop("checked", false);
});
}
});


$(".leadcheck").change(function() {
if($('[name="lead_check[]"]:checked').length!=0){
$("#mark_data").removeAttr( "style" );
}
else{
$("#mark_data").attr( "style","display:none" );
}
});

$(".markdate").click(function() {
var ides =[];
var values="{" ;	
var i=0; 
$(".leadcheck").each(function (key , value) { 

if(this.checked)
{ 
ides.push($(this).val());

if(i==0) {

values+=$(this).val();
}
else
{  
values+=","+$(this).val();
}
i++   }

;});
values +="}";
if(ides.length!=0){ 
$.ajax({url: "<?=SITE_PATH?>remarks/dateMarking?params="+values, success: function(result){ alert(result); return false;
}});

}
});

$(".removemarkdate").click(function() {
var ides =[];
var values="{" ;	
var i=0; 
$(".leadcheck").each(function (key , value) { 

if(this.checked)
{ 
ides.push($(this).val());

if(i==0) {

values+=$(this).val();
}
else
{  
values+=","+$(this).val();
}
i++   }

});
values +="}";
if(ides.length!=0){
$.ajax({url: "<?=SITE_PATH?>remarks/removeDateMarking?params="+values, success: function(result){ alert(result);
}});

$(".leadcheck").each(function (key , value) { 
if(this.checked)
{ 
$(this).prop('checked', false);
}
});
}
});

});

$(document).ready(function(){
$(".leadcheck").each(function (key , value) { 
if(this.checked)
{
$("#mark_data").removeAttr( "style" );
}
});
});
</script>
