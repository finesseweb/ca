<h2><?php echo __('WEEKLY MONTHLY STATUS REPORT');  ?></h2> 
<div class="panel panel-default">
<div class="panel-body">
<div class="row">
<form id="mastersearch" mathod="get" action="<?=SITE_PATH?>enquiries/weeklyMonthlyReport/">
<div class="col-sm-4"><div class="input-group"><input type="text" name="from_date" class="form-control" id="from_date" placeholder="BY DATE" value="<? if(isset($this->params->query['from_date'])){ echo trim($this->params->query['from_date']); }?>"/><span class="input-group-addon">To</span><input type="text" name="to_date" id="to_date" class="form-control" placeholder="BY DATE" value="<? if(isset($this->params->query['to_date'])){ echo trim($this->params->query['to_date']); }?>"/></div></div>

<div class="col-sm-2"><input type="submit" name="confirm" value="search" class="searchbtn btn btn-warning btn-block" data-id='1'/> </div> 

<div class="col-sm-2">
<select name="search_builder" id="search_builder" class="form-control">
<option value="">SELECT BUILDER</option>
<? foreach ($builders as $key=>$builders){?>
<option value="<? echo $key; ?>" <? if(isset($this->params->query['search_builder']) && $this->params->query['search_builder']==$key) { ?> selected="selected"<? } ?>><? echo $builders; ?></option>
<? } ?>
</select></div>

<div class="col-sm-2"><select name="projectid" id="search_project" class="form-control">
<option value="">SELECT PROJECT</option>
<? if(!empty($projects)) { foreach ($projects as $key2=>$project){?>
<option value="<? echo $key2; ?>" <? if(isset($this->params->query['projectid']) && $this->params->query['projectid']==$key2) { ?> selected="selected"<? } ?>><? echo $project; ?></option>
<? } } ?>
</select></div>

<div class="col-sm-2"><input type="button" name="reset" value="reset" class="btn btn-info btn-block" onclick="window.location.href='<?=SITE_PATH?>enquiries/weeklyMonthlyReport/'"/></div><div class="col-sm-3"><?php /*?><input type="button" name="reset" value="export" onclick="window.open('<?=SITE_PATH?>enquiries/export/?<?=$_SERVER['QUERY_STRING']?>','abhay','scrollbars=1,width=1400,height=650,left=100,top=50')"/><?php */?></div>
</form>
</div>
</div>
</div>

<div class="table-responsive"><table class="table table-striped">
<thead>
<tr><td colspan="10"> <?=$date?></td></tr>
<tr><td colspan="3">TOTAL</td><td colspan="7"><?=$total?></td></tr>
<? if(isset($this->params->query['from_date'])){ $customerTypeUserLeadsWeekly=$this->requestAction(array('controller'=>'enquiries','action'=>'customerTypeUserLeadsWeekly',$fromdate,$todate,$searchProjectId,$total));?>
<tr><td colspan="10"><? echo $customerTypeUserLeadsWeekly; ?></td></tr> <? } ?>
<tr>
<td>Executive</td>
<td>No Of Queries</td>
<td>Buyer/Seller/Dealer/Fake/Blank</td>
<td>First Response Above 50</td>
<td>Discrepencies</td>
<td>Company Given Query</td>
<td>Own Query</td>
<td>Meetings</td>
<td>Old Followup</td>
<td>Response Of meeting above 50</td>

</tr>
</thead>
<tbody id="response">
<?php 
$users='';$tot='';$enquiries='';$garndtotal=0;$totalcompanyGivenQuery=0;$totalownQuery=0; if(!empty($data)) { foreach ($data as $dataa): 
$users=$this->requestAction(array('controller'=>'enquiries','action'=>'usersOnParent',$dataa['user']['id']));
$totalFirstResponseAbove=0;
?>
<tr> <th colspan="10">Group ( <? echo $dataa['user']['name'].' '.$dataa['user']['last_name']; ?> )</th></tr>

<? if(!empty($users)) { foreach ($users as $usr):

$enquiries=$this->requestAction(array('controller'=>'enquiries','action'=>'weeklyAll',$fromdate,$todate,$searchProjectId,$usr['user']['id']));
//print_r($enquiries);
if(!empty($enquiries)) { 
//$dailyreports=$this->requestAction(array('controller'=>'dailyReports','action'=>'reportOnEnquiry',$enq['Enquiry']['id']));
//$getUser=$this->requestAction(array('controller'=>'users','action'=>'getUser',$usr['User']['id']));
$countWeeklyUserLeads=$this->requestAction(array('controller'=>'enquiries','action'=>'countWeeklyUserLeads',$fromdate,$todate,$searchProjectId,$usr['user']['id']));
$customerTypeUserLeads=$this->requestAction(array('controller'=>'enquiries','action'=>'customerTypeUserLeads',$fromdate,$todate,$searchProjectId,$usr['user']['id'],$countWeeklyUserLeads));
$responseUserLeads=$this->requestAction(array('controller'=>'enquiries','action'=>'responseUserLeads',$fromdate,$todate,$searchProjectId,$usr['user']['id']));
$companyGivenQuery=$this->requestAction(array('controller'=>'enquiries','action'=>'leadsFromSource',$fromdate,$todate,$searchProjectId,$usr['user']['id'],'company_given_query'));
$ownQuery=$this->requestAction(array('controller'=>'enquiries','action'=>'leadsFromSource',$fromdate,$todate,$searchProjectId,$usr['user']['id'],'own_query'));
$garndtotal+=$countWeeklyUserLeads;
$totalFirstResponseAbove+=$responseUserLeads;
$totalcompanyGivenQuery+=$companyGivenQuery;
$totalownQuery+=$ownQuery;
?>

<tr>
<td><?php echo h($usr['user']['username']); ?></td>
<td><?php echo $countWeeklyUserLeads; ?></td>
<td><?php echo $customerTypeUserLeads; ?></td>
<td style="text-align:center"><?php echo $responseUserLeads; ?></td>
<td><input type="text" class="form-control"/></td>
<td style="text-align:center"><?php echo $companyGivenQuery; ?></td>
<td style="text-align:center"><?php echo $ownQuery; ?></td>
<td><input type="text" class="form-control"/></td>
<td><input type="text" class="form-control"/></td>
<td><input type="text" class="form-control"/></td>
</tr>




<? } endforeach; } ?>
<tr><th>TOTAL</th><th colspan="2"><?=$garndtotal?></th><th style="text-align:center"><?=$totalFirstResponseAbove?></th><th>&nbsp;</th><th style="text-align:center"><?=$totalcompanyGivenQuery?></th><th style="text-align:center"><?=$totalownQuery?></th><th></th><th></th><th></th></tr> 
<?php $garndtotal=0;$totalcompanyGivenQuery=0;$totalownQuery=0; endforeach;  ?>
<? } else { ?><tr><td colspan="13">NO MORE RECORDS.</td></tr><? } ?>
<tr><td colspan="10"><input type="button" name="reset" value="Print Preview" class="btn btn-success" onclick="window.open('<?=SITE_PATH?>enquiries/printWeekly/?<?=$_SERVER['QUERY_STRING']?>','abhay','menubar=no,link=no,scrollbars=yes,width=1800,height=1800')"/></td></tr>
</tbody>
</table></div>
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>cal/epoch_styles.css" />
<script type="text/javascript" src="<?=SITE_PATH?>cal/epoch_classes.js"></script>
<script type="text/javascript" language="javascript">

var dp_cal1;var dp_cal2;      
dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('from_date'));	
dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('to_date'));


$(document).ready(function(){
$("#search_builder").change(function(){
var c=$(this).val();
$('#search_project').html("<option value=''>loading......</option>"); 
$.ajax({url:"<?=SITE_PATH?>projects/getproject/"+c,success:function(result){$("#search_project").html(result);}});

});
});
</script>