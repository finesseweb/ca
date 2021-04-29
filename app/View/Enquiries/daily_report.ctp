<h2><?php echo __('DAILY STATUS REPORT'); ?></h2> 
<? if(CakeSession::read('User.type')!=='regular'){ ?>
<div class="panel panel-default">
<div class="panel-body">
<form id="mastersearch" mathod="get" action="<?=SITE_PATH?>enquiries/dailyReport/">
<div class="row"><div class="col-sm-3"><input type="text" name="date" id="date" placeholder="BY DATE" class="form-control" value="<? if(isset($this->params->query['date'])){ echo trim($this->params->query['date']); }?>"/></div>

<div class="col-sm-1"><input type="submit" name="confirm" value="search" class="btn btn-warning btn-block" data-id='1'/> </div> <div class="col-sm-1"><input type="button" name="reset" value="reset" class="btn btn-info btn-block" onClick="window.location.href='<?=SITE_PATH?>enquiries/dailyReport/'"/></div><div class="col-sm-1"><?php /*?><input type="button" name="reset" value="export" onclick="window.open('<?=SITE_PATH?>enquiries/export/?<?=$_SERVER['QUERY_STRING']?>','abhay','scrollbars=1,width=1400,height=650,left=100,top=50')"/><?php */?></div>
</div>
</form>
</div>
</div>



<? } ?>
<div class="table-responsive">
<table class="table table-hover table-condensed">
<thead>
<tr><th colspan="10">Daily Report As On <?=date('d-m-Y, l',strtotime($date))?></th></tr>
<tr><th colspan="3">TOTAL</td><td colspan="7"><?=$total?></th></tr>
<? if($total!=0) { $sourceWiseLeadsCounter=$this->requestAction(array('controller'=>'enquiries','action'=>'sourceWiseLeadsCounter',$date));?>
<tr><th colspan="10"><? echo $sourceWiseLeadsCounter;?><?=$this->requestAction(array('controller'=>'enquiries','action'=>'movedToLeads',$date));?></th></tr><? } ?>
<tr>
<th>Executive</th>
<th>Client</th>
<th>Country</th>
<th>Project</th>
<th>Status</th>
<th>Attended By</th>
<th>Client Type</th>
<th>Response</th>
<th>Source</th>
<th>Msg Sent</th>
</tr>
</thead>
<tbody id="response">
<?php $users='';$tot=0;$enquiries=''; if(!empty($data)) { foreach ($data as $data): 
$users=$this->requestAction(array('controller'=>'enquiries','action'=>'usersOnParent',$data['user']['id']));
?>
<tr> <th colspan="10">Group ( <? echo $data['user']['name'].' '.$data['user']['last_name']; ?> )</th></tr>

<?  if(!empty($users)) { foreach ($users as $usr):

$enquiries=$this->requestAction(array('controller'=>'enquiries','action'=>'dailyAll',$date,$usr['user']['id']));
//print_r($enquiries);

if(!empty($enquiries) and count($enquiries)!=0) {  foreach ($enquiries as $enq):
$tot+=1;
$dailyreports=$this->requestAction(array('controller'=>'dailyReports','action'=>'reportOnEnquiry',$enq['Enquiry']['id']));
$leadsource=$this->requestAction(array('controller'=>'enquiries','action'=>'leadsource',$enq['Enquiry']['lead_source_id']));

?>

<tr>
<td><?php echo h($usr['user']['name']." ".$usr['user']['last_name']); ?></td>
<td><?php echo h($enq['Enquiry']['name']); ?></td>
<td><?php echo h($enq['Country']['name']); ?></td>
<td><?php echo h($enq['Project']['name']); ?></td>
<td><?php echo h($enq['Enquiry']['status']); ?></td>
<td><?php if(!empty($dailyreports)) { echo h($this->requestAction(array("controller"=>"users","action"=>"getUser",$dailyreports[0]['DailyReport']['attend_by'])));} ?></td>
<td><?php if(!empty($dailyreports)) {echo h($dailyreports[0]['DailyReport']['customer_type']);} ?></td>
<td><?php if(!empty($dailyreports)) {echo h($dailyreports[0]['DailyReport']['response']);} ?></td>
<td><?php if(!empty($leadsource)) {echo h($leadsource);} ?></td>
<td><?php if(!empty($dailyreports)) {echo h($dailyreports[0]['DailyReport']['msgsent']); } ?></td>
</tr>


<? endforeach; } ?> 

<?  endforeach; } ?>
<tr><th>TOTAL</th><th colspan="9"><?=$tot?></th></tr>
<?php $tot=0; endforeach;  ?>
<? } else { ?><tr><td colspan="13">NO MORE RECORDS.</td></tr><? } ?>
</tbody>
</table></div>

<?  $meetings=$this->requestAction(array('controller'=>'meetings','action'=>'report',$date)); ?>
<div class="table-responsive">
<table class="table table-hover table-condensed">
<thead>
<tr><th colspan="11">Daily Meeting Feeds As On <?=date('d-m-Y',strtotime($date))?></th></tr>
<tr><th colspan="4">TOTAL</td><td colspan="7"><?=count($meetings)?></th></tr>
<tr><th colspan="11"><? echo $this->requestAction(array('controller'=>'meetings','action'=>'meetingStatusCounter',$date));?></td></tr>
<tr>
<th>Executive</th>
<th>Project Name</th>
<th>Timings</th>
<th>Client</th>
<th>Meeting Place</th>
<th>Representative</th>
<th>Status</th>
<th>Response</th>
<th>First Response</th>
<th>Form Received</th>
<th>Lead Repeat</th>
</tr>
</thead>
<tbody>
<? if(!empty($meetings)) { foreach($meetings as $value) { $representative=$this->requestAction(array('controller'=>'users','action'=>'getUser',$value['Meeting']['representative'])) ?>
<tr>
<td><?=$value['User']['name']." ".$value['User']['last_name']?></td>
<td><?=$value['Project']['name']?></td>
<td><?=$value['Meeting']['timing']?></td>
<td><?=$value['Meeting']['client_name']?></td>
<td><?=$value['Meeting']['meeting_place']?></td>
<td><?=$representative?></td>
<td><?=ucfirst($value['Meeting']['status'])?></td>
<td><?=$value['Meeting']['response']?></td>
<td><?=$value['Meeting']['first_response']?></td>
<td><?=$value['Meeting']['form_received']?></td>
<td><?=$value['Meeting']['form_repeat']?></td>
</tr>
<?  }  } else {  ?>
<tr><td colspan="11">No more records found.</td></tr>
<? }?></tbody>
</table>
</div>
<? if(!isset($this->params->query['date']) || $this->params->query['date']==''){ $campaigns=$this->requestAction(array('controller'=>'mailerFeeds','action'=>'dailyAll')); 
if(CakeSession::read('User.type')!=='regular'){
?>
<div class="table-responsive"><table class="table table-hover table-condensed">
<tr><th colspan="3">Mailers Campaign As On <?=$date?></th><th colspan="2" class="report-heading">Total : <?=count($campaigns)?></th></tr>
<tr>
<th>Builder</th>
<th>Project</th>
<th>Total Data</th>
<th>Type Of Data</th>
<th>If No Any Mailer</th>
</tr>
<?
if($campaigns){ foreach($campaigns as $key=>$data) { 
?>
<tr>
<td><?=ucfirst($data['MailerFeed']['builder'])?></td>
<td><?=ucfirst($data['MailerFeed']['project'])?></td>
<td><?=ucfirst($data['MailerFeed']['total_data'])?></td>
<td><?=ucfirst($data['MailerFeed']['type_of_data'])?></td>
<td><?=ucfirst($data['MailerFeed']['if_no_any_mailer'])?></td>
</tr>
<? } } else { ?>  <tr><td colspan="5">No more records found.</td></tr> <? } ?></table></div>
<? } } ?>
<div class="table-responsive"><table class="table table-hover table-condensed">
<tr><td colspan="10"><input type="button" name="reset" value="Print Preview" class="btn btn-success" onClick="window.open('<?=SITE_PATH?>enquiries/printDaily/?<?=$_SERVER['QUERY_STRING']?>','abhay','menubar=no,link=no,scrollbars=yes,width=1800,height=1800')"/></td></tr>

</table></div>
<link rel="stylesheet" type="text/css" href="<?=SITE_PATH?>cal/epoch_styles.css" />
<script type="text/javascript" src="<?=SITE_PATH?>cal/epoch_classes.js"></script>
<script type="text/javascript" language="javascript">

var dp_cal1;var dp_cal2;      
dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('date'));	
</script>